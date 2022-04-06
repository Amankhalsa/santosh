<?php $__env->startSection('title','Add / Edit Product'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Add / Edit Product &nbsp; <i style="font-size:20px;" class="fas fa-list-alt"></i></h4>
<span style="float:right;"><a href="<?php echo e(route('manage-product', [$category_parent_id, $sub_cat_id, $final_cat_id])); ?>" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>
</div>
</div>
</div>

<div class="section__content section__content--p30">
<br>

<?php if(session('error')): ?>
<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo e(session('error')); ?>

</div>
<?php endif; ?>

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
  <form <?php if(isset($edit_product)): ?> action="<?php echo e(route('update-product', [$category_parent_id, $sub_cat_id, $final_cat_id, $edit_product->id])); ?>" <?php else: ?> action="<?php echo e(route('add-product', [$category_parent_id, $sub_cat_id, $final_cat_id])); ?>" <?php endif; ?> method="post" enctype="multipart/form-data" class="form-horizontal">
  <?php echo csrf_field(); ?>
  <?php if(isset($edit_product)): ?>
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
            $final_cat_name = DB::table('categories')->where('id',$final_cat_id)->select('category_name')->first();
            ?>
            
            <?php if(!empty($cat_name->category_name)): ?> 
            <li class="breadcrumb-item"><a href="<?php echo e(route('add-category')); ?>">
                <?php echo e($cat_name->category_name); ?>    
            </a></li>
            <?php endif; ?>

            <?php if(!empty($sub_cat_name->category_name)): ?>    
            <li class="breadcrumb-item"><a href="<?php echo e(route('add-subcategory-form', $category_parent_id)); ?>">
                <?php echo e($sub_cat_name->category_name); ?>

            </a></li>
            <?php endif; ?>    

            <?php if(!empty($final_cat_name->category_name)): ?>    
            <li class="breadcrumb-item"><a href="<?php echo e(route('add-finalcategory-form', [$category_parent_id, $sub_cat_id])); ?>">
                <?php echo e($final_cat_name->category_name); ?>

            </a></li>
            <?php endif; ?>    

            <?php if(isset($edit_product)): ?>
            <li class="breadcrumb-item active"><?php echo e($edit_product->category_name); ?></li>
            <?php endif; ?>

            &nbsp;

            </ol>
            </nav>
        </div>
        <div class="card-body card-block">

<!-- DISPLAY IMAGE -->
        <div class="row form-group">
        <div class="col-3 col-md-3">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Product Front Image</label>
        <?php if(isset($edit_product) && !empty($edit_product->category_image_name)): ?>
        <img src="<?php echo e(asset('uploaded_files/product/'.$edit_product->category_image_name)); ?>" style="width:100%;height:180px;" alt="product" title="product" class="rounded"/>
        <span><a href="<?php echo e(route('remove-product-image', [$category_parent_id, $sub_cat_id, $final_cat_id, $edit_product->id])); ?>">Remove Image</a></span>
        <?php else: ?>
        <img src="<?php echo e(asset('admin_assets/images/no_image.jpg')); ?>" style="width:100%;height:180px;" alt="product" title="product" class="rounded"/>
        <?php endif; ?>

        </div>
        <div class="col-3 col-md-3">
        <input type="file" id="category_image_name" name="category_image_name" class="form-control-file" style="margin-top:100px;" >
        </div>
        
        <!-- Back Image -->
        
        <div class="col-3 col-md-3">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Product Back Image</label>
        <?php if(isset($edit_product) && !empty($edit_product->category_image_name2)): ?>
        <img src="<?php echo e(asset('uploaded_files/product/'.$edit_product->category_image_name2)); ?>" style="width:100%;height:180px;" alt="product" title="product" class="rounded"/>
        <span><a href="<?php echo e(route('remove-product-back-image', [$category_parent_id, $sub_cat_id, $final_cat_id, $edit_product->id])); ?>">Remove Back Image</a></span>
        <?php else: ?>
        <img src="<?php echo e(asset('admin_assets/images/no_image.jpg')); ?>" style="width:100%;height:180px;" alt="product" title="product" class="rounded"/>
        <?php endif; ?>

        </div>
        <div class="col-3 col-md-3">
        <input type="file" id="category_image_name2" name="category_image_name2" class="form-control-file" style="margin-top:100px;" >
        </div>
        
        </div>
        
<!-- Other Images -->
        <div class="row form-group">
        <div class="col-3 col-md-3">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Product Other Image</label>
        <?php if(isset($edit_product) && !empty($edit_product->category_image_name3)): ?>
        <img src="<?php echo e(asset('uploaded_files/product/'.$edit_product->category_image_name3)); ?>" style="width:100%;height:180px;" alt="product" title="product" class="rounded"/>
        <span><a href="<?php echo e(route('remove-product-image3', [$category_parent_id, $sub_cat_id, $final_cat_id, $edit_product->id])); ?>">Remove Image</a></span>
        <?php else: ?>
        <img src="<?php echo e(asset('admin_assets/images/no_image.jpg')); ?>" style="width:100%;height:180px;" alt="product" title="product" class="rounded"/>
        <?php endif; ?>

        </div>
        <div class="col-3 col-md-3">
        <input type="file" id="category_image_name3" name="category_image_name3" class="form-control-file" style="margin-top:100px;" >
        </div>
        
        <!-- Image  -->
        
        <div class="col-3 col-md-3">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Product Other Image</label>
        <?php if(isset($edit_product) && !empty($edit_product->category_image_name4)): ?>
        <img src="<?php echo e(asset('uploaded_files/product/'.$edit_product->category_image_name4)); ?>" style="width:100%;height:180px;" alt="product" title="product" class="rounded"/>
        <span><a href="<?php echo e(route('remove-product-image4', [$category_parent_id, $sub_cat_id, $final_cat_id, $edit_product->id])); ?>">Remove Back Image</a></span>
        <?php else: ?>
        <img src="<?php echo e(asset('admin_assets/images/no_image.jpg')); ?>" style="width:100%;height:180px;" alt="product" title="product" class="rounded"/>
        <?php endif; ?>

        </div>
        <div class="col-3 col-md-3">
        <input type="file" id="category_image_name4" name="category_image_name4" class="form-control-file" style="margin-top:100px;" >
        </div>
        
        </div>
        
<!-- Other Images -->
        <div class="row form-group">
        <div class="col-3 col-md-3">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Product Other Image</label>
        <?php if(isset($edit_product) && !empty($edit_product->category_image_name5)): ?>
        <img src="<?php echo e(asset('uploaded_files/product/'.$edit_product->category_image_name5)); ?>" style="width:100%;height:180px;" alt="product" title="product" class="rounded"/>
        <span><a href="<?php echo e(route('remove-product-image5', [$category_parent_id, $sub_cat_id, $final_cat_id, $edit_product->id])); ?>">Remove Image</a></span>
        <?php else: ?>
        <img src="<?php echo e(asset('admin_assets/images/no_image.jpg')); ?>" style="width:100%;height:180px;" alt="product" title="product" class="rounded"/>
        <?php endif; ?>

        </div>
        <div class="col-3 col-md-3">
        <input type="file" id="category_image_name5" name="category_image_name5" class="form-control-file" style="margin-top:100px;" >
        </div>
        
        
        </div>

          
        <div class="row form-group">
        <div class="col-6 col-md-8">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Category Banner</label>
        <?php if(isset($edit_product) && !empty($edit_product->category_inner_banner)): ?>
        <img src="<?php echo e(asset('uploaded_files/product/'.$edit_product->category_inner_banner)); ?>" style="width:100%;height:180px;" alt="category" title="category" class="rounded"/>
        <span><a href="<?php echo e(route('remove-product-banner', [$category_parent_id, $sub_cat_id, $final_cat_id, $edit_product->id])); ?>">Remove Banner</a></span>
        <?php else: ?>
        <img src="<?php echo e(asset('admin_assets/images/no-banner.jpg')); ?>" style="width:100%;height:200px;" alt="category" title="category" class="rounded"/>
        <?php endif; ?>

        </div>
        <div class="col-6 col-md-4">
        <input type="file" id="category_inner_banner" name="category_inner_banner" class="form-control-file" style="margin-top:100px;" >
        </div>
        </div>


        <div class="row form-group">
        <div class="col-12 col-md-5">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Product Name</label>
        <input type="text" id="category_name" name="category_name" placeholder="Enter Product Name" class="form-control" <?php if(isset($edit_product)): ?> value="<?php echo e($edit_product->category_name); ?>" <?php else: ?> value="<?php echo e(old('category_name')); ?>" <?php endif; ?> >
        </div>

        <div class="col-12 col-md-2">
        <label for="select" class=" form-control-label" style="font-weight:520"> Status</label>
        <select name="category_status" id="category_status" class="form-control">
        <option value="Active" <?php if(isset($edit_product)): ?> <?php if($edit_product->category_status=='Active'): ?> selected <?php endif; ?> <?php endif; ?> >Active</option>
        <option value="Inactive" <?php if(isset($edit_product)): ?> <?php if($edit_product->category_status=='Inactive'): ?> selected <?php endif; ?> <?php endif; ?>  >Inactive</option>
        </select>
        </div>

        <div class="col-12 col-md-2">
        <label for="select" class=" form-control-label" style="font-weight:520"> Product For</label>
       <select name="category_for" id="category_for" class="form-control">
        <option value="Gentle Man" <?php if(isset($edit_product)): ?> <?php if($edit_product->category_for=='Gentle Man'): ?> selected <?php endif; ?> <?php endif; ?> >Gentle Man</option>
        <option value="Woman" <?php if(isset($edit_product)): ?> <?php if($edit_product->category_for=='Woman'): ?> selected <?php endif; ?> <?php endif; ?>  >Woman</option>
        <option value="Junior" <?php if(isset($edit_product)): ?> <?php if($edit_product->category_for=='Junior'): ?> selected <?php endif; ?> <?php endif; ?>  >Junior</option>
        <option value="Unisex" <?php if(isset($edit_product)): ?> <?php if($edit_product->category_for=='Unisex'): ?> selected <?php endif; ?> <?php endif; ?>  >Unisex</option>
        </select>
        </div>
 <?php if(isset($edit_product)): ?>
 <?php if($copied_products->isNotEmpty() || !empty($edit_product->category_group_ids)): ?>
  <?php
   $group_ids = explode(',',$edit_product->category_group_ids);
  ?>
    <div class="col-12 col-md-3">
    <label for="select" class=" form-control-label" style="font-weight:520"> Group Products</label>
    <select class="selectpicker" name="category_group_ids[]" id="category_group_ids" multiple data-live-search="true">
       <?php $__currentLoopData = $copied_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($prd->id); ?>" <?php if(in_array($prd->id,$group_ids)): ?> selected <?php endif; ?>><?php echo e($prd->id); ?></option>
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    </div>
 <?php endif; ?>    
<?php endif; ?>
        </div>

    <div class="row form-group">
     
     <div class="col-12 col-md-3">
      <label for="text-input" class=" form-control-label" style="font-weight:520"> EAN Code</label>
     <input type="text" id="category_sku_code" name="category_sku_code" placeholder="Enter Product EAN Code" class="form-control" <?php if(isset($edit_product)): ?> value="<?php echo e($edit_product->category_sku_code); ?>" <?php else: ?> value="<?php echo e(old('category_sku_code')); ?>" <?php endif; ?> >
     </div>
     
     <div class="col-12 col-md-2">
      <label for="text-input" class=" form-control-label" style="font-weight:520"> Product Shape</label>
     <select name="shape" id="shape" class="form-control">
      <?php if($shapes->isNotEmpty()): ?>    
       <?php $__currentLoopData = $shapes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shape): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
        <option value="<?php echo e($shape->shape); ?>" <?php if(isset($edit_product)): ?> <?php if($edit_product->shape==$shape->shape): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo e($shape->shape); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       <?php endif; ?>
     </select>
     </div> 

     <div class="col-12 col-md-2">
      <label for="text-input" class=" form-control-label" style="font-weight:520">Product Type</label>
     <select name="type" id="type" class="form-control">
        <?php if($types->isNotEmpty()): ?>    
       <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
        <option value="<?php echo e($type->type); ?>" <?php if(isset($edit_product)): ?> <?php if($edit_product->type==$type->type): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo e($type->type); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       <?php endif; ?>

     </select>
     </div>

    <div class="col-12 col-md-2">
      <label for="text-input" class=" form-control-label" style="font-weight:520"> Material</label>
     <select name="material" id="material" class="form-control">
        <?php if($materials->isNotEmpty()): ?>    
       <?php $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
        <option value="<?php echo e($material->material); ?>" <?php if(isset($edit_product)): ?> <?php if($edit_product->material==$material->material): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo e($material->material); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       <?php endif; ?>

     </select>
     </div>
    
