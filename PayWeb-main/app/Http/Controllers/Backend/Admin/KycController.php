<?php

namespace App\Http\Controllers\Backend\Admin;

use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Model\Kyc;
use Illuminate\Support\Facades\Auth;

class KycController extends Controller
{
    private $kyc;
    public function __construct(
        Kyc $kyc
    )
    {
        $this->middleware(['auth:admin', 'verified']);
        $this->kyc = $kyc;

    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $results = $this->kyc->where('verified',null)->get();
        return view('admin.kyc.index')->with(['results' => $results]);
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
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
        $validatedData = $request->validate([
            'verified' => 'required'
        ]);
        $validatedData['verified_by'] = Auth::user()->id;
        try{
            $this->kyc->find($id)->update($validatedData);
            return redirect()->back()->with(['status' => [
                'class' => 'success',
                'message' => 'Verified.']
            ]);
        } catch (Exception $e){
            return redirect()->back()->with(['status' => [
                'class' => 'danger',
                'message' => 'Something error. Please try again.']
            ]);
        }
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
