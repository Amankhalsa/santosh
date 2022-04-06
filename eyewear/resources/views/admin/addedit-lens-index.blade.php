@extends('admin.layouts.app')

@section('title','Add / Edit Lens Index')

@section('content')

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Add / Edit Lens Index &nbsp; <i style="font-size:20px;" class="fas fa-file-photo-o"></i></h4>
<span style="float:right;"><a href="{{ route('manage-lens-index') }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
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
  <form @if(isset($edit_lens_index)) action="{{ route('update-lens-index',$edit_lens_index->id) }}" @else action="{{ route('add-lens-index') }}" @endif method="post" enctype="multipart/form-data" class="form-horizontal">
  @csrf
  @if(isset($edit_lens_index))
   @method('PUT')
  @else
   @method('POST')
  @endif

        <div class="card">
        <div class="card-header">
        <strong>Add / Edit Lens Index</strong> Details
        </div>
        <div class="card-body card-block">

        <div class="row form-group">
        <div class="col-6 col-md-6">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Lens Index Name</label>
        <input type="text" id="lens_index" name="lens_index" placeholder="Enter Lens Index Name" class="form-control" @if(isset($edit_lens_index)) value="{{ $edit_lens_index->lens_index }}" @else value="{{ old('lens_index') }}" @endif  required>
        </div>
      
      <div class="col-12 col-md-4">
        <label for="select" class=" form-control-label" style="font-weight:520"> Status</label>
        <select name="status" id="status" class="form-control">
        <option value="Active" @isset($edit_lens_index) @if($edit_lens_index->status=='Active') selected @endif @endisset >Active</option>
        <option value="Inactive" @isset($edit_lens_index) @if($edit_lens_index->status=='Inactive') selected @endif @endisset  >Inactive</option>
        </select>
        </div>
       
        </div>

    <div class="row form-group">
    <div class="col-12 col-md-12">
    <label for="text-input" class=" form-control-label" style="font-weight:520"> Description</label>
    <textarea name="description" id="description" cols="30" rows="10" class="form-control">@if(isset($edit_lens_index) && !empty($edit_lens_index->description)){{ $edit_lens_index->description }}@else{{ old('description') }}@endif</textarea>
    </div>
    
    </div>
    
    {{-- Script for advance text editor     --}}
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description' );
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