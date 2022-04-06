
<header class="header-desktop">
<div class="section__content section__content--p30">
<div class="container-fluid">
<div class="header-wrap">

<h3><?php echo e($admin_data->admin_company_name); ?></h3>

<div class="header-button">

 &nbsp;

 <div class="account-wrap">
<div class="account-item clearfix js-item-menu">
<div class="image">
<img src="<?php echo e(asset('admin_assets/images/user-login.png')); ?>" alt="User Logged In" class="img-fluid"  />
</div>
<div class="content">
<a class="js-acc-btn" href="#"><?php echo e(\Illuminate\Support\Str::limit(Auth::user()->admin_name, 25, $end='...')); ?></a>
</div>
<div class="account-dropdown js-dropdown">
<div class="info clearfix">
<div class="image">
<a href="#">
<img src="<?php echo e(asset('admin_assets/images/user-login.png')); ?>" alt="User Logged In" class="img-fluid" />
</a>
</div>
<div class="content">
<h5 class="name">
<a href="#"><?php echo e(\Illuminate\Support\Str::limit(Auth::user()->admin_name, 25, $end='...')); ?></a>
</h5>
<span class="email"><?php echo e(\Illuminate\Support\Str::limit(Auth::user()->email, 25, $end='...')); ?></span>
<br>
<span class="user_type"><b>User Type:</b> <?php echo e(Auth::user()->admin_type); ?> </span>

</div>
</div>

<div class="account-dropdown__footer">

<a href="<?php echo e(route('admin.logout')); ?>" ><i class="zmdi zmdi-power"></i>Logout</a>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</header>
<?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/admin/layouts/header_desktop.blade.php ENDPATH**/ ?>