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

<!--new -->
<link rel="stylesheet" type=text/css href="{{asset('css/productdetail/style.css')}}">
<!--new -->
<style>
.carousel-inner img {
    cursor:-webkit-zoom-in;
    cursor:-moz-zoom-in;
    cursor:zoom-in;
}
.sunglass-heading:before {
    content: "";
    <!--border-bottom: 3px solid transparent;-->
    position: absolute;
    width: 54px;
    bottom: 0;
    left: 0;
    right: 0;
    margin: 0 auto;
}
/*preview */
.carousel-control-prev-icon {
    background-image: url("https://luxuryeyewear.in/uploaded_files/assets/images/Vector1.png") !important;
    width:1rem  !important;
  
}
/*next */
.carousel-control-next-icon {
    background-image: url("https://luxuryeyewear.in/uploaded_files/assets/images/Vector2.png")!important;
        width:1rem  !important;
}



#sliderbox{
     color: var(--primaryColor);
}

ol.carousel-indicators.list-inline li {
    border: 1px solid #ccc;
    padding: 10px;
}

#addCartBtn {
    min-width: 190px;
    margin-bottom: 1rem;
}
/*------------color images --------*/
#color_builts {
    padding: 8px 0 8px 0;
}
/*color images */
#cardStylecol{
       border: 1px solid #D2D2D2;
    padding: 0px 15px 20px 15px;
    position: relative;
    
}
</style>
@endsection

{{-- Meta tag Section End --}}

@section('content')

<section class="pro-con" style="margin-top:5rem;">
<div class=" container-fluid">
<div class="row">

<div class="col-lg-7">                                  
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
    
<li class="list-inline-item active " style="border: 1px solid #F07500 !important;" > <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#custCarousel"> <img src="{{asset('uploaded_files/product/'.$product_data->category_image_name)}}" class="img-fluid"> </a> </li>

<li class="list-inline-item" > <a id="carousel-selector-1" data-slide-to="1" data-target="#custCarousel"> <img src="{{asset('uploaded_files/product/'.$product_data->category_image_name2)}}" class="img-fluid"> </a> </li>

@if(!empty($product_data->category_image_name3))
<li class="list-inline-item" > <a id="carousel-selector-2" data-slide-to="2" data-target="#custCarousel"> <img src="{{asset('uploaded_files/product/'.$product_data->category_image_name3)}}" class="img-fluid"> </a> </li>
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



<div class="col-lg-5">


<form action="{{url('/add-to-cart')}}" method="post">
 @csrf
 @method('POST')









<div class="row">
    @php
  $b_name = DB::table('categories')->where('id',$product_data->category_parent_id)->select('category_name','category_slug_name')->first();
 @endphp
<!--############################## new right card ###############################-->
  <!----------------------------->
      <div class="col-lg-6">
        <div class="tommy_hilfiger_col">
          <div class="heading_COL">
              <form action="{{url('/add-to-cart')}}" method="post">
 @csrf
 @method('POST')
            <div class="row align-items-center">
              <div class="col-auto">
                  <span class="text-secondary">Brand:</span> 
                  <a style="text-decoration:none !important;" class="text-dark" href="{{url('/brand/'.$b_name->category_slug_name.'.html')}}"><small>{{$b_name->category_name}}</small></a>
                <h2>{{$product_data->category_name}}</h2>
              </div>
              <!--<div class="col">-->
              <!--  <img src="{{asset('css/productdetail/images/logo.jpg')}}" alt="..." class="img_class">-->
              <!--</div>-->
            </div>
            <h3> {{$product_data->category_uan_code}}</h3>
         <p> Spotted Transparent/Grey Black Shaded (3314/8G)</p>
            <div class="row align-items-center">
              <div class="col-auto">
                <span class="color_dollor pb-5">
                    
            {{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product_data->category_discount_price)}}
            @if($product_data->category_is_discount=="Yes")
            <strike id="mrp">{{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product_data->category_price)}}</strike>
            @endif
                    
                </span>
              </div>
              <div class="col-auto mt-2 text-end">
                <div class="number ">
                	<span class="minus">-</span>
                	<input type="text" value="1"/>
                	<span class="plus">+</span>
                </div>
              </div>
            </div>
            <div class="row align-items-center mt-2">
              <div class="col-auto">
                <span class="color_div">Color</span>
              </div>
                @php
                $group_ids = explode(',',$product_data->category_group_ids);
                $group_prd = DB::table('categories')->whereIn('id',$group_ids)->where('category_status','Active')->get();
                $i=1;
                @endphp    
                @if(!empty($product_data->category_group_ids)) 
              <div class="col-auto">
                <div class="img_COL">
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
              </div>
              @endif
            </div>
            <div class="row align-items-center mt-2">
              <div class="col-auto">
                <span class="same_col_size">Size</span>
              </div>
              <div class="col-auto">
                <span class="same_col_size">{{str_replace("mm","",$product_data->category_lens_width)}}-{{str_replace("mm","",$product_data->category_bridge)}}-{{str_replace("mm","",$product_data->category_arm_length)}}-{{str_replace("mm","",$product_data->category_lens_height)}}-{{str_replace("mm","",$product_data->category_total_width)}}
</span>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col-auto">
                <div class="class_Btn">
       
                  <a href="#" class="btn1">add to cart</a>
                </div>
              </div>
              <div class="col">
                <div class="class_Btn">
                  <a href="#" class="btn2">ADD TO CART WITH PRESCRIPTION</a>
                </div>
              </div>
            </div>
            <div class="row align-items-center mt-2">
              <div class="col-auto">
                <div class="class_Btn">
                  <a href="#" class="btn3">Pay with
                  <span>
                    <img src="{{asset('css/productdetail/images/p.png')}}" alt="">
                  </span>
                  </a>
                </div>
              </div>
              <div class="col">
                <div class="class_Btn">
                  <a href="#" class="btn4">Add to Wishlist</a>
                </div>
              </div>
              <div class="col-auto">
                <span class="blooth_img">
                  <img src="{{asset('css/productdetail/images/Vector.png')}}" alt="">
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
  <!--3############################## new right card end ###############################-->
<!-------------------------------> 
    
    
    
    

    <!--====================== col lg- 6 end ===================-->

    <!--====================== col lg- 6 end ===================-->

                    
</div> <!--row end  -->


</form>

</div>


<!--<div class="glass-return">
{!!$admin_data->admin_return_info!!}
 </div>-->

<div class="modal_social">
    <h2>Share this product</h2>
<div class="sharethis-inline-share-buttons"></div>    
</div>

</div>
</div>

</div>
</div>
</section>
<!--product slider start  -->

<!--product slider end -->

<!--3########################## section start ###################################-->
<section>
  <div class="container">
          <div class="productColMain">
            <div class="row g-4">
  <div class="col-md-12 col-xl-12">
                <div class="cardStyle1">
            <!------------------------->
            <div class="reviews">
    <div class="review-item">
            <h4>Frame Measurement</h4>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec augue nunc, 
                    pretium at augue at, convallis pellentesque ipsum. Lorem ipsum dolor sit amet, 
                    consectetur adipiscing elit.</p>
                    <hr>
            <h4>Product Detail</h4>
<div class="row">
    <div class="col-md-4"> <!--col md 4 start -->
            <ul >
                <li > <b>Frmae Type :</b>  {{$product_data->type}}</li>
                <li >  <b>Type :</b> {{$product_data->category_frame}}</li>
                <li >  <b>Gender :</b> {{$product_data->category_for}}</li>
            </ul>
    </div> 
    <!--col md 4 end -->
            <div class="col-md-4"> 
            <!--col md 4 start -->
                <ul>
                <li> <b>Frmae Shape :</b> {{$product_data->shape}}</li>
                <li>  <b>EAN Code :</b> {{$product_data->category_sku_code}}</li>
            
            </ul>
        </div> 
        <!--col md 4 end -->
            <div class="col-md-4"> 
            <!--col md 4 start -->
                <ul>
                <li>  <b>Material :</b>  {{$product_data->material}} </li>
                <li>  <b>Warranty :</b> {{$main_cat->category_warranty}}</li>
        
            </ul>




        </div> 
        <!--col md 4 end -->
    </div>
               
                    <hr>
            <h4>Product Description</h4>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec augue nunc, 
                    pretium at augue at, convallis pellentesque ipsum. Lorem ipsum dolor sit amet, 
                    consectetur adipiscing elit.</p>
    </div>
</div>
<!---------------------->
            
                </div>
              </div>
            </div>
          </div>
          </div>
</section>
<!--3############################ section end #################################-->

<!--################################### new section start ##########################################-->
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
            @if($related_products->isNotEmpty())
          <div class="productColMain">
            <div class="row g-3">
                
                @foreach($related_products as $product)
                @php
                $brand = DB::table('categories')->where('id',$product->category_parent_id)->first();
                @endphp
              <!-- card start -->
    <div class="col-md-6 col-xl-3">
                <div class="cardStyle1" id="cardStylecol">
                    @if($product->category_sale_off=="Yes")      
                  <span class="discountCol">20% off</span>
                  @endif 
                  <div class="productImg">
                    <div class="imgCol">
                            @if(!empty($product->category_image_name))  
                            <a href="{{url('/frame/'.$product->category_slug_name.'.html')}}">
                                  <img src="{{asset('uploaded_files/product/'.$product->category_image_name)}}"></a>
                            @else
                            <a href="{{url('/frame/'.$product->category_slug_name.'.html')}}"> 
                            <img class="img-responsive" src="{{ asset('admin_assets/images/no_image.jpg') }}" alt=""> </a>
                            @endif
                    </div>
                    <!--display none-->
                    <div class="back d-none" >    

                @if(!empty($product->category_image_name2))  
                <a href="{{url('/frame/'.$product->category_slug_name.'.html')}}"> 
                <img src="{{asset('uploaded_files/product/'.$product->category_image_name2)}}"></a>
                @else
                <a href="{{url('/frame/'.$product->category_slug_name.'.html')}}"> 
                <img class="img-responsive" src="{{ asset('admin_assets/images/no_image.jpg') }}" alt=""> </a>
                @endif
                </div>
                    <!--display none-->
                    <div class="color_builts" id="color_builts">
                        <!-------------------------------- color start -------------------------------->
                        @php
                        $get_current_color = DB::table('product_colors')->where('id',$product->category_color)->first(); 
                        @endphp
                      <ul>
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
               
    
                        <li>
                          <a href="{{url('/frame/'.$group->category_slug_name.'.html')}}"  class="colorCol actColor btn-tool @if($group->category_slug_name==$product->category_slug_name) color-btn @endif">
                              
                              <img src="{{asset('uploaded_files/color_image/'.$color_data->color_image_name)}}" alt="..."></a>
                        </li>
                    @php
                    $i++;
                    @endphp   
                    @endforeach
                    @else


                        <li>
                          <a href="{{url('/frame/'.$product->category_slug_name.'.html')}}"  class="colorCol">
                              <img src="{{asset('uploaded_files/color_image/'.$get_current_color->color_image_name)}}" alt="..."></a>
                        </li>
                        @endif
                      </ul>
                    </div>
                    <!--color end -->
                  </div>
                  <div class="contentCol">
                      <!--brand name -->
                    <h4 class="brandCol">{{$brand->category_name}}</h4>
                    <!--brand name -->
                    <p><a href="{{url('/frame/'.$product->category_slug_name.'.html')}}" class="title">
                            {{Str::limit($product->category_name,30,$end='...')}}</a></p>
                    <!--price -->       
                    <span class="priceCol">
                        {{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product->category_discount_price)}} 
                        @if($product->category_is_discount=="Yes")
                            <strike id="mrp">{{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product->category_price)}}</strike> 
                            @endif
                        </span>
                    <!--price -->
                    <div class="row gx-2">
                      <div class="col-auto">
                        <a href="{{url('/frame/'.$product['category_slug_name'].'.html')}}" class="btn btnDark w-100 " id="addCartBtn">ADD TO CART</a>
                      </div>
                       &nbsp;
                      <div class="col">
                        <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- card end -->
              @endforeach

            </div>
            <div class="btnCol text-center">
              <!--<a href="javascript:void(0)" class="btn btnPrimary minWdBtn btnNew">Load More</a>-->
            </div>
          </div>
          @endif
        </div>
        </div>
      </div>
    </div>
  </section>

<!--################################# new section end #############################################-->

<!------------------------- old code was goes here ----------------------------->
  <script>
  $(document).ready(function() {
  			$('.minus').click(function () {
  				var $input = $(this).parent().find('input');
  				var count = parseInt($input.val()) - 1;
  				count = count < 1 ? 1 : count;
  				$input.val(count);
  				$input.change();
  				return false;
  			});
  			$('.plus').click(function () {
  				var $input = $(this).parent().find('input');
  				$input.val(parseInt($input.val()) + 1);
  				$input.change();
  				return false;
  			});
  		});
  </script>



<script type="text/javascript">

	//apply the 'elevateZoom' plugin to the image


$(document).ready(function(){


	    $('.carousel-inner img').mouseenter(function(){  //click, dblclick also can use, mouseenter , 
//         //   alert('you click on image');

            // $(this).zoom();
        $(this).css({
            'transform':'scale(1.5,1.5)',
            'transition':'0.5s ease'
            
        });
    
    });
       
       
    $('.carousel-inner img').mouseout(function(){  //click, dblclick also can use, mouseenter 
    $(this).css({
        'transform':'scale(1,1)',
        'transition':'0.5s ease'
    });
    $(this).Toggle('slow');   
});

});

</script>
@endsection
