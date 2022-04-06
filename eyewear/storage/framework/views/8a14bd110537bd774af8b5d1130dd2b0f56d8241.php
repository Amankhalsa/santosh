
<style>
 .disable-sec{
     background-color:#fafbed;
 }    
</style>

<?php
 $meta_title = $meta_description = $meta_keywords = "";
 $meta_title = "{$product_data->category_name} | {$admin_data->admin_company_name}";
 $meta_description = "{$product_data->category_name} Meta Description";
 $meta_keywords = "{$product_data->category_name} Meta Keywords";
?>

 <?php $__env->startSection('title',$meta_title); ?>
 <?php $__env->startSection('description',$meta_description); ?>
 <?php $__env->startSection('keywords',$meta_keywords); ?>

 

 <?php $__env->startSection('content'); ?>

<div class="container-fluid">
<section class="row rht">
<!-- left column -->
<div class="col-lg-4 col-md-4 col-12" style="padding:0px 60px">
<div class="row">
    <!-- back to home -->
    <div class="col-12 left-cont-back">
        <a href="<?php echo e(url('/frame/'.$product_data->category_slug_name.'.html')); ?>">
            < Back To Frame Description </a>
</div>
<!-- product image -->
<div class="col-12 left-cont-product">
<div class="pro-image">
    <img src="<?php echo e(asset('uploaded_files/product/'.$product_data->category_image_name)); ?>" alt="<?php echo e($product_data->category_name); ?>" title="<?php echo e($product_data->category_name); ?>"/>
</div>
<?php
  $b_name = DB::table('categories')->where('id',$product_data->category_parent_id)->select('category_name','category_slug_name')->first();
 ?>
<div class="pro-description">
    <h5><strong>Brand:</strong> <?php echo e($b_name->category_name); ?></h5>
    <h5><strong><?php echo e($product_data->category_name); ?></strong></h5>
    <p><?php echo e($product_data->category_uan_code); ?></p>
    <p><strong>EAN:</strong> <?php echo e($product_data->category_sku_code); ?></p>
    
    <h5>SubTotal:<strong><?php echo e(getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$product_data->category_discount_price)); ?></strong></h5>
</div>
</div>
</div>
</div>
<!-- left column end -->

<style>


</style>

<!-- right column -->
<div class="col-lg-8 col-md-8 col-12">
<div class="row right-side">
<!-- navigation selection -->
<div class="col-12 left-cont-back">
<ul class="upper-nav">
    
<li><a id="first-nav" class="navactive" href="javascript:void(0)" onclick="bynavtokken('first-nav')"></a></li>

<li><a id="second-nav" href="javascript:void(0)" onclick="bynavtokken(this.id)"></a></li>

<li><a id="third-nav" href="javascript:void(0)" onclick="bynavtokken(this.id)"></a></li>

<li><a id="fourth-nav" href="javascript:void(0)" onclick="bynavtokken(this.id)"></a></li>

<li><a id="fifth-nav" href="javascript:void(0)" onclick="bynavtokken(this.id)"></a></li>

<li><a id="sixth-nav" href="javascript:void(0)" onclick="bynavtokken(this.id)"></a></li>

</ul>
<hr class="setul" />
</div>
    <!-- navigation selection description -->
    <div class="col-12 left-cont-product">
<input type="hidden" name="product_id" class="product_id" value="<?php echo e($product_id); ?>">
   <input type="hidden" name="qty" class="qty" value="<?php echo e($prd_qty); ?>">
   <input type="hidden" name="vision_id" class="vision_id">        
<!-- SECTION VISION START -->

<div class="first-card" id="first-card">
<div class="row mt-5 mb-5">
     <div class="col-md-12 text-center">
         <h2 class="page_speed_693368138" style="font-weight: 900;">Usage</h2>
         
         
     </div>
 </div>
<?php
$i=1;
$product_visions = explode(',',$product_data->visions);
 $visions = DB::table('visions')->where('vision_parent_id','0')->get();
?>  
 <?php $__currentLoopData = $visions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vision): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php 
$check_subvision = DB::table('visions')->where('vision_parent_id',$vision->id)->count();
?>
<?php if($check_subvision>0): ?>    
<div class="row desc-card <?php if(in_array($vision->id,$product_visions)): ?> putdown<?php echo e($i); ?> <?php else: ?> disable-sec <?php endif; ?>" <?php if(!in_array($vision->id,$product_visions)): ?> style="cursor:no-drop" <?php endif; ?>>
    <div class="col-lg-2 col-md-4 col-4">
        <img src="<?php echo e(asset('uploaded_files/vision/'.$vision->vision_image_name)); ?>" alt="<?php echo e($product_data->category_name); ?>" title="<?php echo e($product_data->category_name); ?>" width="50px" height="50px" />
    </div>
    <div class="col-lg-8 col-md-6 col-6">
        <h4><?php echo e($vision->vision_name); ?></h4>
        <p><?php echo e($vision->vision_tag_line); ?></p>
    </div>
<?php if(!in_array($vision->id,$product_visions)): ?>
 <div class="col-md-2 col-2">
<div class="popup">
    <i class="fa fa-info"></i>
    <span class="popuptext" id="myPopup"><?php echo $vision->vision_disable_description; ?></span>
</div>
</div>
<?php else: ?>
<?php if(!empty($vision->vision_description)): ?>    
    <div class="col-md-2 col-2">
    <div class="popup">
        <i class="fa fa-info"></i>
        <span class="popuptext" id="myPopup"><?php echo $vision->vision_description; ?></span>
    </div>
    </div>
 <?php endif; ?>
<?php endif; ?>
</div>
<!-- sub nav  -->
<div class="puttingdown<?php echo e($i); ?>" style="display: none">
<?php
$subvisions = DB::table('visions')->where('vision_parent_id',$vision->id)->get();
?> 
<?php $__currentLoopData = $subvisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subvision): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
<div id="crdsub" class="row desc-card" onclick="getPrescription('<?php echo e($subvision->id); ?>')">
<div class="col-lg-2 col-md-4 col-4">
    <img src="<?php echo e(asset('uploaded_files/vision/'.$subvision->vision_image_name)); ?>" alt="<?php echo e($product_data->category_name); ?>" title="<?php echo e($product_data->category_name); ?>" width="50px" height="50px" />
</div>
<div class="col-lg-8 col-md-6 col-6">
<h4><?php echo e($subvision->vision_name); ?> 
<?php if($subvision->vision_price>0): ?>
<?php echo e(getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$subvision->vision_price)); ?>

<?php endif; ?>
</h4>
</div>
<?php if(!empty($subvision->vision_description)): ?>
<div class="col-md-2 col-2">
<div class="popup">
    <i class="fa fa-info"></i>
    <span class="popuptext" id="myPopup"><?php echo e($subvision->vision_description); ?></span>
</div>
</div>
<?php endif; ?>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
<!-- sub nav end-->
<?php else: ?>
<div class="row desc-card <?php if(!in_array($vision->id,$product_visions)): ?> disable-sec <?php endif; ?>" <?php if(!in_array($vision->id,$product_visions)): ?> disabled style="cursor:no-drop;" <?php else: ?>  onclick="getPrescription('<?php echo e($vision->id); ?>')" style="cursor:pointer;" <?php endif; ?> >
    <div class="col-lg-2 col-md-4 col-4">
        <img src="<?php echo e(asset('uploaded_files/vision/'.$vision->vision_image_name)); ?>" alt="<?php echo e($product_data->category_name); ?>" title="<?php echo e($product_data->category_name); ?>" width="50px" height="50px" />
    </div>
    <div class="col-lg-8 col-md-6 col-6">
        <h4><?php echo e($vision->vision_name); ?></h4>
        <p><?php echo e($vision->vision_tag_line); ?></p>
    </div>

<?php if(!in_array($vision->id,$product_visions)): ?>    
<div class="col-md-2 col-2">
<div class="popup">
    <i class="fa fa-info"></i>
    <span class="popuptext" id="myPopup"><?php echo $vision->vision_disable_description; ?></span>
</div>
</div>
<?php else: ?>
 <?php if(!empty($vision->vision_description)): ?>
 
    <div class="col-md-2 col-2">
    <div class="popup"> 
    <i class="fa fa-info"></i>
    <span class="popuptext" id="myPopup"><?php echo $vision->vision_description; ?></span>
    </div>
    </div>
 
 <?php endif; ?>
<?php endif; ?>

</div>
<?php endif; ?>

<?php
   $i++;
  ?>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<!-- ##################### SECTION VISION END ############################## -->

       
<!-- ##################### SECTION PRESCRIPTION START ###################### -->
<?php
$prescription_array = Session::get('prescription_array');
?>
<div class="second-card" id="second-card" style="display: none">
 <div class="row mt-5 mb-5">
     <div class="col-md-12 text-center">
         <h2 style="font-weight:900;">Prescription</h2>
<?php if(!empty($admin_data->admin_prescription_desc)): ?>
<div class="popup info-posi">
<i class="fa fa-info"></i>
<span class="popuptext" id="myPopup"><?php echo $admin_data->admin_prescription_desc; ?></span>
</div>
<?php endif; ?>
         
         
     </div>
 </div>
<div class="row hide-prescription-fields">
<div class="col-12" style="margin-bottom: 10px">
<div class="row">
<div class="col-lg-2 col-md-4 col-12" style="line-height: 0; text-align: center">
<h4><strong>OD</strong></h4>
<p>(Right Eye)</p>
</div>
<div class="col-lg-10 col-md-8 col-12">
<div class="row">
<div class="col-lg-3 col-md-6 col-12">
<h5 style="font-size: 20px"><center>Sphere (SPH)</center></h5>
<select name="sph_right" class="form-control sph_right" id="sph_right">
<?php
$prescription_data = DB::table('prescription_data')->where('sph_right','!=','')->whereRaw("sph_right Between $product_data->min_sph AND '$product_data->max_sph' ")->get();
?> 
<?php $__currentLoopData = $prescription_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(!empty($prescription_array['sph_right'])): ?>
 <option value="<?php echo e($data->sph_right); ?>" <?php if($data->sph_right==$prescription_array['sph_right']): ?> selected <?php endif; ?> ><?php echo e($data->sph_right); ?></option>
<?php else: ?>
<option value="<?php echo e($data->sph_right); ?>" <?php if($data->sph_right=="0.00"): ?> selected <?php endif; ?> ><?php echo e($data->sph_right); ?></option>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
</div>
<div class="col-lg-3 col-md-6 col-12">
<h5 style="font-size: 20px"><center>Cylinder (CYL)</center></h5>
<select name="cyl_right" class="form-control cyl_right" id="cyl_right">
<?php
$prescription_data = DB::table('prescription_data')->where('cyl_right','!=','')->whereRaw("cyl_right Between $product_data->min_cyl AND '$product_data->max_cyl' ")->get();
?>      
        
<?php $__currentLoopData = $prescription_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(!empty($prescription_array['cyl_right'])): ?>
 <option value="<?php echo e($data->cyl_right); ?>" <?php if($data->cyl_right==$prescription_array['cyl_right']): ?> selected <?php endif; ?>><?php echo e($data->cyl_right); ?></option>
<?php else: ?>
<option value="<?php echo e($data->cyl_right); ?>" <?php if($data->cyl_right=="0.00"): ?> selected <?php endif; ?>><?php echo e($data->cyl_right); ?></option>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
</div>
<div class="col-lg-3 col-md-6 col-12">
<h5 style="font-size: 20px"><center>Axis</center></h5>
<select name="axis_right" class="form-control axis_right" id="axis_right">

