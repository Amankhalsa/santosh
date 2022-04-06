<?php
 $meta_title = $meta_description = $meta_keywords = "";
 $meta_title = (!empty($meta_tag->page_meta_title)) ? $meta_tag->page_meta_title : "Faq Meta Title";
 $meta_description = (!empty($meta_tag->page_meta_description)) ? $meta_tag->page_meta_description : "Faq Meta Description";
 $meta_keywords = (!empty($meta_tag->page_meta_keywords)) ? $meta_tag->page_meta_keywords : "Faq Meta Keywords";
?>

 <?php $__env->startSection('title',$meta_title); ?>
 <?php $__env->startSection('description',$meta_description); ?>
 <?php $__env->startSection('keywords',$meta_keywords); ?>

 

 <?php $__env->startSection('content'); ?>
 
 
 <div class="sun-breadcrumb-01">
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

<div id="content" class="site-content">
<div class="container">
<div class="row">
    <div class="col-12">
<!-- .woocommerce-breadcrumb -->
<div id="primary" class="content-area">
<main id="main" class="site-main">
<div class="type-page hentry privacy-page">
<header class="entry-header">
<div class="page-header-caption text-center">
<h3><b><?php echo e($meta_tag->page_name); ?></b></h3>
</div>
</header>
<!-- .entry-header -->
<div class="entry-content">

<?php echo $meta_tag->page_content; ?>


</div>
<!-- .entry-content -->
</div>
<!-- .hentry -->
</main>
<!-- #main -->
</div>
<!-- #primary -->
</div>
</div>
<!-- .row -->
</div>
<!-- .col-full -->
</div>

 <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/faq.blade.php ENDPATH**/ ?>