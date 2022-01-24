@extends('admin.layouts.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Payment</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Payment list</h6>
            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Company</th>
                        <th>Reference</th>
                        <th>@lang('pages.amount')</th>
                        <th>Currency</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Own</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($results as $index => $result)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $result->name }}</td>
                            <td>{{ $result->reference }}</td>
                            <td>{{ $result->amount }}</td>
                            <td>{{ $result->symbol }}</td>
                            <td>{{ ($result->status == 1) ? 'success' : 'fail' }}</td>
                            <td>{{ $result->created_at }}</td>
                            <td>{{ $result->user_name }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection