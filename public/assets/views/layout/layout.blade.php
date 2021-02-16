<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin Dashboard</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/simple-line-icon/css/simple-line-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.addons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/font-awesome/css/font-awesome.min.css') }}">
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ route('home') }}">
          <img src="{{ asset('assets/images/boomgen/splashscreen.png') }}" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('home') }}">
          <img src="{{ asset('assets/images/boomgen/splashscreen.png') }}" alt="logo" />
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav d-none d-md-block">
          
        </ul>
        
        <ul class="navbar-nav navbar-nav-right">
          
          <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <div class="dropdown-toggle-wrapper">
                <div class="inner">
                  @php $path = url("/". Auth::user()->image); 
                  $username = Auth::user()->name;
                  @endphp
                  
                  <img class="img-xs rounded-circle" src="{{$path}}" alt="Profile image">
                </div>
                <div class="inner">
                  <div class="inner">
                    <span class="profile-text font-weight-bold">{{$username}}</span>
                    <small class="profile-text small">Admin</small>
                  </div>
                  <div class="inner">
                    <div class="icon-wrapper">
                      <i class="mdi mdi-chevron-down"></i>
                    </div>
                  </div>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a class="dropdown-item mt-2">
                Manage Accounts
              </a>
              <a class="dropdown-item" href="{{ route('changepassword') }}">
                Change Password
              </a>
             
              <a class="dropdown-item"  href="{{ route('logout') }}">
                Log Out
              </a>
            </div>
          </li>
          
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close mdi mdi-close"></i>
          <div class="d-flex align-items-center justify-content-between border-bottom">
            <p class="settings-heading font-weight-bold border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Template Skins</p>
          </div>
          <div class="sidebar-bg-options" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options selected" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading font-weight-bold mt-2">Header Skins</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles primary"></div>
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles pink"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas sidebar-dark" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <img src="{{$path}}" alt="profile image">
            <p class="text-center font-weight-medium">Admin</p>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
              <i class="menu-icon icon-diamond"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          {{-- <li class="nav-item d-none d-md-block">
            
            <div class="collapse" id="page-layouts">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="pages/layout/boxed-layout.html">Boxed</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/layout/rtl-layout.html">RTL</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/layout/horizontal-menu.html">Horizontal Menu</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="pages/layout/horizontal-menu-2.html">Horizontal Menu 2</a>
                </li>
              </ul>
            </div>
          </li> --}}

          <li class="nav-item">
            <a class="nav-link" href="{{ route('redeemeduserlist') }}">
              <i class="menu-icon icon-people"></i>
              <span class="menu-title">Redeemed Users</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#apps-dropdown" aria-expanded="false" aria-controls="apps-dropdown">
              <i class="menu-icon icon-people"></i>
              <span class="menu-title">Users</span>
            </a>
             
            <div class="collapse" id="apps-dropdown">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('userlist') }}">User List</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('createuser') }}">Create User</a>
                </li>
              </ul>
            </div>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#apps-dropdown1" aria-expanded="false" aria-controls="apps-dropdown1">
              <i class="menu-icon fa fa-gift"></i>
              <span class="menu-title">Coupons</span>
            </a>
             
            <div class="collapse" id="apps-dropdown1">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('coupon') }}">Coupon List</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('createcoupon') }}">Create Coupon</a>
                </li>
              </ul>
            </div>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#apps-dropdown2" aria-expanded="false" aria-controls="apps-dropdown2">
              <i class="menu-icon icon-people"></i>
              <span class="menu-title">Ads Manager</span>
            </a>
             
            <div class="collapse" id="apps-dropdown2">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('adslist') }}">Ads List</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('createads') }}">Create Ads</a>
                </li>
              </ul>
            </div>
          </li>
          <!--<li class="nav-item">-->
          <!--  <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">-->
          <!--    <i class="menu-icon  icon-list"></i>-->
          <!--    <span class="menu-title">Coupons</span>-->
              
          <!--  </a>-->
          <!--  <div class="collapse" id="ui-basic">-->
          <!--    <ul class="nav flex-column sub-menu">-->
          <!--      <li class="nav-item">-->
          <!--        <a class="nav-link" href="{{ route('coupon') }}">Coupon List</a>-->
          <!--      </li>-->
          <!--      <li class="nav-item">-->
          <!--        <a class="nav-link" href="{{ route('createcoupon') }}">Create Coupon</a>-->
          <!--      </li>                -->
          <!--    </ul>-->
          <!--  </div>-->
          <!--</li>-->
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}">
              <i class="menu-icon  icon-logout"></i>
              <span class="menu-title">Logout</span>
            </a>
          </li>
        </ul>
      </nav>
      
      <!-- partial -->
      <div class="main-panel">
           @yield('content')
    <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018
              <a href="http://bootstrapdash.com" target="_blank">BootstrapDash</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with
              <i class="mdi mdi-heart-outline text-danger"></i>
            </span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!--<script src="{{ asset('assets/vendovendor.bundle.base.js') }}"></script>-->
  <!--<script src="{{ asset('assets/vendovendor.bundle.addons.js') }}"></script>-->
  <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('assets/vendors/js/vendor.bundle.addons.js') }}"></script>
  <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('assets/js/misc.js') }}"></script>
  <script src="{{ asset('assets/js/settings.js') }}"></script>
  <script src="{{ asset('assets/js/todolist.js') }}"></script>
  <script src="{{ asset('assets/js/file-upload.js') }}"></script>
  <script src="{{ asset('assets/js/formpickers.js') }}"></script>
  <script src="{{ asset('assets/js/iCheck.js') }}"></script>
  <script src="{{ asset('assets/js/jquery-file-upload.js') }}"></script>
  <script src="{{ asset('assets/js/typeahead.js') }}"></script>
  <script src="{{ asset('assets/js/select2.js') }}"></script>
  <script src="{{ asset('assets/js/coupon-validation.js') }}"></script>
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
</body>
</html>