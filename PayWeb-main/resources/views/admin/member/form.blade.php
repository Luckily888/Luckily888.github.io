@extends('admin.layouts.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Member</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">{{ ($action === 'edit') ? 'Edit' : 'Add' }} Member</h6>
                <a href="{{ route('admin.members.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-list fa-sm"></i> Member list</a>
            </div>
        </div>
        <div class="card-body">
            <form enctype="multipart/form-data" method="post" action="{{ ($action === 'edit') ? route('admin.currencies.update',["id" => $results->id]):route('admin.currencies.store')}}">
                @csrf
                @if($action === 'edit')
                    <input type="hidden" name="_method" value="PUT">
                @endif
                <div class="row">
                    <div class="form-group col-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" {{ isset($results->email) ? 'disable':'' }} value="{{ old('name',isset($results->email)) ? ($results->email) : '' }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name',isset($results->name)) ? ($results->name) : '' }}">
                    </div>
                    @if($action === 'add')
                        <div class="form-group col-6">
                            <label for="symbol">Password</label>
                            <input type="password" class="form-control" id="password" name="passsword" value="{{ old('password',isset($results->symbol)) ? ($results->symbol) : '' }}">
                        </div>
                        <div class="form-group col-6">
                            <label for="symbol">Re-Password</label>
                            <input type="re-password" class="form-control" id="re-password" name="re-password">
                        </div>
                    @endif
                    <div class="form-group col-12">
                        <button class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection