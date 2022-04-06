@extends('admin.layouts.app')

@section('title','Add / Edit Lens')

@section('content')

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Add / Edit Lens &nbsp; <i style="font-size:20px;" class="fas fa-list-alt"></i></h4>
<span style="float:right;"><a href="{{ route('manage-lens') }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
</div>
</div>
</div>

<form @if(isset($edit_lens)) action="{{ route('update-lens', $edit_lens->id) }}" @else action="{{ route('add-lens') }}" @endif method="post" enctype="multipart/form-data" class="form-horizontal">
  @csrf
  @if(isset($edit_lens))
   @method('PUT')
  @else
   @method('POST')
  @endif
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
  <div class="col-lg-6">
  

<div class="card">
<div class="card-header">
  <nav>
        <ol class="breadcrumb" id="breadcrumb_cat">
         
          <strong>Lens Basic</strong> &nbsp; Details
       
    </ol>
  </nav>
</div>
<div class="card-body card-block">

<!-- DISPLAY IMAGE -->
        <div class="row form-group">
        <div class="col-6 col-md-6">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Lens Image</label>
        @if(isset($edit_lens) && !empty($edit_lens->lens_image_name))
        <img src="{{ asset('uploaded_files/lens/'.$edit_lens->lens_image_name) }}" style="width:100%;height:180px;" alt="lens" title="lens" class="rounded"/>
        <span><a href="{{ route('remove-lens-image', $edit_lens->id) }}">Remove Image</a></span>
        @else
        <img src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:100%;height:160px;" alt="lens" title="lens" class="rounded"/>
        @endif

        </div>
        <div class="col-6 col-md-6">
        <input type="file" id="lens_image_name" name="lens_image_name" class="form-control-file" style="margin-top:100px;" >
        </div>
        </div>


        <div class="row form-group">
        <div class="col-12 col-md-6">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Lens Name</label>
        <input type="text" id="name" name="name" placeholder="Enter Lens Name" class="form-control" @if(isset($edit_lens)) value="{{ $edit_lens->name }}" @else value="{{ old('name') }}" @endif >
        </div>
        
        <div class="col-12 col-md-6">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Lens Brand</label>
        <select name="brand" id="brand_id" class="form-control" onchange="getCoating('{{$admin_data->admin_website_url}}')">
        <option value="">-- Lens Brand --</option>
        @foreach($lens_brands as $brand)
    @isset($edit_lens)    
        <option value="{{$brand->id}}" @if($edit_lens->brand==$brand->id) selected @endif >{{$brand->category_name}}</option>
    @else
    <option value="{{$brand->id}}" @if(old('brand')==$brand->id) selected @endif >{{$brand->category_name}}</option>
    @endisset
        @endforeach
        </select>
        </div>

        </div>


        </div>
        
        </div>

    </div>
    
<div class="col-lg-6">


<div class="card">
<div class="card-header">
  <nav>
        <ol class="breadcrumb" id="breadcrumb_cat">
         
          <strong>Lens Attributes</strong> &nbsp; Details
       
    </ol>
  </nav>
</div>
<div class="card-body card-block">

    <div class="row form-group">
    <div class="col-12 col-md-6">
    <label for="text-input" class=" form-control-label" style="font-weight:520">Lens Index</label>
     <select name="lens_index" class="form-control">
        <option value="">-- Lens Index --</option>
        @foreach($lens_index as $index)
    @isset($edit_lens)    
        <option value="{{$index->id}}" @if($edit_lens->lens_index==$index->id) selected @endif >{{$index->lens_index}}</option>
    @else
    <option value="{{$index->id}}" @if(old('lens_index')==$index->id) selected @endif >{{$index->lens_index}}</option>
    @endisset
        @endforeach
        </select>
    </div>

        <div class="col-12 col-md-6">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Lens Diameter</label>
        <input type="text" id="diameter" name="diameter" placeholder="Enter Lens Diameter" class="form-control" @if(isset($edit_lens)) value="{{ $edit_lens->diameter }}" @else value="{{ old('diameter') }}" @endif >
        </div>
        </div>
        
