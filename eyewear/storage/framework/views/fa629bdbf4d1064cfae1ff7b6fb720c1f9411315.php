<?php $__env->startSection('title','Add / Edit Tint'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Add / Edit Tint &nbsp; <i style="font-size:20px;" class="fas fa-list-alt"></i></h4>
<span style="float:right;"><a href="<?php echo e(route('manage-tint-color', [$category_parent_id, $sub_cat_id])); ?>" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
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
  <form <?php if(isset($edit_finalcategory)): ?> action="<?php echo e(route('update-color-tint', [$category_parent_id, $sub_cat_id, $edit_finalcategory->id])); ?>" <?php else: ?> action="<?php echo e(route('add-color-tint', [$category_parent_id, $sub_cat_id])); ?>" <?php endif; ?> method="post" enctype="multipart/form-data" class="form-horizontal">
  <?php echo csrf_field(); ?>
  <?php if(isset($edit_finalcategory)): ?>
   <?php echo method_field('PUT'); ?>
  <?php else: ?>
   <?php echo method_field('POST'); ?>
  <?php endif; ?>

     <div class="card">
      <div class="card-header">
       <nav>
        <ol class="breadcrumb" id="breadcrumb_cat">
        <?php
        $cat_name = DB::table('categories')->where('id',$category_parent_id)->select('category_name')->first();
        $sub_cat_name = DB::table('categories')->where('id',$sub_cat_id)->select('category_name')->first();
        ?>

        <?php if(!empty($cat_name->category_name)): ?>
        <li class="breadcrumb-item"><a href="<?php echo e(route('add-category')); ?>"><?php echo e($cat_name->category_name); ?></a></li>
        <?php endif; ?>

        <?php if(!empty($sub_cat_name->category_name)): ?>
        <li class="breadcrumb-item"><a href="<?php echo e(route('add-subcategory-form', $category_parent_id)); ?>"><?php echo e($sub_cat_name->category_name); ?></a></li>
        <?php endif; ?>

        <?php if(isset($edit_finalcategory)): ?>
        <li class="breadcrumb-item active"><?php echo e($edit_finalcategory->category_name); ?></li>
        <?php endif; ?>

        &nbsp;

    </ol>
        </nav>
        </div>
        <div class="card-body card-block">

<!-- DISPLAY IMAGE -->
        <div class="row form-group">
        <div class="col-6 col-md-3">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Color Image</label>
        <?php if(isset($edit_finalcategory) && !empty($edit_finalcategory->category_image_name)): ?>
        <img src="<?php echo e(asset('uploaded_files/finalcat/'.$edit_finalcategory->category_image_name)); ?>" style="width:50%;height:100px;" alt="category" title="category" class="rounded"/>
        <!--<span><a href="<?php echo e(route('remove-finalcategory-image', [$category_parent_id, $sub_cat_id, $edit_finalcategory->id])); ?>">Remove Image</a></span>-->
        <?php else: ?>
        <img src="<?php echo e(asset('admin_assets/images/no_image.jpg')); ?>" style="width:100%;height:160px;" alt="category" title="category" class="rounded"/>
        <?php endif; ?>

        </div>
        <div class="col-6 col-md-3">
        <input type="file" id="category_image_name" name="category_image_name" class="form-control-file" style="margin-top:100px;" >
        </div>
        </div>



        <div class="row form-group">
        <div class="col-12 col-md-3">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Color Name</label>
        <input type="text" id="category_name" name="category_name" placeholder="Enter Color Name" class="form-control" <?php if(isset($edit_finalcategory)): ?> value="<?php echo e($edit_finalcategory->category_name); ?>" <?php else: ?> value="<?php echo e(old('category_name')); ?>" <?php endif; ?> >
        </div>
        
        <!--<div class="col-12 col-md-3">
        <label for="select" class=" form-control-label" style="font-weight:520"> Color Price</label>
       <input type="number" id="category_price" name="category_price" placeholder="Enter Price" class="form-control" <?php if(isset($edit_finalcategory)): ?> value="<?php echo e($edit_finalcategory->category_price); ?>" <?php else: ?> value="<?php echo e(old('category_price')); ?>" <?php endif; ?> >
        </div>-->

        <div class="col-12 col-md-2">
        <label for="select" class=" form-control-label" style="font-weight:520"> Status</label>
        <select name="category_status" id="category_status" class="form-control">
        <option value="Active" <?php if(isset($edit_finalcategory)): ?> <?php if($edit_finalcategory->category_status=='Active'): ?> selected <?php endif; ?> <?php endif; ?> >Active</option>
        <option value="Inactive" <?php if(isset($edit_finalcategory)): ?> <?php if($edit_finalcategory->category_status=='Inactive'): ?> selected <?php endif; ?> <?php endif; ?>  >Inactive</option>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/admin/addedit-color-tint.blade.php ENDPATH**/ ?>