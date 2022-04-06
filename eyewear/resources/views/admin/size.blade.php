@extends('admin.layouts.app')

@section('title','Manage Size')

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
<h4 style="float:left;margin-top:5px;">Manage Size &nbsp; <i style="font-size:20px;" class="fas fa-asterisk"></i></h4>

<div style="float:right;">
<span style="padding:8px;font-size:16px;box-shadow:2px 2px 2px grey;" class="badge badge-pill badge-secondary"><b>Total:</b> {{ count($sizes) }}</span>
&nbsp;&nbsp;
<span ><a href="{{ route('size-option', [$category_parent_id, $sub_cat_id, $final_cat_id,$product_id]) }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
<span><a href="{{ route('add-size-form', [$category_parent_id, $sub_cat_id, $final_cat_id, $product_id,$size_option_id]) }}" class="btn btn-primary"> <i class="fa fa-plus"></i> Add Size</a></span>

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

@if($sizes->isNotEmpty())

 <div class="container-fluid">
  <form action="{{ route('bottom-button-size',[$category_parent_id,$sub_cat_id,$final_cat_id,$product_id,$size_option_id]) }}" method="post" onsubmit="return checkboxValidation()">
  @csrf
  @method('PUT')
  <div class="row">

        <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-30">
        <table class="table table-borderless table-striped table-earning">
        <thead>
        <tr>
        <th class="text-center">S.No</th>
        <th class="text-center">Size</th>
        <th class="text-center">Status</th>
        <th class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
     @php
     $i=1;
     $status="";
     @endphp
     @foreach($sizes as $size_data)
        <tr>
        <td class="text-center v-align"><input type="checkbox" name="size_ids[]" id="ids[]" class="size_ids" value="{{ $size_data->id }}"/> {{ $i++ }}</td>
  
       
        <td class="text-center v-align" >
          {{ $size_data->size }} </td>
        <td class="text-center v-align">
        @if($size_data->status=="Active")
        <span class="badge badge-success">{{ $size_data->status }}</span>
        @else
        <span class="badge badge-danger">{{ $size_data->status }}</span>
        @endif
        </td>

        <td class="text-center v-align">
        <a title="Edit Size" href="{{ route('edit-size',[$category_parent_id,$sub_cat_id,$final_cat_id,$product_id,$size_option_id,$size_data->id]) }}" data-toggle="tooltip"><i class="fa fa-edit"></i></a>

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
   <input type="submit" class="btn btn-success req_for" name="req_for" value="Active">
   <input type="submit" class="btn btn-danger req_for" name="req_for" value="Inactive" style="margin-left:10px;">
   <input type="submit" class="btn btn-danger req_for" name="req_for" value="Delete" style="float:right">


 </div>
</div>
</form>
 </div>

 @else
 <div class="alert alert-danger fade show" id="no_record_found">
    <strong style="font-size: 22px">No Record Found...!</strong>
 </div>
 @endif

</div>

@endsection('content')
