<?php

namespace App\Http\Controllers\Backend;

use App\ExchangeTransaction;
use App\Model\Company;
use App\Model\Currency;
use App\Model\DevvioHistory;
use App\Model\History;
use App\Model\Notification;
use App\Model\Transaction;
use App\Model\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        $this->middleware(['auth', 'verified', 'checkkyc']);
        $this->currency = $currency;
        $this->company = $company;
        $this->history = $history;
        $this->wallet = $wallet;
        $this->notification = $notification;
        $this->devvioHistory = $devvioHistory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $balances = $this->wallet->getBalanceDevvioAvailable();

        return view('backend.exchange.index',['balances' => $balances]);
    }

    public function getcoins(Request $request){
        $keyword = $request->keyword;
        $hidezerobalance = $request->hidezerobalance;

        $balances = $this->wallet->getBalanceDevvioAvailable($keyword, $hidezerobalance);

        return view('backend.exchange.ajaxcoins',['balances' => $balances]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $currency1 = $request->input('currency1');
        $currency2 = $request->input('currency2');
        if ($currency1 == $currency2){
            return redirect(route('user.exchanges.index'))->with(['status' => [
                'class' => 'warning',
                'message' => 'Please choose a different currency.']
            ]);
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
                return redirect(route('user.exchanges.index'))->with(['status' => [
                    'class' => 'success',
                    'message' => 'Exchange successes.']
                ]);
            }

            return redirect(route('user.exchanges.index'))->with(['status' => [
                'class' => 'warning',
                'message' => 'Failed, something is wrong If your balance is reduced, please contact us.']
            ]);
        }

        return redirect(route('user.exchanges.index'))->with(['status' => [
            'class' => 'danger',
            'message' => 'Your Balance is not enough.']
        ]);
    }

    public function storeERC20(Request $request)
    {
        $currency1 = $request->input('currency1');
        $currency2 = $request->input('currency2');
        if ($currency1 == $currency2){
            return redirect(route('user.exchanges.index'))->with(['status' => [
                'class' => 'warning',
                'message' => 'Please choose a different currency.']
            ]);
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

                return redirect(route('user.exchanges.index'))->with(['status' => [
                    'class' => 'success',
                    'message' => 'Exchange successes.']
                ]);
            }catch (\Exception $e){
                Log::info($e->getMessage() . "\n" . $e->getTraceAsString());
                return redirect(route('user.exchanges.index'))->with(['status' => [
                    'class' => 'warning',
                    'message' => 'Failed, something is wrong If your balance is reduced, please contact us.']
                ]);
            }
        }

        return redirect(route('user.exchanges.index'))->with(['status' => [
            'class' => 'danger',
            'message' => 'Your Balance is not enough.']
        ]);
    }

    public static function convertCurrency($currency1,$currency2,$amount1){
        return Currency::convertCurrency($currency1, $currency2, $amount1);
    }

    public static function convertCurrency2($currency1,$currency2,$amount1,&$con1, &$con2){
        return Currency::convertCurrency2($currency1, $currency2, $amount1, $con1, $con2);
    }
}
