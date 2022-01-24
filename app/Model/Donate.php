<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Donate
 *
 * @property int $id
 * @property string $name
 * @property string|null $image_path
 * @property string|null $desc
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon $start_datetime
 * @property \Illuminate\Support\Carbon $end_datetime
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Donate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Donate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Donate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Donate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Donate whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Donate whereEndDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Donate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Donate whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Donate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Donate whereStartDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Donate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Donate whereUserId($value)
 * @mixin \Eloquent
 */
class Donate extends Model
{
    protected $dates = [
        'start_datetime',
        'end_datetime',
    ];
}
