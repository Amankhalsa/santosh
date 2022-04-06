@extends('admin.layouts.app')

@section('title','Add / Edit Attribute')

@section('content')

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Add / Edit Attribute &nbsp; <i style="font-size:20px;" class="fas fa-list-alt"></i></h4>
<span style="float:right;"><a href="{{ route('attribute-list',$type) }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
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
  <form @if(isset($edit_attribute)) action="{{ route('update-attribute',[$edit_attribute->id,$type]) }}" @else action="{{ route('add-attribute',$type) }}" @endif method="post" enctype="multipart/form-data" class="form-horizontal">
  @csrf
  @if(isset($edit_attribute))
   @method('PUT')
  @else
   @method('POST')
  @endif

        <div class="card">
        <div class="card-header">
        <strong>Add / Edit Attribute</strong> Details
        </div>
        <div class="card-body card-block">

        <div class="row form-group">
        <div class="col-6 col-md-6">
        <label for="text-input" class=" form-control-label" style="font-weight:520">{{ucwords(str_replace('_',' ',$type))}}</label>
        <input type="text" id="attribute_value" name="attribute_value" placeholder="Enter {{ucwords(str_replace('_',' ',$type))}}" class="form-control" @if(isset($edit_attribute))value="@if($type=="shape"){{$edit_attribute->shape}}@elseif($type=="material"){{$edit_attribute->material}}@elseif($type=="type"){{$edit_attribute->type}}@elseif($type=="lens_type"){{$edit_attribute->lens_type}}@elseif($type=="extra"){{$edit_attribute->extra}}@endif" @else value="{{ old('attribute_value') }}" @endif  required>
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