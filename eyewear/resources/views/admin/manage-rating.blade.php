@extends('admin.layouts.app')

@section('title','Manage Rating')

@section('content')

<style>
.swal-wide{
width:750px !important;
font-size:16px !important;
}
</style>

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Manage Rating &nbsp; <i style="font-size:20px;" class="fas fa-star"></i></h4>

<div style="float:right;">
<span style="padding:8px;font-size:16px;box-shadow:2px 2px 2px grey;" class="badge badge-pill badge-secondary"><b>Total:</b> {{ $ratings->total() }}</span>

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

@if($ratings->isNotEmpty())

 <div class="container-fluid">
 <form action="{{ route('bottom-button-action-rating') }}" method="post" onsubmit="return checkboxValidation()">
  @csrf
  @method('PUT')
  <div class="row">
        <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-30">
        <table class="table table-borderless table-striped table-earning">
        <thead>
        <tr>
        <th class="text-center"><input type="checkbox" id="checkAll"> S.No</th>
        <th class="text-center">Name</th>
        <th class="text-center">Rating</th>
        <th class="text-center">Date</th>
        </tr>
        </thead>
        <tbody>
     @php
     $i=1;
     $status="";
     @endphp
     @foreach($ratings as $ratings_data)

@php
 $user = DB::table('users')->select('name')->where('id',$ratings_data->user_id)->first();
@endphp

        <tr>
        <td class="text-center v-align"><input type="checkbox" name="rating_ids[]" id="ids[]" class="rating_ids" value="{{ $ratings_data->id }}"/> {{ $i++ }}</td>
        
        <td class="text-center v-align" >{{ $user->name }}</td>
        <td class="text-center v-align" >{{ $ratings_data->rating }}</td>
        
        {{-- <td class="text-center v-align"> 
          <a href="javascript:void(0)" title="View Review" data-toggle="tooltip" data-placement="left" onClick="view_review('{{ $ratings_data->review }}');"> <i class="fas fa-eye"></i></a></td> --}}

        <td class="text-center v-align">{{ date("d-m-Y",strtotime($ratings_data->created_at)) }}</td>
        </tr>
    @endforeach

        </tbody>
        </table>
        </div>
        </div>

      {{ $ratings->links() }}

  </div>

<!-- BOTTOM BUTTONS -->

<div class="row" style="background-color:lightgrey;padding:10px;box-shadow:2px 2px 2px grey;">
 <div class="col-md-12">
   <!-- ******** -->

{{-- <input type="submit" class="btn btn-success req_for" name="req_for" value="Active">
   <input type="submit" class="btn btn-danger req_for" name="req_for" value="Inactive" style="margin-left:10px;"> --}}

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
