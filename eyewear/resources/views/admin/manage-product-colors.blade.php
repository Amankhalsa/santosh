@extends('admin.layouts.app')

@section('title','Manage Product Color')

@section('content')

<style>
.swal-wide{
width:500px !important;
font-size:16px !important;
}
</style>

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-40px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Manage Product Color &nbsp; <i style="font-size:20px;" class="fas fa-file-photo-o"></i></h4>

<div style="float:right;">
<span style="padding:8px;font-size:16px;box-shadow:2px 2px 2px grey;" class="badge badge-pill badge-secondary"><b>Total:</b> {{ COUNT($product_colors) }}</span>
&nbsp;&nbsp;
<span><a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#addColorModal" onclick="$('.color_name').val('')"> <i class="fa fa-plus"></i> Add Color</a></span>

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
 <form action="{{ route('bottom-button-action-product-colors') }}" method="post" onsubmit="return checkboxValidation()">
  @csrf
  @method('PUT')
  <div class="row">
        <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-30">
        <table class="table table-borderless table-striped table-earning">
        <thead>
        <tr>
        <th class="text-center">S.No</th>
        <th class="text-center">Color Image</th>
        <th class="text-center">Color</th>
        <th class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
     @php
     $i = 1;
     $status="";
     @endphp
     @foreach($product_colors as $product_colors_data)
        <tr>
        <td class="text-center v-align"><input type="checkbox" name="product_color_ids[]" id="ids[]" class="product_color_ids" value="{{ $product_colors_data->id }}"/> {{ $i++ }}</td>
        
        <td class="text-center v-align">
           @if(!empty($product_colors_data->color_image_name))
        <img src="{{ asset('/uploaded_files/color_image/'.$product_colors_data->color_image_name) }}" style="width:40px;height:40px;" alt="category image" title="category image" class="rounded">
         @else
         <img src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:50px;height:50px;" alt="category" title="category" class="rounded"/>
         @endif   
        </td>    
        
       
    <td class="text-center v-align">{{ $product_colors_data->color_name }}</td>
    
    <td class="text-center v-align">
    <a title="Edit Color" href="javascript:void(0)" data-toggle="tooltip" onclick="editColor('{{$product_colors_data->id}}','{{$product_colors_data->color_name}}','{{$product_colors_data->color_code}}');"><i class="fa fa-edit"></i></a>

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
  
   <input type="submit" class="btn btn-danger req_for" name="req_for" value="Delete" style="float:right">


 </div>
</div>
</form>
 </div>
</div>

<!-- Company Credit Modal -->
<div class="modal" id="addColorModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title cmp_name_heading" >Product Color</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">

       <div class="credit_section">
         
       </div>

<form method="post" action="{{route('add-product-color')}}" enctype="multipart/form-data">
  @csrf
  @method('POST')
  
  <input type="file" name="color_image_name" class="form-control color_image_name"/><br>
  <input type="text" name="color_name" id="color_name" class="form-control color_name" placeholder="Enter Color Name" required/><br>
  
  <input type="hidden" name="color_id" id="color_id" class="color_id">
  <br> 
  <input type="submit" name="submit" class="btn btn-primary" value="Submit">
</form>
      </div>

    </div>
  </div>
</div>

@endsection('content')
