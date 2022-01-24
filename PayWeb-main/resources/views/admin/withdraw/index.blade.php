@extends('admin.layouts.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Withdraws</h1>
    </div>

    @if(Session::has('success'))
        <div class="alert bg-success">
            {{Session::get('success')}}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Withdraw Requests</h6>
            </div>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>User</th>
                        <th>Receive Address</th>
                        <th>Currency</th>
                        <th>Amount</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($withdraws as $item)
                        <tr>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->user_name }}</td>
                            <td>{{ $item->receive_address }}</td>
                            <td>{{ $item->currency_name }} ({{ strtoupper($item->currency_symbol) }})</td>
                            <td>{{ $item->amount }}</td>
                            <td>
                                <form style="display: inline-block;" method="post" action="{{route('admin.withdraw.approve', $item->id)}}">
                                    {{csrf_field()}}
                                    <button class="btn btn-success">Approve</button>
                                </form>
                                <form style="display: inline-block;" method="post" action="{{route('admin.withdraw.not-approve', $item->id)}}">
                                    {{csrf_field()}}
                                    <button class="btn btn-danger">Not Approve</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection