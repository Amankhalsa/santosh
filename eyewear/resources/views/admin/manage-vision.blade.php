@extends('admin.layouts.app')

@section('title','Manage Vision')

@section('content')

<style>
.swal-wide{
width:500px !important;
font-size:16px !important;
}
</style>

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Manage Vision &nbsp; <i style="font-size:20px;" class="fas fa-list-alt"></i></h4>

<div style="float:right;">
<span style="padding:8px;font-size:16px;box-shadow:2px 2px 2px grey;" class="badge badge-pill badge-secondary"><b>Total:</b> {{ $visions->total() }}</span>
&nbsp;&nbsp;
<span><a href="{{ route('add-vision-form') }}" class="btn btn-primary"> <i class="fa fa-plus"></i> Add Vision</a></span>

</div>

</div>
</div>
</div>

<div class="section__content section__content--p30">
<br>

@if(count($errors)>0)
<div class="alert alert-danger alert-dismissible fade show">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<strong>Errors Occured!</strong>
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


@if($visions->isNotEmpty())

 <div class="container-fluid">
 <form action="{{ route('bottom-button-action-vision') }}" method="post" onsubmit="return checkboxValidation()">
  @csrf
  @method('PUT')

  <div class="row">

        <div class="col-lg-12">

        <div class="card" id="card_categories">
        <div class="card-header">
        <nav>
        <ol class="breadcrumb" id="breadcrumb_cat">
            <strong>Vision </strong> &nbsp; Details
        </ol>
        </nav>
        </div>
        <div class="card-body card-block">

        <div class="table-responsive table--no-card m-b-30" id="table_categories">
        <table class="table table-borderless table-striped table-earning" style=" width:100%" id="table_layout">
        <thead>
        <tr>
        <th class="text-center"><input type="checkbox" id="checkAll"> S.No</th>
        <th class="text-center">Image</th>
        <th class="text-center">Name</th>
        <th class="text-center">Add</th>
        <th class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
     @php
     $i=1;
     $status="";
     @endphp
     @foreach($visions as $vision_data)

        <tr>
        <td class="text-center v-align"><input type="checkbox" name="vision_ids[]" id="ids[]" class="vision_ids" value="{{ $vision_data->id }}"/> {{ $i++ }}</td>
        <td class="text-center">
         @if(!empty($vision_data->vision_image_name))
        <img src="{{ asset('/uploaded_files/vision/'.$vision_data->vision_image_name) }}" style="width:40%;height:100px;" alt="vision image" title="vision image" class="rounded">
         @else
         <img src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:40%;height:90px;" alt="vision" title="vision" class="rounded"/>
         @endif

         </td>
        <td class="text-center v-align">
        <a href="{{route('manage-subvision',$vision_data->id)}}">{{ $vision_data->vision_name }} <i class="fas fa-arrow-right"></i></a>
        </td>

       <td class="text-center v-align">
        <a href="{{ route('add-subvision-form', $vision_data->id) }}" title="Add Sub vision" data-toggle="tooltip" class="btn btn-outline-secondary"> <i class="fas fa-plus"></i> Sub Vision </a>
        </td>


        <td class="text-center v-align">
        <a title="Edit Vision" href="{{ route('edit-vision', $vision_data->id) }}" data-toggle="tooltip"><i class="fa fa-edit"></i></a>

        </td>
        </tr>
    @endforeach

        </tbody>
        </table>
        </div>
        </div>

  </div>

<!-- BOTTOM BUTTONS -->

<div class="row" style="background-color:lightgrey;padding:10px;box-shadow:2px 2px 2px grey;">
 <div class="col-md-12">
   <!-- ******** -->
  


   <input type="submit" class="btn btn-danger req_for" name="req_for" value="Delete" style="float:right">


 </div>
</div>

</div></div>

</form>
 </div>
 <br>

{{ $visions->links() }}

 @else

 <div class="alert alert-danger fade show" id="no_record_found">
    <strong style="font-size: 22px">No Record Found...!</strong>
 </div>

@endif

</div>

@endsection('content')
