@php
$get_brands = DB::table('newbrands')->where('status','Active')->orderBy('name')->get();
@endphp
  <section>
    <div class="brand_logo_section">
      <div class="container">
        <div class="brand_swiper_img">
          <div class="swiper logoSwiper">
<div class="swiper-wrapper">

@foreach($get_brands as $key => $value)
  <div class="swiper-slide">
      <a href="{{asset($value->url)}}">
      <img src="{{asset($value->image)}}" alt="Image Not Found"></a>
      </div>
@endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <!-- <div class="swiper-pagination"></div> -->
          </div>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="productsCol section_space py-0">
      <div class="container">
        <!-- ================ -->
<!--female code collection -->
@include('frontend.female_sunglasses_core')
<!--end female core collection -->
<!--#############################################################################-->
                            <!--START sunglasses-->      
                    @include('frontend.sunglass')

                            <!--END sunglasses-->      
<!--#############################################################################-->
       <!--END COL-->
      </div>
    </div>
  </section>

  <section>
    <div class="productsCol section_space">
      <div class="container">
        <!-- =================== -->
        <div class="bgLight">
          <div class="row gx-0 align-items-center">
            <div class="col-sm-6 order-lg-last">
              <div class="core_coll_img">
                <img src="{{asset('uploaded_files/assets/images/webp/male-product.webp')}}" alt="Image Not Found">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="collection_col whiteBGColor core_coll_block_padding collection_col_right">
                <h2 class="darkColor">Male Sunglasses COre Collection</h2>
                  <div class="line"></div>
                  <div class="row text-end">
                    <div class="col">
                      <div class="core_coll_shop_btn">
                        <a href="{{url('/sunglasses/men')}}" target="_blank" class="btn btnShop darkBGColor whiteColor whiteColor">SHOP</a>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ======================= -->
<!--################################## Eyeglasses #####################################-->    

                        @include('frontend.male_sunglass')

<!--################################## Eyeglasses #####################################-->
        <!--==============-->
      </div>
    </div>
  </section>

<!--######################## FEMALE CARD #############################-->
  <section>
    <div class="image_grid_col image_grid_content overflow-hidden">
      <div class="row g-2">
        <div class="col-sm-6">
          <img src="{{asset('uploaded_files/assets/images/webp/img_grid.webp')}}" alt="Image Not Found">
        </div>
        <div class="col-sm-6">
          <img src="{{asset('uploaded_files/assets/images/webp/img_grid2.webp')}}" alt="Image Not Found">
        </div>
        <div class="col-sm-6">
          <img src="{{asset('uploaded_files/assets//images/webp/img_grid3.webp')}}" alt="Image Not Found">
        </div>
        <div class="col-sm-6">
          <img src="{{asset('uploaded_files/assets/images/webp/img_grid4.webp')}}" alt="Image Not Found">
        </div>
      </div>
    </div>
  </section>
  <!--######################## FEMALE CARD #############################-->
  

 <section>
    <div class="productsCol section_space">
      <div class="container">
        <!-- ==================== -->
          <div class="bgLight">
          <div class="row gx-0 align-items-center">
            <div class="col-sm-6">
              <div class="core_coll_img">
                <img src="{{asset('uploaded_files/assets/images/webp/female_eye_glass.webp')}}" alt="Image Not Found">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="collection_col whiteBGColor core_coll_block_padding">
                <h2 class="darkColor">Female Eyeglasses COre Collection</h2>
                  <div class="line"></div>
                  <div class="row text-end">
                    <div class="col">
                      <div class="core_coll_shop_btn">
                        <a class="btn btnShop darkBGColor whiteColor whiteColor" target="_blank" href="{{url('/eyeglasses/women')}}">SHOP</a>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <!-- =========== productColMain ============ -->
<!--################################## Eyeglasses #####################################-->

                        @include('frontend.eyeglass')

<!--################################## Eyeglasses #####################################-->
        <!-- =========== productColMain ============ -->
      </div>
    </div>
  </section>

  <section>
    <div class="productsCol section_space py-0">
      <div class="container">
        <!-- ========================= -->
        <div class="bgLight">
          <div class="row gx-0 align-items-center">
            <div class="col-sm-6 order-lg-last">
              <div class="core_coll_img">
                <img src="{{asset('uploaded_files/assets/images/webp/male-product1.webp')}}" alt="Image Not Found">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="collection_col whiteBGColor core_coll_block_padding collection_col_right">
                <h2 class="darkColor">Male Eyeglasses COre Collection</h2>
                  <div class="line"></div>
                  <div class="row text-end">
                    <div class="col">
                      <div class="core_coll_shop_btn">
                        <a href="{{url('/eyeglasses/men')}}" target="_blank" class="btn btnShop darkBGColor whiteColor whiteColor">SHOP</a>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- =========== productColMain  ============ -->
<!--#############################################################################-->
                            <!--START sunglasses-->      
                        @include('frontend.male_eyeglass')
                            <!--END sunglasses-->      
<!--#############################################################################-->
        <!--============== productColMain ==============-->
      </div>
    </div>
  </section>
