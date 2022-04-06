@extends('admin.layouts.app')

@section('title','Add / Edit Color & image')

@section('content')

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Add / Edit Color & image &nbsp; <i style="font-size:20px;" class="fas fa-asterisk"></i></h4>
<span style="float:right;"><a href="{{ route('color', [$category_parent_id, $sub_cat_id, $final_cat_id, $product_id]) }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
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
  <form @if(isset($edit_color)) action="{{ route('update-color',[$category_parent_id,$sub_cat_id,$final_cat_id,$product_id,$edit_color->id]) }}" @else action="{{ route('add-color',[$category_parent_id,$sub_cat_id,$final_cat_id,$product_id]) }}" @endif method="post" enctype="multipart/form-data" class="form-horizontal">
  @csrf
  @if(isset($edit_color))
   @method('PUT')
  @else
   @method('POST')
  @endif

        <div class="card">
        <div class="card-header">
        <strong>Add / Edit Color & image</strong> Details
        </div>
        <div class="card-body card-block">

<!-- DISPLAY IMAGE -->
  @isset($edit_color)    
   @php
    $color_images = DB::table('colors')->where('color_parent_id',$edit_color->id)->get();
   @endphp      
        <div class="row form-group">

        @foreach($color_images as $image)

        <div class="col-6 col-md-2" style="margin-bottom: 10px;">

        <img src="{{ asset('uploaded_files/category_more_images/'.$image->image) }}" style="width:100%;height:150px;" alt="image" title="image" class="rounded"/>
        <center><span><a href="{{ route('remove-color-image', [$category_parent_id, $sub_cat_id, $final_cat_id, $product_id, $image->id]) }}" data-toggle="tooltip" title="Delete Image" data-placement="right"><i class="fas fa-trash" style="color: #ff0011;font-size:24px;margin-top:5px;"></i></a></span></center>

      </div>

       @endforeach

        </div>

    @endisset

        <div class="row form-group">
      
        <div class="col-3 col-md-3">
          <label for="text-input" class=" form-control-label" style="font-weight:520">Color Images</label>
          <input type="file" id="image[]" name="image[]" class="form-control-file" multiple>
        </div>

        <div class="col-4 col-md-3">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Color</label>
        @if($product_colors->isNotEmpty())
         <select class="form-control" name="color" id="color">
           @foreach($product_colors as $color)
            <option value="{{$color->id}}" @if(isset($edit_color)) @if($edit_color->color==$color->id) selected @endif @endif>{{$color->color_name}}</option>
           @endforeach
         </select>
        @endif
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