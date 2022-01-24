<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class MemberController extends Controller
{
    private $user;

    public function __construct(
        User $user
    )
    {
        $this->middleware('auth:admin');
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = $this->user->all();
        return view('admin.member.index')->with(['results' => $results]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.member.form',['action' => 'add']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->user->fill($request->all())->save();
        if ($result){
            return redirect(route('admin.members.index'))->with([
                'status' => [
                    'class' => 'success',
                    'message' => 'Added new currency.'
                ],
            ]);
        }

        return redirect(route('admin.members.create'))->with([
            'status' => [
                'class' => 'danger',
                'message' => 'Failed. Try again.'
            ],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $results = $this->user->find($id);
        return view('admin.member.form')->with(['results' => $results,'action' => 'edit']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result = $this->user->where('id',$id)->update(
            [
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
            ]);
        if ($result){
            return redirect(route('admin.members.index'))->with(
                [
                    'status' => [
                        'class' => 'success',
                        'message' => 'Updated.'
                    ]
                ]);
        }
        return redirect()
            ->back()
            ->withErrors($result)
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->currency->destroy($id);
        if ($result){
            return redirect(route('admin.members.index'))->with(
                [
                    'status' => [
                        'class' => 'success',
                        'message' => 'Deleted.'
                    ]
                ]);
        }
        return redirect()
            ->back()
            ->withErrors($result)
            ->withInput();
    }
}
