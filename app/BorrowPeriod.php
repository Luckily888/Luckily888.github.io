<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\BorrowPeriod
 *
 * @property int $id
 * @property string $name
 * @property int $period_amount
 * @property string $period_type
 * @property float $interest_percentage
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BorrowPeriod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BorrowPeriod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BorrowPeriod query()
 * @method static \Illuminate\Database\Eloquent\Builder|BorrowPeriod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BorrowPeriod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BorrowPeriod whereInterestPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BorrowPeriod whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BorrowPeriod wherePeriodAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BorrowPeriod wherePeriodType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BorrowPeriod whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BorrowPeriod extends Model
{
    //
}
