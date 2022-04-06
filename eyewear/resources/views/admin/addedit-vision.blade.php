@extends('admin.layouts.app')

@section('title','Add / Edit Vision')

@section('content')

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Add / Edit Vision &nbsp; <i style="font-size:20px;" class="fas fa-list-alt"></i></h4>
<span style="float:right;"><a href="{{ route('manage-vision') }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
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
  <form @if(isset($edit_vision)) action="{{ route('update-vision', $edit_vision->id) }}" @else action="{{ route('add-vision') }}" @endif method="post" enctype="multipart/form-data" class="form-horizontal">
  @csrf
  @if(isset($edit_vision))
   @method('PUT')
  @else
   @method('POST')
  @endif

        <div class="card">
        <div class="card-header">
          <nav>
                <ol class="breadcrumb" id="breadcrumb_cat">
                  @if(isset($edit_vision))
                <li class="breadcrumb-item active">{{ $edit_vision->vision_name }}</li>
                  @else
                  <strong>Add / Edit Vision </strong> &nbsp; Details
                @endif
            </ol>
          </nav>
        </div>
        <div class="card-body card-block">

<!-- DISPLAY IMAGE -->
        <div class="row form-group">
        <div class="col-6 col-md-3">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Vision Image</label>
        @if(isset($edit_vision) && !empty($edit_vision->vision_image_name))
        <img src="{{ asset('uploaded_files/vision/'.$edit_vision->vision_image_name) }}" style="width:70%;height:200px;" alt="vision" title="vision" class="rounded"/>
        <span><a href="{{ route('remove-vision-image', $edit_vision->id) }}">Remove Image</a></span>
        @else
        <img src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:100%;height:160px;" alt="vision" title="vision" class="rounded"/>
        @endif

        </div>
        <div class="col-6 col-md-3">
        <input type="file" id="vision_image_name" name="vision_image_name" class="form-control-file" style="margin-top:100px;" >
        </div>
        </div>


        <div class="row form-group">
        <div class="col-12 col-md-8">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Vision Name</label>
        <input type="text" id="vision_name" name="vision_name" placeholder="Enter Vision Name" class="form-control" @if(isset($edit_vision)) value="{{ $edit_vision->vision_name }}" @else value="{{ old('vision_name') }}" @endif >
        </div>
        
       <div class="col-12 col-md-2">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Type</label>
        <select name="vision_type" id="vision_type" class="form-control">
        <option value="Single" @isset($edit_vision) @if($edit_vision->vision_type=='Single') selected @endif @endisset >Single</option>
        <option value="Reading" @isset($edit_vision) @if($edit_vision->vision_type=='Reading') selected @endif @endisset  >Reading</option>
        <option value="Bifocal" @isset($edit_vision) @if($edit_vision->vision_type=='Bifocal') selected @endif @endisset  >Bifocal</option>
        <option value="Progressive" @isset($edit_vision) @if($edit_vision->vision_type=='Progressive') selected @endif @endisset  >Progressive</option>
        <option value="Non-Prescription" @isset($edit_vision) @if($edit_vision->vision_type=='Non-Prescription') selected @endif @endisset  >Non-Prescription</option>
        </select>
        </div>

        <div class="col-12 col-md-2">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Is Power?</label>
        <select name="is_power" id="is_power" class="form-control">
        <option value="Yes" @isset($edit_vision) @if($edit_vision->is_power=='Yes') selected @endif @endisset >Yes</option>
        <option value="No" @isset($edit_vision) @if($edit_vision->is_power=='No') selected @endif @endisset  >No</option>
        </select>
        </div>

        </div>


<div class="row form-group">
    <div class="col-12 col-md-12">
    <label for="text-input" class=" form-control-label" style="font-weight:520">Vision Short Description</label>
    <textarea name="vision_tag_line" id="vision_tag_line" cols="15" rows="3" class="form-control">@if(isset($edit_vision) && !empty($edit_vision->vision_tag_line)){{ $edit_vision->vision_tag_line }}@else{{ old('vision_tag_line') }}@endif</textarea>
    </div>
</div>

<div class="row form-group">
    <div class="col-12 col-md-12">
    <label for="text-input" class=" form-control-label" style="font-weight:520">Vision Description</label>
    <textarea name="vision_description" id="vision_description" cols="15" rows="3" class="form-control">@if(isset($edit_vision) && !empty($edit_vision->vision_description)){{ $edit_vision->vision_description }}@else{{ old('vision_description') }}@endif</textarea>
    </div>
</div>

{{-- Script for advance text editor --}}
   <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
   <script>
       CKEDITOR.replace( 'vision_description' );
   </script>
   
   <div class="row form-group">
    <div class="col-12 col-md-12">
    <label for="text-input" class=" form-control-label" style="font-weight:520">Vision Disable Description</label>
    <textarea name="vision_disable_description" id="vision_disable_description" cols="15" rows="3" class="form-control">@if(isset($edit_vision) && !empty($edit_vision->vision_disable_description)){{ $edit_vision->vision_disable_description }}@else{{ old('vision_disable_description') }}@endif</textarea>
    </div>
</div>

{{-- Script for advance text editor --}}
   <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
   <script>
       CKEDITOR.replace( 'vision_disable_description' );
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
