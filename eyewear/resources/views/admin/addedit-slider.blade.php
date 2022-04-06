@extends('admin.layouts.app')

@section('title','Add / Edit Slider')

@section('content')

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Add / Edit Slider &nbsp; <i style="font-size:22px;" class="fas fa-photo"></i></h4>
<span style="float:right;"><a href="{{ route('manage-slider') }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
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
  <form @if(isset($edit_slider)) action="{{ route('update-slider',$edit_slider->id) }}" @else action="{{ route('add-slider') }}" @endif method="post" enctype="multipart/form-data" class="form-horizontal">
  @csrf
  @if(isset($edit_slider))
   @method('PUT')
  @else
   @method('POST')
  @endif

        <div class="card">
        <div class="card-header">
        <strong>Add / Edit Slider</strong> Details
        </div>
        <div class="card-body card-block">

<!-- DISPLAY IMAGE -->
        <div class="row form-group">
        <div class="col col-md-7">
        @if(isset($edit_slider))
        <img src="{{ asset('slider/'.$edit_slider->slider_image_name) }}" style="width:80%;height:250px;" alt="slider" title="slider" class="img-thumbnail"/>
        @else
        <img src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:80%;height:250px;" alt="slider" title="slider" class="img-thumbnail"/>
        @endif

        </div>
        <div class="col-12 col-md-5">
        <input type="file" id="slider_image_name" name="slider_image_name" class="form-control-file" style="padding-top:100px;">
        </div>
        </div>


        <div class="row form-group">
        <div class="col-6 col-md-6">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Slider Caption 1</label>
        <input type="text" id="slider_title1" name="slider_title1" placeholder="Enter Slider Caption" class="form-control" @if(isset($edit_slider)) value="{{ $edit_slider->slider_title1 }}" @else value="{{ old('slider_title1') }}" @endif >
        </div>
      
        <div class="col-6 col-md-6">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Slider Caption 2</label>
        <input type="text" id="slider_title2" name="slider_title2" placeholder="Second Title" class="form-control" @if(isset($edit_slider)) value="{{ $edit_slider->slider_title2 }}" @else value="{{ old('slider_title2') }}" @endif >
        </div>

        </div>

        <div class="row form-group">
          
        <div class="col-6 col-md-4">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Slider Button Text</label>
        <input type="text" id="slider_button_text" name="slider_button_text" placeholder="Slider Button Text" class="form-control" @if(isset($edit_slider)) value="{{ $edit_slider->slider_button_text }}" @else value="{{ old('slider_button_text') }}" @endif >
        </div>

        <div class="col-6 col-md-4">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Slider Button Link</label>
        <input type="text" id="slider_button_link" name="slider_button_link" placeholder="Slider Button Link" class="form-control" @if(isset($edit_slider)) value="{{ $edit_slider->slider_button_link }}" @else value="{{ old('slider_button_link') }}" @endif >
        </div>

        <div class="col-12 col-md-4">
        <label for="select" class=" form-control-label" style="font-weight:520">Slider Status</label>
        <select name="slider_status" id="slider_status" class="form-control">
        <option value="Active" @isset($edit_slider) @if($edit_slider->slider_status=='Active') selected @endif @endisset >Active</option>
        <option value="Inactive" @isset($edit_slider) @if($edit_slider->slider_status=='Inactive') selected @endif @endisset  >Inactive</option>
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