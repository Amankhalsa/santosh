@extends('admin.layouts.app')

@section('title','Manage Lens')

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
<h4 style="float:left;margin-top:5px;">Manage Lens &nbsp; <i style="font-size:20px;" class="fas fa-list-alt"></i></h4>

<div style="float:right;">
<span style="padding:8px;font-size:16px;box-shadow:2px 2px 2px grey;" class="badge badge-pill badge-secondary"><b>Total:</b> {{ $lens->total() }}</span>
&nbsp;&nbsp;
<span><a href="{{ route('add-lens-form') }}" class="btn btn-primary"> <i class="fa fa-plus"></i> Add Lens</a></span>

@if(!empty($lens->total()>0))
<span><a href="{{ route('export-lens') }}" class="btn btn-warning"> <i class="fa fa-plus"></i> Export</a></span>
@endif

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


@if($lens->isNotEmpty())

<div class="container" >
  <form class="cat-search-form" method="get" action="{{route('lens-filter')}}">
     @csrf
     @method('GET')

    <div class="row">   


<div class="col-3"> 
  <label style="font-weight: 550;">Brands</label>:
  <select class="form-control" name="brand_wise" id="brand_wise">
    <option value="">-- Select Brand --</option>
    @foreach($brands as $brand)
      <option value="{{$brand->id}}" @isset($brand_wise) @if($brand_wise==$brand->id) selected @endif @endisset>{{$brand->category_name}}</option>
    @endforeach
  </select>
</div>

<div class="col-2"> 
  <label style="font-weight: 550;">Lens Index</label>:
  <select class="form-control" name="index_wise" id="index_wise">
    <option value="">-- Select Index --</option>
    @foreach($lens_index as $index)
      <option value="{{$index->id}}" @isset($index_wise) @if($index_wise==$index->id) selected @endif @endisset>{{$index->lens_index}}</option>
    @endforeach
  </select>
</div>

<div class="col-2"> 
<label style="font-weight: 550;">Vision</label>:
<select class="form-control" name="vision_wise" id="vision_wise">
    <option value="">-- Select Vision --</option>
    @foreach($lens_visions as $vision)
      <option value="{{$vision->id}}" @isset($vision_wise) @if($vision_wise==$vision->id) selected @endif @endisset>{{$vision->vision_name}}</option>
    @endforeach
  </select>
</div>


<div class="col-2"> 
<label style="font-weight: 550;">Lens Color</label>:
<select class="form-control" name="lens_color_wise" id="lens_color_wise">
    <option value="">-- Select Color Type --</option>
    @foreach($lens_color_types as $color_type)
      <option value="{{$color_type->id}}" @isset($lens_color_wise) @if($lens_color_wise==$color_type->id) selected @endif @endisset>{{$color_type->category_name}}</option>
    @endforeach
  </select>
</div>



 <div class="col-1">
  <br>
   <button type="submit" class="btn btn-primary">Go</button>
   
   @isset($is_filter)
 <span class="badge badge-pill badge-light" id="cat-filter-span" data-toggle="tooltip" title="Remove Filter">
 <a href="{{ route('manage-lens') }}">
  <i class="fas fa-filter" id="remove-filter-parent">
   <i class="fas fa-times" id="remove-filter-child"></i></i>
</a>
 </span> &nbsp;
@endisset
   
 </div>

    </div>
   </form> 
   
   
   </div>

 <div class="container-fluid">
 <form action="{{ route('bottom-button-action-lens') }}" method="post" onsubmit="return checkboxValidation()">
  @csrf
  @method('PUT')

  <div class="row">

        <div class="col-lg-12">

        <div class="card" id="card_categories">
        <div class="card-header">
        <nav>
        <ol class="breadcrumb" id="breadcrumb_cat">
            <strong>Lens </strong> &nbsp; Details
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
        <th class="text-center">Brand</th>
        <th class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
     @php
    
     $status="";
     @endphp
     @foreach($lens as $lens_data)

        <tr>
        <td class="text-center v-align"><input type="checkbox" name="lens_ids[]" id="ids[]" class="lens_ids" value="{{ $lens_data->id }}"/> {{ $lens_data->id }} 
        <a title="Edit Lens" href="{{ route('edit-lens', $lens_data->id) }}" data-toggle="tooltip"><i class="fa fa-edit"></i></a> /
        
        <a title="Copy Lens" href="{{ route('copy-lens', $lens_data->id) }}" data-toggle="tooltip"><i class="fa fa-copy"></i></a>
        </td>
        
        
        <td class="text-center">
         @if(!empty($lens_data->lens_image_name))
        <img src="{{ asset('/uploaded_files/lens/'.$lens_data->lens_image_name) }}" style="width:40%;height:100px;" alt="lens image" title="lens image" class="rounded">
         @else
         <img src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:40%;height:90px;" alt="lens" title="lens" class="rounded"/>
         @endif

         </td>
        <td class="text-center v-align">
        {{ $lens_data->name }} <br>
    @php
     $index = DB::table('lens_index')->where('id',$lens_data->lens_index)->first();
    @endphp  
    
     [ {{$index->lens_index}} ]
        
        </td>

       

        <td class="text-center v-align">
@php
 $bname = DB::table('lens_brands')->where('id',$lens_data->brand)->first();
@endphp            
        {{$bname->category_name}}

        </td>
        
        <td class="text-center v-align">
        @if($lens_data->category_status=="Active")
        <span class="badge badge-success">{{ $lens_data->category_status }}</span>
        @else
        <span class="badge badge-danger">{{ $lens_data->category_status }}</span>
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
   <!-- ******** -->
  
<input type="submit" class="btn btn-success req_for" name="req_for" value="Active">
<input type="submit" class="btn btn-danger req_for" name="req_for" value="Inactive" style="margin-left:10px;">

   <input type="submit" class="btn btn-danger req_for" name="req_for" value="Delete" style="float:right">


 </div>
</div>

</div></div>

</form>
 </div>
 <br>

{{ $lens->appends($_GET)->links() }}

 @else

 <div class="alert alert-danger fade show" id="no_record_found">
    <strong style="font-size: 22px">No Record Found...!</strong>
 </div>

@endif

</div>

@endsection('content')
