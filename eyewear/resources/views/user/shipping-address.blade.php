@extends('user.layouts.app')

@section('user-content')
 
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session('success') }}
</div>
@endif

 <h3>Shipping Address</h3>

 <form action="{{url('/user/shipping-address')}}" method="post">
  @csrf
  @method('POST')
  <div class="row form-group">
    <div class="col-12 col-lg-6">
    <label>Full Name</label> 
    <input type="text" name="ship_name" id="ship_name" placeholder="Enter your name" class="form-control @error('ship_name') is-invalid @enderror" @if(!empty($shipping_address)) @if(!empty($shipping_address->ship_name)) value="{{ $shipping_address->ship_name }}" @endif  @endif>

@error('ship_name')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror

  </div>

  <div class="col-12 col-lg-6">
    <label>Email</label>
    <input type="text" name="ship_email" id="ship_email" placeholder="Enter your email" class="form-control @error('ship_email') is-invalid @enderror" @if(!empty($shipping_address)) @if(!empty($shipping_address->ship_email)) value="{{ $shipping_address->ship_email }}" @endif  @endif>
    
    @error('ship_email')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
 
  </div>
  </div>

  <div class="row form-group">
    
  <div class="col-12 col-lg-6">
    <label>Mobile</label>
    <input type="text" name="ship_mobile" id="ship_mobile" placeholder="Enter your mobile" class="form-control @error('ship_mobile') is-invalid @enderror" @if(!empty($shipping_address)) @if(!empty($shipping_address->ship_mobile)) value="{{ $shipping_address->ship_mobile }}" @endif  @endif>

  @error('ship_mobile')
  <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
  </span>
  @enderror

  </div>

 <div class="col-12 col-lg-6">
    <label>City</label> 
    <input type="text" name="ship_city" id="ship_city" required placeholder="Enter your city" class="form-control @error('ship_city') is-invalid @enderror" @if(!empty($shipping_address)) @if(!empty($shipping_address->ship_city)) value="{{ $shipping_address->ship_city }}" @endif  @endif>

@error('ship_city')
  <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
  </span>
  @enderror

  </div>

  </div>

 <div class="row form-group">

<div class="col-12 col-lg-4">
    <label>Pincode</label> 
    <input type="text" name="ship_pincode" id="ship_pincode" required placeholder="Enter your pincode" class="form-control @error('ship_pincode') is-invalid @enderror" @if(!empty($shipping_address)) @if(!empty($shipping_address->ship_pincode)) value="{{ $shipping_address->ship_pincode }}" @endif  @endif>

    @error('ship_pincode')
  <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
  </span>
  @enderror
  </div>

   <div class="col-12 col-lg-4">
    <label>Country</label>
   <select class="form-control" name="ship_country" id="country" required onchange="getStates()">
      @foreach($countries as $country)
       <option value="{{$country->id}}" @if(!empty($shipping_address)) @if($country->id == $shipping_address->ship_country) selected @endif @endif >{{ $country->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="col-12 col-lg-4">
    <label>State</label>
   <select class="form-control" name="ship_state" id="state" required>
  @foreach($states as $state)
   <option value="{{$state->id}}" @if(!empty($shipping_address)) @if($state->id == $shipping_address->ship_state) selected @endif @endif>{{ $state->name }}</option>
  @endforeach
</select>
  </div>

 

  </div>

  <div class="row form-group">
    <div class="col-12 ">
    <label>Address line 1</label> 
    <textarea type="text" class="form-control @error('ship_address') is-invalid @enderror" rows="4" name="ship_address" id="ship_address" placeholder="Enter your address detail here...">@if(!empty($shipping_address))@if(!empty($shipping_address->ship_address)){{ $shipping_address->ship_address }}@endif @endif</textarea>

    @error('ship_address')
  <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
  </span>
  @enderror
  </div>

  
  </div>
  <!------------------new -------------->
    <div class="row form-group">
    <div class="col-12 ">
    <label>Address line 2</label> 
    <textarea type="text" class="form-control @error('ship_address2') is-invalid @enderror" rows="4" name="ship_address2" id="ship_address2" placeholder="Enter your address line 2 here...">@if(!empty($shipping_address))@if(!empty($shipping_address->ship_address2)){{ $shipping_address->ship_address2 }}@endif @endif</textarea>

    @error('ship_address2')
  <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
  </span>
  @enderror
  </div>

  
  </div>
  
  <div class="row form-group mt-3">
    <div class="col-8 ">
      <button type="submit" class="btn btn-primary"> Update Info</button>
  </div>
  <div class="col-4 ">
      <a class="btn btn-info" href="{{url('/checkout.html')}}">Proceed to checkout</a>
  </div>
 </div>     

</form> 

@endsection