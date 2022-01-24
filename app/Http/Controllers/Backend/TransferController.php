<?php

namespace App\Http\Controllers\Backend;

use App\Model\Transaction;
use App\Model\Notification;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Currency;
use App\Model\Wallet;
use App\Model\History;

class TransferController extends Controller
{
    private $currency,$wallet,$notification,$transaction,$history;

    public function __construct(
        Currency $currency,
        Wallet $wallet,
        Notification $notification,
        Transaction $transaction,
        History $history

    )
    {
        $this->middleware(['auth', 'verified', 'checkkyc']);
        $this->currency = $currency;
        $this->wallet = $wallet;
        $this->notification = $notification;
        $this->transaction = $transaction;
        $this->history = $history;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $wallets = Wallet::join('currencies as c', 'wallets.currency', '=', 'c.id')
            ->where('uid', '=', auth()->user()->id)
            ->select('wallets.balance', 'c.id as coin_id', 'c.name as coin_name')
            ->orderBy('coin_name','asc')
            ->get();
        $res = Wallet::convertBalance($wallets);
        $results = $res->balances;

        return view('backend.transfer.index')->with(['results' => $results]);
    }

    public function getcoins(Request $request){
        $keyword = $request->keyword;
        $hidezerobalance = $request->hidezerobalance;

        $wallets = Wallet::join('currencies as c', 'wallets.currency', '=', 'c.id')
        ->where('uid', '=', auth()->user()->id)
        ->select('wallets.balance', 'c.id as coin_id', 'c.name as coin_name');                
                
        if($hidezerobalance==1)
        {
            $wallets->whereRaw('wallets.balance > 0');
        }

        if($keyword!="")
        {
            $wallets->whereRaw("c.name LIKE '%".$keyword."%'");
        }
        
        $wallets->orderBy('coin_name','asc');
        $wallets = $wallets->get();

        $res = Wallet::convertBalance($wallets);
        $results = $res->balances;

        return view('backend.transfer.ajaxcoins',['results' => $results]);
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
        $amount = $request->input('amount');
        $coin_id = $request->input('coin_id');
        $to = $request->input('to');
        $address = $request->input('address');
        $balances = Wallet::join('currencies as c', 'wallets.currency', '=', 'c.id')
            ->where('uid', '=', auth()->user()->id)
            ->select('wallets.balance', 'c.id as coin_id', 'c.name as coin_name')
            ->get();
        //check balance
        foreach ($balances as $balance){
            if ($balance->coin_id == $coin_id){
                if ($balance->balance <= $amount){
                    return redirect(route('user.transfers.show',['coin_id' => $coin_id]))->with(['status' => [
                        'class' => 'danger',
                        'message' => 'Your Balance is not enough.']
                    ]);
                }
            }
        }

        //check receiver.
        $receiver = $this->wallet->where('address',$to)
            ->select('uid')->get();
        if (!isset($receiver[0]->uid)){
            return redirect(route('user.transfers.show',['coin_id' => $coin_id]))->with(['status' => [
                'class' => 'danger',
                'message' => 'Not found address receiver in system.']
            ]);
        }


        //create transaction to DB
        $currency = Currency::where('id',$coin_id)->select('symbol','id')->get();
        $tran = New Transaction();
        $tran->txid = 'InphibitPay';
        $tran->amount = $amount;
        $tran->blockNumber = Carbon::now()->timestamp;
        $tran->from = $address;
        $tran->to = $to;
        $tran->use = false;
        $tran->uid = $receiver[0]->uid;
        $tran->currency = $currency[0]->symbol;
        $tran->save();

        $senderWallet = Wallet::where('currency', $currency[0]->id)
            ->where('uid', $request->user()->id)
            ->first();
        $senderWallet->balance = $senderWallet->balance - $amount;
        $senderWallet->save();


        // update receiver's balance
        $receiverWallet = Wallet::where('currency', $currency[0]->id)
            ->where('uid', $receiver[0]->uid)->first();
        // create a new one
        if (!$receiverWallet){
            $receiverWallet = new Wallet();
            $receiverWallet->uid = $receiver[0]->uid;
            $receiverWallet->address = $address;
            $receiverWallet->currency = $currency[0]->id;
            $receiverWallet->balance = 0;
        }
        $receiverWallet->balance = $receiverWallet->balance + $amount;
        $receiverWallet->save();

        //create user history
        $this->history->createHistory(0,$amount,'IPB Pay transfer',true,$currency[0]->id,'transfer',$tran->id,$receiver[0]->uid);
        $this->notification->send('You have received income transaction from '.\Auth::user()->name.' (Devvio). Click for check.',$receiver[0]->uid,\Auth::user()->email,route('transaction.search', $currency[0]->symbol));

        return redirect(route('user.transfers.show',['coin_id' => $coin_id]))->with(['status' => [
            'class' => 'info',
            'message' => 'Transfer is complete']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function show($id)
    {
        $currency = $this->currency->find($id);
        if (!$currency){
            return abort(404);
        }
        $histories = new \stdClass();
        $histories->{"hist"} = $this->history->where('currency_id', $id)->where('uid', auth()->user()->id)
            ->get();
        $histories->{"fail"} = [];
        $results = $this->wallet->where(['currency' => $id,'uid' => \Auth::user()->id])->get();

        return view('backend.transfer.form')->with([
            'currency_name' => $currency->name,
            'coin_id' => $id,
            'results' => $results[0],
            'histories' => $histories
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
