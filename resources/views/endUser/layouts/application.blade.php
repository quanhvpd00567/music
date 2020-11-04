<!DOCTYPE HTML>
<html>
<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{url('/')}}">
{{--    <link color='#0069ff' href='/mask_icon.svg' rel='mask-icon'>--}}
    <link href='/end_user/images/favicon.ico' rel='shortcut icon' type='image/ico'>
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
<body class="sticky-header">
    <section>
        <div class="left-side sticky-left-side">
            <div class="logo">
                <h1><a href="/">Vietmix.vn</a></h1>
            </div>
            @include('endUser.layouts.side-bar')
        </div>
        <div class="main-content">
            <div class="header-section">
                <a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
                @include('endUser.layouts.header')
                <div class="clearfix"></div>
            </div>
            @yield('content')
        </div>
        @include('endUser.layouts.footer')
    </section>

    <!-- Modal -->
    @if(!auth()->check())
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Bạn chưa đăng nhập</h4>
                </div>
                <div class="modal-body ">
                    <p style="padding-bottom: 10px">Bạn phải đăng nhập mới có thể đăng bài hát</p>

                    <div class="text-center">
                        <a class="btn btn-success text-center" style="width: 50%; margin-bottom: 10px" href="{{route('login')}}">
                            <i class="fa fa-mail-forward"> Đăng nhập bằng email</i>
                        </a>
                        <a class="btn btn-primary" style="width: 50%; margin-bottom: 10px" href="{{route('socialite_login', ['provider' => 'facebook'])}}">
                            <i class="fa fa-facebook"> Đăng nhập bằng facebook</i>
                        </a>
                        <a class="btn btn-primary" style="width: 50%" href="#">
                            <i class="fa fa-user"> Đăng ký</i>
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endif


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
    @if(!auth()->check())
        <script>
            $(function () {
                $('#showModalConfirm').on('click', function () {
                    $('#myModal').modal('show')
                })
            })
        </script>
    @endif
@yield('scripts')
</body>
</html>
