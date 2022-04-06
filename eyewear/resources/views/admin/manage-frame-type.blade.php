@extends('admin.layouts.app')

@section('title','Manage product')

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

<h4 style="float:left;margin-top:5px;">Manage product &nbsp; <i style="font-size:20px;" class="fas fa-list-alt"></i></h4>

<div style="float:right;">

<span style="padding:8px;font-size:16px;box-shadow:2px 2px 2px grey;" class="badge badge-pill badge-secondary"><b>Total:</b> {{ $products->total() }}</span>



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


@if($products->isNotEmpty())

<div class="container" >
  <form class="cat-search-form form-inline" method="get" action="{{route('frame-type-filter')}}">
     @csrf
     @method('GET')
@isset($type)
 <span class="badge badge-pill badge-light" id="cat-filter-span" data-toggle="tooltip" title="Remove Filter">
 <a href="{{ route('manage-frame') }}">
  <i class="fas fa-filter" id="remove-filter-parent">
   <i class="fas fa-times" id="remove-filter-child"></i></i>
</a>
 </span> &nbsp;
@endisset
  <select class="form-control rounded-0" name="type" id="type">
    <option value="">-- Select Type --</option>
     <option value="Sunglasses" @isset($type) @if($type=="Sunglasses") selected @endif @endisset>Sunglasses</option>
     <option value="Eyeglasses" @isset($type) @if($type=="Eyeglasses") selected @endif @endisset>Eyeglasses</option>

     
  </select>
  
  <input type="search" class="form-control rounded-0" name="search_keyword" @if(isset($search_keyword)) value="{{$search_keyword}}" @endif placeholder="search your product.."/>
  
  <button type="submit" class="btn btn-primary rounded-0">Go</button>

    </div>
   </form> 
   </div>

 <div class="container-fluid">
 <form action="{{ route('bottom-button-all-frame') }}" method="post" onsubmit="return checkboxValidation()">
  @csrf
  @method('PUT')
  <div class="row">

<div class="col-lg-12">
<div class="card" id="card_categories">
    <div class="card-header">
    <nav>
     <ol class="breadcrumb" id="breadcrumb_cat">
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
        <th class="text-center">Material / Type</th>
        <!--<th class="text-center">Color</th>-->
        <th class="text-center">Price</th>
        <th class="text-center">Order</th>
        <th class="text-center">Status</th>
        </tr>
        </thead>
        <tbody>
     @php
     $i=1;
     $status="";
     @endphp
     @foreach($products as $product_data)

@php
$cat = DB::table('categories')->where('id',$product_data->category_parent_id)->first(); 
@endphp     
     
        <tr>
        <td class="text-center v-align">

 <input type="checkbox" name="category_ids[]" id="ids[]" class="category_ids" value="{{ $product_data->id }}"/> {{ $product_data->id }} 
    
  <a title="Edit Product" href="{{ route('edit-product', [0, 0, $cat->id, $product_data->id]) }}" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
    <br>
    <a title="Copy Frame" href="{{ route('copy-product', [0, 0, $cat->id, $product_data->id]) }}" data-toggle="tooltip"><i class="fa fa-copy"></i></a>    
   
    </td>
    
     <td class="text-center">
    

      <a target="_blank" href="{{url('/frame/'.$product_data->category_slug_name.'.html')}}">  
         @if(!empty($product_data->category_image_name))
        <img src="{{ asset('/uploaded_files/product/'.$product_data->category_image_name) }}" width="200" alt="product image" title="{{$product_data->category_for }}" class="img-fluid rounded">
         @else
         <img src="{{ asset('admin_assets/images/no_image.jpg') }}" width="200" alt="product" title="product" class="rounded"/>
         @endif
         </a>
<p>
    @if($product_data->category_is_top == "Yes")
         <span class="badge badge-pill" id="badge_category">Top</span>
    @endif
    @if($product_data->category_is_discount == "Yes")
         <span class="badge badge-pill" id="badge_category">Discount</span>
    @endif
    @if($product_data->category_deal == "Yes")
         <span class="badge badge-pill" id="badge_category">Deal</span>
    @endif
</p>    
         </td>
        <td class="text-center v-align">
         <a target="_blank" href="{{url('/frame/'.$product_data->category_slug_name.'.html')}}">{{$product_data->category_name}}</a>
        
        </td>
        <td class="text-center v-align">
         {{ $product_data->material }} / {{ $product_data->type }} / ({{$product_data->category_for }})
        </td>

       




       <td class="text-center v-align">
         {{ $product_data->category_price }} <i class="fas fa-inr"></i>
       </td>   

       

        <input type="hidden" name="category_order_by_ids[]" class="category_order_by_ids" value="{{ $product_data->id }}"/>

        <td class="text-center v-align"><input type="number" min="0" name="category_order_by[]" class="category_order_by form-control" value="{{ $product_data->category_order_by }}" style="background-color:whitesmoke;text-align:center;width:60px;" /></td>
        
        
        <td class="text-center v-align">
        @if($product_data->category_status=="Active")
        <span class="badge badge-success">{{ $product_data->category_status }}</span>
        @else
        <span class="badge badge-danger">{{ $product_data->category_status }}</span>
        @endif
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
   
   <input type="submit" class="btn btn-success req_for" name="req_for" value="Active">
   <input type="submit" class="btn btn-danger req_for" name="req_for" value="Inactive" style="margin-left:10px;">
   
    <input type="submit" class="btn btn-dark req_for" name="req_for" value="Set for Top" style="margin-left:10px;">
    <input type="submit" class="btn btn-light req_for" name="req_for" value="Remove from Top" style="margin-left:10px;">
    
   <input type="submit" class="btn btn-warning req_for" name="req_for" value="Set for Discount" style="margin-left:10px;">
   <input type="submit" class="btn btn-info req_for" name="req_for" value="Remove from Discount" style="margin-left:10px;">
   
   <input type="submit" class="btn btn-primary req_for" name="req_for" value="Set for Deal" style="margin-left:10px;">
   <input type="submit" class="btn btn-success req_for" name="req_for" value="Remove from Deal" style="margin-left:10px;">


   <input type="submit" class="btn btn-warning req_for" name="req_for" value="Update Order" style="margin-left:10px;">

   <input type="submit" class="btn btn-danger req_for" name="req_for" value="Delete" style="float:right">


 </div>
</div>
</div></div>
</form>

 </div>
 <br>
{{ $products->links() }}

 @else

 <div class="alert alert-danger fade show" id="no_record_found">
    <strong style="font-size: 22px">No Record Found...!</strong>
 </div>

 @endif
</div>

@endsection('content')
