<?php

namespace App\Http\Controllers\API;

use App\Model\UserVote;
use App\Model\VoteChoice;
use App\Model\VoteHeader;
use App\Model\Wallet;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class VoteController extends Controller
{
    public function getVoteList(Request $request)
    {
        /**
         * SELECT h.id, h.name, SUM(case when uv.id is not null and c.name='yes' then 1 else 0 end) as count_yes, SUM(case when uv.id is not null and c.name='no' then 1 else 0 end) as count_no FROM `vote_headers` as h left join vote_choices as c on h.id = c.vote_header_id left join user_votes as uv on c.id = uv.vote_choice_id and h.id = uv.vote_header_id group by h.id, h.name
         */
        $limitQuery = "";
        if ($request->has('limit')) {
            $limitQuery = " LIMIT " . $request->input('limit');
        }
        $userId = $request->user()->id;
        $query = "
        SELECT h.id, h.name, h.image_path, h.desc, h.start_datetime, h.end_datetime, 
        CAST(SUM(case when c.name='yes' then c.count_user_vote else 0 end) AS UNSIGNED) as count_yes, 
        CAST(SUM(case when c.name='no' then c.count_user_vote else 0 end) AS UNSIGNED) as count_no, 
        IF(SUM(case when uv.id is not null and c.name='yes' then 1 else 0 end)>0,'yes', IF(SUM(case when uv.id is not null and c.name='no' then 1 else 0 end)>0, 'no', null)) as user_vote_name
        FROM `vote_headers` as h 
        left join vote_choices as c on h.id = c.vote_header_id 
        left join user_votes as uv on c.id = uv.vote_choice_id and h.id = uv.vote_header_id and uv.user_id = {$userId}
        group by h.id, h.name, h.image_path, h.desc, h.start_datetime, h.end_datetime 
        {$limitQuery}";

        $result = DB::select($query);

        return response()->json($result, 200);
    }

    public function getVoteDetail($id)
    {
        $vote = VoteHeader::find($id);
        $choices = VoteChoice::where('vote_header_id', $vote->id)->get();
        $vote->{"choices"} = $choices;

        return response()->json($vote, 200);
    }

    public function postVoteChoice(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'vote_choice_id' => 'required',
            'wallet_id' => 'required',
            'amount' => 'required',
            'ref' => 'required',
        ]);

        $voteHeader = VoteHeader::find($id);
        if (!$voteHeader) {
            return response()->json(['error_code'=>'not_found_vote', 'status'=>'fail'], 422);
        }
        if ($voteHeader->start_datetime->gt(Carbon::now())){
            return response()->json(['error_code'=>'vote_not_start', 'status'=>'fail'], 422);
        }
        if ($voteHeader->end_datetime->lt(Carbon::now())){
            return response()->json(['error_code'=>'vote_end', 'status'=>'fail'], 422);
        }

        if ($validator->fails()) {
            return response()->json(['error_code'=>'validation_fail', 'status'=>'fail', 'message'=>$validator->getMessageBag()], 422);
        }

//        $voteChoiceId = $request->input('vote_choice_id');
        // TODO this is for test
        if ($request->input('vote_choice_id')){
            $voteChoiceId = VoteChoice::where('vote_header_id', $id)
                ->where('name', 'like', '%yes%')
                ->first()->id;
        }else{
            $voteChoiceId = VoteChoice::where('vote_header_id', $id)
                ->where('name', 'like', '%no%')
                ->first()->id;
        }
        // TODO end test
        $user = $request->user();

        $userVote = UserVote::where('user_id', $user->id)
            ->where('vote_header_id', $id)
            ->first();
        if (!$userVote){
            $userVote = new UserVote();
            $userVote->user_id = $user->id;
            $userVote->vote_header_id = $id;
        }

        $userVote->vote_choice_id = $voteChoiceId;
        $userVote->wallet_id = $request->input('wallet_id');
        $userVote->currency_id = $request->input('currency_id');
        $userVote->amount = $request->input('amount');
        $userVote->ref = $request->input('ref');
        $userVote->note = $request->input('note');
        $userVote->save();

        // count vote so we get current yes-no vote amount
        VoteHeader::countVotes($voteHeader);

        // TODO move this to history so we can check payment history
        $wallet = Wallet::find($request->input('wallet_id'));
        $wallet->balance = (float)$wallet->balance - 1;
        $wallet->save();

        return response()->json(['success'=>true], 200);
    }
}