<?php
$prescription_data = DB::table('prescription_data')->where('axis_right','!=','')->get();
?>      
<option value="">-- Select AXIS (R) --</option>
<?php $__currentLoopData = $prescription_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(!empty($prescription_array['axis_right'])): ?>
<option value="<?php echo e($data->axis_right); ?>" <?php if($prescription_array['axis_right']==$data->axis_right): ?> selected <?php endif; ?>><?php echo e($data->axis_right); ?></option>
<?php else: ?>
<option value="<?php echo e($data->axis_right); ?>"><?php echo e($data->axis_right); ?></option>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
</div>
<div class="col-lg-3 col-md-6 col-12">
<h5 style="font-size: 20px"><center>Add</center></h5>
<select name="add_right" class="form-control add_right" id="add_right" >
<?php
$prescription_data = DB::table('prescription_data')->where('add_right','!=','')->get();
?>      
<option value="">n/a</option>
<?php $__currentLoopData = $prescription_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <option value="<?php echo e($data->add_right); ?>"><?php echo e($data->add_right); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
</div>
</div>
</div>
</div>
</div>
<div class="col-12">
<div class="row">
<div class="col-lg-2 col-md-4 col-12" style="line-height: 0; text-align: center">
<h4><strong>OS</strong></h4>
<p>(Left Eye)</p>
</div>
<div class="col-lg-10 col-md-8 col-12">
<div class="row">
<div class="col-lg-3 col-md-6 col-12">
<h5 style="font-size: 20px"><center>Sphere (SPH)</center></h5>
<select name="sph_left" class="form-control sph_left" id="sph_left">
<?php
$prescription_data = DB::table('prescription_data')->where('sph_left','!=','')->whereRaw("sph_left Between $product_data->min_sph AND '$product_data->max_sph' ")->get();
?>      
<?php $__currentLoopData = $prescription_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(!empty($prescription_array['sph_left'])): ?>
 <option value="<?php echo e($data->sph_left); ?>" <?php if($prescription_array['sph_left']==$data->sph_left): ?> selected <?php endif; ?>><?php echo e($data->sph_left); ?></option>
<?php else: ?>
 <option value="<?php echo e($data->sph_left); ?>" <?php if($data->sph_left=="0.00"): ?> selected <?php endif; ?>><?php echo e($data->sph_left); ?></option>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
</div>
<div class="col-lg-3 col-md-6 col-12">
<h5 style="font-size: 20px"><center>Cylinder (CYL)</center></h5>
<select name="cyl_left" class="form-control cyl_left" id="cyl_left">
<?php
$prescription_data = DB::table('prescription_data')->where('cyl_left','!=','')->whereRaw("cyl_left Between $product_data->min_cyl AND '$product_data->max_cyl' ")->get();
?>      
  
<?php $__currentLoopData = $prescription_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(!empty($prescription_array['cyl_left'])): ?>
<option value="<?php echo e($data->cyl_left); ?>" <?php if($prescription_array['cyl_left']==$data->cyl_left): ?> selected <?php endif; ?>><?php echo e($data->cyl_left); ?></option>
<?php else: ?>
<option value="<?php echo e($data->cyl_left); ?>" <?php if($data->cyl_left=="0.00"): ?> selected <?php endif; ?>><?php echo e($data->cyl_left); ?></option>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
</div>
<div class="col-lg-3 col-md-6 col-12">
<h5 style="font-size: 20px"><center>Axis</center></h5>
<select name="axis_left" class="form-control axis_left" id="axis_left">
<?php
$prescription_data = DB::table('prescription_data')->where('axis_left','!=','')->get();
?>      
<option value="">-- Select AXIS (L) --</option>
<?php $__currentLoopData = $prescription_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(!empty($prescription_array['axis_left'])): ?>
 <option value="<?php echo e($data->axis_left); ?>" <?php if($prescription_array['axis_left']==$data->axis_left): ?> selected <?php endif; ?>><?php echo e($data->axis_left); ?></option>
<?php else: ?>
 <option value="<?php echo e($data->axis_left); ?>"><?php echo e($data->axis_left); ?></option>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
