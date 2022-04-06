@extends('admin.layouts.app')

@section('title','Manage Image Resize')

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
<h4 style="float:left;margin-top:5px;">Manage Brand page images &nbsp; <i style="font-size:20px;" class="fas fa-file-photo-o"></i></h4>

<div style="float:right;">
<span style="padding:8px;font-size:16px;box-shadow:2px 2px 2px grey;" 
class="badge badge-pill badge-danger"><b>Total:</b>{{count($brand_img)}} </span>
&nbsp;&nbsp;
<span><a href="{{route('manage.add_brands')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> Add brands</a></span>

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

  <div class="row">
        <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-30">
        <table class="table table-borderless table-striped table-earning">
        <thead>
        <tr>
        <th class="text-center" width="10%"> S.No</th>
        <th class="text-center"  width="40%">Name</th>
        <th class="text-center"  width="40%">Image</th>
        <th class="text-center"  width="20%">Status</th>
        <th class="text-center"  width="20%">Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach($brand_img  as $key  =>$value  )
            <tr>
        <td class="text-center" width="10%"> {{$key+1}}</td>
        <td class="text-center" width="10%"> {{$value->name}}</td>
        <td class="text-center"  width="40%">
            <a href="{{$value->url}}">
            <img src="{{asset($value->image)}}" width="100" title="{{$value->url}}">
            </a>
            </td>
        <td class="text-center"  width="20%">
                        @if($value->status != 'Active' )
            <span class="badge badge-success">Active</span>
            @else 
            <span class="badge badge-danger">InActive</span>
            @endif
        
        </td>
        <td class="text-center"  width="20%">
            <!--========== Active==========--> 

      <!--============= Active=================-->
      
            @if($value->status == 'Active' )
        <a href="#" onclick="return confirm('This function is disable from backend');">
            <i class="fa fa-eye" title="InActive"></i></a>
        @else
        <a href="#" onclick="return confirm('This function is disable from backend');">
            <i class="fa fa-eye" title="Active"></i></a>
         @endif
            <a href="{{route('manage.brandsedit',$value->id)}}" ><i class="fa fa-edit" title="Edit brand"></i></a>
          
            <a href="{{route('manage.delete_brands',$value->id)}}"
        onclick="return confirm('Do you want to delete ?');"><i class="fa fa-trash" title="Delete brand"></i></a></td>
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


 </div>
</div>
</form>
 </div>
</div>

@endsection('content')
