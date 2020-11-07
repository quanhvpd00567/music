@extends('public.layout.master')
@section('metas')
    @include('public.layout.partials.meta-default')
@endsection
@section('content')
    <section class="album-list-wrap">
        <div class="container">
            <div class="text-center rm-group-link">
                <a href="{{route('user.song.approved')}}" class="btn btn-primary {{$active == 'approved' ? 'active' : ''}}">Đã duyệt</a>
                <a href="{{route('user.song.progress')}}" class="btn btn-primary {{$active == 'in_progress' ? 'active' : ''}}">Đang chờ duyệt</a>
                <a href="{{route('user.song.cancel')}}" class="btn btn-primary {{$active == 'cancel' ? 'active' : ''}}">Không được duyệt</a>
            </div>
            @if(count($songs) > 0)
            <div class="">
                <ul>
                    @foreach($songs as $song)
                        <li class="list-item">
                            <div>
                                <a href="" class="text" tabindex="0">{{$song->title}}</a>
                                <span class="vm-gr-megdia" style="float: right;">
                                    @if($active === 'approved')
                                        <span class="media-item">
                                            <i class="fa fa-headphones" aria-hidden="true"></i> {{number_format($song->view)}}
                                        </span>
                                        <span class="media-item">
                                            <i class="fa fa-heart text-danger" aria-hidden="true"></i> {{number_format($song->liked)}}
                                        </span>
                                    @else
                                        <span class="media-item">
                                            <i class="fa fa-calendar" aria-hidden="true"></i> {{$song->created_at}}
                                        </span>
                                    @endif
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