<div class="row form-group">
@isset($edit_lens)
 @if($copied_products->isNotEmpty() || !empty($edit_lens->category_group_ids))
  @php
   $group_ids = explode(',',$edit_lens->category_group_ids);
  @endphp
    <div class="col-12 col-md-6">
    <label for="select" class=" form-control-label" style="font-weight:520"> Group Lens</label>
    <select class="selectpicker" name="category_group_ids[]" id="category_group_ids" multiple data-live-search="true">
       @foreach($copied_products as $prd)
        <option value="{{$prd->id}}" @if(in_array($prd->id,$group_ids)) selected @endif>{{$prd->id}}</option>
       @endforeach
    </select>
    </div>
 @endif    
@endisset


<div class="col-12 col-md-6">
<label for="text-input" class=" form-control-label" style="font-weight:520">Vision</label>
<select class="form-control" name="vision_id" required>
<option value="">-- Select Vision --</option>
@foreach($visions as $vision)
@php
$check_subvision = DB::table('visions')->where('vision_parent_id',$vision->id)->count(); 
@endphp
@if($check_subvision>0)
@php
$subvisions=DB::table('visions')->where('vision_parent_id',$vision->id)->get();
@endphp
@foreach($subvisions as $subvision)
 @if(isset($edit_lens))
<option value="{{$subvision->id}}" @if($edit_lens->vision_id==$subvision->id) selected @endif >{{$subvision->vision_name}}</option>
@else
<option value="{{$subvision->id}}" @if(old('vision_id')==$subvision->id) selected @endif >{{$subvision->vision_name}}</option>
@endif
@endforeach

@else
@if(isset($edit_lens))
<option value="{{$vision->id}}" @if($edit_lens->vision_id==$vision->id) selected @endif>{{$vision->vision_name}}</option>
@else
<option value="{{$vision->id}}" @if(old('vision_id')==$vision->id) selected @endif>{{$vision->vision_name}}</option>
@endif
@endif


@endforeach
</select>
</div>
</div>


<div class="row form-group">

<div class="col-12 col-md-6">
<label for="text-input" class=" form-control-label" style="font-weight:520">Type</label>
<select class="form-control" name="color_type_id" id="color_type_id" onchange="colorTypeDetail('{{$admin_data->admin_website_url}}')" required>
<option value="">-- Select Type --</option>
@foreach($lens_color_types as $type)
@php
$check_subtype = DB::table('lens_color_types')->where('category_parent_id',$type->id)->count(); 
@endphp
@if($check_subtype>0)
@php
$subtypes=DB::table('lens_color_types')->where('category_parent_id',$type->id)->get();
@endphp
@foreach($subtypes as $subtype)
@if(isset($edit_lens))
<option value="{{$subtype->id}}" @if($edit_lens->color_type_id==$subtype->id) selected @endif>{{$subtype->category_name}}</option>
@else
<option value="{{$subtype->id}}" @if(old('color_type_id')==$subtype->id) selected @endif>{{$subtype->category_name}}</option>
@endif
@endforeach

@else
@if(isset($edit_lens))
<option value="{{$type->id}}" @if($edit_lens->color_type_id==$type->id) selected @endif >{{$type->category_name}}</option>
@else
<option value="{{$type->id}}" @if(old('color_type_id')==$type->id) selected @endif >{{$type->category_name}}</option>
@endif
@endif


@endforeach
</select>
</div>



</div>

<div class="row form-group">
<div class="col-12 col-md-6">
  <label for="text-input" class=" form-control-label" style="font-weight:520">Bifocal Type</label>
 <input type="text" id="bifocal_type" name="bifocal_type" placeholder="Enter Bifocal Type" class="form-control" @if(isset($edit_lens)) value="{{ $edit_lens->bifocal_type }}" @else value="{{ old('bifocal_type') }}" @endif > 
</div>      
</div>
        
</div>

</div>

</div>
    
    
<div class="col-lg-6">
<div class="card">
<div class="card-header">
<nav>
<ol class="breadcrumb" id="breadcrumb_cat">
 
  <strong>Lens Toggle</strong> &nbsp; Details

</ol>
</nav>
</div>
<div class="card-body card-block">

@if($lens_toggles->isNotEmpty())
<div class="row form-group">
 @foreach($lens_toggles as $toggle)          
<div class="col-12 col-md-6">
<input type="checkbox" name="lens_toggles[]" id="lens_toggles" @isset($edit_lens) @if(in_array($toggle->id,$edit_toggles)) checked @endif @endisset value="{{$toggle->id}}">
<label for="text-input" class=" form-control-label" style="font-weight:520">{{$toggle->toggle_name}}</label>
</div>
@endforeach

</div>
@endif

        
        <div class="row form-group">
    <div class="col-12 col-md-12">
    <label for="text-input" class=" form-control-label" style="font-weight:520">Lens Description</label>
    <textarea name="description" id="description" cols="15" rows="3" class="form-control">@if(isset($edit_lens) && !empty($edit_lens->description)){{ $edit_lens->description }}@else{{ old('description') }}@endif</textarea>
    </div>
</div>
</div>
</div>
</div>    
    
<div class="col-lg-6">
<div class="card">
<div class="card-header">
  <nav>
        <ol class="breadcrumb" id="breadcrumb_cat">
         
          <strong>Lens Ranges</strong> &nbsp; Details
       
    </ol>
  </nav>
</div>
<div class="card-body card-block">

<div class="row form-group">
<div class="col-12 col-md-6">
<label for="text-input" class=" form-control-label" style="font-weight:520">Min Sphere</label>
@php
$prescription_data = DB::table('prescription_data')->where('sph_left','!=','')->get();
@endphp         
<select name="min_sph" class="form-control min_sph">
<option value="">-- Select SPH (MIN) --</option>
@foreach($prescription_data as $data)
@isset($edit_lens)
 <option value="{{$data->sph_left}}" @if($edit_lens->min_sph==$data->sph_left) selected @endif >{{$data->sph_left}}</option>
@else
 <option value="{{$data->sph_left}}" @if(old('min_sph')==$data->sph_left) selected @endif >{{$data->sph_left}}</option>
@endisset
@endforeach
</select>
        </div>

<div class="col-12 col-md-6">
<label for="text-input" class=" form-control-label" style="font-weight:520">Max Sphere</label>
<select name="max_sph" class="form-control max_sph">
<option value="">-- Select SPH (MAX) --</option>
@foreach($prescription_data as $data)
@isset($edit_lens)
 <option value="{{$data->sph_left}}" @if($edit_lens->max_sph==$data->sph_left) selected @endif >{{$data->sph_left}}</option>
@else
 <option value="{{$data->sph_left}}" @if(old('max_sph')==$data->sph_left) selected @endif >{{$data->sph_left}}</option>
@endisset
@endforeach
</select>
</div>
</div>


<div class="row form-group">
<div class="col-12 col-md-6">
<label for="text-input" class=" form-control-label" style="font-weight:520">Min Cylinder</label>
@php
$prescription_data = DB::table('prescription_data')->where('cyl_left','!=','')->get();
@endphp         
<select name="min_cyl" class="form-control min_cyl">
<option value="">-- Select CYL (MIN) --</option>
@foreach($prescription_data as $data)
@isset($edit_lens)
 <option value="{{$data->cyl_left}}" @if($edit_lens->min_cyl==$data->cyl_left) selected @endif >{{$data->cyl_left}}</option>
@else
 <option value="{{$data->cyl_left}}" @if(old('min_cyl')==$data->cyl_left) selected @endif >{{$data->cyl_left}}</option>
@endisset
@endforeach
</select>
        </div>

<div class="col-12 col-md-6">
<label for="text-input" class=" form-control-label" style="font-weight:520">Max Cylinder</label>
<select name="max_cyl" class="form-control max_cyl">
<option value="">-- Select CYL (MAX) --</option>
@foreach($prescription_data as $data)
@isset($edit_lens)
 <option value="{{$data->cyl_left}}" @if($edit_lens->max_cyl==$data->cyl_left) selected @endif >{{$data->cyl_left}}</option>
