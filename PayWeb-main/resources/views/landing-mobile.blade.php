<html>
<head>
    <title>IPB Pay @Phitech</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-152391197-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-152391197-1');
    </script>

    <style>
        body {
            background-color: white;
        }

        .coin-img {
            height: 10vh;
            width: auto;
            margin-bottom: 10%;
        }

        .one {
            background: url(../landing/assets/images/bg1.png);
            background-position: center;
            background-size: 100% 100% !important;
        }

        .three {
            background-color: #999;
        }
    </style>
</head>
<body class="theme-dark io-dark io-dark-light">
<div id="container">
    <!-- Header -->
    <header class="site-header is-sticky" style="background-color: white;">
        @include('layouts.navbar')
    </header>
    <div class="row p-5 one" style="height:100vh;">
        <div class="col-12 p-5">
            <p><img style="width: 500px; margin-top: 10vh;" src="landing/assets/images/paymentlogo.svg"></p>
            <p class="text-dark mt-5" style="font-size: 5rem;">@lang('landing.online-payment')</p>
            <p class="text-dark" style="font-size: 5rem;">IPB pay</p>
            <p class="mt-5 text-gray-100" style="font-size: 2rem;">@lang('landing.using-ipb-pay')</p>
        </div>
    </div>
    <div class="row p-3 mt-3 text-center" style="height:100vh; font-size: 1.6rem;">
        <div class="col-12">
            <h1>@lang('landing.payment-options')</h1>
        </div>
        <div class="col-6">
            <p><img class="coin-img" src="landing/assets/images/coin-blu.png"></p>
            <p class="p-coin">Blue Chip Coin</p>
        </div>
        <div class="col-6">
            <p><img class="coin-img" src="landing/assets/images/xrp.png"></p>
            <p class="p-coin">XRP</p>
        </div>
        <div class="col-6">
            <p><img class="coin-img" src="landing/assets/images/eth.png"></p>
            <p class="p-coin">Ethereum</p>
        </div>
        <div class="col-6">
            <p><img class="coin-img" src="landing/assets/images/ltc.png"></p>
            <p class="p-coin">Lite Coin</p>
        </div>
        <div class="col-6">
            <p><img class="coin-img" src="landing/assets/images/btc.png"></p>
            <p class="p-coin">Bitcoin</p>
        </div>
        <div class="col-6">
            <p><img class="coin-img" src="landing/assets/images/eos.png"></p>
            <p class="p-coin">EOS</p>
        </div>
        <div class="col-6">
            <p><img class="coin-img" src="landing/assets/images/bch.png"></p>
            <p class="p-coin">Bitcoin cash</p>
        </div>
    </div>
    <div class="row p-5 three text-white">
        <div class="col-12 text-center p-5">
            <p><img style="width: 300px;" src="landing/assets/images/paymentlogo.svg"></p>
            <p class="mt-5 text-uppercase">@lang('landing.about')</p>
            <p class="mt-3">----------------------------------------</p>
            <p class="mt-3">----------------------------------------</p>
            <p class="mt-3">----------------------------------------</p>
            <p class="mt-3">----------------------------------------</p>
            <p class="mt-5 text-uppercase">@lang('landing.contact')</p>
            <p class="mt-3">blockchainipb.com</p>
            <p class="mt-3">Email: contact@blockchainipb.com</p>
            <hr style="border-color: white;">
            Copyright © Phitech 2019.
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
<script>
    function updateQueryStringParameter(uri, key, value) {
        var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        var separator = uri.indexOf('?') !== -1 ? "&" : "?";
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        }
        else {
            return uri + separator + key + "=" + value;
        }
    }
    $(function() {
        $(".lang-select").click(function(){
            var url = window.location.href;
            url = updateQueryStringParameter(url, 'lang', $(this).attr('data-lang'))
            window.location.href = url;
        })
    })

</script>
</body>
</html>