<?php
if(isset($edit_product)){
 $vision_ids = explode(',',$edit_product->visions);
}
?>     
     <div class="col-12 col-md-3">
      <label for="text-input" class=" form-control-label" style="font-weight:520"> Visions</label>
     <select name="visions[]" id="visions" class="selectpicker" multiple>
        <?php if($visions->isNotEmpty()): ?>    
       <?php $__currentLoopData = $visions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vision): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
        <option value="<?php echo e($vision->id); ?>" <?php if(isset($edit_product)): ?> <?php if(in_array($vision->id,$vision_ids)): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo e($vision->vision_name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       <?php endif; ?>

     </select>
     </div>

    </div>
    
    <div class="row form-group">
    
<div class="col-12 col-md-2">
<input type="checkbox" name="available_with_lens" id="available_with_lens" <?php if(isset($edit_product->available_with_lens)): ?> <?php if($edit_product->available_with_lens=="Yes"): ?> checked <?php endif; ?> <?php endif; ?>/>
<label for="select" class=" form-control-label" style="font-weight:520"> Available with lens?</label>

</div>
    
    <div class="col-12 col-md-2">
      <label for="text-input" class=" form-control-label" style="font-weight:520"> Frame Type</label>
     <select name="category_frame" id="category_frame" class="form-control">
        <option value="Eyeglasses" <?php if(isset($edit_product)): ?> <?php if($edit_product->category_frame=='Eyeglasses'): ?> selected <?php endif; ?> <?php endif; ?> >Eyeglasses</option>
        <option value="Sunglasses" <?php if(isset($edit_product)): ?> <?php if($edit_product->category_frame=='Sunglasses'): ?> selected <?php endif; ?> <?php endif; ?>  >Sunglasses</option>

     </select>
     </div>
    
    <div class="col-12 col-md-2">
      <label for="text-input" class=" form-control-label" style="font-weight:520"> Price</label>
     <input type="text" id="category_price" name="category_price" placeholder="Enter Product Price" class="form-control" <?php if(isset($edit_product)): ?> value="<?php echo e($edit_product->category_price); ?>" <?php else: ?> value="<?php echo e(old('category_price')); ?>" <?php endif; ?> >
     </div>
     
     <div class="col-12 col-md-2">
      <label for="text-input" class=" form-control-label" style="font-weight:520"> Discount Price</label>
     <input type="number" readonly class="form-control" <?php if(isset($edit_product)): ?> value="<?php echo e($edit_product->category_discount_price); ?>" <?php endif; ?> >
     </div> 
     
     <div class="col-12 col-md-2">
      <label for="text-input" class=" form-control-label" style="font-weight:520"> Quantity</label>
     <input type="number" min="0" id="category_qty" name="category_qty" placeholder="Enter Qty" class="form-control" <?php if(isset($edit_product)): ?> value="<?php echo e($edit_product->category_qty); ?>" <?php else: ?> value="<?php echo e(old('category_qty')); ?>" <?php endif; ?> >
     </div>
     
     <div class="col-12 col-md-2">
      <label for="text-input" class=" form-control-label" style="font-weight:520"> UAN Code</label>
     <input type="text" id="category_uan_code" name="category_uan_code" placeholder="Enter UAN Code" class="form-control" <?php if(isset($edit_product)): ?> value="<?php echo e($edit_product->category_uan_code); ?>" <?php else: ?> value="<?php echo e(old('category_uan_code')); ?>" <?php endif; ?> >
     </div>
     
    </div>
    
<div class="row form-group">
 <div class="col-12 col-md-3">
<label for="text-input" class=" form-control-label" style="font-weight:520"> Min Sphere</label>
<?php
$prescription_data = DB::table('prescription_data')->where('sph_left','!=','')->get();
?> 
<select name="min_sph" class="form-control min_sph">
<option value="">-- Select SPH (MIN) --</option>
<?php $__currentLoopData = $prescription_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(isset($edit_product)): ?>
 <option value="<?php echo e($data->sph_left); ?>" <?php if($edit_product->min_sph==$data->sph_left): ?> selected <?php endif; ?> ><?php echo e($data->sph_left); ?></option>
<?php else: ?>
<option value="<?php echo e($data->sph_left); ?>" <?php if(old('min_sph')==$data->sph_left): ?> selected <?php endif; ?> ><?php echo e($data->sph_left); ?></option>
<?php endif; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
 </div>  

<div class="col-12 col-md-3">
<label for="text-input" class=" form-control-label" style="font-weight:520">Max Sphere</label>
<select name="max_sph" class="form-control max_sph">
<option value="">-- Select SPH (MAX) --</option>
<?php $__currentLoopData = $prescription_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(isset($edit_product)): ?>
 <option value="<?php echo e($data->sph_left); ?>" <?php if($edit_product->max_sph==$data->sph_left): ?> selected <?php endif; ?>><?php echo e($data->sph_left); ?></option>
<?php else: ?>
 <option value="<?php echo e($data->sph_left); ?>" <?php if(old('max_sph')==$data->sph_left): ?> selected <?php endif; ?>><?php echo e($data->sph_left); ?></option>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
</div>     
    
<div class="col-12 col-md-3">
<label for="text-input" class=" form-control-label" style="font-weight:520">Min Cylinder</label>
<?php
$prescription_data = DB::table('prescription_data')->where('cyl_left','!=','')->get();
?>         
<select name="min_cyl" class="form-control min_cyl">
<option value="">-- Select CYL (MIN) --</option>
<?php $__currentLoopData = $prescription_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(isset($edit_product)): ?>
 <option value="<?php echo e($data->cyl_left); ?>" <?php if($edit_product->min_cyl==$data->cyl_left): ?> selected <?php endif; ?> ><?php echo e($data->cyl_left); ?></option>
<?php else: ?>
 <option value="<?php echo e($data->cyl_left); ?>" <?php if(old('min_cyl')==$data->cyl_left): ?> selected <?php endif; ?> ><?php echo e($data->cyl_left); ?></option>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
        </div>

<div class="col-12 col-md-3">
<label for="text-input" class=" form-control-label" style="font-weight:520">Max Cylinder</label>
<select name="max_cyl" class="form-control max_cyl">
<option value="">-- Select CYL (MAX) --</option>
<?php $__currentLoopData = $prescription_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(isset($edit_product)): ?>
 <option value="<?php echo e($data->cyl_left); ?>" <?php if($edit_product->max_cyl==$data->cyl_left): ?> selected <?php endif; ?> ><?php echo e($data->cyl_left); ?></option>
<?php else: ?>
 <option value="<?php echo e($data->cyl_left); ?>" <?php if(old('max_cyl')==$data->cyl_left): ?> selected <?php endif; ?> ><?php echo e($data->cyl_left); ?></option>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
</div>    
     
</div>    

<div class="row form-group">
<div class="col-4 col-md-4">
<label for="text-input" class=" form-control-label" style="font-weight:520">
    Lens Type</label> <br>   
<select class="selectpicker" name="lens_type[]" multiple>
 <?php $__currentLoopData = $lens_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <option value="<?php echo e($data->id); ?>" <?php if(isset($edit_product)): ?> <?php if(!empty($edit_lens_type)): ?> <?php if(in_array($data->id,$edit_lens_type)): ?> selected <?php endif; ?> <?php endif; ?> <?php endif; ?>><?php echo e($data->lens_type); ?></option>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>    
</div> 

<div class="col-4 col-md-4">
<label for="text-input" class=" form-control-label" style="font-weight:520">
    Extra</label> <br>   
<select class="selectpicker" name="extra[]" multiple>
 <?php $__currentLoopData = $extras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <option value="<?php echo e($data->id); ?>" <?php if(isset($edit_product)): ?> <?php if(!empty($edit_extra)): ?> <?php if(in_array($data->id,$edit_extra)): ?> selected <?php endif; ?> <?php endif; ?> <?php endif; ?>><?php echo e($data->extra); ?></option>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>    
</div> 

</div>    

<div class="row form-group">
<div class="col-12 col-md-12">
<label for="text-input" class=" form-control-label" style="font-weight:520">Product Short Description</label>
<textarea name="category_short_description" id="category_short_description" cols="15" rows="4" class="form-control"><?php if(isset($edit_product) && !empty($edit_product->category_short_description)): ?><?php echo e($edit_product->category_short_description); ?><?php else: ?><?php echo e(old('category_short_description')); ?><?php endif; ?></textarea>
</div>
</div>


<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'category_short_description' );
</script>

        <div class="row form-group">
        <div class="col-12 col-md-12">
        <label for="text-input" class=" form-control-label" style="font-weight:520"> Product Description</label>
        <textarea name="category_description" id="category_description" cols="30" rows="10" class="form-control"><?php if(isset($edit_product) && !empty($edit_product->category_description)): ?><?php echo e($edit_product->category_description); ?><?php else: ?><?php echo e(old('category_description')); ?><?php endif; ?></textarea>
        </div>

        </div>

    
        <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'category_description' );
        </script>

 

    <div class="jumbotron" id="cat_jumbotron"><h4>Frame Dimension Information</h4></div>

    <div class="row form-group">
        <div class="col-2 col-md-2">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Lens Width</label>
        <input type="text" id="category_lens_width" name="category_lens_width" placeholder="Enter Lens Width" class="form-control" <?php if(isset($edit_product)): ?> value="<?php echo e($edit_product->category_lens_width); ?>" <?php else: ?> value="<?php echo e(old('category_lens_width')); ?>" <?php endif; ?> >
        </div>
        
        <div class="col-2 col-md-2">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Bridge</label>
        <input type="text" id="category_bridge" name="category_bridge" placeholder="Enter Bridge" class="form-control" <?php if(isset($edit_product)): ?> value="<?php echo e($edit_product->category_bridge); ?>" <?php else: ?> value="<?php echo e(old('category_bridge')); ?>" <?php endif; ?> >
        </div>
        
        <div class="col-2 col-md-2">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Arm Length</label>
        <input type="text" id="category_arm_length" name="category_arm_length" placeholder="Enter Arm Length" class="form-control" <?php if(isset($edit_product)): ?> value="<?php echo e($edit_product->category_arm_length); ?>" <?php else: ?> value="<?php echo e(old('category_arm_length')); ?>" <?php endif; ?> >
        </div>
        
        <div class="col-2 col-md-2">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Lens Height</label>
        <input type="text" id="category_lens_height" name="category_lens_height" placeholder="Enter Lens Height" class="form-control" <?php if(isset($edit_product)): ?> value="<?php echo e($edit_product->category_lens_height); ?>" <?php else: ?> value="<?php echo e(old('category_lens_height')); ?>" <?php endif; ?> >
        </div>
        
        <div class="col-2 col-md-2">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Total Width</label>
        <input type="text" id="category_total_width" name="category_total_width" placeholder="Enter Total Width" class="form-control" <?php if(isset($edit_product)): ?> value="<?php echo e($edit_product->category_total_width); ?>" <?php else: ?> value="<?php echo e(old('category_total_width')); ?>" <?php endif; ?> >
        </div>
        
    </div>
    
    

    <div class="jumbotron" id="cat_jumbotron"><h4>Frame Color Information</h4></div>

    <div class="row form-group">
       
       <div class="col-5 col-md-5">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Color</label>
        <?php if($product_colors->isNotEmpty()): ?>
         <select class="form-control" name="category_color" id="category_color">
           <?php $__currentLoopData = $product_colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($color->id); ?>" <?php if(isset($edit_product)): ?> <?php if($edit_product->category_color==$color->id): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e($color->color_name); ?> </option>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </select>
        <?php endif; ?>
        </div>
   
    </div>

    

    <div class="jumbotron" id="cat_jumbotron"><h4>SEO related information</h4></div>

    <div class="row form-group">
        <div class="col-12 col-md-12">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Product Meta Title</label>
        <input type="text" id="category_meta_title" name="category_meta_title" placeholder="Enter Product Meta Title" class="form-control" <?php if(isset($edit_product)): ?> value="<?php echo e($edit_product->category_meta_title); ?>" <?php else: ?> value="<?php echo e(old('category_meta_title')); ?>" <?php endif; ?> >
        </div>
    </div>

    <div class="row form-group">
        <div class="col-12 col-md-12">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Product Meta Keywords</label>
        <input type="text" id="category_meta_keywords" name="category_meta_keywords" placeholder="Enter Product Meta Keywords" class="form-control" <?php if(isset($edit_product)): ?> value="<?php echo e($edit_product->category_meta_keywords); ?>" <?php else: ?> value="<?php echo e(old('category_meta_keywords')); ?>" <?php endif; ?> >
        </div>
    </div>

    <div class="row form-group">
        <div class="col-12 col-md-12">
        <label for="text-input" class=" form-control-label" style="font-weight:520">Product Meta Description</label>
        <textarea name="category_meta_description" id="category_meta_description" cols="20" rows="5" class="form-control" placeholder="Enter Product Meta Description"><?php if(isset($edit_product) && !empty($edit_product->category_meta_description)): ?><?php echo e($edit_product->category_meta_description); ?><?php else: ?><?php echo e(old('category_meta_description')); ?><?php endif; ?></textarea>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/admin/addedit-product.blade.php ENDPATH**/ ?>