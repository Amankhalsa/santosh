@extends('admin.layouts.app')

@section('title','Add / Edit Currency')

@section('content')

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Add / Edit Currency &nbsp; <i style="font-size:20px;" class="fas fa-rupee"></i></h4>
<span style="float:right;"><a href="{{ route('manage-currency') }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
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
  <form @if(isset($edit_currency)) action="{{ route('update-currency',$edit_currency->id) }}" @else action="{{ route('add-currency') }}" @endif method="post" enctype="multipart/form-data" class="form-horizontal">
  @csrf
  @if(isset($edit_currency))
   @method('PUT')
  @else
   @method('POST')
  @endif

        <div class="card">
        <div class="card-header">
        <strong>Add / Edit Currency</strong> Details
        </div>
        <div class="card-body card-block">


        <div class="row form-group">

        <div class="col-12 col-md-4">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Select Country</label>
        <select class="form-control" name="country_name">
            <option value="">--- Select Country ---</option>
          @foreach($countries as $country)
           <option value="{{$country->name}}" @isset($edit_currency) @if($edit_currency->country_name==$country->name) selected @endif @endisset>{{$country->name}}</option>
          @endforeach
        </select>
        </div>
        
        <div class="col-12 col-md-2">
       <label for="text-input" class=" form-control-label" style="font-weight:520">Currency Symbol</label>
        <input type="text" id="currency_symbol" name="currency_symbol" placeholder="Enter Currency Symbol" class="form-control" @if(isset($edit_currency)) value="{{ $edit_currency->currency_symbol }}" @else value="{{ old('currency_symbol') }}" @endif >
        </div>
        
        <div class="col-12 col-md-3">
       <label for="text-input" class=" form-control-label" style="font-weight:520">Exchange Rate</label>
        <input type="text" id="exchange_rate" name="exchange_rate" placeholder="Enter Exchange Rate" class="form-control" @if(isset($edit_currency)) value="{{ $edit_currency->exchange_rate }}" @else value="{{ old('exchange_rate') }}" @endif >
        </div>

        <div class="col-12 col-md-3">
        <label for="select" class=" form-control-label" style="font-weight:520"> Status</label>
        <select name="status" id="status" class="form-control">
        <option value="Active" @isset($edit_currency) @if($edit_currency->status=='Active') selected @endif @endisset >Active</option>
        <option value="Inactive" @isset($edit_currency) @if($edit_currency->status=='Inactive') selected @endif @endisset  >Inactive</option>
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
