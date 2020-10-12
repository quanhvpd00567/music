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
      					<img src="assets/img/profiles/avatar.jpg" alt="" data-src="assets/img/profiles/avatar.jpg"
                             data-src-retina="assets/img/profiles/avatar_small2x.jpg" width="32" height="32">
      				</span>
            </button>
            @if(Auth::check())
                <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
                    <a href="#" class="dropdown-item"><span>{{Auth::user()->email}}</span></a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">Your Profile</a>
                    <a href="#" class="dropdown-item">Your Activity</a>
                    <a href="#" class="dropdown-item">Your Archive</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">Features</a>
                    <a href="#" class="dropdown-item">Help</a>
                    <a href="#" class="dropdown-item">Settings</a>
                    <a href="#" class="dropdown-item">Logout</a>
                    <div class="dropdown-divider"></div>
                    <span class="dropdown-item fs-12 hint-text">Last edited by David<br />on Friday at 5:27PM</span>
                </div>
            @endif
        </div>
        <!-- END User Info-->
        <a href="#" class="header-icon m-l-5 sm-no-margin d-inline-block" data-toggle="quickview" data-toggle-element="#quickview">
            <i class="pg-icon btn-icon-link">menu_add</i>
        </a>
    </div>
</div>
