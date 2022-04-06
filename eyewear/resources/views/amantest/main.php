
@Extends('amantest.app')

@section('content')

<section>
    <div class="brand_banner">
      <div class="container">
        <div class="brand_banner_content">
          <div class="brand_banner_content_text text-center">
            <h1 class="brand_bannner_head">Sunglasses</h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumbStyle justify-content-center">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sunglasses</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="product_detail section_space pb-0">
      <div class="container">
        <div class="product_deatail_list">
          <div class="product_deatail_list_text">
            <div class="lineTitleCol">
              <h6 class="lineTitle">Explore Our Products</h6>
            </div>
            <h2 class="product_detail_head lgTitle darkColor">Most Loved Frames</h2>
          </div>
          <!--card start-->

          <div class="filterColMain pt-3">
            <div class="filterCol">
              <div class="row g-2 g-md-3">
                <div class="col"><a  class="btn btnDark w-100 filterBtn"  data-bs-toggle="offcanvas" 
                href="#filterCanvas" role="button" aria-controls="filterCanvas"><span class="filterIcon">
                    <img src="{{asset('uploaded_files/assets/images/filter-icon.svg')}}" alt="..."></span> <span>Filter</span></a></div>
                <div class="col">
                  <select class="form-select selectStyle" aria-label="Default select example">
                    <option selected>Sort by</option>
                    <option value="1">Sort by Name</option>
                    <option value="2">Sort by Name</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <!--card end-->
          <!--==================== Woman_Sunglasses productColMain ========================-->
          
        <!-- product start -->
      
        <!-- product start -->
        @if($sunglasses->isNotEmpty())
<div class="productColMain">
          <div class="row g-4">
              <!--col-md-6 col-xl-4-->
@foreach($sunglasses as $product)
@php
$brand = DB::table('categories')->where('id',$product->category_parent_id)->first();
@endphp
              
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
@if($product['category_is_discount']=="Yes")  
<span class="discountCol"> {{$product['category_discount']}}% </span>
@endif
             
                <div class="productImg">
                    <a href="{{url('/frame/'.$product['category_slug_name'].'.html')}}">
                  <div class="imgCol">
@if(!empty($product->category_image_name)) 
                    <img src="{{asset('uploaded_files/product/'.$product->category_image_name)}}" alt="product-img-1">
@else
<img  src="{{ asset('admin_assets/images/no_image.jpg') }}" alt="...." >
@endif
</div>
</a>
@php
$get_current_color = DB::table('product_colors')->where('id',$product->category_color)->first(); 
@endphp

                  <div class="color_builts">
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
    <img src="{{asset('assets/images/brown.jpg')}}" alt="..."></a>
                      </li>
@endif
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol">{{$brand->category_name}}</h4>
                  
                   <a href="{{url('/frame/'.$product['category_slug_name'].'.html')}}" style="text-decoration:none; color:black;">
                    <p>{{Str::limit($product->category_name,25,$end='...')}} </p>
                        </a>
                        <!--PRICE-->
                <span class="priceCol">
                    {{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product->category_discount_price)}} </span>
                                             <span>
@if($product->category_is_discount=="Yes")
<strike id="mrp">{{getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product->category_price)}}</strike>
@endif
                             </span>

                     <div class="row gx-2">
                      <div class="col-auto">
         <!--add to cart  -->

<!--add to cart  -->
       <a href="{{url('/frame/'.$product['category_slug_name'].'.html')}}" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                      </div>
                      <div class="col">
                
                <form action="{{url('/add-wishlist')}}" method="post">
 @csrf
 @method('POST')
<input type="hidden" name="product_id" class="product_id" value="{{$product->id}}"/>
<input type="hidden" value="1" name="qty" />
<button type="submit" value="Add To WISHLIST"  class="btn btnDark_outline w-100" >
  ADD TO WISHLIST</button>
</form>   
    

                      </div>
                    </div>
                    
                </div>
              </div>
            </div>
