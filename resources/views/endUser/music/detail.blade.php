<?php
use Illuminate\Support\Facades\URL;
?>
@extends('endUser.layouts.application')

@section('title') {{$song->title}}] @endsection
@section('metas')
    <meta property="og:url"                content="{{URL::current()}}" />
    <meta property="og:type"               content="article" />
    <meta property='article:published_time' content='2020-10-15T20:30:11-02:00' />
    <meta property="og:title"              content="{{$song->title}}" />
    <meta property="og:description"        content="{{$song->description}}" />
    <meta property="og:image"              content="{{$song->image}}" />
    <meta property="og:image:url"           content="{{$song->image}}" />
    <meta property="og:site_name"           content="Vietmix.vn" />
    <meta name="description"                content="{{$song->description}}">
    <meta name="keywords"                   content="{{$song->keyword}}">
    <meta name="author"                     content="{{$song->author}}">
    <meta name="twitter:card"               content="summary" />
    <meta name="twitter:title"              content="{{$song->title}}" />
    <meta name="twitter:site"               content="Vietmix.vn" />
@endsection
@section('styles')
    <style>
        canvas{
            background-repeat: no-repeat;
            {{--background-image: url('{{$bg}}');--}}
            background-size: cover;
            width: 100%;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
        }
    </style>
@endsection

@section('content')

    <div id="page-wrapper">
        <div class="inner-content">
            <div class="music-left">
                <!--banner-section-->
                <div class="banner-section">
                    <div class="banner">
                        <div class="callbacks_container">
                            <canvas id='canvas' width="1000" height="400"></canvas>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div style="background: #f1f3f4; height: 50px;">
                    <audio autoplay="" id="audio_xx" loop controlsList="nodownload" crossorigin="anonymous" controls="" style="width:100%; height: 100%">
                        <source src="{{$urlAudio}}" type="audio/mpeg">
                    </audio>
                </div>
                <div id="info-song" style="padding-top: 10px">
                    <?php
                        $argKeyword = explode(',', $song->keyword);
                    ?>
                    <div class="tag" style="padding: 10px; color: #ffffff">
                        <i class="fa fa-info" style="padding-bottom: 10px;"> Thông tin</i>
                        <p style="padding-left: 10px">{{$song->description}}</p>
                    </div>

                    <div class="tag" style="padding: 10px; color: #ffffff">
                        <i class="fa fa-tags" style="padding-bottom: 10px;"> Tags</i>
                        <ul style="padding-left: 10px">
                            @foreach($argKeyword as $tag)
                                <li style="list-style: none; display: inline-block; background-color: #0b7054; border-radius: 5px">
                                    <a style="text-decoration: none; padding: 10px; color: #FFFFFF" href="{{route('song.search', ['tag' => $tag])}}">{{trim($tag)}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
                <div class="song_list">
                    <ul>
                        <li style="list-style: none">
                            @if(count($randomSongs) > 0)
                                <ul class="show-songs">
                                    @foreach($randomSongs as $key => $song)
                                        <li>
                                            <a href="{{route('song.detail', ['slug' => $song->slug])}}"
                                               class="song-title"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               title=" {{$song->title}}"
                                               style="width: 60%">
                                                {{$song->title}}
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
                    <h2 style="color: #ffffff">Remix liên quan</h2>
                    <ul>
                        @foreach($songs as $song)
                            <li>
                                <img class="icon-song" src="{{$song->image}}" alt="">
                                <a class="song-detail"
                                   data-toggle="tooltip"
                                   data-placement="top"
                                   title=" {{$song->title}}"
                                   href="{{route('song.detail', ['slug' => $song->slug])}}">
                                    <span class="song-name">{{$song->title}}</span>
                                </a>
                                <span class="song-author"> {{$song->author}}
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
