<?php
$meta_title = $meta_description = $meta_keywords = "";
$meta_title = (!empty($product_data->category_meta_title)) ? $product_data->category_meta_title : "{$product_data->category_name} Meta Title";
$meta_description = (!empty($product_data->category_meta_description)) ? $product_data->category_meta_description : "{$product_data->category_name} Meta Description";
$meta_keywords = (!empty($product_data->category_meta_keywords)) ? $product_data->category_meta_keywords : "{$product_data->category_name} Meta Keywords";
?>

<?php $__env->startSection('title',$meta_title); ?>
<?php $__env->startSection('description',$meta_description); ?>
<?php $__env->startSection('keywords',$meta_keywords); ?>

<?php $__env->startSection('og'); ?>
<meta property="og:title" content="<?php echo e($product_data->category_name); ?>" />
<meta property="og:url" content="<?php echo e(url('/frame/'.$product_data->category_name.'.html')); ?>" />
<meta property="og:image" content="<?php echo e(asset('uploaded_files/product/'.$product_data->category_image_name)); ?>" />
<meta property="og:description" content="<?php echo e($product_data->category_short_description); ?>" />
<meta property="og:site_name" content="<?php echo e($admin_data->admin_company_name); ?>" />

<!--new -->
 <!--<link rel="stylesheet" href="css/smoothproducts.css">-->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.3/photoswipe.min.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.3/default-skin/default-skin.min.css'>
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <link rel="stylesheet" type=text/css href="https://luxuryeyewear.in/css/new/style.css">

<link rel="stylesheet" type=text/css href="<?php echo e(asset('css/productdetail/style.css')); ?>">
<!--slider css-->
<link rel="stylesheet" href="https://luxuryeyewear.in/css/new/style.css">


<!--slider css-->
<!--new -->

<style>

a.paypal_2--.btn.minWdBtn.text-uppercase {
    padding: 0;
    min-width: 200px !important;
    width: 221px;
}
.class_Btn_new {
    width: 96.5%;
}
.swiper_COl #thumb{
    padding-top:70px!important;
}

.paypal_2--.btn:hover{
    color:#000;
}
.pswp__ui--fit .pswp__caption, .pswp__ui--fit .pswp__top-bar {
    background-color: rgb(255 251 251 / 1%) !important;
    color:black;
}
button.pswp__button.pswp__button--close {
    background-color: #bbb3b3;
    /*border-radius:80%;*/
}
body .img_COL img {
	border: 1px solid rgba(0,0,0,0.5);
	padding: 2px;
}
.heading_COL p.msgText {
	font-size: 14px;
	margin: 0 0 10px;
}
.tommy_hilfiger_col {
	padding: 20px 20px 30px;
}
span.paypal_1 {
	font-size: inherit;
}
/*zoom*/
.slideImg {
	max-width: 80%;
}
.pswp__item{
 background-color:white!important;
}
/*zoom*/
#reviewcardStyle{
    padding:28px!important;
}
    /*#exzoom{*/
        /*position: absolute;*/
        /*top: 50%;*/
        /*left: 25%;*/
        /*transform: translate(-50%, -50%);*/
    /*    max-width: 450px;*/
    /*    display:block;*/
    /*    margin:auto;*/
    /*}*/
#newproduct_silder{ margin-top:7rem;}
.img_COL img { width: 50%;border-radius: 50%;border:5px solid;border-color:gray;border-style: double;}
#addCartBtn { min-width: 190px;margin-bottom: 1rem;}
#color_builts {padding: 8px 0 8px 0;}
#cardStylecol{ border: 1px solid #D2D2D2;padding: 0px 15px 20px 15px;position: relative;}
</style>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>




