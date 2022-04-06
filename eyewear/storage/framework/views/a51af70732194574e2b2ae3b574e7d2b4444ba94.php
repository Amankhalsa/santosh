


<?php
 $meta_title = $meta_description = $meta_keywords = "";
 $meta_title = (!empty($meta_tag->page_meta_title)) ? $meta_tag->page_meta_title : "Privacy Policy Meta Title";
 $meta_description = (!empty($meta_tag->page_meta_description)) ? $meta_tag->page_meta_description : "Privacy Policy Meta Description";
 $meta_keywords = (!empty($meta_tag->page_meta_keywords)) ? $meta_tag->page_meta_keywords : "Privacy Policy Meta Keywords";
?>

 <?php $__env->startSection('title',$meta_title); ?>
 <?php $__env->startSection('description',$meta_description); ?>
 <?php $__env->startSection('keywords',$meta_keywords); ?>

 

 <?php $__env->startSection('content'); ?>
<div class="sun-breadcrumb-01 pt-5">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="breadcrumb-01">

<ul>
<li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home"></i></a></li>
<li><a href=""><?php echo e($meta_tag->page_name); ?></a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="privacy-page pt-5">
  <div class="container">
    <div class="row">
     
     <div class="col-lg-12 text-justify">
         <h3  class="text-center"><?php echo e($meta_tag->page_name); ?></h3>
         <?php echo $meta_tag->page_content; ?>

     </div>

    </div>  
  </div>
    </div>
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/privacy-policy.blade.php ENDPATH**/ ?>