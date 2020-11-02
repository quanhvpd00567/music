@extends('endUser.layouts.application')
<?php
//use Helper;
?>
@section('content')
    <div id="page-wrapper">
        <div class="inner-content">
            <div class="music-left">
                <div class="song_list">
                    <ul>
                        <li style="list-style: none">
                            <h2>
                                <a href="{{route('category.detail', ['slug' => \App\Http\Helpers\Helper::createUrlCategory($category)])}}">{{$category->name}}</a>
                            </h2>
                        @if(count($songs) > 0)
                            <ul class="show-songs">
                                @foreach($songs as $key => $song)
                                    <li>
                                        <a href="{{route('song.detail', ['slug' => $song->slug])}}"
                                           class="song-title"
                                           data-toggle="tooltip"
                                           data-placement="top"
                                           title=" {{$song->title}}"
                                           style="width: 60%">
                                            {{$song->title}}
                                        </a>
                                        <span class="song-listen"  style="float: right">
                                            <i class="fa fa-headphones" aria-hidden="true"></i>
                                            {{number_format($song->view)}}
                                        </span>
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
                                   title="{{$song->title}}"
                                   href="{{route('song.detail', ['slug' => $song->slug])}}">
                                    <img class="icon-song" src="{{$song->image}}" alt="{{$song->title}}">
                                    <span class="song-name">{{$song->title}}</span>
                                </a>
                                <span class="song-author">{{$song->author}}
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