@else
 <option value="{{$data->cyl_left}}" @if(old('max_cyl')==$data->cyl_left) selected @endif >{{$data->cyl_left}}</option>
@endisset
@endforeach
</select>
</div>
</div>
        

<div class="row form-group">
<div class="col-12 col-md-6">
<label for="text-input" class=" form-control-label" style="font-weight:520">Min ADD</label>
@php
$prescription_data = DB::table('prescription_data')->where('add_left','!=','')->get();
@endphp         
<select name="min_add" class="form-control min_add">
<option value="">-- Select ADD (MIN) --</option>
@foreach($prescription_data as $data)
@isset($edit_lens)
 <option value="{{$data->add_left}}" @if($edit_lens->min_add==$data->add_left) selected @endif >{{$data->add_left}}</option>
 @else
  <option value="{{$data->add_left}}" @if(old('min_add')==$data->add_left) selected @endif  >{{$data->add_left}}</option>
 @endisset
@endforeach
</select>
        </div>

<div class="col-12 col-md-6">
<label for="text-input" class=" form-control-label" style="font-weight:520">Max ADD</label>
<select name="max_add" class="form-control max_add">
<option value="">-- Select ADD (MAX) --</option>
@foreach($prescription_data as $data)
@isset($edit_lens)
 <option value="{{$data->add_left}}" @if($edit_lens->max_add==$data->add_left) selected @endif >{{$data->add_left}}</option>
 @else
  <option value="{{$data->add_left}}" @if(old('max_add')==$data->add_left) selected @endif >{{$data->add_left}}</option>
 @endisset
@endforeach
</select>
</div>
</div>

<div class="row form-group">
<div class="col-12 col-md-6">
<label for="text-input" class=" form-control-label" style="font-weight:520">Limit Minus</label>
@php
$prescription_data = DB::table('prescription_data')->where('limit_minus','!=','')->get();
@endphp 
<select name="limit_minus" class="form-control limit_minus">
<option value="">-- Select Limit (MINUS) --</option>
@foreach($prescription_data as $data)
@isset($edit_lens)
 <option value="{{$data->limit_minus}}" @if($edit_lens->limit_minus==$data->limit_minus) selected @endif >{{$data->limit_minus}}</option>
 @else
  <option value="{{$data->limit_minus}}" @if(old('limit_minus')==$data->limit_minus) selected @endif >{{$data->limit_minus}}</option>
 @endisset
@endforeach
</select>
</div>

<div class="col-12 col-md-6">
<label for="text-input" class=" form-control-label" style="font-weight:520">Limit Plus</label>
@php
$prescription_data = DB::table('prescription_data')->where('limit_plus','!=','')->get();
@endphp 
<select name="limit_plus" class="form-control limit_plus">
<option value="">-- Select Limit (PLUS) --</option>
@foreach($prescription_data as $data)
@isset($edit_lens)
 <option value="{{$data->limit_plus}}" @if($edit_lens->limit_plus==$data->limit_plus) selected @endif >{{$data->limit_plus}}</option>
 @else
  <option value="{{$data->limit_plus}}" @if(old('limit_plus')==$data->limit_plus) selected @endif >{{$data->limit_plus}}</option>
 @endisset
@endforeach
</select>
</div>
</div>

        

</div>

</div>

</div>

<div class="col-lg-6">
<div class="card">
<div class="card-header">
  <nav>
        <ol class="breadcrumb" id="breadcrumb_cat">
         
          <strong>Lens Prices</strong> &nbsp; Details
       
    </ol>
  </nav>
</div>
<div class="card-body card-block">

<div class="row form-group">
<div class="col-12 col-md-6">
<label for="text-input" class=" form-control-label" style="font-weight:520">Cost</label>
<input type="number" id="cost" name="cost" placeholder="Enter Cost" class="form-control" @if(isset($edit_lens)) value="{{ $edit_lens->cost }}" @else value="{{ old('cost') }}" @endif >
</div>

