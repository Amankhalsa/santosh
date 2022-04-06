@Extends('frontend.home_master')
@section('title', 'Home')

@section('content')
<!-- slider   -->
@include('frontend.body.slider')
<!-- slider  -->
  <section>
    <div class="brand_logo_section">
      <div class="container">
        <div class="brand_swiper_img">
          <div class="swiper logoSwiper">
<div class="swiper-wrapper">
  <div class="swiper-slide"><img src="{{asset('assets/images/brand_logo_1.png')}}" alt="Image Not Found"></div>
  <div class="swiper-slide"><img src="{{asset('assets/images/brand_logo_2.png')}}" alt="Image Not Found"></div>
  <div class="swiper-slide"><img src="{{asset('assets/images/brand_logo_3.png')}}" alt="Image Not Found"></div>
  <div class="swiper-slide"><img src="{{asset('assets/images/brand_logo_4.png')}}" alt="Image Not Found"></div>
  <div class="swiper-slide"><img src="{{asset('assets/images/brand_logo_5.png')}}" alt="Image Not Found"></div>
  <div class="swiper-slide"><img src="{{asset('assets/images/brand_logo_3.png')}}" alt="Image Not Found"></div>
  <div class="swiper-slide"><img src="{{asset('assets/images/brand_logo_2.png')}}" alt="Image Not Found"></div>
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
        <div class="bgLight">
          <div class="row gx-0 align-items-center">
            <div class="col-sm-6">
              <div class="core_coll_img">
                <img src="{{asset('assets/images/female-product2.jpg')}}" alt="Image Not Found">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="collection_col whiteBGColor core_coll_block_padding">
                <h2 class="darkColor">Female Sunglasses COre Collection</h2>
                  <div class="line"></div>
                  <div class="row text-end">
                    <div class="col">
                      <div class="core_coll_shop_btn">
                        <a class="btn btnShop darkBGColor whiteColor whiteColor" href="#">SHOP</a>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div class="productColMain">
          <div class="row g-4">
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
                <span class="discountCol">20% off</span>
                <div class="productImg">
                  <div class="imgCol">
                    <img src="{{asset('assets/images/product-img-1.png')}}" alt="product-img-1">
                  </div>
                  <div class="color_builts">
                    <ul>
                      <li>
                        <a href="javascript:void(0)"  class="colorCol actColor"><img src="{{asset('assets/images/black.jpg')}}" alt="..."></a>
                      </li>
                      <li>
                        <a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/brown.jpg')}}" alt="..."></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol">HUGO BOSS</h4>
                  <p>HUGO BOSS HG 0328 086</p>
                  <span class="priceCol">₹8900 </span>
                  <div class="row gx-2">
                    <div class="col-auto">
                      <a href="javascript:void(0)" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                    </div>
                    <div class="col">
                      <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
                <div class="productImg">
                  <div class="imgCol">
                    <img src="{{asset('assets/images/product-img-2.png')}}" alt="...">
                  </div>
                  <div class="color_builts">
                    <ul>
<li>
<a href="javascript:void(0)"  class="colorCol actColor"><img src="{{asset('assets/images/black.jpg')}}" alt="..."></a>
</li>
<li>
<a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/brown.jpg')}}" alt="..."></a>
</li>
<li>
<a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/blue.jpg')}}" alt="..."></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol">TOMMY HILFIGER</h4>
                  <p>TOMMY HILFIGER TH 1689 086</p>
                  <span class="priceCol">₹9900 </span>
                  <div class="row gx-2">
                    <div class="col-auto">
                      <a href="javascript:void(0)" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                    </div>
                    <div class="col">
                      <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
                <span class="discountCol">20% off</span>
                <div class="productImg">
                  <div class="imgCol">
                    <img src="{{asset('assets/images/product-img-3.png')}}" alt="...">
                  </div>
                  <div class="color_builts">
<ul>
<li>
<a href="javascript:void(0)" class="colorCol actColor"><img src="{{asset('assets/images/brown.jpg')}}" alt="..."></a>
</li>
<li>
<a href="javascript:void(0)" class="colorCol"><img src="{{asset('assets/images/blue.jpg')}}" alt="..."></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol">TOMMY HILFIGER</h4>
                  <p>TOMMY HILFIGER TH 1689 086</p>
                  <span class="priceCol">₹9900 </span>
                  <div class="row gx-2">
                    <div class="col-auto">
                      <a href="javascript:void(0)" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                    </div>
                    <div class="col">
                      <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
                <span class="discountCol">20% off</span>
                <div class="productImg">
                  <div class="imgCol">
                    <img src="{{asset('assets/images/product-img-4.png')}}" alt="...">
                  </div>
                  <div class="color_builts">
                    <ul>
<li>
<a href="javascript:void(0)"  class="colorCol actColor"><img src="{{asset('assets/images/blue.jpg')}}" alt="..."></a>
</li>
<li>
<a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/brown.jpg')}}" alt="..."></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol">ELIE SAAB</h4>
                  <p>ELIE SAAB ES 061/G/S MVU</p>
                  <span class="priceCol">₹41800</span>
                  <div class="row gx-2">
                    <div class="col-auto">
                      <a href="javascript:void(0)" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                    </div>
                    <div class="col">
                      <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
                <div class="productImg">
                  <div class="imgCol">
                    <img src="{{asset('assets/images/product-img-5.png')}}" alt="...">
                  </div>
                  <div class="color_builts">
<ul>
<li>
<a href="javascript:void(0)"  class="colorCol actColor"><img src="{{asset('assets/images/brown.jpg')}}" alt="..."></a>
</li>
<li>
<a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/black.jpg')}}" alt="..."></a>
</li>
<li>
<a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/blue.jpg')}}" alt="..."></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol">JIMMY CHOO</h4>
                  <p>JIMMY CHOO VINA/G/SK J5G</p>
                  <span class="priceCol">₹19900</span>
                  <div class="row gx-2">
                    <div class="col-auto">
                      <a href="javascript:void(0)" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                    </div>
                    <div class="col">
                      <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
                <span class="discountCol">20% off</span>
                <div class="productImg">
                  <div class="imgCol">
                    <img src="{{asset('assets/images/product-img-6.png')}}" alt="...">
                  </div>
                  <div class="color_builts">
                    <ul>
<li>
<a href="javascript:void(0)"  class="colorCol actColor"><img src="{{asset('assets/images/brown.jpg')}}" alt="..."></a>
</li>
<li>
<a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/blue.jpg')}}" alt="..."></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol">ELIE SAAB</h4>
                  <p>ELIE SAAB ES 087/S OGA</p>
                  <span class="priceCol">₹36000</span>
                  <div class="row gx-2">
                    <div class="col-auto">
                      <a href="javascript:void(0)" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                    </div>
                    <div class="col">
                      <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="btnCol text-center">
            <a href="javascript:void(0)" class="btn btnPrimary minWdBtn btnNew">Shop Now</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="productsCol section_space">
      <div class="container">
        <div class="bgLight">
          <div class="row gx-0 align-items-center">
            <div class="col-sm-6 order-lg-last">
              <div class="core_coll_img">
                <img src="{{asset('assets/images/male-product.jpg')}}" alt="Image Not Found">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="collection_col whiteBGColor core_coll_block_padding collection_col_right">
                <h2 class="darkColor">Male Sunglasses COre Collection</h2>
                  <div class="line"></div>
                  <div class="row text-end">
                    <div class="col">
                      <div class="core_coll_shop_btn">
                        <a href="javascript:void(0)" class="btn btnShop darkBGColor whiteColor whiteColor">SHOP</a>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div class="productColMain">
          <div class="row g-4">
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
                <span class="discountCol">20% off</span>
                <div class="productImg">
                  <div class="imgCol">
                    <img src="{{asset('assets/images/product-img-1.png')}}" alt="...">
                  </div>
                  <div class="color_builts">
                    <ul>
<li>
<a href="javascript:void(0)"  class="colorCol actColor"><img src="{{asset('assets/images/black.jpg')}}" alt="..."></a>
</li>
<li>
<a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/brown.jpg')}}" alt="..."></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol">HUGO BOSS</h4>
                  <p>HUGO BOSS HG 0328 086</p>
                  <span class="priceCol">₹8900 </span>
                  <div class="row gx-2">
                    <div class="col-auto">
                      <a href="javascript:void(0)" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                    </div>
                    <div class="col">
                      <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
                <div class="productImg">
                  <div class="imgCol">
                    <img src="{{asset('assets/images/product-img-2.png')}}" alt="...">
                  </div>
                  <div class="color_builts">
                    <ul>
<li>
<a href="javascript:void(0)"  class="colorCol actColor"><img src="{{asset('assets/images/black.jpg')}}" alt="..."></a>
</li>
<li>
<a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/brown.jpg')}}" alt="..."></a>
</li>
<li>
<a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/blue.jpg')}}" alt="..."></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol">TOMMY HILFIGER</h4>
                  <p>TOMMY HILFIGER TH 1689 086</p>
                  <span class="priceCol">₹9900 </span>
                  <div class="row gx-2">
                    <div class="col-auto">
                      <a href="javascript:void(0)" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                    </div>
                    <div class="col">
                      <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
                <span class="discountCol">20% off</span>
                <div class="productImg">
                  <div class="imgCol">
                    <img src="{{asset('assets/images/product-img-3.png')}}" alt="...">
                  </div>
                  <div class="color_builts">
                    <ul>
<li>
  <a href="javascript:void(0)" class="colorCol actColor"><img src="{{asset('assets/images/brown.jpg')}}" alt="..."></a>
</li>
<li>
  <a href="javascript:void(0)" class="colorCol"><img src="{{asset('assets/images/blue.jpg')}}" alt="..."></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol">TOMMY HILFIGER</h4>
                  <p>TOMMY HILFIGER TH 1689 086</p>
                  <span class="priceCol">₹9900 </span>
                  <div class="row gx-2">
                    <div class="col-auto">
                      <a href="javascript:void(0)" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                    </div>
                    <div class="col">
                      <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
                <span class="discountCol">20% off</span>
                <div class="productImg">
                  <div class="imgCol">
                    <img src="{{asset('assets/images/product-img-4.png')}}" alt="...">
                  </div>
                  <div class="color_builts">
                    <ul>
<li>
<a href="javascript:void(0)"  class="colorCol actColor"><img src="{{asset('assets/images/blue.jpg')}}" alt="..."></a>
</li>
<li>
<a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/brown.jpg')}}" alt="..."></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol">ELIE SAAB</h4>
                  <p>ELIE SAAB ES 061/G/S MVU</p>
                  <span class="priceCol">₹41800</span>
                  <div class="row gx-2">
                    <div class="col-auto">
                      <a href="javascript:void(0)" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                    </div>
                    <div class="col">
                      <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
                <div class="productImg">
                  <div class="imgCol">
                    <img src="{{asset('assets/images/product-img-5.png')}}" alt="...">
                  </div>
                  <div class="color_builts">
                    <ul>
<li>
<a href="javascript:void(0)"  class="colorCol actColor"><img src="{{asset('assets/images/brown.jpg')}}" alt="..."></a>
</li>
<li>
<a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/black.jpg')}}" alt="..."></a>
</li>
<li>
<a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/blue.jpg')}}" alt="..."></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol">JIMMY CHOO</h4>
                  <p>JIMMY CHOO VINA/G/SK J5G</p>
                  <span class="priceCol">₹19900</span>
                  <div class="row gx-2">
                    <div class="col-auto">
                      <a href="javascript:void(0)" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                    </div>
                    <div class="col">
                      <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
                <span class="discountCol">20% off</span>
                <div class="productImg">
                  <div class="imgCol">
                    <img src="{{asset('assets/images/product-img-6.png')}}" alt="...">
                  </div>
                  <div class="color_builts">
                    <ul>
