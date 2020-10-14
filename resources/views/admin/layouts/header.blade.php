<div class="header ">
    <!-- START MOBILE SIDEBAR TOGGLE -->
    <a href="#" class="btn-link toggle-sidebar d-lg-none pg-icon btn-icon-link" data-toggle="sidebar">
        menu</a>
    <!-- END MOBILE SIDEBAR TOGGLE -->
    <div class="">
        <div class="brand inline   ">
            <img src="assets/img/logo.png" alt="logo" data-src="assets/img/logo.png" data-src-retina="assets/img/logo_2x.png" width="78" height="22">
        </div>
    </div>
    <div class="d-flex align-items-center">
        <!-- START User Info-->
        <div class="dropdown pull-right d-lg-block d-none">
            <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="profile dropdown">
              <span class="thumbnail-wrapper d32 circular inline">
      					<img src="{{asset('images/avatar_admin.png')}}" alt="" width="32" height="32">
      				</span>
            </button>
            @if(Auth::check())
                <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
                    <a href="#" class="dropdown-item"><span>{{Auth::user()->name}}</span></a>
                    <a href="#" class="dropdown-item">Settings</a>
                    <a href="{{route('admin.logout')}}" class="dropdown-item">Logout</a>
                    <div class="dropdown-divider"></div>
                </div>
            @endif
        </div>
    </div>
</div>
