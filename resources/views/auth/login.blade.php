<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Chroma Admin Dashboard</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/simple-line-icon/css/simple-line-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.addons.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper auth p-0 theme-two">
        <div class="row d-flex align-items-stretch">
          <div class="col-md-4 banner-section d-none d-md-flex align-items-stretch justify-content-center">
            <div class="slide-content bg-1 row justify-content-center align-items-center">
            <img src="{{ asset('assets/images/boomgen/splashscreen.png') }}">
            </div>
          </div>
          <div class="col-12 col-md-8 h-100 bg-white">
            <div class="auto-form-wrapper d-flex align-items-center justify-content-center flex-column">
              {{-- <div class="nav-get-started">
                <p>Don't have an account?</p>
                <a class="btn get-started-btn" href="register-2.html">GET STARTED</a>
              </div> --}}
              @if($errors->any())
                  <h4 style="color: red">{{$errors->first()}}</h4>
              @endif
              <form method="POST" action="{{ route('login') }}">
                  {{ csrf_field() }}
                <h3 class="mr-auto">Hello! let's get started</h3>
                <p class="mb-5 mr-auto">Enter your details below.</p>
                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}" >
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="mdi mdi-account-outline"></i></span>
                    </div>
                    <input type="text" class="form-control h-auto" value="{{ old('email') }}" name="email" required autofocus placeholder="Email">
                  </div>
                </div>
                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="mdi mdi-lock-outline"></i></span>
                    </div>
                    <input type="password" class="form-control h-auto" name="password" placeholder="Password" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                      <div class="checkbox">
                          <label>
                              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                          </label>
                      </div>
                  </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary submit-btn" value="SIGN IN"/>
                    {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                      Forgot Your Password?
                    </a> --}}
                  <!-- <button class="btn btn-primary submit-btn" onclick="window.location.href='dashboard.html'">SIGN IN</button> -->
                </div>
                {{-- <div class="wrapper mt-5 text-gray">
                  <p class="footer-text">Copyright © 2018 Bootstrapdash. All rights reserved.</p>
                  <ul class="auth-footer text-gray">
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Cookie Policy</a></li>
                  </ul>
                </div> --}}
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('assets/vendors/js/vendor.bundle.addons.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('assets/js/misc.js') }}"></script>
  <script src="{{ asset('assets/js/settings.js') }}"></script>
  <script src="{{ asset('assets/js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>