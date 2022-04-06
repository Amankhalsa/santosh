@extends('admin.layouts.app')

@section('title','Manage Color & Image')

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
<h4 style="float:left;margin-top:5px;">Manage Color & Image &nbsp; <i style="font-size:20px;" class="fas fa-asterisk"></i></h4>

<div style="float:right;">
<span style="padding:8px;font-size:16px;box-shadow:2px 2px 2px grey;" class="badge badge-pill badge-secondary"><b>Total:</b> {{ count($colors) }}</span>
&nbsp;&nbsp;
<span ><a href="{{ route('manage-product', [$category_parent_id, $sub_cat_id, $final_cat_id]) }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
<span><a href="{{ route('add-color-form', [$category_parent_id, $sub_cat_id, $final_cat_id, $product_id]) }}" class="btn btn-primary"> <i class="fa fa-plus"></i> Add Color</a></span>

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

@if($colors->isNotEmpty())

 <div class="container-fluid">
  <form action="{{ route('bottom-button-color',[$category_parent_id,$sub_cat_id,$final_cat_id,$product_id]) }}" method="post" onsubmit="return checkboxValidation()">
  @csrf
  @method('PUT')
  <div class="row">

        <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-30">
        <table class="table table-borderless table-striped table-earning">
        <thead>
        <tr>
        <th class="text-center">S.No</th>
        <th class="text-center">Color</th>
        <th class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
     @php
     $i=1;
     $status="";
     @endphp
     @foreach($colors as $color_data)
      @php
       $prd_color = DB::table('product_colors')->where('id',$color_data->color)->first();
      @endphp
        <tr>
        <td class="text-center v-align"><input type="checkbox" name="color_ids[]" id="ids[]" class="color_ids" value="{{ $color_data->id }}"/> {{ $i++ }}</td>
       
        <td class="text-center v-align" >
          {{ $prd_color->color_name }} </td>
     

        <td class="text-center v-align">
        <a title="Edit Color" href="{{ route('edit-color',[$category_parent_id,$sub_cat_id,$final_cat_id,$product_id,$color_data->id]) }}" data-toggle="tooltip"><i class="fa fa-edit"></i></a>

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
</form>
 </div>

 @else
 <div class="alert alert-danger fade show" id="no_record_found">
    <strong style="font-size: 22px">No Record Found...!</strong>
 </div>
 @endif

</div>

@endsection('content')
