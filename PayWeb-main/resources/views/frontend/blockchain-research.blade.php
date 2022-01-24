@extends('layouts.frontend.main')

@section('content')
    <!--  header area end -->
    <div class="curve-bg" style="top:248px;">
    </div>
    <!--  hero area start -->
    <div class="main-hero-area cta4" id="download" style="background-color: #efefef; padding-bottom: 150px; padding-top: 150px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero-txt">
                        <h1 style="font-size: 64px;
                              font-weight: 700;
                              margin-bottom: 20px;
                              color: white;"><span style="border-bottom: 1px solid white;  display: inline-block;line-height: 1.5;">Blockchain Research</span></h1>
                        <p>"IPB Blockchain has partnered with a University and Non Profit for testing and research
                            of Blockchain technology and laws. Through research our goal is to create new jobs and
                            stimulate global economies."</p>
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
                <div class="col-md-12">
                    @foreach($items as $section)
                        <div class="row" style="padding-bottom: 40px;">
                            <div class="col-md-12">
                                <h3 style="line-height: 2;">{!! $section['title'] !!}</h3>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($section['symbol'] as $coinSymbol)
                                <div class="col-md-2 text-center" style="margin-bottom: 20px;">
                                    <img class="img-fluid" style="max-width: 150px;max-height: 150px;" src="{{asset('assets/img/coins/' . $coinSymbol . '.png')}}" alt="">
                                    <p>{{ $currencies->where('symbol', $coinSymbol)->first()?$currencies->where('symbol', $coinSymbol)->first()->name:'' }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection