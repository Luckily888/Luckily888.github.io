<?php

namespace App\Http\Controllers\Backend;

use App\Model\Currency;
use App\Model\History;
use App\Model\Transaction;
use App\Model\Wallet;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'checkkyc']);
    }

    public function index(){

        return view('backend.history', [
            "results" => History::getAll(),
            "transfers" => History::getTransfer(),
            'deposits' => Transaction::getMainCryptoFromWallet()
        ]);
    }

    public function getUserFromEmail($email,$currency_id)
    {
        return Wallet::join('users','wallets.uid','=','users.id')->where(['users.email' =>$email,'wallets.currency' => $currency_id])->select('users.name','users.email','wallets.address')->get();
    }
}
