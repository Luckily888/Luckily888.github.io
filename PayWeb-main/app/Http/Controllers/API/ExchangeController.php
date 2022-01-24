<?php

namespace App\Http\Controllers\API;

use App\ExchangeTransaction;
use App\Jobs\SendNotiAfterTXSuccess;
use App\Model\Company;
use App\Model\Currency;
use App\Model\DevvioHistory;
use App\Model\History;
use App\Model\Notification;
use App\Model\Transaction;
use App\Model\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;

class ExchangeController extends Controller
{
    private $wallet,$currency,$company,$history,$notification,$devvioHistory;

    public function __construct(
        Currency $currency,
        Company $company,
        History $history,
        Wallet $wallet,
        Notification $notification,
        DevvioHistory $devvioHistory
    ){
//        $this->middleware(['verified', 'checkkyc']);
        $this->currency = $currency;
        $this->company = $company;
        $this->history = $history;
        $this->wallet = $wallet;
        $this->notification = $notification;
        $this->devvioHistory = $devvioHistory;
    }


    /**
     * Exchange only for Devvio coins ตอนนี้ไม่ได้ใช้  devvio แล้วแต่ยังมีเพราะทำมาเยอะแล้ว
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $currency1 = $request->input('currency1');
        $currency2 = $request->input('currency2');
        if ($currency1 == $currency2){
            return response()->json([
                'status'=>'fail',
                'error_code'=>'same_currency',
                'message'=>'Currencies could not be the same'
            ], 422);
        }

        $isDevvioCoins = Currency::whereIn('id', [$currency1, $currency2])
            ->where('isDevvio', 1)
            ->count();
        // return fail if not between Devvio and Devvio
        if ($isDevvioCoins != 2 ) {
            return response()->json([
                'status'=>'fail',
                'error_code'=>'not_correct_coins',
                'message'=>'Only the selected coins is allowed'
            ], 422);
        }

        $amount1 = $request->input('amount1');
        $amount2 = Currency::convertCurrency($currency1,$currency2,$amount1);

        //update balance first.
        $this->wallet->getBalanceDevvioAvailable();
        //get balance from database.
        $address = $this->wallet->getAddress($currency1);
        $balance = $this->wallet->getBalanceFromDB($address,$currency1);

        if ($balance >= $amount1){
            $amount1 = convert_to_devvio($amount1);
            $amount2 = convert_to_devvio($amount2);
            $exchange = Transaction::createTransactionDevvio($currency1,$currency2,$amount1,$amount2);
            if ($exchange){
                return response()->json([
                    'status'=>'success',
                    'error_code'=>null
                ], 200);
            }

            return response()->json([
                'status'=>'fail',
                'error_code'=>'devvio_tx_error',
                'message'=>'Failed, something is wrong If your balance is reduced, please contact us.'
            ], 422);
        }

        return response()->json([
            'status'=>'fail',
            'error_code'=>'not_enough_balance',
            'message'=>'Your Balance is not enough.'
        ], 422);
    }

    public function storeERC20(Request $request)
    {
        $currency1 = $request->input('currency1');
        $currency2 = $request->input('currency2');
        if ($currency1 == $currency2){
            return response()->json([
                'status'=>'fail',
                'error_code'=>'same_currency',
                'message'=>'Currencies could not be the same'
            ], 422);
        }

        $amount1 = $request->input('amount1');
        $amount2 = Currency::convertCurrency2($currency1,$currency2,$amount1, $currency1Conv, $currency2Conv);
        $uid = auth()->user()->id;
        //get balance from database.
        $wallet = $this->wallet->where('currency', $currency1)->where('uid', $uid)->first();
        $balance = 0;
        if ($wallet){
            $balance = $wallet->balance;
        }
        if ($balance >= $amount1){
            \DB::beginTransaction();
            try{
                $wallet2 = Wallet::firstOrNew(['uid'=>$uid, 'currency'=>$currency2]);
                $beforeAfter = ['wallet1'=>[], 'wallet2'=>[]];
                // has wallet currency2
                if ($wallet2->id){
                    $beforeAfter['wallet2'][0] = $wallet2->balance;
                    $wallet2->balance = $wallet2->balance + $amount2;
                }else{
                    $beforeAfter['wallet2'][0] = 0;
                    $wallet2->balance = $amount2;
                }
                $beforeAfter['wallet2'][1] = $wallet2->balance;

                // save wallet 2
                $wallet2->save();

                $beforeAfter['wallet'][0] = $wallet->balance;
                $wallet->balance = $wallet->balance - $amount1;
                $beforeAfter['wallet'][1] = $wallet->balance;
                $wallet->save();

                $exTx = new ExchangeTransaction();
                $exTx->from_currency_id = $currency1;
                $exTx->from_currency_amount = $amount1;
                $exTx->from_currency_before = $beforeAfter['wallet'][0];
                $exTx->from_currency_after = $beforeAfter['wallet'][1];
                $exTx->from_currency_conversion = $currency1Conv;
                $exTx->to_currency_id = $currency2;
                $exTx->to_currency_amount = $amount2;
                $exTx->to_currency_before = $beforeAfter['wallet2'][0];
                $exTx->to_currency_after = $beforeAfter['wallet2'][1];
                $exTx->to_currency_conversion = $currency2Conv;
                $exTx->uid = auth()->user()->id;
                $exTx->save();

                \DB::commit();
                $title = "Your exchange is complete.";
                $body = "+".$amount2;
                SendNotiAfterTXSuccess::dispatch($request->user()->email, $title, $body);

                return response()->json([
                    'status'=>'success',
                    'error_code'=>null
                ], 200);
            }catch (\Exception $e){
                \DB::rollBack();
                Log::error('exchange error ', $request->input());
                Log::error($e->getMessage() . "\n" . $e->getTraceAsString());

                return response()->json([
                    'status'=>'fail',
                    'error_code'=>'devvio_tx_error',
                    'message'=>'Failed, something is wrong If your balance is reduced, please contact us.'
                ], 422);
            }
        }

        return response()->json([
            'status'=>'fail',
            'error_code'=>'not_enough_balance',
            'message'=>'Your Balance is not enough.'
        ], 422);
    }

    public static function convertCurrency($currency1,$currency2,$amount1){
        return Currency::convertCurrency($currency1, $currency2, $amount1);
    }

    public static function convertCurrency2($currency1,$currency2,$amount1,&$con1, &$con2){
        return Currency::convertCurrency2($currency1, $currency2, $amount1, $con1, $con2);
    }
}
