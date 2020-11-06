@extends('public.layout.master')
@section('title') {{$song->title}}] @endsection
@section('metas')
    <meta property="og:url"                content="{{URL::current()}}" />
    <meta property="og:type"               content="article" />
    <meta property='article:published_time' content='2020-10-15T20:30:11-02:00' />
    <meta property="og:title"              content="{{$song->title}}" />
    <meta property="og:description"        content="{{$song->description}}" />
    <meta property="og:image"              content="{{$song->image}}" />
    <meta property="og:image:url"           content="{{$song->image}}" />
    <meta property="og:site_name"           content="Vietmix.vn" />
    <meta name="description"                content="{{$song->description}}">
    <meta name="keywords"                   content="{{$song->keyword}}">
    <meta name="author"                     content="{{$song->author}}">
    <meta name="twitter:card"               content="summary" />
    <meta name="twitter:title"              content="{{$song->title}}" />
    <meta name="twitter:site"               content="Vietmix.vn" />
@endsection
@section('content')
    <section class="album-single-wrap">
        <div class="container">
            <div class="col-md-4 left">
                <div class="album-info">
                    <div class="image">
                        <div class="overlay">
                            <div class="view-wrap">
                                <div class="view">
                                    <a class="shape fancybox" href="{{$song->image}}"
                                       data-fancybox-group="gallery"><i class="fa fa-search"></i></a>
                                </div>
                            </div><!-- /.view-wrap -->
                        </div><!-- /.overlay -->
                        <img src="{{$song->image}}" alt="{{$song->title}}">
                    </div><!-- /.image -->

                    <div class="list">
                        <ul>
                            <li>
                                <span class="bold">
                                    <span class="shape"><i class="fa fa-info"></i></span> {{$song->title}}
                                </span>
                            </li>
                            <li>
                                <span class="bold">
                                    <span class="shape"><i class="fa fa-user"></i></span> {{$song->author}}
                                </span>
                            </li>
                            <li>
                                <span class="bold">
                                    <span class="shape"><i class="fa fa-headphones"></i></span> {{number_format($song->view)}}
                                </span>
                            </li>
                            <li>
                                <span class="bold">
                                    <span class="shape"><i class="fa fa-heart text-danger"></i></span> {{number_format($song->liked)}}
                                </span>
                            </li>
                        </ul>
                    </div><!--/.list -->
                </div><!--/.album-info -->
                <div class="album-share">
                    <div class="title"><h2>Share This Album</h2></div>
                    <div class="content">
                        <div class="socmed-wrap">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </div><!-- /.socmed-wrap -->
                    </div>
                </div><!--/.event-share -->
            </div><!--/.left -->

            <div class="col-md-8 right">
                <div class="content">
                    <div id="jquery_jplayer_1" class="jp-jplayer"></div>
                    <div id="jp_container_1" class="jp-audio" role="application" aria-label="media player">
                        <div class="jp-type-playlist">
                            <div class="jp-gui jp-interface">
                                <div class="jp-volume-controls">
                                    <button class="jp-mute" role="button" tabindex="0">mute</button>
                                    <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
                                    <div class="jp-volume-bar">
                                        <div class="jp-volume-bar-value"></div>
                                    </div>
                                </div>
                                <div class="jp-controls-holder" style="padding-bottom: 10px;">
                                    <div class="jp-controls">
                                        <button class="jp-previous" role="button" tabindex="0">previous</button>
                                        <button class="jp-play" role="button" tabindex="0">play</button>
                                        <button class="jp-stop" role="button" tabindex="0">stop</button>
                                        <button class="jp-next" role="button" tabindex="0">next</button>
                                    </div>
                                    <div class="jp-progress">
                                        <div class="jp-seek-bar">
                                            <div class="jp-play-bar"></div>
                                        </div>
                                    </div>
                                    <div class="jp-time-holder" style="width: 55%">
                                        <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
                                        <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
                                    </div>
                                </div>

                            </div>
                            <div class="jp-no-solution">
                                <span>Update Required</span>
                                To play the media you will need to either update your browser to a recent version or
                                update your <a href="https://get.adobe.com/flashplayer/" target="_blank">Flash
                                    plugin</a>.
                            </div>
                        </div><!-- /.jp-type-playlist -->
                    </div><!-- /.jp-audio -->
                </div><!-- /.content -->

                <div class="album-detail">
                    <div class="title"><h2>Mô tả</h2></div>
                    <div class="content">
                        {{$song->description}}
                    </div><!--/.content -->
                </div><!--/.album-detail -->
            </div><!--/.right -->
        </div><!-- /.container -->
    </section>
@endsection

@section('scripts')
    <script>
        $("#jquery_jplayer_1").jPlayer({
            ready: function () {
                $(this).jPlayer("setMedia", {
                    title: "Bubble",
                    mp3: '{{$urlAudio}}',
                    poster: "https://vuonhoaviet.vn/wp-content/uploads/2017/10/92.-Hoa-h%E1%BB%93ng-ngo%E1%BA%A1i-Blue-Storm.jpg"
                });
            },
            swfPath: "jplayer",
            supplied: "mp3",
            wmode: "window",
            useStateClassSkin: true,
            autoBlur: false,
            smoothPlayBar: true,
            keyEnabled: true,
            remainingDuration: true,
            toggleDuration: true
        });
    </script>
@endsection
