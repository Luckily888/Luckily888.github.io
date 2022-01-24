<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Kyc
 *
 * @property int $id
 * @property int $uid
 * @property string $address
 * @property string $photo
 * @property string $id_card
 * @property int|null $verified
 * @property int|null $verified_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Kyc newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Kyc newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Kyc query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Kyc whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Kyc whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Kyc whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Kyc whereIdCard($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Kyc wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Kyc whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Kyc whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Kyc whereVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Kyc whereVerifiedBy($value)
 * @mixin \Eloquent
 * @property string|null $photo2
 * @property string|null $id_name
 * @property string|null $id_number
 * @method static \Illuminate\Database\Eloquent\Builder|Kyc whereIdName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kyc whereIdNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kyc wherePhoto2($value)
 */
class Kyc extends Model
{
    protected $fillable = ['uid', 'address', 'id_card', 'photo', 'verified', 'verified_by'];

    static $typeAddress = 'address';
    static $typeIdCard = 'id_card';
    static $typePhoto = 'photo';
    static $typePhoto2 = 'photo2';

    public function user()
    {
        return $this->belongsTo(User::class,'uid','id');
    }
}
