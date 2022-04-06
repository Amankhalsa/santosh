@extends('admin.layouts.app')

@section('title','Add / Edit Product')

@section('content')

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Add / Edit Product &nbsp; <i style="font-size:20px;" class="fas fa-list-alt"></i></h4>
<span style="float:right;"><a href="{{ route('manage-product', [$category_parent_id, $sub_cat_id, $final_cat_id]) }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
</div>
</div>
</div>

<div class="section__content section__content--p30">
<br>

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session('error') }}
</div>
@endif

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
  <form @if(isset($edit_product)) action="{{ route('update-product', [$category_parent_id, $sub_cat_id, $final_cat_id, $edit_product->id]) }}" @else action="{{ route('add-product', [$category_parent_id, $sub_cat_id, $final_cat_id]) }}" @endif method="post" enctype="multipart/form-data" class="form-horizontal">
  @csrf
  @if(isset($edit_product))
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
            $final_cat_name = DB::table('categories')->where('id',$final_cat_id)->select('category_name')->first();
            @endphp
            
            @if(!empty($cat_name->category_name)) 
            <li class="breadcrumb-item"><a href="{{ route('add-category') }}">
                {{ $cat_name->category_name }}    
            </a></li>
            @endif

            @if(!empty($sub_cat_name->category_name))    
            <li class="breadcrumb-item"><a href="{{ route('add-subcategory-form', $category_parent_id) }}">
                {{ $sub_cat_name->category_name }}
            </a></li>
            @endif    

            @if(!empty($final_cat_name->category_name))    
            <li class="breadcrumb-item"><a href="{{ route('add-finalcategory-form', [$category_parent_id, $sub_cat_id]) }}">
                {{ $final_cat_name->category_name }}
            </a></li>
            @endif    

            @isset($edit_product)
            <li class="breadcrumb-item active">{{ $edit_product->category_name }}</li>
            @endisset

            &nbsp;

            </ol>
            </nav>
        </div>
        <div class="card-body card-block">

<!-- DISPLAY IMAGE -->
        <div class="row form-group">
        <div class="col-3 col-md-3">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Product Front Image</label>
        @if(isset($edit_product) && !empty($edit_product->category_image_name))
        <img src="{{ asset('uploaded_files/product/'.$edit_product->category_image_name) }}" style="width:100%;height:180px;" alt="product" title="product" class="rounded"/>
        <span><a href="{{ route('remove-product-image', [$category_parent_id, $sub_cat_id, $final_cat_id, $edit_product->id]) }}">Remove Image</a></span>
        @else
        <img src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:100%;height:180px;" alt="product" title="product" class="rounded"/>
        @endif

        </div>
        <div class="col-3 col-md-3">
        <input type="file" id="category_image_name" name="category_image_name" class="form-control-file" style="margin-top:100px;" >
        </div>
        
        <!-- Back Image -->
        
        <div class="col-3 col-md-3">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Product Back Image</label>
        @if(isset($edit_product) && !empty($edit_product->category_image_name2))
        <img src="{{ asset('uploaded_files/product/'.$edit_product->category_image_name2) }}" style="width:100%;height:180px;" alt="product" title="product" class="rounded"/>
        <span><a href="{{ route('remove-product-back-image', [$category_parent_id, $sub_cat_id, $final_cat_id, $edit_product->id]) }}">Remove Back Image</a></span>
        @else
        <img src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:100%;height:180px;" alt="product" title="product" class="rounded"/>
        @endif

        </div>
        <div class="col-3 col-md-3">
        <input type="file" id="category_image_name2" name="category_image_name2" class="form-control-file" style="margin-top:100px;" >
        </div>
        
        </div>
        
<!-- Other Images -->
        <div class="row form-group">
        <div class="col-3 col-md-3">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Product Other Image</label>
        @if(isset($edit_product) && !empty($edit_product->category_image_name3))
        <img src="{{ asset('uploaded_files/product/'.$edit_product->category_image_name3) }}" style="width:100%;height:180px;" alt="product" title="product" class="rounded"/>
        <span><a href="{{ route('remove-product-image3', [$category_parent_id, $sub_cat_id, $final_cat_id, $edit_product->id]) }}">Remove Image</a></span>
        @else
        <img src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:100%;height:180px;" alt="product" title="product" class="rounded"/>
        @endif

        </div>
        <div class="col-3 col-md-3">
        <input type="file" id="category_image_name3" name="category_image_name3" class="form-control-file" style="margin-top:100px;" >
        </div>
        
        <!-- Image  -->
        
        <div class="col-3 col-md-3">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Product Other Image</label>
        @if(isset($edit_product) && !empty($edit_product->category_image_name4))
        <img src="{{ asset('uploaded_files/product/'.$edit_product->category_image_name4) }}" style="width:100%;height:180px;" alt="product" title="product" class="rounded"/>
        <span><a href="{{ route('remove-product-image4', [$category_parent_id, $sub_cat_id, $final_cat_id, $edit_product->id]) }}">Remove Back Image</a></span>
        @else
        <img src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:100%;height:180px;" alt="product" title="product" class="rounded"/>
        @endif

        </div>
        <div class="col-3 col-md-3">
        <input type="file" id="category_image_name4" name="category_image_name4" class="form-control-file" style="margin-top:100px;" >
        </div>
        
        </div>
        
<!-- Other Images -->
        <div class="row form-group">
        <div class="col-3 col-md-3">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Product Other Image</label>
        @if(isset($edit_product) && !empty($edit_product->category_image_name5))
        <img src="{{ asset('uploaded_files/product/'.$edit_product->category_image_name5) }}" style="width:100%;height:180px;" alt="product" title="product" class="rounded"/>
        <span><a href="{{ route('remove-product-image5', [$category_parent_id, $sub_cat_id, $final_cat_id, $edit_product->id]) }}">Remove Image</a></span>
        @else
        <img src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:100%;height:180px;" alt="product" title="product" class="rounded"/>
        @endif

        </div>
        <div class="col-3 col-md-3">
        <input type="file" id="category_image_name5" name="category_image_name5" class="form-control-file" style="margin-top:100px;" >
        </div>
        
        
        </div>

          {{-- Category Inner Banner --}}
        <div class="row form-group">
        <div class="col-6 col-md-8">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Category Banner</label>
        @if(isset($edit_product) && !empty($edit_product->category_inner_banner))
        <img src="{{ asset('uploaded_files/product/'.$edit_product->category_inner_banner) }}" style="width:100%;height:180px;" alt="category" title="category" class="rounded"/>
        <span><a href="{{ route('remove-product-banner', [$category_parent_id, $sub_cat_id, $final_cat_id, $edit_product->id]) }}">Remove Banner</a></span>
        @else
        <img src="{{ asset('admin_assets/images/no-banner.jpg') }}" style="width:100%;height:200px;" alt="category" title="category" class="rounded"/>
        @endif

        </div>
        <div class="col-6 col-md-4">
        <input type="file" id="category_inner_banner" name="category_inner_banner" class="form-control-file" style="margin-top:100px;" >
        </div>
        </div>


        <div class="row form-group">
        <div class="col-12 col-md-5">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Product Name</label>
        <input type="text" id="category_name" name="category_name" placeholder="Enter Product Name" class="form-control" @if(isset($edit_product)) value="{{ $edit_product->category_name }}" @else value="{{ old('category_name') }}" @endif >
        </div>

        <div class="col-12 col-md-2">
        <label for="select" class=" form-control-label" style="font-weight:520"> Status</label>
        <select name="category_status" id="category_status" class="form-control">
        <option value="Active" @isset($edit_product) @if($edit_product->category_status=='Active') selected @endif @endisset >Active</option>
        <option value="Inactive" @isset($edit_product) @if($edit_product->category_status=='Inactive') selected @endif @endisset  >Inactive</option>
        </select>
        </div>

        <div class="col-12 col-md-2">
        <label for="select" class=" form-control-label" style="font-weight:520"> Product For</label>
       <select name="category_for" id="category_for" class="form-control">
        <option value="Gentle Man" @isset($edit_product) @if($edit_product->category_for=='Gentle Man') selected @endif @endisset >Gentle Man</option>
        <option value="Woman" @isset($edit_product) @if($edit_product->category_for=='Woman') selected @endif @endisset  >Woman</option>
        <option value="Junior" @isset($edit_product) @if($edit_product->category_for=='Junior') selected @endif @endisset  >Junior</option>
        <option value="Unisex" @isset($edit_product) @if($edit_product->category_for=='Unisex') selected @endif @endisset  >Unisex</option>
        </select>
        </div>
 @isset($edit_product)
 @if($copied_products->isNotEmpty() || !empty($edit_product->category_group_ids))
  @php
   $group_ids = explode(',',$edit_product->category_group_ids);
  @endphp
    <div class="col-12 col-md-3">
    <label for="select" class=" form-control-label" style="font-weight:520"> Group Products</label>
    <select class="selectpicker" name="category_group_ids[]" id="category_group_ids" multiple data-live-search="true">
       @foreach($copied_products as $prd)
        <option value="{{$prd->id}}" @if(in_array($prd->id,$group_ids)) selected @endif>{{$prd->id}}</option>
       @endforeach
    </select>
    </div>
 @endif    
@endisset
        </div>

    <div class="row form-group">
     
     <div class="col-12 col-md-3">
      <label for="text-input" class=" form-control-label" style="font-weight:520"> EAN Code</label>
     <input type="text" id="category_sku_code" name="category_sku_code" placeholder="Enter Product EAN Code" class="form-control" @if(isset($edit_product)) value="{{ $edit_product->category_sku_code }}" @else value="{{ old('category_sku_code') }}" @endif >
     </div>
     
     <div class="col-12 col-md-2">
      <label for="text-input" class=" form-control-label" style="font-weight:520"> Product Shape</label>
     <select name="shape" id="shape" class="form-control">
      @if($shapes->isNotEmpty())    
       @foreach($shapes as $shape)    
        <option value="{{$shape->shape}}" @isset($edit_product) @if($edit_product->shape==$shape->shape) selected @endif @endisset >{{$shape->shape}}</option>
        @endforeach
       @endif
     </select>
     </div> 

     <div class="col-12 col-md-2">
      <label for="text-input" class=" form-control-label" style="font-weight:520">Product Type</label>
     <select name="type" id="type" class="form-control">
        @if($types->isNotEmpty())    
       @foreach($types as $type)    
        <option value="{{$type->type}}" @isset($edit_product) @if($edit_product->type==$type->type) selected @endif @endisset >{{$type->type}}</option>
        @endforeach
       @endif

     </select>
     </div>

    <div class="col-12 col-md-2">
      <label for="text-input" class=" form-control-label" style="font-weight:520"> Material</label>
     <select name="material" id="material" class="form-control">
        @if($materials->isNotEmpty())    
       @foreach($materials as $material)    
        <option value="{{$material->material}}" @isset($edit_product) @if($edit_product->material==$material->material) selected @endif @endisset >{{$material->material}}</option>
        @endforeach
       @endif

     </select>
     </div>
    
@php
if(isset($edit_product)){
 $vision_ids = explode(',',$edit_product->visions);
}
@endphp     
     <div class="col-12 col-md-3">
      <label for="text-input" class=" form-control-label" style="font-weight:520"> Visions</label>
     <select name="visions[]" id="visions" class="selectpicker" multiple>
        @if($visions->isNotEmpty())    
       @foreach($visions as $vision)    
        <option value="{{$vision->id}}" @isset($edit_product) @if(in_array($vision->id,$vision_ids)) selected @endif @endisset >{{$vision->vision_name}}</option>
        @endforeach
       @endif

     </select>
     </div>

    </div>
    
    <div class="row form-group">
    
<div class="col-12 col-md-2">
<input type="checkbox" name="available_with_lens" id="available_with_lens" @isset($edit_product->available_with_lens) @if($edit_product->available_with_lens=="Yes") checked @endif @endisset/>
<label for="select" class=" form-control-label" style="font-weight:520"> Available with lens?</label>

</div>
    
    <div class="col-12 col-md-2">
      <label for="text-input" class=" form-control-label" style="font-weight:520"> Frame Type</label>
     <select name="category_frame" id="category_frame" class="form-control">
        <option value="Eyeglasses" @isset($edit_product) @if($edit_product->category_frame=='Eyeglasses') selected @endif @endisset >Eyeglasses</option>
        <option value="Sunglasses" @isset($edit_product) @if($edit_product->category_frame=='Sunglasses') selected @endif @endisset  >Sunglasses</option>

     </select>
     </div>
    
    <div class="col-12 col-md-2">
      <label for="text-input" class=" form-control-label" style="font-weight:520"> Price</label>
     <input type="text" id="category_price" name="category_price" placeholder="Enter Product Price" class="form-control" @if(isset($edit_product)) value="{{ $edit_product->category_price }}" @else value="{{ old('category_price') }}" @endif >
     </div>
     
     <div class="col-12 col-md-2">
      <label for="text-input" class=" form-control-label" style="font-weight:520"> Discount Price</label>
     <input type="number" readonly class="form-control" @if(isset($edit_product)) value="{{ $edit_product->category_discount_price }}" @endif >
     </div> 
     
     <div class="col-12 col-md-2">
      <label for="text-input" class=" form-control-label" style="font-weight:520"> Quantity</label>
     <input type="number" min="0" id="category_qty" name="category_qty" placeholder="Enter Qty" class="form-control" @if(isset($edit_product)) value="{{ $edit_product->category_qty }}" @else value="{{ old('category_qty') }}" @endif >
     </div>
     
     <div class="col-12 col-md-2">
      <label for="text-input" class=" form-control-label" style="font-weight:520"> UAN Code</label>
     <input type="text" id="category_uan_code" name="category_uan_code" placeholder="Enter UAN Code" class="form-control" @if(isset($edit_product)) value="{{ $edit_product->category_uan_code }}" @else value="{{ old('category_uan_code') }}" @endif >
     </div>
     
    </div>
    
<div class="row form-group">
 <div class="col-12 col-md-3">
<label for="text-input" class=" form-control-label" style="font-weight:520"> Min Sphere</label>
@php
$prescription_data = DB::table('prescription_data')->where('sph_left','!=','')->get();
@endphp 
<select name="min_sph" class="form-control min_sph">
<option value="">-- Select SPH (MIN) --</option>
@foreach($prescription_data as $data)
@isset($edit_product)
 <option value="{{$data->sph_left}}" @if($edit_product->min_sph==$data->sph_left) selected @endif >{{$data->sph_left}}</option>
@else
<option value="{{$data->sph_left}}" @if(old('min_sph')==$data->sph_left) selected @endif >{{$data->sph_left}}</option>
@endisset

@endforeach
</select>
 </div>  

<div class="col-12 col-md-3">
<label for="text-input" class=" form-control-label" style="font-weight:520">Max Sphere</label>
<select name="max_sph" class="form-control max_sph">
<option value="">-- Select SPH (MAX) --</option>
@foreach($prescription_data as $data)
@isset($edit_product)
 <option value="{{$data->sph_left}}" @if($edit_product->max_sph==$data->sph_left) selected @endif>{{$data->sph_left}}</option>
@else
 <option value="{{$data->sph_left}}" @if(old('max_sph')==$data->sph_left) selected @endif>{{$data->sph_left}}</option>
@endisset
@endforeach
</select>
</div>     
    
<div class="col-12 col-md-3">
<label for="text-input" class=" form-control-label" style="font-weight:520">Min Cylinder</label>
@php
$prescription_data = DB::table('prescription_data')->where('cyl_left','!=','')->get();
@endphp         
<select name="min_cyl" class="form-control min_cyl">
<option value="">-- Select CYL (MIN) --</option>
@foreach($prescription_data as $data)
@isset($edit_product)
 <option value="{{$data->cyl_left}}" @if($edit_product->min_cyl==$data->cyl_left) selected @endif >{{$data->cyl_left}}</option>
@else
 <option value="{{$data->cyl_left}}" @if(old('min_cyl')==$data->cyl_left) selected @endif >{{$data->cyl_left}}</option>
@endisset
@endforeach
</select>
        </div>

<div class="col-12 col-md-3">
<label for="text-input" class=" form-control-label" style="font-weight:520">Max Cylinder</label>
<select name="max_cyl" class="form-control max_cyl">
<option value="">-- Select CYL (MAX) --</option>
@foreach($prescription_data as $data)
@isset($edit_product)
 <option value="{{$data->cyl_left}}" @if($edit_product->max_cyl==$data->cyl_left) selected @endif >{{$data->cyl_left}}</option>
@else
 <option value="{{$data->cyl_left}}" @if(old('max_cyl')==$data->cyl_left) selected @endif >{{$data->cyl_left}}</option>
@endisset
@endforeach
</select>
</div>    
     
</div>    

<div class="row form-group">
<div class="col-4 col-md-4">
<label for="text-input" class=" form-control-label" style="font-weight:520">
    Lens Type</label> <br>   
<select class="selectpicker" name="lens_type[]" multiple>
 @foreach($lens_types as $data)
  <option value="{{$data->id}}" @isset($edit_product) @if(!empty($edit_lens_type)) @if(in_array($data->id,$edit_lens_type)) selected @endif @endif @endisset>{{$data->lens_type}}</option>
 @endforeach
</select>    
</div> 

<div class="col-4 col-md-4">
<label for="text-input" class=" form-control-label" style="font-weight:520">
    Extra</label> <br>   
<select class="selectpicker" name="extra[]" multiple>
 @foreach($extras as $data)
  <option value="{{$data->id}}" @isset($edit_product) @if(!empty($edit_extra)) @if(in_array($data->id,$edit_extra)) selected @endif @endif @endisset>{{$data->extra}}</option>
 @endforeach
</select>    
</div> 

</div>    

<div class="row form-group">
<div class="col-12 col-md-12">
<label for="text-input" class=" form-control-label" style="font-weight:520">Product Short Description</label>
<textarea name="category_short_description" id="category_short_description" cols="15" rows="4" class="form-control">@if(isset($edit_product) && !empty($edit_product->category_short_description)){{ $edit_product->category_short_description }}@else{{ old('category_short_description') }}@endif</textarea>
</div>
</div>

{{-- Script for advance text editor --}}
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'category_short_description' );
</script>

        <div class="row form-group">
        <div class="col-12 col-md-12">
        <label for="text-input" class=" form-control-label" style="font-weight:520"> Product Description</label>
        <textarea name="category_description" id="category_description" cols="30" rows="10" class="form-control">@if(isset($edit_product) && !empty($edit_product->category_description)){{ $edit_product->category_description }}@else{{ old('category_description') }}@endif</textarea>
        </div>

        </div>

    {{-- Script for advance text editor --}}
        <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'category_description' );
        </script>

 {{-- Frame Size Section START --}}

    <div class="jumbotron" id="cat_jumbotron"><h4>Frame Dimension Information</h4></div>

    <div class="row form-group">
        <div class="col-2 col-md-2">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Lens Width</label>
        <input type="text" id="category_lens_width" name="category_lens_width" placeholder="Enter Lens Width" class="form-control" @if(isset($edit_product)) value="{{ $edit_product->category_lens_width }}" @else value="{{ old('category_lens_width') }}" @endif >
        </div>
        
        <div class="col-2 col-md-2">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Bridge</label>
        <input type="text" id="category_bridge" name="category_bridge" placeholder="Enter Bridge" class="form-control" @if(isset($edit_product)) value="{{ $edit_product->category_bridge }}" @else value="{{ old('category_bridge') }}" @endif >
        </div>
        
        <div class="col-2 col-md-2">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Arm Length</label>
        <input type="text" id="category_arm_length" name="category_arm_length" placeholder="Enter Arm Length" class="form-control" @if(isset($edit_product)) value="{{ $edit_product->category_arm_length }}" @else value="{{ old('category_arm_length') }}" @endif >
        </div>
        
        <div class="col-2 col-md-2">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Lens Height</label>
        <input type="text" id="category_lens_height" name="category_lens_height" placeholder="Enter Lens Height" class="form-control" @if(isset($edit_product)) value="{{ $edit_product->category_lens_height }}" @else value="{{ old('category_lens_height') }}" @endif >
        </div>
        
        <div class="col-2 col-md-2">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Total Width</label>
        <input type="text" id="category_total_width" name="category_total_width" placeholder="Enter Total Width" class="form-control" @if(isset($edit_product)) value="{{ $edit_product->category_total_width }}" @else value="{{ old('category_total_width') }}" @endif >
        </div>
        
    </div>
    
    {{-- Frame Color Section START --}}

    <div class="jumbotron" id="cat_jumbotron"><h4>Frame Color Information</h4></div>

    <div class="row form-group">
       
       <div class="col-5 col-md-5">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Color</label>
        @if($product_colors->isNotEmpty())
         <select class="form-control" name="category_color" id="category_color">
           @foreach($product_colors as $color)
            <option value="{{$color->id}}" @if(isset($edit_product)) @if($edit_product->category_color==$color->id) selected @endif @endif>{{$color->color_name}} </option>
           @endforeach
         </select>
        @endif
        </div>
   
    </div>

    {{-- SEO Section START --}}

    <div class="jumbotron" id="cat_jumbotron"><h4>SEO related information</h4></div>

    <div class="row form-group">
        <div class="col-12 col-md-12">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Product Meta Title</label>
        <input type="text" id="category_meta_title" name="category_meta_title" placeholder="Enter Product Meta Title" class="form-control" @if(isset($edit_product)) value="{{ $edit_product->category_meta_title }}" @else value="{{ old('category_meta_title') }}" @endif >
        </div>
    </div>

    <div class="row form-group">
        <div class="col-12 col-md-12">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Product Meta Keywords</label>
        <input type="text" id="category_meta_keywords" name="category_meta_keywords" placeholder="Enter Product Meta Keywords" class="form-control" @if(isset($edit_product)) value="{{ $edit_product->category_meta_keywords }}" @else value="{{ old('category_meta_keywords') }}" @endif >
        </div>
    </div>

    <div class="row form-group">
        <div class="col-12 col-md-12">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Product Meta Description</label>
        <textarea name="category_meta_description" id="category_meta_description" cols="20" rows="5" class="form-control" placeholder="Enter Product Meta Description">@if(isset($edit_product) && !empty($edit_product->category_meta_description)){{ $edit_product->category_meta_description }}@else{{ old('category_meta_description') }}@endif</textarea>
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
