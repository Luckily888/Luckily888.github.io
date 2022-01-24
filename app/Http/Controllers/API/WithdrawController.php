<?php

namespace App\Http\Controllers\API;

use App\Model\Currency;
use App\Model\Transaction;
use App\Model\Wallet;
use App\Withdraw;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;
use Validator;

class WithdrawController extends Controller
{
    public function index(Request $request)
    {

        $query = Withdraw::leftJoin('users', 'withdraws.user_id', '=', 'users.id')
            ->leftJoin('currencies', 'withdraws.currency_id','=', 'currencies.id')
            ->where('user_id', $request->user()->id)
            ->select(\DB::raw("withdraws.*, users.name as user_name, currencies.name as currency_name
            ,currencies.symbol as currency_symbol"));

        if ($request->input('status')){
            $query->where('status', Withdraw::STATUS_PENDING);
        }

        $withdraws = $query->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status'=>'success',
            'items'=>$withdraws,
            'error_code'=>null
        ], 200);
    }

    public function postOutsideWithdraw(Request $request)
    {
        $user = $request->user();
        // check user wallet address
        $messages = [
            'amount.min' => 'Please enter the right amount',
            'receive_address.required' => 'Please insert receive address',
            'currency_id.required' => 'Please choose currency',
        ];
        $validator = Validator::make($request->all(),[
            "amount" => 'required|min:0.000000001',
            "receive_address" => "required",
            "currency_id" => "required",
        ], $messages);

        if ($validator->fails()) {
            Log::info('postOutsideWithdraw > validation fail', $validator->errors()->toArray());
            return response()->json($validator->errors()->toArray(),422);
        }

        // check balance
        $wallet = Wallet::whereCurrency($request->input('currency_id'))
            ->where('uid', $user->id)
            ->first();
        if (!$wallet){
            return response()->json([
                'status'=>'fail',
                'error_code'=>'not_found_address',
                'message'=>'Failed. Not found address in system.'
            ], 422);
        }
        if ($wallet->balance < $request->input('amount')){
            return response()->json([
                'status'=>'fail',
                'error_code'=>'not_enough_balance',
                'message'=>'Your Balance is not enough.'
            ], 422);
        }

        $currency = Currency::find($request->input('currency_id'));

        \DB::beginTransaction();

        try{
            // add withdraw item
            $withdraw = new Withdraw();
            $withdraw->user_id = $user->id;
            $withdraw->currency_id = $request->input('currency_id');
            $withdraw->wallet_id = $wallet->id;

            $withdraw->amount = $request->input('amount');
            $withdraw->balance_before = $wallet->balance;
            $withdraw->balance_after = $wallet->balance - $withdraw->amount;
            $withdraw->receive_address = $request->input('receive_address');
            $withdraw->status = Withdraw::STATUS_PENDING;

            // insert into transaction
            $transaction = new Transaction();
            $transaction->txid = "Withdraw";
            $transaction->amount = $request->input('amount');
            $transaction->from = $wallet->address;
            $transaction->to = $request->input('receive_address');
            $transaction->uid = $user->id;
            $transaction->currency = $currency->symbol;
            $transaction->save();

            $withdraw->transaction_id = $transaction->id;
            $withdraw->save();

            // subtract from wallet
            $wallet->balance  = $wallet->balance - $request->input('amount');
            $wallet->save();

            \DB::commit();
        }catch (\Exception $e){

            \DB::rollBack();
            return response()->json([
                'status'=>'fail',
                'error_code'=>'error',
                'message'=> 'Something wrong with the server',
                'exception'=>$e->getMessage()
            ], 422);
        }

        return response()->json([
            'status'=>'success',
            'error_code'=>null
        ], 200);
    }
}
