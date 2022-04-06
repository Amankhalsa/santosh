@extends('admin.layouts.app')

@section('title','Add / Edit Coupon')

@section('content')

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Add / Edit Coupon &nbsp; <i style="font-size:20px;" class="fas fa-gift"></i></h4>
<span style="float:right;"><a href="{{ route('manage-coupon') }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
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
  <form @if(isset($edit_coupon)) action="{{ route('update-coupon',$edit_coupon->id) }}" @else action="{{ route('add-coupon') }}" @endif method="post" enctype="multipart/form-data" class="form-horizontal">
  @csrf
  @if(isset($edit_coupon))
   @method('PUT')
  @else
   @method('POST')
  @endif

        <div class="card">
        <div class="card-header">
        <strong>Add / Edit Coupon</strong> Details
        </div>
        <div class="card-body card-block">


        <div class="row form-group">
        <div class="col-12 col-md-4">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Coupon Code</label>
        <input type="text" id="coupon_code" name="coupon_code" placeholder="Enter Coupon Code" class="form-control" @if(isset($edit_coupon)) value="{{ $edit_coupon->coupon_code }}" @else value="{{ old('coupon_code') }}" @endif >
        </div>
      
        <div class="col-12 col-md-4">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Coupon Amount</label>
        <input type="number" id="coupon_amount" name="coupon_amount" placeholder="Enter Coupon Amount" class="form-control" @if(isset($edit_coupon)) value="{{ $edit_coupon->coupon_amount }}" @else value="{{ old('coupon_amount') }}" @endif >
        </div>

        <div class="col-12 col-md-4">
        <label for="select" class=" form-control-label" style="font-weight:520"> Coupon Type</label>
        <select name="coupon_type" id="coupon_type" class="form-control">
        <option value="Fixed" @isset($edit_coupon) @if($edit_coupon->coupon_type=='Fixed') selected @endif @endisset >Fixed</option>
        <option value="Percent_off" @isset($edit_coupon) @if($edit_coupon->coupon_type=='Percent_off') selected @endif @endisset  >Percent off</option>
        </select>
        </div>
        </div>

        <div class="row form-group">
          <div class="col-12">
            <label for="text-area" class=" form-control-label" style="font-weight:520">Coupon Description</label> 
            <textarea type="text" name="coupon_desc" id="coupon_desc" class="form-control" placeholder="Enter Coupon Description">@if(isset($edit_coupon)){{$edit_coupon->coupon_desc}}@else{{ old('coupon_desc')}}@endif</textarea>
          </div>  
        </div>

        <div class="row form-group">

        <div class="col-12 col-md-4">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Coupon Condition</label>
        <input type="number" min="0" id="coupon_condition" name="coupon_condition" placeholder="E.g:- Order above 200rs" class="form-control" @if(isset($edit_coupon)) value="{{ $edit_coupon->coupon_condition }}" @else value="{{ old('coupon_condition') }}" @endif >
        </div>    

        <div class="col-12 col-md-4">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Coupon Expiry</label>
        <input type="date" id="coupon_expiry_date" name="coupon_expiry_date" class="form-control" @if(isset($edit_coupon)) value="{{ $edit_coupon->coupon_expiry_date }}" @else value="{{ old('coupon_expiry_date') }}" @endif >
        </div>

        <div class="col-12 col-md-4">
        <label for="select" class=" form-control-label" style="font-weight:520"> Status</label>
        <select name="coupon_status" id="coupon_status" class="form-control">
        <option value="Active" @isset($edit_coupon) @if($edit_coupon->coupon_status=='Active') selected @endif @endisset >Active</option>
        <option value="Inactive" @isset($edit_coupon) @if($edit_coupon->coupon_status=='Inactive') selected @endif @endisset  >Inactive</option>
        </select>
        </div>
        </div>




        </div>
        <div class="card-footer" style="box-shadow:2px 2px 2px grey;">
        <button type="submit" class="btn btn-primary btn-md">
        <i class="fa fa-send"></i> Submit
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