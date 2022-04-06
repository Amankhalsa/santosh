@extends('admin.layouts.app')

@section('title','Add / Edit Sub Lens Color Type')

@section('content')

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Add / Edit Sub Lens Color Type &nbsp; <i style="font-size:20px;" class="fas fa-list-alt"></i></h4>
<span style="float:right;"><a href="{{ route('manage-sub-lens-color-type', $category_parent_id) }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
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
  <form @if(isset($edit_subcategory)) action="{{ route('update-sub-lens-color-type', [$category_parent_id, $edit_subcategory->id]) }}" @else action="{{ route('add-sub-lens-color-type', $category_parent_id) }}" @endif method="post" enctype="multipart/form-data" class="form-horizontal">
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
              $cat_name = DB::table('lens_color_types')->where('id',$category_parent_id)->select('category_name')->first();
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


        <div class="row form-group">
        <div class="col-12 col-md-6">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Lens Color Type Name</label>
        <input type="text" id="category_name" name="category_name" placeholder="Enter Lens Color Type Name" class="form-control" @if(isset($edit_subcategory)) value="{{ $edit_subcategory->category_name }}" @else value="{{ old('category_name') }}" @endif >
        </div>
        
        <div class="col-12 col-md-3">
        <label for="select" class=" form-control-label" style="font-weight:520"> Tag Line</label>
       <input type="text" id="category_tag_line" name="category_tag_line" placeholder="Enter tag line" class="form-control" @if(isset($edit_subcategory)) value="{{ $edit_subcategory->category_tag_line }}" @else value="{{ old('category_tag_line') }}" @endif >
        </div>
        
        
</div>
    <div class="row form-group">
        
    <div class="col-12 col-md-2">
    <label for="select" class=" form-control-label" style="font-weight:520"> Price</label>
    <input type="number" id="category_price" name="category_price" placeholder="Enter Price" class="form-control" @if(isset($edit_subcategory)) value="{{ $edit_subcategory->category_price }}" @else value="{{ old('category_price') }}" @endif >
    </div>
        
        <div class="col-12 col-md-2">
        <label for="select" class=" form-control-label" style="font-weight:520"> Status</label>
        <select name="category_status" id="category_status" class="form-control">
        <option value="Active" @isset($edit_subcategory) @if($edit_subcategory->category_status=='Active') selected @endif @endisset >Active</option>
        <option value="Inactive" @isset($edit_subcategory) @if($edit_subcategory->category_status=='Inactive') selected @endif @endisset  >Inactive</option>
        </select>
        </div>
        
        </div>

 <div class="row form-group">
    <div class="col-12 col-md-12">
    <label for="text-input" class=" form-control-label" style="font-weight:520"> Description</label>
    <textarea name="category_description" id="category_description" cols="30" rows="10" class="form-control">@if(isset($edit_subcategory) && !empty($edit_subcategory->category_description)){{ $edit_subcategory->category_description }}@else{{ old('category_description') }}@endif</textarea>
    </div>

    </div>

{{-- Script for advance text editor     --}}
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'category_description' );
    </script>

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
