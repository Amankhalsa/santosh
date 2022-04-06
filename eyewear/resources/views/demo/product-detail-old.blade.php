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

<section>
<div class=" container-fluid">
<div class="row">

<div class="col-lg-8">                                  

<div id="slider-wrapper">


<div id="image-slider">
<ul>
	<li class="active-img">
	    <a  href="{{asset('uploaded_files/product/'.$product_data->category_image_name)}}" data-fancybox="images" >
		<img src="{{asset('uploaded_files/product/'.$product_data->category_image_name)}}" alt="" />
		</a>
	</li>
<li class="" >
     <a  href="{{asset('uploaded_files/product/'.$product_data->category_image_name2)}}" data-fancybox="images" >
		<img src="{{asset('uploaded_files/product/'.$product_data->category_image_name2)}}" alt="" />
		</a>
	</li>
  @if(!empty($product_data->category_image_name3))	
	<li class="" >
	     <a  href="{{asset('uploaded_files/product/'.$product_data->category_image_name3)}}" data-fancybox="images" >
		<img src="{{asset('uploaded_files/product/'.$product_data->category_image_name3)}}" alt="" />
		</a>
	</li>
  @endif
   @if(!empty($product_data->category_image_name4))
	<li class="" >
	     <a  href="{{asset('uploaded_files/product/'.$product_data->category_image_name4)}}" data-fancybox="images" >
		<img src="{{asset('uploaded_files/product/'.$product_data->category_image_name4)}}" alt="" />
		</a>
	</li>
  @endif
   @if(!empty($product_data->category_image_name5))
	<li class="" >
	     <a  href="{{asset('uploaded_files/product/'.$product_data->category_image_name5)}}" data-fancybox="images" >
		<img src="{{asset('uploaded_files/product/'.$product_data->category_image_name5)}}" alt="" />
		</a>
	</li>	
 @endif	
		
													
</ul>
</div>

<div id="thumbnail">
<ul class="feature-img">
	<li class="active"><img src="{{asset('uploaded_files/product/'.$product_data->category_image_name)}}" alt="" /></li>
	<li><img src="{{asset('uploaded_files/product/'.$product_data->category_image_name2)}}" alt="" /></li>
 @if(!empty($product_data->category_image_name3))	
	<li><img src="{{asset('uploaded_files/product/'.$product_data->category_image_name3)}}" alt="" /></li>
 @endif
  @if(!empty($product_data->category_image_name4))
	<li><img src="{{asset('uploaded_files/product/'.$product_data->category_image_name4)}}" alt="" /></li>
@endif
 @if(!empty($product_data->category_image_name5))
	<li><img src="{{asset('uploaded_files/product/'.$product_data->category_image_name5)}}" alt="" /></li>
@endif	
</ul>
</div>
</div>

<span id="SizeChart1"></span>

<div class="w3-bar w3-black" style="background-color: #f8f4f4;">
  <button class="w3-bar-item w3-button" onclick="openCity('London')">Description</button>
  <button class="w3-bar-item w3-button" onclick="openCity('Paris')">Waranty Information</button>
  <button class="w3-bar-item w3-button" onclick="openCity('SizeChart')">Size Chart</button>
</div>

<div id="London" class="w3-container city">
  <!--<h3>Description</h3>-->
  <span class="aniket" style="text-align: justify; padding:20px; color:#91887c; font-size: 15px; "> 
     {!!$product_data->category_description!!} </span>
</div>

<div id="Paris" class="w3-container city" style="display:none">
  
  <div class="row">
      <div class="col-lg-2 col-12">
          
      </div>
       <div class="col-lg-6 col-12">
         <p style="font-size:20px; font-weight:600; margin-top:12%; color: #60ced9;">
          {{$main_cat->category_warranty}}</p>
      </div>
      
      </div>
</div>

<div id="SizeChart" class="w3-container city" style="display:none">
    @if(!empty($product_data->category_lens_width)) 
       <div class="row" style="margin-top:30px;">
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





<div class="col-lg-4">
<div class="modal-right">

<h2>{{$product_data->category_name}}</h2>


<div class="variants_selects">

<form action="{{url('/add-to-cart')}}" method="post">
 @csrf
 @method('POST')

<div class="row">
    
<div class="col-lg-12">
<div class="product-size">
<h3 class="text-secondary pt-10">Size:</h3> &nbsp;&nbsp;
<p style="margin-top:10px;">
{{substr($product_data->category_lens_width, 0, strpos( $product_data->category_lens_width, ' '))}}-{{substr($product_data->category_bridge, 0, strpos( $product_data->category_bridge, ' '))}}-{{substr($product_data->category_arm_length, 0, strpos( $product_data->category_arm_length, ' '))}}-{{substr($product_data->category_lens_height, 0, strpos( $product_data->category_lens_height, ' '))}}-{{substr($product_data->category_total_width, 0, strpos( $product_data->category_total_width, ' '))}}

 <a href="#SizeChart1" onclick="openCity('SizeChart');">
     <i class="fa fa-question-circle"></i></a>
</p>     
</div>

</div>
    
    <div class="col-lg-12">
@php
 $group_ids = explode(',',$product_data->category_group_ids);
 $group_prd = DB::table('categories')->whereIn('id',$group_ids)->get();
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
<img class="pro-i" src="{{asset('uploaded_files/color_image/'.$color_data->color_image_name)}}">
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
{{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product_data->category_price)}}

<strike id="mrp">{{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product_data->category_mrp)}}</strike>
</span>    
  
</div>
    </div>
    
    
    </div>


<div class="row">
    <div class="col-lg-12">
<button type="submit" class="button-sun">Buy only Frame</button>
 
@if($product_data->available_with_lens=="Yes")        
 @if($product_data->category_qty>0)
<button type="button" class="button-sun-01" onclick="addLensCart('{{$product_data->id}}')">
Buy with Lens</button>

@else
<button type="button" class="button-sun-01" disabled style="cursor:no-drop;">
Buy with Lens</button>
@endif

@else

<button type="button" class="button-sun-01" disabled style="cursor:no-drop;">
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
</ul>
</div>

<div class="glass-return">
    <h3>14 days free return</h3>
    <p>Enjoy 14 days to try out our frames. Send back for a free exchange or return. <a href="">Learn More</a></p>
     </div>


<div class="modal_social">
    <h2>Share this product</h2>
<div class="sharethis-inline-share-buttons"></div>    
</div>

</div>
</div>

</div>
</div>
</section>



<style>.sunglass-heading:before {
    content: "";
    border-bottom: 3px solid transparent;
    position: absolute;
    width: 54px;
    bottom: 0;
    left: 0;
    right: 0;
    margin: 0 auto;
}</style>

<div class="sun-head padd-nee-002">
    <div class="container-fluid">
<div class="row">
<div class="col-lg-12 col-12">
<div class="sunglass-heading" >
    <!--<img src="{{asset('img/more.gif')}}" style="width:30%">-->
    <span style="font-family: -webkit-pictograph;
    font-size: 20px;
    color: #7c7575;">
        ---- YOU MIGHT ALSO LIKE ---</span>

</div>
</div>
</div>


<div id="sunglass-related" class="owl-carousel owl-theme row">
    
@foreach($related_products as $product)
 @php
  $brand = DB::table('categories')->where('id',$product->category_parent_id)->first();
 @endphp


<div class="item col-lg-3 col-6">
<div class="thumbnail-wrap">
<div class="thumbnail">
    <div class="thumbnail-img light-bg">
        

<div class="flipper" style="display: block; width: 220px;">

<div class="front">
@if(!empty($product->category_image_name))  
<a href="{{url('/frame/'.$product->category_slug_name.'.html')}}">  <img src="{{asset('uploaded_files/product/'.$product->category_image_name)}}"></a>
@else
<a href="{{url('/frame/'.$product->category_slug_name.'.html')}}"> <img class="img-responsive" src="{{ asset('admin_assets/images/no_image.jpg') }}" alt=""> </a>
@endif
</div>

<div class="back">    

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
      
<ul class="thumbnail-content hover-style1 list-items" style="background-color:#ffffff">
<li><form action="{{url('/add-to-cart')}}" method="post">
 @csrf
 @method('POST')
<input type="hidden" name="product_id" class="product_id" value="{{$product->id}}"/>
<input type="hidden" value="1" name="qty" />
<button type="submit" value="Add To Cart" class="butt01" ><i class="icon ion-android-add"></i> <i class="icon far fa-shopping-cart"></i></button>
</form></li>

<li style="margin-left:-5px;"> <button type="button" class="butt01" onclick="addWishlist('{{$product->id}}')"><i class="icon far fa-heart"></i> </button> </li>

<li> <button type="button" class="butt01" onclick="productPreview('{{$product->id}}')"><i class="icon far fa-eye"></i> </button> </li>
</ul>   
      
      </div>
      
<div class="caption">

 <div class="caption-title"><a href="{{url('/frame/'.$product->category_slug_name.'.html')}}" class="title">{{Str::limit($product->category_name,30,$end='...')}}</a></div>
<div class="caption-text"> 
<span> {{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product->category_price)}} <strike id="mrp">{{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product->category_mrp)}}</strike> </span> 

</div>                                                   
</div>
       
    
   
    
    </div>
    </div>
    
 </div>
@endforeach

</div>
</div>

</div>


@endsection








