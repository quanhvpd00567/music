@extends('endUser.layouts.application')
<?php
use Illuminate\Support\Facades\URL;
?>
@section('metas')
    <meta property="og:url"                content="{{URL::current()}}" />
    <meta property="og:type"               content="article" />
    <meta property='article:published_time' content='2020-10-15T20:30:11-02:00' />
    <meta property="og:title"              content="vietmix.vn" />
    <meta property="og:description"        content="Tải Nhạc DJ Remix, Nghe Nhạc Trẻ DJ Remix 2020, Download Nhạc DJ Music MP3, Tải Nhạc Nonstop Vinahouse 2020, Music Song, Music Edm, Nonstop Mp3,DJ Song, Remix DJ, Nonstop Vinahouse, Remixviet New Update - Tai Nhac DJ, Tai Nhac Nonstop Vinahouse 2020 2020 cập nhật mới nhất . Nhạc sàn online 2020, Nghe nhạc sàn miễn phí trên điện thoại, iphone, mobile, android, windows phone, nghe & tải nhạc mp3 chất lượng cao.Tải downd nhạc mp3 chất lượng cao 320 kb. " />
{{--    <meta property="og:image"              content="{{$song->image}}" />--}}
{{--    <meta property="og:image:url"           content="{{$song->image}}" />--}}
    <meta property="og:site_name"           content="Vietmix.vn" />
    <meta name="description"                content="Tải Nhạc DJ Remix, Nghe Nhạc Trẻ DJ Remix 2020, Download Nhạc DJ Music MP3, Tải Nhạc Nonstop Vinahouse 2020, Music Song, Music Edm, Nonstop Mp3,DJ Song, Remix DJ, Nonstop Vinahouse, Remixviet New Update - Tai Nhac DJ, Tai Nhac Nonstop Vinahouse 2020 2020 cập nhật mới nhất . Nhạc sàn online 2020, Nghe nhạc sàn miễn phí trên điện thoại, iphone, mobile, android, windows phone, nghe & tải nhạc mp3 chất lượng cao.Tải downd nhạc mp3 chất lượng cao 320 kb. " />
    <meta name="keywords"                   content="Nonstop, nonstop 2020, Nonstop mp3, Nonstop song, Nonstop mp3 download, Dj nonstop, NhacDJ.Vn, NhacDJ, Nhac DJ, Nonstop Việt Mix, Nhac Nonstop, Vinahouse 2020, Nhac San, Nonstop vinahouse, Nonstop vinahouse 2020, Nhạc Bay Phòng, Nhạc nonstop, Nhạc trẻ remix 2020, Nhạc trẻ 2020 remix, Nhạc trẻ remix 2020 hay nhất, Lk Nhạc Trẻ 2020, Nhạc Trẻ Hay Remix, Nhạc Trẻ Hay Nhất Remix, Nonstop Việt Mix, Viêt Mix. Remix Việt,
	Remix, Remix song, DJ remix, DJ, Remox 2020, DJ remix song, Nhạc Remix, Nhac Remix, Remix hay, Remix 2020, Nhac remix moi nhat 2020,Nonstop Việt Mix, Viêt Mix. Remix Việt, Remix, Remix song, DJ remix, DJ, Remox 2020, DJ remix song, Nhạc Remix, Nhac Remix, Remix hay, Remix 2020, Nhac remix moi nhat 2020,Electro house 2020, Electro house, Nhạc electro house , Deep house, Electro house music, Electro house mix, Edm, Best Edm, House Mix, Electro House Mix,  Electro mix, Dj electro house,
	House music electro, house music, Vina house, Dubstep song, Dubstep music, Dubstep remix, Best dubstep, Dubstep songs">
    <meta name="author"                     content="vietmix.vn">
    <meta name="twitter:card"               content="summary" />
    <meta name="twitter:title"              content="Vietmix.vn" />
    <meta name="twitter:site"               content="Vietmix.vn" />
@endsection
@section('content')
    <div class="header-section">
        <a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
        <div class="menu-right"></div>
        <div class="clearfix"></div>
    </div>
    <!-- //header-ends -->

    <div id="page-wrapper">
        <div class="inner-content">
            <div class="music-left">
                <!--banner-section-->
                <div class="banner-section"s>
                    <div class="banner">
                        <div class="callbacks_container">
                            <ul class="rslides callbacks callbacks1" id="slider4">
                                <li>
                                    @include('endUser.layouts.waves')
                                </li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="song_list">
                    <ul>
                        @foreach($categories as $category)
                            @if(count($category->songs) == 0)
                                @continue
                            @endif
                            <li style="list-style: none">
                                <h2>
                                    <a href="{{route('category.detail', ['slug' => \App\Http\Helpers\Helper::createUrlCategory($category)])}}">{{$category->name}}</a>
                                </h2>
                                <ul class="show-songs">
                                    @foreach($category->songs as $key => $song)
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
                                                    {{number_format($song->view)}}
                                                    <i class="fa fa-headphones" aria-hidden="true"></i>
                                                </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
            <!--/music-right-->
            <div class="music-right">
                <!--/video-main-->
                <div class="list-song">
                    <h2 style="color: #ffffff">Remix mới</h2>
                    <ul>
                        @foreach($songs as $song)
                            <li>
                                <a class="song-detail"
                                   data-toggle="tooltip"
                                   data-placement="top"
                                   title=" {{$song->title}}"
                                   href="{{route('song.detail', ['slug' => $song->slug])}}">
                                    <img class="icon-song" src="{{$song->image}}" alt="">
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
    <script src="end_user/js/wa.js"></script>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection
