@extends('layouts.app')

{{-- Meta tag Section Start --}}
@php
$meta_title = $meta_description = $meta_keywords = "";
$meta_title = (!empty($product_data->category_meta_title)) ? $product_data->category_meta_title : "{$product_data->category_name} Meta Title";
$meta_description = (!empty($product_data->category_meta_description)) ? $product_data->category_meta_description : "{$product_data->category_name} Meta Description";
$meta_keywords = (!empty($product_data->category_meta_keywords)) ? $product_data->category_meta_keywords : "{$product_data->category_name} Meta Keywords";
@endphp

@section('title',$meta_title)
@section('description',$meta_description)
@section('keywords',$meta_keywords)

@section('og')
<meta property="og:title" content="{{ $product_data->category_name}}" />
<meta property="og:url" content="{{ url('/frame/'.$product_data->category_name.'.html')}}" />
<meta property="og:image" content="{{asset('uploaded_files/product/'.$product_data->category_image_name)}}" />
<meta property="og:description" content="{{ $product_data->category_short_description}}" />
<meta property="og:site_name" content="{{ $admin_data->admin_company_name}}" />
@endsection

{{-- Meta tag Section End --}}

@section('content')

<section class="pro-con" style="margin-top:5rem;">
<div class=" container-fluid">
<div class="row">

<div class="col-lg-8">                                  
<link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

<style>

.pro-con .container {
    margin-top: 100px;
    margin-bottom: 100px
}

.carousel-inner img {
    width: 100%;
    height: 100%
}

#custCarousel .carousel-indicators {
    position: static;
    margin-top: 20px
}

#custCarousel .carousel-indicators>li {
    width: 100px
}

#custCarousel .carousel-indicators li img {
    display: block;
    opacity: 0.5
}

#custCarousel .carousel-indicators li.active img {
    opacity: 1
}

#custCarousel .carousel-indicators li:hover img {
    opacity: 0.75
}

.carousel-item img {
    width: 80%
}    
    
</style>


<div class="container" >
<div class="row" style="margin-top:5rem;">
<div class="col-md-12">
<div id="custCarousel" class="carousel slide" data-ride="carousel" align="center">
<!-- slides -->
<div class="carousel-inner">
    
<div class="carousel-item active"><a href="{{asset('uploaded_files/product/'.$product_data->category_image_name)}}" data-fancybox="images"> <img src="{{asset('uploaded_files/product/'.$product_data->category_image_name)}}" alt="{{$product_data->category_name}}" title="{{$product_data->category_name}}"> </a></div>

<div class="carousel-item"><a href="{{asset('uploaded_files/product/'.$product_data->category_image_name2)}}" data-fancybox="images">  <img src="{{asset('uploaded_files/product/'.$product_data->category_image_name2)}}" alt="{{$product_data->category_name}}" title="{{$product_data->category_name}}"> </a></div>

@if(!empty($product_data->category_image_name3))
<div class="carousel-item"><a href="{{asset('uploaded_files/product/'.$product_data->category_image_name3)}}" data-fancybox="images">  <img src="{{asset('uploaded_files/product/'.$product_data->category_image_name3)}}" alt="{{$product_data->category_name}}" title="{{$product_data->category_name}}"></a> </div>
@endif

@if(!empty($product_data->category_image_name4))
<div class="carousel-item"><a href="{{asset('uploaded_files/product/'.$product_data->category_image_name4)}}" data-fancybox="images">  <img src="{{asset('uploaded_files/product/'.$product_data->category_image_name4)}}" alt="{{$product_data->category_name}}" title="{{$product_data->category_name}}"></a> </div>
@endif

@if(!empty($product_data->category_image_name5))
<div class="carousel-item"><a href="{{asset('uploaded_files/product/'.$product_data->category_image_name5)}}" data-fancybox="images">  <img src="{{asset('uploaded_files/product/'.$product_data->category_image_name5)}}" alt="{{$product_data->category_name}}" title="{{$product_data->category_name}}"></a> </div>
@endif

</div>
<span id="SizeChart1"></span>

<!-- Left right --> <a class="carousel-control-prev" href="#custCarousel" data-slide="prev"> <span class="carousel-control-prev-icon"></span> </a> <a class="carousel-control-next" href="#custCarousel" data-slide="next"> <span class="carousel-control-next-icon"></span> </a> <!-- Thumbnails -->
<ol class="carousel-indicators list-inline">
    
<li class="list-inline-item active"> <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#custCarousel"> <img src="{{asset('uploaded_files/product/'.$product_data->category_image_name)}}" class="img-fluid"> </a> </li>

<li class="list-inline-item"> <a id="carousel-selector-1" data-slide-to="1" data-target="#custCarousel"> <img src="{{asset('uploaded_files/product/'.$product_data->category_image_name2)}}" class="img-fluid"> </a> </li>

@if(!empty($product_data->category_image_name3))
<li class="list-inline-item"> <a id="carousel-selector-2" data-slide-to="2" data-target="#custCarousel"> <img src="{{asset('uploaded_files/product/'.$product_data->category_image_name3)}}" class="img-fluid"> </a> </li>
@endif

@if(!empty($product_data->category_image_name4))
<li class="list-inline-item"> <a id="carousel-selector-3" data-slide-to="3" data-target="#custCarousel"> <img src="{{asset('uploaded_files/product/'.$product_data->category_image_name4)}}" class="img-fluid"> </a> </li>
@endif

@if(!empty($product_data->category_image_name5))
<li class="list-inline-item"> <a id="carousel-selector-4" data-slide-to="4" data-target="#custCarousel"> <img src="{{asset('uploaded_files/product/'.$product_data->category_image_name5)}}" class="img-fluid"> </a> </li>
@endif

</ol>
</div>
</div>
</div>
</div>


<div class="w3-bar w3-black" style="background-color: #f8f4f4;">
@if(!empty($product_data->category_description))
  <button class="w3-bar-item w3-button" onclick="openCity('London')">Description</button>
@endif  
  <button class="w3-bar-item w3-button btn btn-dark" onclick="openCity('SizeChart')">Size Chart</button>
</div>

<div id="London" class="w3-container city">
  <!--<h3>Description</h3>-->
  <span class="aniket" style="text-align: justify; padding:20px; color:#91887c; font-size: 15px; "> 
     {!!$product_data->category_description!!} </span>
</div>
<!--cart start -->
<div id="SizeChart" class="w3-container city" style="display:none">
<div class="row" style="margin-top:30px;">    
    @if(!empty($product_data->category_lens_width)) 
       
         <div class="col-lg-1"></div>   
      <div class="col-lg-2">
      <img src="{{asset('img/sizechart01.png')}}" alt="">
      <h6 style="text-align:center">LENS WIDTH<br>
      {{$product_data->category_lens_width}}</h6>  
      </div>
      @endif 
      
     @if(!empty($product_data->category_bridge))
      
      <div class="col-lg-2">
      <img src="{{asset('img/sizechart02.png')}}" alt="">
      <h6 style="text-align:center">BRIDGE WIDTH<br>
       {{$product_data->category_bridge}}</h6>
      </div>
      
      @endif 
     @if(!empty($product_data->category_arm_length))
      
      <div class="col-lg-2">
      <img src="{{asset('img/sizechart03.png')}}" alt="">
      <h6 style="text-align:center">TEMPLE LENGTH<br>
      {{$product_data->category_arm_length}}</h6>
         </div> 
      
      
      @endif 
     @if(!empty($product_data->category_lens_height))
     <div class="col-lg-2">
      <img src="{{asset('img/sizechart04.png')}}" alt="">
     <h6 style="text-align:center;">LENS HEIGHT<br>
     {{$product_data->category_lens_height}}</h6>
         </div> 
      
      
       @endif 
     @if(!empty($product_data->category_total_width))
      <div class="col-lg-2">
      <img src="{{asset('img/sizechart05.png')}}" alt="">
      <h6 style="text-align:center;">TOTAL WIDTH<br>
      {{$product_data->category_total_width}}</h6>
         </div> 
       @endif 
      
      
      </div>
     
    
</div>
<!--cart end -->
<script>
function openCity(cityName) {
  var i;
  var x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  document.getElementById(cityName).style.display = "block";  
}
</script>

</div>

@php
  $b_name = DB::table('categories')->where('id',$product_data->category_parent_id)->select('category_name','category_slug_name')->first();
 @endphp
<!-- =================================================col-lg-4===================================-->
<div class="col-lg-4">
<div class="modal-right">
<span class="text-secondary">Brand:</span>    
<a style="text-decoration:none !important;" class="text-dark" href="{{url('/brand/'.$b_name->category_slug_name.'.html')}}"><small>{{$b_name->category_name}}</small></a>
<h2>{{$product_data->category_name}}</h2>
<h6 style="font-size:13px !important;"><strong class="text-secondary"> </strong> {{$product_data->category_uan_code}}</h6>

<div class="variants_selects">

<form action="{{url('/add-to-cart')}}" method="post">
 @csrf
 @method('POST')

<div class="row">
  
    
<div class="col-lg-12" style="margin-bottom:-20px;">
<div class="product-size">
<h3 class="text-secondary pt-10">Size:</h3> &nbsp;&nbsp;
<p style="margin-top:10px;">
    
{{str_replace("mm","",$product_data->category_lens_width)}}-{{str_replace("mm","",$product_data->category_bridge)}}-{{str_replace("mm","",$product_data->category_arm_length)}}-{{str_replace("mm","",$product_data->category_lens_height)}}-{{str_replace("mm","",$product_data->category_total_width)}}

 <a href="#SizeChart1" onclick="openCity('SizeChart');">
     <i class="fa fa-question-circle"></i></a>
</p>     
</div>

</div>
    
    <div class="col-lg-12">
@php
 $group_ids = explode(',',$product_data->category_group_ids);
 $group_prd = DB::table('categories')->whereIn('id',$group_ids)->where('category_status','Active')->get();
 $i=1;
@endphp    
@if(!empty($product_data->category_group_ids))         
    <div class="product-color">
    <h3 class="text-secondary pt-10">Color</h3>

   
@foreach($group_prd as $group)
 @php
$color_data = DB::table('product_colors')->where('id',$group->category_color)->first(); 
 @endphp
<a href="{{url('/frame/'.$group->category_slug_name.'.html')}}" class="pro-ibtn  btn-tool @if($group->category_slug_name==$product_data->category_slug_name) color-btn @endif ">
<img class="pro-i "  src="{{asset('uploaded_files/color_image/'.$color_data->color_image_name)}}">
</a>
 
 @php
  $i++;
 @endphp   
@endforeach    
   
</div>
@endif

<input type="hidden" name="product_id" class="product_id" value="{{$product_data->id}}"/>
<input value="1" type="hidden" class="prd_qty" name="qty">

    <div class="modal_price mb-10">
<span class="new_price"><h3>Frame Price:</h3>  
{{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product_data->category_discount_price)}}
@if($product_data->category_is_discount=="Yes")
<strike id="mrp">{{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product_data->category_price)}}</strike>
@endif
</span>    
  
</div>
    </div>
    
    
    </div>


<div class="row">
    <div class="col-lg-12">
<button type="submit" class="btn btn-primary">Buy only Frame</button>
 
@if($product_data->available_with_lens=="Yes")        
 @if($product_data->category_qty>0)
<button type="button"class="btn btn-primary" onclick="addLensCart('{{$product_data->id}}')">
Buy with Lens</button>

@else
<button type="button" class="btn btn-primary" disabled style="cursor:no-drop;background-color:#bdbdbd">
Buy with Lens</button>
@endif

@else

<button type="button" class="btn btn-primary" disabled style="cursor:no-drop;background-color:#bdbdbd">
Buy with Lens</button>

<div class="popover__wrapper">
  <a href="#">
    <h5 class="popover__title"><i class="fa fa-question-circle"></i></h5>
  </a>
  <div class="popover__content">
   <p>{{$admin_data->available_with_lens_desc}}</p>
  </div>
</div>

@endif
    </div>
</div>


</form>

</div>

<div class="glass-point">
 <h3>Details</h3>
<ul style="font-size:13px;">
<li>EAN Code: {{$product_data->category_sku_code}}</li>
<li>Frame Type : {{$product_data->type}}</li>
<li>Frame Shape : {{$product_data->shape}}</li>
<li>Material : {{$product_data->material}}</li>
<li>Gender : {{$product_data->category_for}}</li>
<li>Type : {{$product_data->category_frame}}</li>
<li>Warranty : {{$main_cat->category_warranty}}</li>
@if(!empty($product_data->lens_type))
<li>Lens Type : 
<ul>
@foreach($lens_types as $data)
 <li>{{$data->lens_type}}</li>
@endforeach
</ul>
</li>
@endif

@if(!empty($product_data->extra))
<li>Extra : 
<ul>
@foreach($extras as $data)
 <li>{{$data->extra}}</li>
@endforeach
</ul>
</li>
@endif

</ul>
</div>

<!--<div class="glass-return">
{!!$admin_data->admin_return_info!!}
 </div>-->

<div class="modal_social">
    <h2>Share this product</h2>
<div class="sharethis-inline-share-buttons"></div>    
</div>

</div>
<!-- =================================================col-lg-4===================================-->
</div>

</div>
</div>
</section>



<style>.sunglass-heading:before {
    content: "";
    <!--border-bottom: 3px solid transparent;-->
    position: absolute;
    width: 54px;
    bottom: 0;
    left: 0;
    right: 0;
    margin: 0 auto;
}</style>

<!--======================new section ====================-->
  <section>
    <div class="product_detail section_space pb-0">
      <div class="container">
        <div class="product_deatail_list">
          <div class="product_deatail_list_text">
            <div class="lineTitleCol">
              <h6 class="lineTitle">Explore Our Products</h6>
            </div>
            <h2 class="product_detail_head lgTitle darkColor">YOU MIGHT ALSO LIKE</h2>
          </div>


        </div>
        </div>
      </div>
    </div>
  </section>
<!--====================== new section ===============-->
<!---------------------->
@include('footer_what_about')
<!------------------------>

@if($related_products->isNotEmpty())
<div class="sun-head padd-nee-002">
    <div class="container-fluid">
