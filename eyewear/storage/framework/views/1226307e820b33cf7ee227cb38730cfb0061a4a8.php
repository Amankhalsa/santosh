

<?php $__env->startSection('title','Change Password'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left">Change Password &nbsp; <i style="font-size:20px;" class="fa fa-lock"></i></h4>
</div>
</div>
</div>
<div class="section__content section__content--p30">
<br>

<?php if(count($errors)>0): ?>
<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Errors Occurred!</strong>
    <ul style="margin-left:25px;">
     <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     <li><?php echo e($error); ?></li>
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>  
<?php endif; ?>

<?php if(session('pass_err')): ?>

<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Errors Occurred!</strong>
    <ul style="margin-left:25px;"> 
     <li><?php echo e(session('pass_err')); ?></li>
    </ul>
</div> 

<?php endif; ?>

<?php if(session('success')): ?>
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo e(session('success')); ?>  
</div>
<?php endif; ?>

 <div class="container-fluid">
  <div class="row">
  <div class="col-lg-6 offset-lg-3">
            <div class="card">
            <div class="card-header">Update Password</div>
            <div class="card-body">
            <div class="card-title">
            <h3 class="text-center title-2">Change Password</h3>
            </div>
            <hr>
            <form action="<?php echo e(route('change-password')); ?>" method="post" >
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="form-group">
            <label for="cc-payment" class="control-label mb-1">Old Password</label>
            <input id="old_password" name="old_password" type="password" class="form-control" required placeholder="Enter Old Password" value="<?php echo e(old('old_password')); ?>">
            </div>
           
           
            <div class="form-group">
            <label for="cc-payment" class="control-label mb-1">New Password</label>
            <input id="new_password" name="new_password" type="password" class="form-control" required placeholder="Enter New Password" value="<?php echo e(old('new_password')); ?>">
            </div>

            <div class="form-group">
            <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
            <input id="confirm_password" name="confirm_password" type="password" class="form-control" required placeholder="Enter Confirm Password" value="<?php echo e(old('confirm_password')); ?>">
            </div>

            <div>
            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
            <i class="fa fa-lock fa-lg"></i>&nbsp;
            <span id="payment-button-amount">Change</span>
            </button>
            </div>
            </form>
            </div>
            </div>
            </div>
  </div>
 </div>

 <!-- ******************** -->
</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/admin/change-password.blade.php ENDPATH**/ ?>