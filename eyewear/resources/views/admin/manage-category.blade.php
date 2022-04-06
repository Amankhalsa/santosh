@extends('admin.layouts.app')

@section('title','Manage category')

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
<h4 style="float:left;margin-top:5px;">Manage category &nbsp; <i style="font-size:20px;" class="fas fa-list-alt"></i></h4>

<div style="float:right;">
<span style="padding:8px;font-size:16px;box-shadow:2px 2px 2px grey;" class="badge badge-pill badge-secondary"><b>Total:</b> {{ $categories->total() }}</span>
&nbsp;&nbsp;
<span><a href="{{ route('add-category') }}" class="btn btn-primary"> <i class="fa fa-plus"></i> Add Category</a></span>

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


@if($categories->isNotEmpty())

 @if($admin_data->admin_search_option == "Yes")
{{-- Search Form Start --}}

<div class="container" >
 <div class="row">
  <div class="col-12 offset-md-3 offset-sm-2">

  <form class="cat-search-form" method="post" action="{{ route('cat-search-form') }}">
  @csrf
  @method('POST')

 <div class="input-group mb-3">
@isset($search_keyword)
 <span class="badge badge-pill badge-light" id="cat-filter-span" data-toggle="tooltip" title="Remove Filter">
 <a href="{{ route('manage-category') }}">
  <i class="fas fa-filter" id="remove-filter-parent">
   <i class="fas fa-times" id="remove-filter-child"></i></i>
</a>
 </span> &nbsp;
@endisset

  <input class="au-input au-input--xl" type="text" name="search_keyword" placeholder="Search category by name..." @isset($search_keyword) value="{{ $search_keyword }}" @endisset required/>
   <div class="input-group-append">
    <span class="input-group-text" id="input-group-span-search-form" >
    <button class="btn btn-primary" type="submit" id="cat-search-btn" >
    <i class="zmdi zmdi-search" id="cat-search-icon"></i>
   </button></span>
  </div>
 </div>
</form>

  </div>
 </div>
</div>

{{-- Search Form End --}}
@endif

 <div class="container-fluid">
 <form action="{{ route('bottom-button-action-category') }}" method="post" onsubmit="return checkboxValidation()">
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
            <strong>Category </strong> &nbsp; Details
        </ol>
        </nav>
        </div>
        <div class="card-body card-block">

        <div class="table-responsive table--no-card m-b-30" id="table_categories">
        <table class="table table-borderless table-striped table-earning" style=" width:100%" id="table_layout">
        <thead>
        <tr>
        <th class="text-center"><input type="checkbox" id="checkAll"> S.No</th>
        <th class="text-center">Image</th>
        <th class="text-center">Name</th>
        <th class="text-center">Add</th>
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
     @foreach($categories as $category_data)

        <tr>
        <td class="text-center v-align"><input type="checkbox" name="category_ids[]" id="ids[]" class="category_ids" value="{{ $category_data->id }}"/> {{ $i++ }}</td>
        <td class="text-center">
         @if(!empty($category_data->category_image_name))
        <img src="{{ asset('/uploaded_files/cat/'.$category_data->category_image_name) }}" style="width:100%;height:100px;" alt="category image" title="category image" class="rounded">
         @else
         <img src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:100%;height:90px;" alt="category" title="category" class="rounded"/>
         @endif

    @if($category_data->category_for_home == "Yes")
         <br>
         <span class="badge badge-pill" id="badge_category"> <i class="fas fa-home" style="color:black"></i> &nbsp; Home</span>

    @endif
         </td>
        <td class="text-center v-align">
        <a href="{{ route('manage-subcategory', $category_data->id) }}" title="View Sub category" data-toggle="tooltip"> {{ $category_data->category_name }} <i class="fas fa-arrow-right"></i> </a>
        </td>

        <td class="text-center v-align">
        <a href="{{ route('add-subcategory-form', $category_data->id) }}" title="Add Sub category" data-toggle="tooltip" class="btn btn-outline-secondary"> <i class="fas fa-plus"></i> Sub Category </a>
        </td>

        <input type="hidden" name="category_order_by_ids[]" class="category_order_by_ids" value="{{ $category_data->id }}"/>

        <td class="text-center v-align"><input type="number" min="0" name="category_order_by[]" class="category_order_by form-control" value="{{ $category_data->category_order_by }}" style="background-color:whitesmoke;text-align:center;width:60px;" /></td>

        <td class="text-center v-align">
        @if($category_data->category_status=="Active")
        <span class="badge badge-success">{{ $category_data->category_status }}</span>
        @else
        <span class="badge badge-danger">{{ $category_data->category_status }}</span>
        @endif
        </td>

        <td class="text-center v-align">
        <a title="Edit Category" href="{{ route('edit', $category_data->id) }}" data-toggle="tooltip"><i class="fa fa-edit"></i></a>

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

   <input type="submit" class="btn btn-dark req_for" name="req_for" value="Set for home" style="margin-left:10px;">
   <input type="submit" class="btn btn-light req_for" name="req_for" value="Remove from home" style="margin-left:10px;">

   <input type="submit" class="btn btn-warning req_for" name="req_for" value="Update Order" style="margin-left:10px;">

   <input type="submit" class="btn btn-danger req_for" name="req_for" value="Delete" style="float:right">


 </div>
</div>

</div></div>

</form>
 </div>
 <br>

{{ $categories->links() }}

 @else

 <div class="alert alert-danger fade show" id="no_record_found">
    <strong style="font-size: 22px">No Record Found...!</strong>
 </div>

@endif

</div>

@endsection('content')
