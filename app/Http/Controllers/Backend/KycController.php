<?php

namespace App\Http\Controllers\Backend;

use App\Model\Kyc;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class KycController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $oldKyc = Kyc::where('uid', auth()->user()->id)
            ->first();
        return view('backend.kyc.index', compact('oldKyc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if(!is_dir("images/kycs/". auth()->user()->id ."/")) {
            File::makeDirectory("images/kycs/". auth()->user()->id ."/", $mode = 0777, true, true);
        }

        if (!$request->hasFile('address') || !$request->hasFile('id') ||!$request->hasFile('photo')) {
            return redirect(route('user.kyc.index'))->with(['status' => [
                'class' => 'danger',
                'message' => 'We need all 3 proof images to finish your kyc']
            ]);
        }

        $file_address = $request->file('address');
        $extension_address = $file_address->getClientOriginalExtension(); // getting image extension
        $filename_address = 'address.' . $extension_address;

        $file_id = $request->file('id');
        $extension_id = $file_address->getClientOriginalExtension(); // getting image extension
        $filename_id = 'id.' . $extension_id;

        $file_photo = $request->file('photo');
        $extension_photo = $file_address->getClientOriginalExtension(); // getting image extension
        $filename_photo = 'photo.' . $extension_photo;
        if($file_address->move('images/kycs/'.auth()->user()->id.'/', $filename_address)){
            if ($file_id->move('images/kycs/'.auth()->user()->id.'/', $filename_id)){
                if ($file_photo->move('images/kycs/'.auth()->user()->id.'/', $filename_photo)){
                    $create = Kyc::create([
                        'uid' => auth()->user()->id,
                        'address' => "images/kycs/". auth()->user()->id ."/".$filename_address,
                        'id_card' => "images/kycs/". auth()->user()->id ."/".$filename_id,
                        'photo' => "images/kycs/". auth()->user()->id ."/".$filename_photo,
                    ]);
                    if ($create){

                        $user = auth()->user();
                        $user->kyc_verified_at = Carbon::now();
                        $user->save();

                        return redirect(route('user.kyc.index'))->with(['status' => [
                            'class' => 'success',
                            'message' => 'Uploaded successfully, Your account is temporarily verified.']
                        ]);
                    }
                } else {
                    return redirect(route('user.kyc.index'))->with(['status' => [
                        'class' => 'danger',
                        'message' => 'Upload images fail. Try again.']
                    ]);
                }
            } else {
                return redirect(route('user.kyc.index'))->with(['status' => [
                    'class' => 'danger',
                    'message' => 'Upload images fail. Try again.']
                ]);
            }
        } else {
            return redirect(route('user.kyc.index'))->with(['status' => [
                'class' => 'danger',
                'message' => 'Upload images fail. Try again.']
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