</div>
<div class="col-lg-3 col-md-6 col-12">
<h5 style="font-size: 20px"><center>Add</center></h5>
<select name="add_left" class="form-control add_left" >
<?php
$prescription_data = DB::table('prescription_data')->where('add_left','!=','')->get();
?>      
<option value="">n/a</option>
<?php $__currentLoopData = $prescription_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <option value="<?php echo e($data->add_left); ?>"><?php echo e($data->add_left); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="row hide-prescription-fields" style="margin-top: 50px">
<div class="col-lg-2 col-md-4 col-3">
<h5>Pupillary Distance</h5>

</div>
<div class="col-lg-8 col-md-6 col-7">
    <div  class="row">
<div class="col-6">
<div id="showpd1">
<select name="pupillary_distance" class="form-control pupillary_distance">
<?php
$prescription_data = DB::table('prescription_data')->where('pupillary_distance','!=','')->get();
?>      
<?php $__currentLoopData = $prescription_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(!empty($prescription_array['pupillary_distance'])): ?>
 <option value="<?php echo e($data->pupillary_distance); ?>" <?php if($data->pupillary_distance==$prescription_array['pupillary_distance']): ?> selected <?php endif; ?>><?php echo e($data->pupillary_distance); ?></option>
<?php else: ?>
 <option value="<?php echo e($data->pupillary_distance); ?>" <?php if($data->pupillary_distance=="63"): ?> selected <?php endif; ?>><?php echo e($data->pupillary_distance); ?></option>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
</div>
</div>
<div class="col-6">
<span><input type="checkbox" name="check-pd" id="check-pd" class="check-pd" onclick="check_two_pd()"/>
Two PD ?</span>
<input type="hidden" name="is_pd2" id="is_pd2" class="is_pd2" value="No"/>
</div>

</div>
<div class="row">
    <div class="col-lg-12">
<div id="showpd2" style="display: none">
    <div class="row">
<div class="col-lg-6 col-12">
<p>Pupillary Distance (R)</p>
<select name="pupillary_distance_right" class="form-control pupillary_distance_right">
<?php
$prescription_data = DB::table('prescription_data')->where('pupillary_distance_right','!=','')->get();
?>      
<option value="">-- Select Pupillary Distance --</option>
<?php $__currentLoopData = $prescription_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <option value="<?php echo e($data->pupillary_distance_right); ?>" <?php if($data->pupillary_distance_right=='31.5'): ?> selected <?php endif; ?>><?php echo e($data->pupillary_distance_right); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
</div>
<div class="col-lg-6 col-12">
<p>Pupillary Distance (L)</p>
<select name="pupillary_distance_left" class="form-control pupillary_distance_left">
<?php
$prescription_data = DB::table('prescription_data')->where('pupillary_distance_left','!=','')->get();
?>      
  <option value="">-- Select Pupillary Distance --</option>
  <?php $__currentLoopData = $prescription_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <option value="<?php echo e($data->pupillary_distance_left); ?>" <?php if($data->pupillary_distance_left=='31.5'): ?> selected <?php endif; ?>><?php echo e($data->pupillary_distance_left); ?></option>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="col-lg-2 col-md-2 col-2">
    <?php if(!empty($admin_data->admin_prescription_pd_desc)): ?>
<div class="popup info-posi">
<i class="fa fa-info"></i>
<span class="popuptext" id="myPopup"><?php echo $admin_data->admin_prescription_pd_desc; ?></span>
</div>
<?php endif; ?>
</div>
</div>

