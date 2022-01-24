<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
</head>

<body id="login">

<!-- Page Wrapper -->
<div id="wrapper" class="vh-100">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <div class="container">
                    <div class="login-box">
                        <div class="row justify-content-center p-5">
                            <div class="col-lg-6 mb-sm-4" align="center">
                                <img src="{{asset('landing/assets/images/paymentlogo.svg')}}" style="height: 200px;">
                            </div>
                            <div class="col-lg-6">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="post">
                                    <div id="result" class="alert alert-success text-center" style="display: none;"> Logged in! <i class="fa fa-refresh fa-spin"></i> Entering...</div>
                                    <div class="form-group has-feedback">
                                        @csrf
                                        <input type="email" placeholder="@lang('auth.email')" name="email" autofocus="autofocus" class="form-control"> <span class="glyphicon form-control-feedback glyphicon-envelope"></span>
                                        <!---->
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input type="password" placeholder="@lang('auth.password')" name="password" class="form-control"> <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                        <!---->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="remember"> @lang('auth.remember-me')
                                                    </label>
                                                </div>
                                                <div>
                                                    <a href="/register">@lang('auth.dont-have-account')</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                           <button class="btn btn-success">@lang('menu.login')</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->


    </div>
    <!-- End of Content Wrapper -->

</div>

</body>

</html>
