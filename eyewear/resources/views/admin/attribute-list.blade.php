@extends('admin.layouts.app')

@section('title','Attribute List')

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
<h4 style="float:left;margin-top:5px;">Attribute List &nbsp; <i style="font-size:20px;" class="fas fa-list-alt"></i></h4>

<div style="float:right;">

<span style="float:right;"><a href="{{route('manage-attribute-type')}}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
    
<span style="padding:8px;font-size:16px;box-shadow:2px 2px 2px grey;" class="badge badge-pill badge-secondary"><b>Total:</b> {{ COUNT($attribute_data) }}</span>

&nbsp;&nbsp;
<span><a href="{{ route('add-attribute-form',$type) }}" class="btn btn-primary"> <i class="fa fa-plus"></i> Add</a></span>
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

@if($attribute_data->isNotEmpty())

 <div class="container-fluid">
 <form action="{{ route('bottom-button-action-attribute') }}" method="post" onsubmit="return checkboxValidation()">
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
     @foreach($attribute_data as $attribute_detail)
        <tr>
        <td class="text-center v-align">
            <input type="checkbox" name="attribute_ids[]" id="ids[]" class="attribute_ids" value="{{ $attribute_detail->id }}"/> {{ $i++ }}
            &nbsp;
            <a href="{{route('edit-attribute',[$attribute_detail->id,$type])}}"><i class="fas fa-edit"></i></a>
            </td>
       
        <td class="text-center v-align" >
         @if($type=="shape")    
            {{ $attribute_detail->shape }}
         @elseif($type=="material")    
            {{ $attribute_detail->material }}
         @elseif($type=="type")    
            {{ $attribute_detail->type }}
        @elseif($type=="lens_type")    
            {{ $attribute_detail->lens_type }}
        @elseif($type=="extra")    
            {{ $attribute_detail->extra }}    
         @endif    
        </td>
        <td class="text-center v-align">{{ date("d-m-Y",strtotime($attribute_detail->date)) }}</td>
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
