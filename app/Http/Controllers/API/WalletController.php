<?php

namespace App\Http\Controllers\API;

use App\Model\Currency;
use App\Model\Wallet;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WalletController extends Controller
{
    private $wallet;

    public function __construct(
        Wallet $wallet
    )
    {
        $this->wallet = $wallet;
    }
    public function index()
    {

    }

    public function show($id)
    {
        $walletModel = $this->wallet->find($id);

        return response()->json([
            'address'=>$walletModel->address,
            'currency' => $walletModel->currency,
            'balance' => $walletModel->balance
        ],200);
    }

    public function generateAddress(Request $request)
    {
        $symbol = $request->input('symbol');

        if (\Cache::has('currencies')){
            $currencies = \Cache::get('currencies');
        }else{
            $currencies = Currency::pluck('name', 'symbol');
        }

        if (empty($symbol) || !isset($currencies[$symbol]) || !in_array($symbol, ['btc', 'eth'])){
            return response()->json(['error_code' => 'not_found_symbol', 'status' => 'fail'],500);
        }

        $wallet = null;
        $currency = null;
        if ($symbol == 'eth'){
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
                $newAddress = $response->getBody()->getContents();

                $currency = Currency::where('symbol', $symbol)->first();

                $wallet = Wallet::query()
                    ->where('uid',$request->user()->id)
                    ->where('currency',$currency->id)
                    ->first();
                $wallet->address = $newAddress;
                $wallet->save();

                // update all erc20
                $erc20Ids = Currency::where('isERC20',1)->pluck('id');
                $this->wallet->where('uid',$request->user()->id)->whereIn('currency',$erc20Ids)
                    ->update(['address' => $newAddress]);
            }catch (RequestException $e) {
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                \Log::error($responseBodyAsString);
            }
        }

        $returnWallet = [];
        if ($wallet){
            $returnWallet = [
                'user_id'=>$wallet->uid,
                'currency_id'=>$wallet->currency,
                'wallet_id'=>$wallet->id,
                'balance'=>$wallet->balance,
                'currency_name'=>$currency->name,
                'currency_symbol'=>$currency->symbol,
                'address'=>$wallet->address
            ];
        }

        return response()->json([
            'success'=>true,
            'data'=> $returnWallet
        ], 200);
    }
}
