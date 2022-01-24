<?php

namespace App\Http\Controllers\Backend;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'checkkyc']);
    }

    public function index(){
        return view('backend.profile');
    }

    public function changePassword(Request $request){
        $rules = [
            'old_password' => 'required',
            'new_password' => 'required',
        ];
        $request->validate($rules);

        $user = User::where('email',Auth::user()->email)->get();
        if (Hash::check($request->get('old_password'), $user[0]->password)) {
            $update = User::where('email',Auth::user()->email)
                ->update([
                    "password" => Hash::make($request->get('new_password'))
                ]);
            if ($update){
                return redirect(action('Backend\ProfileController@index'))->with(['status' => [
                    'class' => 'success',
                    'message' => 'Already updated your password.']
                ]);
            }else{
                return redirect(action('Backend\ProfileController@index'))->with(['status' => [
                    'class' => 'danger',
                    'message' => 'Failed. Try again next time.']
                ]);
            }
        }else{
            return redirect(action('Backend\ProfileController@index'))->with(['status' => [
                'class' => 'danger',
                'message' => 'Wrong password.']
            ]);
        }
    }

    public function changeProfile(Request $request){
        $rules = [
            'name' => 'required',
            'phone' => 'required',
        ];
        $request->validate($rules);

        $update = User::where('email',Auth::user()->email)
            ->update([
                "name" => $request->get('name'),
                "phone" => $request->get('phone')
            ]);
        if($update){
            return redirect(action('Backend\ProfileController@index'))->with(['status' => [
                'class' => 'success',
                'message' => 'Already updated.']
            ]);
        }
        else{
            return redirect(action('Backend\ProfileController@index'))->with(['status' => [
                'class' => 'danger',
                'message' => 'Failed. Try again next time.']
            ]);
        }
    }
}
