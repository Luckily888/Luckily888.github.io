@extends('backend.layouts.main')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">@lang('pages.payment-history')</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if (session('status'))
                            <div class="alert alert-{{ session('status')["class"]}} text-center" role="alert">
                                {{ session('status')["message"]}}
                            </div>
                        @endif
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('pages.company')</th>
                                    <th>@lang('pages.reference')</th>
                                    <th>@lang('pages.amount')</th>
                                    <th>@lang('pages.currency')</th>
                                    <th>@lang('pages.type')</th>
                                    <th>@lang('pages.status')</th>
                                    <th>@lang('pages.created-at')t</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($results as $index => $result)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $result->name }}</td>
                                        <td>{{ $result->reference }}</td>
                                        <td>{{ $result->amount }}</td>
                                        <td class="text-uppercase">{{ $result->symbol }}</td>
                                        <td>{{ $result->payment_type }}</td>
                                        <td>{{ ($result->status == 1) ? 'Success' : 'Failed' }}</td>
                                        <td>{{ $result->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">@lang('pages.transfer-history')</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if (session('status'))
                            <div class="alert alert-{{ session('status')["class"]}} text-center" role="alert">
                                {{ session('status')["message"]}}
                            </div>
                        @endif
                        <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('pages.currency')</th>
                                <th>@lang('pages.amount')</th>
                                <th>@lang('pages.receiver')</th>
                                <th>@lang('pages.sent-at')</th>
                                <th>@lang('pages.status')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transfers as $index => $result)
                                <tr>
                                    <td>{{ $index +1 }}</td>
                                    <td class="text-uppercase">{{ $result->symbol }}</td>
                                    <td>{{ $result->amount }}</td>
                                    <td>{{ $result->email }}</td>
                                    <td>{{ $result->created_at }}</td>
                                    <td>{{ ($result->status == 1) ? 'Success' : 'Failed' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">@lang('pages.deposit-history')</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if (session('status'))
                            <div class="alert alert-{{ session('status')["class"]}} text-center" role="alert">
                                {{ session('status')["message"]}}
                            </div>
                        @endif
                        <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('pages.currency')</th>
                                <th>@lang('pages.address')</th>
                                <th>@lang('pages.transaction-hash')</th>
                                <th>@lang('pages.amount')</th>
                                <th>@lang('pages.sent-at')</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $index = 1; ?>
                            @foreach($deposits as $result)
                                <tr>
                                    <td>{{ $index++ }}</td>
                                    <td class="text-uppercase">{{ $result->currency }}</td>
                                    <td>{{ $result->to }}</td>
                                    <td>{{ $result->txid }}</td>
                                    <td>{{ $result->amount }}</td>
                                    <td>{{ $result->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
        //    $('.table').DataTable();
        });
    </script>
@endsection
