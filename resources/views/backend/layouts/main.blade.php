<!DOCTYPE html>
<html lang="en">

<head>
    <title>IPB Pay @Phitech</title>
    @include('backend.layouts.head')
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-152391197-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-152391197-1');
    </script>

</head>

<body id="page-top" onload="checkDarkMode()">

<!-- Page Wrapper -->
<div id="wrapper">

@include('backend.layouts.sidebar')

<!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

        @include('backend.layouts.navbar')

        <!-- Begin Page Content -->
            <div class="container-fluid" >

                @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        @include('backend.layouts.footer')

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

@include('backend.layouts.js')

@yield('script')

</body>

</html>
