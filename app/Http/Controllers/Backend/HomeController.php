<?php

namespace App\Http\Controllers\Backend;

use App\ExchangeTransaction;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Wallet;
use App\Model\Currency;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $wallet,$currency;

    public function __construct(
        Wallet $wallet,
        Currency $currency
    )
    {
        $this->middleware(['auth', 'verified', 'checkkyc']);
        $this->wallet = $wallet;
        $this->currency = $currency;
    }

    public function index(){
        // TODO test period wallet

//        $testCurrrency = [1,4,19,13];
        return view('backend.home',[
            'wallets' => $this->wallet
                ->leftjoin('currencies','wallets.currency','=','currencies.id')
                ->where('wallets.uid', \Auth::user()->id)
                ->whereRaw('wallets.balance > 0')
//                ->whereIn('currency', $testCurrrency)
                ->select('wallets.*','currencies.isDevvio','currencies.devID','currencies.symbol','currencies.name as currency_name')
                ->orderBy('currency_name','asc')
                ->get()
            ,
            'currencies' => $this->currency->all()
        ]);
    }

    public function testGenerate()
    {
        try{
            $token = \Hash::make('inphibitPay2019', [
                'rounds' => 10
            ]);
            $ref = 'test20191104';
            $token = str_replace("$2y$", "$2b$", $token);
            $cName = 'inphibit-pay';
            $crypto = 'eth';
            $client = new \GuzzleHttp\Client(['http_errors' => true]);
            $requestUrl = "http://websocket.inphibit.com/create-new-address/{$cName}/{$crypto}/{$ref}?token={$token}";
            $response = $client->request('GET', $requestUrl);
        }catch (RequestException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            \Log::error($responseBodyAsString);
        }

        return $response->getBody()->getContents();
    }

    public function generateWalletAddress(Request $request){
        $newWalletAddress = null;
        $cName = 'inphibit-pay';
        $crypto = $request->get('crypto');
        $currency = $this->currency->where('symbol',$crypto)->get();
        $ref = $request->get('ref');
        $token = \Hash::make('inphibitPay2019', [
            'rounds' => 10
        ]);
        $token = str_replace("$2y$", "$2b$", $token);
        $uid = \Auth::user()->id;

        try {
            $client = new \GuzzleHttp\Client();
            if ($currency[0]->isERC20 == 1){
                $eth = $this->wallet->where('uid',$uid)->where('currency',4)->get();
                // if not exist create new one
                if(empty($eth[0]->address)){
                    $requestUrl = "http://websocket.inphibit.com/create-new-address/{$cName}/eth/{$ref}?token={$token}";
                    $response = $client->request('GET', $requestUrl);
                    $newEthAddr = $response->getBody()->getContents();
                    if ($newEthAddr == 'not found' || $response->getStatusCode() >= 400){
                        return redirect(action('Backend\HomeController@index'))->with(['status' => [
                            'class' => 'danger',
                            'message' => 'Cannot create new address, please contact an admin.']
                        ]);
                    }
                    else{
                        $this->wallet->where('uid',$uid)->where('currency',4)->update(['address' => $newEthAddr]);
                        $eth = $this->wallet->where('uid',$uid)->where('currency',4)->get();
                    }
                }
                $this->wallet->where('uid',$uid)->where('currency',$currency[0]->id)
                    ->update(['address' => $eth[0]->address]);
                // update all erc20
                $erc20Ids = Currency::where('isERC20',1)->pluck('id');
                $this->wallet->where('uid',$uid)->whereIn('currency',$erc20Ids)
                    ->update(['address' => $eth[0]->address]);

                return redirect(action('Backend\HomeController@index'))->with(['status' => [
                    'class' => 'success',
                    'message' => 'Successfully created a wallet address.']
                ]);
            }

            if (sizeof($this->wallet->getWallet($currency)) > 0){
                abort(404);
            }
            else{
                $requestUrl = "http://websocket.inphibit.com/create-new-address/{$cName}/{$crypto}/{$ref}?token={$token}";
                $response = $client->request('GET', $requestUrl);
                $newWalletAddress = $response->getBody()->getContents();
                if ($newWalletAddress == 'not found' || $response->getStatusCode() >= 400){
                    return redirect(action('Backend\HomeController@index'))->with(['status' => [
                        'class' => 'danger',
                        'message' => 'Try again next time.']
                    ]);
                }
                else{
                    $this->wallet->where('uid',$uid)->where('currency',$currency[0]->id)->update(['address' => $newWalletAddress]);
                    // if currency is eth then update all isERC20
                    if (strtolower($crypto) == 'eth'){
                        // update all erc20
                        $erc20Ids = Currency::where('isERC20',1)->pluck('id');
                        $this->wallet->where('uid',$request->user()->id)->whereIn('currency',$erc20Ids)
                            ->update(['address' => $newWalletAddress]);
                    }
                    return redirect(action('Backend\HomeController@index'))->with(['status' => [
                        'class' => 'success',
                        'message' => 'Already created a wallet address.']
                    ]);
                }
            }
        }catch (RequestException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            \Log::error($responseBodyAsString);
        }
    }

    public function balance(Request $request){
        $keyword = $request->keyword;
        $hidezerobalance = $request->hidezerobalance;
        $sort_by = $request->sort_by;

        if($keyword!="" || $hidezerobalance == 0 || $sort_by!="")
            $wallets = Wallet::getAllUserBalance(\auth()->user()->id, $keyword, $hidezerobalance, $sort_by);
        else
            $wallets = Wallet::getAllUserBalance(\auth()->user()->id);

        return $wallets;

    }

    public function getwallets(Request $request){
        $keyword = $request->keyword;
        $hidezerobalance = $request->hidezerobalance;
        $sort_by = $request->sort_by;

        $wallets = $this->wallet
                ->select('wallets.*','currencies.isDevvio','currencies.devID','currencies.symbol','currencies.name as currency_name')
                ->leftjoin('currencies','wallets.currency','=','currencies.id')
                ->where('wallets.uid', \Auth::user()->id);                
                
        if($hidezerobalance==1)
        {
            $wallets->whereRaw('wallets.balance > 0');
        }

        if($keyword!="")
        {
            $wallets->whereRaw("currencies.name LIKE '%".$keyword."%'");
        }
        if($sort_by!="")
        {
            if($sort_by == 1)
            {
                $wallets->orderBy('currency_name','asc');
            }
            elseif($sort_by == 2)
            {
                $wallets->orderBy('currency_name','desc');
            }
            elseif($sort_by == 3)
            {
                $wallets->orderBy('wallets.balance','desc');
            }
            elseif($sort_by == 4)
            {
                $wallets->orderBy('wallets.balance','asc');
            }
            else
            {
                $wallets->orderBy('currency_name','asc');
            }
        
        }
        else {
            $wallets->orderBy('currency_name','asc');
        }
        $wallets = $wallets->get();

        return view('backend.homewallets',['wallets' => $wallets]);
    }
}
