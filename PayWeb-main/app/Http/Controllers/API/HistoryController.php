<?php

namespace App\Http\Controllers\API;

use App\ExchangeTransaction;
use App\Model\History;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->has('limit')?(int)$request->input('limit'):5;
        $skip = $request->has('skip')?(int)$request->input('skip'):0;
        $symbol = $request->input('symbol')?$request->input('symbol'):null;

        $result =History::getAll($limit, $symbol, $skip);
        foreach ($result as $row){
            $row->currency_id = (int)$row->currency_id;
        }

        $exchangeTx = ExchangeTransaction::getAll($limit, $symbol, $skip);
        foreach ($exchangeTx as $row){
            $row->currency_id = (int)$row->currency_id;
        }
        $result = $result->merge($exchangeTx)->sortByDesc('created_at')->slice(0, $limit)->values();

        return response()->json($result, 200);
    }

    public function show($id)
    {
        return response()->json(History::find($id), 200);
    }
}
