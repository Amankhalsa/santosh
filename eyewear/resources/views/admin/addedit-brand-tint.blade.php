@extends('admin.layouts.app')

@section('title','Add / Edit Brand Tint')

@section('content')

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Add / Edit Brand Tint &nbsp; <i style="font-size:20px;" class="fas fa-list-alt"></i></h4>
<span style="float:right;"><a href="{{ route('manage-brand-tint', $category_parent_id) }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
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
  <form @if(isset($edit_subcategory)) action="{{ route('update-brand-tint', [$category_parent_id, $edit_subcategory->id]) }}" @else action="{{ route('add-brand-tint', $category_parent_id) }}" @endif method="post" enctype="multipart/form-data" class="form-horizontal">
  @csrf
  @if(isset($edit_subcategory))
   @method('PUT')
  @else
   @method('POST')
  @endif

        <div class="card">
        <div class="card-header">
          <nav>
            <ol class="breadcrumb" id="breadcrumb_cat">
             @php
              $cat_name = DB::table('lens_brands')->where('id',$category_parent_id)->select('category_name')->first();
             @endphp

            @if(!empty($cat_name->category_name))
            <li class="breadcrumb-item"><a href="{{ route('add-category') }}">{{ $cat_name->category_name }}</a></li>
            @endif

            @isset($edit_subcategory)
            <li class="breadcrumb-item active">{{ $edit_subcategory->category_name }}</li>
            @endisset

            &nbsp;

        </ol>
          </nav>
        </div>
        <div class="card-body card-block">

<!-- DISPLAY IMAGE -->
        <div class="row form-group">
        <div class="col-6 col-md-3">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Brand Tint Image</label>
        @if(isset($edit_subcategory) && !empty($edit_subcategory->category_image_name))
        <img src="{{ asset('uploaded_files/lens/'.$edit_subcategory->category_image_name) }}" style="width:100%;height:180px;" alt="category" title="category" class="rounded"/>
        <span><a href="{{ route('remove-brand-tint-image', $edit_subcategory->id) }}">Remove Image</a></span>
        @else
        <img src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:100%;height:160px;" alt="category" title="category" class="rounded"/>
        @endif

        </div>
        <div class="col-6 col-md-3">
        <input type="file" id="category_image_name" name="category_image_name" class="form-control-file" style="margin-top:100px;" >
        </div>
        </div>

        <div class="row form-group">
        <div class="col-12 col-md-6">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Tint Name</label>
        <input type="text" id="category_name" name="category_name" placeholder="Enter Tint Name" class="form-control" @if(isset($edit_subcategory)) value="{{ $edit_subcategory->category_name }}" @else value="{{ old('category_name') }}" @endif >
        </div>
        
        <div class="col-12 col-md-2">
        <label for="select" class=" form-control-label" style="font-weight:520"> Status</label>
        <select name="category_status" id="category_status" class="form-control">
        <option value="Active" @isset($edit_subcategory) @if($edit_subcategory->category_status=='Active') selected @endif @endisset >Active</option>
        <option value="Inactive" @isset($edit_subcategory) @if($edit_subcategory->category_status=='Inactive') selected @endif @endisset  >Inactive</option>
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
