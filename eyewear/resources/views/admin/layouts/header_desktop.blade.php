
<header class="header-desktop">
<div class="section__content section__content--p30">
<div class="container-fluid">
<div class="header-wrap">

<h3>{{ $admin_data->admin_company_name }}</h3>

<div class="header-button">
{{-- nbsp is use for float right in mobile view --}}
 &nbsp;

 <div class="account-wrap">
<div class="account-item clearfix js-item-menu">
<div class="image">
<img src="{{ asset('admin_assets/images/user-login.png') }}" alt="User Logged In" class="img-fluid"  />
</div>
<div class="content">
<a class="js-acc-btn" href="#">{{ \Illuminate\Support\Str::limit(Auth::user()->admin_name, 25, $end='...') }}</a>
</div>
<div class="account-dropdown js-dropdown">
<div class="info clearfix">
<div class="image">
<a href="#">
<img src="{{ asset('admin_assets/images/user-login.png') }}" alt="User Logged In" class="img-fluid" />
</a>
</div>
<div class="content">
<h5 class="name">
<a href="#">{{ \Illuminate\Support\Str::limit(Auth::user()->admin_name, 25, $end='...') }}</a>
</h5>
<span class="email">{{ \Illuminate\Support\Str::limit(Auth::user()->email, 25, $end='...') }}</span>
<br>
<span class="user_type"><b>User Type:</b> {{ Auth::user()->admin_type }} </span>

</div>
</div>
{{-- <div class="account-dropdown__body">
<div class="account-dropdown__item">
<a href="#">
<i class="zmdi zmdi-account"></i>Account</a>
</div>
<div class="account-dropdown__item">
<a href="#">
<i class="zmdi zmdi-settings"></i>Setting</a>
</div>
<div class="account-dropdown__item">
<a href="#">
<i class="zmdi zmdi-money-box"></i>Billing</a>
</div>
</div> --}}
<div class="account-dropdown__footer">

<a href="{{ route('admin.logout') }}" ><i class="zmdi zmdi-power"></i>Logout</a>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</header>
