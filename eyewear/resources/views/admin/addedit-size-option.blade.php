@extends('admin.layouts.app')

@section('title','Add / Edit Size Option')

@section('content')

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Add / Edit Size Option &nbsp; <i style="font-size:20px;" class="fas fa-asterisk"></i></h4>
<span style="float:right;"><a href="{{ route('size-option', [$category_parent_id, $sub_cat_id, $final_cat_id, $product_id]) }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
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
  <form @if(isset($edit_size_option)) action="{{ route('update-size-option',[$category_parent_id,$sub_cat_id,$final_cat_id,$product_id,$edit_size_option->id]) }}" @else action="{{ route('add-size-option',[$category_parent_id,$sub_cat_id,$final_cat_id,$product_id]) }}" @endif method="post" enctype="multipart/form-data" class="form-horizontal">
  @csrf
  @if(isset($edit_size_option))
   @method('PUT')
  @else
   @method('POST')
  @endif

        <div class="card">
        <div class="card-header">
        <strong>Add / Edit Size Option</strong> Details
        </div>
        <div class="card-body card-block">



        <div class="row form-group">
      
        <div class="col-6 col-md-5">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Size Option</label>
        <input type="text" id="size" name="size" placeholder="Enter Size Option" class="form-control" @if(isset($edit_size_option)) value="{{ $edit_size_option->size }}" @else value="{{ old('size') }}" @endif >
        </div>
        
         <div class="col-6 col-md-3">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Size Price</label>
        <input type="number" id="price" name="price" placeholder="Enter Size Price" class="form-control" @if(isset($edit_size_option)) value="{{ $edit_size_option->price }}" @else value="{{ old('price') }}" @endif >
        </div>
        
        <div class="col-12 col-md-4">
        <label for="select" class=" form-control-label" style="font-weight:520"> Status</label>
        <select name="status" id="status" class="form-control">
        <option value="Active" @isset($edit_size_option) @if($edit_size_option->status=='Active') selected @endif @endisset >Active</option>
        <option value="Inactive" @isset($edit_size_option) @if($edit_size_option->status=='Inactive') selected @endif @endisset  >Inactive</option>
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