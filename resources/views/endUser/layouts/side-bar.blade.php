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
            <a href="javascript:void(0)"><i class="lnr lnr-indent-increase"></i> <span>Categories</span></a>
            <ul class="sub-menu-list">
                @foreach($categories as $category)
                    <li><a href="{{route('category.detail', ['slug' => \App\Http\Helpers\Helper::createUrlCategory($category)])}}">{{$category->name}}</a></li>
                @endforeach
            </ul>
        </li>
{{--        <li><a href="blog.html"><i class="lnr lnr-book"></i><span>Blog</span></a></li>--}}
{{--        <li><a href="typography.html"><i class="lnr lnr-pencil"></i> <span>Typography</span></a></li>--}}
    </ul>
    <!--sidebar nav end-->
</div>
