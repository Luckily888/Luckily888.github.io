<?php

namespace App\Http\Controllers\API;

use App\Jobs\SendNotiAfterTXSuccess;
use App\Model\Credit;
use App\Model\CreditUser;
use App\Model\Currency;
use App\Model\History;
use App\Model\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Queue\RedisQueue;

class CreditPaymentController extends Controller
{
    public function show(Request $request, $id)
    {
        $creditUser = CreditUser::where('user_id', $request->user()->id)
            ->where('credit_id', $id)
            ->first();

        if (!$creditUser) {
            return response()->json(['error_code' => 'not_found_credit_user', 'status' => 'fail'], 422);
        }

        return response()->json($creditUser, 200);
    }

    public function getCreditsByType(Request $request, $type_id)
    {
        $credits = Credit::leftJoin('credit_users', function ($join) use ($request) {
            $join->on('credits.id', '=', 'credit_users.credit_id')
                ->where('credit_users.user_id', $request->user()->id);
        })
            ->leftJoin('currencies', 'credits.currency_id', '=', 'currencies.id')
            ->where('credit_type_id', $type_id)
            ->select('credits.id', 'credits.credit_type_id', 'credits.name', 'credits.icon',
                'currencies.id as currency_id', 'currencies.symbol as currency_symbol', 'currencies.name as currency_name',
                \DB::raw("IFNULL(credit_users.balance,0) as balance"))
            ->get();

        return response()->json($credits, 200);
    }

    public function getCredit(Request $request, $id)
    {
        $credit = Credit::leftJoin('credit_users', function ($join) use ($request) {
            $join->on('credits.id', '=', 'credit_users.credit_id')
                ->where('credit_users.user_id', $request->user()->id);
        })
            ->leftJoin('currencies', 'credits.currency_id', '=', 'currencies.id')
            ->select('credits.id', 'credits.credit_type_id', 'credits.name', 'credits.icon',
                'currencies.id as currency_id', 'currencies.symbol as currency_symbol', 'currencies.name as currency_name',
                \DB::raw("IFNULL(credit_users.balance,0) as balance"))
            ->findOrFail($id);
        return response()->json(['item' => $credit], 200);
    }

    public function getUserCredit(Request $request, $credit_id)
    {
        $credit = CreditUser::where('credit_id', $credit_id)
            ->where('user_id', $request->user()->id)
            ->first();
        $returnArr = [
            'balance' => 0
        ];
        if ($credit) {
            $returnArr['balance'] = $credit->balance;
        }

        return response()->json($returnArr, 200);
    }

    public function getUserCreditHistory(Request $request, $credit_id)
    {
        $credits = History::where('receiver', $credit_id)
            ->where('uid', $request->user()->id)
            ->where('method', History::$typeCreditPayment)
            ->select('created_at', 'amount')
            ->get();

        foreach ($credits as $credit) {
            $credit->formatted_created_at = is_null($credit->created_at) ? '' : Carbon::createFromFormat('Y-m-d H:i:s', $credit->created_at)->toRfc7231String();
        }

        return response()->json(['credit_list' => $credits], 200);
    }

    // id is credit id
    public function update(Request $request, $id)
    {
        $user = $request->user();

        $credit = Credit::find($id);
        if (!$credit) {
            return response()->json(['error_code' => 'not_found_credit', 'status' => 'fail'], 422);
        }
        if (!$credit->currency_id) {
            return response()->json(['error_code' => 'not_found_currency_in_credit', 'status' => 'fail'], 422);
        }
        // we get balance for currency_symbol
        $currency = Currency::find($credit->currency_id);
        if (!$currency) {
            return response()->json(['error_code' => 'not_found_currency', 'status' => 'fail'], 422);
        }
        $wallet = Wallet::find($request->wallet_id);
        if (!$wallet) {
            return response()->json(['error_code' => 'not_found_wallet', 'status' => 'fail'], 422);
        }

        if ((float)$wallet->balance <= (float)$request->input('amount')) {
            return response()->json(['error_code' => 'not_enough_balance', 'status' => 'fail'], 422);
        }

        // add to history
        if ((float)$request->amount <= 0) {
            return response()->json(['error_code' => 'zero_amount', 'status' => 'fail'], 422);
        }
        $amount = (float)$request->amount;
        $creditAmount = (float)$request->amount;

        \DB::beginTransaction();
        try{
            $ref = $request->ref;
            $note = $request->note;
            History::createHistory(0, $amount, $ref, true, $currency->id, History::$typeCreditPayment, null, $credit->id, $note);

            // subtract from wallet
            $wallet->balance = (float)$wallet->balance - (float)$amount;
            $wallet->save();

            // add amount to credit wallet
            $creditUser = CreditUser::firstOrNew([
                'credit_id' => $credit->id,
                'user_id' => $user->id
            ]);
            $creditUser->balance = (float)$creditUser->balance + $creditAmount;
            $creditUser->save();

            \DB::commit();
            $title = "Your credit purchase is complete.";
            $body = "" . $creditAmount . " " . $credit->name;
            SendNotiAfterTXSuccess::dispatch($request->user()->email, $title, $body);
        }catch (\Exception $e){
            \Log::error('credit store error', $request->input());
            \Log::error($e->getMessage() . "\n".$e->getTraceAsString());
            \DB::rollBack();
            return response()->json(['error_code' => 'server_error', 'status' => 'fail'],500);
        }

        return response()->json(['success' => true], 200);
    }
}
