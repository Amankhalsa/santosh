@extends('admin.layouts.app')

@section('title','Add / Edit Blog')

@section('content')

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Add / Edit Blog &nbsp; <i style="font-size:20px;" class="fas fa-newspaper"></i></h4>
<span style="float:right;"><a href="{{ route('manage-blog') }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
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
  <form @if(isset($edit_blog)) action="{{ route('update-blog',$edit_blog->id) }}" @else action="{{ route('add-blog') }}" @endif method="post" enctype="multipart/form-data" class="form-horizontal">
  @csrf
  @if(isset($edit_blog))
   @method('PUT')
  @else
   @method('POST')
  @endif

        <div class="card">
        <div class="card-header">
        <strong>Add / Edit Blog</strong> Details
        </div>
        <div class="card-body card-block">

<!-- DISPLAY IMAGE -->
        <div class="row form-group">
        <div class="col-7 col-md-7">
        @if(isset($edit_blog))
        <img src="{{ asset('blog/thumb/'.$edit_blog->blog_image_name) }}" style="width:50%;height:220px;" alt="blog" title="blog" class="rounded"/>
        @else
        <img src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:70%;height:230px;" alt="blog" title="blog" class="rounded"/>
        @endif

        </div>
        <div class="col-5 col-md-5">
        <input type="file" id="blog_image_name" name="blog_image_name" class="form-control-file" style="margin-top:100px;" >
        </div>
        </div>


        <div class="row form-group">

        <div class="col-12 col-md-8">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Blog Name</label>
        <input type="text" id="blog_name" name="blog_name" placeholder="Enter Blog Name" class="form-control" @if(isset($edit_blog)) value="{{ $edit_blog->blog_name }}" @else value="{{ old('blog_name') }}" @endif >
        </div>

        <div class="col-12 col-md-4">
        <label for="select" class=" form-control-label" style="font-weight:520"> Status</label>
        <select name="blog_status" id="blog_status" class="form-control">
        <option value="Active" @isset($edit_blog) @if($edit_blog->blog_status=='Active') selected @endif @endisset >Active</option>
        <option value="Inactive" @isset($edit_blog) @if($edit_blog->blog_status=='Inactive') selected @endif @endisset  >Inactive</option>
        </select>
        </div>

        </div>

        <div class="row form-group">
            <div class="col-12 col-md-12">
            <label for="text-input" class=" form-control-label" style="font-weight:520">Blog Description</label>
            <textarea name="blog_desc" id="blog_desc" cols="20" rows="5" class="form-control" placeholder="Enter Blog Description">@if(isset($edit_blog) && !empty($edit_blog->blog_desc)){{ $edit_blog->blog_desc }}@else{{ old('blog_desc') }}@endif</textarea>
            </div>
        </div>
   {{-- Script for advance text editor --}}
   <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
   <script>
       CKEDITOR.replace( 'blog_desc' );
   </script>

    {{-- SEO Section START --}}

    <div class="jumbotron" id="cat_jumbotron"><h4>SEO related information</h4></div>

    <div class="row form-group">
        <div class="col-12 col-md-12">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Blog Meta Title</label>
        <input type="text" id="blog_meta_title" name="blog_meta_title" placeholder="Enter Blog Meta Title" class="form-control" @if(isset($edit_blog)) value="{{ $edit_blog->blog_meta_title }}" @else value="{{ old('blog_meta_title') }}" @endif >
        </div>
    </div>

    <div class="row form-group">
        <div class="col-12 col-md-12">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Blog Meta Keywords</label>
        <input type="text" id="blog_meta_keywords" name="blog_meta_keywords" placeholder="Enter Blog Meta Keywords" class="form-control" @if(isset($edit_blog)) value="{{ $edit_blog->blog_meta_keywords }}" @else value="{{ old('blog_meta_keywords') }}" @endif >
        </div>
    </div>

    <div class="row form-group">
        <div class="col-12 col-md-12">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Blog Meta Description</label>
        <textarea name="blog_meta_description" id="blog_meta_description" cols="20" rows="4" class="form-control" placeholder="Enter Blog Meta Description">@if(isset($edit_blog) && !empty($edit_blog->blog_meta_description)){{ $edit_blog->blog_meta_description }}@else{{ old('blog_meta_description') }}@endif</textarea>
        </div>
    </div>



    {{-- SEO Section END --}}



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
