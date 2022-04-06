<?php $__env->startSection('title','Manage Lens Color Type'); ?>

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
<h4 style="float:left;margin-top:5px;">Manage Lens Color Type &nbsp; <i style="font-size:20px;" class="fas fa-list-alt"></i></h4>

<div style="float:right;">
<span style="padding:8px;font-size:16px;box-shadow:2px 2px 2px grey;" class="badge badge-pill badge-secondary"><b>Total:</b> <?php echo e($lens_color_types->total()); ?></span>
&nbsp;&nbsp;
<span><a href="<?php echo e(route('add-lens-color-type')); ?>" class="btn btn-primary"> <i class="fa fa-plus"></i> Add Lens Color Type</a></span>

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


<?php if($lens_color_types->isNotEmpty()): ?>


 <div class="container-fluid">
 <form action="<?php echo e(route('bottom-button-action-lens-color-type')); ?>" method="post" onsubmit="return checkboxValidation()">
  <?php echo csrf_field(); ?>
  <?php echo method_field('PUT'); ?>


  <div class="row">

        <div class="col-lg-12">

        <div class="card" id="card_categories">
        <div class="card-header">
        <nav>
        <ol class="breadcrumb" id="breadcrumb_cat">
            <strong>Lens Color Type </strong> &nbsp; Details
        </ol>
        </nav>
        </div>
        <div class="card-body card-block">

        <div class="table-responsive table--no-card m-b-30" id="table_categories">
        <table class="table table-borderless table-striped table-earning" style=" width:100%" id="table_layout">
        <thead>
        <tr>
        <th class="text-center"><input type="checkbox" id="checkAll"> S.No</th>
        <th class="text-center">Image</th>
        <th class="text-center">Name</th>
        <th class="text-center">Add</th>
        <th class="text-center">Order</th>
        <th class="text-center">Status</th>
        <th class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
     <?php
     $i=1;
     $status="";
     ?>
     <?php $__currentLoopData = $lens_color_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <tr>
        <td class="text-center v-align"><input type="checkbox" name="category_ids[]" id="ids[]" class="category_ids" value="<?php echo e($category_data->id); ?>"/> <?php echo e($i++); ?></td>
        <td class="text-center">
         <?php if(!empty($category_data->category_image_name)): ?>
        <img src="<?php echo e(asset('/uploaded_files/lens/'.$category_data->category_image_name)); ?>" style="width:80%;height:100px;" alt="category image" title="category image" class="rounded">
         <?php else: ?>
         <img src="<?php echo e(asset('admin_assets/images/no_image.jpg')); ?>" style="width:80%;height:90px;" alt="category" title="category" class="rounded"/>
         <?php endif; ?>

    <?php if($category_data->category_for_home == "Yes"): ?>
         <br>
         <span class="badge badge-pill" id="badge_category"> <i class="fas fa-home" style="color:black"></i> &nbsp; Home</span>

    <?php endif; ?>
         </td>
        <td class="text-center v-align">
        <a href="<?php echo e(route('manage-sub-lens-color-type', $category_data->id)); ?>" title="View Sub category" data-toggle="tooltip"> <?php echo e($category_data->category_name); ?> <i class="fas fa-arrow-right"></i> </a>
        </td>

        <td class="text-center v-align">
        <a href="<?php echo e(route('add-sub-lens-color-type-form', $category_data->id)); ?>" title="Add Sub Lens Color Type" data-toggle="tooltip" class="btn btn-outline-secondary"> <i class="fas fa-plus"></i> Sub Color </a>
        </td>

        <input type="hidden" name="category_order_by_ids[]" class="category_order_by_ids" value="<?php echo e($category_data->id); ?>"/>

        <td class="text-center v-align"><input type="number" min="0" name="category_order_by[]" class="category_order_by form-control" value="<?php echo e($category_data->category_order_by); ?>" style="background-color:whitesmoke;text-align:center;width:60px;" /></td>

        <td class="text-center v-align">
        <?php if($category_data->category_status=="Active"): ?>
        <span class="badge badge-success"><?php echo e($category_data->category_status); ?></span>
        <?php else: ?>
        <span class="badge badge-danger"><?php echo e($category_data->category_status); ?></span>
        <?php endif; ?>
        </td>

        <td class="text-center v-align">
        <a title="Edit Lens Color Type" href="<?php echo e(route('edit-lens-color-type', $category_data->id)); ?>" data-toggle="tooltip"><i class="fa fa-edit"></i></a>

        </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
        </table>
        </div>
        </div>

  </div>

<!-- BOTTOM BUTTONS -->

<div class="row" style="background-color:lightgrey;padding:10px;box-shadow:2px 2px 2px grey;">
 <div class="col-md-12">
   <!-- ******** -->
   <input type="submit" class="btn btn-success req_for" name="req_for" value="Active">
   <input type="submit" class="btn btn-danger req_for" name="req_for" value="Inactive" style="margin-left:10px;">

  
   <input type="submit" class="btn btn-warning req_for" name="req_for" value="Update Order" style="margin-left:10px;">

   <input type="submit" class="btn btn-danger req_for" name="req_for" value="Delete" style="float:right">


 </div>
</div>

</div></div>

</form>
 </div>
 <br>

<?php echo e($lens_color_types->links()); ?>


 <?php else: ?>

 <div class="alert alert-danger fade show" id="no_record_found">
    <strong style="font-size: 22px">No Record Found...!</strong>
 </div>

<?php endif; ?>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/admin/manage-lens-color-type.blade.php ENDPATH**/ ?>