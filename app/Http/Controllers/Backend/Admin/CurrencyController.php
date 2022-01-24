<?php

namespace App\Http\Controllers\Backend\Admin;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Currency;
use App\User;
use App\Model\Wallet;
use mysql_xdevapi\Exception;
use PHPUnit\Util\Json;

class CurrencyController extends Controller
{
    private $currency,$user,$wallet;

    public function __construct(
        Currency $currency,
        User $user,
        Wallet $wallet
    )
    {
        $this->middleware('auth:admin');
        $this->currency = $currency;
        $this->user = $user;
        $this->wallet = $wallet;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.currency.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.currency.form',['action' => 'add']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->currency->create([
            'name' => $request->input('name'),
            'symbol' => $request->input('symbol'),
            'conversion' => ($request->input('conversion')) ? $request->input('conversion'):1,
            'isDevvio' => $request->input('isDevvio'),
            'devID' => ($request->input('devID') && $request->input('isDevvio') == 1) ? $request->input('devID') : null
        ]);
        if ($request->input('isDevvio')){
            $users = $this->user->select('id')->get();
            foreach ($users as $user){
                $wallet = $this->wallet->where(["currency" => 9,"uid" => $user->id])->select("address")->get();
                if(isset($wallet[0]->address)){
                    $this->wallet->create([
                        'uid' => $user->id,
                        'currency' => $result->id,
                        'address' => $wallet[0]->address,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }
                else{
                    $this->wallet->create([
                        'uid' => $user->id,
                        'currency' => $result->id,
                        'address' => null,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }
        }
        else{
            $users = $this->user->select('id')->get();
            foreach ($users as $user){
                $this->wallet->create([
                    'uid' => $user->id,
                    'currency' => $result->id,
                    'address' => null,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }
        if ($result){
            return redirect(route('admin.currencies.index'))->with([
                'status' => [
                    'class' => 'success',
                    'message' => 'Added new currency.'
                ],
            ]);
        }

        return redirect(route('admin.currencies.create'))->with([
            'status' => [
                'class' => 'danger',
                'message' => 'Failed. Try again.'
            ],
        ]);
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
        $results = $this->currency->find($id);
        return view('admin.currency.form')->with(['results' => $results,'action' => 'edit']);
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
        $result = $this->currency->where('id',$id)->update([
            'name' => $request->input('name'),
            'symbol' => $request->input('symbol'),
            'conversion' => ($request->input('conversion')) ? $request->input('conversion'):1,
            'isDevvio' => $request->input('isDevvio'),
            'devID' => ($request->input('devID') && $request->input('isDevvio') == 1) ? $request->input('devID') : null
        ]);
        if ($result){
            return redirect(route('admin.currencies.index'))->with(
                [
                    'status' => [
                        'class' => 'success',
                        'message' => 'Updated.'
                    ]
                ]);
        }
        return redirect()
            ->back()
            ->withErrors($result)
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $this->currency->destroy($id);
            $this->wallet->where('currency',$id)->delete();
            return redirect(route('admin.currencies.index'))->with(
                [
                    'status' => [
                        'class' => 'success',
                        'message' => 'Deleted.'
                    ]
                ]);
        } catch (\Exception $e){
            return redirect()->back()->with(
                [
                    'status' => [
                        'class' => 'danger',
                        'message' => 'Try again.'
                    ]
                ]);
        }
    }
}
