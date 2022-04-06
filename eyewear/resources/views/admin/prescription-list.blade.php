@extends('admin.layouts.app')

@section('title','Prescription List')

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
<h4 style="float:left;margin-top:5px;">Prescription List &nbsp; <i style="font-size:20px;" class="fas fa-envelope"></i></h4>

<div style="float:right;">
    
<span style="padding:8px;font-size:16px;box-shadow:2px 2px 2px grey;" class="badge badge-pill badge-secondary"><b>Total:</b> {{ COUNT($prescription_data) }}</span>

&nbsp;&nbsp;
<span><a href="{{ route('add-prescription-form',$type) }}" class="btn btn-primary"> <i class="fa fa-plus"></i> Add</a></span>

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

@if($prescription_data->isNotEmpty())

 <div class="container-fluid">
 <form action="{{ route('bottom-button-action-prescription') }}" method="post" onsubmit="return checkboxValidation()">
  @csrf
  @method('PUT')
  <div class="row">
        <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-30">
        <table class="table table-borderless table-striped table-earning">
        <thead>
        <tr>
        <th class="text-center"><input type="checkbox" id="checkAll"> S.No</th>
        <th class="text-center">{{str_replace('_',' ',$type)}}</th>
        <th class="text-center">Date</th>
        </tr>
        </thead>
        <tbody>
     @php
      $i=1;
     @endphp
     @foreach($prescription_data as $prescription_detail)
        <tr>
        <td class="text-center v-align">
            <input type="checkbox" name="prescription_ids[]" id="ids[]" class="prescription_ids" value="{{ $prescription_detail->id }}"/> {{ $i++ }}
            &nbsp;
            <a href="{{route('edit-prescription',[$prescription_detail->id,$type])}}"><i class="fas fa-edit"></i></a>
            </td>
       
        <td class="text-center v-align" >
         @if($type=="sph_right")    
            {{ $prescription_detail->sph_right }}
         @elseif($type=="sph_left")    
            {{ $prescription_detail->sph_left }}
         @elseif($type=="cyl_right")    
            {{ $prescription_detail->cyl_right }}
        @elseif($type=="cyl_left")    
            {{ $prescription_detail->cyl_left }}
        @elseif($type=="axis_right")    
            {{ $prescription_detail->axis_right }}
        @elseif($type=="axis_left")    
            {{ $prescription_detail->axis_left }}
        @elseif($type=="add_right")    
            {{ $prescription_detail->add_right }}
        @elseif($type=="add_left")    
            {{ $prescription_detail->add_left }}
            
        @elseif($type=="limit_plus")    
            {{ $prescription_detail->limit_plus }}
        @elseif($type=="limit_minus")    
            {{ $prescription_detail->limit_minus }}
            
        @elseif($type=="pupillary_distance")    
            {{ $prescription_detail->pupillary_distance }}    
        @elseif($type=="pupillary_distance_right")    
            {{ $prescription_detail->pupillary_distance_right }}
        @elseif($type=="pupillary_distance_left")    
            {{ $prescription_detail->pupillary_distance_left }}    
         @endif    
        </td>
        <td class="text-center v-align">{{ date("d-m-Y",strtotime($prescription_detail->date)) }}</td>
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
</form>
 </div>

 @else
 <div class="alert alert-danger fade show" id="no_record_found">
    <strong style="font-size: 22px">No Record Found...!</strong>
 </div>
 @endif

</div>

@endsection('content')
