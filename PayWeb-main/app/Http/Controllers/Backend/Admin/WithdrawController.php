<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Model\Wallet;
use App\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WithdrawController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $withdraws = Withdraw::leftJoin('users', 'withdraws.user_id', '=', 'users.id')
            ->leftJoin('currencies', 'withdraws.currency_id','=', 'currencies.id')
            ->whereStatus(Withdraw::STATUS_PENDING)
            ->select(\DB::raw("withdraws.*, users.name as user_name, currencies.name as currency_name
            ,currencies.symbol as currency_symbol"))
            ->get();
        return view('admin.withdraw.index', compact('withdraws'));
    }

    public function approve(Request  $request, $id)
    {
        \Session::flash('success', 'Action is completed');
        $withdraw = Withdraw::findOrFail($id);
        $withdraw->status = Withdraw::STATUS_APPROVE;
        $withdraw->approve_user_id = auth()->user()->id;
        $withdraw->action_datetime = Carbon::now();
        $withdraw->save();

        return redirect(url('/admin/withdraws'));
    }

    public function notApprove(Request  $request, $id)
    {
        $user = $request->user();
        \Session::flash('success', 'Action is completed');

        $withdraw = Withdraw::findOrFail($id);
        $withdraw->status = Withdraw::STATUS_NOT_APPROVE;
        $withdraw->approve_user_id = auth()->user()->id;
        $withdraw->action_datetime = Carbon::now();
        $withdraw->save();

        // rollback wallet
        $wallet = Wallet::whereCurrency($withdraw->currency_id)
            ->where('uid', $user->id)
            ->first();
        $wallet->balance = $wallet->balance + $withdraw->amount;
        $wallet->save();

        return redirect(url('/admin/withdraws'));
    }

}
