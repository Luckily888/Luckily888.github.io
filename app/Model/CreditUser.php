<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\CreditUser
 *
 * @property int $id
 * @property int $user_id
 * @property int $credit_id
 * @property float $balance
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\CreditUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\CreditUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\CreditUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\CreditUser whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\CreditUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\CreditUser whereCreditId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\CreditUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\CreditUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\CreditUser whereUserId($value)
 * @mixin \Eloquent
 */
class CreditUser extends Model
{
    protected $fillable = [
        'user_id',
        'credit_id'
    ];
}
