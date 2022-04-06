@extends('admin.layouts.app')

@section('title','Manage Lens Index')

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
<h4 style="float:left;margin-top:5px;">Manage Lens Index &nbsp; <i style="font-size:20px;" class="fas fa-file-photo-o"></i></h4>

<div style="float:right;">
<span style="padding:8px;font-size:16px;box-shadow:2px 2px 2px grey;" class="badge badge-pill badge-secondary"><b>Total:</b> {{ $lens_index->total() }}</span>
&nbsp;&nbsp;
<span><a href="{{ route('add-lens-index-form') }}" class="btn btn-primary"> <i class="fa fa-plus"></i> Add Lens Index</a></span>

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



 <div class="container-fluid">
 <form action="{{ route('bottom-button-action-lens-index') }}" method="post" onsubmit="return checkboxValidation()">
  @csrf
  @method('PUT')
  <div class="row">
        <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-30">
        <table class="table table-borderless table-striped table-earning">
        <thead>
        <tr>
        <th class="text-center"><input type="checkbox" id="checkAll"> S.No</th>
        <th class="text-center">Index</th>
        <th class="text-center">Status</th>
        <th class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
     @php
     $i=1;
     $status="";
     @endphp
     @foreach($lens_index as $lens_index_data)
        <tr>
        <td class="text-center v-align"><input type="checkbox" name="lens_index_ids[]" id="ids[]" class="lens_index_ids" value="{{ $lens_index_data->id }}"/> {{ $i++ }}</td>
        <td class="text-center v-align">{{ $lens_index_data->lens_index }}</td>
        <td class="text-center v-align">
        @if($lens_index_data->status=="Active")
        <span class="badge badge-success">{{ $lens_index_data->status }}</span>
        @else
        <span class="badge badge-danger">{{ $lens_index_data->status }}</span>
        @endif
        </td>

        <td class="text-center v-align">
        <a title="Edit Lens Index" href="{{ route('edit-lens-index',$lens_index_data->id) }}" data-toggle="tooltip"><i class="fa fa-edit"></i></a>

        </td>
        </tr>
    @endforeach

        </tbody>
        </table>
        </div>
        </div>

      {{ $lens_index->links() }}

  </div>

<!-- BOTTOM BUTTONS -->

<div class="row" style="background-color:lightgrey;padding:10px;box-shadow:2px 2px 2px grey;">
 <div class="col-md-12">
   <!-- ******** -->
   <input type="submit" class="btn btn-success req_for" name="req_for" value="Active">
   <input type="submit" class="btn btn-danger req_for" name="req_for" value="Inactive" style="margin-left:10px;">
   <input type="submit" class="btn btn-danger req_for" name="req_for" value="Delete" style="float:right">


 </div>
</div>
</form>
 </div>
</div>

@endsection('content')
