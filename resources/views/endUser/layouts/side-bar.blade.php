<div class="left-side-inner">
    <!--sidebar nav start-->
    <ul class="nav nav-pills nav-stacked custom-nav">
        <li class="active">
            <a href="/"><i class="lnr lnr-home"></i><span>Home</span></a>
        </li>
        <li>
            <a href="#"><i class="lnr lnr-film-play"></i><span>video</span></a>
        </li>
        <li><a href="browse.html"><i class="lnr lnr-music-note"></i><span>Albums</span></a></li>

        <li class="menu-list">
            <a href="javascript:void(0)"><i class="lnr lnr-list"></i> <span>Categories</span></a>
            <ul class="sub-menu-list" style="display: block;">
                @foreach($categories as $category)
                    <li><a href="{{route('category.detail', ['slug' => $category->slug])}}">{{$category->name}}</a></li>
                @endforeach
            </ul>
        </li>

        <li class="menu-list">
            <a href="javascript:void(0)"><i class="lnr lnr-user"></i> <span>Profile</span></a>
            <ul class="sub-menu-list" style="display: block;">
                <li><a href="{{route('user.songs')}}">Danh sách bài hát</a></li>
            </ul>
        </li>
    </ul>
    <!--sidebar nav end-->
</div>
