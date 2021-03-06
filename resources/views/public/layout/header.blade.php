
<?php
$routeArray = request()->route()->getAction();

$controllerAction = class_basename($routeArray['controller']);
$controllerName = explode('@', $controllerAction)[0];
?>

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
            <a class="navbar-brand" href="#">
                <img src="vietmix/images/logo.png" alt="Viet mix">
            </a>
        </div><!-- /.navbar-header -->

        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="{{$controllerName == 'HomeController' ? 'active' : ''}}">
                    <a href="/">
                        <i class="fa fa-home">Home</i>
                    </a>
                </li>
                <li class="dropdown {{$controllerName == 'CategoryController' ? 'active' : ''}}">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                        Danh mục <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu animated fadeIn" role="menu">
                        @foreach($categories as $category)
                            <li><a href="{{route('category.detail', ['slug' => $category->slug])}}">{{$category->name}}</a></li>
                        @endforeach
                    </ul>
                </li><!-- /.dropdown -->

                <li>
                    <a href="#" class="brand"><img src="/vietmix/images/logo.png" alt="Viet mix"></a>
                </li>

                <li>
                    @if(auth()->check())
                        <a href="{{route('user.upload')}}">
                            <span> Đăng bài</span>
                        </a>
                    @else
                        <a href="javascript:void(0)" id="upload-song">
                            <span> Đăng bài</span>
                        </a>
                    @endif
                </li>
                @if(auth()->check())
                    <li class="dropdown active">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                            {{auth()->user()->name}} <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu animated fadeIn" role="menu">
                            <li>
                                <a href="{{route('user.song.approved')}}">
                                    <span> Danh sach</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('logout')}}">
                                    <span> Thoát</span>
                                </a>
                            </li>
                        </ul>
                    </li><!-- /.dropdown -->
                @else
                    <li class="{{$controllerName == 'AuthController' ? 'active' : ''}}">
                        <a href="{{route('login')}}">
                            </i> <span> Đăng nhập</span>
                        </a>
                    </li>
                @endif
            </ul><!-- /.nav -->
        </div><!--/.nav-collapse -->
    </div><!--/.container -->
</nav><!--/.navbar -->
