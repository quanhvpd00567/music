@extends('public.layout.master')
@section('title') Nhạc Remix | vietmix.vn @endsection
@section('metas')
    @include('public.layout.partials.meta-default')
@endsection
@section('content')
    <section class="album-list-wrap">
        <div class="container">
            @if(count($songs) > 0)
            <div class="">
                <ul class="item-song">
                    @foreach($songs as $song)
                        <li class="list-item">
                            <div>
                                <a href="{{route('song.detail', ['slug' => $song->slug])}}" class="text" tabindex="0">{{$song->title}}</a>
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
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            @else
                <div class="text-center">
                    <h3>Không có bài hát nào</h3>
                </div>
            @endif
            @if(count($songs) > 0)
                {{ $songs->links('public.layout.partials.pagination') }}
            @endif
        </div><!--/.container -->
    </section>
@endsection
