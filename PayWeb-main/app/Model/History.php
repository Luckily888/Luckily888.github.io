<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

/**
 * App\Model\History
 *
 * @property int $id
 * @property int $company_id
 * @property string $reference
 * @property float $amount
 * @property string $currency_id
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $uid
 * @property string $method
 * @property int|null $tnx_id
 * @property int|null $receiver
 * @property int|null $convert_currency_id
 * @property float|null $convert_amount
 * @property string|null $note
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\History newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\History newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\History query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\History whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\History whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\History whereConvertAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\History whereConvertCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\History whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\History whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\History whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\History whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\History whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\History whereReceiver($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\History whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\History whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\History whereTnxId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\History whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\History whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class History extends Model
{
    protected $fillable = ['company_id', 'reference', 'amount', 'currency_id', 'status', 'uid', 'method', 'tnx_id', 'receiver', 'note'];

    static $typePayment = 'payment';
    static $typeCreditPayment = 'credit-payment';

    public static function getAll($limit = 0, $symbol = null, $skip = 0, $countAll = false)
    {
        $uid = Auth::user()->id;
        $typePayment = History::$typePayment;

        $query = History::where(function ($mainSub) use ($uid, $symbol){
            $mainSub->where(function ($sub) use ($uid, $symbol) {
                $sub->where('uid', $uid)
                    ->whereIn('method', [History::$typePayment, History::$typeCreditPayment]);
                if ($symbol) {
                    $sub->where('currencies.symbol', '=', $symbol);
                }
            })
                ->orWhere(function($sub2) use ($uid, $symbol) {
                    $sub2->where('receiver', $uid)
                        ->where('method', History::$typePayment);
                    if ($symbol) {
                        $sub2->where('currencies.symbol', '=', $symbol);
                    }
                });
            })
            ->leftjoin('companies', 'histories.company_id', '=', 'companies.id')
            ->leftJoin('users as senders','senders.id', '=', 'histories.uid')
            ->leftJoin('users as receivers', function($join) {
                $join->on('receivers.id', '=', 'histories.receiver')
                    ->where('method', History::$typePayment);
            })
            ->leftJoin('credits as c', function ($join){
                $join->on('c.id', '=', 'histories.receiver')
                    ->where('method', History::$typeCreditPayment);
            })
            ->join('currencies', 'histories.currency_id', '=', 'currencies.id')
            ->select('histories.id', 'histories.company_id', 'histories.reference','histories.amount',
                'histories.currency_id', 'histories.status', 'histories.created_at','histories.updated_at',
                'histories.uid', 'histories.method','histories.tnx_id', 'histories.convert_currency_id',
                'histories.convert_amount', 'histories.note'
                , 'senders.name as sender_name',
                'companies.name', 'currencies.symbol','currencies.name as currency_name',
                DB::raw("case when receiver={$uid} and method='{$typePayment}' then 'RECEIVE' else 'SEND' end as payment_type,
                IFNULL(receivers.name, CONCAT(c.name, ' +', CONVERT(ROUND(histories.amount,0), CHAR), ' credit(s)') ) as receiver_name, 
                IFNULL(histories.receiver, 0) as receiver,
                CAST(IFNULL(c.credit_type_id, 0) AS UNSIGNED) as credit_type_id,
                UNIX_TIMESTAMP(histories.created_at)*1000 as created_at_timestamp,
                CONCAT('assets/images/coins/' ,IFNULL(c.icon, currencies.symbol), '.png') as coin_image
                "));

        if ($countAll){
            return $query->count();
        }
        $query->orderBy('histories.created_at', 'desc');

        if ((int)$limit > 0) {
            if ((int)$limit > 20){
                $countQuery = with(clone $query)
                    ->where("histories.created_at", '>=', Carbon::now()->subDays(5))
                    ->count();
                if ($countQuery > 5) {
                    $query->where("histories.created_at", '>=', Carbon::now()->subDays(5));
                } else {
                    $limit = 5;
                }
            }
            $query->limit($limit);
        }
        if ($skip > 0) {
            $query->skip($skip);
        }

        return $query->get();
    }

    public static function getTransfer()
    {
        return History::where('uid', \Auth::user()->id)
            ->join('currencies', 'histories.currency_id', '=', 'currencies.id')
            ->join('users', 'histories.receiver', '=', 'users.id')
            ->where('method', 'transfer')
            ->select('histories.*', 'currencies.symbol', 'users.email')
            ->get();
    }

    public static function getDeposit()
    {
        return History::where('uid', \Auth::user()->id)
            ->join('currencies', 'histories.currency_id', '=', 'currencies.id')
            ->join('users', 'histories.receiver', '=', 'users.id')
            ->where('method', 'deposit')
            ->select('histories.*', 'currencies.symbol', 'users.email')
            ->get();
    }

    public static function SumPayment($id)
    {
        $sum = History::where('uid', \Auth::user()->id)
            ->where(['status' => 1, 'currency_id' => $id])
            ->sum('amount');
        return $sum;
    }

    public static function sumReceive($id)
    {
        $sum = History::where('receiver', \Auth::user()->id)->where(['status' => 1, 'currency_id' => $id])->sum('amount');
        return $sum;
    }

    public static function createHistory($company_id, $amount, $reference, $status, $currency_id,
                                         $method = 'payment', $tnx_id = null, $receiver = null, $note=null, $user=null)
    {
        $history = new History();
        $history->company_id = $company_id;
        $history->amount = $amount;
        $history->reference = $reference;
        $history->status = $status;
        $history->currency_id = $currency_id;
        $history->uid = !is_null($user)?$user:\Auth::user()->id;
        $history->method = $method;
        $history->tnx_id = $tnx_id;
        $history->receiver = $receiver;
        $history->note = $note;
        $history->save();
        return $history;
    }
}
