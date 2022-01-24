<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\History;
use App\User;
use App\Model\Company;

class PaymentController extends Controller
{
    private $history,$user,$company;

    public function __construct(
        History $history,
        User $user,
        Company $company
    )
    {
        $this->middleware('auth:admin');
        $this->history = $history;
        $this->user = $user;
        $this->company = $company;
    }

    public function index(){
        $results = $this->history
            ->leftjoin('companies','histories.company_id','companies.id')
            ->leftjoin('users','histories.uid','users.id')
            ->leftjoin('currencies','histories.currency_id','currencies.id')
            ->orderBy('created_at','desc')
            ->select('histories.*','companies.name','users.name as user_name','currencies.symbol')
            ->get();
        $members = $this->user->all();
        return view('admin.payment.index')->with([
            'results' => $results,
            'members' => $members
        ]);
    }
}
