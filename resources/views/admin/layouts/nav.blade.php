<nav class="page-sidebar" data-pages="sidebar">
    <!-- BEGIN SIDEBAR MENU TOP TRAY CONTENT-->
    <div class="sidebar-overlay-slide from-top" id="appMenu">
    </div>
    <!-- END SIDEBAR MENU TOP TRAY CONTENT-->
    <!-- BEGIN SIDEBAR MENU HEADER-->
    <div class="sidebar-header">
        <span>VIET MIX</span>
        <div class="sidebar-header-controls">
            <button aria-label="Pin Menu" type="button" class="btn btn-icon-link invert d-lg-inline-block d-xlg-inline-block d-md-inline-block d-sm-none d-none" data-toggle-pin="sidebar">
                <i class="pg-icon text-success"></i>
            </button>
        </div>
    </div>
    <!-- END SIDEBAR MENU HEADER-->
    <!-- START SIDEBAR MENU -->
    <div class="sidebar-menu">
        <!-- BEGIN SIDEBAR MENU ITEMS-->
        <ul class="menu-items">
            <li class="m-t-30"><a href="#" class="detailed">
                    <span class="title">Dashboard</span>
                </a>
                <span class="icon-thumbnail "><i class="pg-icon">inbox</i></span>
            </li>
            <li class="">
                <a href="{{route('song.list')}}">
                    <span class="title">Songs</span>
                </a>
                <span class="icon-thumbnail "><i class="pg-icon">card</i></span>
            </li>
            @if(false)
                <li class="">
                    <a href="{{route('admin.master.images.list')}}">
                        <span class="title">Image</span>
                    </a>
                    <span class="icon-thumbnail "><i class="pg-icon">grid</i></span>
                </li>
            @endif
            <li class="">
                <a href="{{route('category.list')}}">
                    <span class="title">Categories</span>
                </a>
                <span class="icon-thumbnail"><i class="pg-icon">note</i></span>
            </li>
            <li class="">
                <a href="{{route('admin.import.song')}}">
                    <span class="title">Import</span>
                </a>
                <span class="icon-thumbnail"><i class="fa fa-upload"></i></span>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <!-- END SIDEBAR MENU -->
</nav>