<!--####################################### new product slider start ########################################################  -->
<section>

  <div class="container" id="">
    <div class="row mt-5 pt-5 align-items-center">
        <!--############### slider start  #############  -->

       <div class="col-lg-6 mt-5">
        <div class="swiper_COl">
          <div class="swiper mySwiper2" itemscope itemtype="http://schema.org/ImageGallery">
            <ul class="swiper-wrapper my-gallery">
              <li id="1" class="swiper-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                <a id="first" title="click to zoom-in" href="<?php echo e(asset('uploaded_files/product/'.$product_data->category_image_name)); ?>" itemprop="contentUrl" data-size="2400x1200">
                  <img src="<?php echo e(asset('uploaded_files/product/'.$product_data->category_image_name)); ?>" class="slideImg">
                </a>
              </li>
              <?php if(!empty($product_data->category_image_name2)): ?>
              <li id="2" class="swiper-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                <a title="click to zoom-in" href="<?php echo e(asset('uploaded_files/product/'.$product_data->category_image_name2)); ?>"
                   itemprop="contentUrl" data-size="2400x1200">
                  <img src="<?php echo e(asset('uploaded_files/product/'.$product_data->category_image_name2)); ?>" itemprop="thumbnail" alt="Image description"  class="slideImg"/>
                </a>
              </li>
              <?php endif; ?>
              <?php if(!empty($product_data->category_image_name3)): ?>
              <li id="3" class="swiper-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                <a title="click to zoom-in" href="<?php echo e(asset('uploaded_files/product/'.$product_data->category_image_name3)); ?>"
                   itemprop="contentUrl" data-size="2400x1200">
                  <img src="<?php echo e(asset('uploaded_files/product/'.$product_data->category_image_name3)); ?>" itemprop="thumbnail" alt="Image description"  class="slideImg"/>
                </a>
              </li>
              <?php endif; ?>

              <?php if(!empty($product_data->category_image_name4)): ?>
                            <li id="3" class="swiper-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                <a title="click to zoom-in" href="<?php echo e(asset('uploaded_files/product/'.$product_data->category_image_name4)); ?>"
                   itemprop="contentUrl" data-size="2400x1200">
                  <img src="<?php echo e(asset('uploaded_files/product/'.$product_data->category_image_name4)); ?>" itemprop="thumbnail" alt="Image description"  class="slideImg"/>
                </a>
              </li>
              <?php endif; ?>

            <?php if(!empty($product_data->category_image_name5)): ?>
                          <li id="3" class="swiper-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                <a title="click to zoom-in" href="<?php echo e(asset('uploaded_files/product/'.$product_data->category_image_name5)); ?>"
                   itemprop="contentUrl" data-size="2400x1200">
                  <img src="<?php echo e(asset('uploaded_files/product/'.$product_data->category_image_name5)); ?>" itemprop="thumbnail" alt="Image description"  class="slideImg"/>
                </a>
              </li>
              <?php endif; ?>
            </ul>
            <div class="swiper-button-next" ></div>
            <div class="swiper-button-prev" style="color:#f07500 !important;"></div>
          </div>
          <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="pswp__bg"></div>
            <div class="pswp__scroll-wrap">
              <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
              </div>
              <div class="pswp__ui pswp__ui--hidden">
                <div class="pswp__top-bar">
                  <div class="pswp__counter"></div>
                  <button class="pswp__button pswp__button--close" title="Close (Esc)" style="font-size: 24px;
font-weight: bolder;"></button>
                  <!--<button class="pswp__button pswp__button--share" title="Share"></button>-->
                  <!--<button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>-->
                  <!--<button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>-->
                  <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                  <div class="pswp__share-tooltip"></div>
                </div>
                <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)" ></button>
                <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                <div class="pswp__caption">
                  <div class="pswp__caption__center"></div>
                </div>
              </div>
            </div>
          </div>
          <div thumbsSlider="" class="swiper mySwiper" id="thumb">
            <div class="swiper-wrapper ">
              <div class="swiper-slide">
                <img src="<?php echo e(asset('uploaded_files/product/'.$product_data->category_image_name)); ?>" />
              </div>
              <div class="swiper-slide">
                <img src="<?php echo e(asset('uploaded_files/product/'.$product_data->category_image_name2)); ?>" />
              </div>

<?php if(!empty($product_data->category_image_name3)): ?>
              <div class="swiper-slide">
                <img src="<?php echo e(asset('uploaded_files/product/'.$product_data->category_image_name3)); ?>" />
              </div>
<?php endif; ?>
<?php if(!empty($product_data->category_image_name4)): ?>
              <div class="swiper-slide">
                <img src="<?php echo e(asset('uploaded_files/product/'.$product_data->category_image_name4)); ?>" />
              </div>
