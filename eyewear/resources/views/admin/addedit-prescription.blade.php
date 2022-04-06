@extends('admin.layouts.app')

@section('title','Add / Edit Prescription')

@section('content')

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Add / Edit Prescription &nbsp; <i style="font-size:20px;" class="fas fa-file-photo-o"></i></h4>
<span style="float:right;"><a href="{{ route('prescription-list',$type) }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
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
  <form @if(isset($edit_prescription)) action="{{ route('update-prescription',[$edit_prescription->id,$type]) }}" @else action="{{ route('add-prescription',$type) }}" @endif method="post" enctype="multipart/form-data" class="form-horizontal">
  @csrf
  @if(isset($edit_prescription))
   @method('PUT')
  @else
   @method('POST')
  @endif

        <div class="card">
        <div class="card-header">
        <strong>Add / Edit Prescription</strong> Details
        </div>
        <div class="card-body card-block">

        <div class="row form-group">
        <div class="col-6 col-md-6">
        <label for="text-input" class=" form-control-label" style="font-weight:520">{{ucwords(str_replace('_',' ',$type))}}</label>
        <input type="text" id="prescription_value" name="prescription_value" placeholder="Enter {{ucwords(str_replace('_',' ',$type))}}" class="form-control" @if(isset($edit_prescription)) value="@if($type=="sph_right"){{ $edit_prescription->sph_right }} @elseif($type=="sph_left") {{ $edit_prescription->sph_left }} @elseif($type=="cyl_right") {{ $edit_prescription->cyl_right }} @elseif($type=="cyl_left") {{ $edit_prescription->cyl_left }} @elseif($type=="axis_right") {{ $edit_prescription->axis_right }} @elseif($type=="axis_left") {{ $edit_prescription->axis_left }} @elseif($type=="add_right") {{ $edit_prescription->add_right }} @elseif($type=="add_left") {{ $edit_prescription->add_left }} @elseif($type=="limit_plus") {{ $edit_prescription->limit_plus }} @elseif($type=="limit_minus") {{ $edit_prescription->limit_minus }} @elseif($type=="pupillary_distance") {{ $edit_prescription->pupillary_distance }} @elseif($type=="pupillary_distance_right") {{ $edit_prescription->pupillary_distance_right }} @elseif($type=="pupillary_distance_left") {{ $edit_prescription->pupillary_distance_left }}@endif" @else value="{{ old('prescription_value') }}" @endif  required>
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