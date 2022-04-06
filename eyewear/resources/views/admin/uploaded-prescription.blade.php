@extends('admin.layouts.app')

@section('title','Uploaded Prescription')

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
<h4 style="float:left;margin-top:5px;">Uploaded Prescription &nbsp; <i style="font-size:20px;" class="fas fa-user-secret"></i></h4>

<div style="float:right;">
<span style="padding:8px;font-size:16px;box-shadow:2px 2px 2px grey;" class="badge badge-pill badge-secondary"><b>Total:</b> {{ count($prescriptions) }}</span>
&nbsp;&nbsp;

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

@if($prescriptions->isNotEmpty())

 <div class="container-fluid">
 <form action="#" method="post" onsubmit="return checkboxValidation()">
  @csrf
  @method('PUT')
  <div class="row">

        <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-30">
        <table class="table table-borderless table-striped table-earning">
        <thead>
        <tr>
        <th class="text-center"><input type="checkbox" id="checkAll"> S.No</th>
        <th class="text-center">Prescription</th>
        <th class="text-center">Email</th>
        <th class="text-center">Action</th>
        <th class="text-center">Date</th>
        </tr>
        </thead>
        <tbody>
     @php
     $i=1;
     $status="";
     @endphp
     @foreach($prescriptions as $pres_data)
        <tr>
        <td class="text-center v-align"><input type="checkbox" name="uploaded_pres_ids[]" id="ids[]" class="uploaded_pres_ids" value="{{ $pres_data->id }}"/> {{ $i++ }}</td>
        <td class="text-center">
        <a href="{{ asset('/uploaded_files/prescription/'.$pres_data->prescription) }}"><img src="{{ asset('/uploaded_files/prescription/'.$pres_data->prescription) }}" alt="uploaded prescription image" title="uploaded prescription image" class="rounded" width="300"></a>
         </td>
        <td class="text-center v-align">{{ $pres_data->email }}</td>

        <td class="text-center v-align">
        <a title="Delete Prescription" href="{{ route('delete-prescription', $pres_data->id) }}" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
        </td>
        <td class="text-center v-align">{{ date('d-m-Y',strtotime($pres_data->date)) }}</td>
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
