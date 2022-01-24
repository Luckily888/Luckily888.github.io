<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\DevvioHistory
 *
 * @property int $id
 * @property int $uid
 * @property float $amount
 * @property string $reference
 * @property string $status
 * @property string $from
 * @property string $to
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $coin_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DevvioHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DevvioHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DevvioHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DevvioHistory whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DevvioHistory whereCoinId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DevvioHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DevvioHistory whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DevvioHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DevvioHistory whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DevvioHistory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DevvioHistory whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DevvioHistory whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\DevvioHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DevvioHistory extends Model
{
    protected $fillable = ['uid','amount','reference','status','from','to','coin_id'];
}
