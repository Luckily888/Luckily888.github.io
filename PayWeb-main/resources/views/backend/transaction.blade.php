@extends('backend.layouts.main')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-success">@lang('pages.income')</h6>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> @lang('pages.generate-report')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('datatable.transaction-id')</th>
                        <th>@lang('datatable.amount')</th>
                        <th>@lang('datatable.to')</th>
                        <th>@lang('datatable.date')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($incomes as $id => $income)
                        <tr>
                            <td>{{ $id+1 }}</td>
                            <td>{{ $income->txid }}</td>
                            <td>{{ $income->amount }}</td>
                            <td>{{ $income->from }}</td>
                            <td>{{ $income->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-danger">@lang('pages.outcome')</h6>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> @lang('pages.generate-report')</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('datatable.transaction-id')</th>
                        <th>@lang('datatable.amount')</th>
                        <th>@lang('datatable.to')</th>
                        <th>@lang('datatable.date')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($outcomes as $id => $outcome)
                        <tr>
                            <td>{{ $id+1 }}</td>
                            <td>{{ $outcome->txid }}</td>
                            <td>{{ $outcome->amount }}</td>
                            <td>{{ $outcome->to }}</td>
                            <td>{{ $outcome->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#dataTable2').DataTable({
                "language": languageObject
            });
        });
    </script>
@endsection