<?php endif; ?>
<?php if(!empty($product_data->category_image_name5)): ?>
              <div class="swiper-slide">
                <img src="<?php echo e(asset('uploaded_files/product/'.$product_data->category_image_name5)); ?>" />
              </div>
<?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    <!--############### slider end   #############  -->
      <!--right part start-->
<?php
$b_name = DB::table('categories')->where('id',$product_data->category_parent_id)->select('category_name','category_slug_name')->first();
?>
      <div class="col-lg-6 mt-5">
        <div class="tommy_hilfiger_col">
          <div class="heading_COL">
            <div class="row align-items-center">
              <div class="col-auto">
                  <span class="text-secondary">Brand:</span>
                  <a style="text-decoration:none !important;" class="text-dark" href="<?php echo e(url('/brand/'.$b_name->category_slug_name.'.html')); ?>"><small><?php echo e($b_name->category_name); ?></small></a>
                <h2 class="cat_1"><?php echo e($product_data->category_name); ?></h2>
              </div>

            </div>
            <!-- #################################################### form end #################################################### -->
<form action="<?php echo e(url('/add-to-cart')); ?>" method="post">
 <?php echo csrf_field(); ?>
 <?php echo method_field('POST'); ?>
            <!--uan-->
            <h3 class="uan_no"><?php echo e($product_data->category_uan_code); ?></h3>
            <!--uan-->
            <!--<p>Spotted Transparent/grey Black Shaded (3314/8G) </p>-->
            <div class="row align-items-center">
              <div class="col-auto">
         <!--hidden          -->
<input type="hidden" name="product_id" class="product_id" value="<?php echo e($product_data->id); ?>"/>
<input value="1" type="hidden" class="prd_qty" name="qty">
<!--hidden-->
                <span class="color_dollor pb-5">

                    <?php echo e(getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product_data->category_discount_price)); ?>

<?php if($product_data->category_is_discount=="Yes"): ?>
<strike id="mrp"><?php echo e(getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product_data->category_price)); ?></strike>
<?php endif; ?>
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
                <?php
                $group_ids = explode(',',$product_data->category_group_ids);
                $group_prd = DB::table('categories')->whereIn('id',$group_ids)->where('category_status','Active')->get();
                $i=1;
                ?>
                <?php if(!empty($product_data->category_group_ids)): ?>
              <!--===================================for color=============== -->
              <div class="col-auto">
                <div class="img_COL">
                    <!--foreach-->
                <?php $__currentLoopData = $group_prd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $color_data = DB::table('product_colors')->where('id',$group->category_color)->first();
                ?>
                <!--foreach-->
                <a href="<?php echo e(url('/frame/'.$group->category_slug_name.'.html')); ?>" >
                <img class="pro-i "  src="<?php echo e(asset('uploaded_files/color_image/'.$color_data->color_image_name)); ?>">
                </a>
                    <?php
                    $i++;
                    ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
              </div>
                  <!--===================================for color=============== -->
              <?php endif; ?>
            </div>
            <!--Size-->
            <div class="row align-items-center mt-2 space_1">
              <div class="col-auto">
                <span class="same_col_size">Size</span>
              </div>
              <div class="col-auto">
                <span class="same_col_size1" style="font-size:15px;"><?php echo e(str_replace("mm","",$product_data->category_lens_width)); ?>-<?php echo e(str_replace("mm","",$product_data->category_bridge)); ?>-<?php echo e(str_replace("mm","",$product_data->category_arm_length)); ?>-<?php echo e(str_replace("mm","",$product_data->category_lens_height)); ?>-<?php echo e(str_replace("mm","",$product_data->category_total_width)); ?></span>
              </div>
            </div>
            <!--Size-->
     <div class="row g-3 align-items-center">
              <div class="col-sm-auto col-12">
                <div class="class_Btn">
                  <button href="#" class="btn1-- btn minWdBtn btnDark text-uppercase">add to cart</button>
                </div>
              </div>
              <div class="col">
                  <!--class_Btn-->
