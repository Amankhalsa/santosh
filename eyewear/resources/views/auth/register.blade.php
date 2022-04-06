@extends('layouts.app')
@section('title', 'Register')
<style>
.account_form {
    border: solid 1px #222;
    padding: 15px;
    
}
.account_form h2 {
    margin-bottom: 20px;
}
.account_form label {
    color: #222;
    margin-bottom: 8px;
}
.account_form input {
    border-radius: unset;
    border: solid 1px #222;
}
.login_submit a {
    color: #222;
}
.page_speed_440257927 {
    margin-left: 0 !important;
    width: auto !important;
    height: 60px !important;
}
.login_submit .btn.btn-primary {
    background: #222;
    border: solid 1px #222;
    width: 185px;
    padding: 14px 0;
}
.flex.items-center.justify-end.mt-4 .page_speed_1009002956 {
    margin-left: 0;
    width: auto;
    height: 60px;
}
</style>
@section('content')

<div class="sun-breadcrumb-01">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="breadcrumb-01">
<ul>
<li><a href="{{url('/')}}"><i class="fas fa-home"></i></a></li>
<li><a href="">My Account</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>

<div class="privacy-page" style="margin-top:5rem; margin-bottom:5rem;">
<div class="container">
<div class="row">
<div class="col-lg-6 col-12">
<div class="account_form">
<h2>login</h2>

 <form method="POST" action="{{ route('login') }}">
@csrf
<input type="hidden" name="auth_attempt" value="login">
    <p>   
        <label>Username or email <span>*</span></label>
        <input id="email" type="email" class="form-control @error('email') @if(Session::get('last_auth_attempt')=='login') is-invalid @endif @enderror" name="email" @if(Session::get('last_auth_attempt')=='login') value="{{ old('email') }}" @endif required >

        @error('email')
         @if(Session::get('last_auth_attempt')=='login')    
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
         @endif    
        @enderror
     </p>
     <p>   
        <label>Passwords <span>*</span></label>
       <input id="password" type="password" class="form-control @error('password') @if(Session::get('last_auth_attempt')=='login') is-invalid @endif @enderror" name="password" required >

            @error('password')
            @if(Session::get('last_auth_attempt')=='login')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @endif    
            @enderror
     </p>   
    <div class="login_submit">
       <a href="{{ route('password.request') }}">Lost your password?</a>
        <label for="remember">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            Remember me
        </label><br>
        <button type="submit" class="btn btn-primary">login</button>
        
    </div>
          <div class="flex items-center justify-end mt-4">
                <a href="{{route('please.wait')}}">
                    <img src="{{asset('uploaded_files/assets/images/goolge.png')}}" style=" width:auto; height:60px;">
                
                <img src="{{asset('uploaded_files/assets/images/facebook.png')}}" style=" width:auto; height:60px;">
           </a>
            </div>

</form>
</div>
</div>
<div class="col-lg-6 col-12">
<div class="account_form register">
<h2>Register</h2>

<form method="POST" action="{{ route('register') }}">
 @csrf
 <input type="hidden" name="auth_attempt" value="register">
    <p>   
        <label>Name  <span>*</span></label>
         <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
     </p>
    <p>   
        <label>Email address  <span>*</span></label>
       <input id="email" type="email" class="form-control @error('email') @if(Session::get('last_auth_attempt')=='register') is-invalid @endif @enderror" name="email" @if(Session::get('last_auth_attempt')=='register') value="{{ old('email') }}" @endif required >

                @error('email')
                @if(Session::get('last_auth_attempt')=='register')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @endif
                @enderror
     </p>
      <p>   
        <label>Phone No  <span>*</span></label>
         <input id="mobile" type="text" maxlength="10" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile">

                @error('mobile')
                @if(Session::get('last_auth_attempt')=='register')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @endif
                @enderror
     </p>
     <p>   
        <label>Passwords <span>*</span></label>
        <input id="password" type="password" class="form-control @error('password') @if(Session::get('last_auth_attempt')=='register') is-invalid @endif @enderror" name="password" required >

                @error('password')
                @if(Session::get('last_auth_attempt')=='register')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @endif
                @enderror
     </p>
      <p>   
        <label>Confirm Passwords <span>*</span></label>
         <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
     </p>
    <div class="login_submit">
        <button type="submit" class="btn btn-primary">Register</button>
    </div>
    <div class="form-group row mb-0">
<div class="col-md-8 offset-md-4">
<a href="{{ url('/auth/redirect/google') }}" class="btn btn-primary"><i class="fa fa-google"></i> Google</a>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>


@endsection