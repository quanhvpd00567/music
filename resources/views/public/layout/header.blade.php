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
                <li><a href="index-2.html">Home</a></li>

                <li class="dropdown active">
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
                    <a href="#" class="brand"><img src="/vietmix/images/logo-dark.png" alt="Jukebox Logo"></a>
                </li>

                <li>
                    <a href="index-2.html">
                        <i class="fa fa-upload"></i> <span>Đăng bài</span>
                    </a>
                </li>
                <li>
                    <a href="index-2.html">
                        <i class="fa fa-upload"></i> <span>Login</span>
                    </a>
                </li>
            </ul><!-- /.nav -->
        </div><!--/.nav-collapse -->
    </div><!--/.container -->
</nav><!--/.navbar -->
