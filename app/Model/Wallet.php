<?php

namespace App\Model;

use App\ExchangeTransaction;
use App\Model\Currency;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * App\Model\Wallet
 *
 * @property int $id
 * @property int $uid
 * @property int $currency
 * @property string|null $address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float $balance
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Wallet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Wallet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Wallet query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Wallet whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Wallet whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Wallet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Wallet whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Wallet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Wallet whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Wallet whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Wallet extends Model
{
    protected $fillable = ['uid','currency','address','balance'];

    public static function currency($symbol)
    {
        return Currency::where('symbol',$symbol)->get();
    }

    public static function getAllUserBalance($userId, $keyword="", $hidezerobalance=1, $sort_by="")
    {
        $wallets = Wallet::whereUid($userId)
        ->join('currencies', 'wallets.currency', '=', 'currencies.id')
        ->select('wallets.id as wallet_id', 'wallets.balance', 'currencies.name as currency_name'
            , 'currencies.symbol as currency_symbol', 'currencies.isERC20', 'wallets.uid as user_id',
            'wallets.address','wallets.currency',
            'currencies.id as currency_id');
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

        /*return Wallet::whereUid($userId)
            ->whereRaw('wallets.balance > 0')
            ->join('currencies', 'wallets.currency', '=', 'currencies.id')
            ->select('wallets.id as wallet_id', 'wallets.balance', 'currencies.name as currency_name'
                , 'currencies.symbol as currency_symbol', 'currencies.isERC20', 'wallets.uid as user_id',
                'wallets.address','wallets.currency',
                'currencies.id as currency_id')
            ->get();*/
        return $wallets;
    }

    public static function balance($id){
        $balance = Wallet::where('uid',\Auth::user()->id)
            ->where('currency',$id)
            ->select('balance')->first();
        if ($balance){
            return $balance->balance;
        }
        return 0;
    }

    public static function getBalanceFromDB($address = false,$currency_id = false){
        if ($address && $currency_id){
            $balance = Wallet::where('uid',\Auth::user()->id)
                ->where('address' , $address)
                ->where('currency', $currency_id)
                ->select('balance')->first();
        }
        else if($address){
            $balance = Wallet::where('uid',\Auth::user()->id)
                ->where('address' , $address)
                ->select('balance')->first();
        }
        else if($currency_id){
            $balance = Wallet::where('uid',\Auth::user()->id)
                ->where('currency', $currency_id)
                ->select('balance')->first();
        }
        if ($balance){
            return $balance->balance;
        }
        return 0;
    }

    public static function getBalanceFromNode($currency_symbol,$address){

        // ตอนนี้ไม่ใช้ devvio แล้วเพราะฉะนั้น getFromNode ไม่ได้แล้ว
        Transaction::updateTransaction($currency_symbol,$address);
        $transactions = Transaction::getFromDB($currency_symbol,$address);
        $balance = 0;
        if (sizeof($transactions) > 0){
            foreach ($transactions as $transaction){
                $balance += $transaction->amount;
            }
        }

        $currency_id = Currency::getId($currency_symbol);
        // Note this one is to subtract system payment
        $balance -= History::SumPayment($currency_id);
        // Note this one is to add system payment
        $balance += History::sumReceive($currency_id);

        return $balance;
    }

    public static function updateBalance($balance,$currency_id){

        $balance_update = Wallet::where('uid',\Auth::user()->id)
            ->where('currency',$currency_id)
            ->update(['balance' => $balance]);

        return $balance;
    }

    public static function convertBalance($balances){
        $balance_converted = [];
        foreach ($balances as $balance) {
            $arr = [
                "balance" => $balance->balance,
                "coin_id" => $balance->coin_id,
                "coin_name" => $balance->coin_name
            ];
            array_push($balance_converted,$arr);
        }
        $object = (object) ["balances" => \GuzzleHttp\json_decode(json_encode($balance_converted))];
        return $object;
    }

    public static function getBalanceAvailable($currency_symbol = false,$currency_id = false){
        if (!$currency_symbol)
            $currency_symbol = Currency::getSymbol($currency_id);
        if (!$currency_id)
            $currency_id = Currency::getId($currency_symbol);
        $currency = Currency::find($currency_id);
        $address = self::getAddress($currency_id);
        $balance_db = self::getBalanceFromDB($address,$currency_id);

        if (!$currency->is_virtual && !$currency->isDevvio){
            $balance_node = self::getBalanceFromNode($currency_symbol,$address, $currency->isDevvio, $balance_db);
            if ($balance_db != $balance_node){
                return self::updateBalance($balance_node,$currency_id);
            }
        }

        return $balance_db;
    }

    public static function getBalanceDevvioAvailable($keyword="", $hidezerobalance=1){
        $wallets = Wallet::join('currencies as c', 'wallets.currency', '=', 'c.id')
            ->where('uid', '=', auth()->user()->id)
            ->select('wallets.balance', 'c.id as coin_id', 'c.name as coin_name');
        
        if($hidezerobalance==1)
        {
            $wallets->whereRaw('wallets.balance > 0');
        }

        if($keyword!="")
        {
            $wallets->whereRaw("c.name LIKE '%".$keyword."%'");
        }

        $wallets->orderBy('coin_name','asc');
        $wallets = $wallets->get();

        return $wallets;
    }

    public static function getWallet($currency_id){
        $wallet = Wallet::where(['uid' => \Auth::user()->id , 'currency' => $currency_id])->get();
        return $wallet;
    }

    public static function getAddress($currency_id = false,$currency_symbol = false){
        if ($currency_symbol)
            $currency_id = Currency::getId($currency_symbol);
        $wallet = Wallet::where(['uid' => \Auth::user()->id , 'currency' => $currency_id])
            ->select('address')->first();
        if ($wallet){
            return $wallet->address;
        }

        return null;
    }

    public static function checkUserWallets($userId)
    {
        $currencies = Currency::get();

        $eth = Currency::where('symbol', 'eth')->first();
        $ethWallet = Wallet::where('uid', $userId)
            ->where('currency', $eth->id)
            ->first();

        foreach ($currencies as $currency){
            $wallet = Wallet::where('uid', $userId)
                ->where('currency', $currency->id)
                ->first();

            if (!$wallet){
                $wallet = new Wallet();
                $wallet->currency = $currency->id;
                $wallet->uid = $userId;
                $wallet->balance = 0;
                if ($currency->isERC20){
                    $wallet->address = $ethWallet->address;
                }else{
                    $wallet->address = null;
                }
                $wallet->save();
            }

            if ($currency->isERC20 && (is_null($wallet->address) || empty(str_replace('-', '', $wallet->address))) ){
                $wallet->address = $ethWallet->address;
                $wallet->save();
            } else if ( ($currency->isDevvio || $currency->is_virtual) && empty($wallet->address)){
                $wallet->address = Wallet::generateHyperledgerAddress($userId);
                $wallet->save();
            }
        }
    }

    public static function clearDupWallets()
    {
        $rows = DB::select("select group_concat(id) as ids, uid, currency 
from wallets group by uid, currency having count(*) > 1");
        foreach ($rows as $row){
            $explodedIds = explode(",", $row->ids);
            for ($i = count($explodedIds) - 1; $i > 0; $i--) {
                if (\App::runningInConsole())
                {
                    echo "Deleteing " . $explodedIds[$i] . " from " . $row->ids;
                }
                $wallet = Wallet::find($explodedIds[$i]);
                $wallet->delete();
            }
        }
    }

    /*
     *  This is our hyperledger wallet scheme 70 characters
       prefix = “ipbpay” -> 6
        object-type = “wallet-address” -> 4
        unique-object-identifier = ”email” -> 60
     */
    public static function generateHyperledgerAddress($userId)
    {
        $user = User::find($userId);

        $prefix = 'ipbpay';
        $prefixHash = substr(hash('sha256', $prefix), 0, 6);
        $objectType = 'wallet-address';
        $objectTypeHash = substr(hash('sha256', $objectType), 0, 4);
        $email = $user->email;
        $emailHash = substr(hash('sha256', $email), 0, 60);

        return $prefixHash.$objectTypeHash.$emailHash;
    }

    public static function fillNotFoundWallet($currency_id)
    {
        $user = \App\User::get();foreach ($user as $u){$wallet = Wallet::where('uid', $u->id)->where('currency', $currency_id)->first();if (!$wallet){Wallet::create(['uid'=>$u->id, 'currency'=>33, 'balance'=>0]);}}
        return 'success';
    }
}
