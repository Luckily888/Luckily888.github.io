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
        <div id="front-line"></div>
    </div>
    <div class="row">
        <div class="col-md-4 col-lg-2"><input type="text" class="form-control" name="keyword" id="keyword" placeholder="Search" /></div>
        <div class="col-md-4 col-lg-2" style="padding-left:0px;padding-top:5px;font-size:20px;"><a href="javascript:void(0);" class="fa fa-search"  id="btnsearch" style="text-decoration:none">&nbsp;</a></div>
        <div class="col-md-6 col-lg-4">&nbsp;</div>
        <div class="col-md-4 col-lg-2" style="padding-top:5px;"><label for="chkhidezerobalance"><input type="checkbox" id="chkhidezerobalance" name="chkhidezerobalance" value="1" checked="checked" />&nbsp;Hide 0 Balance</label></div>
        <div class="col-md-4 col-lg-2">
            <select id="sort_by" class="form-control">
                <option value="">Sort by</option>
                <option value="1">A TO Z</option>
                <option value="2">Z TO A</option>
                <option value="3">Balance High to Low</option>
                <option value="4">Balance Low to High</option>
            </select>
        </div>
    </div>
    <div class="clearfix">&nbsp;</div>
    <div class="row" id="wallets">
        @foreach($wallets as $wallet)
        <div class="col-md-6 col-lg-4" id="div-{{$wallet->currency}}">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><img class="mr-5" src="landing/assets/images/{{$wallet->symbol}}.png" width="40px" height="40px">{{ $wallet->currency_name }} Wallet</h6>
                </div>
                <div class="card-body" align="center">
                    <div class="row">
                        <div class="col-12">
                            <div class="card rounded-circle text-center pt-5 text-uppercase" style="width: 160px;height: 160px;">
                                <p>@lang('pages.balance')</p>
                                <div id="balance_{{ $wallet->currency }}" class="text-center">
                                    <div class="spinner-border text-primary text-center" role="status">
                                        <span class="sr-only">'@lang('pages.loading')'</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr>
                            <p><strong>@lang('pages.address')</strong></p>
                            <p>
                                <td>{!! ($wallet->address) ? QrCode::size(150)->generate($wallet->currency .' ' . $wallet->address) : '' !!}</td>
                            </p>
                            <p>
                                @if(!isset($wallet->address))
                                    <a href="{{action('Backend\HomeController@generateWalletAddress',['crypto' => $wallet->symbol,'ref' => Auth::user()->name ])}}" class="btn btn-primary w-100">@lang('pages.generate')</a>
                                @else
                                    @if(!empty($wallet->address))
                                    <input class="form-control" id="{{ $wallet->symbol }}" readonly onclick="copyValue('{{ $wallet->symbol }}')" value="{{$wallet->address}}">
                                    @endif
                                @endif
                            </p>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        </div>
    <script>
        let balanceMapping = []
        let $divFrontLine = $("#front-line")
        $(document).ready(function () {

            $.get( "<?= URL::to('/'); ?>/balance", function( results ) {
                results.forEach((result) => {
                    balanceMapping.push({currency: result.currency, balance: result.balance})
                    $("#balance_"+result.currency).html(new Intl.NumberFormat('en-US', { maximumSignificantDigits: 20 }).format(result.balance))
                })
            });

            $('#chkhidezerobalance').change(function() {
                var hidezerobalance = 0;
                if($(this).is(":checked"))
                {
                    hidezerobalance = 1;
                }
                var keyword = $('#keyword').val();

                var sort_by = $('#sort_by').val();

                $.get( "<?= URL::to('/'); ?>/wallets?keyword="+keyword+"&hidezerobalance="+hidezerobalance+"&sort_by="+sort_by, function( resp ) {
                    $('#wallets').html(resp);
                    $.get( "<?= URL::to('/'); ?>/balance?keyword="+keyword+"&hidezerobalance="+hidezerobalance+"&sort_by="+sort_by, function( results ) {
                        results.forEach((result) => {
                            balanceMapping.push({currency: result.currency, balance: result.balance})
                            $("#balance_"+result.currency).html(new Intl.NumberFormat('en-US', { maximumSignificantDigits: 20 }).format(result.balance))
                        })
                    });
                    
                });
            });

            $('#sort_by').change(function() {
                var hidezerobalance = 0;
                if($('#chkhidezerobalance').is(":checked"))
                {
                    hidezerobalance = 1;
                }
                var keyword = $('#keyword').val();

                var sort_by = $(this).val();

                $.get( "<?= URL::to('/'); ?>/wallets?keyword="+keyword+"&hidezerobalance="+hidezerobalance+"&sort_by="+sort_by, function( resp ) {
                    $('#wallets').html(resp);
                    $.get( "<?= URL::to('/'); ?>/balance?keyword="+keyword+"&hidezerobalance="+hidezerobalance+"&sort_by="+sort_by, function( results ) {
                        results.forEach((result) => {
                            balanceMapping.push({currency: result.currency, balance: result.balance})
                            $("#balance_"+result.currency).html(new Intl.NumberFormat('en-US', { maximumSignificantDigits: 20 }).format(result.balance))
                        })
                    });
                    
                });
            });

            $('#btnsearch').click(function() {
                var hidezerobalance = 0;
                if($('#chkhidezerobalance').is(":checked"))
                {
                    hidezerobalance = 1;
                }
                var keyword = $('#keyword').val();

                var sort_by = $('#sort_by').val();

                $.get( "<?= URL::to('/'); ?>/wallets?keyword="+keyword+"&hidezerobalance="+hidezerobalance+"&sort_by="+sort_by, function( resp ) {
                    $('#wallets').html(resp);
                    $.get( "<?= URL::to('/'); ?>/balance?keyword="+keyword+"&hidezerobalance="+hidezerobalance+"&sort_by="+sort_by, function( results ) {
                        results.forEach((result) => {
                            balanceMapping.push({currency: result.currency, balance: result.balance})
                            $("#balance_"+result.currency).html(new Intl.NumberFormat('en-US', { maximumSignificantDigits: 20 }).format(result.balance))
                        })
                    });
                    
                });
            });

           
        })
    </script>
@endsection
