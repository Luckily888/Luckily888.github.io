<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Currency
 *
 * @property int $id
 * @property string $name
 * @property string $symbol
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float $conversion
 * @property int $isDevvio
 * @property int|null $devID
 * @property int $isERC20
 * @property string|null $symbol_api
 * @property int $is_virtual
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Currency whereConversion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Currency whereDevID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Currency whereIsDevvio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Currency whereIsERC20($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Currency whereIsVirtual($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Currency whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Currency whereSymbolApi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Currency whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $is_fiat
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Currency whereIsFiat($value)
 */
class Currency extends Model
{
    protected $fillable = ['name','symbol','isDevvio','devID','conversion'];
    static $ethId = 4;


    public static function getId($symbol = false,$coin_id = false){
        if (isset($symbol)){
            $currency = Currency::where('symbol',$symbol)->select('id')->get();
            return $currency[0]->id;
        }
        $currency = Currency::where('devID',$coin_id)->select('id')->get();
        return $currency[0]->id;
    }

    public static function getSymbol($id){
        $currency = Currency::where('id',$id)->select('symbol')->get();
        return $currency[0]->symbol;
    }

    /**
     * Change cur1 to usd and convert usd to cur2
     */
    public static function convertCurrency($currency1,$currency2,$amount1){
        $currency1_rate = Currency::where('id',$currency1)->select('conversion')->get();
        $currency2_rate = Currency::where('id',$currency2)->select('conversion')->get();
        $currency1_to_usd =  $amount1 * $currency1_rate[0]->conversion;
        return $currency1_to_usd / $currency2_rate[0]->conversion;

    }

    public static function convertCurrency2($currency1,$currency2,$amount1,&$con1, &$con2){
        $currency1_rate = Currency::where('id',$currency1)->select('conversion')->get();
        $currency2_rate = Currency::where('id',$currency2)->select('conversion')->get();

        $con1 = $currency1_rate[0]->conversion;
        $con2 = $currency2_rate[0]->conversion;

        $currency1_to_usd =  $amount1 * $currency1_rate[0]->conversion;
        return $currency1_to_usd / $currency2_rate[0]->conversion;

    }

}
