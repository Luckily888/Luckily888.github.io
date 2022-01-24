<?php

namespace App\Http\Controllers\Auth;

use App\Model\Currency;
use App\Model\History;
use App\Model\Wallet;
use App\User;
use App\Http\Controllers\Controller;
use Auth;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Symfony\Component\Debug\Debug;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'unique:users'] ,
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $create =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
        $currencies = Currency::all();
        $user = User::where('email', $data['email'])->get();
        foreach ($currencies as $currency){
            Wallet::create([
                'uid' => $user[0]->id,
                'currency' => $currency->id,
                'address' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
        User::generateAddresses($user[0]);
        $this->putRandomMoney($user[0]);
        return $create;
    }

    public function putRandomMoney($user)
    {
        // 0.00018 btc
        // 0.0091 eth
        // 50 thb
        // 1.66 usd

        $testCurrrency = [1,4,19,13];
        $wallets = Wallet::whereIn('currency', $testCurrrency)
            ->whereNotNull('address')
            ->where('uid', $user->id)
            ->get()->random(1);

        $currency = Currency::find($wallets->first()->currency);

        $amount = 0;
        if ($currency->id == 19) {
            $amount = convert_to_devvio(50);
        }else if($currency->id == 13) {
            $amount = convert_to_devvio(1.66);
        }
        else if ($currency->symbol == 'btc'){
            $amount = 0.00018;
        }elseif ($currency->symbol == 'eth'){
            $amount = 0.0091;
        }

        History::createHistory(0, $amount, 'register', true,$currency->id, 'payment', null, $user->id,'', 0);
    }
}
