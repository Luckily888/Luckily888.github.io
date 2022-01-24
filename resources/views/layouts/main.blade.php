<!DOCTYPE html>
<html lang="en">
<head>
    <title>IPB Pay @Phitech</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/scroll.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-152391197-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-152391197-1');
    </script>
</head>
<body class="theme-dark io-dark io-dark-light" data-spy="scroll" data-target="#mainnav" data-offset="80" style="height: 80vh;">
    <header class="site-header is-sticky">
        @include('layouts.navbar')
    </header>
    <!-- Page Wrapper -->
    <div id="wrapper" class="one">
    <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column" style="margin-top: 150px;">
            <!-- Main Content -->
            <div id="content">
            <!-- Begin Page Content -->
                <div class="container">
                    @yield('content')
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
