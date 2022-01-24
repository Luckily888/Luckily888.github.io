<?php

namespace App;

use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;

/**
 * App\ExchangeTransaction
 *
 * @property int $id
 * @property int $from_currency_id
 * @property float $from_currency_amount
 * @property float $from_currency_before
 * @property float $from_currency_after
 * @property float $from_currency_conversion
 * @property int $to_currency_id
 * @property float $to_currency_amount
 * @property float $to_currency_before
 * @property float $to_currency_after
 * @property float $to_currency_conversion
 * @property int $uid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeTransaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeTransaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeTransaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeTransaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeTransaction whereFromCurrencyAfter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeTransaction whereFromCurrencyAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeTransaction whereFromCurrencyBefore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeTransaction whereFromCurrencyConversion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeTransaction whereFromCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeTransaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeTransaction whereToCurrencyAfter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeTransaction whereToCurrencyAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeTransaction whereToCurrencyBefore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeTransaction whereToCurrencyConversion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeTransaction whereToCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeTransaction whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExchangeTransaction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ExchangeTransaction extends Model
{
    public static function getAll($limit = 0, $symbol = null, $skip = 0, $countAll = false)
    {
        $uid = Auth::user()->id;

        $tb= 'exchange_transactions';
        $query = ExchangeTransaction::query()
            ->join('currencies as from_currencies', "$tb.from_currency_id", '=', 'from_currencies.id')
            ->join('currencies as to_currencies', "$tb.to_currency_id", '=', 'to_currencies.id')
            ->where('uid', $uid)
            ->select(
                DB::raw("
                $tb.id, 
                'exchange' as reference,
                CAST(0 AS UNSIGNED) as company_id,
                from_currency_amount, 
                to_currency_amount as amount,
                to_currency_id as currency_id,
                to_currencies.name as currency_name, 
                to_currencies.symbol as symbol, 
                'RECEIVE' as payment_type,
                CONCAT('EXCHANGE ', from_currencies.name, ' -', TRIM(TRAILING '.' FROM TRIM(TRAILING '0' FROM CONVERT(from_currency_amount, CHAR)))) as sender_name,
                'payment' as method,
                NULL as note,
                NULL as receiver_name,
                CAST(0 AS UNSIGNED) as receiver,
                CAST(0 AS UNSIGNED) as credit_type_id,
                $tb.uid,
                $tb.created_at,
                UNIX_TIMESTAMP($tb.created_at)*1000 as created_at_timestamp,
                CONCAT('assets/images/coins/' ,to_currencies.symbol, '.png') as coin_image
                "));
        // id , company_id,reference, amount, currency_id, status, created_at, updated_at,uid, method, tnx_id, convert_currency_id,
        // convert_amount, note, sender_name, companies.name, symbol, currency_name, payment_type, receiver_name, receiver, credit_type_id,
        // created_at_timestamp, coin_image

        if ($countAll){
            return $query->count();
        }
        $query->orderBy("$tb.created_at", 'desc');

        if ((int)$limit > 0) {
            if ((int)$limit > 20){
                $countQuery = with(clone $query)
                    ->where("$tb.created_at", '>=', Carbon::now()->subDays(5))
                    ->count();
                if ($countQuery > 5) {
                    $query->where("$tb.created_at", '>=', Carbon::now()->subDays(5));
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

}
