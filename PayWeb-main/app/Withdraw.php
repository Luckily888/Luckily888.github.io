<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Withdraw
 *
 * @property int $id
 * @property int $user_id
 * @property int $currency_id
 * @property int $wallet_id
 * @property float $amount
 * @property float $balance_before
 * @property float $balance_after
 * @property string $status
 * @property int|null $approve_user_id
 * @property string $action_datetime
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw query()
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereActionDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereApproveUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereBalanceAfter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereBalanceBefore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereWalletId($value)
 * @mixin \Eloquent
 * @property string $receive_address
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereReceiveAddress($value)
 * @property int|null $transaction_id
 * @method static \Illuminate\Database\Eloquent\Builder|Withdraw whereTransactionId($value)
 */
class Withdraw extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVE = 'approve';
    const STATUS_NOT_APPROVE = 'notapprove';
    const STATUS_CANCEL = 'cancel';
    const STATUS_COMPLETE = 'complete';

    protected $table = 'withdraws';

    protected $dates = ["action_datetime"];

}
