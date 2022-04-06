


<?php
$meta_title = $meta_description = $meta_keywords = "";
$meta_title = (!empty($meta_tag->page_meta_title)) ? $meta_tag->page_meta_title : "Cart Meta Title";
$meta_description = (!empty($meta_tag->page_meta_description)) ? $meta_tag->page_meta_description : "Cart Meta Description";
$meta_keywords = (!empty($meta_tag->page_meta_keywords)) ? $meta_tag->page_meta_keywords : "Cart Meta Keywords";


?>

<?php $__env->startSection('title',$meta_title); ?>
<?php $__env->startSection('description',$meta_description); ?>
<?php $__env->startSection('keywords',$meta_keywords); ?>


<style >
.coupon_area {
    padding: 15px;
    border: solid 1px #ccc;
    border-top: unset;
    margin-bottom: 50px;
}
.table_desc {
    padding: 15px;
    border: solid 1px #ccc;
}
.cart_page table {
    width: 100%;
}
.coupon_code.right {
    border-left: solid 1px #ccc;
    text-align: center;
}
.coupon_inner #coupon_code {
    border-radius: unset;
    padding: 2px;
    color: #222;
}
table {
  width: 100%;
}
</style>
<?php $__env->startSection('content'); ?>

<br>
<div class="sun-breadcrumb-01 pt-5">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="breadcrumb-01">
<!--<h3>Cart</h3>-->

</div>
</div>
</div>
</div>
</div>

<?php if($carts->isNotEmpty()): ?>
<div class="privacy-page pt-5">
<div class="container">
    <div class="row mb-5">
       <div class="col-12 text-center">
           
<h3><b>Cart</b></h3>
       </div> 
    </div>
<div class="row">
<div class="col-lg-12">
<div class="table_desc">
<form method="post" action="<?php echo e(url('/update-row-qty')); ?>">
<div class="cart_page">

<?php echo csrf_field(); ?>
<?php echo method_field('PUT'); ?>
<div  style="overflow-x:auto;"
>
<table class="table table-responsive  "  style="overflow-x:auto !important;">
<thead class="thead-dark">
    <tr>
        <th scope="col" class="">Delete</th>
        <th scope="col" class="product_thumb">Image</th>
        <th scope="col" class="product_name">Product</th>
        <th  scope="col" class="product-price">Price</th>
        <th scope="col" class="product_quantity">Quantity</th>
        <th scope="col" class="product_total">Total</th>
    </tr>
</thead>
<tbody>
   
<?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
 $product = DB::table('categories')->where('id',$cart->product_id)->first();
?>

<input type="hidden" name="cart_ids[]" id="cart_ids[]" value="<?php echo e($cart->id); ?>">   
<tr>
<td class="product_remove"><a href="<?php echo e(url('/remove-cart',$cart->id)); ?>"><i class="far fa-trash-alt"></i></a>
<!--/
<a title="Edit" href="<?php echo e(url('/update-cart',$cart->id)); ?>"><i class="fas fa-edit"></i></a>-->
</td>
<td class="product_thumb"><a href="<?php echo e(url('/frame/'.$product->category_slug_name.'.html')); ?>">
    <img src="<?php echo e(asset('uploaded_files/product/'.$product->category_image_name)); ?>" width="150"></a></td>
<td class="product_name"><a href="<?php echo e(url('/frame/'.$product->category_slug_name.'.html')); ?>"><?php echo e($product->category_name); ?></a> (<?php echo e($cart->color); ?>)

<?php if(!empty($cart->lens_id)): ?> 
<h5>Lens Detail</h5>
<?php
$vision_detail = DB::table('visions')->where('id',$cart->vision_id)->first();
$lens_detail = DB::table('lenses')->where('id',$cart->lens_id)->first();
$lens_color_type = DB::table('lens_color_types')->where('id',$cart->lens_color_id)->first();
?>
<p>Vision: <?php echo e($vision_detail->vision_name); ?>

<?php if($cart->vision_price==0.00): ?>

<?php else: ?>
(<?php echo e($cart->currency_symbol); ?><?php echo e($cart->vision_price); ?>)
<?php endif; ?>
</p>

<?php
 $lens_color_parent=DB::table('lens_color_types')->where('id',$lens_color_type->category_parent_id)->first();
?>
<?php if($cart->is_tint=="tint"): ?>

<p>Color Type: <?php echo e($lens_color_parent->category_name); ?> - <?php echo e($lens_color_type->category_name); ?>

<?php if($cart->lens_color_price==0.00): ?>