<li>
<a href="javascript:void(0)"  class="colorCol actColor"><img src="{{asset('assets/images/brown.jpg')}}" alt="..."></a>
</li>
<li>
<a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/blue.jpg')}}" alt="..."></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol">ELIE SAAB</h4>
                  <p>ELIE SAAB ES 087/S OGA</p>
                  <span class="priceCol">₹36000</span>
                  <div class="row gx-2">
                    <div class="col-auto">
                      <a href="javascript:void(0)" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                    </div>
                    <div class="col">
                      <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="btnCol text-center">
            <a href="javascript:void(0)" class="btn btnPrimary minWdBtn btnNew">Shop Now</a>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section>
    <div class="image_grid_col image_grid_content overflow-hidden">
      <div class="row g-2">
        <div class="col-sm-6">
          <img src="{{asset('assets/images/img_grid.png')}}" alt="Image Not Found">
        </div>
        <div class="col-sm-6">
          <img src="{{asset('assets/images/img_grid2.png')}}" alt="Image Not Found">
        </div>
        <div class="col-sm-6">
          <img src="{{asset('assets/images/img_grid3.png')}}" alt="Image Not Found">
        </div>
        <div class="col-sm-6">
          <img src="{{asset('assets/images/img_grid4.png')}}" alt="Image Not Found">
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="productsCol section_space">
      <div class="container">
        <div class="bgLight">
          <div class="row gx-0 align-items-center">
            <div class="col-sm-6">
              <div class="core_coll_img">
                <img src="{{asset('assets/images/female_eye_glass.png')}}" alt="Image Not Found">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="collection_col whiteBGColor core_coll_block_padding">
                <h2 class="darkColor">Female Eyeglasses COre Collection</h2>
                  <div class="line"></div>
                  <div class="row text-end">
                    <div class="col">
                      <div class="core_coll_shop_btn">
                        <a class="btn btnShop darkBGColor whiteColor whiteColor" href="#">SHOP</a>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div class="productColMain">
          <div class="row g-4">
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
                <span class="discountCol">20% off</span>
                <div class="productImg">
                  <div class="imgCol">
                    <img src="{{asset('assetsimages/product-img-1.png')}}" alt="...">
                  </div>
                  <div class="color_builts">
                    <ul>
<li>
<a href="javascript:void(0)"  class="colorCol actColor"><img src="{{asset('assets/images/black.jpg')}}" alt="..."></a>
</li>
<li>
<a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/brown.jpg')}}" alt="..."></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol">HUGO BOSS</h4>
                  <p>HUGO BOSS HG 0328 086</p>
                  <span class="priceCol">₹8900 </span>
                  <div class="row gx-2">
                    <div class="col-auto">
                      <a href="javascript:void(0)" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                    </div>
                    <div class="col">
                      <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
                <div class="productImg">
                  <div class="imgCol">
                    <img src="{{asset('assets/images/product-img-2.png')}}" alt="...">
                  </div>
                  <div class="color_builts">
<ul>
<li>
<a href="javascript:void(0)"  class="colorCol actColor"><img src="{{asset('assets/images/black.jpg')}}" alt="..."></a>
</li>
<li>
<a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/brown.jpg')}}" alt="..."></a>
</li>
<li>
<a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/blue.jpg')}}" alt="..."></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol">TOMMY HILFIGER</h4>
                  <p>TOMMY HILFIGER TH 1689 086</p>
                  <span class="priceCol">₹9900 </span>
                  <div class="row gx-2">
                    <div class="col-auto">
                      <a href="javascript:void(0)" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                    </div>
                    <div class="col">
                      <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
                <span class="discountCol">20% off</span>
                <div class="productImg">
                  <div class="imgCol">
                    <img src="{{asset('assets/images/product-img-3.png')}}" alt="...">
                  </div>
                  <div class="color_builts">
                    <ul>
<li>
<a href="javascript:void(0)" class="colorCol actColor"><img src="{{asset('assets/images/brown.jpg')}}" alt="..."></a>
</li>
<li>
<a href="javascript:void(0)" class="colorCol"><img src="{{asset('assets/images/blue.jpg')}}" alt="..."></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol">TOMMY HILFIGER</h4>
                  <p>TOMMY HILFIGER TH 1689 086</p>
                  <span class="priceCol">₹9900 </span>
                  <div class="row gx-2">
                    <div class="col-auto">
                      <a href="javascript:void(0)" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                    </div>
                    <div class="col">
                      <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
                <span class="discountCol">20% off</span>
                <div class="productImg">
                  <div class="imgCol">
                    <img src="{{asset('assets/images/product-img-4.png')}}" alt="...">
                  </div>
                  <div class="color_builts">
