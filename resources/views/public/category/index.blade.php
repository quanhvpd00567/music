@extends('public.layout.master')
@section('title') {{$category->name}} | vietmix.vn @endsection
@section('metas')
    @include('public.layout.partials.meta-default')
@endsection
@section('content')
    <section class="album-list-wrap">
        <div class="container">
            <h2 class="text-center title-category">{{$category->name}}</h2>
            <div class="">
                <ul class="item-song">
                    @foreach($songs as $song)
                    <li class="list-item">
                        <div>
                            <a href="{{route('song.detail', ['slug' => $song->slug])}}" class="text" tabindex="0">
                                <img src="{{$song->img}}" alt="">
                                {{$song->title}}
                            </a>
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
            @if(count($songs) > 0)
            {{ $songs->links('public.layout.partials.pagination') }}
            @endif
        </div><!--/.container -->
    </section>
@endsection
