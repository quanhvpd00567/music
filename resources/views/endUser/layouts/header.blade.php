<div class="menu-right">
    <div class="row">
        <div class="col-md-4 ">
            <form action="{{route('song.search')}}">
                <div class="search input-group">
                    <input type="text" value="{{request()->get('keyword')}}" class="form-control" name="keyword" placeholder="Tìm bài hát ...">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <div class="search">
                <ul class="nav navbar-nav navbar-right">
                    @if(auth()->check())
                        <li><a class="item-header text-center" href="#"><span class="glyphicon glyphicon-music"></span> Đăng bài hát</a></li>
                        <li><a class="item-header text-center" href="{{route('logout')}}"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                    @else
                        <li>
                            <a class="item-header text-center" href="javascript:void(0)" id="showModalConfirm">
                                <span class="glyphicon glyphicon-music"></span> Đăng bài hát</a>
                        </li>
                        <li><a class="item-header text-center" href="{{route('login')}}"><span class="glyphicon glyphicon-user"></span> Login</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>


