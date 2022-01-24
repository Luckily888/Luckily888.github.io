<html>
<head>
    <title>IPB Pay @Phitech</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/scroll.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-152391197-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-152391197-1');
    </script>

</head>

<body class="theme-dark io-dark io-dark-light" data-spy="scroll" data-target="#mainnav" data-offset="80" style="height: 80vh;">

<!-- Header -->
<header class="site-header is-sticky">
    @include('layouts.navbar')
</header>
<div id="container" class="d-none d-lg-block">
    <div id="container2">
        <div class="box one">
            <div class="row p-5">
                ​<br>
                <div class="col-6">
                    <p><img style="height: 40vh; margin-top: 10vh;" src="landing/assets/images/frontlogo.svg"></p>
                    <p class="text-dark mt-5" style="font-size: 2rem;">@lang('landing.online-payment')</p>
                    <p class="text-dark" style="font-size: 2rem;">IPB pay</p>
                    <p class="text-dark mt-5" style="font-size: 1rem;">@lang('landing.using-ipb-pay')</p>
                </div>
                <div class="col-6">
                    <p class="mt-5 text-center"><img style="height: 40vh; margin-top: 10vh;" id="coin" src="landing/assets/images/coin.png"></p>
                </div>
            </div>
        </div>
        <div class="box two">
            <div class="row p-lg-5 p-md-2">
                ​<br>
                <div class="col-5 d-none d-lg-block">
                    {{--                    animated fadeIn delay-3s--}}
                </div>
                <div class="col-7" id="coin-panel">
                    <p class="text-center mt-5" style="font-size: 4vh;">@lang('landing.payment-options')</p>
                    <div class="row">
                        <div class="col-6 mt-5" id="coin1">
                            <div class="row">
                                <div class="col-6">
                                    <img class="coin-img" src="landing/assets/images/coin-blu.png">
                                </div>
                                <div class="col-6">
                                    <p class="p-coin">Blue Chip Coin</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-5 offset-1 mt-5" id="coin2">
                            <div class="row">
                                <div class="col-6">
                                    <img class="coin-img" src="landing/assets/images/xrp.png">
                                </div>
                                <div class="col-6">
                                    <p class="p-coin">XRP</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mt-5" id="coin3">
                            <div class="row">
                                <div class="col-6">
                                    <img class="coin-img" src="landing/assets/images/eth.png">
                                </div>
                                <div class="col-6">
                                    <p class="p-coin">Ethereum</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-5 offset-1 mt-5" id="coin4">
                            <div class="row">
                                <div class="col-6">
                                    <img class="coin-img" src="landing/assets/images/ltc.png">
                                </div>
                                <div class="col-6">
                                    <p class="p-coin">Lite Coin</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mt-5" id="coin5">
                            <div class="row">
                                <div class="col-6">
                                    <img class="coin-img" src="landing/assets/images/btc.png">
                                </div>
                                <div class="col-6">
                                    <p class="p-coin">Bitcoin</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-5 offset-1 mt-5" id="coin6">
                            <div class="row">
                                <div class="col-6">
                                    <img class="coin-img" src="landing/assets/images/eos.png">
                                </div>
                                <div class="col-6">
                                    <p class="p-coin">EOS</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mt-5" id="coin7">
                            <div class="row">
                                <div class="col-6">
                                    <img class="coin-img" src="landing/assets/images/bch.png">
                                </div>
                                <div class="col-6">
                                    <p class="p-coin">Bitcoin cash</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box three">
            <div class="row">
                <div class="col-12 p-lg-5 p-md-2" id="contact-animation" style="font-size: 16px;color: white !important;">
                    <p><img src="landing/assets/images/last-logo.png" style="height: 15vh;" class="mt-3"></p>
                    <p class="mt-5 text-uppercase">@lang('landing.about')</p>
                    <p class="mt-3">----------------------------------------</p>
                    <p class="mt-3">----------------------------------------</p>
                    <p class="mt-3">----------------------------------------</p>
                    <p class="mt-3">----------------------------------------</p>
                    <p class="mt-5 text-uppercase">@lang('landing.contact')</p>
                    <p class="mt-3">blockchainipb.com</p>
                    <p class="mt-3">Email: contact@blockchainipb.com</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Header -->
{{-- Mobile Zone --}}
<div class="d-none d-lg-none d-md-block">
    <div class="row p-5 one">
        ​<br>
        <div class="col-6">
            <p><img style="height: 40vh; margin-top: 10vh;" src="landing/assets/images/paymentlogo.png"></p>
            <p class="text-dark mt-5" style="font-size: 2rem;">@lang('landing.online-payment')</p>
            <p class="text-dark" style="font-size: 2rem;">IPB PAY</p>
            <p class="text-dark mt-5" style="font-size: 1rem;">@lang('landing.using-ipb-pay')</p>
        </div>
        <div class="col-6">
            <p class="mt-5 text-center"><img style="height: 40vh; margin-top: 10vh;" id="coin" src="landing/assets/images/coin.png"></p>
        </div>
    </div>
    <div class="row">
        <div class="col-7" id="coin-panel">
            <p class="text-center mt-5" style="font-size: 4vh;">@lang('landing.payment-options')</p>
            <div class="row pl-3">
                <div class="col-6 mt-5" id="coin1">
                    <div class="row">
                        <div class="col-6">
                            <img class="coin-img" src="landing/assets/images/coin-blu.png">
                        </div>
                        <div class="col-6">
                            <p class="p-coin">Blue Chip Coin</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 mt-5" id="coin2">
                    <div class="row">
                        <div class="col-6">
                            <img class="coin-img" src="landing/assets/images/xrp.png">
                        </div>
                        <div class="col-6">
                            <p class="p-coin">XRP</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 mt-5" id="coin3">
                    <div class="row">
                        <div class="col-6">
                            <img class="coin-img" src="landing/assets/images/eth.png">
                        </div>
                        <div class="col-6">
                            <p class="p-coin">Ethereum</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 mt-5" id="coin4">
                    <div class="row">
                        <div class="col-6">
                            <img class="coin-img" src="landing/assets/images/ltc.png">
                        </div>
                        <div class="col-6">
                            <p class="p-coin">Lite Coin</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 mt-5" id="coin5">
                    <div class="row">
                        <div class="col-6">
                            <img class="coin-img" src="landing/assets/images/btc.png">
                        </div>
                        <div class="col-6">
                            <p class="p-coin">Bitcoin</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 mt-5" id="coin6">
                    <div class="row">
                        <div class="col-6">
                            <img class="coin-img" src="landing/assets/images/eos.png">
                        </div>
                        <div class="col-6">
                            <p class="p-coin">EOS</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 mt-5" id="coin7">
                    <div class="row">
                        <div class="col-6">
                            <img class="coin-img" src="landing/assets/images/bch.png">
                        </div>
                        <div class="col-6">
                            <p class="p-coin">Bitcoin cash</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-5 three d-none d-md-block text-dark p-5">
            <p><img src="landing/assets/images/last-logo.png" style="height: 15vh;" class="mt-3"></p>
            <p class="mt-5 text-uppercase">@lang('landing.about')</p>
            <p class="mt-3">----------------------------------------</p>
            <p class="mt-3">----------------------------------------</p>
            <p class="mt-3">----------------------------------------</p>
            <p class="mt-3">----------------------------------------</p>
            <p class="mt-5 text-uppercase">@lang('landing.contact')</p>
            <p class="mt-3">inphibit.com</p>
            <p class="mt-3">Email: contact@inphibit.com</p>
        </div>
    </div>
</div>

<!-- JavaScript (include all script here) -->
@include('layouts.js')

</body>
</html>
