@extends('admin.layouts.app')

@section('title','Add / Edit Sub Vision')

@section('content')

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Add / Edit Sub Vision &nbsp; <i style="font-size:20px;" class="fas fa-list-alt"></i></h4>
<span style="float:right;"><a href="{{ route('manage-subvision', $vision_parent_id) }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
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
  <form @if(isset($edit_subvision)) action="{{ route('update-subvision', [$vision_parent_id, $edit_subvision->id]) }}" @else action="{{ route('add-subvision', $vision_parent_id) }}" @endif method="post" enctype="multipart/form-data" class="form-horizontal">
  @csrf
  @if(isset($edit_subvision))
   @method('PUT')
  @else
   @method('POST')
  @endif

        <div class="card">
        <div class="card-header">
          <nav>
            <ol class="breadcrumb" id="breadcrumb_cat">
             @php
              $cat_name = DB::table('visions')->where('id',$vision_parent_id)->select('vision_name')->first();
             @endphp

            @if(!empty($cat_name->vision_name))
            <li class="breadcrumb-item"><a href="{{ route('add-vision-form') }}">{{ $cat_name->vision_name }}</a></li>
            @endif

            @isset($edit_subvision)
            <li class="breadcrumb-item active">{{ $edit_subvision->vision_name }}</li>
            @endisset

            &nbsp;

        </ol>
          </nav>
        </div>
        <div class="card-body card-block">

<!-- DISPLAY IMAGE -->
        <div class="row form-group">
        <div class="col-6 col-md-3">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Sub Vision Image</label>
        @if(isset($edit_subvision) && !empty($edit_subvision->vision_image_name))
        <img src="{{ asset('uploaded_files/vision/'.$edit_subvision->vision_image_name) }}" style="width:100%;height:180px;" alt="category" title="category" class="rounded"/>
        <span><a href="{{ route('remove-subvision-image', [$vision_parent_id, $edit_subvision->id]) }}">Remove Image</a></span>
        @else
        <img src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:100%;height:160px;" alt="category" title="category" class="rounded"/>
        @endif

        </div>
        <div class="col-6 col-md-3">
        <input type="file" id="vision_image_name" name="vision_image_name" class="form-control-file" style="margin-top:100px;" >
        </div>
        </div>


        <div class="row form-group">
        <div class="col-12 col-md-9">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Sub Vision Name</label>
        <input type="text" id="vision_name" name="vision_name" placeholder="Enter Sub Vision Name" class="form-control" @if(isset($edit_subvision)) value="{{ $edit_subvision->vision_name }}" @else value="{{ old('vision_name') }}" @endif >
        </div>

         <div class="col-12 col-md-3">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Vision Price</label>
        <input type="number" id="vision_price" name="vision_price" placeholder="Enter Vision Price" class="form-control" @if(isset($edit_subvision)) value="{{ $edit_subvision->vision_price }}" @else value="{{ old('vision_price') }}" @endif >
        </div>

        </div>


    <div class="row form-group">
        <div class="col-12 col-md-12">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Sub Vision Description</label>
        <textarea name="vision_tag_line" id="vision_tag_line" cols="15" rows="4" class="form-control">@if(isset($edit_subvision) && !empty($edit_subvision->vision_tag_line)){{ $edit_subvision->vision_tag_line }}@else{{ old('vision_tag_line') }}@endif</textarea>
        </div>
    </div>
    
    <div class="row form-group">
    <div class="col-12 col-md-12">
    <label for="text-input" class=" form-control-label" style="font-weight:520">Sub Vision Description</label>
    <textarea name="vision_description" id="vision_description" cols="15" rows="3" class="form-control">@if(isset($edit_subvision) && !empty($edit_subvision->vision_description)){{ $edit_subvision->vision_description }}@else{{ old('vision_description') }}@endif</textarea>
    </div>
</div>

{{-- Script for advance text editor --}}
   <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
   <script>
       CKEDITOR.replace( 'vision_description' );
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
