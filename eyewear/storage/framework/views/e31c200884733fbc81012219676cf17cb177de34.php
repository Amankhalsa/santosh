<?php $__env->startSection('title','Manage Category'); ?>

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
<h4 style="float:left;margin-top:5px;">Manage Category &nbsp; <i style="font-size:20px;" class="fas fa-list-alt"></i></h4>

<div style="float:right;">
<span style="padding:8px;font-size:16px;box-shadow:2px 2px 2px grey;" class="badge badge-pill badge-secondary"><b>Total:</b> <?php echo e($finalcategories->total()); ?></span>
&nbsp;&nbsp;

<?php if($admin_data->admin_category_level == "2"): ?>
<span><a href="<?php echo e(route('manage-subcategory', [$category_parent_id])); ?>" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
&nbsp;&nbsp;
<?php endif; ?>

<span><a href="<?php echo e(route('add-finalcategory-form', [$category_parent_id, $sub_cat_id])); ?>" class="btn btn-primary"> <i class="fa fa-plus"></i> Add Category</a></span>

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


<?php if($finalcategories->isNotEmpty()): ?>

 <?php if($admin_data->admin_search_option == "Yes"): ?>


<div class="container" >
    <div class="row">
     <div class="col-12 offset-md-3 offset-sm-2">

     <form class="cat-search-form" method="post" action="<?php echo e(route('finalcat-search-form',[$category_parent_id,$sub_cat_id])); ?>">
     <?php echo csrf_field(); ?>
     <?php echo method_field('POST'); ?>


    <div class="input-group mb-3">
   <?php if(isset($search_keyword)): ?>
    <span class="badge badge-pill badge-light" id="cat-filter-span" data-toggle="tooltip" title="Remove Filter">
    <a href="<?php echo e(route('manage-finalcategory',[$category_parent_id,$sub_cat_id])); ?>">
     <i class="fas fa-filter" id="remove-filter-parent">
      <i class="fas fa-times" id="remove-filter-child"></i></i>
   </a>
    </span> &nbsp;
   <?php endif; ?>

     <input class="au-input au-input--xl" type="text" name="search_keyword" placeholder="Search category by name..." <?php if(isset($search_keyword)): ?> value="<?php echo e($search_keyword); ?>" <?php endif; ?> required/>
      <div class="input-group-append">
       <span class="input-group-text" id="input-group-span-search-form" >
       <button class="btn btn-primary" type="submit" id="cat-search-btn" >
       <i class="zmdi zmdi-search" id="cat-search-icon"></i>
      </button></span>
     </div>
    </div>
   </form>

     </div>
    </div>
   </div>

   
