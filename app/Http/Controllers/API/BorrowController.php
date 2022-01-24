<?php

namespace App\Http\Controllers\API;

use App\Borrow;
use App\BorrowPeriod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class BorrowController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'loan_currency_id' => 'required',
            'loan_amount' => 'required',
            'collateral_currency_id'=> 'required',
            'collateral_amount'=> 'required',
            'borrow_period_id'=> 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error'=>'validation_error',
                'success'=>false,
                'validations'=>$validator->errors()], 401);
        }

        $borrowPeriod = BorrowPeriod::find($request->borrow_period_id);

        $borrow = new Borrow();
        $borrow->user_id = $request->user()->id;
        $borrow->loan_currency_id = $request->loan_currency_id;
        $borrow->loan_amount = $request->loan_amount;
        $borrow->collateral_currency_id = $request->collateral_currency_id;
        $borrow->collateral_amount = $request->collateral_amount;
        $borrow->borrow_period_id = $request->borrow_period_id;

        $borrow->percentage = $borrowPeriod->interest_percentage;
        $borrow->period_text = $borrowPeriod->period_amount . ' ' . $borrowPeriod->period_type;
        $borrow->interest_amount = ((double)$request->loan_amount / (double)$borrowPeriod->period_amount) / $borrowPeriod->interest_percentage;
        $borrow->end_period_amount = (double)$request->loan_amount + $borrow->interest_amount;
        $borrow->save();

        return response()->json([
            'status'=>'success',
            'error_code'=>null
        ], 200);
    }

    public function indexBorrowPeriod()
    {
        return response()->json([
            'status'=>'success',
            'items'=>BorrowPeriod::get(),
            'error_code'=>null
        ], 200);
    }
}
