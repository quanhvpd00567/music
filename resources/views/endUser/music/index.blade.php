@extends('endUser.layouts.application')
<?php
//use Helper;
?>
@section('content')
    <!-- header-starts -->
    <div class="header-section">
        <!--toggle button start-->
        <a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
        <!--toggle button end-->
        <!--notification menu start -->
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
            <!--//music-left-->
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
                                    <img class="icon-song" src="https://www.remixviet.net/data/upload/icon/1589273690.jpg" alt="">
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
