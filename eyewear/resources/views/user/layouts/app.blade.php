@extends('layouts.app')

@section('title','User Panel')

@section('content')

<style type="text/css">
  #main-section{
    padding: 30px;
  }
  #sidebar {
    padding-top: 10px;
    background-color: #d3d3d300;
}
  #sidebar ul{
    list-style: none;
  }
  #sidebar ul li a{color:#000;}
  #sidebar ul li a:hover{text-decoration:none;}
  #sidebar ul li{
   margin-bottom: 5%;
    line-height: 2.0;
    border: 1px solid #8080806e;
    border-radius: 5px;
    padding: 10px;
    background: #efefef;
    color: #000;
    box-shadow: -3px 3px #d4d4d4;
    transition:0.8s;
  }
  #sidebar ul li:hover{
   transition:0.8s;
   background:transparent;
   transform: rotateY(-30deg);
  }
  #content{
        padding-left: 100px;
    padding: 0 5%;
  }
</style>

 <div class="container mt-5 mb-5" id="main-section">
   <div class="row">
     <div class="col-12 col-lg-3" id="sidebar">
       <ul>
        <li><a href="{{ url('/user') }}"> <i class="fa fa-server"></i> Dashboard</a></li>
         <li><a href="{{ url('/user/profile') }}"> <i class="fas fa-user"></i> My Profile</a></li>
         <li><a href="{{ url('/user/shipping-address') }}"> <i class="fas fa-shipping-fast"></i> Shipping Address</a></li>
         <li><a href="{{ url('/user/orders') }}"> <i class="fas fa-shopping-cart"></i> My Orders</a></li>
         <li><a href="{{ url('/user/change-password') }}"> <i class="fas fa-lock"></i> Change Password</a></li>
         <li class="menu-item animate-dropdown">
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out-alt"></i>
        {{ __('Logout') }}
        </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
        </form>
       </ul>
     </div>
      <div class="col-12 col-lg-8" id="content">
       @yield('user-content')
     </div>
   </div>
 </div>

@endsection