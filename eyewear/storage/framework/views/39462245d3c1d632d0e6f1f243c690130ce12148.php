<?php if($eyeglasses->isNotEmpty()): ?>

<div class="productColMain">
                 <!--Eyeglasses header   -->

   <!--Eyeglasses header   -->
            <div class="row g-4">
<?php $__currentLoopData = $eyeglasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
$brand = DB::table('categories')->where('id',$product->category_parent_id)->first();
?>
<!--card start -->
<div class="col-md-6 col-xl-4">
<div class="cardStyle1">
<!--discount part-->
<?php if($product['category_is_discount']=="Yes"): ?>    
<span class="discountCol"> <?php echo e($product['category_discount']); ?>%</span>
<?php endif; ?>
<!--discount part-->
<div class="productImg">
        <a href="<?php echo e(url('/frame/'.$product['category_slug_name'].'.html')); ?>" target="_blank">
<div class="imgCol">
<?php if(!empty($product->category_image_name)): ?> 
<img src="<?php echo e(asset('uploaded_files/product/'.$product->category_image_name)); ?>" alt="image of <?php echo e($brand->category_name); ?>"  title="<?php echo e($brand->category_for); ?>">
<?php else: ?>
<img  src="<?php echo e(asset('admin_assets/images/no_image.jpg')); ?>" alt="image of <?php echo e($brand->category_name); ?>" title="<?php echo e($brand->category_for); ?>">
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
<a href="<?php echo e(url('/frame/'.$product->category_slug_name.'.html')); ?>" target="_blank"  class="colorCol actColor btn-tool <?php if($group->category_slug_name==$product->category_slug_name): ?> color-btn <?php endif; ?>" target="_blank">
<img src="<?php echo e(asset('uploaded_files/color_image/'.$color_data->color_image_name)); ?>" alt="..."></a>
</li>
<?php
$i++;
?>   
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
<li>
<a href="<?php echo e(url('/frame/'.$product->category_slug_name.'.html')); ?>"  class="colorCol"  >
<img src="<?php echo e(asset('uploaded_files/color_image/'.$get_current_color->color_image_name)); ?>" alt="...."></a>
</li>
<?php endif; ?>
                      </ul>
                    </div>
                  </div>
                  <div class="contentCol">
                    <!--brand name-->
                    <h4 class="brandCol"><?php echo e($brand->category_name); ?></h4>
                       <!--brand name-->
            <a href="<?php echo e(url('/frame/'.$product['category_slug_name'].'.html')); ?>" style="text-decoration:none; color:black;">
                    <p> <?php echo e(strtoupper(Str::limit($product->category_name,30,$end='...'))); ?></p>
                        </a>
                    <!--price-->
                    <span class="priceCol">
                        <?php echo e(getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product->category_discount_price)); ?> 
                         </span>
                         <span>
             <?php if($product->category_is_discount=="Yes"): ?>
<strike id="mrp"><?php echo e(getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product->category_price)); ?></strike>
<?php endif; ?>
                             </span>
                         <!--price-->
                    <div class="row gx-2">
                      <div class="col-auto">

       <a href="<?php echo e(url('/frame/'.$product['category_slug_name'].'.html')); ?>" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
                      </div>
                      <div class="col">

            <form action="<?php echo e(url('/add-wishlist')); ?>" method="post">
 <?php echo csrf_field(); ?>
 <?php echo method_field('POST'); ?>
<input type="hidden" name="product_id" class="product_id" value="<?php echo e($product->id); ?>"/>
<input type="hidden" value="1" name="qty" />
<button type="submit" value="Add To WISHLIST"  class="btn btnDark_outline w-100" >
  ADD TO WISHLIST</button>
</form>   
    
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
            <div class="btnCol text-center">
              <a href="<?php echo e(url('/eyeglasses/women')); ?>" target="_blank" class="btn btnPrimary minWdBtn btnNew">Shop Now</a>
            </div>
          </div>
          <?php endif; ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/frontend/eyeglass.blade.php ENDPATH**/ ?>