@extends('public.layout.master')
@section('title') Nhạc Remix | vietmix.vn @endsection
@section('metas')
    @include('public.layout.partials.meta-default')
@endsection
@section('content')
    <section class="album-list-wrap">
        <div class="container">
            @foreach($categories as $category)
                <div class="col-md-3 col-sm-3 album-card-wrap">
                <div class="album-card">
                    <div class="image hoverdir-target">
                        <img src="{{$category->image}}" alt="{{$category->name}}">
                        <div class="overlay">
                            <div class="buy-wrapper">
                                <div class="buy">
                                    <a class="link" href="{{route('category.detail', ['slug' => $category->slug])}}">
                                        <span><i class="fa fa-headphones"></i> <br/> Nghe ngay</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text">
                        <a href="{{route('category.detail', ['slug' => $category->slug])}}"><div class="title"><h4>{{$category->name}}</h4></div></a>
                        <div class="tracks"><span><i class="fa fa-music"></i> {{$category->songs_count}}</span></div>
                    </div>
                </div><!-- /.album-card -->
            </div><!-- /.album-card-wrap -->
            @endforeach
        </div><!--/.container -->
        <div class="container">
            <div class="">
                <ul class="item-song">
                    @foreach($songs as $song)
                        <li class="list-item">
                            <div>
                                <a href="{{route('song.detail', ['slug' => $song->slug])}}" class="text" tabindex="0">
                                    {{--                                <img src="{{$song->image}}" alt="">--}}
                                    {{$song->title}}
                                </a>
                                @if(false)
                                    <span class="vm-gr-megdia" style="float: right;">
                                <span class="media-item">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                </span>
                                <span class="media-item loved">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                </span>
                                <span class="media-item">
                                    <i class="fa fa-headphones" aria-hidden="true"></i>
                                </span>
                            </span>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
@endsection