<div class="col-12 col-md-6">
<label for="text-input" class=" form-control-label" style="font-weight:520">Special Price</label>
<input type="number" id="price" name="price" placeholder="Enter Special Price" class="form-control" @if(isset($edit_lens)) value="{{ $edit_lens->price }}" @else value="{{ old('price') }}" @endif >
</div>

</div>



</div>

</div>

</div>

<div id="coating_section" class="col-lg-6">
@if(isset($edit_lens))    
<div class="card">
<div class="card-header">
<nav>
<ol class="breadcrumb" id="breadcrumb_cat">
 
  <strong>Coating & Price</strong> &nbsp; Details

</ol>
  </nav>
</div>
<div class="card-body card-block">
@if(COUNT($lens_coatings)==0)

@if($coatings->isNotEmpty())
 @foreach($coatings as $detail)
<div class="row form-group">
<div class="col-12">


<input type="hidden" name="coating_status[]" value="add" />
<input type="hidden" name="coating_id[]" id="coating_id" value="{{$detail->id}}">
<label for="text-input" class="form-control-label" style="font-weight:520">{{$detail->category_name}}</label>
</div>    
</div>

<div class="row form-group">

<div class="col-6">
<label for="text-input" class="form-control-label" style="font-weight:520">Cost</label>        
<input type="number" id="coating_cost" name="coating_cost[]" class="form-control" @if(isset($edit_lens)) value="{{ $edit_lens->coating_cost }}" @else value="{{ old('coating_cost') }}" @endif >
</div>

<div class="col-6">
<label for="text-input" class="form-control-label" style="font-weight:520">Price</label>        
<input type="number" id="coating_price" name="coating_price[]" class="form-control" @if(isset($edit_lens)) value="{{ $edit_lens->coating_price }}" @else value="{{ old('coating_price') }}" @endif >
</div>

</div>
@endforeach
@endif

@else

@foreach($lens_coatings as $coating)
@php
 $name=DB::table('lens_brands')->where('id',$coating->coating_id)->first();
@endphp

<div class="row form-group">
<div class="col-12">

<input type="hidden" name="coating_status[]" value="update" />
<input type="hidden" name="coating_id[]" value="{{$coating->id}}" />    
    
<label for="text-input" class=" form-control-label" style="font-weight:520">{{$name->category_name}}</label>
</div>
</div>
<div class="row form-group">
<div class="col-6">
<label for="text-input" class="form-control-label" style="font-weight:520">Cost</label>    
<input type="number" id="coating_cost" name="coating_cost[]" class="form-control" value="{{ $coating->coating_cost }}" >
</div>

<div class="col-6">
<label for="text-input" class="form-control-label" style="font-weight:520">Price</label>    
<input type="number" id="coating_price" name="coating_price[]" class="form-control" value="{{ $coating->coating_price }}" >
</div>

</div>
@endforeach
@endif

@if(COUNT($lens_coatings)>0)
@php
$id_array=array();
$check_lens_coating = DB::table('lens_coatings')->where('lens_id',$edit_lens->id)->get();
foreach($check_lens_coating as $check){
 $id_array[]=$check->coating_id;
}

$edit_coating = DB::table('lens_brands')->where('category_parent_id',$edit_lens->brand)->where('type','coating')->whereNotIn('id',$id_array)->get();
@endphp

@if($edit_coating->isNotEmpty())
 @foreach($edit_coating as $detail)
 
<div class="row form-group">
<div class="col-12">
<input type="hidden" name="coating_status[]" value="add" />
<input type="hidden" name="coating_id[]" id="coating_id" value="{{$detail->id}}">
<label for="text-input" class="form-control-label" style="font-weight:520">{{$detail->category_name}}</label>
</div>    
</div>

<div class="row form-group">

<div class="col-6">
<label for="text-input" class="form-control-label" style="font-weight:520">Cost</label>        
<input type="number" id="coating_cost" name="coating_cost[]" class="form-control" @if(isset($edit_lens)) value="{{ $edit_lens->coating_cost }}" @else value="{{ old('coating_cost') }}" @endif >
</div>

