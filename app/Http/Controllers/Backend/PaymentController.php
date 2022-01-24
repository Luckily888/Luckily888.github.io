<?php

namespace App\Http\Controllers\Backend;

use App\Model\Company;
use App\Model\Currency;
use App\Model\DevvioHistory;
use App\Model\History;
use App\Model\Wallet;
use App\Model\Notification;
use App\User;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Validator;

class PaymentController extends Controller
{

    private $wallet,$currency,$company,$history,$notification,$devvioHistory;

    public function __construct(
        Currency $currency,
        Company $company,
        History $history,
        Wallet $wallet,
        Notification $notification,
        DevvioHistory $devvioHistory
    )
    {
        $this->middleware(['auth', 'verified', 'checkkyc']);
        $this->currency = $currency;
        $this->company = $company;
        $this->history = $history;
        $this->wallet = $wallet;
        $this->notification = $notification;
        $this->devvioHistory = $devvioHistory;

    }

    public function index(){
        $currency = Cookie::get('currency');
        $order = [
            'company' => Cookie::get('company'),
            'currency' => Cookie::get('currency'),
            'amount' => Cookie::get('amount'),
            'ref' => Cookie::get('ref')
        ];
        if (isset($currency)){
            $currency = $this->wallet->find(1)->currency($currency);
            $wallet = $this->wallet->getWallet($currency[0]->id);
        }
        else{
            $wallet = $this->wallet->where('uid',Auth::user()->id)->where('currency',1)->get();
        }
        return view('backend.payment',
            [
                "order" => $order,
                "wallet" => $wallet[0],
                "currencies" => $this->currency->all(),
                "companies" => $this->company->all()
            ]
        );
    }

    public function paymentSuccess($historyId)
    {
        $history  = History::find($historyId);
        $wallet  = Wallet::where('address', $history->reference)->first();
        $currency = Currency::find($history->currency_id);
        $receiveUser = null;
        if ($wallet) {
            $receiveUser = User::find($wallet->uid);
        }

        return view('backend.payment.success', compact('history', 'receiveUser', 'currency'));
    }

    public function search($currency){
        $currency_cookie = Cookie::get('currency');
        if (isset($currency_cookie)){
            $currency = $currency_cookie;
        }
        $order = [
            'company' => Cookie::get('company'),
            'currency' => Cookie::get('currency'),
            'amount' => Cookie::get('amount'),
            'ref' => Cookie::get('ref')
        ];
        if (isset($currency)){
            $currency_id = $this->wallet->currency($currency);
            $wallet = $this->wallet->getWallet($currency_id[0]->id);
        }
        else{
            $wallet = $this->wallet->where('uid',Auth::user()->id)->where('currency',1)->get();
        }
        return view('backend.payment',
            [
                "order" => $order,
                "wallet" => $wallet[0],
                "companies" => $this->company->all(),
                "symbol" => $currency
            ]
        );
    }

    public function confirmShop($url,$token,$ref){
        $client = new Client(['http_errors' => false]);
        $data = $client->request('GET',$url."?token=${token}&ref=${ref}")->getBody()->getContents();
        $res = \GuzzleHttp\json_decode($data);
        if ((string)$res->status == 200){
            return ['link' => (string)$res->link];
        } else {
            return ['errors' => (string)$res->message];
        }
    }

    public function createTransactionDevvio($currency_id,$amount,$company,$ref,$company_id){
        $user = \Auth::user();
        $coinID = $this->currency->where('id',$currency_id)->select('devID')->get();
        $to = $this->company->where('id',$company_id)->select('address')->get();

        $amount = convert_balance($amount);
        $create_history = $this->devvioHistory->create([
            'uid' => \Auth::user()->id,
            'amount' => $amount,
            'reference' => $company.$ref,
            'status' => 'success',
            'from' => '02D983C21D39840D20A3D9F9E0F707EE2020B36A8E9F46DC8A35EAD68925A3C9C4',
            'to' => $to,
            'coin_id' => $coinID[0]->devID
        ]);

        return true;
    }