<?php if($admin_data->is_prism=="Yes"): ?>
<input type="hidden" name="is_prism" class="is_prism" value="No" />
<div class="row hide-prescription-fields">
<div class="col-lg-12 col-12">
<p>
<input type="checkbox" name="prism_checkbox" class="prism_checkbox" id="togprism" onclick="isPrism()" />Add Prism
<strong><?php echo e(getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$admin_data->prism_price)); ?></strong>
</p>
</div>
<div class="col-lg-12 col-12" id="prismadd" style="display: none">
<div class="row">
<div class="col-12" style="margin-bottom: 10px">
<div class="row">
<div class="col-lg-2 col-md-2 col-12" style="line-height: 0; text-align: center">
<h4><strong>OD</strong></h4>
<p>(Right Eye)</p>
</div>
<div class="col-lg-10 col-md-10 col-12">
<div class="row">
<div class="col-lg-3 col-md-6 col-12">
    <h5 style="font-size: 20px">Vertical (Δ)</h5>
    <select name="prism_right_vertical" class="form-control prism_right_vertical">

        <option value="">n/a</option>
        <option value="0.50">0.50</option>
        <option value="1.00">1.00</option>
        <option value="1.50">1.50</option>
        <option value="2.00">2.00</option>
        <option value="2.50">2.50</option>
        <option value="3.00">3.00</option>
        <option value="3.50">3.50</option>
        <option value="4.00">4.00</option>
        <option value="4.50">4.50</option>
        <option value="5.00">5.00</option>

    </select>
</div>
<div class="col-lg-3 col-md-6 col-12">
    <h5 style="font-size: 20px">
        Base Direction</h5>
    <select name="prism_right_vertical_direction"
        class="form-control prism_right_vertical_direction">

        <option value="">n/a</option>
        <option value="Up">Up</option>
        <option value="Down">Down</option>

    </select>
</div>
<div class="col-lg-3 col-md-6 col-12">
    <h5 style="font-size: 20px">Horizontal (Δ)</h5>
    <select name="prism_right_horizontal" class="form-control prism_right_horizontal">
        <option value="">n/a</option>
        <option value="0.50">0.50</option>
        <option value="1.00">1.00</option>
        <option value="1.50">1.50</option>
        <option value="2.00">2.00</option>
        <option value="2.50">2.50</option>
        <option value="3.00">3.00</option>
        <option value="3.50">3.50</option>
        <option value="4.00">4.00</option>
        <option value="4.50">4.50</option>
        <option value="5.00">5.00</option>

    </select>
</div>
<div class="col-lg-3 col-md-6 col-12">
    <h5 style="font-size: 20px">
        Base Direction</h5>
    <select name="prism_right_horizontal_direction"
        class="form-control prism_right_horizontal_direction">

        <option value="">n/a</option>
        <option value="Up">Up</option>
        <option value="Down">Down</option>
    </select>
</div>
</div>
</div>
</div>
</div>
<div class="col-12">
<div class="row">
<div class="col-lg-2 col-md-2 col-12" style="line-height: 0; text-align: center">
<h4><strong>OS</strong></h4>
<p>(Left Eye)</p>
</div>
<div class="col-lg-10 col-md-10 col-12">
<div class="row">
<div class="col-lg-3 col-md-6 col-12">
    <h5 style="font-size: 20px">Vertical (Δ)</h5>
    <select name="prism_left_vertical" class="form-control prism_left_vertical">
        <option value="">n/a</option>
        <option value="0.50">0.50</option>
        <option value="1.00">1.00</option>
        <option value="1.50">1.50</option>
        <option value="2.00">2.00</option>
        <option value="2.50">2.50</option>
        <option value="3.00">3.00</option>
        <option value="3.50">3.50</option>
        <option value="4.00">4.00</option>
        <option value="4.50">4.50</option>
        <option value="5.00">5.00</option>

    </select>
</div>
<div class="col-lg-3 col-md-6 col-12">
    <h5 style="font-size: 20px">Base Direction</h5>
    <select name="prism_left_vertical_direction"
        class="form-control prism_left_vertical_direction">

        <option value="">n/a</option>
        <option value="Up">Up</option>
        <option value="Down">Down</option>

    </select>
</div>
<div class="col-lg-3 col-md-6 col-12">
    <h5 style="font-size: 20px">
        Horizontal (Δ)</h5>
    <select name="prism_left_horizontal" class="form-control prism_left_horizontal">
        <option value="">n/a</option>
        <option value="0.50">0.50</option>
        <option value="1.00">1.00</option>
        <option value="1.50">1.50</option>
        <option value="2.00">2.00</option>
        <option value="2.50">2.50</option>
        <option value="3.00">3.00</option>
        <option value="3.50">3.50</option>
        <option value="4.00">4.00</option>
        <option value="4.50">4.50</option>
        <option value="5.00">5.00</option>

    </select>