<?php if($product_data->available_with_lens=="Yes"): ?>
 <?php if($product_data->category_qty>0): ?>

                <div class="class_Btn_new ">
                  <button type="button" class="btn w-100 btnDark text-uppercase" onclick="addLensCart('<?php echo e($product_data->id); ?>')"> Buy with PRESCRIPTION  Lens</button>
                </div>
                <?php else: ?>
                 <div class="class_Btn_new show_line">
                  <button type="button" class="btn w-100 btnDark text-uppercase"  disabled style="cursor:no-drop !important;background-color:#bdbdbd !important;"> Buy with PRESCRIPTION  Lens</button>
                </div>
                <?php endif; ?>
                <?php else: ?>
                  <div class="class_Btn_new show_line">
                  <button type="button" class="btn w-100 btnDark text-uppercase"  disabled style="cursor:no-drop !important;background-color:#bdbdbd !important; "> Buy with PRESCRIPTION  Lens</button>
                </div>
                <!--class_Btn-->

              </div>
               <div class="col-12">



                <div >
                 <p class="text-danger font-weight-bold msgText " ><?php echo e($admin_data->available_with_lens_desc); ?></p>
                 </div>
               </div>
                <?php endif; ?>
            </div>

          </form>

<!-- #################################################### form end #################################################### -->
            <div class="row g-3 align-items-center">
              <div class="col-auto">
                <div class="class_Btn" >
                  <a href="<?php echo e(url('/cart.html')); ?>" class=" paypal_2-- btn minWdBtn text-uppercase"  ><span class="paypal_1 "><img src="<?php echo e(asset('css/productdetail/images/paywith.png')); ?>" border="2"> </span>

                  </a>

                </div>
              </div>
              <div class="col">
                <div class="class_Btn_new2" style=" padding-top:0px!important; ">
                  <a href="#" class="add_to_wishlist-- btn w-100 btnDark_outline text-uppercase ">Add to Wishlist</a>

                </div>
              </div>


            </div>
          </div>
        </div>
              <div class="modal_social">
    <h2>Share this product</h2>
<div class="sharethis-inline-share-buttons"></div>
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
                <div class="cardStyle1_1" id="reviewcardStyle_1">

            <!------------------------->
            <div class="reviews">
    <div class="review-item">
        <div class='row g-0'>
          <div class="col-md-auto order-md-last">
            <span class="logo_img">
                <img src="<?php echo e(asset('css/productdetail/images/logo.jpg')); ?>" alt="..." class="img_class  img-fluid">
            </span>
          </div>
            <div class="col-md">
              <div class="proDetailCol">
                <h4 class="frame_img-- detailTitle">Frame Measurement</h4>
                <!--if lense avilable size chart button will show -->

                <!--if lense avilable size chart button will show -->
                <!--SizeChart start -->

                <div  class="w3-container city" >
                  <div class="row lense_imgs" style="margin-top:30px;">
                    <?php if(!empty($product_data->category_lens_width)): ?>

                    <div class="col-6 col-sm-3 col-lg-2">
                      <img src="<?php echo e(asset('img/sizechart01.png')); ?>" alt="">
                      <h6 style="text-align:center">LENS WIDTH<br>
                        <?php echo e($product_data->category_lens_width); ?></h6>
                      </div>
                      <?php endif; ?>

                      <?php if(!empty($product_data->category_bridge)): ?>

                      <div class="col-6 col-sm-3 col-lg-2">
                        <img src="<?php echo e(asset('img/sizechart02.png')); ?>" alt="">
                        <h6 style="text-align:center">BRIDGE WIDTH<br>
                          <?php echo e($product_data->category_bridge); ?></h6>
                        </div>

                        <?php endif; ?>
                        <?php if(!empty($product_data->category_arm_length)): ?>

                        <div class="col-6 col-sm-3 col-lg-2">
                          <img src="<?php echo e(asset('img/sizechart03.png')); ?>" alt="">
                          <h6 style="text-align:center">TEMPLE LENGTH<br>
                            <?php echo e($product_data->category_arm_length); ?></h6>
                          </div>


                          <?php endif; ?>
                          <?php if(!empty($product_data->category_lens_height)): ?>
                          <div class="col-6 col-sm-3 col-lg-2">
                            <img src="<?php echo e(asset('img/sizechart04.png')); ?>" alt="">
                            <h6 style="text-align:center;">LENS HEIGHT<br>
                              <?php echo e($product_data->category_lens_height); ?></h6>
                            </div>


                            <?php endif; ?>
                            <?php if(!empty($product_data->category_total_width)): ?>
                            <div class="col-6 col-sm-3 col-lg-2">
                              <img src="<?php echo e(asset('img/sizechart05.png')); ?>" alt="">
                              <h6 style="text-align:center;">TOTAL WIDTH<br>
                                <?php echo e($product_data->category_total_width); ?></h6>
                              </div>
                              <?php endif; ?>


                            </div>

                          </div>


              </div>


<!--SizeChart end -->


            </div>

        </div>
        <div class="proDetailCol">
          <h4 class="detail_1-- detailTitle">Product Detail</h4>
          <div class="product_detail-- pt-2">
            <div class="row product_row ">
              <div class="col-md-4"> <!--col md 4 start -->
                <ul class="detailList">
                  <li > <b>Frmae Type :</b>  <?php echo e($product_data->type); ?></li>
                  <li >  <b>Type :</b> <?php echo e($product_data->category_frame); ?></li>
                  <li >  <b>Gender :</b> <?php echo e($product_data->category_for); ?></li>

                  <?php if(!empty($product_data->lens_type)): ?>
                  <li><b>Lens Type : </b>
                    <ul>
                      <?php $__currentLoopData = $lens_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li><?php echo e($data->lens_type); ?></li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                  </li>
                  <?php endif; ?>


                </ul>
              </div>
              <!--col md 4 end -->
              <div class="col-md-4">
                <!--col md 4 start -->
                <ul class="detailList">
                  <li> <b>Frmae Shape :</b> <?php echo e($product_data->shape); ?></li>
                  <li>  <b>EAN Code :</b> <?php echo e($product_data->category_sku_code); ?></li>
                  <?php if(!empty($product_data->extra)): ?>
                  <li><b>Extra : </b>
                    <ul>
                      <?php $__currentLoopData = $extras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li><?php echo e($data->extra); ?></li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                  </li>
                  <?php endif; ?>
                </ul>
              </div>
              <!--col md 4 end -->
              <div class="col-md-4">
                <!--col md 4 start -->
                <ul class="detailList">
                  <li>  <b>Material :</b>  <?php echo e($product_data->material); ?> </li>
                  <li>  <b>Warranty :</b> <?php echo e($main_cat->category_warranty); ?></li>
                </ul>
              </div>
            </div>
            <!--col md 4 end -->
          </div>

        </div>


        <!--end ul row -->
        <!--category_description start -->
             <?php if(!empty($product_data->category_description)): ?>
        <div class="proDetailCol">
          <div class="pro_descri--">

            <h4 class="pro_descri-- detailTitle">Product Description</h4>

            <span class="pro_descri">
              <p class="pro_descri"><?php echo $product_data->category_description; ?></p>
            </span>

            <!--category_description end-->
          </div>
        </div>
        <?php endif; ?>

    </div>
