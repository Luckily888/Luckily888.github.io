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