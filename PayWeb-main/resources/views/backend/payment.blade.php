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
        @if($errors->any())
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
        @endif
            @if(isset(session('redirect')['status']))
                <div class="col-12">
                    <div class="alert alert-warning text-center" role="alert">
                        <span>Back to {{ session('redirect')["shop"] }} in </span><span id="sec">5 sec.</span>
                    </div>
                </div>
                <script>
                    let sec = 4;
                    let loop = setInterval(function () {
                        $('#sec').text(sec+' sec.');
                        if (sec == 0){
                            clearInterval(loop);
                            window.close()
                        }
                        else
                            sec--
                    },1000)
                </script>
            @endif
            @if(isset(session('redirect')['link']))
                <div class="col-12">
                    <div class="alert alert-warning text-center" role="alert">
                        <span>Back to {{ session("redirect")["shop"] }} in </span><span id="sec">5 sec.</span>
                    </div>
                </div>
                <script>
                    let sec = 4;
                    let loop = setInterval(function () {
                        $('#sec').text(sec+' sec.');
                        if (sec == 0){
                            clearInterval(loop);
                            var link = "{{ session('redirect')['link'] }}".replace(/\&amp\;/gi, "&");
                            window.location.assign(link + "&close=1")
                        }
                        else
                            sec--
                    },1000)
                </script>
            @endif
        <div class="col-lg-6">
            <form method="post">
                @csrf
                <input type="hidden" name="devvio" value="{{ $currencies[($wallet->currency)-1]->isDevvio }}">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">@lang('pages.order-detail')</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-lg-12 form-group">
                                <div class="row">
                                    <label class="control-label col-12"><strong>@lang('pages.payment-for')</strong></label>
                                </div>
                                <div class="row d-none" id="qr-scan-div">
                                    <div class="col-12">
                                        <div id="loadingMessage">@lang('pages.camera-access-error')</div>
                                        <canvas id="qr-canvas"></canvas>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="output" hidden>
                                            <div id="outputMessage" class="d-none">@lang('pages.no-qr-error')</div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-12"><strong>@lang('pages.to')</strong></label>
                                            <input name="qr-name" class="form-control w-100 d-none" id="username-input" type="text" readonly>
                                        </div>
                                        <input type="hidden" name="qr-id" id="userid-input">
                                    </div>
                                </div>
                                <div class="row ml-0 mr-0" id="company-select-div">
                                    <div class="col-lg-9 col-sm-12">
                                        <select class="form-control" id="company" name="company">
                                            <option value="">-- @lang('pages.select') --</option>
                                            @foreach($companies as $company)
                                                @if($company->activated == 1)
                                                    @if(($order['company'] && $order['company'] == $company->id) || (session('company_id') && session('company_id') == $company->id))
                                                        <option selected value="{{ $company->id }}">{{ $company->name }}</option>
                                                    @else
                                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-sm-12">
                                        @if($order['company'] || session('company_id'))
                                        @else
                                            <button class="btn btn-primary w-100" id="scan-btn">@lang('pages.scan')</button>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label col-12"><strong>@lang('pages.address')</strong></label>
                                            <input name="qr-address" class="form-control w-100" id="outputData" type="text">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-10 form-group">
                                <label class="control-label"><strong>@lang('pages.amount')</strong></label>
                                <input class="form-control w-100" name="amount" {{ ($order['amount']) ? "readonly":'' }} type="text" value="{{ ($order['amount']) ? $order['amount']:''}}">
                            </div>

                            <div class="col-lg-2 form-group">
                                <label class="control-label"><br></label>
                                <select class="form-control" id="currency" onchange="changeWallet(this)" name="currency" {{($order['currency']) ? 'disabled':''}}>
                                    @foreach($currencies as $currency)
                                        <option value="{{$currency->symbol}}" {{ (strtolower($order['currency']) == $currency->symbol) ? 'selected':(isset($symbol) && $symbol == $currency->symbol) ? 'selected':''}}>{{ strtoupper($currency->symbol) }}</option>
                                    @endforeach
                                        @if($order['currency'])
                                            <input type="hidden" name="currency" value="{{ strtolower($order['currency']) }}"/>
                                        @endif
                                </select>
                            </div>

                            <div class="col-lg-12 form-group">
                                <label class="control-label"><strong>@lang('pages.order-reference')</strong></label>
                                <input class="form-control" name="reference" {{ ($order['ref']) ? "readonly":'' }} type="text" value="{{ ($order['ref']) ? $order['ref']:'' }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success w-100" onclick="waitingDialog.show('@lang('pages.loading')');">@lang('pages.confirm-payment')</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><h6 class="m-0 font-weight-bold text-primary"><img class="mr-5" src="{{asset('landing/assets/images/'.$currencies[($wallet->currency)-1]->symbol.'.png')}}" width="40px" height="40px">{{ $currencies[($wallet->currency)-1]->name }} @lang('pages.wallet')</h6></h6>
                </div>
                <div class="card-body" align="center">
                    <div class="row">
                        <div class="col-12">
                            <div class="card rounded-circle text-center pt-5 text-uppercase" style="width: 160px;height: 160px;">
                                <p>@lang('pages.balance')</p>
                                <div id="balance_{{ $wallet->currency }}" class="text-center" style="color: black;">
                                    <div class="spinner-border text-primary text-center" role="status">
                                        <span class="sr-only">@lang('pages.loading')</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr>
                            <p><strong>@lang('pages.address')</strong></p>
                            <p><td>{!! ($wallet->address) ? QrCode::size(150)->generate($wallet->address) : '' !!}</td></p>
                            <p>
                                @if(!isset($wallet->address))
                                    <a href="{{action('Backend\HomeController@generateWalletAddress',['crypto' => $currencies[($wallet->currency)-1]->symbol,'ref' => Auth::user()->name ])}}" class="btn btn-primary w-100">@lang('pages.generate')</a>
                                @else
                                    <input class="form-control" readonly value="{{$wallet->address}}">
                                @endif
                            </p>
                            <hr>
                        </div>
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
    <script src="{{asset('/js/custom_qr.js')}}?ver=2"></script>

    <script>
        var chooseCoin = '{!! isset($symbol)?$symbol:'btc' !!}'
        function changeWallet(sel){
            window.location.href = "/payments/"+sel.value;
        }
        $(document).ready(function () {
            $.get( "/balance", function( results ) {
                results.forEach((result) => {
                    $("#balance_"+result.currency).text(new Intl.NumberFormat('en-US', { maximumSignificantDigits: 20 }).format(result.balance))
                })
            });

            $("#scan-btn").click(function(e){
                e.preventDefault();
                $("#qr-scan-div").removeClass('d-none')
                $("#company-select-div").addClass('d-none')

                initQR(chooseCoin)
            })
        })
    </script>
@endsection
