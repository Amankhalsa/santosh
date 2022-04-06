@extends('user.layouts.app')

@section('user-content')
 
@if(session('pass_err'))

<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>{{ session('pass_err') }}!</strong>
    
</div> 

@endif

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session('success') }}  
</div>
@endif

 <h3>Change Password</h3>

 <form action="{{route('change-user-password')}}" method="post">
  @csrf
  @method('PUT')
  
  <div class="col-md-6 border p-5" style="border-radius:10px;">
      <div class="row form-group">
    <div class="col-12 col-lg-12">
    <label>Old Password</label> 
    <input type="password" name="old_password" id="old_password" placeholder="Enter old password" class="form-control @error('old_password') is-invalid @enderror" value="{{ old('old_password') }}" >

@error('old_password')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror

  </div>
</div>

<div class="row form-group">
  <div class="col-12 col-lg-12">
    <label>New Password</label>
    <input type="password" name="new_password" id="new_password" placeholder="Enter new password" class="form-control @error('new_password') is-invalid @enderror" value="{{ old('new_password') }}" >
    
    @error('new_password')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
 
  </div>
  </div>

  <div class="row form-group">
  <div class="col-12 col-lg-12">
    <label>Confirm Password</label>
    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" class="form-control @error('confirm_password') is-invalid @enderror" value="{{ old('confirm_password') }}">
    
    @error('confirm_password')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
 
  </div>
  </div>



  
  <div class="row form-group">
    <div class="col-12 ">
      <button type="submit" class="btn btn-primary"> Update Password</button>
  </div>
 </div>     
</div>
</form> 

@endsection