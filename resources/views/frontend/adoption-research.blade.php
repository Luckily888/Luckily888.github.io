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
                        <h2>Adoption Research Development</h2>
                        <hr style="margin-left:0;width: 500px;">
                        <p style="margin-bottom: 50px;">Technology aligned with human design.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-2 text-center">
                    <img src="{{asset('assets/img/adoptionres/about1.png')}}" alt="">
                    <div class="about-single-content">
                        <p>CULTURAL & POLITICAL PARTICIPATION</p>
                    </div>
                </div>
                <div class="col-md-2 text-center">
                    <img src="{{asset('assets/img/adoptionres/about2.png')}}" alt="">
                    <div class="about-single-content">
                        <p>SEND - RECEIVE MONEY</p>
                    </div>
                </div>
                <div class="col-md-2 text-center">
                    <img src="{{asset('assets/img/adoptionres/about3.png')}}" alt="">
                    <div class="about-single-content">
                        <p>RAISE MONEY</p>
                    </div>
                </div>
                <div class="col-md-2 text-center">
                    <img src="{{asset('assets/img/adoptionres/about4.png')}}" alt="">
                    <div class="about-single-content">
                        <p>LOGISTIC</p>
                    </div>
                </div>
                <div class="col-md-2 text-center">
                    <img src="{{asset('assets/img/adoptionres/about5.png')}}" alt="">
                    <div class="about-single-content">
                        <p>CREATE GREAT JOBS</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  about area end -->
    {{--    vote & donate start--}}
    <div class="screenshot-area cta3" id="vote-and-donate">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mt-5 wow fadeInLeftBig lg-height-500">
                    <div class="get-area-left">
                        <p>Cultural & Political Participation</p>
                        <h1>Vote & Donate</h1>
                        <p class="pack-text">"Society impact system"</p>
                        <p class="pack-text">Approved KYC AML customers and organizations will have limited access to :</p>
                        <p class="pack-text">&middot; Blockchain Voting for approved petitions</p>
                        <p class="pack-text">&middot; Blockchain Donations to approved non-profits</p>
                    </div>
                </div>
                <div class="col-lg-5 wow fadeInRightBig">
                    <div class="get-app-right">
                        <img src="{{asset('assets/img/adoptionres/vote_donate.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    vote & donate end--}}
    {{--    ipb pay start--}}
    <div class="screenshot-area cta3" style="background-color: #ffffff;">
        <div class="sm-container">
            <div class="row" style="margin: 0;">
                <div class="col-lg-7 mt-5 mt-lg-0 wow fadeInLeftBig">
                    <div class="get-app-padding-right get-app-right-w100" >
                        <img src="{{asset('assets/img/adoptionres/ipbpay.png')}}" alt="">
                    </div>
                </div>
                <div class="col-lg-5 wow fadeInRightBig lg-height-500">
                    <div class="get-area-left">
                        <p>Send & Receive Money</p>
                        <h1>IPB Pay</h1>
                        <p class="pack-text">Transfer money using digital asset or crypto currency.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    ipb pay end--}}
    {{--    bank the unbanked start--}}
    <div class="screenshot-area cta3" style="padding-top: 50px; padding-bottom: 50px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>Send & Receive Money</p>
                    <h1>Bank the Unbanked</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 wow fadeInLeftBig">
                    <div class="">
                        <p>Business</p>
                        <p class="pack-text">thousands of great legal businesses that create jobs do not have banking as they are considered a risk for traditional old banking systems that do not have blockchain technology for trust and transparency. IPB blockchain solves this. IPB is here to support emerging business and innovation.</p>
                    </div>
                </div>
                <div class="col-md-6 wow fadeInRightBig">
                    <div class="get-app-right">
                        <p>Community</p>
                        <p class="pack-text">100’s of millions do not have basic banking in the world as the cost using old traditional banking technology is too expensive and slow. Join IPB and help us lift 100’s of millions out of poverty by providing them with the basic ability to receive money for work, pay for utilities, food, education and become active in our world community.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    bank the unbanked end--}}
    {{--    crowdfunding start--}}
    <div class="screenshot-area cta3" style="background-color: white;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mt-5 wow fadeInLeftBig lg-height-500">
                    <div class="get-area-left">
                        <p>Raise Money</p>
                        <h1>Crowdfunding</h1>
                        <p class="pack-text">Crowdfunding let you help people create their dreams and bring innovation to our life.</p>
                        <p class="pack-text">Crowdfund:</p>
                        <div class="row">
                            <div class="col-md-6"><p class="pack-text">&middot; Music</p></div>
                            <div class="col-md-6"><p class="pack-text">&middot; Life Extension</p></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><p class="pack-text">&middot; Movies</p></div>
                            <div class="col-md-6"><p class="pack-text">&middot; Innovation</p></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><p class="pack-text">&middot; TV Series</p></div>
                            <div class="col-md-6"><p class="pack-text">&middot; Engineering</p></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><p class="pack-text">&middot; Games</p></div>
                            <div class="col-md-6"><p class="pack-text">&middot; Apps</p></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><p class="pack-text">&middot; Dance</p></div>
                            <div class="col-md-6"><p class="pack-text">&middot; Medical</p></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><p class="pack-text">&middot; Books</p></div>
                            <div class="col-md-6"><p class="pack-text">&middot; Lifestyle events</p></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 wow fadeInRightBig">
                    <div class="get-app-right">
                        <img src="{{asset('assets/img/adoptionres/crowdfunding.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    crowdfunding end--}}
    {{--    ipb eagle start--}}
    <div class="screenshot-area cta3">
        <div class="sm-container">
            <div class="row" style="margin: 0;">
                <div class="col-lg-7 mt-5 mt-lg-0 wow fadeInLeftBig">
                    <div class="get-app-padding-right get-app-right-w100">
                        <img src="{{asset('assets/img/adoptionres/ipbeagle.png')}}" alt="">
                    </div>
                </div>
                <div class="col-lg-5 wow fadeInRightBig lg-height-500">
                    <div class="get-area-left">
                        <p>Logistic</p>
                        <h1>IPB Eagle</h1>
                        <p>IPB Eagle Logistic includes Food delivery, Domestic and International delivery, care share and cash delivery.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    ipb eagle end--}}
    {{--    ipb university games start--}}
    <div class="screenshot-area cta3" style="background-color: #ffffff;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mt-5 wow fadeInLeftBig lg-height-500">
                    <div class="get-area-left">
                        <p>IPB challenge</p>
                        <h1>IPB University Games</h1>
                        <p>University teams complete using their problem solving skills
                        and IPB blockchain, drones, AI to navigate and exciting
                        obstacle course. The obstacle course represents our modern
                        cities and the tasks are designed to share how tchnology can
                        improve the quality and efficiency of our lives.</p>
                    </div>
                </div>
                <div class="col-lg-5 wow fadeInRightBig">
                    <div class="get-app-right" style="padding-top: 5rem;">
                        <img src="{{asset('assets/img/adoptionres/unigames.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    ipb university games end--}}
    {{--    safety and security start--}}
    <div class="screenshot-area cta3">
        <div class="sm-container">
            <div class="row" style="margin: 0;">
                <div class="col-lg-7 mt-5 mt-lg-0 wow fadeInLeftBig">
                    <div class="get-app-padding-right get-app-right-w100">
                        <img style="max-width: 90%;" src="{{asset('assets/img/adoptionres/safety.png')}}" alt="">
                    </div>
                </div>
                <div class="col-lg-5 wow fadeInRightBig lg-height-500">
                    <div class="get-area-left">
                        <p>Emergency</p>
                        <h1>Safety and Security</h1>
                        <p>IPB emergency function allows the community to actively assist in
                        the aid of community members. Also interact with government authorities to
                        render help and assistance to those in distress.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    safety and security end--}}
    {{--    create great jobs start--}}
    <div class="screenshot-area cta3" style="background-color: #ffffff;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mt-5 wow fadeInLeftBig lg-height-500">
                    <div class="get-area-left">
                        <p>Jobs</p>
                        <h1>Create Great Jobs</h1>
                        <p>We have through blockchain the ability for technology to take over
                        excessive labor and repetition. Technology aligned with human design places
                            human quality of life in the center of creation. Innovation, testing,
                            design, management are the new growth areas for jobs. The evolution of
                            technologies gives more purpose to our lives and work. The success of your work adds
                            to the quality of your overall life experience. Quality of life leads to finding
                            purpose and life extension.
                        </p>
                    </div>
                </div>
                <div class="col-lg-5 wow fadeInRightBig">
                    <div class="get-app-right" style="padding-top:50px;">
                        <img src="{{asset('assets/img/adoptionres/createjob.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    create great jobs end--}}
@endsection