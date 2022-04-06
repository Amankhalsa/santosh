<?php $__env->startSection('title','Manage Currency'); ?>

<?php $__env->startSection('content'); ?>

<style>
.swal-wide{
width:500px !important;
font-size:16px !important;
}
</style>

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Manage Currency &nbsp; <i style="font-size:20px;" class="fas fa-rupee"></i></h4>

<div style="float:right;">
<span style="padding:8px;font-size:16px;box-shadow:2px 2px 2px grey;" class="badge badge-pill badge-secondary"><b>Total:</b> <?php echo e(count($currencies)); ?></span>
&nbsp;&nbsp;
<span><a href="<?php echo e(route('add-currency-form')); ?>" class="btn btn-primary"> <i class="fa fa-plus"></i> Add</a></span>

</div>

</div>
</div>
</div>

<div class="section__content section__content--p30">
<br>

<?php if(count($errors)>0): ?>
<div class="alert alert-danger alert-dismissible fade show">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<strong>Errors Occured!</strong>
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

<?php if($currencies->isNotEmpty()): ?>

 <div class="container-fluid">
 <form action="<?php echo e(route('bottom-button-action-currency')); ?>" method="post" onsubmit="return checkboxValidation()">
  <?php echo csrf_field(); ?>
  <?php echo method_field('PUT'); ?>
  <div class="row">

        <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-30">
        <table class="table table-borderless table-striped table-earning">
        <thead>
        <tr>
        <th class="text-center"><input type="checkbox" id="checkAll"> S.No</th>
        <th class="text-center">Name</th>
        <th class="text-center">Exchange Rate</th>
        <th class="text-center">Status</th>
        <th class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
     <?php
     $i=1;
     $status="";
     ?>
     <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
        <td class="text-center v-align"><input type="checkbox" name="currency_ids[]" id="ids[]" class="currency_ids" value="<?php echo e($currency_data->id); ?>"/> <?php echo e($i++); ?></td>
        
        <td class="text-center v-align"><?php echo e($currency_data->country_name); ?></td>
        <td class="text-center v-align"><?php echo e($currency_data->currency_symbol.' '.$currency_data->exchange_rate); ?></td>
        <td class="text-center v-align">
        <?php if($currency_data->status=="Active"): ?>
        <span class="badge badge-success"><?php echo e($currency_data->status); ?></span>
        <?php else: ?>
        <span class="badge badge-danger"><?php echo e($currency_data->status); ?></span>
        <?php endif; ?>
        </td>

        <td class="text-center v-align">
        <a title="Edit Currency" href="<?php echo e(route('edit-currency',$currency_data->id)); ?>" data-toggle="tooltip"><i class="fa fa-edit"></i></a>

        </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
        </table>
        </div>
        </div>

        <?php echo e($currencies->links()); ?>


  </div>

<!-- BOTTOM BUTTONS -->
<div class="row" style="background-color:lightgrey;padding:10px;box-shadow:2px 2px 2px grey;">
 <div class="col-md-12">
   <!-- ******** -->
   <input type="submit" class="btn btn-success req_for" name="req_for" value="Active">
   <input type="submit" class="btn btn-danger req_for" name="req_for" value="Inactive" style="margin-left:10px;">
   <input type="submit" class="btn btn-danger req_for" name="req_for" value="Delete" style="float:right">


 </div>
</div>
</form>
 </div>

 <?php else: ?>
 <div class="alert alert-danger fade show" id="no_record_found">
    <strong style="font-size: 22px">No Record Found...!</strong>
 </div>
 <?php endif; ?>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/admin/manage-currency.blade.php ENDPATH**/ ?>