<div class="navbar navbar-expand-lg is-transparent fixed-top" style="{{ isset($phone) ? 'background-color: whitesmoke;':'' }}" id="mainnav">
    <nav class="row w-100 mt-3">
        <div class="col-lg-6 col-md-8" align="left">
            <a class="navbar-brand" href="/" style="padding-bottom: 0px; padding-right: 0px; padding-left: 5%;">
                <img class="logo logo-dark " alt="logo" height="60" style="height: 60px;" src="landing/assets/images/paylogo.svg">
            </a>
        </div>
        <div class="col-lg-6 col-md-4" align="right">
            <div class="row" style="float:right">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flag-icon flag-icon-@lang('menu.flag')"> </span> @lang('menu.lang-switch')</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown09" style="background-color: gray;">
                            @foreach(array_diff_key(config('app.locales'),[ App::getLocale()=>1 ]) as $key=>$name)
                                <a class="dropdown-item lang-select" href="javascript:;" data-lang="{{$key}}">
                                    <span class="flag-icon flag-icon-{{ config('app.flags')[$key] }}"> </span>
                                    {{$name}}
                                </a>
                            @endforeach
                        </div>
                    </li>
                </ul>
                <a class="nav-link menu-link" href="/tutorial" style="color: black">@lang('landing.tutorials')</a>
                <a class="btn btn-outline-dark ml-3" href="/login" >@lang('menu.login')</a>
                <a class="btn btn-outline-dark ml-3" href="/register">@lang('menu.signup')</a>
            </div>
        </div>
    </nav>
</div>

<div id="registerModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Register</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form method="post" action="/register">
                    @csrf
                    <div id="result" class="alert alert-success text-center" style="display: none;"> User Registered! <i class="fa fa-refresh fa-spin"></i> Entering...</div>
                    <div class="form-group has-feedback ">
                        <input type="text" placeholder="Full Name" name="name" class="form-control"> <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <!---->
                        {{--#f9f976 0%, #f9d29d 100--}}
                    </div>
                    <div class="form-group has-feedback">
                        <input type="email" placeholder="Email" name="email"  class="form-control"> <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        <!---->
                    </div>
                    <div class="form-group has-feedback ">
                        <input type="text" placeholder="Phone" name="phone" class="form-control"> <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                        <!---->
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" placeholder="Password" name="password" value="" class="form-control"> <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <!---->
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" placeholder="Retype password" value="" name="password_confirmation" class="form-control">
                        <input type="hidden"  value="1" name="permission" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="terms"> <a href="#" class="" data-toggle="modal" data-target="#termsModal">Terms and conditions</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 captcha-box">
                            <div name="recaptcha" class="g-recaptcha recaptcha-otr ">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn-blue-theme btn-primary btn-block">Register</button>
{{--                            <a href="{{route('oauth_social','google')}}" class="btn-blue-theme btn-primary btn-block btn-social btn-google">Sign Up With Google</a>--}}
                        </div>
                        <div class="col-md-12">
                            <p style="margin-top: 15px;"> <a class="link pull-right" href="{{ url('/login') }}">Already have account?</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="loginModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Register</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form method="post" action="/register">
                    @csrf
                    <div id="result" class="alert alert-success text-center" style="display: none;"> User Registered! <i class="fa fa-refresh fa-spin"></i> Entering...</div>
                    <div class="form-group has-feedback ">
                        <input type="text" placeholder="Full Name" name="name"  autofocus="autofocus" class="form-control"> <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <!---->
                        {{--#f9f976 0%, #f9d29d 100--}}
                    </div>
                    <div class="form-group has-feedback">
                        <input type="email" placeholder="Email" name="email"  class="form-control"> <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        <!---->
                    </div>
                    <div class="form-group has-feedback ">
                        <input type="text" placeholder="Phone" name="phone" autofocus="autofocus" class="form-control"> <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                        <!---->
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" placeholder="Password" name="password" value="" class="form-control"> <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <!---->
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" placeholder="Retype password" value="" name="password_confirmation" class="form-control">
                        <input type="hidden"  value="1" name="permission" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="terms"> <a href="#" class="" data-toggle="modal" data-target="#termsModal">Terms and conditions</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 captcha-box">
                            <div name="recaptcha" class="g-recaptcha recaptcha-otr ">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn-blue-theme btn-primary btn-block">Register</button>
                            {{--                            <a href="{{route('oauth_social','google')}}" class="btn-blue-theme btn-primary btn-block btn-social btn-google">Sign Up With Google</a>--}}
                        </div>
                        <div class="col-md-12">
                            <p style="margin-top: 15px;"> <a class="link pull-right" href="{{ url('/login') }}">Already have account?</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="Terms and conditions" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Terms and conditions</h3>
            </div>

            <div class="modal-body" style="color: black">
                <p>Lorem ipsum dolor sit amet, veniam numquam has te. No suas nonumes recusabo mea, est ut graeci definitiones. His ne melius vituperata scriptorem, cum paulo copiosae conclusionemque at. Facer inermis ius in, ad brute nominati referrentur vis. Dicat erant sit ex. Phaedrum imperdiet scribentur vix no, ad latine similique forensibus vel.</p>
                <p>Dolore populo vivendum vis eu, mei quaestio liberavisse ex. Electram necessitatibus ut vel, quo at probatus oportere, molestie conclusionemque pri cu. Brute augue tincidunt vim id, ne munere fierent rationibus mei. Ut pro volutpat praesent qualisque, an iisque scripta intellegebat eam.</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
