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
class="badge badge-pill badge-secondary"><b>Total:</b> </span>
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



 <div class="container-fluid">

  <div class="row">
        <div class="col-lg-12">
<form method="post" action="{{route('manage.store_brands')}}" enctype="multipart/form-data">
    @csrf
  <div class="form-group">
<h3 class="text-center"> Add Multiple Brand Images from here </h3>
  </div>
  <!--select options -->
  <div class="form-group">
  <label for="name">Brand List:</label>
  @php
$brands = DB::table('categories')->select(['id','category_name','category_slug_name'])->where('category_status','Active')->where('category_parent_id','0')->get();
@endphp
  <select id="name" name="name" class="form-control"  required>
       <option selected>Choose Brand Name </option>
    @foreach($brands as $brand)  
  <option value="{{$brand->category_name}}">{{$brand->category_name}}</option>
  @endforeach
</select>

</div>

  <!--select options -->
<!--===== select url ===========  -->
  <div class="form-group">
  <label for="url">Brand url:</label>
  @php
$brands = DB::table('categories')->select(['id','category_name','category_slug_name'])->where('category_status','Active')->where('category_parent_id','0')->get();
@endphp
  <select id="url" name="url" class="form-control" required>
      <option selected>Choose Brand URL </option>
    @foreach($brands as $brand)  
  <option value="{{url('/brand/'.$brand->category_slug_name.'.html')}}">{{$brand->category_name}}</option>
  @endforeach
</select>

</div>
<!--========== select url =============-->
  
  
  <!------------------- image -------------------->
  	<div class="form-group">
			<div class="controls">
			<img src="https://luxuryeyewear.in/admin_assets/images/no_image.jpg" width="100" height="100" id="output">
			</div>
	</div>
	<!-------------- image ---------------------->
  <div class="form-group">
    <label for="image">Brand image</label>

		<input name="image" type="file" class="form-control" 
		accept="image/*" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" required>
  </div>

  <button type="submit" class="btn btn-primary">Publish brand</button>
</form>
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
