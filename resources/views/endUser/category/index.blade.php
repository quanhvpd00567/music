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
                <div class="song_list">
                    <ul>
                        <li style="list-style: none">
                            <h2>
                                <a href="{{route('category.detail', ['slug' => \App\Http\Helpers\Helper::createUrlCategory($category)])}}">{{$category->name}}</a>
                            </h2>
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
                <div class="mix-pagination" style="width: 100%">
                    {{ $songs->links() }}
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
                                <a class="song-detail"
                                   data-toggle="tooltip"
                                   data-placement="top"
                                   title=" {{$song->name}}"
                                   href="{{route('song.detail', ['slug' => Helper::createUrlSong($song)])}}">
                                    <img class="icon-song" src="https://www.remixviet.net/data/upload/icon/1589273690.jpg" alt="">
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
            <div class="clearfix"></div>
        </div>
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
