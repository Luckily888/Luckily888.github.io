<?php

namespace App\Model;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Hash;

/**
 * App\Model\Transaction
 *
 * @property int $id
 * @property string $txid
 * @property float $amount
 * @property int $blockNumber
 * @property string $from
 * @property string $to
 * @property string $use
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $uid
 * @property string $currency
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Transaction whereBlockNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Transaction whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Transaction whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Transaction whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Transaction whereTxid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Transaction whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Transaction whereUse($value)
 * @mixin \Eloquent
 */
class Transaction extends Model
{
    protected $fillable = ['txid','amount','blockNumber','from','to','use','uid'];
    static $fromNode = 'node';

    public static function getFromNode($currency_symbol,$address){
        try{
            $requestUrl = "http://websocket.inphibit.com/get-transactions";
            $client = new \GuzzleHttp\Client(['http_errors' => true]);
            $token = Hash::make('inphibitPay2019', [
                'rounds' => 10
            ]);
//            $token = str_replace("$2y$", "$2b$", $token);
            $data = $client->request('POST', $requestUrl,[
                'json' => [
                    'token' => $token,
                    'crypto' => $currency_symbol,
                    'address' => $address
                ]
            ])->getBody()->getContents();
        }catch (Exception $e){
            return false;
        }

        return \GuzzleHttp\json_decode($data);
    }

    public static function getFromDB($currency_symbol,$address){
        return Transaction::where(['currency' => strtolower($currency_symbol),'to' => $address])->get();
    }

    public static function updateTransaction($currency_symbol,$address){
        $transactions_node = self::getFromNode($currency_symbol,$address);
        if (!$transactions_node)
            return Transaction::where('to',$address)->where('currency',$currency_symbol)->get();
        // fix why delete all when we have txid
//        $delete = Transaction::where('to',$address)->where('currency',$currency_symbol)->delete();
        foreach ($transactions_node as $transaction){
            $tran = Transaction::where('txid', $transaction->txid)->first();
            if ($tran){
                if ($tran->from != Transaction::$fromNode){
                    $tran->from = Transaction::$fromNode;
                    $tran->save();
                }
                continue;
            }
            $tran = New Transaction();
            $tran->txid = $transaction->txid;
            $tran->amount = $transaction->amount;
            $tran->blockNumber = $transaction->blockNumber;
            $tran->from = (isset($transaction->from)) ? $transaction->from:Transaction::$fromNode;
            $tran->to = $transaction->to;
            $tran->use = (isset($transaction->use)) ? $transaction->use:false;
            $tran->uid = Auth::user()->id;
            $tran->currency = $currency_symbol;
            if(isset($transaction->created_at))
                $tran->created_at = $transaction->created_at;
            $tran->save();
        }
        return Transaction::where('to',$address)->where('currency',$currency_symbol)->get();

    }

    public static function getAll(){
        return Transaction::where('uid',Auth::user()->id)->get();
    }

    public static function getFromCurrency($currency_id){
        $wallet = Wallet::where('currency',$currency_id)->select('address')->get();
        $transactions = Transaction::where('to',$wallet[0]->address)->get();
        return $transactions[0];
    }

    public static function getMainCryptoFromWallet(){
        $curIdArr = Currency::whereIn('symbol', ['btc', 'eth'])
            ->pluck('id');
        $addresses = Wallet::where('uid',Auth::user()->id)
            ->whereIn('currency', $curIdArr)->pluck('address');
        if ($addresses->count() > 0) {
            return Transaction::whereIn('to',$addresses)
                ->where('from', Transaction::$fromNode)
                ->orderBy('created_at','desc')->get();
        }

        return [];
    }

    public static function adminSend($to,$amount,$coin_id){
        $currency =Currency::where('id',$coin_id)->select('id','symbol','devID')->get();

        $amount = convert_balance($amount);
        $create_history = DevvioHistory::create([
            'uid' => 0,
            'amount' => $amount,
            'reference' => "Exchange",
            'status' => 'success',
            'from' => '02D983C21D39840D20A3D9F9E0F707EE2020B36A8E9F46DC8A35EAD68925A3C9C4',
            'to' => $to,
            'coin_id' => $currency[0]->devID
        ]);

        //create transaction to DB
        $tran = New Transaction();
        $tran->txid = 'InphibitPay X Devvio (Exchange)';
        $tran->amount = $amount;
        $tran->blockNumber = Carbon::now()->timestamp;
        $tran->from = '02D983C21D39840D20A3D9F9E0F707EE2020B36A8E9F46DC8A35EAD68925A3C9C4';
        $tran->to = $to;
        $tran->use = false;
        $tran->uid = \Auth::user()->id;
        $tran->currency = $currency[0]->symbol;
        $tran->save();

        //create user history
        $create_hist = History::createHistory(0,$amount,'IPB Pay exchange',true,$currency[0]->id,'exchange',$tran->id,\Auth::user()->id);
        if ($create_hist){
           Notification::send('You have received '.$amount.' '.$currency[0]->symbol.' from (System) IPB Pay Exchange. Click for check.',\Auth::user()->id,'(System) IPB Pay Exchange.',route('transaction.search', $currency[0]->symbol));
            return true;
        }
        return false;
    }

    public static function createTransactionDevvio($currency1,$currency2,$amount1,$amount2){
        $user = \Auth::user();
        $coinID = Currency::where('id',$currency1)->select('devID','symbol')->get();
        $coinID2 = Currency::where('id',$currency2)->select('devID','symbol')->get();
        $address = Wallet::getAddress($currency1);
        $amount1 = convert_balance($amount1);
        //create transaction to DB
        $tran = New Transaction();
        $tran->txid = '(System)Exchange  '.$coinID[0]->symbol.' to '.$coinID2[0]->symbol;
        $tran->amount = $amount1;
        $tran->blockNumber = Carbon::now()->timestamp;
        $tran->from = $address;
        $tran->to = "02D983C21D39840D20A3D9F9E0F707EE2020B36A8E9F46DC8A35EAD68925A3C9C4";
        $tran->use = false;
        $tran->uid = 0;
        $tran->currency = $coinID[0]->symbol;
        $tran->save();

        $currency1Model = Wallet::whereCurrency($currency1)->where('uid', $user->id)->first();
        $currency1Model->balance -= $amount1;
        $currency1Model->save();
        $currency2Model = Wallet::whereCurrency($currency2)->where('uid', $user->id)->first();
        $currency2Model->balance += convert_balance($amount2);
        $currency2Model->save();


        //create user history
        $create_hist = History::createHistory(0,$amount1,'IPB Pay exchange',true,$currency1,'exchange',$tran->id,0);
        if ($create_hist){
            if(Transaction::adminSend($address,$amount2,$currency2))
                return true;
            return false;
        }
        return false;

    }

}
