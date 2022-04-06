<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
       <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

      <title><?php echo $__env->yieldContent('title'); ?></title>
      <meta name="description" content="<?php echo $__env->yieldContent('description'); ?>">
      <meta name="keywords" content="<?php echo $__env->yieldContent('keywords'); ?>">

<?php echo $__env->yieldContent('og'); ?>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('/'.$admin_data->admin_favicon)); ?>">

<!-- STYLESHEETS -->
<!--========== new css added ==============-->
<?php if(Request::is('/') || Request::url('/eyeglasses.html') || Request::url('/sunglasses.html') || Request::url('/brands.html')    ): ?>

<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/new/bootstrap.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/new/style.css')); ?>">
<?php else: ?>

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/new/bootstrap.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/new/style.css')); ?>">

<!--======= new added css end ==========-->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/aniket.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/buywithlens.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/all.css')); ?>">
<link id="effect" rel="stylesheet" type="text/css" media="all" href="<?php echo e(asset('webslidemenu/dropdown-effects/fade-down.css')); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo e(asset('webslidemenu/webslidemenu.css')); ?>" />
<link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo e(asset('webslidemenu/color-skins/white-red.css')); ?>" />


<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/owl.carousel.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/owl.theme.default.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('webslidemenu/demo.css')); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/style.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/responsive.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/nice-select.min.css')); ?>">
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/multistep.min.css')); ?>">
<link type="text/css" rel="stylesheet" href="<?php echo e(asset('css/jquery.fancybox.min.css')); ?>">


<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/igorlino/fancybox-plus@1.3.6/css/jquery.fancybox-plus.css" media="screen"/>

<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/gh/igorlino/elevatezoom-plus@1.2.1/demo/css/prism.css"/>
<?php endif; ?>

<!-- STYLESHEETS -->

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

 <?php
  DB::table('carts')->whereNull('user_email')->where(DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d')"), '<', date('Y-m-d', strtotime('-30 days')))->delete(); 
  DB::table('cart_coating')->where(DB::raw("DATE_FORMAT(date,'%Y-%m-%d')"), '<', date('Y-m-d', strtotime('-30 days')))->delete(); 
 ?>    

<?php if(auth()->guard('user')->check()): ?>
 <?php
 $count_cart =  DB::table('carts')->where('user_email',Auth::guard('user')->user()->email)->first();
 if(!empty($count_cart)){
 DB::table('carts')->where('session_id',Session::get('session_id'))->update([
    'user_email' => Auth::guard('user')->user()->email,
    'session_id' => $count_cart->session_id ]);
 }else{
  DB::table('carts')->where('session_id',Session::get('session_id'))->update([
    'user_email' => Auth::guard('user')->user()->email ]);
}
 ?>
<?php endif; ?>

<?php
$session_id = Session::get('session_id');
if(empty($session_id)){
 if(Auth::guard('user')->check()){
  $session_data = DB::table('carts')->where('user_email',Auth::guard('user')->user()->email)->select('session_id')->first();
  $session_id = $session_data->session_id;
 }else{
 $session_id = Str::random(30);  
 } 
  Session::put('session_id',$session_id);
}else{
  if(Auth::guard('user')->check()){
  $session_data = DB::table('carts')->where('user_email',Auth::guard('user')->user()->email)->select('session_id')->first();
  if(!empty($session_data->session_id)){
  $session_id = $session_data->session_id;
  }
 }
  Session::put('session_id',$session_id);
}

$prescription_img = DB::table('prescription')
 ->where('id',Session::get('prescription_id')) 
 ->where('session_id',Session::get('session_id')) 
 ->first();
if(!empty($prescription_img)){ 
$del_img_path = "uploaded_files/prescription/".$prescription_img->prescription;
@unlink($del_img_path);
}
DB::table('prescription')
 ->where('id',Session::get('prescription_id')) 
 ->where('session_id',Session::get('session_id')) 
 ->delete();
?>
<style>
  #loader {
      /*border: 5px solid #f3f3f3;*/
      /*border-radius: 50%;*/
      /*border-top: 5px solid skyblue;*/
      width: 30px;
      height: 30px;
      /*animation: spin 1s linear infinite;*/
      } 
      .center {
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			margin: auto;
		}
@media  only screen and (max-width: 470px) {
    .bannerSlider .swiper-slide {
    position: relative;
    overflow: hidden;
    top: 2rem;
}
}

</style>
    </head>
    <body>
        <!--<img src="<?php echo e(asset('uploaded_files/assets/images/gif/loader.gif')); ?>"  class="center" alt=" loader" id="loader"  >-->
    
         <div class="off_canvars_overlay">
                
    </div><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/layouts/header.blade.php ENDPATH**/ ?>