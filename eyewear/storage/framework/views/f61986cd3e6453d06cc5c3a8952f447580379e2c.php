<?php $__env->startSection('title',"Meta for {$search_keyword}"); ?>
<?php $__env->startSection('description',"Meta for {$search_keyword}"); ?>
<?php $__env->startSection('keywords',"Meta for {$search_keyword}"); ?>



<?php $__env->startSection('content'); ?>
<div class="sun-breadcrumb-01">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="breadcrumb-01">

<ul>
<li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home"></i></a></li>
<li><a href=""><?php echo e($search_keyword); ?></a></li>
</ul>
</div>
</div>
</div>
</div>
</div>

<div class="">
    <div class="container-fluid pl-0 pr-0">
        <div class="row">
<div class="col-12">
<div class="product-banner">
<img src="<?php echo e(asset('img/luxury-search.jpg')); ?>" style="width:100%">
</div>
</div>
</div>
    </div>
<div class="container-fluid">
<div class="row">

<div class="col-lg-12">
    

<div class="row">
<div class="col-lg-12">
<div class="search-refine">

</div>
</div>
</div>

<div class="row text-center">
    <div class="col-12 text-left mt-5 mb-5">
        <h3><b>Search Result for "<?php echo e($search_keyword); ?>"</b></h3>
        <hr>
    </div>
<?php $__currentLoopData = $search_result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <?php
  $brand = DB::table('categories')->where('id',$product->category_parent_id)->first();
 ?>
<div class="col-lg-3 col-12 cate-box">
<div class="thumbnail-wrap">
<div class="thumbnail" style="height:300px;">
    <a href="<?php echo e(url('/frame/'.$product['category_slug_name'].'.html')); ?>">
<div class="thumbnail-img light-bg">


<div class="flipper" >

<div class="front">
<?php if(!empty($product->category_image_name)): ?>    
<img src="<?php echo e(asset('uploaded_files/product/'.$product->category_image_name)); ?>"  >
<?php else: ?>
<img  src="<?php echo e(asset('admin_assets/images/no_image.jpg')); ?>" alt="" >
<?php endif; ?>
</div>
<div class="back">
<?php if(!empty($product->category_image_name2)): ?>    
<img src="<?php echo e(asset('uploaded_files/product/'.$product->category_image_name2)); ?>" >
<?php else: ?>
<img class="img-responsive" src="<?php echo e(asset('admin_assets/images/no_image.jpg')); ?>" alt="" >
<?php endif; ?>
</div>

<?php if($product['category_is_discount']=="Yes"): ?>      
 <div class="sale-tag right"> <span> <?php echo e($product['category_discount']); ?>% </span> </div>
<?php endif; ?>

</div>

</div>
<div class="sun-product-detail">
<span style="font-family: utopia-std,Charter,Georgia,serif;
    font-weight: 600;
    line-height: calc(1em + 6px);
    margin-top: 0;
    margin-bottom: 0;
    font-size: 20px;
    color: #414B56;
    margin-bottom: 0px;"><?php echo e($brand->category_name); ?></span><br>
<a href="<?php echo e(url('/frame/'.$product['category_slug_name'].'.html')); ?>">
<span style="color: #212121;
    font-family: Nunito,sans-serif;
    font-weight: 400;
    font-style: normal;
    letter-spacing: 2px;
    text-transform: uppercase;
"> <?php echo e(Str::limit($product->category_name,17,$end='...')); ?></span>
</a>
<p><?php echo e(getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product->category_discount_price)); ?> 
<?php if($product->category_is_discount=="Yes"): ?>
<strike id="mrp"><?php echo e(getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product->category_price)); ?></strike>
<?php endif; ?>
</p>
<?php
$get_current_color = DB::table('product_colors')->where('id',$product->category_color)->first(); 
?>
<div class="product-color">

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
<a href="<?php echo e(url('/frame/'.$group->category_slug_name.'.html')); ?>" class="pro-ibtn  btn-tool <?php if($group->category_slug_name==$product->category_slug_name): ?> color-btn <?php endif; ?> ">
<img class="pro-i" src="<?php echo e(asset('uploaded_files/color_image/'.$color_data->color_image_name)); ?>" style="margin-top: -30px; width:25px; height: 25px;">
</a>
<?php
  $i++;
 ?>   
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>

<a href="<?php echo e(url('/frame/'.$product->category_slug_name.'.html')); ?>" class="pro-ibtn  btn-tool color-btn ">
<img class="pro-i" src="<?php echo e(asset('uploaded_files/color_image/'.$get_current_color->color_image_name)); ?>" style="margin-top: -30px; width:25px; height: 25px;">
</a>

<?php endif; ?>
</div>
</div>
</a>
</div>
</div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   

</div>

<div class="sun-pagination">
<div class="container">
<div class="row">
<div class="col-lg-6">
<div class="">

</div>
<div class="col-lg-6">
<ul class="pagination">
<?php echo e($search_result->links()); ?>

</ul>



</div>
</div>
</div>
</div>

</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/search-result.blade.php ENDPATH**/ ?>