<?php endif; ?>

 <div class="container-fluid">
 <form action="<?php echo e(route('bottom-button-action-finalcategory', [$category_parent_id, $sub_cat_id])); ?>" method="post" onsubmit="return checkboxValidation()">
  <?php echo csrf_field(); ?>
  <?php echo method_field('PUT'); ?>

  <input type="hidden" name="url" value="<?php echo e(Request::fullUrl()); ?>">
  <?php if(isset($search_keyword)): ?>
   <input type="hidden" name="keyword" value="<?php echo e($search_keyword); ?>">
  <?php endif; ?>

  <div class="row">

        <div class="col-lg-12">
        <div class="card" id="card_categories">
        <div class="card-header">
        <nav>
        <ol class="breadcrumb" id="breadcrumb_cat">
        <?php
        $cat_name = DB::table('categories')->orderBy('category_name')->where('id',$category_parent_id)->select('category_name')->first();
        $sub_cat_name = DB::table('categories')->where('id',$sub_cat_id)->select('category_name')->first();
        ?>

        <?php if(!empty($cat_name->category_name)): ?>
        <li class="breadcrumb-item"><a href="<?php echo e(route('manage-category')); ?>"><?php echo e($cat_name->category_name); ?></a></li>
        <?php endif; ?>

        <?php if(!empty($sub_cat_name->category_name)): ?>
        <li class="breadcrumb-item"><a href="<?php echo e(route('manage-subcategory', $category_parent_id)); ?>"><?php echo e($sub_cat_name->category_name); ?></a></li>
        <?php endif; ?>

        &nbsp;

        </ol>
        </nav>
    </div>
    <div class="card-body card-block">

        <div class="table-responsive table--no-card m-b-30" id="table_categories">
        <table class="table table-borderless table-striped table-earning" >
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
     $i = $finalcategories->perPage() * ($finalcategories->currentPage() - 1 );
     $status="";
     ?>
     <?php $__currentLoopData = $finalcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $finalcategory_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
        <td class="text-center v-align"><input type="checkbox" name="category_ids[]" id="ids[]" class="category_ids" value="<?php echo e($finalcategory_data->id); ?>"/> <?php echo e(++$i); ?></td>
        <td class="text-center">
         <?php if(!empty($finalcategory_data->category_image_name)): ?>
        <img src="<?php echo e(asset('/uploaded_files/finalcat/'.$finalcategory_data->category_image_name)); ?>" width="200" alt="finalcategory image" title="finalcategory image" class="img-fluid rounded">
         <?php else: ?>
         <img src="<?php echo e(asset('admin_assets/images/no_image.jpg')); ?>" width="200" alt="finalcategory" title="finalcategory" class="rounded"/>
         <?php endif; ?>

    <?php if($finalcategory_data->category_for_home == "Yes"): ?>
         <br>
         <span class="badge badge-pill" id="badge_category"> <i class="fas fa-home" style="color:black"></i> &nbsp; Home</span>

    <?php endif; ?>
         </td>
        <td class="text-center v-align">
        <a href="<?php echo e(route('manage-product', [$category_parent_id, $sub_cat_id, $finalcategory_data->id])); ?>" title="View Product" data-toggle="tooltip"> <?php echo e($finalcategory_data->category_name); ?> <i class="fas fa-arrow-right"></i> </a>
        </td>

        <td class="text-center v-align">
        <a href="<?php echo e(route('add-product-form', [$category_parent_id, $sub_cat_id, $finalcategory_data->id])); ?>" title="Add Product" data-toggle="tooltip" class="btn btn-outline-secondary"> <i class="fas fa-plus"></i> Product </a>
        </td>

        <input type="hidden" name="category_order_by_ids[]" class="category_order_by_ids" value="<?php echo e($finalcategory_data->id); ?>"/>

        <td class="text-center v-align"><input type="number" min="0" name="category_order_by[]" class="category_order_by form-control" value="<?php echo e($finalcategory_data->category_order_by); ?>" style="background-color:whitesmoke;text-align:center;width:60px;" /></td>

        <td class="text-center v-align">
        <?php if($finalcategory_data->category_status=="Active"): ?>
        <span class="badge badge-success"><?php echo e($finalcategory_data->category_status); ?></span>
        <?php else: ?>
        <span class="badge badge-danger"><?php echo e($finalcategory_data->category_status); ?></span>
        <?php endif; ?>
        </td>

        <td class="text-center v-align">
        <a title="Edit Category" href="<?php echo e(route('edit-finalcategory', [$category_parent_id, $sub_cat_id, $finalcategory_data->id])); ?>" data-toggle="tooltip"><i class="fa fa-edit"></i></a>

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

   <input type="submit" class="btn btn-dark req_for" name="req_for" value="Set for home" style="margin-left:10px;">
   <input type="submit" class="btn btn-light req_for" name="req_for" value="Remove from home" style="margin-left:10px;">

   <input type="submit" class="btn btn-warning req_for" name="req_for" value="Update Order" style="margin-left:10px;">

   <input type="submit" class="btn btn-danger req_for" name="req_for" value="Delete" style="float:right">


 </div>
</div>
</div></div>
</form>
 </div>
 <br>

<?php echo e($finalcategories->links()); ?>


<?php else: ?>

 <div class="alert alert-danger fade show" id="no_record_found">
    <strong style="font-size: 22px">No Record Found...!</strong>
 </div>

<?php endif; ?>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/admin/manage-finalcategory.blade.php ENDPATH**/ ?>