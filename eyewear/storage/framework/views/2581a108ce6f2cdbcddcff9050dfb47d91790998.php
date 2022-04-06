<?php
$get_brands = DB::table('newbrands')->where('status','Active')->orderBy('name')->get();
?>
  <section>
    <div class="brand_logo_section">
      <div class="container">
        <div class="brand_swiper_img">
          <div class="swiper logoSwiper">
<div class="swiper-wrapper">

<?php $__currentLoopData = $get_brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="swiper-slide">
      <a href="<?php echo e(asset($value->url)); ?>">
      <img src="<?php echo e(asset($value->image)); ?>" alt="Image Not Found"></a>
      </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php echo $__env->make('frontend.female_sunglasses_core', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!--end female core collection -->
<!--#############################################################################-->
                            <!--START sunglasses-->      
                    <?php echo $__env->make('frontend.sunglass', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
                <img src="<?php echo e(asset('uploaded_files/assets/images/webp/male-product.webp')); ?>" alt="Image Not Found">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="collection_col whiteBGColor core_coll_block_padding collection_col_right">
                <h2 class="darkColor">Male Sunglasses COre Collection</h2>
                  <div class="line"></div>
                  <div class="row text-end">
                    <div class="col">
                      <div class="core_coll_shop_btn">
                        <a href="<?php echo e(url('/sunglasses/men')); ?>" target="_blank" class="btn btnShop darkBGColor whiteColor whiteColor">SHOP</a>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ======================= -->
<!--################################## Eyeglasses #####################################-->    

                        <?php echo $__env->make('frontend.male_sunglass', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
          <img src="<?php echo e(asset('uploaded_files/assets/images/webp/img_grid.webp')); ?>" alt="Image Not Found">
        </div>
        <div class="col-sm-6">
          <img src="<?php echo e(asset('uploaded_files/assets/images/webp/img_grid2.webp')); ?>" alt="Image Not Found">
        </div>
        <div class="col-sm-6">
          <img src="<?php echo e(asset('uploaded_files/assets//images/webp/img_grid3.webp')); ?>" alt="Image Not Found">
        </div>
        <div class="col-sm-6">
          <img src="<?php echo e(asset('uploaded_files/assets/images/webp/img_grid4.webp')); ?>" alt="Image Not Found">
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
                <img src="<?php echo e(asset('uploaded_files/assets/images/webp/female_eye_glass.webp')); ?>" alt="Image Not Found">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="collection_col whiteBGColor core_coll_block_padding">
                <h2 class="darkColor">Female Eyeglasses COre Collection</h2>
                  <div class="line"></div>
                  <div class="row text-end">
                    <div class="col">
                      <div class="core_coll_shop_btn">
                        <a class="btn btnShop darkBGColor whiteColor whiteColor" target="_blank" href="<?php echo e(url('/eyeglasses/women')); ?>">SHOP</a>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <!-- =========== productColMain ============ -->
<!--################################## Eyeglasses #####################################-->

                        <?php echo $__env->make('frontend.eyeglass', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
                <img src="<?php echo e(asset('uploaded_files/assets/images/webp/male-product1.webp')); ?>" alt="Image Not Found">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="collection_col whiteBGColor core_coll_block_padding collection_col_right">
                <h2 class="darkColor">Male Eyeglasses COre Collection</h2>
                  <div class="line"></div>
                  <div class="row text-end">
                    <div class="col">
                      <div class="core_coll_shop_btn">
                        <a href="<?php echo e(url('/eyeglasses/men')); ?>" target="_blank" class="btn btnShop darkBGColor whiteColor whiteColor">SHOP</a>
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
                        <?php echo $__env->make('frontend.male_eyeglass', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <!--END sunglasses-->      
<!--#############################################################################-->
        <!--============== productColMain ==============-->
      </div>
    </div>
  </section>
<?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/frontend/new_index.blade.php ENDPATH**/ ?>