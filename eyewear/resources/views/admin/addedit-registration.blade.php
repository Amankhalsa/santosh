@extends('admin.layouts.app')

@section('title','Add / Edit Registration')

@section('content')

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Add / Edit Registration &nbsp; <i style="font-size:20px;" class="fas fa-user-plus"></i></h4>
<span style="float:right;"><a href="{{ route('manage-registration') }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
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

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session('success') }}
</div>
@endif

 <div class="container-fluid">
  <div class="row">
  <div class="col-lg-12">
  <form @if(isset($edit_user)) action="{{ route('update-reg-user',$edit_user->id) }}" @else action="" @endif method="post" enctype="multipart/form-data" class="form-horizontal">
  @csrf
  @if(isset($edit_user))
   @method('PUT')
  @else
   @method('POST')
  @endif

        <div class="card">
        <div class="card-header">
        <strong>Add / Edit Registration</strong> Details
        </div>
        <div class="card-body card-block">

        <div class="row form-group">
        <div class="col-12 col-md-6">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Name</label>
        <input type="text" id="name" name="name" placeholder="Enter Name" class="form-control" @if(isset($edit_user)) value="{{ $edit_user->name }}" @else value="{{ old('name') }}" @endif >
        </div>

        <div class="col-12 col-md-6">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Email</label>
        <input type="text" id="email" name="email" placeholder="Enter Email" class="form-control" @if(isset($edit_user)) value="{{ $edit_user->email }}" @else value="{{ old('email') }}" @endif >
        </div>
        </div>

        <div class="row form-group">

        <div class="col-12 col-md-2">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Dial Code</label>
        <select class="form-control" name="dial_code" id="dial_code">
          @foreach($dial_codes as $dial)
           <option value="{{$dial->phonecode}}" @if($dial->phonecode == $edit_user->dial_code) selected @endif >{{ $dial->phonecode }} ({{ $dial->name }})</option>
          @endforeach
        </select>
        </div>
          
        <div class="col-12 col-md-4">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Mobile No</label>
        <input type="text" id="mobile" name="mobile" placeholder="Enter Mobile No" class="form-control" @if(isset($edit_user)) value="{{ $edit_user->mobile }}" @else value="{{ old('mobile') }}" @endif >
        </div>

        <div class="col-12 col-md-6">
        <label for="text-input" class=" form-control-label" style="font-weight:520">City</label>
        <input type="text" id="city" name="city" placeholder="Enter City" class="form-control" @if(isset($edit_user)) value="{{ $edit_user->city }}" @else value="{{ old('city') }}" @endif >
        </div>
        </div>

      <div class="row form-group">

        <div class="col-12 col-md-4">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Country</label>
        <select class="form-control" name="country" id="country" onchange="getStates('{{ $admin_data->admin_website_url }}')">
          @foreach($countries as $country)
           <option value="{{$country->id}}" @if($country->id == $edit_user->country) selected @endif >{{ $country->name }}</option>
          @endforeach
        </select>
        </div>

        <div class="col-12 col-md-4">
        <label for="text-input" class=" form-control-label" style="font-weight:520">State</label>
        <select class="form-control" name="state" id="state">
          @foreach($states as $state)
           <option value="{{$state->id}}" @if($state->id == $edit_user->state) selected @endif >{{ $state->name }}</option>
          @endforeach
        </select>
        </div>

        <div class="col-12 col-md-4">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Pincode</label>
        <input type="text" id="pincode" name="pincode" placeholder="Enter Pincode" class="form-control" @if(isset($edit_user)) value="{{ $edit_user->pincode }}" @else value="{{ old('pincode') }}" @endif >
        </div>
        </div>

       <div class="row form-group">

        <div class="col-12">
        <label for="text-input" class=" form-control-label" style="font-weight:520"> Address </label>
        <textarea type="text" name="address" id="address" class="form-control" rows="4" placeholder="Enter your address details">@if(isset($edit_user)){{$edit_user->address}}@endif</textarea>
        </div>
        </div>

        <div class="row form-group">

        <div class="col-12 col-md-4">
        <label for="select" class=" form-control-label" style="font-weight:520"> Status</label>
        <select name="status" id="status" class="form-control">
        <option value="Active" @isset($edit_user) @if($edit_user->status=='Active') selected @endif @endisset >Active</option>
        <option value="Inactive" @isset($edit_user) @if($edit_user->status=='Inactive') selected @endif @endisset  >Inactive</option>
        </select>
        </div>
        </div>




        </div>
        <div class="card-footer" style="box-shadow:2px 2px 2px grey;">
        <button type="submit" class="btn btn-primary btn-md">
        <i class="fa fa-send"></i> Update
        </button>

        </div>
        </div>
</form>
    </div>
  </div>
 </div>

 <!-- ******************** -->
</div>

@endsection
