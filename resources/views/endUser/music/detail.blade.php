@extends('endUser.layouts.application')

@section('title') Vietx Mix @endsection

@section('styles')
    <style>
        canvas{
            background-repeat: no-repeat;
            background-image: url('{{$bg}}');
            background-size: cover;
            width: 100%;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
        }

        .addAnimation {
            animation: shake 2s;
            animation-iteration-count: infinite;
        }

        /*#mix-player{*/
        /*    background-image: url('end_user/images/bg-play.png')*/
        /*}*/

        @keyframes shake {
            0% {
                transform: translate(1px, 1px) rotate(0deg) scale(1,1);
            }
            10% { transform: translate(-1px, -2px) rotate(-1deg) scale(1,1); }
            20% { transform: translate(-3px, 0px) rotate(1deg) scale(1,1); }
            30% { transform: translate(3px, 2px) rotate(0deg) scale(1,1); }
            40% { transform: translate(1px, -1px) rotate(1deg) scale(1,1); }
            50% { transform: translate(-1px, 2px) rotate(-1deg) scale(1,1); }
            60% { transform: translate(-3px, 1px) rotate(0deg) scale(1,1); }
            70% { transform: translate(3px, 1px) rotate(-1deg) scale(1,1); }
            80% { transform: translate(-1px, -1px) rotate(1deg) scale(1,1); }
            90% { transform: translate(1px, 2px) rotate(0deg) scale(1,1); }
            100% { transform: translate(1px, -2px) rotate(-1deg) scale(1,1); }
        }
    </style>
@endsection

@section('content')
    <!-- header-starts -->
    <div class="header-section">
        <!--toggle button start-->
        <a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
        <!--toggle button end-->
        <!--notification menu start -->
        <div class="menu-right">

        </div>
        <div class="clearfix"></div>
    </div>
    <!-- //header-ends -->

    <div id="page-wrapper">
        <div class="inner-content">
            <div class="music-left">
                <!--banner-section-->
                <div class="banner-section">
                    <div class="banner">
                        <div class="callbacks_container">
                            <canvas id='canvas' width="1000" height="600"></canvas>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div style="background: #f1f3f4; height: 50px;">
                    <audio autoplay="" id="audio_xx" crossorigin="anonymous" controls="" style="width:100%; height: 100%">
                        <source src="https://ewr1.vultrobjects.com/hoangquan94/vietmix/vietmix_36165302_a01a_4cb6_b869_3855ad6ea672.mp3" type="audio/mpeg">
                    </audio>
                </div>
                <div class="song_list">
                    <ul>
                        <li style="list-style: none">
                            @if(count($songs) == 0)
                                <p class="text-center">Data nor found</p>
                            @else
                                <ul class="show-songs">
                                    @foreach($songs as $key => $song)
                                        <li>
                                            <a href="{{route('song.detail', ['slug' => \App\Http\Helpers\Helper::createUrlSong($song)])}}"
                                               class="song-title"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               title=" {{$song->name}}"
                                               style="width: 60%">
                                                {{$song->name}}
                                            </a>
                                            <a class="song-listen" href="javascript:void(0)" style="width: 38%">
                                            <span style="float: right">
                                                <i class="fa fa-headphones" aria-hidden="true"></i>
                                                {{number_format($song->view)}}
                                            </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
            <!--//music-left-->
            <!--/music-right-->
            <div class="music-right">
                <!--/video-main-->
                <div class="list-song">
                    <h2 style="color: #ffffff">Remix mới</h2>
                    <ul>
                        @foreach($songsNew as $song)
                            <li>
                                <img class="icon-song" src="{{$song->image}}" alt="">
                                <a class="song-detail"
                                   data-toggle="tooltip"
                                   data-placement="top"
                                   title=" {{$song->name}}"
                                   href="{{route('song.detail', ['slug' => Helper::createUrlSong($song)])}}">
                                    <span class="song-name">{{$song->name}}</span>
                                </a>
                                <span class="song-author"> Vietmix.vn
                                <i class="fa fa-headphones" style="padding-left: 20px" aria-hidden="true"></i>
                                {{number_format($song->view)}}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!--//music-right-->
            <div class="clearfix"></div>
            <!-- /w3l-agile-its -->
        </div>
        <!--body wrapper start-->
    </div>

    <div class="clearfix"></div>
@endsection

@section('scripts')
    <script>


    </script>
{{--    <script>--}}
{{--        let urlAudio = '{{$urlAudio}}'--}}
{{--    </script>--}}
{{--    <script type="text/javascript" src="end_user/js/jquery.jplayer.js"></script>--}}
    <script type="text/javascript" src="end_user/js/audio-animation2.js"></script>
{{--    <link href="end_user/css/jplayer.blue.monday.min.css" rel="stylesheet" type="text/css">--}}

@endsection
