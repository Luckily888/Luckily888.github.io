<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Model\Currency;
use App\Model\Notification;
use App\Model\Transaction;
use App\Model\Wallet;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\DevvioHistory;

class DevvioController extends Controller
{
    private $devvioHistory,$currency;
    public function __construct(
        DevvioHistory $devvioHistory,
        Currency $currency
    )
    {
        $this->middleware('auth:admin');
        $this->devvioHistory = $devvioHistory;
        $this->currency = $currency;
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
            ->get();

        $res = Wallet::convertBalance($wallets);

        return view('admin.devvio.index')->with(['results' => $res->balances]);
    }

    public function show($coin_id){
        $currency = Currency::where('devID',$coin_id)->select('id')->get();
        $users = User::join('wallets','users.id','=','wallets.uid')
            ->where('wallets.currency',$currency[0]->id)
            ->select('users.email','users.name','wallets.address')
            ->get();
        return view('admin.devvio.form')->with(['users' => $users,'coin_id' => $coin_id]);
    }

    public function send(Request $request){
        $amount = $request->input('amount');
        $coin_id = $request->input('coin_id');
        $to = $request->input('to');
        $ref = $this->generateRandomString();
        $receiver = Wallet::where('address',$to)->select('uid')->get();

        //create transaction to DB
        $currency =$this->currency->where('devID',$coin_id)->select('symbol')->get();
        $tran = new Transaction();
        $tran->txid = 'InphibitPay X Devvio (Sent by Admin)';
        $tran->amount = $amount;
        $tran->blockNumber = Carbon::now()->timestamp;
        $tran->from = '02D983C21D39840D20A3D9F9E0F707EE2020B36A8E9F46DC8A35EAD68925A3C9C4';
        $tran->to = $to;
        $tran->use = false;
        $tran->uid = $receiver[0]->uid;
        $tran->currency = $currency[0]->symbol;
        $tran->save();

        $update = $this->devvioHistory->where('reference',$ref)->update(['status' => 'success']);
        if ($update){
            $cur = Currency::where('devID',$coin_id)->select('name','symbol')->get();
            Notification::send('You have received '.$amount.' '.$cur[0]->symbol.' ('.$cur[0]->name.')',$receiver[0]->uid,false,'/home');
            return redirect(route('admin.devvio.form',['coin_id' => $coin_id]))->with(['status' => [
                'class' => 'success',
                'message' => 'Status transaction is success.']
            ]);
        }

        return redirect(route('admin.devvio.form',['coin_id' => $coin_id]))->with(['status' => [
            'class' => 'danger',
            'message' => 'Failed to create transaction.']
        ]);
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $check = $this->devvioHistory->where('reference',$randomString)->count();
        if ($check > 0){
            return $this->generateRandomString();
        }
        return $randomString;
    }
}
