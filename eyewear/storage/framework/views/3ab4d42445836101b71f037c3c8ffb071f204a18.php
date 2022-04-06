

<?php $__env->startSection('user-content'); ?>
 
<?php if(session('success')): ?>
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

 <h3>Shipping Address</h3>

 <form action="<?php echo e(url('/user/shipping-address')); ?>" method="post">
  <?php echo csrf_field(); ?>
  <?php echo method_field('POST'); ?>
  <div class="row form-group">
    <div class="col-12 col-lg-6">
    <label>Full Name</label> 
    <input type="text" name="ship_name" id="ship_name" placeholder="Enter your name" class="form-control <?php $__errorArgs = ['ship_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" <?php if(!empty($shipping_address)): ?> <?php if(!empty($shipping_address->ship_name)): ?> value="<?php echo e($shipping_address->ship_name); ?>" <?php endif; ?>  <?php endif; ?>>

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

  <div class="col-12 col-lg-6">
    <label>Email</label>
    <input type="text" name="ship_email" id="ship_email" placeholder="Enter your email" class="form-control <?php $__errorArgs = ['ship_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" <?php if(!empty($shipping_address)): ?> <?php if(!empty($shipping_address->ship_email)): ?> value="<?php echo e($shipping_address->ship_email); ?>" <?php endif; ?>  <?php endif; ?>>
    
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

  <div class="row form-group">
    
  <div class="col-12 col-lg-6">
    <label>Mobile</label>
    <input type="text" name="ship_mobile" id="ship_mobile" placeholder="Enter your mobile" class="form-control <?php $__errorArgs = ['ship_mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" <?php if(!empty($shipping_address)): ?> <?php if(!empty($shipping_address->ship_mobile)): ?> value="<?php echo e($shipping_address->ship_mobile); ?>" <?php endif; ?>  <?php endif; ?>>

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

 <div class="col-12 col-lg-6">
    <label>City</label> 
    <input type="text" name="ship_city" id="ship_city" required placeholder="Enter your city" class="form-control <?php $__errorArgs = ['ship_city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" <?php if(!empty($shipping_address)): ?> <?php if(!empty($shipping_address->ship_city)): ?> value="<?php echo e($shipping_address->ship_city); ?>" <?php endif; ?>  <?php endif; ?>>

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

  </div>

 <div class="row form-group">

<div class="col-12 col-lg-4">
    <label>Pincode</label> 
    <input type="text" name="ship_pincode" id="ship_pincode" required placeholder="Enter your pincode" class="form-control <?php $__errorArgs = ['ship_pincode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" <?php if(!empty($shipping_address)): ?> <?php if(!empty($shipping_address->ship_pincode)): ?> value="<?php echo e($shipping_address->ship_pincode); ?>" <?php endif; ?>  <?php endif; ?>>

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

   <div class="col-12 col-lg-4">
    <label>Country</label>
   <select class="form-control" name="ship_country" id="country" required onchange="getStates()">
      <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       <option value="<?php echo e($country->id); ?>" <?php if(!empty($shipping_address)): ?> <?php if($country->id == $shipping_address->ship_country): ?> selected <?php endif; ?> <?php endif; ?> ><?php echo e($country->name); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
  </div>

  <div class="col-12 col-lg-4">
    <label>State</label>
   <select class="form-control" name="ship_state" id="state" required>
  <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <option value="<?php echo e($state->id); ?>" <?php if(!empty($shipping_address)): ?> <?php if($state->id == $shipping_address->ship_state): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e($state->name); ?></option>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
  </div>

 

  </div>

  <div class="row form-group">
    <div class="col-12 ">
    <label>Address line 1</label> 
    <textarea type="text" class="form-control <?php $__errorArgs = ['ship_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="4" name="ship_address" id="ship_address" placeholder="Enter your address detail here..."><?php if(!empty($shipping_address)): ?><?php if(!empty($shipping_address->ship_address)): ?><?php echo e($shipping_address->ship_address); ?><?php endif; ?> <?php endif; ?></textarea>

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

  
  </div>
  <!------------------new -------------->
    <div class="row form-group">
    <div class="col-12 ">
    <label>Address line 2</label> 
    <textarea type="text" class="form-control <?php $__errorArgs = ['ship_address2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="4" name="ship_address2" id="ship_address2" placeholder="Enter your address line 2 here..."><?php if(!empty($shipping_address)): ?><?php if(!empty($shipping_address->ship_address2)): ?><?php echo e($shipping_address->ship_address2); ?><?php endif; ?> <?php endif; ?></textarea>

    <?php $__errorArgs = ['ship_address2'];
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
  
  <div class="row form-group mt-3">
    <div class="col-8 ">
      <button type="submit" class="btn btn-primary"> Update Info</button>
  </div>
  <div class="col-4 ">
      <a class="btn btn-info" href="<?php echo e(url('/checkout.html')); ?>">Proceed to checkout</a>
  </div>
 </div>     

</form> 

<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/user/shipping-address.blade.php ENDPATH**/ ?>