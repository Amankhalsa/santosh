@extends('admin.layouts.app')

@section('title','Edit Page')

@section('content')

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Edit Site Page &nbsp; <i style="font-size:20px;" class="fa fa-file-alt"></i></h4>
<span style="float:right;"><a href="{{url('/admin/manage-pages')}}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
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
  <form action="{{ url('/admin/manage-pages/page-update-form',$page_edit->id) }}" method="post" enctype="multipart/form-data" class="form-horizontal">
  @csrf
  @method('PUT')
        <div class="card">
        <div class="card-header">
        <strong>Edit Page</strong> Details
        </div>
        <div class="card-body card-block">

        <div class="row form-group">
        <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">Page Name</label>
        </div>
        <div class="col-12 col-md-4">
        <input type="text" id="page_name" name="page_name" placeholder="Page Name" class="form-control" value="{{ $page_edit->page_name }}">

        </div>

        <div class="col col-md-2">
            <label for="text-input" class=" form-control-label">Page Link</label>
            </div>
            <div class="col-12 col-md-3">
            <select class="form-control" name="page_link" id="page_link">
                <option value="/" @if($page_edit->page_link == "/") selected @endif >home</option>
                <option value="about-us" @if($page_edit->page_link == "about-us") selected @endif >about-us</option>
                <option value="contact-us" @if($page_edit->page_link == "contact-us") selected @endif >contact-us</option>
                <option value="blog" @if($page_edit->page_link == "blog") selected @endif >blog</option>
                <option value="track-order" @if($page_edit->page_link == "track-order") selected @endif >track-order</option>
                <option value="sunglasses" @if($page_edit->page_link == "sunglasses") selected @endif >sunglasses</option>
                <option value="whishlist" @if($page_edit->page_link == "whishlist") selected @endif >whishlist</option>
                <option value="eyeglasses" @if($page_edit->page_link == "eyeglasses") selected @endif >eyeglasses</option>
                <option value="faq" @if($page_edit->page_link == "faq") selected @endif >faq</option>
                <option value="return-and-exchange" @if($page_edit->page_link == "return-and-exchange") selected @endif >return-and-exchange</option>
                <option value="contact-lenses" @if($page_edit->page_link == "contact-lenses") selected @endif >contact-lenses</option>
                <option value="terms-and-conditions" @if($page_edit->page_link == "terms-and-conditions") selected @endif >terms-and-conditions</option>
                <option value="brands" @if($page_edit->page_link == "brands") selected @endif >brands</option>
                <option value="cancellation" @if($page_edit->page_link == "cancellation") selected @endif >cancellation</option>
                <option value="shipping" @if($page_edit->page_link == "shipping") selected @endif >shipping</option>
                <option value="privacy-policy" @if($page_edit->page_link == "privacy-policy") selected @endif >privacy-policy</option>
                <option value="payment-options" @if($page_edit->page_link == "payment-options") selected @endif >payment-options</option>
                <option value="track-order" @if($page_edit->page_link == "track-order") selected @endif >track-order</option>
                <option value="find-a-store" @if($page_edit->page_link == "find-a-store") selected @endif >find-a-store</option>
                

            </select>

            </div>

        </div>


        <div class="row form-group">
        <div class="col col-md-3">
        <label for="textarea-input" class=" form-control-label">Page Content</label>
        </div>
        <div class="col-12 col-md-9">
        <textarea name="page_content" id="page_content" rows="9" placeholder="Content..." class="form-control">{{ $page_edit->page_content }}</textarea>
        </div>
        </div>

          {{-- Script for advance text editor     --}}
        <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'page_content' );
        </script>

        <div class="row form-group">
            <div class="col col-md-3">
            <label for="text-input" class=" form-control-label">Page Meta Title</label>
            </div>
            <div class="col-12 col-md-9">
            <input type="text" id="page_meta_title" name="page_meta_title" placeholder="Enter Meta Title" class="form-control" value="{{ $page_edit->page_meta_title }}">

        </div>
        </div>

        <div class="row form-group">
            <div class="col col-md-3">
            <label for="text-input" class=" form-control-label">Page Meta Keywords</label>
            </div>
            <div class="col-12 col-md-9">
            <input type="text" id="page_meta_keywords" name="page_meta_keywords" placeholder="Enter Meta Keywords" class="form-control" value="{{ $page_edit->page_meta_keywords }}">

        </div>
        </div>

        <div class="row form-group">
            <div class="col col-md-3">
            <label for="textarea-input" class=" form-control-label">Page Meta Description</label>
            </div>
            <div class="col-12 col-md-9">
            <textarea name="page_meta_description" id="page_meta_description" rows="4" placeholder="Enter Meta Description" class="form-control">{{ $page_edit->page_meta_description }}</textarea>
        </div>
        </div>

        <div class="row form-group">
        <div class="col col-md-3">
        <label for="select" class=" form-control-label">Page Status</label>
        </div>
        <div class="col-12 col-md-4">
        <select name="page_status" id="page_status" class="form-control">
        <option value="Active" {{ ($page_edit->page_status=="Active") ? 'selected' : '' }} >Active</option>
        <option value="Inactive"  {{ ($page_edit->page_status=="Inactive") ? 'selected' : '' }} >Inactive</option>
        </select>
        </div>
        </div>
        
@if($page_edit->id==1)
 @if(!empty($page_edit->page_video))
<!-- DISPLAY IMAGE -->
        <div class="row form-group">
        <div class="col col-md-3">
        <label for="file-input" class=" form-control-label">Current Video</label>
        </div>
        <div class="col-12 col-md-9">
        <video width="320" height="200" controls>
        <source src="{{asset('uploaded_files/page/video/'.$page_edit->page_video)}}" type="video/mp4">
        </video>
        &nbsp;&nbsp;&nbsp;
        <span><a href="{{ route('remove-page-video', $page_edit->id) }}" data-toggle="tooltip" title="Remove Video" data-placement="right"><i style="color: red;" class="fas fa-times-circle"></i></a></span>
        </div>
        </div>
 @endif       

<!-- UPLOAD IMAGE -->
        <div class="row form-group">
        <div class="col col-md-3">
        <label for="file-input" class=" form-control-label">Upload Video</label>
        </div>
        <div class="col-12 col-md-9">
        <input type="file" id="page_video" name="page_video" class="form-control-file">
        </div>
        </div>
@endif

@if($page_edit->id==2)
 @if(!empty($page_edit->page_image))
<!-- DISPLAY IMAGE -->
        <div class="row form-group">
        <div class="col col-md-3">
        <label for="file-input" class=" form-control-label">Current Image</label>
        </div>
        <div class="col-12 col-md-9">
        <img src="{{ asset('uploaded_files/page/'. $page_edit->page_image) }}" alt="about page" width="150" height="150">
        &nbsp;&nbsp;&nbsp;
        <span><a href="{{ route('remove-page-image', $page_edit->id) }}" data-toggle="tooltip" title="Remove Image" data-placement="right"><i style="color: red;" class="fas fa-times-circle"></i></a></span>
        </div>
        </div>
 @endif       

<!-- UPLOAD IMAGE -->
        <div class="row form-group">
        <div class="col col-md-3">
        <label for="file-input" class=" form-control-label">Upload Image</label>
        </div>
        <div class="col-12 col-md-9">
        <input type="file" id="page_image" name="page_image" class="form-control-file">
        </div>
        </div>
@endif
        </div>
        <div class="card-footer" style="box-shadow:2px 2px 2px grey;">
        <button type="submit" class="btn btn-primary btn-md">
        <i class="fa fa-send"></i> Update
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
