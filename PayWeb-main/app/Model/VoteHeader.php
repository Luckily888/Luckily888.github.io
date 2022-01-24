<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\VoteHeader
 *
 * @property int $id
 * @property string $name
 * @property string|null $image_path
 * @property string|null $desc
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $start_datetime
 * @property \Illuminate\Support\Carbon|null $end_datetime
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\VoteHeader newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\VoteHeader newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\VoteHeader query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\VoteHeader whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\VoteHeader whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\VoteHeader whereEndDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\VoteHeader whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\VoteHeader whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\VoteHeader whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\VoteHeader whereStartDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\VoteHeader whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\VoteHeader whereUserId($value)
 * @mixin \Eloquent
 */
class VoteHeader extends Model
{
    protected $dates = [
        'start_datetime',
        'end_datetime',
    ];

    public static function countVotes($voteHeader)
    {
        $yesChoice = VoteChoice::where('vote_header_id', $voteHeader->id)
            ->where('name', 'like' ,'%yes%')
            ->first();
        $noChoice = VoteChoice::where('vote_header_id', $voteHeader->id)
            ->where('name','like', '%no%')
            ->first();

        $yesChoice->count_user_vote = UserVote::where('vote_header_id', $voteHeader->id)
            ->where('vote_choice_id', $yesChoice->id)
            ->count();
        $yesChoice->save();
        $noChoice->count_user_vote = UserVote::where('vote_header_id', $voteHeader->id)
            ->where('vote_choice_id', $noChoice->id)
            ->count();
        $noChoice->save();

        return true;
    }
}
