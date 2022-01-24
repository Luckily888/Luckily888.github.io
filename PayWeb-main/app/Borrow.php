<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Borrow
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property int $loan_currency_id
 * @property float $loan_amount
 * @property int $collateral_currency_id
 * @property float $collateral_amount
 * @property int $borrow_period_id
 * @property float $percentage
 * @property string|null $period_text
 * @property float $interest_amount
 * @property float $end_period_amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow whereBorrowPeriodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow whereCollateralAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow whereCollateralCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow whereEndPeriodAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow whereInterestAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow whereLoanAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow whereLoanCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow wherePeriodText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Borrow whereUserId($value)
 */
class Borrow extends Model
{
    protected $table = 'borrows';
}
