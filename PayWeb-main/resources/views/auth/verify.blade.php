<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
</head>

<body id="login">
<header class="site-header is-sticky">
    <div class="navbar navbar-expand-lg is-transparent fixed-top" style="{{ isset($phone) ? 'background-color: whitesmoke;':'' }}" id="mainnav">
        <nav class="row w-100 mt-3">
            <div class="col-lg-6 col-md-8" align="left">
                <a class="navbar-brand" href="/" style="padding-bottom: 0px; padding-right: 0px; padding-left: 5%;">
                    <img class="logo logo-dark " alt="logo" height="60" style="height: 60px;" src="/landing/assets/images/paylogo.svg">
                </a>
            </div>
            <div class="col-lg-6 col-md-4" align="right">

                <div class="row" style="float:right">
                    <a href="{{ route('logout') }}"class="btn btn-outline-dark ml-3" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </nav>
    </div>
</header>
<!-- Page Wrapper -->
<div id="wrapper vh-100">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <div class="container">
                    <div class="row justify-content-center p-5">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                                <div class="card-body">
                                    @if (session('resent'))
                                        <div class="alert alert-success" role="alert">
                                            {{ __('A fresh verification link has been sent to your email address.') }}
                                        </div>
                                    @endif

                                    {{ __('Before proceeding, please check your email for a verification link.') }}
                                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                                </div>
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
<!-- End of Page Wrapper -->
@include('layouts.js')

</body>

</html>
