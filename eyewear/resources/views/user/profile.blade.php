@extends('user.layouts.app')

@section('user-content')
 
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session('success') }}
</div>
@endif

 <h3>Basic Info</h3>

 <form action="{{ route('update-user') }}" class="border p-5" style="border-radius:10px;" method="post">
  @csrf
  @method('PUT')
  <div class="row form-group">
    <div class="col-12 col-lg-12">
    <label>Full Name</label> 
    <input type="text" name="name" id="name" placeholder="Enter your name" class="form-control @error('name') is-invalid @enderror" @if(!empty(Auth::guard('user')->user()->name)) value="{{ Auth::guard('user')->user()->name }}" @else value="{{ old('name') }}" @endif>

@error('name')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror

  </div>
 <!---------------------->
  
  </div>

  <div class="row form-group">
<div class="col-12 col-lg-4">
    <label>Email</label>
    <input type="text" name="email" id="email" placeholder="Enter your email" class="form-control @error('email') is-invalid @enderror" @if(!empty(Auth::guard('user')->user()->email)) value="{{ Auth::guard('user')->user()->email }}" @else value="{{ old('email') }}" @endif>
    
    @error('email')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
 
  </div>
  <div class="col-12 col-lg-4">
    <label>Mobile</label>
    <input type="text" name="mobile" id="mobile" placeholder="Enter your mobile" class="form-control @error('mobile') is-invalid @enderror" @if(!empty(Auth::guard('user')->user()->mobile)) value="{{ Auth::guard('user')->user()->mobile }}" @else value="{{ old('mobile') }}" @endif>

  @error('mobile')
  <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
  </span>
  @enderror

  </div>

 <div class="col-12 col-lg-4">
    <label>City</label> 
    <input type="text" name="city" id="city" required placeholder="Enter your city" class="form-control" @if(!empty(Auth::guard('user')->user()->city)) value="{{ Auth::guard('user')->user()->city }}" @else value="{{ old('city') }}" @endif>
  </div>

  </div>

 <div class="row form-group">

<div class="col-12 col-lg-4">
    <label>Pincode</label> 
    <input type="text" name="pincode" id="pincode" required placeholder="Enter your pincode" class="form-control" @if(!empty(Auth::guard('user')->user()->pincode)) value="{{ Auth::guard('user')->user()->pincode }}" @else value="{{ old('pincode') }}" @endif>
  </div>

   <div class="col-12 col-lg-4">
    <label>Country</label>
   <select class="form-control country" name="country" id="country" required onchange="getStates('{{$admin_data->admin_website_url}}')">
              <option selected >Select city</option>
      @foreach($countries as $country)
       <option value="{{$country->id}}" @if($country->id == Auth::guard('user')->user()->country) selected @endif >{{ $country->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="col-12 col-lg-4">
    <label>State</label>
   <select class="form-control state" name="state" id="state" required>
       <option selected >Select state</option>
  @foreach($states as $state)
   <option value="{{$state->id}}" @if($state->id == Auth::guard('user')->user()->state) selected @endif >{{ $state->name }}</option>
  @endforeach
</select>
  </div>

 

  </div>

  <div class="row form-group">
    <div class="col-12 ">
    <label>Address line 1</label> 
    <textarea type="text" class="form-control" rows="3" name="address" id="address" placeholder="Enter your address detail here...">@if(!empty(Auth::guard('user')->user()->address)){{Auth::guard('user')->user()->address}}@else{{ old('address') }}@endif</textarea>
  </div>

  
  </div>
    <div class="row form-group">
    <div class="col-12 ">
    <label>Address line 2</label> 
    <textarea type="text" class="form-control" rows="3"  name="address2" id="address2" placeholder="Enter your address detail here...">@if(!empty(Auth::guard('user')->user()->address2)){{Auth::guard('user')->user()->address2}}@else{{ old('address2') }}@endif</textarea>
  </div>

  
  </div>
  
  <div class="row form-group mt-3">
    <div class="col-12 ">
      <button type="submit" class="btn btn-primary"> Update Info</button>
  </div>
 </div>     

</form> 

@endsection