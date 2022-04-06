<?php $__env->startSection('title','Add / Edit Currency'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Add / Edit Currency &nbsp; <i style="font-size:20px;" class="fas fa-rupee"></i></h4>
<span style="float:right;"><a href="<?php echo e(route('manage-currency')); ?>" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
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

<?php if(session('success')): ?>
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

 <div class="container-fluid">
  <div class="row">
  <div class="col-lg-12">
  <form <?php if(isset($edit_currency)): ?> action="<?php echo e(route('update-currency',$edit_currency->id)); ?>" <?php else: ?> action="<?php echo e(route('add-currency')); ?>" <?php endif; ?> method="post" enctype="multipart/form-data" class="form-horizontal">
  <?php echo csrf_field(); ?>
  <?php if(isset($edit_currency)): ?>
   <?php echo method_field('PUT'); ?>
  <?php else: ?>
   <?php echo method_field('POST'); ?>
  <?php endif; ?>

        <div class="card">
        <div class="card-header">
        <strong>Add / Edit Currency</strong> Details
        </div>
        <div class="card-body card-block">


        <div class="row form-group">

        <div class="col-12 col-md-4">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Select Country</label>
        <select class="form-control" name="country_name">
            <option value="">--- Select Country ---</option>
          <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <option value="<?php echo e($country->name); ?>" <?php if(isset($edit_currency)): ?> <?php if($edit_currency->country_name==$country->name): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e($country->name); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        </div>
        
        <div class="col-12 col-md-2">
       <label for="text-input" class=" form-control-label" style="font-weight:520">Currency Symbol</label>
        <input type="text" id="currency_symbol" name="currency_symbol" placeholder="Enter Currency Symbol" class="form-control" <?php if(isset($edit_currency)): ?> value="<?php echo e($edit_currency->currency_symbol); ?>" <?php else: ?> value="<?php echo e(old('currency_symbol')); ?>" <?php endif; ?> >
        </div>
        
        <div class="col-12 col-md-3">
       <label for="text-input" class=" form-control-label" style="font-weight:520">Exchange Rate</label>
        <input type="text" id="exchange_rate" name="exchange_rate" placeholder="Enter Exchange Rate" class="form-control" <?php if(isset($edit_currency)): ?> value="<?php echo e($edit_currency->exchange_rate); ?>" <?php else: ?> value="<?php echo e(old('exchange_rate')); ?>" <?php endif; ?> >
        </div>

        <div class="col-12 col-md-3">
        <label for="select" class=" form-control-label" style="font-weight:520"> Status</label>
        <select name="status" id="status" class="form-control">
        <option value="Active" <?php if(isset($edit_currency)): ?> <?php if($edit_currency->status=='Active'): ?> selected <?php endif; ?> <?php endif; ?> >Active</option>
        <option value="Inactive" <?php if(isset($edit_currency)): ?> <?php if($edit_currency->status=='Inactive'): ?> selected <?php endif; ?> <?php endif; ?>  >Inactive</option>
        </select>
        </div>

        </div>

      
        </div>
        <div class="card-footer" style="box-shadow:2px 2px 2px grey;">
        <button type="submit" class="btn btn-primary btn-md">
        <i class="fa fa-send"></i> Submit
        </button>

        </div>
        </div>
</form>
    </div>
  </div>
 </div>

 <!-- ******************** -->
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/admin/addedit-currency.blade.php ENDPATH**/ ?>