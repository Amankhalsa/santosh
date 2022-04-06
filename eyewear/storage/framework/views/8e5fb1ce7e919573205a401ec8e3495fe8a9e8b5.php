

<?php if($sliders->isNotEmpty()): ?>    
<section>
    <div class="bannerCol">
      <div class="container-fluid p-0">
        <div class="bannerSlider">
          <div class="swiper bannerSlider swiperStyle">
            <div class="swiper-wrapper">
                    <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
              <div class="swiper-slide <?php echo e($key ==0 ? 'active' :''); ?>">
                <div class="swiper_bg_img" style="background-image:url('<?php echo e(asset('slider/'.$slider->slider_image_name)); ?>');">
                  <div class="container">
                    <div class="bannerImgCnt">
                      <a href="javascript:void(0)"><img src="<?php echo e(asset('uploaded_files/assets/images/banner-content.png')); ?>" 
                      alt="..." class="saleImg"></a>
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php endif; ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/new-slider.blade.php ENDPATH**/ ?>