</div>
<!---------------------->

                </div>


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
            <?php if($related_products->isNotEmpty()): ?>
          <div class="productColMain">
            <div class="row g-3">

                <?php $__currentLoopData = $related_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $brand = DB::table('categories')->where('id',$product->category_parent_id)->first();
                ?>
              <!-- card start -->
    <div class="col-md-6 col-xl-3">
                <div class="cardStyle1" id="cardStylecol">
                    <?php if($product->category_sale_off=="Yes"): ?>
                  <span class="discountCol">20% off</span>
                  <?php endif; ?>
                  <div class="productImg">
                    <div class="imgCol">
                            <?php if(!empty($product->category_image_name)): ?>
                            <a href="<?php echo e(url('/frame/'.$product->category_slug_name.'.html')); ?>">
                                  <img src="<?php echo e(asset('uploaded_files/product/'.$product->category_image_name)); ?>"></a>
                            <?php else: ?>
                            <a href="<?php echo e(url('/frame/'.$product->category_slug_name.'.html')); ?>">
                            <img class="img-responsive" src="<?php echo e(asset('admin_assets/images/no_image.jpg')); ?>" alt=""> </a>
                            <?php endif; ?>
                    </div>
                    <!--display none-->
                    <div class="back d-none" >

                <?php if(!empty($product->category_image_name2)): ?>
                <a href="<?php echo e(url('/frame/'.$product->category_slug_name.'.html')); ?>">
                <img src="<?php echo e(asset('uploaded_files/product/'.$product->category_image_name2)); ?>"></a>
                <?php else: ?>
                <a href="<?php echo e(url('/frame/'.$product->category_slug_name.'.html')); ?>">
                <img class="img-responsive" src="<?php echo e(asset('admin_assets/images/no_image.jpg')); ?>" alt=""> </a>
                <?php endif; ?>
                </div>
                    <!--display none-->
                    <div class="color_builts" id="color_builts">
                        <!-------------------------------- color start -------------------------------->
                        <?php
                        $get_current_color = DB::table('product_colors')->where('id',$product->category_color)->first();
                        ?>
                      <ul>
                            <?php
                            $group_ids = explode(',',$product->category_group_ids);
                            $group_prd = DB::table('categories')->whereIn('id',$group_ids)->where('category_status','Active')->get();
                            $i=1;
                            ?>
                            <?php if(!empty($product->category_group_ids)): ?>

                            <?php $__currentLoopData = $group_prd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $color_data = DB::table('product_colors')->where('id',$group->category_color)->first();
                            ?>


                        <li>
                          <a href="<?php echo e(url('/frame/'.$group->category_slug_name.'.html')); ?>"  class="colorCol actColor btn-tool <?php if($group->category_slug_name==$product->category_slug_name): ?> color-btn <?php endif; ?>">

                              <img src="<?php echo e(asset('uploaded_files/color_image/'.$color_data->color_image_name)); ?>" alt="..."></a>
                        </li>
                    <?php
                    $i++;
                    ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>


                        <li>
                          <a href="<?php echo e(url('/frame/'.$product->category_slug_name.'.html')); ?>"  class="colorCol">
                              <img src="<?php echo e(asset('uploaded_files/color_image/'.$get_current_color->color_image_name)); ?>" alt="..."></a>
                        </li>
                        <?php endif; ?>
                      </ul>
                    </div>
                    <!--color end -->
                  </div>
                  <div class="contentCol">
                      <!--brand name -->
                    <h4 class="brandCol"><?php echo e($brand->category_name); ?></h4>
                    <!--brand name -->
                    <p><a href="<?php echo e(url('/frame/'.$product->category_slug_name.'.html')); ?>" class="title">
                            <?php echo e(Str::limit($product->category_name,30,$end='...')); ?></a></p>
                    <!--price -->
                    <span class="priceCol">
                        <?php echo e(getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product->category_discount_price)); ?>

                        <?php if($product->category_is_discount=="Yes"): ?>
                            <strike id="mrp"><?php echo e(getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product->category_price)); ?></strike>
                            <?php endif; ?>
                        </span>
                    <!--price -->
                    <div class="row gx-2 proBtnCol">
                      <div class="col col-sm-auto">
                        <a href="<?php echo e(url('/frame/'.$product['category_slug_name'].'.html')); ?>" class="btn btnDark w-100 " id="addCartBtn">ADD TO CART</a>
                      </div>
                       &nbsp;
                      <div class="col">
                        <a href="javascript:void(0)" class="btn btnDark_outline w-100 add_to_wishlist">ADD TO WISHLIST</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- card end -->
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
            <div class="btnCol text-center">
              <!--<a href="javascript:void(0)" class="btn btnPrimary minWdBtn btnNew">Load More</a>-->
            </div>
          </div>
          <?php endif; ?>
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

  <script src='https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.3/photoswipe.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/photoswipe/4.1.3/photoswipe-ui-default.min.js'></script>
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

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
    // var swiper = new Swiper(".mySwiper", {

    //   loop: true,
    //   spaceBetween: 10,
    //   slidesPerView: 3,
    //   freeMode: true,
    //   watchSlidesProgress: true,
    // });
    // var swiper2 = new Swiper(".mySwiper2", {
    //   loop: true,
    //   spaceBetween: 10,
    //   navigation: {
    //     nextEl: ".swiper-button-next",
    //     prevEl: ".swiper-button-prev",
    //   },
    //   thumbs: {
    //     swiper: swiper,
    //   },
    // });
$(document).ready(function(){
$(".msgText").hide();
  $(".show_line").click(function(){
    $(".msgText").fadeToggle("slow");

  });
});
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 <script src="<?php echo e(asset('css/productdetail/script.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/product-detail.blade.php ENDPATH**/ ?>