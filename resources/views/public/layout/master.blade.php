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

<!-- Album list Begin -->
@yield('content')

<!-- Album list End -->
@include('public.layout.footer')

@include('public.layout.partials.script')

@yield('scripts')
</body>
</html>