<ul>
<li>
  <a href="javascript:void(0)"  class="colorCol actColor"><img src="{{asset('assets/images/blue.jpg')}}" alt="..."></a>
</li>
<li>
  <a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/brown.jpg')}}" alt="..."></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol">ELIE SAAB</h4>
                  <p>ELIE SAAB ES 061/G/S MVU</p>
                  <span class="priceCol">₹41800</span>
                  <div class="row gx-2">
                    <div class="col-auto">
                      <a href="javascript:void(0)" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                    </div>
                    <div class="col">
                      <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
                <div class="productImg">
                  <div class="imgCol">
                    <img src="{{asset('assets/images/product-img-5.png')}}" alt="...">
                  </div>
                  <div class="color_builts">
                    <ul>
<li>
<a href="javascript:void(0)"  class="colorCol actColor"><img src="{{asset('assets/images/brown.jpg')}}" alt="..."></a>
</li>
<li>
<a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/black.jpg')}}" alt="..."></a>
</li>
<li>
<a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/blue.jpg')}}" alt="..."></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol">JIMMY CHOO</h4>
                  <p>JIMMY CHOO VINA/G/SK J5G</p>
                  <span class="priceCol">₹19900</span>
                  <div class="row gx-2">
                    <div class="col-auto">
                      <a href="javascript:void(0)" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                    </div>
                    <div class="col">
                      <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
                <span class="discountCol">20% off</span>
                <div class="productImg">
                  <div class="imgCol">
                    <img src="{{asset('assets/images/product-img-6.png')}}" alt="...">
                  </div>
                  <div class="color_builts">
                    <ul>
  <li>
    <a href="javascript:void(0)"  class="colorCol actColor"><img src="{{asset('assets/images/brown.jpg')}}" alt="..."></a>
  </li>
  <li>
    <a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/blue.jpg')}}" alt="..."></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol">ELIE SAAB</h4>
                  <p>ELIE SAAB ES 087/S OGA</p>
                  <span class="priceCol">₹36000</span>
                  <div class="row gx-2">
                    <div class="col-auto">
                      <a href="javascript:void(0)" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                    </div>
                    <div class="col">
                      <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="btnCol text-center">
            <a href="javascript:void(0)" class="btn btnPrimary minWdBtn btnNew">Shop Now</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="productsCol section_space py-0">
      <div class="container">
        <div class="bgLight">
          <div class="row gx-0 align-items-center">
            <div class="col-sm-6 order-lg-last">
              <div class="core_coll_img">
                <img src="{{asset('assets/images/male-product1.jpg')}}" alt="Image Not Found">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="collection_col whiteBGColor core_coll_block_padding collection_col_right">
                <h2 class="darkColor">Male Eyeglasses COre Collection</h2>
                  <div class="line"></div>
                  <div class="row text-end">
                    <div class="col">
                      <div class="core_coll_shop_btn">
                        <a href="javascript:void(0)" class="btn btnShop darkBGColor whiteColor whiteColor">SHOP</a>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div class="productColMain">
          <div class="row g-4">
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
                <span class="discountCol">20% off</span>
                <div class="productImg">
                  <div class="imgCol">
                    <img src="{{asset('assets/images/product-img-1.png')}}" alt="...">
                  </div>
                  <div class="color_builts">
                    <ul>
<li>
  <a href="javascript:void(0)"  class="colorCol actColor"><img src="{{asset('assets/images/black.jpg')}}" alt="..."></a>
</li>
<li>
  <a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/brown.jpg')}}" alt="..."></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol">HUGO BOSS</h4>
                  <p>HUGO BOSS HG 0328 086</p>
                  <span class="priceCol">₹8900 </span>
                  <div class="row gx-2">
                    <div class="col-auto">
                      <a href="javascript:void(0)" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                    </div>
                    <div class="col">
                      <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
                <div class="productImg">
                  <div class="imgCol">
                    <img src="{{asset('assets/images/product-img-2.png')}}" alt="...">
                  </div>
                  <div class="color_builts">
                    <ul>
                      <li>
