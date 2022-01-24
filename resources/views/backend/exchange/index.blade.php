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
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header row" style="margin:0px;">
                    <div class="col-md-9 col-lg-7 d-sm-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">@lang('pages.my-balance')</h6>
                    </div>
                    <div class="col-md-4 col-lg-2" style="padding-top:5px;"><label for="chkhidezerobalance"><input type="checkbox" id="chkhidezerobalance" name="chkhidezerobalance" value="1" checked="checked" />&nbsp;Hide 0 Balance</label></div>
                    <div class="col-md-4 col-lg-2"><input type="text" class="form-control" name="keyword" id="keyword" placeholder="Search" /></div>
                    <div class="col-md-4 col-lg-1" style="padding-left:0px;padding-top:5px;font-size:20px;"><a href="javascript:void(0);" class="fa fa-search"  id="btnsearch" style="text-decoration:none">&nbsp;</a></div>
                </div>
                <div class="card-body" align="center" id="coins">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>@lang('pages.coin-name')</th>
                                <th>@lang('pages.balance')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($balances as $balance)
                                <tr>
                                    <td>{{ $balance->coin_name }}</td>
                                    <td>{{ number_format($balance->balance,8) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="row">
                <form method="post" action="{{ route('user.exchanges.store') }}">
                    @csrf
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">@lang('pages.digital-currency-transfer')</h6>
                        </div>
                        <div class="card-body">

                            <div class="form-row">
                                <div class="col-lg-8 form-group">
                                    <label class="control-label"><strong>@lang('pages.amount')</strong></label>
                                    <input class="form-control w-100" type="number" maxlength="8" required name="amount1" id="devvio-amount1" min="0" step="0.0000001">
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label class="control-label"><strong>@lang('pages.change')</strong></label>

                                    <select class="form-control" id="devvio-currency1" name="currency1">
                                        @foreach($currencies as $currency)
                                            @if($currency->isDevvio)
                                                <option value="{{$currency->id}}">{{ strtoupper($currency->symbol) }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-8 form-group">
                                    <label class="control-label"><strong>@lang('pages.you-have-receive')</strong></label>
                                    <input class="form-control w-100" required readonly name="amount2" id="devvio-amount2" type="text">
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label class="control-label"><strong>@lang('pages.to')</strong></label>

                                    <select class="form-control" id="devvio-currency2" name="currency2">
                                        @foreach($currencies as $currency)
                                            @if($currency->isDevvio)
                                                <option value="{{$currency->id}}">{{ strtoupper($currency->symbol) }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success w-100" onclick="waitingDialog.show('@lang('pages.loading')');">@lang('pages.confirm')</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <form method="post" action="{{ route('user.exchanges.storeERC20') }}">
                    @csrf
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">@lang('pages.alt-coins-exchange')</h6>
                        </div>
                        <div class="card-body">

                            <div class="form-row">
                                <div class="col-lg-8 form-group">
                                    <label class="control-label"><strong>@lang('pages.amount')</strong></label>
                                    <input class="form-control w-100" type="number" maxlength="8" required name="amount1" id="erc-amount1" min="0" step="0.0000001">
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label class="control-label"><strong>@lang('pages.change')</strong></label>

                                    <select class="form-control" id="erc-currency1" name="currency1">
                                        @foreach($currencies as $currency)
                                            @if($currency->symbol=='blu'||$currency->symbol=='btc'||$currency->symbol=='eth')
                                                <option value="{{$currency->id}}">{{ strtoupper($currency->symbol) }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-8 form-group">
                                    <label class="control-label"><strong>@lang('pages.you-have-receive')</strong></label>
                                    <input class="form-control w-100" required readonly name="amount2" id="erc-amount2" type="text">
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label class="control-label"><strong>@lang('pages.to')</strong></label>

                                    <select class="form-control" id="erc-currency2" name="currency2">
                                        @foreach($currencies as $currency)
                                            @if(in_array($currency->symbol, ['elcred', 'cbdasia','cbdus','ipb','edge']))
                                                <option value="{{$currency->id}}">{{ strtoupper($currency->symbol) }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success w-100" onclick="waitingDialog.show('@lang('pages.loading')');">@lang('pages.confirm')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">@lang('pages.price-table')</h6>
                </div>
                <div class="card-body" align="center">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                            <tr>
                                <th>@lang('pages.coin-name')</th>
                                <th>@lang('pages.price') (USD)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($currencies as $currency)
                                @if($currency->isDevvio)
                                    <tr>
                                        <td>{{ $currency->name }} ({{$currency->symbol}})</td>
                                        <td>1 : {{ $currency->conversion }}</td>
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
    <script>
        var delayTimer;

        $(document).ready(function () {
            function convert(prefix){
                let lPrefix = typeof prefix === undefined?'':prefix
                let amount = $('#'+lPrefix+'amount1').val();
                let cur1 = $('#'+lPrefix+'currency1').val();
                let cur2 = $('#'+lPrefix+'currency2').val();

                // delay for 1 second so the request will not overload server
                clearTimeout(delayTimer);
                delayTimer = setTimeout(function() {
                    $.get( "/exchanges/convert/"+cur1+'/'+cur2+'/'+amount, function( results ) {
                        $('#'+lPrefix+'amount2').val(new Intl.NumberFormat('en-US', { maximumSignificantDigits: 20 }).format(results))
                    });
                }, 1000);
            }

            $('#devvio-amount1').on('input',function () {
                convert('devvio-')
            })
            $('#devvio-currency1,#devvio-currency2').on('change',function () {
                convert('devvio-')
            })
            $('#erc-amount1').on('input',function () {
                convert('erc-')
            })
            $('#erc-currency1,#erc-currency2').on('change',function () {
                convert('erc-')
            })

            $('#chkhidezerobalance').change(function() {
                var hidezerobalance = 0;
                if($(this).is(":checked"))
                {
                    hidezerobalance = 1;
                }
                var keyword = $('#keyword').val();

                $.get( "<?= URL::to('/'); ?>/exchangecoins?keyword="+keyword+"&hidezerobalance="+hidezerobalance, function( resp ) {
                    $('#coins').html(resp);
                });
            });

            $('#btnsearch').click(function() {
                var hidezerobalance = 0;
                if($('#chkhidezerobalance').is(":checked"))
                {
                    hidezerobalance = 1;
                }
                var keyword = $('#keyword').val();

                $.get( "<?= URL::to('/'); ?>/exchangecoins?keyword="+keyword+"&hidezerobalance="+hidezerobalance, function( resp ) {
                    $('#coins').html(resp);
                });
            });
        })
    </script>
@endsection
