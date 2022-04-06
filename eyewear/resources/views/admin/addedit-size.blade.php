@extends('admin.layouts.app')

@section('title','Add / Edit Size')

@section('content')

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Add / Edit Size &nbsp; <i style="font-size:20px;" class="fas fa-asterisk"></i></h4>
<span style="float:right;"><a href="{{ route('size', [$category_parent_id, $sub_cat_id, $final_cat_id, $product_id,$size_option_id]) }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
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
  <form @if(isset($edit_size)) action="{{ route('update-size',[$category_parent_id,$sub_cat_id,$final_cat_id,$product_id,$size_option_id,$edit_size->id]) }}" @else action="{{ route('add-size',[$category_parent_id,$sub_cat_id,$final_cat_id,$product_id,$size_option_id]) }}" @endif method="post" enctype="multipart/form-data" class="form-horizontal">
  @csrf
  @if(isset($edit_size))
   @method('PUT')
  @else
   @method('POST')
  @endif

        <div class="card">
        <div class="card-header">
        <strong>Add / Edit Size</strong> Details
        </div>
        <div class="card-body card-block">



        <div class="row form-group">
      
        <div class="col-6 col-md-6">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Size</label>
        <input type="text" id="size" name="size" placeholder="Enter Size" class="form-control" @if(isset($edit_size)) value="{{ $edit_size->size }}" @else value="{{ old('size') }}" @endif >
        </div>
        
        <div class="col-12 col-md-4">
        <label for="select" class=" form-control-label" style="font-weight:520"> Status</label>
        <select name="status" id="status" class="form-control">
        <option value="Active" @isset($edit_size) @if($edit_size->status=='Active') selected @endif @endisset >Active</option>
        <option value="Inactive" @isset($edit_size) @if($edit_size->status=='Inactive') selected @endif @endisset  >Inactive</option>
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