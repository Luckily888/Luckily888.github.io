<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\UserVote
 *
 * @property int $id
 * @property int $user_id
 * @property int $vote_choice_id
 * @property int $currency_id
 * @property int $wallet_id
 * @property string|null $ref
 * @property float $amount
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $vote_header_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserVote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserVote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserVote query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserVote whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserVote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserVote whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserVote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserVote whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserVote whereRef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserVote whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserVote whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserVote whereVoteChoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserVote whereVoteHeaderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserVote whereWalletId($value)
 * @mixin \Eloquent
 */
class UserVote extends Model
{
    //
}
