<?php

namespace App\Http\Controllers\API;

use App\Model\Currency;
use App\Model\UserContact;
use App\Model\Wallet;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Log;
use Validator;
class UserController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            "company" => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken($request->input('company'))-> accessToken;
            $success['id'] = $user->id;
            $success['email'] = $user->email;
            $success['uuid'] = $user->uuid;
            return response()->json(['success' => $success], $this-> successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'phone' => 'required|unique:users'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error'=>'validation_error',
                'success'=>false,
                'validations'=>$validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        // TODO this is for text
        $input['email_verified_at'] = Carbon::now()->toDateTimeString();
        $input['kyc_verified_at'] = Carbon::now()->toDateTimeString();

        $user = User::create($input);

        $success = [];
        $currencies = Currency::all();
        $user = User::where('email', $request->input('email'))->first();
        foreach ($currencies as $currency){
            Wallet::create([
                'uid' => $user->id,
                'currency' => $currency->id,
                'address' => null,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        User::generateAddresses($user);

        return response()->json(['success'=>$success], $this-> successStatus);
    }

    /**
     * details api
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);
    }

    public function getBalance(Request $request)
    {
        $currency = $request->input('currency');
        $userId = $request->input('user_id');
        $email = $request->input('email');

        Log::info('getBalance user_id: ' .$userId . ' currency: ' . $currency);

        if (!$userId){
            $user = User::where('email', $email)
                ->first();
        }else{
            $user = User::find($userId);
        }

        $wallet = Wallet::where('currency', $currency)
            ->where('uid', $user->id)
            ->first();

        if ($wallet){
            return response()->json(['success'=>['balance'=>$wallet->balance]], $this->successStatus);
        }

        return response()->json(['success'=>['balance'=>0]], $this->successStatus);
    }

    public function getUserFromAddr($addr)
    {
        $user = User::join('wallets', 'users.id', '=', 'wallets.uid')
            ->where('wallets.address', '=', $addr)
            ->select('users.name', 'users.id')
            ->first();
        if ($user){
            return response()->json(['id'=>$user->id, 'name'=>$user->name]);
        }

        return response()->json(['id'=>null, 'name'=>null]);
    }

    public function index(Request $request)
    {
        $users = User::where('id', '!=', $request->user()->id)
            ->get();

        return response()->json($users, 200);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'phone_code'=> 'required',
            'citizenship_code'=>'required',
            'address'=>'required',
            'country_code'=>'required',
            'city'=>'required',
            'zip'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error'=>'validation_error',
                'success'=>false,
                'validations'=>$validator->errors()], 401);
        }

        // check email and phone number
        $emailDup = User::where('id', '!= ',$request->user()->id)
            ->where('email', $request->email)->count();
        if ($emailDup > 0){
            return response()->json(['error'=>'Email is used by other users'], 400);
        }
        $emailDup = User::where('id', '!= ',$request->user()->id)
            ->where('phone', $request->phone)->count();
        if ($emailDup > 0){
            return response()->json(['error'=>'Phone number is used by other users'], 400);
        }

        $user = User::findOrFail($request->user()->id);
        $user->fill($request->input());
        $user->save();

        return response()->json($user, 200);
    }

    public function getUserContacts(Request $request)
    {
        $users = UserContact::join('users', 'user_contacts.contact_user_id', '=', 'users.id')
            ->where('user_id', $request->user()->id)
            ->select('users.id', 'users.name')
            ->get();

        foreach ($users as $user){
            $user->{'wallets'} = Wallet::where('uid', $user->id)
                ->select('id', 'address', 'currency as currency_id')->get();
        }

        return response()->json($users, 200);
    }
}
