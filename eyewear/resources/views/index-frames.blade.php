<section class="video_bg">
  <div class="overlay"></div>
  <video playsinline="playsinline" autoplay="" loop="" controls="" muted="">
    <source src="{{asset('img/sunglass.mp4')}}" type="video/mp4">
  </video>
  <div class="caption">
       <div class="container">
       <div class="row">
       <div class="col-lg-12 fadeInUp">
       <div class="content_box animated">
           <h3>#sunglasses</h3>
           <p>
               </p>
        <a href="" class="item-btn-1">Order Now</a>
        
      </div>
      </div>
    </div>
  </div>
  </div>
  </section>



<div class="service-area">
        <div class="container">
            <div class="row ">
                <div class="col-lg-3 col-6 serv">
                    <div class="service1">
                        <div class="service-icon icon1"></div>
                        <div class="service-content">
<div class="service-heading">Free Delivery</div>
<div class="service-description">Free shipping on all order</div>
</div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-6 serv">
                    <div class="service2">
                       <div class="service-icon icon2"></div>
                       <div class="service-content">
<div class="service-heading">Money Return</div>
<div class="service-description">Back guarantee in 7 days</div>
</div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-6 serv">
                    <div class="service3">
                        <div class="service-icon icon3"></div>
                        <div class="service-content">
<div class="service-heading">Member Discount</div>
<div class="service-description">Onevery order over 2%</div>
</div>
                    </div>
                </div>
                
                <div class="col-lg-3 col-6">
                    <div class="service4">
                        <div class="service-icon icon4"></div>
                        <div class="service-content">
<div class="service-heading">Online Support</div>
<div class="service-description">support 24 Hours a day</div>
</div>
                    </div>
                </div>
            </div>
        </div>
    
</div>
@if($sunglasses->isNotEmpty())
<div class="sun-head padd-nee-002">
<div class="container-fluid">
    <div class="row ">
<div class="col-lg-12 col-12">
<div class="sunglass-heading">
<h2>Latest Sunglass Frames</h2>
</div>
</div>
</div>
    <div id="sunglass-frame" class="owl-carousel owl-theme row text-center" style="margin-left: 15px;">
@foreach($frames as $product)
 @php
  $brand = DB::table('categories')->where('id',$product->category_parent_id)->first();
 @endphp


    <div class="item">
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
 
@if($product->category_is_sale_off=="Yes")      
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
            <div class="caption-title"><a href="{{url('/frame/'.$product->category_slug_name.'.html')}}" class="title">{{Str::limit($product->category_name,20,$end='...')}}</a></div>
            <div class="caption-text"> 
<p>
 {{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product->category_price)}} 
 <strike id="mrp">{{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product->category_mrp)}}</strike>
 </p> </div>                                                   
       </div>
       
    
   
    
    </div>
    </div>
    
 </div>
@endforeach

  
    </div>

    </div>

    </div>
@endif





