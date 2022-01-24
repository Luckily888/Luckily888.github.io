<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\VoteChoice
 *
 * @property int $id
 * @property int $vote_header_id
 * @property string $name
 * @property string|null $desc
 * @property float $score
 * @property int $count_user_vote
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\VoteChoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\VoteChoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\VoteChoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\VoteChoice whereCountUserVote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\VoteChoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\VoteChoice whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\VoteChoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\VoteChoice whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\VoteChoice whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\VoteChoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\VoteChoice whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\VoteChoice whereVoteHeaderId($value)
 * @mixin \Eloquent
 */
class VoteChoice extends Model
{
    //
}
