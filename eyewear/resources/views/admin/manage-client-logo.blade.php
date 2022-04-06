@extends('admin.layouts.app')

@section('title','Manage Client Logo')

@section('content')

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Manage Client Logo &nbsp; <i style="font-size:20px;" class="fas fa-id-card"></i></h4>

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
  <form action="{{ route('add-client-logo') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
  @csrf
  @method('POST')

        <div class="card">
        <div class="card-header">
         <strong>Client Logos</strong>
        </div>
        <div class="card-body card-block">


@if($our_clients->isNotEmpty())

 <!-- DISPLAY IMAGE -->
        <div class="row form-group">

        @foreach($our_clients as $image)

        <div class="col-6 col-md-2" style="margin-bottom: 10px;">

        <img src="{{ asset('client_logo/'.$image->client_image_name) }}" style="width:100%;height:110px;" alt="client logo" title="client logo" class="rounded"/>
        <center><span><a href="{{ route('delete-client-logo', $image->id) }}" data-toggle="tooltip" title="Delete Image" data-placement="right"><i class="fas fa-trash" style="color: #ff0011;font-size:24px;margin-top:5px;"></i></a></span></center>

      </div>

       @endforeach

        </div>
@else

<div class="alert alert-danger fade show" id="no_record_found">
  <strong style="font-size: 22px">No Image Found...!</strong>
</div>


@endif


        </div>
        <div class="card-footer" style="box-shadow:2px 2px 2px grey;">

 <div class="row">
  <div class="col-7 col-md-3">
    <input type="file" id="client_image_name" name="client_image_name[]" class="form-control-file" multiple >
  </div>

<div class="col-1 col-md-1" style="margin:0;padding:0;">
  <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top" title="You can select multiple images for uploading"></i>
</div>

  <div class="col-4 col-md-3">
    <button type="submit" class="btn btn-primary btn-md">
    <i class="fa fa-send"></i> Submit
    </button>
 </div>
</div>
        </div>
        </div>
</form>
    </div>
  </div>
 </div>

 <!-- ******************** -->
</div>

@endsection
