

<?php $__env->startSection('title','Manage Pages'); ?>

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
<h4 style="float:left;margin-top:5px;">Manage Site Pages &nbsp; <i style="font-size:20px;" class="fa fa-file-alt"></i></h4>

<span style="float:right;padding:8px;font-size:16px;box-shadow:2px 2px 2px grey;" class="badge badge-pill badge-secondary"><b>Total:</b> <?php echo e(count($pages)); ?></span>
</div>
</div>
</div>

<div class="section__content section__content--p30">
<br>

<?php if(session('msg_page_status')): ?>
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo e(session('msg_page_status')); ?>  
</div>
<?php endif; ?>

 <div class="container-fluid">
  <form action="<?php echo e(url('/admin/manage-pages/update-page-status')); ?>" method="post" onsubmit="return checkboxValidation()">
  <?php echo csrf_field(); ?>
  <?php echo method_field('PUT'); ?>
  <div class="row">

        <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-30">
        <table class="table table-borderless table-striped table-earning">
        <thead>
        <tr>
        <th class="text-center"><input type="checkbox" id="checkAll"> S.No</th>
        <th class="text-center">Page Name</th>
        <th class="text-center">Page Status</th>
        <th class="text-center">Set for header</th>
        <th class="text-center">Set for footer</th>
        <th class="text-center">Page Order</th>
        <th class="text-center">Edit</th>
        </tr>
        </thead>
        <tbody>
     <?php 
     $i=1;
     $status="";
     ?>   
     <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
        <tr>
        <td class="text-center"><input type="checkbox" name="page_ids[]" id="ids[]" class="page_ids" value="<?php echo e($page_data->id); ?>"/> <?php echo e($i++); ?></td>
        <td class="text-center"><?php echo e($page_data->page_name); ?></td>
        <td class="text-center">
        <?php if($page_data->page_status=="Active"): ?>
        <span class="badge badge-success"><?php echo e($page_data->page_status); ?></span>
        <?php else: ?>
        <span class="badge badge-danger"><?php echo e($page_data->page_status); ?></span>
        <?php endif; ?>        
        </td>
        
        <td class="text-center" ><?php echo e($page_data->set_for_header); ?></td>
        <td class="text-center" ><?php echo e($page_data->set_for_footer); ?></td>

    <input type="hidden" name="page_ids_upd[]" class="page_ids_upd" value="<?php echo e($page_data->id); ?>"/>
    
        <td class="text-center"> <input type="number" min="0" name="page_order[]" class="page_order" value="<?php echo e($page_data->page_order_by); ?>" style="background-color:lightgrey;text-align:center;width:60px;" /> </td>
        <td class="text-center"><a href="<?php echo e(url('/admin/manage-pages/edit',$page_data->id)); ?>"><i class="fa fa-edit"></i></a></td> 
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
   <!-- ******** -->
   <input type="submit" class="btn btn-primary req_for" name="req_for" value="Set for header" style="margin-left:10px;">
   <input type="submit" class="btn btn-info req_for" name="req_for" value="Remove from header" style="margin-left:10px;">
   <!-- ******** -->
   <input type="submit" class="btn btn-secondary req_for" name="req_for" value="Set for footer" style="margin-left:10px;">
   <input type="submit" class="btn btn-dark req_for" name="req_for" value="Remove from footer" style="margin-left:10px;">
   <!-- ******** -->
   
   <input type="submit" class="btn btn-warning req_for" name="req_for" value="Update Order" style="margin-left:10px;">

 </div>
</div>
</form>
 </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/admin/manage-pages.blade.php ENDPATH**/ ?>