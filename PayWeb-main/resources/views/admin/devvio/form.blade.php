@extends('admin.layouts.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Send Coins</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Send coin panel</h6>
            </div>
        </div>
        <div class="card-body">
            <form action="send" method="post">
                @csrf
                <input type="hidden" value="" id="uid">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="coin_id">Coin ID</label>
                        <input type="text" class="form-control" id="coin_id" readonly name="coin_id" value="{{ old('coin_id',isset($coin_id)) ? ($coin_id) : '' }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="to">To Address</label>
                        <input type="text" class="form-control" id="to" name="to" value="{{ old('to',isset($to)) ? ($to) : '' }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="amount">@lang('pages.amount')</label>
                        <input type="text" class="form-control" id="amount" name="amount" value="{{ old('amount',isset($amount)) ? ($amount) : '' }}">
                    </div>
                    <div class="form-group col-12">
                        <button class="btn btn-success">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">User list</h6>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Address</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($users))
                    @foreach($users as $user)
                        <tr>
                            <td>-</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->address }}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection