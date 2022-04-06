<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $__env->make('admin.layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<!-- (animsition) removed this class from body tag to stop loader -->

<body class="">
<div class="page-wrapper">
 <?php echo $__env->make('admin.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

 <?php echo $__env->make('admin.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

 <div class="page-container">
 <?php echo $__env->make('admin.layouts.header_desktop', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="main-content">
<?php echo $__env->yieldContent('content'); ?>
</div>

 <?php echo $__env->make('admin.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
    
</body>
</html><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/admin/layouts/app.blade.php ENDPATH**/ ?>