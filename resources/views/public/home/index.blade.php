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
                        <img src="/vietmix/images/album1.jpg" alt="image">
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
    </section>
@endsection
