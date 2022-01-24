@extends('layouts.frontend.main')

@section('style')
    <style>
        .main-hero-area.cta4:after{
            top: 0;
        }
        .pack-text {
            margin-bottom: 0;
            color: black;
        }
        .get-app-padding-right {
            position: absolute;
            right: 200px;
        }
    </style>
@endsection

@section('content')
    <div class="main-hero-area cta4" id="download" style="background-color: #efefef; padding-bottom: 0; padding-top: 70px;">
        <div class="container">
            <div class="row">
            </div>
        </div>
    </div>
    <!--  about area start -->
    <div class="home3-about-area" id="features" style="background-color: white;padding-top: 50px;">
        <div class="container" style="padding-bottom: 30px;">
            <div class="row">
                <div class="col-md-12 wow fadeInUp">
                    <div class="section-title">
                        <h2>Marketplace Research Development</h2>
                        <hr style="margin-left:0;width: 500px;">
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-3 text-center">
                    <img src="{{asset('assets/img/mrd/about1.png')}}" alt="">
                    <div class="about-single-content">
                        <p>Logistics</p>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3 text-center">
                    <img src="{{asset('assets/img/mrd/about2.png')}}" alt="">
                    <div class="about-single-content">
                        <p>Travel</p>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3 text-center">
                    <img src="{{asset('assets/img/mrd/about3.png')}}" alt="">
                    <div class="about-single-content">
                        <p>Gaming</p>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-2"></div>
                <div class="col-md-3 text-center">
                    <img src="{{asset('assets/img/mrd/about4.png')}}" alt="">
                    <div class="about-single-content">
                        <p>Medical</p>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3 text-center">
                    <img src="{{asset('assets/img/mrd/about5.png')}}" alt="">
                    <div class="about-single-content">
                        <p>Legal</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  about area end -->
@endsection