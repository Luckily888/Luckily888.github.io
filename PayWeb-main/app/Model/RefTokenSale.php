<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\RefTokenSale
 *
 * @property int $id
 * @property string $name
 * @property string|null $image_path
 * @property string|null $symbol
 * @property string $status
 * @property string $use_raised
 * @property string $start_date
 * @property string $sale_price
 * @property string $currency_price
 * @property string|null $return_rate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RefTokenSale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RefTokenSale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RefTokenSale query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RefTokenSale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RefTokenSale whereCurrencyPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RefTokenSale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RefTokenSale whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RefTokenSale whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RefTokenSale whereReturnRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RefTokenSale whereSalePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RefTokenSale whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RefTokenSale whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RefTokenSale whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RefTokenSale whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\RefTokenSale whereUseRaised($value)
 * @mixin \Eloquent
 */
class RefTokenSale extends Model
{
    //
}
