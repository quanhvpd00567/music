<?php
?>



<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.suavedigital.com/jukebox/album-4columns.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 04 Nov 2020 15:22:08 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Jukebox - Responsive Music and Band Website Template">
    <link rel="icon" href="/vietmix/images/favicon.png">
    <base href="{{url('/')}}">
    <title>@yield('title')</title>
    @yield('metas')
    @include('public.layout.partials.style')
</head>
<body>
@include('public.layout.partials.loading')

<!-- Navbar Begin -->
@include('public.layout.header')
<!-- Navbar End -->


@if(!isset($isShowBanner))
    <!-- Banner Title Begin -->
    <section class="banner-title album-banner">
        <div class="overlay"></div>
        <div class="container content">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="main-title">
                    <h1>
                        Album List
                        <span class="light"> 4 Columns</span>
                    </h1>
                    <div class="text-wrap">
                        <div class="text">Your custom text here.</div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/.banner -->
    <!-- Banner Title End -->
@endif

<!-- Album list Begin -->
@yield('content')

<!-- Album list End -->
@include('public.layout.footer')

@if(!auth()->check())
    <div class="modal fade" id="popupConfirmUpload" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Bạn chưa đăng nhập</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Bạn phải đăng nhập mới có thể đăng bài hát</p>
                        </div>
                        <div class="col-md-12" style="padding-top: 10px">
                            <a href="{{route('login')}}" class="btn btn-primary btn-login">Đăng nhập</a>
                            <a class="btn facebook-btn btn-block" style="color: white; background-color: #1877f2" href="{{route('socialite_login', ['provider' => 'facebook'])}}" >
                                <i class="fa fa-facebook"></i> Login with facebook
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endif

@include('public.layout.partials.script')

@yield('scripts')
<script>
    $(function () {
        $('#upload-song').on('click', function () {
            $('#popupConfirmUpload').modal('show')
        })
    })
</script>
</body>
</html>
