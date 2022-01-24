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
    {{--    ipb pay start--}}
    <div class="screenshot-area cta3" style="background-color: #ffffff;padding-top:3em;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Digital asset fund research</h1>
                    <hr>
                </div>
                <div class="col-12">
                    <p class="pack-text">
                        Digital Assets have created for some innovative fortunate in investors great returns. For others their investment has been lost. A sample of our research into the trading and investment of  digital assets can bees seen below articles. We are not providing any investment advice here but is posted purely for research and discussion.

                        In 2020 David Burke and Zeno Goldsmith tested live trades of a private investment from January to March 2020 and recorded an approx 53 percent return. However this was just a test and we are not taking on any outside funds at the moment to trade or invest. Remember with any investment you have a chance of  losing or winning.
                    </p>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-12">
                    <p class="pack-text">
                        Among these VC players are Pantera Capital. As reported by multiple sites, the fund amassed returns over 10,000 percent over the last several years by investing in and trading bitcoin. The incubator arm of Pantera leads investments in altcoin trading on high-volume exchanges, utilizing an algorithmic trading approach. The Pantera team posted this letter on their official Medium site in July of 2018 regarding its involvement with blockchain and cryptocurrency based investment. Pantera’s blockchain SEC filing documents can be found here

                        According to ICO Data from the website Hackernoon about how much money made by investors in best 100 ICO’s… “some early investors are making as much as 50,000% returns on ICOs. Early investment is paying off in massive ways.”
                    </p>
                </div>
            </div>

            <div class="row pt-5">
                <div class="col-md-12">
                    <h1>Top Returns of 2017</h1>
                </div>
                <div class="col-12">
                    <p class="pack-text">
                        2017 saw some incredible returns for investors in ICOs. Some of the leaders of the pack are listed below:
                    </p>
                </div>
            </div>

            <div class="row pt-5">
                <div class="col-md-5 text-center">
                    <img src="{{asset('assets/img/digital-fund/komodo.png')}}" alt="">
                </div>
                <div class="col-md-7">
                    <h2>Komodo</h2>
                    <p class="pack-text">
                        ROI : $100 in their ICO = $14,151 today <br>
                        One-liner : Privacy focused Ethereum <br>
                        Why it maters : Komodo is yet another platform
                    </p>
                </div>
            </div>
            <div class="row pt-5">
                <div class="col-md-5 text-center">
                    <img src="{{asset('assets/img/digital-fund/ark.png')}}" alt="">
                </div>
                <div class="col-md-7">
                    <h2>Ark</h2>
                    <p class="pack-text">
                        ROI : $100 in their ICO= $36,600 today <br>
                        One-liner : Lets blockchains communicate with other blockchains. <br>
                        Why it maters : There are many cases for businesses to create and maintain their own blockchain. Ark aims to allow easy communication between different blockchains. Rather than having a bunch of independent data stores and platforms with Ark there is the potential for a network. The need for this network will likely increase as more and more blockchains are created.
                    </p>
                </div>
            </div>
            <div class="row pt-5">
                <div class="col-md-5 text-center">
                    <img src="{{asset('assets/img/digital-fund/spectrecoin.png')}}" alt="">
                </div>
                <div class="col-md-7">
                    <h2>Spectrecoin</h2>
                    <p class="pack-text">
                        Return : $100 in their ICO= $50,834 today <br>
                        􏰀One-liner : Privacy focused cryptocurrency <br>
                        Why it maters : Privacy focused cryptocurrencies like Monero nd Zcash have been getting a lot of attention lately. Spectre-coins claim to fame is that it provides network privacy by running within the TOR network
                    </p>
                </div>
            </div>
            <div class="row pt-5">
                <div class="col-md-5 text-center">
                    <img src="{{asset('assets/img/digital-fund/mangrove-capital.png')}}" alt="">
                </div>
                <div class="col-md-7">
                    <h2>Mangrove Capital</h2>
                    <p class="pack-text">
                        2017 Mangrove Capital reported “If one had invested blindly in every ICO, including the significant number of ICOs that failed, this would have delivered a 13.2x return (1320 percent return on investment).”
                    </p>
                    <p class="pack-text">
                        The Mangrove report highlighted tokenizations implications for the venture capital industry.
                        It examined the potential of tokenization and
                        explains why ICOs could radically change how private companies raise capital. It also provides an analysis of how this funding mechanism is being used today, explores how ICOs could impactthe venture capital operating model and examines the likely shape of a suportive regulatory framework.
                        <br>
                        • Many ICO projects are serious, and deserve consideration <br>
                        • As the mechanism develops, VCs need to change their thinking <br>
                        • With regulatory acceptance, an ICO will be a very normal method of raising capital <br>
                        According to the report: “At a rate of 1,320%ROI,
                        ICOs beat out even bitcoin’s prodigious rise over the last year.”
                    </p>
                </div>
            </div>
        </div>
    </div>
    {{--    ipb pay end--}}

    <div class="screenshot-area cta3" style="background-color: #ffffff;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mt-5 wow fadeInLeftBig lg-height-500">
                    <div class="get-area-left">
                        <h2>The average performance of ICOs to
                            date has been noting short
                            of outstanding</h2>
                        <p>If one had blindly invested €10000 in every visible ICO, including number of ICOs that failed this would have delivered a *13.2x return</p>
                    </div>
                </div>
                <div class="col-lg-5 wow fadeInRightBig">
                    <div class="get-app-right" style="padding-top: 5rem;">
                        <img src="{{asset('assets/img/digital-fund/useless-graph.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="screenshot-area cta3">
        <div class="container">
            <div class="row">
                <div class="col-md-7 mt-5 wow fadeInLeftBig" style="height: 300px;">
                    <div class="get-area-left">
                        <h2>Token Sale Data</h2>
                        <p>The list of 100 ICO’s ranging from 2830% return to 100% return for ICO participants.</p>
                        <div class="row text-center">
                            <div class="col-md-3">
                                <a href="/token-sale-data" class="btn btn-warning">Learn more</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 wow fadeInRightBig">
                    <div class="get-app-right" style="padding-top: 1rem;right: 100px;">
                        <img height="300" src="{{asset('assets/img/digital-fund/man-on-coin.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="screenshot-area cta3 pt-2 pb-2" style="background-color: white;">
        <div class="container" style="padding-top: 50px;padding-bottom: 50px;">
            <div class="row">
                <div class="col-md-12">
                    <p class="pack-text">
                        “Traditional venture capital (VC) investment in blockchain and crypto firms has almost tripled in the first three quarters of 2018, according to a new Diar report published on September 30.
                        Diar cites data from Pitchbook that reveals blockchain and crypto-related firms have raised nearly $3.9 billion in VC capital. This $3.9 billion represents a 280 percent rise as compared with last year.”
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection