@extends('public.layout.master')
@section('title') {{$song->title}} @endsection
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
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name"                   content="{{$song->title}}" />
    <meta itemprop="description"             content="{{$song->description}}">
    <meta itemprop="image"                   content="{{$song->author}}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site"               content="Vietmix.vn" />
    <meta name="twitter:title"              content="{{$song->title}}" />
    <meta name="twitter:description"        content="{{$song->description}}">
    <meta name="twitter:creator"            content="{{$song->author}}">
    <meta name="twitter:image:src"          content="{$song->image}}g">

@endsection
@section('content')
    <section class="album-single-wrap">
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        @if($isMobile)
        <div class="container" style="padding-bottom: 20px">
            <div class="col-md-4 left">
                <div id="jquery_jplayer_1" class="jp-jplayer"></div>
                <div class="rm-btn-custom text-center">
                    <button class="btn btn-primary" id="onMobilePlay">
                        <i class="fa fa-play"></i> Nghe ngay
                    </button>
                    <button class="btn btn-primary" id="onMobilePause">
                        <i class="fa fa-pause"></i> Dừng
                    </button>
                </div>
            </div>
        </div>
        @endif
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
                                    <span class="shape"><i class="fa fa-info"></i></span>
                                    <span>{{$song->title}}</span>
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
            </div><!--/.left -->

            <div class="col-md-8 right">
                <div class="content">
                    @if(!$isMobile)
                    <div id="jquery_jplayer_1" class="jp-jplayer"></div>
                    <div id="jp_container_1" class="jp-audio" role="application" aria-label="media player">
                        <div class="jp-type-playlist">
                            <div class="jp-gui jp-interface">
                                <div class="jp-volume-controls" style="z-index: 99999">
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
                    @endif
                </div><!-- /.content -->
                <div class="album-share link-share" >
                    <div class="title"><h2>Chia sẻ bài hát</h2></div>
                    <div class="content" style="padding-top: 10px">
                        <div class="socmed-wrap" style="margin-bottom: 20px">
                            <a href="javascript:void(0)" id="btn-share"><i class="fa fa-share-alt"></i></a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="https://twitter.com/intent/tweet?text={{url()->current()}}"><i class="fa fa-twitter"></i></a>
                        </div><!-- /.socmed-wrap -->
                        <div>
                            <div class="fb-share-button"
                                 data-href="{{url()->current()}}"
                                 data-layout="button_count">
                            </div>
                            <input style="display: none" id="show-share" type="text" class="form-control" value="{{url()->current()}}">
                        </div>
                    </div>
                </div><!--/.event-share -->

                <div class="album-detail">
                    <div class="title"><h2>Mô tả</h2></div>
                    <div class="content">
                        {{$song->description}}
                    </div><!--/.content -->
                </div><!--/.album-detail -->

                <div class="detail-tag" >
                    <div class="title"><h2>Tags</h2></div>
                    <?php
                        $argKeyword = explode(',', $song->keyword);
                    ?>
                    <div class="content">
                        <div class="tag-wrap">
                            @foreach($argKeyword as $tag)
                                <a href="{{route('search', ['tag' => $tag])}}" class="tag">{{trim($tag)}}</a>
                            @endforeach
                        </div><!-- /.tag-wrap -->
                    </div><!-- /.content -->
                </div>
            </div><!--/.right -->
        </div><!-- /.container -->
    </section>
{{--    <div id="snackbar">Đã sao chép link bài hát</div>--}}
@endsection

@section('scripts')
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <script>
        let isShowShare = false;
        $('#btn-share').on('click', function () {
            isShowShare = !isShowShare
            if(isShowShare) {
                let input = $('#show-share');
                input.show('slow').focus().val(input.val()).select()
            }else{
                $('#show-share').hide(500)
            }
        });

        let stream = {
            title: "{{$song->title}}",
            mp3: '{{$urlAudio}}',
            poster: "{{$song->image}}"
        },
        ready = false;

        let audio = $("#jquery_jplayer_1").jPlayer({
            ready: function () {
                ready = true;
                $(this).jPlayer("setMedia", stream).jPlayer("play")
            },
            swfPath: "jplayer",
            supplied: "mp3",
            wmode: "window",
            useStateClassSkin: true,
            autoBlur: false,
            smoothPlayBar: true,
            autoPlay: true,
            keyEnabled: true,
            remainingDuration: true,
            toggleDuration: true
        });

        @if($isMobile)
            $('#onMobilePause').hide()
            $('#onMobilePlay').on('click', function () {
                $(this).hide()
                audio.jPlayer('play')
                $('#onMobilePause').show()
            })//
            $('#onMobilePause').on('click', function () {
                $(this).hide()
                audio.jPlayer('pause')
                $('#onMobilePlay').show()
            })
        @endif
    </script>
@endsection