<?php else: ?>
- <?php echo e($cart->currency_symbol); ?><?php echo e($cart->lens_color_price); ?>

<?php endif; ?>
</p>

<?php else: ?>

<p>Color Type: <?php echo e($lens_color_type->category_name); ?>

<?php if($cart->lens_color_price==0.00): ?>

<?php else: ?>
- <?php echo e($cart->currency_symbol); ?><?php echo e($cart->lens_color_price); ?>

<?php endif; ?>
</p>
<?php endif; ?>

<p>Lens: <?php echo e($lens_detail->name); ?> (<?php echo e($lens_detail->lens_index); ?>) + <?php echo e($cart->lens_price); ?> 

<?php if($cart->is_power!="No" && $cart->is_prescription_uploaded=="No"): ?>
<br>
<a style="font-size:12px !important;text-decoration:none" href="javascript:void(0)" id="pre"><strong>View Prescription</strong></a>
<?php endif; ?>
</p>

<div class="row prescr" id="prescr" style="display:none;">
 <div class="col-12 col-lg-12 col-md-12 col-sm-12" >
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Prescription</th>
      <th scope="col">SPH</th>
      <th scope="col">CYL</th>
      <th scope="col">AXIS</th>
      <th scope="col">ADD</th>
      <th scope="col">PD</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Right</th>
      <td><?php echo e($cart->sph_right); ?></td>
      <td><?php echo e($cart->cyl_right); ?></td>
       <td><?php echo e($cart->axis_right); ?></td>
        <td><?php echo e($cart->add_right); ?></td>
       <?php if($cart->is_pd2=="Yes"): ?>
         <td><?php echo e($cart->pupillary_distance_right); ?></td>
       <?php else: ?>
         <td><?php echo e($cart->pupillary_distance); ?></td>
       <?php endif; ?>     
    </tr>
    <tr>
      <th scope="row">Left</th>
      <td><?php echo e($cart->sph_left); ?></td>
      <td><?php echo e($cart->cyl_left); ?></td>
      <td><?php echo e($cart->axis_left); ?></td>
        <td><?php echo e($cart->add_left); ?></td>
         <td><?php echo e($cart->pupillary_distance_left); ?></td>

    </tr>
  </tbody>
    <tfoot>
    <tr>
      <td>Description</td>
      <td><?php echo e($cart->prescription_comment); ?></td>
       
    </tr>
  </tfoot>
</table>

<?php if($cart->is_prism=="Yes"): ?>
<table class="table">
  <thead class="thead-light">
    <tr>
      <th class="min" scope="col">Prism</th>
      <th class="min" scope="col">VERTICAL (Δ)</th>
      <th class="min" scope="col">BASE DIRECTION</th>
      <th class="min" scope="col">HORIZONTAL (Δ)</th>
      <th class="min" scope="col">BASE DIRECTION</th>
    </tr>
  </thead>
   <tbody>
    <tr>
      <th scope="row">Right</th>
      <td><?php echo e($cart->prism_right_vertical); ?></td>
      <td><?php echo e($cart->prism_right_vertical_direction); ?></td>
       <td><?php echo e($cart->prism_right_horizontal); ?></td>
        <td><?php echo e($cart->prism_right_horizontal_direction); ?></td>
    </tr>
    <tr>
      <th scope="row">Left</th>
      <td><?php echo e($cart->prism_left_vertical); ?></td>
      <td><?php echo e($cart->prism_left_vertical_direction); ?></td>
      <td><?php echo e($cart->prism_left_horizontal); ?></td>
       <td><?php echo e($cart->prism_left_horizontal_direction); ?></td>
    </tr>
  </tbody>
    
</table>
<?php endif; ?>
</div>   
</div>

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

</td>
<td class="product-price"><?php echo e($cart->currency_symbol); ?><?php echo e($cart->price); ?></td>
<td class="product_quantity"><label>Quantity</label> <input min="1" name="qty[]" max="100" value="<?php echo e($cart->quantity); ?>" type="number"></td>

<?php if(!empty($cart->lens_id)): ?>
<td class="product_total">
<?php echo e($cart->currency_symbol); ?><?php echo e(($cart->price*$cart->quantity)+($cart->lens_price*$cart->lens_qty)+$cart->vision_price+$cart->lens_color_price+$cart->prism_price+$coat_price); ?></td>
<?php else: ?>
<td class="product_total">
<?php echo e($cart->currency_symbol); ?><?php echo e(($cart->price*$cart->quantity)+($cart->lens_price*$cart->lens_qty)); ?>

</td>
<?php endif; ?>

