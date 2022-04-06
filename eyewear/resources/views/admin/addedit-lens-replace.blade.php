@extends('admin.layouts.app')

@section('title','Add / Edit Lens Replace')

@section('content')

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Add / Edit Lens Replace &nbsp; <i style="font-size:22px;" class="fas fa-exchange-alt"></i></h4>
<span style="float:right;"><a href="{{ url('/admin/lens-replace') }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
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
  <form @if(isset($edit_lens_replace)) action="{{ route('update-lens-replace',$edit_lens_replace->id) }}" @else action="{{ route('add-lens-replace') }}" @endif method="post" enctype="multipart/form-data" class="form-horizontal">
  @csrf
  @if(isset($edit_lens_replace))
   @method('PUT')
  @else
   @method('POST')
  @endif

        <div class="card">
        <div class="card-header">
        <strong>Add / Edit Lens Replace</strong> Details
        </div>
        <div class="card-body card-block">

<!-- DISPLAY IMAGE -->
        <div class="row form-group">
        <div class="col col-md-7">
        @if(isset($edit_lens_replace))
        <img src="{{ asset('uploaded_files/'.$edit_lens_replace->replace_image_name) }}" style="width:80%;height:250px;" alt="replace image" title="replace image" class="img-thumbnail"/>
        @else
        <img src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:80%;height:250px;" alt="replace image" title="replace image" class="img-thumbnail"/>
        @endif

        </div>
        <div class="col-12 col-md-5">
        <input type="file" id="replace_image_name" name="replace_image_name" class="form-control-file" style="padding-top:100px;">
        </div>
        </div>


        <div class="row form-group">
          
        <div class="col-6 col-md-6">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Lens Replace Text</label>
        <input type="text" id="replace_text" name="replace_text" placeholder="Lens Replace Text" class="form-control" @if(isset($edit_lens_replace)) value="{{ $edit_lens_replace->replace_text }}" @else value="{{ old('replace_text') }}" @endif >
        </div>

        <div class="col-6 col-md-6">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Lens Replace Link</label>
        <input type="text" id="replace_link" name="replace_link" placeholder="Lens Replace Link" class="form-control" @if(isset($edit_lens_replace)) value="{{ $edit_lens_replace->replace_link }}" @else value="{{ old('replace_link') }}" @endif >
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