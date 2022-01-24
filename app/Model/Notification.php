<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Model\Notification
 *
 * @property int $id
 * @property int $readed
 * @property int $uid
 * @property string|null $detail
 * @property string $sender
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $link
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Notification whereDetail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Notification whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Notification whereReaded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Notification whereSender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Notification whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Notification whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Notification extends Model
{
    protected $fillable = ['readed','uid','detail','sender','link'];

    public static function send($message,$uid,$sender = false,$link = false){
        $notification = new Notification();
        $notification->readed = false;
        $notification->uid = $uid;
        $notification->detail = $message;
        $notification->sender = ($sender) ? $sender:'System';
        $notification->link = ($link) ? $link:'#';
        return $notification->save();
    }

    public static function readed(){
        return Notification::updated(['readed' => true])->where('uid',Auth::user()->id);
    }

}
