<nav class="navbar navbar-inverse navbar-fixed-top navbar-page" role="navigation" id="home-nav">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img src="/vietmix/images/logo-dark.png" alt="Jukebox Logo"></a>
        </div><!-- /.navbar-header -->

        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="/">
                        <i class="fa fa-home">Home</i>
                    </a>
                </li>

                <li class="dropdown active">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                        <i class="fa fa-list"></i>
                        Danh mục <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu animated fadeIn" role="menu">
                        @foreach($categories as $category)
                            <li><a href="{{route('category.detail', ['slug' => $category->slug])}}">{{$category->name}}</a></li>
                        @endforeach
                    </ul>
                </li><!-- /.dropdown -->

                <li>
                    <a href="#" class="brand"><img src="/vietmix/images/logo-dark.png" alt="Jukebox Logo"></a>
                </li>

                <li>
                    <a href="javascript:void(0)" id="upload-song">
                        <i class="fa fa-upload"></i> <span> Đăng bài</span>
                    </a>
                </li>
                @if(auth()->check())
                    <li class="dropdown active">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                            <i class="fa fa-user"></i>
                            {{auth()->user()->name}} <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu animated fadeIn" role="menu">
                            <li>
                                <a href="{{route('user.song.approved')}}">
                                    <i class="fa fa-list-alt"></i> <span> Danh sach</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('logout')}}">
                                    <i class="fa fa-sign-out"></i> <span> Thoát</span>
                                </a>
                            </li>
                        </ul>
                    </li><!-- /.dropdown -->
                @else
                    <li>
                        <a href="{{route('login')}}">
                            <i class="fa fa-sign-in"></i> <span> Đăng nhập</span>
                        </a>
                    </li>
                @endif
            </ul><!-- /.nav -->
        </div><!--/.nav-collapse -->
    </div><!--/.container -->
</nav><!--/.navbar -->
