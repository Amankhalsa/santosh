<?php $__env->startSection('title', 'User Login'); ?>
<?php $__env->startSection('content'); ?>
<style>
.account_form {
    border: solid 1px #222;
    padding: 15px;
    
}
.account_form h2 {
    margin-bottom: 20px;
}
.account_form label {
    color: #222;
    margin-bottom: 8px;
}
.account_form input {
    border-radius: unset;
    border: solid 1px #222;
}
.login_submit a {
    color: #222;
}
.page_speed_440257927 {
    margin-left: 0 !important;
    width: auto !important;
    height: 60px !important;
}
.login_submit .btn.btn-primary {
    background: #222;
    border: solid 1px #222;
    width: 185px;
    padding: 14px 0;
}
.flex.items-center.justify-end.mt-4 .page_speed_1009002956 {
    margin-left: 0;
    width: auto;
    height: 60px;
}
</style>
<div class="sun-breadcrumb-01">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="breadcrumb-01">
<ul>
<li><a href="<?php echo e(url('/')); ?>"><i class="fas fa-home"></i></a></li>
<li><a href="">My Account</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>

<div class="privacy-page" style="margin-top:5rem; margin-bottom:5rem;">
<div class="container">
<div class="row">
<div class="col-lg-6 col-12">
<div class="account_form">
<h2>login</h2>

 <form method="POST" action="<?php echo e(route('login')); ?>">
<?php echo csrf_field(); ?>
<input type="hidden" name="auth_attempt" value="login">
    <p>   
        <label>Username or email <span>*</span></label>
        <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php if(Session::get('last_auth_attempt')=='login'): ?> is-invalid <?php endif; ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" <?php if(Session::get('last_auth_attempt')=='login'): ?> value="<?php echo e(old('email')); ?>" <?php endif; ?> required >

        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
         <?php if(Session::get('last_auth_attempt')=='login'): ?>    
            <span class="invalid-feedback" role="alert">
                <strong><?php echo e($message); ?></strong>
            </span>
         <?php endif; ?>    
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
     </p>
     <p>   
        <label>Passwords <span>*</span></label>
       <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php if(Session::get('last_auth_attempt')=='login'): ?> is-invalid <?php endif; ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required >

            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <?php if(Session::get('last_auth_attempt')=='login'): ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($message); ?></strong>
                </span>
            <?php endif; ?>    
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
     </p>   
    <div class="login_submit">
       <a href="<?php echo e(route('password.request')); ?>">Lost your password?</a>
    
        <label for="remember">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
            Remember me
        </label>
        <br>
        <button type="submit" class="btn btn-primary">Login</button>
        
    </div>
      <div class="flex items-center justify-end mt-4">
                <a href="<?php echo e(url('/auth/redirect/google')); ?>">
                    <img src="<?php echo e(asset('uploaded_files/assets/images/goolge.png')); ?>" style=" width:auto; height:60px;">
                </a>
                <a href="<?php echo e(url('/auth/redirect/facebook')); ?>">
                <img src="<?php echo e(asset('uploaded_files/assets/images/facebook.png')); ?>" style=" width:auto; height:60px;">
           </a>
            </div>

                      
           



</form>
</div>
</div>
<div class="col-lg-6 col-12">
<div class="account_form register">
<h2>Register</h2>

<form method="POST" action="<?php echo e(route('register')); ?>">
 <?php echo csrf_field(); ?>
 <input type="hidden" name="auth_attempt" value="register">
    <p>   
        <label>Name  <span>*</span></label>
         <input id="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e(old('name')); ?>" required autocomplete="name" autofocus>

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
     </p>
    <p>   
        <label>Email address  <span>*</span></label>
       <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php if(Session::get('last_auth_attempt')=='register'): ?> is-invalid <?php endif; ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" <?php if(Session::get('last_auth_attempt')=='register'): ?> value="<?php echo e(old('email')); ?>" <?php endif; ?> required >

                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <?php if(Session::get('last_auth_attempt')=='register'): ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($message); ?></strong>
                </span>
                <?php endif; ?>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
     </p>
      <p>   
        <label>Phone No  <span>*</span></label>
         <input id="mobile" type="text" maxlength="10" class="form-control <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="mobile" value="<?php echo e(old('mobile')); ?>" required autocomplete="mobile">

                <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <?php if(Session::get('last_auth_attempt')=='register'): ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($message); ?></strong>
                </span>
                <?php endif; ?>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
     </p>
     <p>   
        <label>Passwords <span>*</span></label>
        <input id="password" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php if(Session::get('last_auth_attempt')=='register'): ?> is-invalid <?php endif; ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" title="Must contain at least one number and one uppercase and lowercase letter, and at
least 8 or more characters" required >

                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <?php if(Session::get('last_auth_attempt')=='register'): ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($message); ?></strong>
                </span>
                <?php endif; ?>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
     </p>
      <p>   
        <label>Confirm Passwords <span>*</span></label>
         <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
     </p>
    <div class="login_submit">
        <button type="submit" class="btn btn-primary">Register</button>
    </div>
</form>
</div>
</div>
</div>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/auth/login.blade.php ENDPATH**/ ?>