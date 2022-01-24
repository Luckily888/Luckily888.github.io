@extends('backend.layouts.main')

@section('content')
    <div class="row">
        @if (session('status'))
            <div class="col-12">
                <div class="alert alert-{{ session('status')["class"]}} text-center" role="alert">
                    {{ session('status')["message"]}}
                </div>
            </div>
        @endif
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-left">Profile</h6>
                </div>
                <div class="card-body text-left">
                    <form method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ Auth::user()->email }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="formGroupExampleInput" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="formGroupExampleInput" value="{{ Auth::user()->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="formGroupExampleInput" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="formGroupExampleInput" value="{{ Auth::user()->name }}">
                            </div>
                        </div>
                        <button class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-left">Change Password</h6>
                </div>
                <div class="card-body text-left">
                    <form method="post" action="{{action('Backend\ProfileController@changePassword')}}">
                        @csrf
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-12 col-form-label">Old Password</label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control" id="inputPassword" required name="old_password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-12 col-form-label">New Password</label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control" id="inputPassword" required name="new_password">
                            </div>
                        </div>
                        <button class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
