<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\UserContact
 *
 * @property int $id
 * @property int $user_id
 * @property int $contact_user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserContact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserContact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserContact query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserContact whereContactUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserContact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserContact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserContact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserContact whereUserId($value)
 * @mixin \Eloquent
 */
class UserContact extends Model
{
    protected $fillable = ['user_id', 'contact_user_id'];
}