<a href="javascript:void(0)"  class="colorCol actColor"><img src="{{asset('assets/images/black.jpg')}}" alt="..."></a>
</li>
<li>
<a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/brown.jpg')}}" alt="..."></a>
</li>
<li>
<a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/blue.jpg')}}" alt="..."></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol">TOMMY HILFIGER</h4>
                  <p>TOMMY HILFIGER TH 1689 086</p>
                  <span class="priceCol">₹9900 </span>
                  <div class="row gx-2">
                    <div class="col-auto">
                      <a href="javascript:void(0)" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                    </div>
                    <div class="col">
                      <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
                <span class="discountCol">20% off</span>
                <div class="productImg">
                  <div class="imgCol">
                    <img src="{{asset('assets/images/product-img-3.png')}}" alt="...">
                  </div>
                  <div class="color_builts">
                    <ul>
<li>
  <a href="javascript:void(0)" class="colorCol actColor"><img src="{{asset('assets/images/brown.jpg')}}" alt="..."></a>
</li>
<li>
  <a href="javascript:void(0)" class="colorCol"><img src="{{asset('assets/images/blue.jpg')}}" alt="..."></a>
</li>
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol">TOMMY HILFIGER</h4>
                  <p>TOMMY HILFIGER TH 1689 086</p>
                  <span class="priceCol">₹9900 </span>
                  <div class="row gx-2">
                    <div class="col-auto">
                      <a href="javascript:void(0)" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                    </div>
                    <div class="col">
                      <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
                <span class="discountCol">20% off</span>
                <div class="productImg">
                  <div class="imgCol">
                    <img src="{{asset('assets/images/product-img-4.png')}}" alt="...">
                  </div>
                  <div class="color_builts">
  <ul>
    <li>
      <a href="javascript:void(0)"  class="colorCol actColor"><img src="{{asset('assets/images/blue.jpg')}}" alt="..."></a>
    </li>
    <li>
      <a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/brown.jpg')}}" alt="..."></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol">ELIE SAAB</h4>
                  <p>ELIE SAAB ES 061/G/S MVU</p>
                  <span class="priceCol">₹41800</span>
                  <div class="row gx-2">
                    <div class="col-auto">
                      <a href="javascript:void(0)" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                    </div>
                    <div class="col">
                      <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
                <div class="productImg">
                  <div class="imgCol">
                    <img src="{{asset('assets/images/product-img-5.png')}}" alt="...">
                  </div>
                  <div class="color_builts">
                    <ul>
    <li>
      <a href="javascript:void(0)"  class="colorCol actColor"><img src="{{asset('assets/images/brown.jpg')}}" alt="..."></a>
    </li>
    <li>
      <a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/black.jpg')}}" alt="..."></a>
    </li>
    <li>
      <a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/blue.jpg')}}" alt="..."></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol">JIMMY CHOO</h4>
                  <p>JIMMY CHOO VINA/G/SK J5G</p>
                  <span class="priceCol">₹19900</span>
                  <div class="row gx-2">
                    <div class="col-auto">
                      <a href="javascript:void(0)" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                    </div>
                    <div class="col">
                      <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
                <span class="discountCol">20% off</span>
                <div class="productImg">
                  <div class="imgCol">
                    <img src="{{asset('assets/images/product-img-6.png')}}" alt="...">
                  </div>
                  <div class="color_builts">
                    <ul>
          <li>
            <a href="javascript:void(0)"  class="colorCol actColor"><img src="{{asset('assets/images/brown.jpg')}}" alt="..."></a>
          </li>
          <li>
            <a href="javascript:void(0)"  class="colorCol"><img src="{{asset('assets/images/blue.jpg')}}" alt="..."></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol">ELIE SAAB</h4>
                  <p>ELIE SAAB ES 087/S OGA</p>
                  <span class="priceCol">₹36000</span>
                  <div class="row gx-2">
                    <div class="col-auto">
                      <a href="javascript:void(0)" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                    </div>
                    <div class="col">
                      <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="btnCol text-center">
            <a href="javascript:void(0)" class="btn btnPrimary minWdBtn btnNew">Shop Now</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- what about  -->

  @include('frontend.body.what_about')
  <!-- what about  -->

@endsection