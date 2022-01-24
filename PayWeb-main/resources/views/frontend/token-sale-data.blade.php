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
                        <h2>Token Sale Data</h2>
                        <hr style="margin-left:0;width: 500px;">
                        <p class="pack-text">The list of 100 ICO's ranging from 2830% return to 100% return for ICO participants.</p>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12 table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Symbol</th>
                            <th>Status</th>
                            <th>USE Raised</th>
                            <th>Month</th>
                            <th>Sale Price</th>
                            <th>Current Price</th>
                            <th>Return</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tokens as $token)
                            <tr>
                                <td>
                                    <img height="30" width="30" src="{{asset('assets/img/digital-fund/' . $token->image_path)}}" alt="">
                                    {{$token->name}}
                                </td>
                                <td>{{$token->symbol}}</td>
                                <td>{{$token->status}}</td>
                                <td>{{$token->use_raised}}</td>
                                <td>{{$token->start_date}}</td>
                                <td>{{$token->sale_price}}</td>
                                <td>{{$token->currency_price}}</td>
                                <td>{{$token->return_rate}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--  about area end -->
@endsection