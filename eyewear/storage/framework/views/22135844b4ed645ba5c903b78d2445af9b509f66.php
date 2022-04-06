
<?php
 $meta_title = $meta_description = $meta_keywords = "";
 $meta_title = (!empty($meta_tag->page_meta_title)) ? $meta_tag->page_meta_title : "Eyewear Brands";
 $meta_description = (!empty($meta_tag->page_meta_description)) ? $meta_tag->page_meta_description : "Eyewear Brands Meta Description";
 $meta_keywords = (!empty($meta_tag->page_meta_keywords)) ? $meta_tag->page_meta_keywords : "Eyewear Brands Meta Keywords";
?>
 <?php $__env->startSection('title',$meta_title); ?>
 <?php $__env->startSection('description',$meta_description); ?>
 <?php $__env->startSection('keywords',$meta_keywords); ?>
 <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('/'.$admin_data->admin_favicon)); ?>">
 
<?php $__env->startSection('content'); ?>
 
 
<section>
    <div class="brand_banner">
      <div class="container">
        <div class="brand_banner_content">
          <div class="brand_banner_content_text text-center">
            <h1 class="brand_bannner_head">Eyewear Brands</h1>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumbStyle justify-content-center">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home.page')); ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Brands</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="brand_logo_section pb-0">
      <div class="container">
    <b>  Total Brand:<span class=""><?php echo e(count($brand_img)); ?></span></b>

        <div class="brand_logo_list">
          <div class="row row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 g-2 justify-content-center">
              <?php $__currentLoopData = $brand_img; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              
            <div class="col">
              <div class="brand_logo_link">
                <a href="<?php echo e($brand->url); ?>" class="blankLink" target="_blank">
                <img src="<?php echo e(asset($brand->image)); ?>" alt="..."></a>
              </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          </div>
        </div>
      </div>
    </div>
  </section>  
        <div class="btnCol text-center">
              <a href="" class=""></a>
            </div>
 
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/brands_page_new.blade.php ENDPATH**/ ?>