

@if($sliders->isNotEmpty())    
<section>
    <div class="bannerCol">
      <div class="container-fluid p-0">
        <div class="bannerSlider">
          <div class="swiper bannerSlider swiperStyle">
            <div class="swiper-wrapper">
                    @foreach( $sliders as $key => $slider)  
              <div class="swiper-slide {{ $key ==0 ? 'active' :'' }}">
                <div class="swiper_bg_img" style="background-image:url('{{asset('slider/'.$slider->slider_image_name)}}');">
                  <div class="container">
                    <div class="bannerImgCnt">
                      <a href="javascript:void(0)"><img src="{{asset('uploaded_files/assets/images/banner-content.png')}}" 
                      alt="..." class="saleImg"></a>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
    
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endif