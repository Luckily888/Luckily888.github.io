@extends('backend.layouts.main')

@section('content')
    @if (session('status'))
        <div class="col-12">
            <div class="alert alert-{{ session('status')["class"]}} text-center" role="alert">
                {{ session('status')["message"]}}
            </div>
        </div>
    @endif
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@lang('pages.send-coin')</h1>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">@lang('pages.send') {{ $currency_name }}</h6>
                        <h6 class="m-0 font-weight-bold text-primary float-right">@lang('pages.balance')
                            : {{ $results->balance }}</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.transfers.store') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $results->address }}" name="address">
                        <input type="hidden" value="{{ $results->currency }}" name="currency_id">
                        <div>

                            <div class="row d-none" id="qr-scan-div">
                                <div id="loadingMessage">@lang('pages.camera-access-error')</div>
                                <canvas id="qr-canvas"></canvas>
                                <div class="col-md-12">
                                    <div id="output" hidden>
                                        <div id="outputMessage" class="d-none">@lang('pages.no-qr-error')</div>
                                    </div>
                                    <input type="hidden" name="qr-id" id="userid-input">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="control-label col-12"><strong>@lang('pages.to')</strong></label>
                                    <input name="qr-name" class="form-control w-100 d-none" id="username-input" type="text" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="outputData">@lang('pages.address')</label>
                                    <input type="text" class="form-control" required id="outputData" name="to"
                                           value="{{ old('to',isset($to)) ? ($to) : '' }}">
                                </div>
                                <div class="form-group col-md-2 col-sm-12">
                                    <label for="" style="color:white;">a</label>
                                    <button class="btn btn-primary w-100" id="scan-btn" style="margin-left: 5px;">@lang('pages.scan')</button>
                                </div>
                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="coin_id">@lang('pages.coin-id')</label>
                                    <input type="text" class="form-control" id="coin_id" required readonly name="coin_id"
                                           value="{{ old('coin_id',isset($coin_id)) ? ($coin_id) : '' }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="amount">@lang('pages.amount')</label>
                                    <input type="number" class="form-control" required step="0.000001" min="0" id="amount"
                                           name="amount" max="{{ $results->balance }}"
                                           value="{{ old('amount',isset($amount)) ? ($amount) : '' }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <button class="btn btn-success" type="submit" id="send" onclick="waitingDialog.show('@lang('pages.loading')');">@lang('pages.send')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{--    History Panel    --}}
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">@lang('pages.transfer-history')</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>@lang('pages.block-time')</th>
                                <th>@lang('pages.amount')</th>
                                <th>@lang('pages.to')</th>
                                <th>@lang('pages.status')</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($histories->hist as $hist)
                                @if($hist->coin_id == $coin_id && $hist->tx_name == \Auth::user()->email)
                                    <tr>
                                        <td>{{ isset($hist->blocktime) ?  $hist->blocktime : '-'}}</td>
                                        <td>{{ number_format(convert_balance($hist->amount),8) }}</td>
                                        <td>{{ $hist->reference }}</td>
                                        <td>@lang('pages.success')</td>
                                        @if(strpos($hist->reference,'@') > 0)
                                            <td><button class="btn btn-success w-100" onclick="userAddress('{{ auth()->user()->email }}','{{ $results->currency_id }}')">@lang('pages.recent-address')</button></td>
                                        @else
                                            <td><a class="btn btn-success w-100" href="{{ action('Backend\PaymentController@index') }}">@lang('pages.go-to-payment-page')</a></td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach
                            @foreach($histories->fail as $hist)
                                @if($hist->coin_id == $coin_id && $hist->tx_name == \Auth::user()->email)
                                    <tr>
                                        <td>{{ isset($hist->blocktime) ?  $hist->blocktime : '-'}}</td>
                                        <td>{{ $hist->amount }}</td>
                                        <td>{{ $hist->reference }}</td>
                                        <td>@lang('pages.failed')</td>
                                        @if(strpos($hist->reference,'@') > 0)
                                            <td><button class="btn btn-success w-100" onclick="userAddress('{{ auth()->user()->email }}','{{ $results->currency_id }}')">@lang('pages.recent-address')</button></td>
                                        @else
                                            <td><a class="btn btn-success w-100" href="{{ action('Backend\PaymentController@index') }}">@lang('pages.go-to-payment-page')</a></td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{asset('/js/jsqr/jsQR.js')}}"></script>
    <script src="{{asset('/js/axios.min.js')}}"></script>
    <script src="{{asset('/js/wallet-address-validator.min.js')}}"></script>
    <script src="{{asset('/js/custom_qr.js')}}"></script>

    <script>
        function userAddress(email,currency_id) {
            $.get( "/histories/"+email+"/"+currency_id)
                .done(function( data ) {
                    document.getElementById('to').value = data[0].address;
                });

        }
        $(document).ready(function () {
            $("#scan-btn").click(function(e){
                e.preventDefault();
                $("#qr-scan-div").removeClass('d-none')
                $("#company-select-div").addClass('d-none')

                initQR('devvio')
            })
        })
    </script>
@endsection