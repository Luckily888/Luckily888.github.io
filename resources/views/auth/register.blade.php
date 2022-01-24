<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
</head>

<body id="login">

<!-- Page Wrapper -->
<div id="wrapper vh-100">
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
                                <form method="post" class="row">
                                    @if (session('status'))
                                        <div class="col-12">
                                            <div class="alert alert-{{ session('status')["class"]}} text-center"
                                                 role="alert">
                                                {{ session('status')["message"]}}
                                            </div>
                                        </div>
                                    @endif
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="form-group has-feedback col-lg-12">
                                        <input required type="text" placeholder="@lang('auth.name')" name="name" class="form-control">
                                    </div>
                                    <div class="form-group has-feedback col-lg-12">
                                        @csrf
                                        <input required type="email" placeholder="@lang('auth.email')" name="email" class="form-control"> <span
                                                class="glyphicon form-control-feedback glyphicon-envelope"></span>
                                        <!---->
                                    </div>
                                    <div class="form-group has-feedback col-lg-12">
                                        @csrf
                                        <input required type="text" placeholder="@lang('auth.phone')" name="phone" class="form-control"> <span
                                                class="glyphicon form-control-feedback glyphicon-envelope"></span>
                                        <!---->
                                    </div>
                                    <div class="form-group has-feedback col-lg-12">
                                        <input required type="password" placeholder="@lang('auth.password')" name="password"
                                               class="form-control"> <span
                                                class="glyphicon glyphicon-lock form-control-feedback"></span>
                                        <!---->
                                    </div>
                                    <div class="form-group has-feedback col-lg-12">
                                        <input required type="password" placeholder="@lang('auth.re-type-password')" value=""
                                               name="password_confirmation" class="form-control">
                                        <input type="hidden" value="1" name="permission" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <div>
                                            <div class="checkbox">
                                                <label>
                                                    <input required type="checkbox" name="terms"> <a href="#" class=""
                                                                                            data-toggle="modal"
                                                                                            data-target="#termsModal">@lang('auth.term')</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="termsModal" tabindex="-1" role="dialog"
                                         aria-labelledby="Terms and conditions" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">@lang('auth.term')</h3>
                                                </div>

                                                <div class="modal-body" style="color: black">
                                                    <p>Lorem ipsum dolor sit amet, veniam numquam has te. No suas
                                                        nonumes recusabo mea, est ut graeci definitiones. His ne melius
                                                        vituperata scriptorem, cum paulo copiosae conclusionemque at.
                                                        Facer inermis ius in, ad brute nominati referrentur vis. Dicat
                                                        erant sit ex. Phaedrum imperdiet scribentur vix no, ad latine
                                                        similique forensibus vel.</p>
                                                    <p>Dolore populo vivendum vis eu, mei quaestio liberavisse ex.
                                                        Electram necessitatibus ut vel, quo at probatus oportere,
                                                        molestie conclusionemque pri cu. Brute augue tincidunt vim id,
                                                        ne munere fierent rationibus mei. Ut pro volutpat praesent
                                                        qualisque, an iisque scripta intellegebat eam.</p>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                                                        OK
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback col-lg-12">
                                        <button type="submit" class="btn btn-success">
                                            @lang('auth.register')
                                        </button>
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
<!-- End of Page Wrapper -->
@include('layouts.js')

</body>

</html>