@endforeach
            <!--col-md-6 col-xl-4 END-->
        
          </div>
          <div class="btnCol text-center">
            <a href="{{url('/sunglasses/men')}}" class="btn btnPrimary minWdBtn btnNew">Shop Now</a>
          </div>
        </div>
       @endif

           <!--==================== Woman_sunglasses productColMain ========================-->
        </div>
        </div>
      </div>
    </div>
  </section>
  <div class="offcanvas offcanvas-start offCanvasStyle" tabindex="-1" id="filterCanvas" aria-labelledby="filterCanvasLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="filterCanvasLabel"></h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

 
 <!--side bar -->
 <div class="backDrop"></div>
  <div class="offcanvas-body">

    <h5 class="smTitle">Gender</h5>
    <div class="filterChekCol">
      <ul>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="genderCheck_01" autocomplete="off">
            <label class="btn btn-outline-secondary" for="genderCheck_01">Male</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="genderCheck_02" autocomplete="off">
            <label class="btn btn-outline-secondary" for="genderCheck_02">Female</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="genderCheck_03" autocomplete="off">
            <label class="btn btn-outline-secondary" for="genderCheck_03">Kid</label>
          </span>
        </li>
      </ul>
    </div>

    <h5 class="smTitle">Our Brands</h5>
    <div class="filterChekCol">
      <ul>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck1">Carrera</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck2" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck2">MARC JACOBS</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck3" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck3">Fendi</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck4" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck4">JIMMY CHOO</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck5" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck5">Hugo</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck6" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck6">GIVENCHY</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck7" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck7">Tommy Hilfiger</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck8" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck8">Elie Saab</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck9" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck9">Polaroid</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck10" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck10">Kate Spade</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck11" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck11">Burberry</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck12" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck12">Gucci</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck13" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck13">Bvlgari</label>
          </span>
        </li>
      </ul>
    </div>

    <h5 class="smTitle">colors</h5>
    <div class="filterChekCol">
      <ul>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-01" autocomplete="off">
            <label class="btn colorBtn" for="btncheck-01"><img src="{{asset('assets/images/black.jpg')}}" alt="..."></label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-02" autocomplete="off">
            <label class="btn colorBtn" for="btncheck-02"><img src="{{asset('assets/images/brown.jpg')}}" alt="..."></label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-03" autocomplete="off">
            <label class="btn colorBtn" for="btncheck-03"><img src="{{asset('assets/images/blue.jpg')}}" alt="..."></label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-04" autocomplete="off">
            <label class="btn colorBtn" for="btncheck-04"><img src="{{asset('assets/images/color-4.jpg')}}" alt="..."></label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-05" autocomplete="off">
            <label class="btn colorBtn" for="btncheck-05"><img src="{{asset('assets/images/color-5.jpg')}}" alt="..."></label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-06" autocomplete="off">
            <label class="btn colorBtn" for="btncheck-06"><img src="{{asset('assets/images/color-6.jpg')}}" alt="..."></label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-07" autocomplete="off">
            <label class="btn colorBtn" for="btncheck-07"><img src="{{asset('assets/images/color-7.jpg')}}" alt="..."></label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-08" autocomplete="off">
            <label class="btn colorBtn" for="btncheck-08"><img src="{{asset('assets/images/color-8.jpg')}}" alt="..."></label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-09" autocomplete="off">
            <label class="btn colorBtn" for="btncheck-09"><img src="{{asset('assets/images/color-9.jpg')}}" alt="..."></label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-010" autocomplete="off">
            <label class="btn colorBtn" for="btncheck-010"><img src="{{asset('assets/images/color-10.jpg')}}" alt="..."></label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-011" autocomplete="off">
            <label class="btn colorBtn" for="btncheck-011"><img src="{{asset('assets/images/color-11.jpg')}}" alt="..."></label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-012" autocomplete="off">
            <label class="btn colorBtn" for="btncheck-012"><img src="{{asset('assets/images/color-12.jpg')}}" alt="..."></label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-013" autocomplete="off">
            <label class="btn colorBtn" for="btncheck-013"><img src="{{asset('assets/images/color-13.jpg')}}" alt="..."></label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-014" autocomplete="off">
            <label class="btn colorBtn" for="btncheck-014"><img src="{{asset('assets/images/color-14.jpg')}}" alt="..."></label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-015" autocomplete="off">
            <label class="btn colorBtn" for="btncheck-015"><img src="{{asset('assets/images/color-15.jpg')}}" alt="..."></label>
          </span>
        </li>
      </ul>
    </div>

    <h5 class="smTitle">SHAPES</h5>
    <div class="filterChekCol">
      <ul>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-001" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck-001">Rectangle</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-002" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck-002">Square</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-003" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck-003">Round</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-004" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck-004">Aviator</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-005" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck-005">Cat-eye</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-006" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck-006">Navigator</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-007" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck-007">Hexagon</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-008" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck-008">Round - Oval</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-009" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck-009">Butterfly</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck-0010" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck-0010">Pilot</label>
          </span>
        </li>
      </ul>
    </div>

    <h5 class="smTitle">material</h5>
    <div class="filterChekCol">
      <ul>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck_01" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck_01">Acetate</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck_02" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck_02">Metal</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck_03" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck_03">Mixed</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck_04" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck_04">Acetate And Metal</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck_05" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck_05">Titanium</label>
          </span>
        </li>
      </ul>
    </div>


    <h5 class="smTitle">frame type</h5>
    <div class="filterChekCol">
      <ul>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck__01" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck__01">Full Frame</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck__02" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck__02">Semi Rim</label>
          </span>
        </li>
        <li>
          <span class="filterChek">
            <input type="checkbox" class="btn-check" id="btncheck__03" autocomplete="off">
            <label class="btn btn-outline-secondary" for="btncheck__03">Rimless</label>
          </span>
        </li>
      </ul>
    </div>
  </div>
</div>
          <!--================ end eye glass section ========================-->
       

  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  <script src="{{asset('assets/js/script.js')}}"></script>
  <script>
    var swiper = new Swiper(".logoSwiper", {
      slidesPerView: 1,
      spaceBetween: 5,
      loop: true,
      loopFillGroupWithBlank: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
          375: {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          480: {
            slidesPerView: 3,
            spaceBetween: 10,
          },
          768: {
            slidesPerView: 4,
            spaceBetween: 10,
          },
          1200: {
            slidesPerView: 5,
            spaceBetween: 10,
          },
        },
    });
  </script>

  <script>
    var swiper = new Swiper(".testimonialSlider", {
      spaceBetween: 30,
      effect: "fade",
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });
  </script>
  <script>
    var swiper = new Swiper(".bannerSlider", {
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });



</script>

@endsection


    



