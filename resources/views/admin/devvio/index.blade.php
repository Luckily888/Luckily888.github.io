@extends('admin.layouts.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Devvio</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Balances</h6>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name Coin</th>
                    <th>Coin ID</th>
                    <th>@lang('pages.balance')</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($results as $result)
                        <tr>
                            <td>-</td>
                            <td>{{ $result->coin_name }}</td>
                            <td>{{ $result->coin_id }}</td>
                            <td>{{ number_format($result->balance,8) }}</td>
                            <td><a href="{{ route('admin.devvio.form',['coin_id' => $result->coin_id]) }}" class="btn btn-primary">Send coin</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection