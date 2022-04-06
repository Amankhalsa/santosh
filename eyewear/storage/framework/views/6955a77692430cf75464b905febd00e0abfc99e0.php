
<?php
 $meta_title = $meta_description = $meta_keywords = "";
 $meta_title = (!empty($meta_tag->page_meta_title)) ? $meta_tag->page_meta_title : "Sunglasses";
 $meta_description = (!empty($meta_tag->page_meta_description)) ? $meta_tag->page_meta_description : "Sunglasses Meta Description";
 $meta_keywords = (!empty($meta_tag->page_meta_keywords)) ? $meta_tag->page_meta_keywords : "Sunglasses Meta Keywords";
?>
 <?php $__env->startSection('title',$meta_title); ?>
 <?php $__env->startSection('description',$meta_description); ?>
 <?php $__env->startSection('keywords',$meta_keywords); ?>
 <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('/'.$admin_data->admin_favicon)); ?>">
 
<?php $__env->startSection('content'); ?>
 
 <!--sunglass-->

<section>
    <div class="brand_banner">
      <div class="container">
        <div class="brand_banner_content">
          <div class="brand_banner_content_text text-center">
            <h1 class="brand_bannner_head">Sunglasses</h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumbStyle justify-content-center">
                <li class="breadcrumb-item"><a href="<?php echo e(url('/')); ?>">Home</a></li>
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
  <span class="lineTitle">    Total:  <?php echo e(count($sunglasses)); ?></span><br>
              <h6 class="lineTitle">Explore Our Products</h6>

            </div>
            <h2 class="product_detail_head lgTitle darkColor">Most Loved Frames</h2>
          </div>
          <div class="filterColMain pt-3">
            <div class="filterCol">
              <div class="row g-2 g-md-3">
                <div class="col"><a  class="btn btnDark w-100 filterBtn"  
                data-bs-toggle="offcanvas" href="#filterCanvas" role="button" aria-controls="filterCanvas">
                <span class="filterIcon"><img src="<?php echo e(asset('uploaded_files/assets/images/filter-icon.svg')); ?>" alt="..."></span> <span>Filter</span></a></div>
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
          <!--========================= productColMain=======================-->
      <?php if($sunglasses->isNotEmpty()): ?>
<div class="productColMain">
          <div class="row g-4">
              <!--col-md-6 col-xl-4-->
<?php $__currentLoopData = $sunglasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
$brand = DB::table('categories')->where('id',$product->category_parent_id)->first();
?>
              
            <div class="col-md-6 col-xl-4">
              <div class="cardStyle1">
<?php if($product['category_is_discount']=="Yes"): ?>  
<span class="discountCol"> <?php echo e($product['category_discount']); ?>% </span>
<?php endif; ?>
             
                <div class="productImg">
                    <a href="<?php echo e(url('/frame/'.$product['category_slug_name'].'.html')); ?>" target="_blank">
                  <div class="imgCol">
<?php if(!empty($product->category_image_name)): ?> 
                    <img src="<?php echo e(asset('uploaded_files/product/'.$product->category_image_name)); ?>" alt="product-img-1">
<?php else: ?>
<img  src="<?php echo e(asset('admin_assets/images/no_image.jpg')); ?>" alt="...." >
<?php endif; ?>
</div>
</a>
<?php
$get_current_color = DB::table('product_colors')->where('id',$product->category_color)->first(); 
?>

                  <div class="color_builts">
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
    <img src="    <?php echo e(asset('uploaded_files/color_image/'.$get_current_color->color_image_name)); ?>" alt="..."></a>

                      </li>
<?php endif; ?>
                    </ul>
                  </div>
                </div>
                <div class="contentCol">
                  <h4 class="brandCol"><?php echo e($brand->category_name); ?></h4>
                  
                   <a href="<?php echo e(url('/frame/'.$product['category_slug_name'].'.html')); ?>" style="text-decoration:none; color:black;">
                    <p><?php echo e(Str::limit($product->category_name,25,$end='...')); ?> </p>
                        </a>
                        <!--PRICE-->
                <span class="priceCol">
                    <?php echo e(getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product->category_discount_price)); ?> </span>
                                             <span>
<?php if($product->category_is_discount=="Yes"): ?>
<strike id="mrp"><?php echo e(getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product->category_price)); ?></strike>
<?php endif; ?>
                             </span>

                     <div class="row gx-2">
                      <div class="col-auto">
         <!--add to cart  -->

<!--add to cart  -->
       <a href="<?php echo e(url('/frame/'.$product['category_slug_name'].'.html')); ?>" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                      </div>
                      <div class="col">
                
                         
<form action="<?php echo e(url('/add-wishlist')); ?>" method="post">
                             <?php echo csrf_field(); ?>
                             <?php echo method_field('POST'); ?>
                            <input type="hidden" name="product_id" class="product_id" value="<?php echo e($product->id); ?>"/>
                            <input type="hidden" value="1" name="qty" />
                            <a   class="btn btnDark_outline w-100 add_to_wishlist" >
                            ADD TO WISHLIST</a>
                        </form>    
    

                      </div>
                    </div>
                    
                    <div class="row gx-2">
                        <span class="wish_list_mssg"></span>
                    </div>
                </div>
              </div>
            </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <!--col-md-6 col-xl-4 END-->
        
          </div>
          <!-------------blank space div ---------------->
        <div class="btnCol text-center">
              <a href="" class=""></a>
            </div>
          <!-------------blank space div ---------------->
        </div>
        <!--        <div class="auto-load text-center">-->
        <!--    <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"-->
        <!--        x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">-->
        <!--        <path fill="#000"-->
        <!--            d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">-->
        <!--            <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"-->
        <!--                from="0 50 50" to="360 50 50" repeatCount="indefinite" />-->
        <!--        </path>-->
        <!--    </svg>-->
        <!--</div>-->
       <?php endif; ?>

          <!--======================== productColMain =========================-->
        </div>
        </div>
      </div>
    </div>
  </section>
  <!--filter_side_bar  -->
  <?php echo $__env->make('filter_side_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <!--filter_side_bar -->

 <?php $__env->stopSection(); ?>
 
   <script src=https://luxuryeyewear.in/js/jquery-3.5.1.min.js></script>
  <script>
 
        var ENDPOINT = "<?php echo e(url('sunglasses')); ?>";
        var page = 0;
        var response_load = true;
     
       //infinteLoadMore(page);
        //  $(window).scroll(function () {
        //  if ($(window).scrollTop() + $(window).height() >= $('.auto-load').height()) {
        //     if(response_load)
        //     {
        //         response_load = false;
            
        //      var page = $(".cardStyle1").length;
        //     infinteLoadMore(page);
        //     }
                
        //     }
        //  });
        
        // function infinteLoadMore(page) {
             
        //     $.ajax({
        //             url: ENDPOINT + "?page=" + page,
        //             datatype: "html",
        //             type: "get",
        //             beforeSend: function () {
        //                 $('.auto-load').show();
        //             }
        //         })
        //         .done(function (response) {
        //             response_load = true;
        //             if (response.length == 0) {
        //                 $('.auto-load').html("We don't have more data to display :(");
        //                 return;
        //             }
        //             $('.auto-load').hide();
        //             $(".productColMain").append(response);
        //         })
        //         .fail(function (jqXHR, ajaxOptions, thrownError) {
        //             console.log('Server error occured');
        //         });
        // }
    </script>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/sun_glasses_new.blade.php ENDPATH**/ ?>