</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</tbody>
</table> 
</div>  
<div class="cart_submit">
    <button type="submit" class="btn btn-dark">update cart</button>
</div>   
</form>
</div>
</div>
</div>

<?php
$final_total_price=0;
$total_cart = DB::table('carts')->where('session_id',Session::get('session_id'))->get();
foreach ($total_cart as $total) {
if(!empty($total->lens_id)){

$final_total_price += ($total->quantity*$total->price)+($total->lens_price*$total->lens_qty)+$cart->vision_price+$cart->lens_color_price+$cart->prism_price+$coat_price;
}else{ 
$final_total_price += ($total->quantity*$total->price)+($total->lens_price*$total->lens_qty);
}
}
?>
<!--coupon code area start-->
<div class="coupon_area">
<div class="row">

<?php if(Auth::guard('user')->check()): ?>
<?php
$checkUserCoupon = DB::table('user_coupon')->where('user_id',Auth::guard('user')->user()->id)->where('status','Applied')->first();  
if(!empty($checkUserCoupon)){
$couponCondition = DB::table('coupons')->where('id',$checkUserCoupon->coupon_id)->first();
if($final_total_price<getCurrencyPrice($couponCondition->coupon_condition)){
DB::table('user_coupon')->where('id',$checkUserCoupon->id)->delete();
}}

$checkUserCoupon = DB::table('user_coupon')->where('user_id',Auth::guard('user')->user()->id)->where('status','Applied')->first();
?>
<?php if(empty($checkUserCoupon)): ?>
<div class="col-lg-6 col-md-6">
<div class="coupon_code left">
<h3>Coupon</h3>
<div class="coupon_inner">   
<p>Enter your coupon code if you have one.</p>                                
<input placeholder="Coupon code" type="text" id="coupon_code" name="coupon_code">
<button type="submit" onclick="applyCoupon()" class="btn btn-dark">Apply coupon</button>
</div>    
</div>
</div>
<?php else: ?>
<?php
 $coupon_code = DB::table('coupons')->where('id',$checkUserCoupon->coupon_id)->first();
?>
<div class="col-lg-6 col-md-6">
<div class="coupon_code left">
<h3>Coupon Applied:</h3>
<div class="coupon_inner">   
<p><a href="javascript:void(0)" class="btn btn-warning"><i class="fa fa-gift"></i> <?php echo e($coupon_code->coupon_code); ?></a> <a title="Remove" href="<?php echo e(url('/remove-coupon',$checkUserCoupon->id)); ?>"><i class="fa fa-times-circle" style="color: red"></i></a></p>
</div>    
</div>
</div>

<?php endif; ?>

<?php else: ?>
<div class="col-lg-6 col-md-6">
<div class="coupon_code left">
<h3>Coupon</h3>
<div class="coupon_inner">   
<p>Enter your coupon code if you have one.</p>                                
<input placeholder="Please Login First!" type="text" disabled>
<button type="submit" disabled class="btn btn-dark">Apply coupon</button>
</div>    
</div>
</div>
<?php endif; ?>


<div class="col-lg-6 col-md-6">
<div class="coupon_code right">
    <h3>Cart Totals</h3>
    <div class="coupon_inner">
       <div class="cart_subtotal">
           <p>Subtotal</p>
           <p class="cart_amount"><?php echo e($cart->currency_symbol); ?><?php echo e($final_total_price); ?></p>
       </div>
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
       <div class="cart_subtotal ">
           <p>Discount</p>
           <p class="cart_amount"><span>-</span> <?php echo e($cart->currency_symbol); ?><?php echo e($discount); ?></p>
       </div>
    <?php endif; ?>
       <div class="cart_subtotal">
           <p>Total</p>
           <p class="cart_amount"><?php echo e($cart->currency_symbol); ?><?php if(!empty($checkUserCoupon)): ?>
           <?php echo e($final_amount); ?>

          <?php else: ?>
           <?php echo e($final_total_price); ?>

          <?php endif; ?></p>
       </div>
       <div class="checkout_btn btn btn-light">
           <a href="<?php echo e(url('/checkout.html')); ?>" class="btn btn-warning">Pay with <span style="color:#0a2e8c ">pay</span><span style="color:#149dea">pal</span></a>
           

       </div>
    </div>
</div>
</div>
</div>
</div>
<!--coupon code area end-->
</div>
</div>

<?php else: ?>
<div class="" style="text-align: center;
    padding: 200px;">
    <img src="http://luxuryeyewear.in/img/Capture.JPG" style="width:200px;">
<h3>Your Cart is Empty!</h3>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/cart.blade.php ENDPATH**/ ?>