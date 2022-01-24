<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;

class ShopController extends Controller
{
    public function login(Request $request)
    {
        Cookie::queue('company',$request->get('company'),30);
        Cookie::queue('ref',$request->get('ref'),30);
        Cookie::queue('currency',$request->get('currency'),30);
        Cookie::queue('amount',$request->get('amount'),30);
        Cookie::queue('redirect',$request->get('redirect'),30);
        return redirect('/payments');
    }
}