<div class="col-6">
<label for="text-input" class="form-control-label" style="font-weight:520">Price</label>        
<input type="number" id="coating_price" name="coating_price[]" class="form-control" @if(isset($edit_lens)) value="{{ $edit_lens->coating_price }}" @else value="{{ old('coating_price') }}" @endif >
</div>

</div>
@endforeach
@endif
@endif
</div>
</div>
@endif

</div>


<div id="color_tint" class="col-lg-6">
@if(isset($edit_lens))    
<div class="card">
<div class="card-header">
<nav>
<ol class="breadcrumb" id="breadcrumb_cat">
 
  <strong>Tint & Price</strong> &nbsp; Details

</ol>
  </nav>
</div>
<div class="card-body card-block">
@if(COUNT($lens_tints)==0)

@if($color_details->isNotEmpty())
 @foreach($color_details as $detail)
<div class="row form-group">
<div class="col-12">
<input type="hidden" name="tint_status[]" value="add" />
<input type="hidden" name="tint_id[]" id="tint_id" value="{{$detail->id}}">
<label for="text-input" class="form-control-label" style="font-weight:520">{{$detail->category_name}}</label>
</div>    
</div>

<div class="row form-group">


<div class="col-12">
<label for="text-input" class="form-control-label" style="font-weight:520">Price</label>        
<input type="number" id="tint_price" name="tint_price[]" class="form-control" @if(isset($edit_lens)) value="{{ $edit_lens->tint_price }}" @else value="{{ old('tint_price') }}" @endif >
</div>

</div>
@endforeach
@endif

@else

@foreach($lens_tints as $tint)
@php
 $name=DB::table('lens_color_types')->where('id',$tint->tint_id)->first();
@endphp

<div class="row form-group">
<div class="col-12">

<input type="hidden" name="tint_status[]" value="update" />
<input type="hidden" name="tint_id[]" value="{{$tint->id}}" />    
    
<label for="text-input" class=" form-control-label" style="font-weight:520">{{$name->category_name}}</label>
</div>
</div>
<div class="row form-group">

<div class="col-12">
<label for="text-input" class="form-control-label" style="font-weight:520">Price</label>    
<input type="number" id="tint_price" name="tint_price[]" class="form-control" value="{{ $tint->tint_price }}" >
</div>

</div>
@endforeach
@endif

@if(COUNT($lens_tints)>0)
@php
$id_array=array();
$check_lens_tint = DB::table('lens_tints')->where('lens_id',$edit_lens->id)->get();
foreach($check_lens_tint as $check){
 $id_array[]=$check->tint_id;
}

$edit_tint = DB::table('lens_color_types')->where('category_parent_id',$edit_lens->color_type_id)->whereNotIn('id',$id_array)->get();
@endphp

@if($edit_tint->isNotEmpty())
 @foreach($edit_tint as $detail)
 
<div class="row form-group">
<div class="col-12">
<input type="hidden" name="tint_status[]" value="add" />
<input type="hidden" name="tint_id[]" id="tint_id" value="{{$detail->id}}">
<label for="text-input" class="form-control-label" style="font-weight:520">{{$detail->category_name}}</label>
</div>    
</div>

<div class="row form-group">


<div class="col-12">
<label for="text-input" class="form-control-label" style="font-weight:520">Price</label>        
<input type="number" id="tint_price" name="tint_price[]" class="form-control" @if(isset($edit_lens)) value="{{ $edit_lens->tint_price }}" @else value="{{ old('tint_price') }}" @endif >
</div>

</div>
@endforeach
@endif
@endif
</div>
</div>
@endif

</div>


</div>
    
  </div>
 </div>
<div class="card-footer" style="box-shadow:2px 2px 2px grey;">
        <button type="submit" class="btn btn-primary btn-md">
        <i class="fa fa-send"></i> Submit
        </button>

        </div>
 <!-- ******************** -->
</div>
</form>
@endsection
