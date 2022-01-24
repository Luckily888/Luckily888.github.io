<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\DonateUser
 *
 * @property int $id
 * @property int $user_id
 * @property int $donate_id
 * @property int $currency_id
 * @property int $wallet_id
 * @property string|null $ref
 * @property float $amount
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DonateUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DonateUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DonateUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DonateUser whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DonateUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DonateUser whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DonateUser whereDonateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DonateUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DonateUser whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DonateUser whereRef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DonateUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DonateUser whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DonateUser whereWalletId($value)
 * @mixin \Eloquent
 */
class DonateUser extends Model
{
    //
}