    public function paymentWithAddress($request, $currency = false)
    {
        $messages = [
            'amount.required' => 'Please enter the right amount',
            'amount.min' => 'Please enter the right amount',
            'qr-address.required' => 'Please scan the address first'
        ];
        $validator = Validator::make($request->all(),[
            "amount" => 'required|min:0.000000001',
            "qr-address" => "required"
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if ($currency)
            $currency_id = $this->currency->getId($currency);
        else
            $currency_id = $this->currency->getId($request->input('currency'));
        $isDevvio = 0; // devvio always 0
        $amount = $request->input('amount');
        $redirect = Cookie::get('redirect');
        $address = $request->input('qr-address');
        $name = $request->input('qr-name');
        $receiver = $request->input('qr-id');
        if (is_null($receiver)) {
            $userReceive = User::join('wallets', 'users.id', '=', 'wallets.uid')
                ->where('wallets.address', '=', $address)
                ->select('users.name', 'users.id')
                ->first();
            // if not found user in our system
            if (!$userReceive){
                return redirect(action('Backend\PaymentController@index'))->with([
                    'status' => [
                        'class' => 'danger',
                        'company_id' => $address,
                        'message' => 'Failed. Not found address in system.']
                ]);
            }

            // sender and receiver cannot be the same person
            if ($userReceive->id == \auth()->user()->id) {
                return redirect(action('Backend\PaymentController@index'))->with([
                    'status' => [
                        'class' => 'danger',
                        'company_id' => $address,
                        'message' => 'Failed. Sender and Receiver cannot be the same.']
                ]);
            }

            $name = $userReceive->name;
            $receiver = $userReceive->id;
        }
        $ref = $address;
        $note = $request->input('reference');

        $balance = $this->wallet->getBalanceAvailable($request->input('currency'));
        if ($balance >= $amount){
            //update balance
            $balance = $balance - $amount;
            $update_balance = $this->wallet->updateBalance($balance,$currency_id);
            if ($update_balance){
                //create history
                $create_history = $this->history->createHistory(0,$amount,$ref,true,$currency_id,'payment', null, $receiver, $note);
                if ($create_history){
                    $this->destroyCookie();
                    $return = $this->redirectStatus($ref,$address,$request->input('currency'));
                    $this->notification->send('You have paid '.$amount.' '.strtoupper($request->input('currency')).'  to '.$name.'.',\Auth::user()->id,false,'/histories');
                    if (isset($return["link"])){
                        return redirect(action('Backend\PaymentController@index'))->with(
                            [
                                'status' => [
                                    'class' => 'success',
                                    'message' => 'Payment success and '.$name.' confirm your order.'
                                ],
                                'redirect' => [
                                    'shop' => $name,
                                    'link' => $return["link"]
                                ],
                                'company_id' => $address
                            ]);
                    } else {
                        return $this->paymentSuccess($create_history->id);
                    }
                }
            }
        }

        //balance not enough
        return redirect(action('Backend\PaymentController@index'))->with([
            'status' => [
            'class' => 'danger',
            'company_id' => $address,
            'message' => 'Failed. Your balance not enough.']
        ]);
    }

    public function payment(Request $request,$currency = false){

        // if payment to another account then use separate function
        if ($request->input('qr-address') && !empty($request->input('qr-address'))){
            return $this->paymentWithAddress($request, $currency);
        }

        $messages = [
            'amount.required' => 'Please enter the right amount',
            'amount.min' => 'Please enter the right amount',
            'company.required' => 'Please select company'
        ];
        $validator = Validator::make($request->all(),[
            "amount" => 'required|min:0.000000001',
            "company" => "required"
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if ($currency)
            $currency_id = $this->currency->getId($currency);
        else
            $currency_id = $this->currency->getId($request->input('currency'));
        $isDevvio = $request->input('devvio');
        $amount = $request->input('amount');
        $company_id = $request->input('company');
        $name = $this->company->getName($company_id);
        $ref = $request->input('reference');
        $redirect = Cookie::get('redirect');
        if ($isDevvio == 1){ // for Devvio send transaction.
            //update balance first.
            $update = $this->wallet->getBalanceDevvioAvailable();
            try{
                //get balance from database.
                $balance = $this->wallet->getBalanceFromDB(false,$currency_id);
            }
            catch (Exception $e){
                return redirect(action('Backend\PaymentController@index'))->with(['status' => [
                    'class' => 'warning',
                    'company_id' => $company_id,
                    'message' => "Devvio system can not update your balance. Try again later."]
                ]);
            }
            if ($balance >= (int)$amount){
                $devvio_res = $this->createTransactionDevvio($currency_id,convert_to_devvio($amount),$name,$ref,$company_id);
                if ($devvio_res){
                    $this->history->createHistory($company_id,$amount,$ref,true,$currency_id);
                    $this->notification->send('You have paid '.$amount.' '.strtoupper($request->input('currency')).'  to '.$name.'.',\Auth::user()->id,false,'/histories');
                    $return = $this->redirectStatus($ref,$company_id,$request->input('currency'));
                    if (isset($return["link"])){
                        return redirect(action('Backend\PaymentController@index'))->with(
                            [
                                'status' => [
                                    'class' => 'success',
                                    'message' => 'Payment success and '.$name.' confirm your order.'
                                ],
                                'redirect' => [
                                    'status' => $redirect,
                                    'shop' => $name,
                                    'link' => $return["link"]
                                ],
                                'company_id' => $company_id
                            ]);
                    } else {
                        return redirect(action('Backend\PaymentController@index'))->with(
                            [
                                'status' => [
                                    'class' => 'success',
                                    'message' => 'Payment success and '.$name.' confirm your order.'
                                ],
                                'redirect' => [
                                    'status' => $redirect,
                                    'shop' => $name
                                ],
                                'company_id' => $company_id
                            ]);
                    }
                }else{
                    $this->history->createHistory($company_id,$amount,$ref,false,$currency_id);
                    return redirect(action('Backend\PaymentController@index'))->with(['status' => [
                        'class' => 'warning',
                        'company_id' => $company_id,
                        'message' => 'Failed, something is wrong If your balance is reduced, please contact us.']
                    ]);
                }

            }
            return redirect(action('Backend\PaymentController@index'))->with(['status' => [
                'class' => 'danger',
                'company_id' => $company_id,
                'message' => 'Failed. Your balance not enough.']
            ]);

        }
        else{ // for IPB pay transaction.
            $balance = $this->wallet->getBalanceAvailable($request->input('currency'));
            if ($balance >= $amount){
                //update balance
                $balance = $balance - $amount;
                $update_balance = $this->wallet->updateBalance($balance,$currency_id);
                if ($update_balance){
                    //create history
                    $create_history = $this->history->createHistory($company_id,$amount,$ref,true,$currency_id);
                    if ($create_history){
                        $this->destroyCookie();
                        $return = $this->redirectStatus($ref,$company_id,$request->input('currency'));
                        $this->notification->send('You have paid '.$amount.' '.strtoupper($request->input('currency')).'  to '.$name.'.',\Auth::user()->id,false,'/histories');
                        if (isset($return["link"])){
                            return redirect(action('Backend\PaymentController@index'))->with(
                                [
                                    'status' => [
                                        'class' => 'success',
                                        'message' => 'Payment success and '.$name.' confirm your order.'
                                    ],
                                    'redirect' => [
                                        'shop' => $name,
                                        'link' => $return["link"]
                                    ],
                                    'company_id' => $company_id
                                ]);
                        } else {
                            return redirect(action('Backend\PaymentController@index'))->with(
                                [
                                    'status' => [
                                        'class' => 'success',
                                        'message' => 'Payment success and '.$name.' confirm your order.'
                                    ],
                                    'redirect' => [
                                        'status' => $redirect,
                                        'shop' => $name
                                    ],
                                    'company_id' => $company_id
                                ]);
                        }
                    }
                }
            }
        }

        //balance not enough
        return redirect(action('Backend\PaymentController@index'))->with(['status' => [
            'class' => 'danger',
            'company_id' => $company_id,
            'message' => 'Failed. Your balance not enough.']
        ]);
    }

    public function destroyCookie(){
        Cookie::queue(Cookie::forget('company'));
        Cookie::queue(Cookie::forget('ref'));
        Cookie::queue(Cookie::forget('amount'));
        Cookie::queue(Cookie::forget('currency'));
        Cookie::queue(Cookie::forget('redirect'));
        return 1;
    }

    public function redirectStatus($reference,$company,$currency){
        if ($company == 5){
//            $requestUrl = "http://localhost/shop/admin557benbjw?token_api=QMxvNYo7ynHWe9mmVnA4&ref=".$reference."&currency=".$currency;
            $requestUrl = "https://vanilla-shop.inphibit.com/admin087g7yyhz?token_api=QMxvNYo7ynHWe9mmVnA4&ref=".$reference."&currency=".$currency;
            $client = new Client();
            $res = $client->request('GET', $requestUrl)->getBody()->getContents();

            return $res;
        }
        if ($company == 6){
//            $requestUrl = "http://localhost:8080/admin570pb1jnk?token_api=QMxvNYo7ynHWe9mmVnA4&ref=".$reference."&currency=".$currency;
            $requestUrl = "http://cbdshop.inphibit.com/admin570pb1jnk?token_api=QMxvNYo7ynHWe9mmVnA4&ref=".$reference."&currency=".$currency;
            $client = new Client();
            $res = $client->request('GET', $requestUrl)->getBody()->getContents();
            return $res;
        }
        if ($company == 7){
            $token = $this->company->find(7);
            return $this->confirmShop('http://verboden.inphibit.com/module/ps_ipbpay/confirm',$token->token,$reference);

//            $requestUrl = "http://verboden.inphibit.com/admin139b5rqb4?token_api=QMxvNYo7ynHWe9mmVnA4&ref=".$reference."&currency=".$currency;
//            $client = new Client();
//            $res = $client->request('GET', $requestUrl)->getBody()->getContents();

//            return $res;
        }

    }
}
