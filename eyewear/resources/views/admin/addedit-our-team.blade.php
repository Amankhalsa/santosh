@extends('admin.layouts.app')

@section('title','Add / Edit Our Team')

@section('content')

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Add / Edit Our Team &nbsp; <i style="font-size:20px;" class="fas fa-user-secret"></i></h4>
<span style="float:right;"><a href="{{ route('manage-our-team') }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
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
  <form @if(isset($edit_our_team)) action="{{ route('update-member',$edit_our_team->id) }}" @else action="{{ route('add-member') }}" @endif method="post" enctype="multipart/form-data" class="form-horizontal">
  @csrf
  @if(isset($edit_our_team))
   @method('PUT')
  @else
   @method('POST')
  @endif

        <div class="card">
        <div class="card-header">
        <strong>Add / Edit Our Team</strong> Details
        </div>
        <div class="card-body card-block">

<!-- DISPLAY IMAGE -->
        <div class="row form-group">
        <div class="col-7 col-md-7">
        @if(isset($edit_our_team))
        <img src="{{ asset('our_team/'.$edit_our_team->member_image_name) }}" style="width:40%;height:220px;" alt="our team" title="our team" class="rounded-circle"/>
        @else
        <img src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:70%;height:230px;" alt="our team" title="our team" class="rounded-circle"/>
        @endif

        </div>
        <div class="col-5 col-md-5">
        <input type="file" id="member_image_name" name="member_image_name" class="form-control-file" style="margin-top:100px;" >
        </div>
        </div>


        <div class="row form-group">
        <div class="col-12 col-md-6">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Member Name</label>
        <input type="text" id="member_name" name="member_name" placeholder="Enter Member Name" class="form-control" @if(isset($edit_our_team)) value="{{ $edit_our_team->member_name }}" @else value="{{ old('member_name') }}" @endif >
        </div>

        <div class="col-12 col-md-6">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Member Designation</label>
        <input type="text" id="member_designation" name="member_designation" placeholder="Enter Designation" class="form-control" @if(isset($edit_our_team)) value="{{ $edit_our_team->member_designation }}" @else value="{{ old('member_designation') }}" @endif >
        </div>
        </div>


        <div class="row form-group">

        <div class="col-12 col-md-4">
        <label for="select" class=" form-control-label" style="font-weight:520"> Status</label>
        <select name="member_status" id="member_status" class="form-control">
        <option value="Active" @isset($edit_our_team) @if($edit_our_team->member_status=='Active') selected @endif @endisset >Active</option>
        <option value="Inactive" @isset($edit_our_team) @if($edit_our_team->member_status=='Inactive') selected @endif @endisset  >Inactive</option>
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
