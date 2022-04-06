@extends('admin.layouts.app')

@section('title','Manage Sub Vision')

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
<h4 style="float:left;margin-top:5px;">Manage Sub Vision &nbsp; <i style="font-size:20px;" class="fas fa-list-alt"></i></h4>

<div style="float:right;">
<span style="padding:8px;font-size:16px;box-shadow:2px 2px 2px grey;" class="badge badge-pill badge-secondary"><b>Total:</b> {{ $subvisions->total() }}</span>
&nbsp;&nbsp;

<span><a href="{{ route('manage-vision') }}" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
&nbsp;&nbsp;

<span><a href="{{ route('add-subvision-form', $vision_parent_id) }}" class="btn btn-primary"> <i class="fa fa-plus"></i> Add Sub Vision</a></span>

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



@if($subvisions->isNotEmpty())


 <div class="container-fluid">
 <form action="{{ route('bottom-button-action-subvision', $vision_parent_id) }}" method="post" onsubmit="return checkboxValidation()">
  @csrf
  @method('PUT')

  <div class="row">

        <div class="col-lg-12">

        <div class="card" id="card_categories">
        <div class="card-header">
        <nav>
        <ol class="breadcrumb" id="breadcrumb_cat">
        @php
        $cat_name = DB::table('visions')->where('id',$vision_parent_id)->select('vision_name')->first();
        @endphp

        @if(!empty($cat_name->vision_name))
        <li class="breadcrumb-item"><a href="{{ route('manage-category') }}">{{ $cat_name->vision_name }}</a></li>
        @endif

        &nbsp;
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
        <th class="text-center">Price</th>
        <th class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
     @php
     $i=1;
     $status="";
     @endphp
     @foreach($subvisions as $subvision_data)
        <tr>
        <td class="text-center v-align"><input type="checkbox" name="vision_ids[]" id="ids[]" class="vision_ids" value="{{ $subvision_data->id }}"/> {{ $i++ }}</td>
        <td class="text-center">
         @if(!empty($subvision_data->vision_image_name))
        <img src="{{ asset('/uploaded_files/vision/'.$subvision_data->vision_image_name) }}" style="width:60%;height:100px;" alt="subvision image" title="subvision image" class="img-fluid rounded">
         @else
         <img src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:60%;height:90px;" alt="subvision" title="subvision" class="rounded"/>
         @endif

         </td>
        <td class="text-center v-align">
        {{ $subvision_data->vision_name }}
        </td>
        
        <td class="text-center v-align">
        {{ $subvision_data->vision_price }}
        </td>

        <td class="text-center v-align">
        <a title="Edit subvision" href="{{ route('edit-subvision', [$vision_parent_id, $subvision_data->id]) }}" data-toggle="tooltip"><i class="fa fa-edit"></i></a>

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
</div></div>
</form>
 </div>
 <br>

{{ $subvisions->links() }}

 @else

 <div class="alert alert-danger fade show" id="no_record_found">
    <strong style="font-size: 22px">No Record Found...!</strong>
  </div>

@endif

</div>

@endsection('content')
