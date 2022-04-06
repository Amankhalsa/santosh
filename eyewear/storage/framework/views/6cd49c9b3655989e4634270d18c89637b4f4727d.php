
<div class="">
    <div class="container">
        <div class="row padd-nee-001">
            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-12" style="padding-left:5px; padding-right:5px; padding-bottom:10px;">
                <div class="img-effect">
                    <a href="<?php echo e(url('/brand/'.$brand->category_slug_name.'.html')); ?>">
                        <img src="<?php echo e(asset('uploaded_files/finalcat/'.$brand->category_image_name)); ?>" width="100%">
                    </a>
                </div>
                
            </div>
            
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>



<?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/index-brands.blade.php ENDPATH**/ ?>