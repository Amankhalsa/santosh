@extends('admin.layouts.app')

@section('title','Add / Edit Lens Toggle')

@section('content')

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Add / Edit Lens Toggle &nbsp; <i style="font-size:20px;" class="fas fa-eye"></i></h4>
<span style="float:right;"><a href="{{ route('lens-toggle') }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
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
  <form @if(isset($edit_lens_toggle)) action="{{ route('update-lens-toggle',$edit_lens_toggle->id) }}" @else action="{{ route('add-lens-toggle') }}" @endif method="post" enctype="multipart/form-data" class="form-horizontal">
  @csrf
  @if(isset($edit_lens_toggle))
   @method('PUT')
  @else
   @method('POST')
  @endif

        <div class="card">
        <div class="card-header">
        <strong>Add / Edit Lens Toggle</strong> Details
        </div>
        <div class="card-body card-block">

<!-- DISPLAY IMAGE -->
        <div class="row form-group">
        <div class="col-6 col-md-3">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Image</label>
        <br>
        @if(isset($edit_lens_toggle) && !empty($edit_lens_toggle->coating_image_name))
        <img src="{{ asset('uploaded_files/coating/'.$edit_lens_toggle->coating_image_name) }}" style="width:50%;height:100px;" alt="category" title="category" class="rounded"/>
        @else
        <img src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:100%;height:160px;" alt="category" title="category" class="rounded"/>
        @endif

        </div>
        <div class="col-6 col-md-3">
        <input type="file" id="coating_image_name" name="coating_image_name" class="form-control-file" style="margin-top:100px;" >
        </div>
        </div>

        <div class="row form-group">
        <div class="col-6 col-md-6">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Lens Toggle Name</label>
        <input type="text" id="toggle_name" name="toggle_name" placeholder="Enter Lens Toggle Name" class="form-control" @if(isset($edit_lens_toggle)) value="{{ $edit_lens_toggle->toggle_name }}" @else value="{{ old('toggle_name') }}" @endif  required>
        </div>
      
      <div class="col-12 col-md-4">
        <label for="select" class=" form-control-label" style="font-weight:520"> Status</label>
        <select name="toggle_status" id="toggle_status" class="form-control">
        <option value="Active" @isset($edit_lens_toggle) @if($edit_lens_toggle->toggle_status=='Active') selected @endif @endisset >Active</option>
        <option value="Inactive" @isset($edit_lens_toggle) @if($edit_lens_toggle->toggle_status=='Inactive') selected @endif @endisset  >Inactive</option>
        </select>
        </div>
       
        </div>


<div class="row form-group">
    <div class="col-12 col-md-12">
    <label for="text-input" class=" form-control-label" style="font-weight:520"> Description</label>
    <textarea name="toggle_desc" id="toggle_desc" cols="30" rows="10" class="form-control">@if(isset($edit_lens_toggle) && !empty($edit_lens_toggle->toggle_desc)){{ $edit_lens_toggle->toggle_desc }}@else{{ old('toggle_desc') }}@endif</textarea>
    </div>
    
    </div>
    
    {{-- Script for advance text editor     --}}
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'toggle_desc' );
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