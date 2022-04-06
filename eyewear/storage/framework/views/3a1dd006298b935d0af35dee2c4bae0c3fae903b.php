



 <?php $__env->startSection('title',"Wishlist"); ?>
 <?php $__env->startSection('description',"Wishlist"); ?>
 <?php $__env->startSection('keywords',"Wishlist"); ?>

 

 <?php $__env->startSection('content'); ?>

    <div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
    <div class="row">
    <nav class="woocommerce-breadcrumb">
    <a href="<?php echo e(url('/')); ?>">Home</a>
    <span class="delimiter">
    <i class="tm tm-breadcrumbs-arrow-right"></i>
    </span>Wishlist
    </nav>
    <!-- .woocommerce-breadcrumb -->
    <div id="primary" class="content-area">
    <main id="main" class="site-main">

<?php if(auth()->guard('user')->check()): ?>

    <section class="section-product-categories">
    <header class="section-header">
    <h1 class="woocommerce-products-header__title page-title">Wishlist</h1>
    </header>
    <div class="woocommerce columns-5">
    <div class="product-loop-categories">
<?php
 $wishlists = DB::table('wishlists')->where('user_id',Auth::guard('user')->user()->id)->get();
?>
<?php $__currentLoopData = $wishlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wishlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <?php
  $product_data = DB::table('categories')->where('id',$wishlist->product_id)->first();
  $finalcat_data = DB::table('categories')->where('id',$product_data->category_parent_id)->first();
  $subcat_data = DB::table('categories')->where('id',$finalcat_data->category_parent_id)->first();
 ?>

  <div class="product-category product first">
      <?php if(isset($subcat_data->category_slug_name) && isset($product_data->category_slug_name) && isset($subcat_data->category_slug_name)): ?>
  <a href="<?php echo e(url('/'.$subcat_data->category_slug_name.'/'.$finalcat_data->category_slug_name.'/'.$product_data->category_slug_name.'.html')); ?>">
    <?php endif; ?>
  <?php if(!empty($product_data->category_image_name)): ?>  
  <img src="<?php echo e(asset('uploaded_files/product/'.$product_data->category_image_name)); ?>" style="width: 100%;height: 200px;">
  <?php else: ?>
  <img src="<?php echo e(asset('admin_assets/images/no_image.jpg')); ?>" style="width:100%;height:200px;" alt="products" title="products" class="rounded"/>
  <?php endif; ?>

      <h2 class="woocommerce-loop-category__title"> <?php echo e($product_data->category_name); ?>

          <span><a href="<?php echo e(url('/remove-wishlist',$wishlist->id)); ?>"><i class="fas fa-times-circle" title="Remove from wishlist"></i></a></span>
      </h2>
  </a>
  </div>

 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   

    </div>
    <!-- .product-loop-categories -->
    </div>
    <!-- .woocommerce -->
    </section>

<?php else: ?>

Please Login first to see wishlist

<?php endif; ?>

    <!-- .section-products-carousel -->
    </main>
    <!-- #main -->
    </div>

    </div>
    <!-- .row -->
    </div>
    <!-- .col-full -->
    </div>
    <!-- #content -->
    <div class="col-full">
    

    <?php echo $__env->make('index-brands', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>

 <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/wishlist.blade.php ENDPATH**/ ?>