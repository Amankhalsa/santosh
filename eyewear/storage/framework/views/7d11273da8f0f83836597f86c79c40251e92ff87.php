

<?php $__env->startSection('title','User Panel'); ?>

<?php $__env->startSection('content'); ?>

<style type="text/css">
  #main-section{
    padding: 30px;
  }
  #sidebar {
    padding-top: 10px;
    background-color: #d3d3d300;
}
  #sidebar ul{
    list-style: none;
  }
  #sidebar ul li a{color:#000;}
  #sidebar ul li a:hover{text-decoration:none;}
  #sidebar ul li{
   margin-bottom: 5%;
    line-height: 2.0;
    border: 1px solid #8080806e;
    border-radius: 5px;
    padding: 10px;
    background: #efefef;
    color: #000;
    box-shadow: -3px 3px #d4d4d4;
    transition:0.8s;
  }
  #sidebar ul li:hover{
   transition:0.8s;
   background:transparent;
   transform: rotateY(-30deg);
  }
  #content{
        padding-left: 100px;
    padding: 0 5%;
  }
</style>

 <div class="container mt-5 mb-5" id="main-section">
   <div class="row">
     <div class="col-12 col-lg-3" id="sidebar">
       <ul>
        <li><a href="<?php echo e(url('/user')); ?>"> <i class="fa fa-server"></i> Dashboard</a></li>
         <li><a href="<?php echo e(url('/user/profile')); ?>"> <i class="fas fa-user"></i> My Profile</a></li>
         <li><a href="<?php echo e(url('/user/shipping-address')); ?>"> <i class="fas fa-shipping-fast"></i> Shipping Address</a></li>
         <li><a href="<?php echo e(url('/user/orders')); ?>"> <i class="fas fa-shopping-cart"></i> My Orders</a></li>
         <li><a href="<?php echo e(url('/user/change-password')); ?>"> <i class="fas fa-lock"></i> Change Password</a></li>
         <li class="menu-item animate-dropdown">
        <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out-alt"></i>
        <?php echo e(__('Logout')); ?>

        </a>
        </li>
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
        </form>
       </ul>
     </div>
      <div class="col-12 col-lg-8" id="content">
       <?php echo $__env->yieldContent('user-content'); ?>
     </div>
   </div>
 </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/user/layouts/app.blade.php ENDPATH**/ ?>