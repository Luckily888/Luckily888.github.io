<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Transaction;
use App\User;

class TransactionController extends Controller
{
    private $transaction,$user;
    public function __construct(
        Transaction $transaction,
        User $user
    )
    {
        $this->middleware('auth:admin');
        $this->transaction = $transaction;
        $this->user = $user;
    }

    public function index(Request $request)
    {
        if ($request->get('currency')){
            $result = $this->transaction
                ->leftjoin('users','transactions.uid','users.id')
                ->where('currency',$request->get('currency'))
                ->select('transactions.*','users.name')
                ->get();
            $amount = $this->transaction->where('currency',$request->get('currency'))->sum('amount');
        }
        else{
            $result = $this->transaction->all();
            $amount = $this->transaction->all()->sum('amount');
        }
        return view('admin.transaction.index')->with([
            'results' => $result,
            'amount' => $amount
        ]);
    }
}