<div class="row">
<div class="col-lg-12 col-12">
    <div class="sunglass-heading" style="margin:100px 0 80px;">
<h2>YOU MIGHT ALSO LIKE</h2>
</div>

</div>
</div>


<div class="row text-center">
    
@foreach($related_products as $product)
 @php
  $brand = DB::table('categories')->where('id',$product->category_parent_id)->first();
 @endphp



 <div class="col-md-3">
        <div class="thumbnail-wrap">
            <div class="thumbnail">
                <div class="thumbnail-img light-bg">
                    
       
    <div class="flipper" style="display: block;">
     
      <div class="front">
@if(!empty($product->category_image_name))  
<a href="{{url('/frame/'.$product->category_slug_name.'.html')}}">  <img src="{{asset('uploaded_files/product/'.$product->category_image_name)}}"></a>
@else
<a href="{{url('/frame/'.$product->category_slug_name.'.html')}}"> <img class="img-responsive" src="{{ asset('admin_assets/images/no_image.jpg') }}" alt=""> </a>
@endif
</div>

<div class="back d-none" >    

@if(!empty($product->category_image_name2))  
<a href="{{url('/frame/'.$product->category_slug_name.'.html')}}">  <img src="{{asset('uploaded_files/product/'.$product->category_image_name2)}}"></a>
@else
<a href="{{url('/frame/'.$product->category_slug_name.'.html')}}"> <img class="img-responsive" src="{{ asset('admin_assets/images/no_image.jpg') }}" alt=""> </a>
@endif
</div>
   
@if($product->category_sale_off=="Yes")      
 <div class="sale-tag right"> <span> sale </span> </div>
@endif       
      
      </div>
      
<!--<ul class="thumbnail-content hover-style1 list-items" >-->
<!--<li><form action="{{url('/add-to-cart')}}" method="post">-->
<!-- @csrf-->
<!-- @method('POST')-->
<!--<input type="hidden" name="product_id" class="product_id" value="{{$product->id}}"/>-->
<!--<input type="hidden" value="1" name="qty" />-->
<!--<button type="submit" value="Add To Cart" class="butt01" ><i class="icon ion-android-add"></i> <i class="icon far fa-shopping-cart"></i></button>-->
<!--</form></li>-->

<!--<li style="margin-left:-5px;"> <button type="button" class="butt01" onclick="addWishlist('{{$product->id}}')"><i class="icon far fa-heart"></i> </button> </li>-->

<!--<li> <button type="button" class="butt01" onclick="productPreview('{{$product->id}}')"><i class="icon far fa-eye"></i> </button> </li>-->
<!--</ul>   -->
      
      </div>
      
<div class="caption">

 <div class="caption-title">

<span style="font-family: utopia-std,Charter,Georgia,serif;
    font-weight: 600;
    line-height: calc(1em + 6px);
    margin-top: 0;
    margin-bottom: 0;
    font-size: 20px;
    color: #414B56;
    margin-bottom: 0px;">{{$brand->category_name}}</span><br>
     
<a href="{{url('/frame/'.$product->category_slug_name.'.html')}}" class="title">{{Str::limit($product->category_name,30,$end='...')}}</a></div>
<div class="caption-text"> 
<p> {{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product->category_discount_price)}} 
@if($product->category_is_discount=="Yes")
<strike id="mrp">{{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product->category_price)}}</strike> 
@endif
</p> 
@php
$get_current_color = DB::table('product_colors')->where('id',$product->category_color)->first(); 
@endphp
<div class="product-color">

@php
 $group_ids = explode(',',$product->category_group_ids);
 $group_prd = DB::table('categories')->whereIn('id',$group_ids)->where('category_status','Active')->get();
 $i=1;
@endphp
@if(!empty($product->category_group_ids))  

@foreach($group_prd as $group)
 @php
$color_data = DB::table('product_colors')->where('id',$group->category_color)->first(); 
 @endphp    
<a href="{{url('/frame/'.$group->category_slug_name.'.html')}}" class="pro-ibtn  btn-tool @if($group->category_slug_name==$product->category_slug_name) color-btn @endif ">
<img class="pro-i" src="{{asset('uploaded_files/color_image/'.$color_data->color_image_name)}}" style="margin-top: -30px; width:25px; height: 25px;">
</a>
@php
  $i++;
 @endphp   
@endforeach
@else

<a href="{{url('/frame/'.$product->category_slug_name.'.html')}}" class="pro-ibtn  btn-tool color-btn ">
<img class="pro-i" src="{{asset('uploaded_files/color_image/'.$get_current_color->color_image_name)}}" style="margin-top: -30px; width:25px; height: 25px;">
</a>

@endif
</div>

</div>                                                   
</div>
       
    
   
    
    </div>
    </div>
    
 </div>
@endforeach

</div>
</div>

</div>
@else
<br>
@endif

@endsection








