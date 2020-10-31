<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{url('/')}}">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="robots" content="index, follow">
    @yield('metas')

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0207C0FX3L"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-0207C0FX3L');
    </script>

    <!-- Bootstrap Core CSS -->
    <link href="end_user/css/bootstrap.css" rel='stylesheet' type='text/css'/>
    <!-- Custom CSS -->
    <link href="end_user/css/style.css" rel='stylesheet' type='text/css'/>
    <!-- Graph CSS -->
    <link href="end_user/css/font-awesome.css" rel="stylesheet">
    <!-- jQuery -->
    <!-- lined-icons -->
    <link rel="stylesheet" href="end_user/css/icon-font.css" type='text/css'/>
    <!-- //lined-icons -->
    <!-- Meters graphs -->
    <script src="end_user/js/jquery-2.1.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r73/three.min.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/175711/THREE.OrbitControls.js"></script>
    <link rel="stylesheet" type="text/css" media="all" href="end_user/css/audio.css">

    @yield('styles')

</head>
<!-- /w3layouts-agile -->
<body class="sticky-header left-side-collapsed">
<section>
    <div class="left-side sticky-left-side">
        <div class="logo">
            <h1><a href="index.html">Vietmix</a></h1>
        </div>
        <div class="logo-icon text-center">
            <a href="index.html">VM</a>
        </div>
        @include('endUser.layouts.side-bar')
    </div>

    <div class="main-content">
        @yield('content')
    </div>
    @include('endUser.layouts.footer')
</section>

<script src="end_user/js/jquery.nicescroll.js"></script>
<script src="end_user/js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="end_user/js/bootstrap.js"></script>
<script type="application/x-javascript"> addEventListener("load", function () {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
</script>
@yield('scripts')
</body>
</html>
