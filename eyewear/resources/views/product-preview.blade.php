<a aria-hidden="true" data-dismiss="modal" class="sb-close-btn close icon_close" href="#">
<i class="far fa-times-circle"></i>
</a>              
<!-- Single Products Slider Starts --> 
<section>
<div class=" container-fluid">
<div class="row">

<div class="col-lg-6">                                  

<div id="slider-wrapper">


<div id="image-slider">
<ul>
	<li class="active-img mag1">
		<img data-toggle="magnify" src="{{asset('uploaded_files/product/'.$product_detail->category_image_name)}}" alt="" />
	</li>
<li class="mag1">
		<img data-toggle="magnify" src="{{asset('uploaded_files/product/'.$product_detail->category_image_name2)}}" alt="" />
	</li>
  @if(!empty($product_detail->category_image_name3))	
	<li class="mag1">
		<img data-toggle="magnify" src="{{asset('uploaded_files/product/'.$product_detail->category_image_name3)}}" alt="" />
	</li>
  @endif
   @if(!empty($product_detail->category_image_name4))
	<li class="mag1">
		<img data-toggle="magnify" src="{{asset('uploaded_files/product/'.$product_detail->category_image_name4)}}" alt="" />
	</li>
  @endif
   @if(!empty($product_detail->category_image_name5))
	<li class="mag1">
		<img data-toggle="magnify" src="{{asset('uploaded_files/product/'.$product_detail->category_image_name5)}}" alt="" />
	</li>	
 @endif	
		
													
</ul>

</div>

<div id="thumbnail">
<ul class="feature-img">
	<li class="active"><img src="{{asset('uploaded_files/product/'.$product_detail->category_image_name)}}" alt="" /></li>
	<li><img src="{{asset('uploaded_files/product/'.$product_detail->category_image_name2)}}" alt="" /></li>
 @if(!empty($product_detail->category_image_name3))	
	<li><img src="{{asset('uploaded_files/product/'.$product_detail->category_image_name3)}}" alt="" /></li>
 @endif
  @if(!empty($product_detail->category_image_name4))
	<li><img src="{{asset('uploaded_files/product/'.$product_detail->category_image_name4)}}" alt="" /></li>
@endif
 @if(!empty($product_detail->category_image_name5))
	<li><img src="{{asset('uploaded_files/product/'.$product_detail->category_image_name5)}}" alt="" /></li>
@endif	
</ul>
</div>
 <div class="mag1">
                <img data-toggle="magnify" src="{{asset('uploaded_files/product/'.$product_detail->category_image_name5)}}" alt=""/>
            </div>
           
</div>


              
</div>

<div class="col-lg-6">
<div class="modal-right">
<h2>{{$product_detail->category_name}}</h2>
<div class="modal_price mb-10">
<span class="new_price">₹{{$product_detail->category_price}}</span>    
<!--<span class="old_price">₹78.99</span> -->   
</div>

<div class="variants_selects">

<form action="{{url('/add-to-cart')}}" method="post">
 @csrf
 @method('POST')
@php
 $colors = DB::table('colors')->where('color_parent_id','0')->where('product_id',$product_detail->id)->get();
 $first_color = DB::table('colors')->where('color_parent_id','0')->where('product_id',$product_detail->id)->first();
@endphp

<div class="row">

    
    <div class="col-lg-12">
    <div class="product-color">
    <h3 class="text-secondary pt-10">Colour</h3>
@foreach($colors as $color)
@php
 $color_img = DB::table('colors')->where('color_parent_id',$color->id)->first();
@endphp    
    <a href="javascript:void(0)" class="pro-ibtn  btn-tool" onclick="setColor('{{$color->id}}')">
    <img class="pro-i" src="{{asset('uploaded_files/category_more_images/'.$color_img->image)}}">
    </a>
@endforeach    
<input type="hidden" name="color" class="prd_color" @if(!empty($first_color)) value="{{$first_color->id}}" @endif/>    
<input type="hidden" name="product_id" class="product_id" value="{{$product_detail->id}}"/>
<input value="1" type="hidden" class="prd_qty" name="qty">    
    </div>
    </div>
    
    </div>


<div class="row">
    <div class="col-lg-12">
<button type="submit" class="button-sun">Buy only Frame</button>
        
<!--<button type="button" class="button-sun-01" onclick="addLensCart('{{$product_detail->id}}','{{$product_detail->category_image_name}}')">
Buy with Lens</button>-->
    </div>
</div>


</form>

</div>


<div class="modal_description mb-15">
<p>{!!$product_detail->category_short_description!!}</p>    
</div>

<!--<div class="glass-point">
 <h3>Key Points:</h3>
<ul style="font-size:13px;">
<li>Frame Type : {{$product_detail->type}}</li>
<li>Frame Shape : {{$product_detail->shape}}</li>
<li>Material : {{$product_detail->material}}</li>
<li>Gender : {{$product_detail->category_for}}</li>
<li>Type : {{$product_detail->category_frame}}</li>
</ul>
</div>


<div class="modal_social">
    <h2>Share this product</h2>
<div class="sharethis-inline-share-buttons"></div>    
</div>-->

</div>
</div>

</div>
</div>
</section>