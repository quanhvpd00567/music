<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Framer manager - @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    {{--    <link rel="apple-touch-icon" href="pages/ico/60.png">--}}
    {{--    <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">--}}
    {{--    <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">--}}
    {{--    <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">--}}
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    @include('admin.layouts.styles')
    @yield('styles')
</head>
<body class="fixed-header">
<div id="loading-ajax">
    <div class="progress-circle-indeterminate"></div>
</div>
<!-- BEGIN SIDEBAR-->
@include('admin.layouts.nav')
<!-- END SIDEBAR -->
<!-- START PAGE-CONTAINER -->
<div class="page-container">
    <!-- START HEADER -->
@include('admin.layouts.header')
<!-- END HEADER -->
    <!-- START PAGE CONTENT WRAPPER -->
    <div class="page-content-wrapper">
        <!-- START PAGE CONTENT -->
        <div class="content">
            <!-- START JUMBOTRON -->

        @yield('content')
        <!-- END JUMBOTRON -->
        </div>
        <!-- END PAGE CONTENT -->
        <!-- START FOOTER -->
        <div class="container-fluid container-fixed-lg footer">
            <div class="copyright sm-text-center">
                <p class="small no-margin pull-left sm-pull-reset">
                    <span class="hint-text">Copyright © 2014</span>
                    <span class="font-montserrat">REVOX</span>.
                    <span class="hint-text">All rights reserved.</span>
                    <span class="sm-block"><a href="#" class="m-l-10 m-r-10">Terms of use</a> | <a href="#" class="m-l-10">Privacy Policy</a>
                        </span>
                </p>
                <p class="small no-margin pull-right sm-pull-reset">
                    <a href="#">Hand-crafted</a>
                    <span class="hint-text">&amp; Made with Love ®</span>
                </p>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- END FOOTER -->
    </div>
    <!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE CONTAINER -->

<!-- BEGIN JS -->
@yield('modals')
@include('admin.layouts.javascript')
<script>
    function showNotification(options) {
        const returnedTarget = Object.assign({style: 'flip', timeout: 4000}, options);
        $('body').pgNotification(returnedTarget).show();
    }
</script>
@yield('scripts')

<!-- END JS -->
</body>
</html>
