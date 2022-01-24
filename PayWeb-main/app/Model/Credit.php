<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Credit
 *
 * @property int $id
 * @property string $name
 * @property int $credit_type_id
 * @property string|null $image_path
 * @property string|null $desc
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $currency_id
 * @property string|null $icon
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Credit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Credit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Credit query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Credit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Credit whereCreditTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Credit whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Credit whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Credit whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Credit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Credit whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Credit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Credit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Credit whereUserId($value)
 * @mixin \Eloquent
 */
class Credit extends Model
{
    //
}
