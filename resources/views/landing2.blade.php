@extends('layouts.frontend.main')

@section('content')
    <!--  header area end -->
    <div class="curve-bg">
    </div>
    <!--  hero area start -->
    <div class="main-hero-area cta4" id="download" style="background-color: #efefef;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="hero-txt">
                        <h1 style="font-size: 115px;font-weight: 100;margin-bottom: 20px;">IPB</h1>
                        <h1 style="font-size: 40px;margin-left: 10px;" class="has-coin">P &#32 A &#32 Y</h1>
                        <p style="margin-bottom: 0;font-size: 25px;">ONLINE BLOCKCHAIN PAYMENT SYSTEM</p>
                        <p style="font-size: 25px;">IPB PAY</p>
                        <p>Using IPB Pay make it easy to pay and collect payments online</p>
                        <a class="home4-download-btn" href="#"></a>
                        <a class="home4-download-btn2" href="#"></a>
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <div class="home4-hero-mobile wow fadeInDown">
                        <div id="mobile-landing-img" style="width: 287px;height: 580px;"></div>
                        {{--                    <img id="mobile-landing-img" src="assets/img/mobile.png" alt="">--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  hero area start -->
    <!--  about area start -->
    <div class="home3-about-area" id="features" style="background-color: #efefef;">
        <div class="container" style="padding-bottom: 30px;">
            <div class="row">
                <div class="col-md-12 wow fadeInUp text-center">
                    <div class="section-title">
                        <h2>WITH IPB PAY</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 text-center">
                    <img src="{{asset('assets/img/about1.png')}}" alt="">
                    <div class="about-single-content">
                        <p>Use this app to pay for any purchase with IPB</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <img src="{{asset('assets/img/about2.png')}}" alt="">
                    <div class="about-single-content">
                        <p>Support many digital currency and digital assets. Trade/Exchange your digital assets</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <img src="{{asset('assets/img/about3.png')}}" alt="">
                    <div class="about-single-content">
                        <p>Pay bill using only this app</p>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <img src="{{asset('assets/img/about4.png')}}" alt="">
                    <div class="about-single-content">
                        <p>IPB blockchain SIS</p>
                        <p>"Society Impact System"</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  about area end -->
    <!--  get area start -->
    <div class="screenshot-area cta3" id="usenow" style="background-color: #ffffff;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mt-5 wow fadeInLeftBig lg-height-500">
                    <div class="get-area-left">
                        <h1>Fast and Secure</h1>
                        <p>Use IPB Pay to pay for anything such as lifestyle, online shopping, coffee, and pay for
                            utilities.
                            This app is not only Payment but you can transfer digital assets or crypto currency.</p>
                        <p>Supports person to person, person to business, business to business transfers.</p>
                    </div>
                </div>
                <div class="col-lg-5 wow fadeInRightBig">
                    <div class="get-app-right">
                        <img src="assets/img/mobile2.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  get area end -->
    <!--  use on web start -->
    <div class="screenshot-area cta3" style="background-color: #ffffff;">
        <div class="sm-container">
            <div class="row" style="margin: 0;">
                <div class="col-lg-7 mt-5 mt-lg-0 wow fadeInLeftBig">
                    <div class="get-app-right get-app-right-w100">
                        <img src="assets/img/laptop.png" alt="">
                    </div>
                </div>
                <div class="col-lg-5 wow fadeInRightBig lg-height-500">
                    <div class="get-area-left">
                        <h1>Use on Web</h1>
                        <p>IPB Pay also support web browser. You can use web version.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  use on web end -->
    <!--  ATM machine start -->
    <div class="screenshot-area cta3" style="background-color: #ffffff;">
        <div class="container">
            <div class="row" style="margin: 0;">
                <div class="col-lg-7 mt-5 wow fadeInLeftBig lg-height-500">
                    <div class="get-area-left">
                        <h1>ATM/Cash Machine*</h1>
                        <p>*coming soon</p>
                        <p>You can Deposit and Withdraw money out of IPB Pay account using our ATM machine.</p>
                    </div>
                </div>
                <div class="col-lg-5 wow fadeInRightBig">
                    <div class="get-app-right tablet-behind">
                        <img src="assets/img/atm2.png" alt="">
                    </div>
                    <div class="get-app-right tablet-front">
                        <img src="assets/img/atm1.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  ATM machine end -->
    <!--  video area start -->
    <div class="video-area cta3" id="digitalassets">
        <div class="container">
            <div class="row">
                <div class="col-md-12 wow fadeInUp text-center">
                    <div class="section-title ctas1">
                        <h2>Digital Asset Options</h2>
                    </div>
                    <div class="screenshot-slide">
                        @foreach($currencies as $currency)
                            <img src="{{asset('assets/img/coins/'.$currency.'.png')}}" alt="">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  video area end -->
    <!--  pricing area start -->
    <div class="screenshot-area cta3" style="background-color: #ffffff;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mtm-div">
                    <div class="monitor-div wow fadeInMonitor">
                        <img src="assets/img/monitor.png" alt="">
                    </div>
                    <div class="tablet-div wow fadeInTablet">
                        <img src="assets/img/tablet.png" alt="">
                    </div>
                    <div class="mobile-div wow fadeInMobile">
                        <img src="assets/img/mobile_login.png" alt="">
                    </div>
                </div>
                <div class="col-lg-5 wow fadeInRight lg-height-500">
                    <div class="get-area-left">
                        <h1>Use Anywhere</h1>
                        <p>Download IPB pay app and use it on smartphone or tablet*. Also works on website.</p>
                        <p style="font-size: 14px;">*Only work on vertical</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="screenshot-area cta3" id="ipb-sis" style="padding: 50px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class=" wow fadeInLeft">
                        <img src="assets/img/mobile_sis.png" alt="">
                    </div>
                </div>
                <div class="col-lg-5 wow fadeInRight">
                    <div class="get-area-right">
                        <h1>IPB blockchain SIS.</h1>
                        <p>“Society impact system”</p>
                        <p></p>
                        <p>Approved KYC AML customers and organizations will have limited access to :</p>
                        <p></p>
                        <p>• Blockchain Voting for approved petitions</p>
                        <p>• Blockchain Donations to approved non-profits</p>
                        <p></p>
                        <p>“This is the first step to streamline safe, secure communication and finance between the public
                            and elected leaders.“</p>
                        <p>Our goal is a</p>
                        <p>• Seamless system between elected leaders, state/federal government departments, charitable
                            organizations, int organizations.</p>
                        <p>• Decrease time and cost to rebuild country infrastructure, grow sustainable economies, support
                            quality employment/job growth, modify/remove unnecessary complication for innovative
                            research</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="screenshot-area cta3" id="research" style="background-color: #ffffff;padding: 50px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="get-area-left wow fadeInLeft">
                        <h1>Blockchain Research</h1>
                        <p>“IPB Blockchain has partnered with a
                            University and Non Profit for testing
                            and research of Blockchain
                            technology and laws. Through research our
                            goal is to create new jobs and stimulate
                            global economies”</p>
                        <div class="row text-center">
                            <div class="col-md-3">
                                <a href="/blockchain-research" class="btn btn-warning">More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 wow fadeInRight">
                    <div class="get-area-right">
                        <img src="assets/img/people_sis.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  pricing area end -->
@endsection

@section('script')
    <script>
        var image = $('#mobile-landing-img');
        var imageIdx = 0;
        var imagePaths = ["url('/assets/img/mobile.png')", "url('/assets/img/mobile2.png')","url('/assets/img/mobile3.png')","url('/assets/img/mobile4.png')"]
        image.css("background", "url('/assets/img/mobile.png')");
        image.fadeIn(200);

        setInterval(function(){
            imageIdx += 1
            if(imageIdx > imagePaths.length -1){
                imageIdx = 0
            }
            image.fadeOut(400, function () {
                image.css("background", imagePaths[imageIdx]);
                image.fadeIn(400);
            });
        }, 5000);
    </script>
@endsection