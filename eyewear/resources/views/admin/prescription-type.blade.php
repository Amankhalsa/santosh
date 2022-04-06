@extends('admin.layouts.app')

@section('title','Prescription Type')

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
<h4 style="float:left;margin-top:5px;">Prescription Type &nbsp; <i style="font-size:20px;" class="fas fa-envelope"></i></h4>


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
 <form action="{{ route('bottom-button-action-enquiry') }}" method="post" onsubmit="return checkboxValidation()">
  @csrf
  @method('PUT')
  <div class="row">
        <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-30">
        <table class="table table-borderless table-striped table-earning">
        <thead>
        <tr>
        
        <th class="text-center">Right</th>
        <th class="text-center">Left</th>
        </tr>
        </thead>
        <tbody>
     
        <tr>
        <td class="text-center v-align" ><a href="{{route('prescription-list','sph_right')}}">SPH (R)</a></td>
        <td class="text-center v-align" ><a href="{{route('prescription-list','sph_left')}}">SPH (L)</td>
        </tr>
        
        <tr>
        <td class="text-center v-align" ><a href="{{route('prescription-list','cyl_right')}}">CYL (R)</a></td>
        <td class="text-center v-align" ><a href="{{route('prescription-list','cyl_left')}}">CYL (L)</td>
        </tr>
        
        <tr>
        <td class="text-center v-align" ><a href="{{route('prescription-list','axis_right')}}">AXIS (R)</a></td>
        <td class="text-center v-align" ><a href="{{route('prescription-list','axis_left')}}">AXIS (L)</td>
        </tr>
        
        <tr>
        <td class="text-center v-align" ><a href="{{route('prescription-list','add_right')}}">ADD (R)</a></td>
        <td class="text-center v-align" ><a href="{{route('prescription-list','add_left')}}">ADD (L)</td>
        </tr>
        
        <tr>
        <td class="text-center v-align" ><a href="{{route('prescription-list','limit_plus')}}">Limit (Plus)</a></td>
        <td class="text-center v-align" ><a href="{{route('prescription-list','limit_minus')}}">Limit (Minus)</td>
        </tr>
       
        <tr>
        <td class="text-center v-align" colspan="2"><a href="{{route('prescription-list','pupillary_distance')}}">Pupillary Distance</a></td>
        </tr>
        
        <tr>
        <td class="text-center v-align"><a href="{{route('prescription-list','pupillary_distance_right')}}">Pupillary Distance (R)</a></td>
        <td class="text-center v-align"><a href="{{route('prescription-list','pupillary_distance_left')}}">Pupillary Distance (L)</a></td>
        </tr>
   

        </tbody>
        </table>
        </div>
        </div>

      

  </div>

<!-- BOTTOM BUTTONS -->


</form>
 </div>



</div>

@endsection('content')
