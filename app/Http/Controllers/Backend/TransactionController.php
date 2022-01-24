<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Transaction;
use App\Model\Wallet;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    private $transaction,$wallet;
    public function __construct(
        Transaction $transaction,
        Wallet $wallet
    )
    {
        $this->middleware(['auth', 'verified', 'checkkyc']);
        $this->transaction = $transaction;
        $this->wallet = $wallet;
    }

    public function index(){
        $results = $this->transaction->where('uid',\Auth::user()->id)->orderBy('to')->get();
        return view('backend.transaction',['results' => $results]);
    }

    public function search($currency){
        $address = $this->wallet->getAddress(false,$currency);
        $incomes = $this->transaction->where(['to' => $address,'currency' => $currency])->orderBy('created_at','desc')->get();
        $outcomes = $this->transaction->where(['from' => $address,'currency' => $currency])->orderBy('created_at','desc')->get();
        return view('backend.transaction',['incomes' => $incomes,'outcomes' => $outcomes]);
    }


}