</div>
<div class="col-lg-3 col-md-6 col-12">
    <h5 style="font-size: 20px">Base Direction</h5>
    <select name="prism_left_horizontal_direction"
        class="form-control prism_left_horizontal_direction">

        <option value="">n/a</option>
        <option value="Up">Up</option>
        <option value="Down">Down</option>

    </select>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php endif; ?>
<div class="row">
<div class="col-lg-6 hide-prescription-fields">
    <h5 style="font-size: 20px">Enter Your Message</h5> 
<textarea name="prescription_comment" id="prescription_comment" class="prescription_comment"></textarea>
</div>

<div class="col-lg-6">
<h5 style="font-size: 20px">Or Upload Prescription ?</h5>    
<form method="post" class="upload_prescription_form" enctype="multipart/form-data"> 
<input type="file" name="upload_prescription" class="form-control upload_prescription" style="height:80px;">
<input type="hidden" name="is_prescription_upload" class="is_prescription_upload" value="No">
</form>
</div>

</div>
<div class="row">
<!-- dynamic button <button id="pressubmit" onclick="tokkenset('second-card')" style="display:none;">Confirm</button> -->
<button id="pressubmit" onclick="prescription('add')">Confirm</button>
</div>
</div>

<!-- ##################### SECTION PRESCRIPTION END ######################## -->

<!-- ################## SECTION LENS COLOR TYPE START ###################### -->

<div class="third-card" id="third-card" style="display: none">
 <div class="row mt-5 mb-5">
     <div class="col-md-12 text-center">
         <h2 style="font-weight:900;">Lens Color Type</h2>
     </div>
 </div>
<?php
$i=1;
 $color_types = DB::table('lens_color_types')->where('category_parent_id','0')->where('category_status','Active')->orderBy('category_order_by')->get();
?>  
 <?php $__currentLoopData = $color_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php 
$check_subcolor = DB::table('lens_color_types')->where('category_status','Active')->where('category_parent_id',$type->id)->count();
?>
<?php if($check_subcolor>0): ?>

<div class="row desc-card putdown<?php echo e($i); ?>">
<div class="col-lg-2 col-md-4 col-4">
<img src="<?php echo e(asset('uploaded_files/lens/'.$type->category_image_name)); ?>" alt="<?php echo e($product_data->category_name); ?>" title="<?php echo e($product_data->category_name); ?>" width="50px" height="50px" />
</div>
<div class="col-lg-8 col-md-6 col-6">
<h4><?php echo e($type->category_name); ?></h4>
<p><?php echo e($type->category_tag_line); ?></p>
</div>

<?php if(!empty($type->category_description)): ?>
<div class="col-md-2 col-2">
<div class="popup">
<i class="fa fa-info"></i>
<span class="popuptext" id="myPopup"><?php echo $type->category_description; ?></span>
</div>
</div>
<?php endif; ?>

</div>
<!-- sub nav  -->
<div class="puttingdown<?php echo e($i); ?>" style="display: none">

<?php
$subcolor_types = DB::table('lens_color_types')->where('category_status','Active')->where('category_parent_id',$type->id)->get();
?>    
  <?php $__currentLoopData = $subcolor_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcolor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div id="crdsub" class="row desc-card">
