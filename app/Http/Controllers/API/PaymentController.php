<?php

namespace App\Http\Controllers\API;

use App\Events\SendTransactionComplete;
use App\Jobs\SendNotiAfterTXSuccess;
use App\Model\Company;
use App\Model\Currency;
use App\Model\DevvioHistory;
use App\Model\History;
use App\Model\Notification;
use App\Model\Wallet;
use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\DB;
use Validator;
use Log;

class PaymentController extends Controller
{
    private $wallet,$currency,$company,$history,$notification,$devvioHistory,$user;

    public function __construct(
        Currency $currency,
        Company $company,
        History $history,
        Wallet $wallet,
        Notification $notification,
        DevvioHistory $devvioHistory
    )
    {
        $this->currency = $currency;
        $this->company = $company;
        $this->history = $history;
        $this->wallet = $wallet;
        $this->notification = $notification;
        $this->devvioHistory = $devvioHistory;
    }

    public function shopPayment(Request $request,$currency = false){
        if ($currency)
            $currency_id = $this->currency->getId($currency);
        else
            $currency_id = $this->currency->getId($request->input('currency'));
        $isDevvio = $request->input('devvio');
        $amount = $request->input('amount');
        $company_id = $request->input('company');
        $name = $this->company->getName($company_id);
        $ref = $request->input('reference');

        $this->user = User::where('email', $request->input('email'))->first();

        if ($isDevvio == 1){ // for Devvio send transaction.
            //update balance first.
            $this->wallet->getBalanceDevvioAvailable();

            try{
                //get balance from database.
                $balance = $this->wallet->getBalanceFromDB(false,$currency_id);
            }
            catch (Exception $e){
                Log::info('payment_system_error : ' . $request->user()->name );
                return response()->json([
                    'error_code'=>'payment_system_error',
                    'message'=>'Payment system cannot process transaction right now'
                ], 401);
            }
            if ($balance >= (int)$amount){
                $devvio_res = $this->createTransactionDevvio($currency_id,convert_to_devvio($amount),$name,$ref,$company_id);
                if ($devvio_res){
                    $this->history->createHistory($company_id,$amount,$ref,true,$currency_id);
                    $this->notification->send('You have paid '.$amount.' '.strtoupper($request->input('currency')).
                        '  to '.$name.'.',$this->user->id,false,'/histories');

                    return response()->json(['message'=>'Payment Success'], 201);
                }else{
                    $this->history->createHistory($company_id,$amount,$ref,false,$currency_id);
                    Log::info('payment_system_error : ' . $request->user()->name );
                    return response()->json(['message'=>'Payment system cannot process transaction right now'], 401);
                }
            }

            Log::info('not_enough_balance : ' . $request->user()->name );
            return response()->json([
                'error_code'=>'not_enough_balance',
                'message'=>'Failed. Your balance not enough.'
            ], 401);
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
                        $this->notification->send('You have paid '.$amount.' '.strtoupper($request->input('currency')).'  to '.$name.'.',\Auth::user()->id,false,'/histories');

                        return response()->json(['message'=>'Payment Success'], 201);
                    }
                }
            }
        }
        Log::info('not_enough_balance : ' . $request->user()->name );
        return response()->json([
            'error_code'=>'not_enough_balance',
            'message'=>'Failed. Your balance not enough.'
        ], 401);
    }

    public function userPayment(Request $request, $currency = false)
    {
        $messages = [
            'amount.required' => 'Please enter amount',
            'amount.min' => 'Please enter the right amount',
            'address.required' => 'Please scan the address first',
            'qr-id.required' => 'Please scan the address first'
        ];
        $validator = Validator::make($request->all(),[
            "amount" => 'required|min:0.000000001',
            "address" => "required",
            "qr-id" => "required"
        ], $messages);

        if ($validator->fails()) {
            Log::info('validation fail', $validator->errors()->toArray());
            return response()->json($validator->errors()->toArray(),422);
        }

        if ($currency)
            $currency_id = $this->currency->getId($currency);
        else
            $currency_id = $this->currency->getId($request->input('currency'));

        $currencyModel = Currency::find($currency_id);

        $isDevvio = 0; // devvio always 0
        $amount = $request->input('amount');
        $address = $request->input('address');
        // ==== we might not use this
        $name = $request->input('qr-name');
        $receiver = $request->input('qr-id');

        $userReceive = User::join('wallets', 'users.id', '=', 'wallets.uid')
            ->where('wallets.address', '=', $address)
            ->where('wallets.currency', '=', $currency_id)
            ->where('wallets.uid', $receiver)
            ->select('users.name', 'users.id', 'users.email')
            ->first();
        // if not found user in our system
        if (!$userReceive){
            Log::info('not_found_address : ' . $request->user()->name, [$address, $currency_id, $receiver] );
            return response()->json([
                'status'=>'fail',
                'error_code'=>'not_found_address',
                'message'=>'Failed. Not found address in system.'
            ], 422);
        }

        // sender and receiver cannot be the same person
        if ($userReceive->id == \auth()->user()->id) {
            Log::info('same_sender_receiver : ' . $request->user()->name );

            return response()->json([
                'status'=>'fail',
                'error_code'=>'same_sender_receiver',
                'message'=>'Failed. Sender and Receiver cannot be the same.'
            ], 422);
        }
        $receiver = $userReceive->id;

        $ref = $address;
        $note = $request->input('reference');

        Log::info('request inputs: ', $request->input());

        DB::beginTransaction();
        try {
            $balance = $this->wallet->getBalanceAvailable($request->input('currency'));
            if ($balance >= $amount){
                //update balance
                $balance = $balance - $amount;
                $this->wallet->updateBalance($balance,$currency_id);
                //create history
                $create_history = $this->history->createHistory(0,$amount,$ref,true,$currency_id,'payment', null, $receiver, $note);

                // add to receiver wallet
                $rWallet = Wallet::whereAddress($address)->where('uid', $receiver)->where('currency', $currency_id)->first();
                $rWallet->balance = $rWallet->balance + $amount;
                $rWallet->save();

                DB::commit();

                $title = $amount . ' ' .$currencyModel->name . ' received' ;
                $body = $request->user()->name . ' sent you ' . $amount . ' ' .$currencyModel->name ;
                // send noti to receiver
                SendNotiAfterTXSuccess::dispatch($userReceive->email, $title, $body);
                // send to user
                $title = $amount . ' ' .$currencyModel->name . ' sent' ;
                $body = 'You sent ' . $amount . ' ' .$currencyModel->name . ' to '.$request->input('qr-name');
                SendNotiAfterTXSuccess::dispatch($request->user()->email, $title, $body);

                event(new SendTransactionComplete($request->user()->id, $receiver));

                if ($create_history){
                    return response()->json([
                        'status'=>'success',
                        'error_code'=>null
                    ], 200);
                }
            }else {
                DB::commit();
            }


        }catch (Exception $e){

            Log::info($e->getMessage() ."\n".$e->getTraceAsString());
            DB::rollBack();
            return response()->json([
                'status'=>'fail',
                'error_code'=>'error',
                'message'=>'Unexpected error'
            ], 422);
        }

        Log::info('not_enough_balance : ' . $request->user()->name . ' balance: ' . $balance . ' ,amount: ' . $amount);
        //balance not enough
        return response()->json([
            'status'=>'fail',
            'error_code'=>'not_enough_balance',
            'message'=>'Your Balance is not enough.'
        ], 422);
    }

    public function createTransactionDevvio($currency_id,$amount,$company,$ref,$company_id){
        $user = $this->user;
        $coinID = $this->currency->where('id',$currency_id)->select('devID')->get();
        $to = $this->company->where('id',$company_id)->select('address')->get();

        $amount = convert_balance($amount);
        $create_history = $this->devvioHistory->create([
            'uid' => $this->user->id,
            'amount' => $amount,
            'reference' => $company.$ref,
            'status' => 'success',
            'from' => '02D983C21D39840D20A3D9F9E0F707EE2020B36A8E9F46DC8A35EAD68925A3C9C4',
            'to' => $to,
            'coin_id' => $coinID[0]->devID
        ]);

        return false;
    }


}
