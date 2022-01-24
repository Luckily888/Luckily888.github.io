<?php

namespace App\Http\Controllers;

use App\Model\Currency;
use App\Model\RefTokenSale;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function research()
    {
        $items = [
            [
                'title' => 'Digital Utility Tokens <br>Blockchain for Services, Logistics and Security.',
                'symbol' => [
                    "bluipb",
                    "cbdipb",
                    "cmul",
                    "edipb",
                    "ec",
                    "ipb",
                    "ipb2",
                    "lwc",
                    "lex",
                    "lc",
                    "mc",
                    "py",
                    "tc",
                    "uc",
                    "vnl",
                    "vcipb",
                ]
            ],
            [
                'title' => 'Game Development Tokens',
                'symbol' => [
                    "gameipb","blu", "elc", "elcred"
                ]
            ],
            [
                'title' => 'Digital Commodity Tokens',
                'symbol' => [
                    "cbdipb","cbdus", "cbdasia"
                ]
            ],
            [
                'title' => 'Digital Crypto',
                'symbol' => [
                    "btc", "eos", "eth", "ltc"
                ]
            ],
            [
                'title' => 'Digital Currency Tokens / Stable Coins',
                'symbol' => [
                    'usdipb', 'poundipb', 'thbipb', 'wonipb', 'yenipb', 'hkdipb', 'mopipb',
                    'goldipb', 'gscipb', 'oilipb', 'h2oipb'
                ]
            ]
        ];
        $currencies = Currency::get();
        return view('frontend.blockchain-research', compact('currencies', 'items'));
    }

    public function adoptionRes(Request $request)
    {
        return view('frontend.adoption-research');
    }

    public function mrd(Request $request)
    {
        return view('frontend.mrd');
    }

    public function digitalFund()
    {
        return view('frontend.digital-fund');
    }

    public function tokenSaleData()
    {
        $tokens = RefTokenSale::get();
        return view('frontend.token-sale-data', compact('tokens'));
    }
}
