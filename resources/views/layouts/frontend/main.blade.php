<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- FAVICON -->
    <link rel="icon" href="assets/img/favicon.png">
    <!-- TITLE -->
    <title>IPB Pay</title>
    <!-- bootstrap.min.css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- font-awesome.min.css -->
    <link href="assets/css/material-design-iconic-font.min.css" rel="stylesheet">
    <!-- slicknav.min.css -->
    <link href="assets/css/slicknav.min.css" rel="stylesheet">
    <!-- magnific popup.css -->
    <link href="assets/css/magnific-popup.css" rel="stylesheet">
    <!-- owl.css -->
    <link href="assets/css/owl.carousel.css" rel="stylesheet">
    <!-- animate.min.css -->
    <link href="assets/css/animate.min.css" rel="stylesheet">
    <!-- style.css -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('style')
</head>

<body class="home4" style="background-color: #efefef;">
<!--  page loader -->
<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<!--  page loader end -->

<div id="home"></div>
<!--  header area start -->
<div class="header-area cta3">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="logo cta">
                    <a href="/">IPBPAY</a>
                </div>
            </div>
            <div class="col-md-10 text-right">
                <div class="responsive_menu"></div>
                <div class="mainmenu">
                    <ul id="nav">
                        <li><a href="{{url('/')}}#home">Home</a></li>
                        <li><a href="{{url('/')}}#download">Download</a></li>
                        <li><a href="{{url('/')}}#usenow">Use now</a></li>
                        {{--                        <li><a href="https://exchange.blockchainipb.com/">Exchange</a></li>--}}
                        <li><a href="{{url('/')}}#ipb-sis">IPB SIS</a></li>
                        <li>
                            <a href="#">Research</a>
                            <ul class="drop-menu">
                                <li><a href="{{url('/')}}#research">Research</a></li>
                                <li><a href="{{url('/adoption-research')}}">Adoption Research Development</a></li>
                                <li><a href="{{url('/mrd')}}">Marketplace Research Development</a></li>
                                <li><a href="{{url('/digital-fund')}}">Digital asset fund research</a></li>
                            </ul>
                        </li>
                        <li><a href="{{url('/tutorial')}}">Tutorial</a></li>
                    </ul>
                    <a href="{{url('login')}}" class="header-btn">Login</a>
                </div>
            </div>
        </div>
    </div>
</div>

@yield('content')

<!--  footer area start -->
<div class="footer-area cta3 wow fadeInUp" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="footer-title">
                    <h2 style="color:white;margin-bottom:0;">IPB</h2>
                    <h3 style="color:white;">PAY <img height="20" src="{{asset('assets/img/coin.png')}}" alt=""></h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-menu">
                    <ul id="footer-list">
                        <li><a href="{{url('/')}}#home">Home</a></li>
                        <li><a href="{{url('/')}}#features">Features</a></li>
                        <li><a href="{{url('/')}}#download">Download</a></li>
                        <li><a href="{{url('/')}}#usenow">Use now</a></li>
                        <li><a href="{{url('/')}}#digitalassets">Digital Assets</a></li>
                        <li><a href="{{url('/')}}#ipb-sis">IPB SIS</a></li>
                        <li><a href="{{url('/')}}#research">Research</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-title">
                    <h3 style="color:white;">Contact</h3>
                    <p>Email: ipbpay@yahoo.com</p>
                </div>
            </div>
        </div>
    </div>
</div>
{{--footer area end--}}

<!-- jquery.js -->
<script src="assets/js/jquery.js"></script>
<!-- jquery.popper.min.js -->
<script src="assets/js/popper.min.js"></script>
<!-- bootstrap.min.js -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- jquery.slicknav.min.js -->
<script src="assets/js/jquery.slicknav.min.js"></script>
<!-- jquery.magnific.min.js -->
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<!-- jquery.is sticky.min.js -->
<script src="assets/js/jquery.sticky.js"></script>
<!-- jquery.owl.min.js -->
<script src="assets/js/owl.carousel.min.js"></script>
<!-- jquery.wow.min.js -->
<script src="assets/js/wow.min.js"></script>
<!-- main.js -->
<script src="assets/js/main.js"></script>

@yield('script')

</body>

</html>