<?php

namespace App\Http\Controllers\API;

use App\Model\Currency;
use App\Model\History;
use App\Model\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BalanceController extends Controller
{
    private $wallet,$currency,$history;

    public function __construct(
        Currency $currency,
        History $history,
        Wallet $wallet
    )
    {
        $this->currency = $currency;
        $this->history = $history;
        $this->wallet = $wallet;
    }

    public function index(Request $request)
    {
        $wallets = Wallet::getAllUserBalance($request->user()->id);
        return response()->json($wallets);
    }

    /**
     * @param Request $request
     * @param $id integer this is user_id, currency_id
     */
    public function show(Request $request, $id)
    {
        $wallet = Wallet::whereUid($request->user()->id)
            ->where('currency', $id)
            ->first();

        if (!$wallet) {
            return response()->json(['balance'=>0], 200);
        }

        return response()->json(['balance'=>$wallet->balance], 200);
    }
}
