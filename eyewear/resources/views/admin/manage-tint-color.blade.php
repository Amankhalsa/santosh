@extends('admin.layouts.app')

@section('title','Manage Tint Color')

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
<h4 style="float:left;margin-top:5px;">Manage Tint Color &nbsp; <i style="font-size:20px;" class="fas fa-list-alt"></i></h4>

<div style="float:right;">
<span style="padding:8px;font-size:16px;box-shadow:2px 2px 2px grey;" class="badge badge-pill badge-secondary"><b>Total:</b> {{ $finalcategories->total() }}</span>
&nbsp;&nbsp;

<span><a href="{{ route('manage-sub-lens-color-type',[$category_parent_id,$sub_cat_id]) }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
&nbsp;&nbsp;

<span><a href="{{ route('add-color-tint-form', [$category_parent_id, $sub_cat_id]) }}" class="btn btn-primary"> <i class="fa fa-plus"></i> Add Tint</a></span>

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


@if($finalcategories->isNotEmpty())

 
 <div class="container-fluid">
 <form action="{{ route('bottom-button-action-tint', [$category_parent_id, $sub_cat_id]) }}" method="post" onsubmit="return checkboxValidation()">
  @csrf
  @method('PUT')

  <input type="hidden" name="url" value="{{ Request::fullUrl() }}">
  @isset($search_keyword)
   <input type="hidden" name="keyword" value="{{ $search_keyword }}">
  @endisset

  <div class="row">

        <div class="col-lg-12">
        <div class="card" id="card_categories">
        <div class="card-header">
        <nav>
        <ol class="breadcrumb" id="breadcrumb_cat">
        @php
        $cat_name = DB::table('categories')->where('id',$category_parent_id)->select('category_name')->first();
        $sub_cat_name = DB::table('categories')->where('id',$sub_cat_id)->select('category_name')->first();
        @endphp

        @if(!empty($cat_name->category_name))
        <li class="breadcrumb-item"><a href="{{ route('manage-category') }}">{{ $cat_name->category_name }}</a></li>
        @endif

        @if(!empty($sub_cat_name->category_name))
        <li class="breadcrumb-item"><a href="{{ route('manage-subcategory', $category_parent_id) }}">{{ $sub_cat_name->category_name }}</a></li>
        @endif

        &nbsp;

        </ol>
        </nav>
    </div>
    <div class="card-body card-block">

        <div class="table-responsive table--no-card m-b-30" id="table_categories">
        <table class="table table-borderless table-striped table-earning" >
        <thead>
        <tr>
        <th class="text-center"><input type="checkbox" id="checkAll"> S.No</th>
        <th class="text-center">Image</th>
        <th class="text-center">Name</th>
        <th class="text-center">Order</th>
        <th class="text-center">Status</th>
        <th class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
     @php
     $i=1;
     $status="";
     @endphp
     @foreach($finalcategories as $finalcategory_data)
        <tr>
        <td class="text-center v-align"><input type="checkbox" name="category_ids[]" id="ids[]" class="category_ids" value="{{ $finalcategory_data->id }}"/> {{ $i++ }}</td>
        <td class="text-center">
         @if(!empty($finalcategory_data->category_image_name))
        <img src="{{ asset('/uploaded_files/finalcat/'.$finalcategory_data->category_image_name) }}" style="width:50%;height:100px;" alt="finalcategory image" title="finalcategory image" class="img-fluid rounded">
         @else
         <img src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:50%;height:100px;" alt="finalcategory" title="finalcategory" class="rounded"/>
         @endif

    @if($finalcategory_data->category_for_home == "Yes")
         <br>
         <span class="badge badge-pill" id="badge_category"> <i class="fas fa-home" style="color:black"></i> &nbsp; Home</span>

    @endif
         </td>
        <td class="text-center v-align">
        <!--<a href="{{ route('manage-product', [$category_parent_id, $sub_cat_id, $finalcategory_data->id]) }}" title="View Product" data-toggle="tooltip">--> {{ $finalcategory_data->category_name }} <!--<i class="fas fa-arrow-right"></i> </a>-->
        </td>

        <input type="hidden" name="category_order_by_ids[]" class="category_order_by_ids" value="{{ $finalcategory_data->id }}"/>

        <td class="text-center v-align"><input type="number" min="0" name="category_order_by[]" class="category_order_by form-control" value="{{ $finalcategory_data->category_order_by }}" style="background-color:whitesmoke;text-align:center;width:60px;" /></td>

        <td class="text-center v-align">
        @if($finalcategory_data->category_status=="Active")
        <span class="badge badge-success">{{ $finalcategory_data->category_status }}</span>
        @else
        <span class="badge badge-danger">{{ $finalcategory_data->category_status }}</span>
        @endif
        </td>

        <td class="text-center v-align">
        <a title="Edit Tint" href="{{ route('edit-color-tint', [$category_parent_id, $sub_cat_id, $finalcategory_data->id]) }}" data-toggle="tooltip"><i class="fa fa-edit"></i></a>

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

 
   <input type="submit" class="btn btn-warning req_for" name="req_for" value="Update Order" style="margin-left:10px;">

   <input type="submit" class="btn btn-danger req_for" name="req_for" value="Delete" style="float:right">


 </div>
</div>
</div></div>
</form>
 </div>
 <br>

{{ $finalcategories->links() }}

@else

 <div class="alert alert-danger fade show" id="no_record_found">
    <strong style="font-size: 22px">No Record Found...!</strong>
 </div>

@endif

</div>

@endsection('content')
