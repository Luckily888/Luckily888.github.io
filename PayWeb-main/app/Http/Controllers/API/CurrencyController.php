<?php

namespace App\Http\Controllers\API;

use App\Model\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CurrencyController extends Controller
{
    private $currency;

    public function __construct(
        Currency $currency
    )
    {
        $this->currency = $currency;
    }

    public function index()
    {
        return $this->currency
            ->select([
                'id','name', 'symbol', 'conversion',
                'isDevvio','devID','isERC20', 'is_virtual', 'is_fiat'
            ])->get();
    }
}
