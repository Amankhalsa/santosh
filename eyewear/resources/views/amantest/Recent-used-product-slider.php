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
 <!--<link rel="stylesheet" href="css/smoothproducts.css">-->
 
<link rel="stylesheet" type=text/css href="{{asset('css/productdetail/style.css')}}">
<!--slider css-->
<link rel="stylesheet" type="text/css" href="{{asset('css/productdetail/jquery.exzoom.css')}}">
<!--slider css-->
<!--new -->

<style>
/*zoom*/

/*zoom*/
#reviewcardStyle{
    padding:28px!important;
}
    #exzoom{
        position: absolute;
        top: 50%;
        left: 25%;
        transform: translate(-50%, -50%);
        width: 400px;
    }
#newproduct_silder{ margin-top:7rem;}
.img_COL img { width: 50%;border-radius: 50%;border:5px solid;border-color:gray;border-style: double;}
#addCartBtn { min-width: 190px;margin-bottom: 1rem;}
#color_builts {padding: 8px 0 8px 0;}
#cardStylecol{ border: 1px solid #D2D2D2;padding: 0px 15px 20px 15px;position: relative;}
</style>

@endsection

{{-- Meta tag Section End --}}

@section('content')




<!--####################################### new product slider start ########################################################  -->
<section>

  <div class="container-fluid" id="newproduct_silder">
    <div class="row mt-5 align-items-center">
        <!--############### slider start  #############  -->
      <div class="col-md-6">

        <div class="swiper_COl " >
          <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2 " >
            <div class="swiper-wrapper ">
                <!--testing -->
                
                <!--testing-->
              <div class="swiper-slide ">
                  
                <img src="{{asset('uploaded_files/product/'.$product_data->category_image_name)}}" alt="{{$product_data->category_name}}" title="{{$product_data->category_name}}">
              </div>
                            @if(!empty($product_data->category_image_name2))
              <div class="swiper-slide">
               <img src="{{asset('uploaded_files/product/'.$product_data->category_image_name2)}}" alt="{{$product_data->category_name}}" title="{{$product_data->category_name}}">
              </div>
              @endif
              <!--if else -->
              @if(!empty($product_data->category_image_name3))
                 <div class="swiper-slide">
               <img src="{{asset('uploaded_files/product/'.$product_data->category_image_name3)}}" alt="{{$product_data->category_name}}" title="{{$product_data->category_name}}">
              </div>
              @endif
              <!--if else -->
                    <!--if else -->
              @if(!empty($product_data->category_image_name4))
                 <div class="swiper-slide">
               <img src="{{asset('uploaded_files/product/'.$product_data->category_image_name4)}}" alt="{{$product_data->category_name}}" title="{{$product_data->category_name}}">
              </div>
              @endif
              <!--if else -->
                    <!--if else -->
              @if(!empty($product_data->category_image_name5))
                 <div class="swiper-slide">
               <img src="{{asset('uploaded_files/product/'.$product_data->category_image_name5)}}" alt="{{$product_data->category_name}}" title="{{$product_data->category_name}}">
              </div>
              @endif
              <!--if else -->
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev" style="color:#f07500 !important;"></div>
          </div>
          
          <div thumbsSlider="" class="swiper mySwiper">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <img src="{{asset('uploaded_files/product/'.$product_data->category_image_name)}}" alt="{{$product_data->category_name}}" title="{{$product_data->category_name}}">
              </div>
              <div class="swiper-slide">
               <img src="{{asset('uploaded_files/product/'.$product_data->category_image_name2)}}" alt="{{$product_data->category_name}}" title="{{$product_data->category_name}}">
              </div>
                     <!--if else -->
              @if(!empty($product_data->category_image_name3))
                 <div class="swiper-slide">
               <img src="{{asset('uploaded_files/product/'.$product_data->category_image_name3)}}" alt="{{$product_data->category_name}}" title="{{$product_data->category_name}}">
              </div>
              @endif
              <!--if else -->
                    <!--if else -->
              @if(!empty($product_data->category_image_name4))
                 <div class="swiper-slide">
               <img src="{{asset('uploaded_files/product/'.$product_data->category_image_name4)}}" alt="{{$product_data->category_name}}" title="{{$product_data->category_name}}">
              </div>
              @endif
              <!--if else -->
                    <!--if else -->
              @if(!empty($product_data->category_image_name5))
                 <div class="swiper-slide">
               <img src="{{asset('uploaded_files/product/'.$product_data->category_image_name5)}}" alt="{{$product_data->category_name}}" title="{{$product_data->category_name}}">
              </div>
              @endif
              <!--if else -->
            </div>
          </div>
        </div>

      </div>
    <!--############### slider end  #############  -->
      <!--right part start-->
