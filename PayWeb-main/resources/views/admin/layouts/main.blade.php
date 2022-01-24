<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @include('admin.layouts.head')

</head>

<body id="page-top" onload="checkDarkMode()">

<!-- Page Wrapper -->
<div id="wrapper">

@include('admin.layouts.sidebar')

<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

        @include('admin.layouts.navbar')

        <!-- Begin Page Content -->
            <div class="container-fluid">
                @if (session('status'))
                    <div class="row">
                        <div class="alert alert-{{ session('status')["class"]}} col-12 text-center" role="alert">
                            {{ session('status')["message"]}}
                        </div>
                    </div>
                @endif
                @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        @include('admin.layouts.footer')

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

@include('admin.layouts.js')

</body>

</html>
