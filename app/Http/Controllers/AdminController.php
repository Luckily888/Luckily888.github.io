<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Model\History;
use App\Model\Currency;
use App\User;
use App\Model\Company;

class AdminController extends Controller
{
    private $history,$currency,$member,$company;
    public function __construct(
        History $history,
        Currency $currency,
        User $member,
        Company $company
    )
    {
        $this->middleware('auth:admin');
        $this->history = $history;
        $this->currency = $currency;
        $this->member = $member;
        $this->company = $company;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = $this->currency->all();
        $histories = $this->history->where('company_id','!=',0)->get();
        $amount_usd = 0;
        foreach ($histories as $history){
            $amount_usd += $history->amount * $currencies[$history->currency_id-1]->conversion;
        }

        $amount_income_today = 0;
        $histories = $this->history->whereDate('created_at',Carbon::today())->get();
        foreach ($histories as $history){
            $amount_income_today += $history->amount * $currencies[$history->currency_id-1]->conversion;
        }



        $amount_withdarw_today = 0;
        $amount_payment = sizeof($histories);
        $results = [
            'earnings_all' => $amount_usd,
            'earnings_today' => $amount_income_today,
            'withdraws_today' => $amount_withdarw_today,
            'payments_today' => $amount_payment,
            'chart' => $this->chart_fecth_detail($currencies)
        ];
        $members = $this->member->all();
        $payments = $this->history->where('company_id','!=',0)->orderBy('created_at','desc')->limit(5)->get();
        return view('admin.dashboard')->with([
            'results' => $results,
            'last_payments' => $payments,
            'members' => $members,
            'companies' => $this->company->all()
        ]);
    }

    public function chart_fecth_detail($currencies){
        $results = [];
        for ($i = 1;$i <= 12;$i++){
            $sum = 0;
            $vals = $this->history->whereMonth('created_at','=',($i > 9) ? "'.$i.'":'0'.$i)->whereYear('created_at','=',date('Y'))->get();
            foreach ($vals as $val){
                if (isset($currencies[$val->currency_id])){
                    $sum += $val->amount * $currencies[$val->currency_id]->conversion;
                }
            }
            $results[$i-1] = $sum;
        }
        return $results;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.auth.register');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        $this->validate($request, [
            'name'          => 'required',
            'email'         => 'required',
            'password'      => 'required'
        ]);
        // store in the database
        $admins = new Admin;
        $admins->name = $request->name;
        $admins->email = $request->email;
        $admins->password=bcrypt($request->password);
        $admins->save();
        return redirect()->route('admin.auth.login');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