<div class="col-10">
<div class="row">
<div class="col-12">
<h4><?php echo e($subcolor->category_name); ?></h4>
<h4><?php echo e(getCurrencySymbol($ip_country).getCurrencyPrice($ip_country,$subcolor->category_price)); ?></h4>
</div>
<div class="col-12 clr-img-cont">
<div class="row">
<?php
$color_tints_count=DB::table('lens_color_types')->where('category_status','Active')->where('category_parent_id',$subcolor->id)->count();
?>    
<?php if($color_tints_count>0): ?>
<?php
$color_tints_first=DB::table('lens_color_types')->where('category_status','Active')->where('category_parent_id',$subcolor->id)->first();
$color_tints=DB::table('lens_color_types')->where('category_status','Active')->where('category_parent_id',$subcolor->id)->get();
?>
<?php $__currentLoopData = $color_tints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-lg-1 col-md-2 col-2" id="tint<?php echo e($tint->id); ?>" onclick="setTint('<?php echo e($tint->id); ?>','<?php echo e($subcolor->id); ?>')" title="<?php echo e($tint->category_name); ?>">
<img src="<?php echo e(asset('uploaded_files/finalcat/'.$tint->category_image_name)); ?>" class="img-color" onclick="setborder(this)" alt="<?php echo e($tint->category_name); ?>" title="<?php echo e($tint->category_name); ?>" width="30px" height="30px"></div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<input type="hidden" id="tintval<?php echo e($subcolor->id); ?>" class="tint_color" value="<?php echo e($color_tints_first->id); ?>">    
<div class="col-12">
    <button type="submit" name="submit" onclick="getLensBrands('tint','<?php echo e($subcolor->id); ?>'),tokkenset('third-card')" class="btn-color" disabled disabled> submit </button>
</div>

<?php endif; ?>

</div>
</div>
</div>
</div>

<?php if(!empty($subcolor->category_description)): ?>
<div class="col-2">
<div class="popup">
<i class="fa fa-info"></i>
<span class="popuptext" id="myPopup"><?php echo $subcolor->category_description; ?></span>
</div>
</div>
<?php endif; ?>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<!-- sub nav end-->

<?php else: ?>

<div class="row desc-card" onclick="getLensBrands('notint','<?php echo e($type->id); ?>'),tokkenset('third-card')">

<input type="hidden" id="tintval<?php echo e($type->id); ?>" class="tint_color" value="<?php echo e($type->id); ?>">

<div class="col-lg-2 col-md-4 col-4">
<img src="<?php echo e(asset('uploaded_files/lens/'.$type->category_image_name)); ?>" alt="<?php echo e($product_data->category_name); ?>" title="<?php echo e($product_data->category_name); ?>" width="50px" height="50px" />
</div>
<div class="col-lg-8 col-md-6 col-6">
<h4><?php echo e($type->category_name); ?></h4>
<p><?php echo e($type->category_tag_line); ?></p>
</div>
<?php if(!empty($type->category_description)): ?>
<div class="col-md-2 col-2">
<div class="popup">
<i class="fa fa-info"></i>
<span class="popuptext" id="myPopup"><?php echo $type->category_description; ?></span>
</div>
</div>
<?php endif; ?>
</div>

<?php endif; ?>

  <?php
   $i++;
  ?>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
</div>

<!-- ################## SECTION LENS COLOR TYPE END ###################### -->
       
<!-- ################## SECTION LENS BRAND START ########################## -->       
<div class="view-lens-brands fourth-card" id="fourth-card" style="display: none">
 <center>   
<img src="<?php echo e(asset('img/loading-img.gif')); ?>" style="width:30%"/>    
</center>    
</div>    

<!-- ################## SECTION LENS BRAND END ############################# -->

<!-- ################## SECTION LENS START ################################# -->

<div class="view-lenses fifth-card" id="fifth-card" style="display: none">
<center>   
<img src="<?php echo e(asset('img/loading-img.gif')); ?>" style="width:30%"/>    
</center>
</div>

<!-- ################## SECTION LENS END ################################### -->

<!-- ################## SECTION REVIEW CART START ########################## -->

<div class="review-cart sixth-card" id="sixth-card" style="display: none">
<center>   
<img src="<?php echo e(asset('img/loading-img.gif')); ?>" style="width:30%"/>    
</center>
</div>

<!-- ################## SECTION REVIEW CART END ########################## -->
                             
    </div>
</div>
</div>
<!-- right column end-->
</section>
</div>

 <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/buy-with-lens.blade.php ENDPATH**/ ?>