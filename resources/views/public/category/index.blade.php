@extends('public.layout.master')
@section('metas')
    @include('endUser.layouts.meta-default')
@endsection
@section('content')
    <section class="album-list-wrap">
        <div class="container">
            <h2 class="text-center title-category">{{$category->name}}</h2>
            <div class="">
                <ul>
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
            {{ $songs->links('public.layout.partials.pagination') }}
        </div><!--/.container -->
    </section>
@endsection
