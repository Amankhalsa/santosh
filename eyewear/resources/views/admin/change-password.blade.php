@extends('admin.layouts.app')

@section('title','Change Password')

@section('content')
<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left">Change Password &nbsp; <i style="font-size:20px;" class="fa fa-lock"></i></h4>
</div>
</div>
</div>
<div class="section__content section__content--p30">
<br>

@if(count($errors)>0)
<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Errors Occurred!</strong>
    <ul style="margin-left:25px;">
     @foreach($errors->all() as $error)
     <li>{{ $error }}</li>
     @endforeach
    </ul>
</div>  
@endif

@if(session('pass_err'))

<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Errors Occurred!</strong>
    <ul style="margin-left:25px;"> 
     <li>{{ session('pass_err') }}</li>
    </ul>
</div> 

@endif

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session('success') }}  
</div>
@endif

 <div class="container-fluid">
  <div class="row">
  <div class="col-lg-6 offset-lg-3">
            <div class="card">
            <div class="card-header">Update Password</div>
            <div class="card-body">
            <div class="card-title">
            <h3 class="text-center title-2">Change Password</h3>
            </div>
            <hr>
            <form action="{{ route('change-password') }}" method="post" >
            @csrf
            @method('PUT')
            <div class="form-group">
            <label for="cc-payment" class="control-label mb-1">Old Password</label>
            <input id="old_password" name="old_password" type="password" class="form-control" required placeholder="Enter Old Password" value="{{ old('old_password') }}">
            </div>
           
           
            <div class="form-group">
            <label for="cc-payment" class="control-label mb-1">New Password</label>
            <input id="new_password" name="new_password" type="password" class="form-control" required placeholder="Enter New Password" value="{{ old('new_password') }}">
            </div>

            <div class="form-group">
            <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
            <input id="confirm_password" name="confirm_password" type="password" class="form-control" required placeholder="Enter Confirm Password" value="{{ old('confirm_password') }}">
            </div>

            <div>
            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
            <i class="fa fa-lock fa-lg"></i>&nbsp;
            <span id="payment-button-amount">Change</span>
            </button>
            </div>
            </form>
            </div>
            </div>
            </div>
  </div>
 </div>

 <!-- ******************** -->
</div>

@endsection

