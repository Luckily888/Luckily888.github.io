<?php

namespace App\Http\Controllers\API;

use App\Model\Donate;
use App\Model\DonateUser;
use App\Model\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class DonateController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->input('limit');
        $user = $request->user();
        $donateQuery = Donate::leftJoin('donate_users', function($join) use($user){
            $join->on('donates.id', '=', 'donate_users.donate_id')
                ->where('donate_users.user_id', $user->id);
        })
            ->select('donates.id', 'donates.name', 'donates.image_path', 'donates.desc', 'donates.user_id',
                'donates.start_datetime', 'donates.end_datetime',
                \DB::raw("CAST(SUM(CASE WHEN donate_users.id IS NOT NULL THEN 1 ELSE 0 END) AS UNSIGNED) as has_user_donate, SUM(IFNULL(donate_users.amount, 0.0)) as sum_amount"))
            ->groupBy('donates.id', 'donates.name', 'donates.image_path', 'donates.desc', 'donates.user_id',
            'donates.start_datetime', 'donates.end_datetime');

        if ($limit && $limit > 0) {
            $donateQuery->limit($limit);
        }

        $result = $donateQuery->get();

        return response()->json($result, 200);
    }

    public function show($id)
    {
        $donate = Donate::find($id);
        $list = DonateUser::where('donate_id', $donate->id)->get();
        $donate->{"donation_list"} = $list;

        return response()->json($donate, 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'wallet_id' => 'required',
            'amount' => 'required',
            'ref' => 'required',
        ]);

        $donate = Donate::find($id);
        if (!$donate) {
            return response()->json(['error_code'=>'not_found_donation', 'status'=>'fail'], 422);
        }
        if ($donate->start_datetime->gt(Carbon::now())){
            return response()->json(['error_code'=>'donation_not_start', 'status'=>'fail'], 422);
        }
        if ($donate->end_datetime->lt(Carbon::now())){
            return response()->json(['error_code'=>'donation_end', 'status'=>'fail'], 422);
        }

        if ($validator->fails()) {
            return response()->json(['error_code'=>'validation_fail', 'status'=>'fail', 'message'=>$validator->getMessageBag()], 422);
        }

        $wallet = Wallet::find($request->input('wallet_id'));
        if ((float)$wallet->balance < (float)$request->input('amount')){
            return response()->json([
                'status'=>'fail',
                'error_code'=>'not_enough_balance',
                'message'=>'Your Balance is not enough.'
            ], 422);
        }

        $user = $request->user();

        $userVote = new DonateUser();
        $userVote->user_id = $user->id;
        $userVote->donate_id = $id;
        $userVote->wallet_id = $request->input('wallet_id');
        $userVote->currency_id = $request->input('currency_id');
        $userVote->amount = $request->input('amount');
        $userVote->ref = $request->input('ref');
        $userVote->note = $request->input('note');
        $userVote->save();

        // TODO add history so we can check payment history
        $wallet->balance = (float)$wallet->balance - 1;
        $wallet->save();

        return response()->json(['success'=>true], 200);
    }
}
