@extends('admin.layouts.app')

@section('title','Add / Edit Testimonial')

@section('content')

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Add / Edit Testimonial &nbsp; <i style="font-size:20px;" class="fas fa-quote-right"></i></h4>
<span style="float:right;"><a href="{{ route('manage-testimonial') }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
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
  <form @if(isset($edit_testimonial)) action="{{ route('update-testimonial',$edit_testimonial->id) }}" @else action="{{ route('add-testimonial') }}" @endif method="post" enctype="multipart/form-data" class="form-horizontal">
  @csrf
  @if(isset($edit_testimonial))
   @method('PUT')
  @else
   @method('POST')
  @endif

        <div class="card">
        <div class="card-header">
        <strong>Add / Edit Testimonial</strong> Details
        </div>
        <div class="card-body card-block">

<!-- DISPLAY IMAGE -->
        <div class="row form-group">
        <div class="col col-md-7">
        @if(isset($edit_testimonial))
        <img src="{{ asset('testimonial/'.$edit_testimonial->testimonial_image_name) }}" style="width:40%;height:220px;" alt="testimonial" title="testimonial" class="rounded-circle"/>
        @else
        <img src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:70%;height:200px;" alt="testimonial" title="testimonial" class="rounded-circle"/>
        @endif

        </div>
        <div class="col-12 col-md-5">
        <input type="file" id="testimonial_image_name" name="testimonial_image_name" class="form-control-file" style="padding-top:100px;" >
        </div>
        </div>


        <div class="row form-group">
        <div class="col-6 col-md-6">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Given by</label>
        <input type="text" id="testimonial_given_by" name="testimonial_given_by" placeholder="Enter Name" class="form-control" @if(isset($edit_testimonial)) value="{{ $edit_testimonial->testimonial_given_by }}" @else value="{{ old('testimonial_given_by') }}" @endif >
        </div>
      
        <div class="col-6 col-md-6">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Designation</label>
        <input type="text" id="testimonial_desig" name="testimonial_desig" placeholder="Enter Designation" class="form-control" @if(isset($edit_testimonial)) value="{{ $edit_testimonial->testimonial_desig }}" @else value="{{ old('testimonial_desig') }}" @endif >
        </div>
        </div>


        <div class="row form-group">

        <div class="col-6 col-md-6">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Company Name</label>
        <input type="text" id="testimonial_company" name="testimonial_company" placeholder="Enter Company Name" class="form-control" @if(isset($edit_testimonial)) value="{{ $edit_testimonial->testimonial_company }}" @else value="{{ old('testimonial_company') }}" @endif >
        </div>

        <div class="col-12 col-md-4">
        <label for="select" class=" form-control-label" style="font-weight:520"> Status</label>
        <select name="testimonial_status" id="testimonial_status" class="form-control">
        <option value="Active" @isset($edit_testimonial) @if($edit_testimonial->testimonial_status=='Active') selected @endif @endisset >Active</option>
        <option value="Inactive" @isset($edit_testimonial) @if($edit_testimonial->testimonial_status=='Inactive') selected @endif @endisset  >Inactive</option>
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