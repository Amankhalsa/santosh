<html>
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel admin dashboard">
    <meta name="author" content="Laravel admin dashboard">
    <meta name="keywords" content="Laravel admin dashboard">

    <!-- Title Page-->
    <title>Admin | Login</title>

    <!-- Fontfaces CSS-->
    
    <link href="{{ asset('admin_assets/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/css/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/css/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/css/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">
    
    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin_assets/css/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('admin_assets/css/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/css/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/css/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/css/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/css/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/css/perfect-scrollbar.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/css/admin_login.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('admin_assets/css/theme.css') }}" rel="stylesheet" media="all">

</head>    

<body>
<div class="container-fluid" id="main-container"> 

<div id="login_text"> 
Welcome to Administration Panel of <b>{{ $admin_data->admin_company_name }}</b>
</div>

    <div class="row justify-content-center">
        <div class="col-md-6" id="shift-form">
            <div class="card" id="card-form">
             <div class="card-header">{{ __('Admin Login') }} 
              <img src="{{asset('admin_assets/images/lock-img1.gif')}}" alt="lock-icon" width="50" >
             </div>

                <div class="card-body">
                <center>
                <i class="fa fa-user-circle fa-4x" id="icon-animate"></i>
                </center>
                <br><br>
                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="showpassword"  onclick="myFunction()">

                                    <label class="form-check-label" for="showpassword">
                                       Show password 
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('admin.password.request'))
                                    <a class="btn btn-link" href="{{ route('admin.password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<!-- Jquery JS-->
<script src="{{ asset('admin_assets/js/jquery-3.2.1.min.js') }}"></script>
<!-- Bootstrap JS-->
<script src="{{ asset('admin_assets/js/popper.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/bootstrap.min.js') }}"></script>
<!-- Vendor JS       -->
<script src="{{ asset('admin_assets/js/slick.min.js') }}">
</script>
<script src="{{ asset('admin_assets/js/wow.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/animsition.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/bootstrap-progressbar.min.js') }}">
</script>
<script src="{{ asset('admin_assets/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/jquery.counterup.min.js') }}">
</script>
<script src="{{ asset('admin_assets/js/circle-progress.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('admin_assets/js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/select2.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/custom.js') }}"></script>


<!-- Main JS-->
<script src="{{ asset('admin_assets/js/main.js') }}"></script>

</body>
</html>