@php
$b_name = DB::table('categories')->where('id',$product_data->category_parent_id)->select('category_name','category_slug_name')->first();
@endphp
      <div class="col-lg-6">
        <div class="tommy_hilfiger_col">
          <div class="heading_COL">
            <div class="row align-items-center">
              <div class="col-auto">
                  <span class="text-secondary">Brand:</span>  
                  <a style="text-decoration:none !important;" class="text-dark" href="{{url('/brand/'.$b_name->category_slug_name.'.html')}}"><small>{{$b_name->category_name}}</small></a>
                <h2>{{$product_data->category_name}}</h2>
              </div>
              <!--<div class="col">-->
              <!--  <img src="images/logo.jpg" alt="" class="img_class">-->
              <!--</div>-->
            </div>
            <!-- #################################################### form end #################################################### -->
<form action="{{url('/add-to-cart')}}" method="post">
 @csrf
 @method('POST')
            <!--uan-->
            <h3>{{$product_data->category_uan_code}}</h3>
            <!--uan-->
            <!--<p>Spotted Transparent/grey Black Shaded (3314/8G) </p>-->
            <div class="row align-items-center">
              <div class="col-auto">
         <!--hidden          -->
<input type="hidden" name="product_id" class="product_id" value="{{$product_data->id}}"/>
<input value="1" type="hidden" class="prd_qty" name="qty">
<!--hidden-->
                <span class="color_dollor pb-5">
                    
                    {{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product_data->category_discount_price)}}
@if($product_data->category_is_discount=="Yes")
<strike id="mrp">{{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product_data->category_price)}}</strike>
@endif
                </span>
              </div>
              <div class="col-auto mt-2 text-end">
                <div class="number"><span class="minus">-</span><input type="text" value="1" /><span class="plus">+</span>
                </div>
              </div>
            </div>
            <div class="row align-items-center mt-2">
              <div class="col-auto">
                <span class="color_div">Color</span>
              </div>
              <!--for color -->
                @php
                $group_ids = explode(',',$product_data->category_group_ids);
                $group_prd = DB::table('categories')->whereIn('id',$group_ids)->where('category_status','Active')->get();
                $i=1;
                @endphp    
                @if(!empty($product_data->category_group_ids)) 
              <!--===================================for color=============== -->
              <div class="col-auto">
                <div class="img_COL">
                    <!--foreach-->
                @foreach($group_prd as $group)
                @php
                $color_data = DB::table('product_colors')->where('id',$group->category_color)->first(); 
                @endphp
                <!--foreach-->
                <a href="{{url('/frame/'.$group->category_slug_name.'.html')}}" >
                <img class="pro-i "  src="{{asset('uploaded_files/color_image/'.$color_data->color_image_name)}}">
                </a>
                    @php
                    $i++;
                    @endphp   
                    @endforeach  
                </div>
              </div>
                  <!--===================================for color=============== -->
              @endif
            </div>
            <!--Size-->
            <div class="row align-items-center mt-2">
              <div class="col-auto">
                <span class="same_col_size">Size</span>
              </div>
              <div class="col-auto">
                <span class="same_col_size">{{str_replace("mm","",$product_data->category_lens_width)}}-{{str_replace("mm","",$product_data->category_bridge)}}-{{str_replace("mm","",$product_data->category_arm_length)}}-{{str_replace("mm","",$product_data->category_lens_height)}}-{{str_replace("mm","",$product_data->category_total_width)}}</span>
              </div>
            </div>
            <!--Size-->
     <div class="row align-items-center">
              <div class="col-auto">
                <div class="class_Btn">
                  <button href="#" class="btn1">add to cart</button>
                </div>
              </div>
              <div class="col">
                  <!--class_Btn-->
@if($product_data->available_with_lens=="Yes")        
 @if($product_data->category_qty>0)
 
                <div class="class_Btn">
                  <button type="button" class="btn2" onclick="addLensCart('{{$product_data->id}}')"> Buy PRESCRIPTION with Lens</button>
                </div>
                @else
                 <div class="class_Btn">
                  <button type="button" class="btn2"  disabled style="cursor:no-drop;background-color:#bdbdbd"> Buy PRESCRIPTION with Lens</button>
                </div>
                @endif
                @else
                  <div class="class_Btn">
                  <button type="button" class="btn2"  disabled style="cursor:no-drop;background-color:#bdbdbd"> Buy PRESCRIPTION with Lens</button>
                </div>
                <!--class_Btn-->
      
              </div>
                  <h5 class="popover__title"><i class="fa fa-question-circle"></i></h5>
                <p class="text-danger font-weight-bold">{{$admin_data->available_with_lens_desc}}</p>
                @endif
            </div>

          </form>
          
<!-- #################################################### form end #################################################### -->
            <div class="row align-items-center mt-2">
              <div class="col-auto">
                <div class="class_Btn" style="background-color: #fec337; padding-top:0px!important; ">
                  <a href="#" class="btn3"  style="  padding: 18px 49px; text-shadow: 2px 1px 1px white;" >Pay with <span style="color:#0a2e8c ">pay</span><span style="color:#149dea">pal</span>
                 
                  </a>
                </div>
              </div>
              <div class="col">
                <div class="class_Btn" style=" padding-top:0px!important; ">
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
            <!--right part end-->
    </div>
  </div>

  </section>
  

<!-- ###################################### new product slider end #################################################### -->

<!--3########################## section start ###################################-->
<section>
  <div class="container" >
          <div class="productColMain">
            <div class="row g-4">
  <div class="col-md-12 col-xl-12">
                <div class="cardStyle1" id="reviewcardStyle">
              
            <!------------------------->
            <div class="reviews">
    <div class="review-item">
        <div class='row'>
            <div class="col-md-8">
                            <h4>Frame Measurement</h4>
                            
<!--if lense avilable size chart button will show -->
@if($product_data->available_with_lens=="Yes")  
<div class="w3-bar w3-black" style="background-color: #f8f4f4;">
<button class="w3-bar-item w3-button btn btn-dark" onclick="openCity('SizeChart')">Size Chart</button>
</div>
@endif
<!--if lense avilable size chart button will show -->

<!--SizeChart start -->
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
<!--SizeChart end -->
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
            <div class="col-md-4 d-flex align-items-center  justify-content-center" style="text-align:center;   border-left: 1px solid gray;">
              
                <img src="{{asset('css/productdetail/images/logo.jpg')}}" alt="..." class="img_class">
              
            </div>
        </div>

            <h4>Product Detail</h4>
<div class="row">
    <div class="col-md-4"> <!--col md 4 start -->
            <ul >
                <li > <b>Frmae Type :</b>  {{$product_data->type}}</li>
                <li >  <b>Type :</b> {{$product_data->category_frame}}</li>
                <li >  <b>Gender :</b> {{$product_data->category_for}}</li>
                
@if(!empty($product_data->lens_type))
<li><b>Lens Type : </b>
<ul>
@foreach($lens_types as $data)
 <li>{{$data->lens_type}}</li>
@endforeach
</ul>
</li>
@endif


            </ul>
    </div> 
    <!--col md 4 end -->
            <div class="col-md-4"> 
            <!--col md 4 start -->
                <ul>
                <li> <b>Frmae Shape :</b> {{$product_data->shape}}</li>
                <li>  <b>EAN Code :</b> {{$product_data->category_sku_code}}</li>
@if(!empty($product_data->extra))
<li><b>Extra : </b>
<ul>
@foreach($extras as $data)
 <li>{{$data->extra}}</li>
@endforeach
</ul>
</li>
@endif
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
    <!--end ul row -->
                    <!--category_description start -->
                    <hr>
                   
                    <h4>Product Description</h4>
                     @if(!empty($product_data->category_description))
                    <p>{!!$product_data->category_description!!}</p>
                    @endif 
                    <!--category_description end-->
                    
                    
    </div>
</div>
<!---------------------->
            
                </div>
<!--3#############################################################-->

                <!--3#############################################################-->
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
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
  </script>
  <script>
    $(document).ready(function() {
      $('.minus').click(function() {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
      });
      $('.plus').click(function() {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
      });
    });
  </script>

  <script>
    var swiper = new Swiper(".mySwiper", {
        
      loop: true,
      spaceBetween: 10,
      slidesPerView: 3,
      freeMode: true,
      watchSlidesProgress: true,
    });
    var swiper2 = new Swiper(".mySwiper2", {
      loop: true,
      spaceBetween: 10,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      thumbs: {
        swiper: swiper,
      },
    });
  </script>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!--for zoom-->
<script type="text/javascript">
    $(function(){

  $("#exzoom").exzoom({
     "autoPlay":false

    // options here
  });

});
</script>
<!-------------------------------------->
<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="{{asset('css/productdetail/jquery.exzoom.js')}}" ></script>

@endsection
