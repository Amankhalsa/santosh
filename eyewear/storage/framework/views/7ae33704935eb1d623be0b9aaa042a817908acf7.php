

<?php $__env->startSection('title','Order Detail'); ?>

<?php $__env->startSection('content'); ?>

<style>
.swal-wide{
width:500px !important;
font-size:16px !important;
}
.card-body{
    padding:30px !important;
}
</style>
<style>
ul.order li{
  border-bottom: 1px solid grey;   
  list-style:none;
}
.ord-address{
 line-height:2.3;    
}
table{
  width:100%;
  table-layout: fixed;
}
.tbl-header{
  background-color: rgba(255,255,255,0.3);
 }
.tbl-content{
  margin-top: 0px;
  border: 1px solid rgba(255,255,255,0.3);
}
th{
  background-color: #f3f3f3;
  padding: 20px 15px;
  text-align: left;
  font-weight: 500;
  font-size: 12px;
  color: black;
  text-transform: uppercase;
}
td{
  padding: 15px;
  text-align: left;
  vertical-align:middle;
  font-weight: 300;
  font-size: 12px;
  color: black;
  border-bottom: solid 1px rgba(255,255,255,0.1);
}

#example2 {
    border: 1px solid;
    padding: 10px;
    box-shadow: 1px 1px 14px 2px #356ed5;
    margin: 31px;
    border: 1px solid;
    border-color: #dbdadac2;
    padding: 20px;
    border-radius: 20px;
}
/* demo styles */

@import  url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);

section{
  margin: 50px;
}




/* for custom scrollbar for webkit browser*/

::-webkit-scrollbar {
    width: 6px;
} 
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
} 
::-webkit-scrollbar-thumb {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
}</style>

<script>
    // '.tbl-content' consumed little space for vertical scrollbar, scrollbar width depend on browser/os/platfrom. Here calculate the scollbar width .
$(window).on("load resize ", function() {
  var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
  $('.tbl-header').css({'padding-right':scrollWidth});
}).resize();
</script>

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Order Detail &nbsp; <i style="font-size:20px;" class="fas fa-list-alt"></i></h4>

<div style="float:right;">
<span style="padding:8px;font-size:16px;box-shadow:2px 2px 2px grey;" class="badge badge-pill badge-secondary"><b>Total:</b> <?php echo e($order_detail->total()); ?></span>
&nbsp;
<span style="float:right;"><a href="<?php echo e(route('manage-order')); ?>" class="btn btn-info" style="font-size:15px"><i class="fa fa-angle-double-left"></i> Back</a></span>

</div>

</div>
</div>
</div>

<div class="section__content section__content--p30">
<br>

<?php if(count($errors)>0): ?>
<div class="alert alert-danger alert-dismissible fade show">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<strong>Errors Occured!</strong>
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

<?php if($order_detail->isNotEmpty()): ?>

<?php
if(!empty($order_parent_data->order_coupon_id)){ 
 $coupon = DB::table('coupons')->where('id',$order_parent_data->order_coupon_id)->first();
 
} 
 
?>

 <div class="container-fluid">
 <form action="#" method="post" onsubmit="return checkboxValidation()">
  <?php echo csrf_field(); ?>
  <?php echo method_field('POST'); ?>
 

<div class="card-deck">
<div class="card bg-light">
<div class="card-body">
<ul class="order">
<li><h4> <i class="fas fa-user"></i> &nbsp; <?php echo e($order_parent_data->ship_name); ?></h4> </li>   
  
<li><p class="ord-address"><i class="fas fa-map-marker"></i>
&nbsp;<?php echo e($order_parent_data->ship_address); ?> <?php echo e($order_parent_data->ship_city); ?>,  <?php echo e($order_parent_data->ship_state); ?> - <?php echo e($order_parent_data->ship_pincode); ?>, <?php echo e($order_parent_data->ship_country); ?>.</p></li>
   
<li><p class="ord-address"><i class="fas fa-phone"></i> 
&nbsp;<?php echo e($order_parent_data->ship_mobile); ?>.</p></li>
   
<li><p class="ord-address"><i class="fas fa-envelope"></i>      
&nbsp;<?php echo e($order_parent_data->ship_email); ?>.</p></li>
   
<li><p class="ord-address"><i class="fas fa-server"></i>      
&nbsp;<?php echo e($order_parent_data->order_ip); ?> [ <?php echo e($order_parent_data->order_country); ?> ]</p></li>
 </ul>  
</div>
</div>

<div class="card bg-light">
<div class="card-body">
<p class="card-text">    
 <ul class="order">
  <li><b>Order Date: </b>&nbsp; <?php echo e(date('d-F-Y',strtotime($order_parent_data->order_date))); ?></li><br>
  <li><b>Order Delivery Status: </b>&nbsp; 
  <span class="badge <?php if($order_parent_data->order_delivery_status=='Pending'): ?> badge-warning <?php elseif($order_parent_data->order_delivery_status=='Dispatch'): ?> badge-info <?php elseif($order_parent_data->order_delivery_status=='Shipped'): ?> badge-primary <?php elseif($order_parent_data->order_delivery_status=='Out For Delivery'): ?> badge-light <?php elseif($order_parent_data->order_delivery_status=='Delivered'): ?> badge-success <?php elseif($order_parent_data->order_delivery_status=='Cancel'): ?> badge-danger <?php elseif($order_parent_data->order_delivery_status=='Hold'): ?> badge-dark <?php elseif($order_parent_data->order_delivery_status=='Refund'): ?> badge-info <?php endif; ?>"><?php echo e($order_parent_data->order_delivery_status); ?></span></li><br>
  
  <li><b>Order Payment Status: </b>&nbsp; 
  <span class="badge <?php if($order_parent_data->order_payment_status=='Paid'): ?> badge-success <?php else: ?> badge-danger <?php endif; ?>"><?php echo e($order_parent_data->order_payment_status); ?></span></li><br>
  
  <li><b>Order Payment Method: </b>&nbsp; 
  <span class="badge <?php if($order_parent_data->order_payment_method=='Online'): ?> badge-info <?php else: ?> badge-dark <?php endif; ?>"><?php echo e($order_parent_data->order_payment_method); ?></span></li>
  
 </ul>
 </p>
</div>
</div>

<div class="card bg-light">
<div class="card-body text-center">
 <h3 style="font-weight:normal">Total: <?php echo e($order_parent_data->order_currency_symbol.$order_parent_data->order_net_amount); ?></h3> 
  <br>
 <ul class="order">
    <li><b>Subtotal: </b>&nbsp; <?php echo e($order_parent_data->order_currency_symbol.$order_parent_data->order_amount); ?></li><br>
    <li><b>Shipping: </b>&nbsp; <?php echo e($order_parent_data->order_currency_symbol.$order_parent_data->shipping_charges); ?></li><br>
    <li><b>Discount: </b>&nbsp; <?php echo e($order_parent_data->order_currency_symbol.$order_parent_data->order_discount); ?></li><br>
<?php if(!empty($order_parent_data->order_coupon_id)): ?>    
    <li><b>Coupon: </b>&nbsp; <?php echo e($coupon->coupon_code); ?></li>
<?php endif; ?>    
 </ul> 
  
</div>
</div>
</div>

<br>
<div class="row">
<?php $__currentLoopData = $order_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
$coat_price=0.00;
$coatings = DB::table('order_coating')->where('order_id',$order_data->id)->get();
 $order_coating_count = DB::table('order_coating')->where('order_id',$order_data->id)->count();
if($order_coating_count>0){
$coat = DB::table('order_coating')->where('order_id',$order_data->id)->get();
foreach($coat as $data){
$coat_price += $data->coating_price;
}}
 
$item_name="";
$product=DB::table('categories')->where('id',$order_data->product_id)->first();
$item_name = $product->category_name; 
?> 
<div class="col-12 col-sm-8 col-md-6 col-lg-6">
<div class="card">
<div class="card-header">
  <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" href="#frame<?php echo e($order_data->id); ?>" role="tab" aria-controls="frame" aria-selected="true">Frame Detail</a>
    </li>
<?php if(!empty($order_data->lens_id)): ?>    
<li class="nav-item">
<a class="nav-link"  href="#lens<?php echo e($order_data->id); ?>" role="tab" aria-controls="lens" aria-selected="false">Lens Detail</a></li>
   
<li class="nav-item">
<a class="nav-link" href="#prescription<?php echo e($order_data->id); ?>" role="tab" aria-controls="prescription" aria-selected="false">Prescription</a></li>
<?php if($order_coating_count>0): ?>
<li class="nav-item">
<a class="nav-link" href="#coating<?php echo e($order_data->id); ?>" role="tab" aria-controls="coating" aria-selected="false">Coating</a></li>
<?php endif; ?>
<?php endif; ?> 
  </ul>
</div>
<div class="card-body">
  <h4 class="card-title"><?php echo e($item_name); ?> (<?php echo e($order_data->product_color); ?>)
  
  <span style="float:right;font-weight:normal">Item Id: <?php echo e($order_data->id); ?></span>
  </h4>
  
   <div class="tab-content mt-3">
    <div class="tab-pane active" id="frame<?php echo e($order_data->id); ?>" role="tabpanel">
      <p class="card-text">
<img src="<?php echo e(asset('uploaded_files/product/'.$product->category_image_name)); ?>" width="200"/>
      X
      <?php echo e($order_data->product_qty); ?>

      <br>
      <span>Price: <?php echo e($order_parent_data->order_currency_symbol.$product->category_price); ?></span>
      <br>
      <span>GST: <?php echo e($order_parent_data->order_currency_symbol.$order_data->frame_gst); ?></span>
      </p>
      <a target="_blank" href="<?php echo e(url('/frame/'.$product->category_slug_name.'.html')); ?>" class="card-link text-danger">Read more</a>
    </div>

   <?php if(!empty($order_data->lens_id)): ?>     
    <div class="tab-pane" id="lens<?php echo e($order_data->id); ?>" role="tabpanel" aria-labelledby="history-tab">  
      <p class="card-text">
        <?php
        $get_lens=DB::table('lenses')->where('id',$order_data->lens_id)->first();
        $lens_color_type = DB::table('lens_color_types')->where('id',$order_data->lens_color_id)->first();    
        ?>
        <?php echo e($get_lens->name); ?> (<?php echo e($order_parent_data->order_currency_symbol.$get_lens->price); ?>) * <?php echo e($order_data->lens_qty); ?> + <?php echo e($order_parent_data->order_currency_symbol.$order_data->lens_gst); ?>[GST]<br>
        
        <?php
        $get_vision=DB::table('visions')->where('id',$order_data->vision_id)->first();
        ?>
        <b>Vision: </b> <?php echo e($get_vision->vision_name); ?>

        <?php if($get_vision->vision_price==0.00): ?>
        (Free)
        <?php else: ?>
        (<?php echo e($order_parent_data->order_currency_symbol.$order_data->vision_price); ?>)
        <?php endif; ?>
        <br>
        <b>Color Type: </b> <?php echo e($lens_color_type->category_name); ?>

        <?php if($lens_color_type->category_price==0.00): ?>
        - Free
        <?php else: ?>
        - <?php echo e($order_parent_data->order_currency_symbol.$order_data->lens_color_price); ?>

        <?php endif; ?>
        <br>
        
        <b>Prism: </b> <?php echo e($order_parent_data->order_currency_symbol.$order_data->prism_price); ?>

        <br>
      <?php if($order_coating_count>0): ?>    
        <b>Coating: </b> <?php echo e($order_parent_data->order_currency_symbol.$coat_price); ?>

        <br>
      <?php endif; ?>    
        <b>subtotal: </b> <?php echo e($order_parent_data->order_currency_symbol); ?><?php echo e($order_data->product_net_price); ?>

        
      </p>
    </div>
   <?php endif; ?>
     
<div class="tab-pane" id="prescription<?php echo e($order_data->id); ?>" role="tabpanel" aria-labelledby="deals-tab">
<?php if($order_data->is_prescription_uploaded=="No" && $order_data->is_power!="No"): ?>  
   <div class="tbl-content">
    <h4>Prescription</h4>   
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody>
          <tr style="background-color:#efefef;">
          <th>   </th>
          <th>SPH</th>
        <th>CYL</th>
        <th>AXIS</th>
        <th>ADD</th>
        <th>PD</th>
        </tr>
        <tr>
         <td>Right</td>
        <td ><?php echo e($order_data->sph_right); ?></td>
        <td ><?php echo e($order_data->cyl_right); ?></td>
        <td ><?php echo e($order_data->axis_right); ?></td>
        <td ><?php echo e($order_data->add_right); ?></td>
        <?php if($order_data->is_pd2=="Yes"): ?>
        <td ><?php echo e($order_data->pupillary_distance_right); ?></td>
        <?php else: ?>
        <td ><?php echo e($order_data->pupillary_distance); ?></td>
        <?php endif; ?>
        </tr>
        <tr>
          <td>Left</td>
        <td class="os_sph"><?php echo e($order_data->sph_left); ?></td>
        <td class="os_cyl"><?php echo e($order_data->cyl_left); ?></td>
        <td class="os_axis"><?php echo e($order_data->axis_left); ?></td>
        <td class="os_add"><?php echo e($order_data->add_left); ?></td>
        <?php if($order_data->is_pd2=="Yes"): ?>
        <td class="os_pd" ><?php echo e($order_data->pupillary_distance_left); ?></td>
        <?php endif; ?>
        </tr>
      </tbody>
    </table>
    
    <p><strong>Description:</strong> <?php echo e($order_data->prescription_comment); ?></p>
  </div> 
  
<?php if($order_data->is_prism=="Yes"): ?>  
    <div class="tbl-content">
    <h4>Prism</h4>   
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody>
          <tr style="background-color:#efefef;">
          <th>   </th>
          <th>Vertical (Δ)</th>
        <th>Base Direction</th>
        <th>Horizontal (Δ)</th>
        <th>Base Direction</th>
        </tr>
        <tr>
         <td>Right</td>
        <td ><?php echo e($order_data->prism_right_vertical); ?></td>
        <td ><?php echo e($order_data->prism_right_vertical_direction); ?></td>
        <td ><?php echo e($order_data->prism_right_horizontal); ?></td>
        <td ><?php echo e($order_data->prism_right_horizontal_direction); ?></td>
        </tr>
        <tr>
          <td>Left</td>
        <td class="os_sph"><?php echo e($order_data->prism_left_vertical); ?></td>
        <td class="os_cyl"><?php echo e($order_data->prism_left_vertical_direction); ?></td>
        <td class="os_axis"><?php echo e($order_data->prism_left_horizontal); ?></td>
        <td class="os_add"><?php echo e($order_data->prism_left_horizontal_direction); ?></td>
        </tr>
        
      </tbody>
    </table>
  </div>
<?php endif; ?> 
<?php else: ?>
<?php if($order_data->is_prescription_uploaded=="Yes"): ?>
<div class="tbl-content">
 <h4>Prescription</h4> 
  <a target="_blank" href="<?php echo e(url('/uploaded_files/prescription/'.$order_data->uploaded_prescription)); ?>">View Prescription</a>
</div>
 <?php endif; ?>
<?php endif; ?>
  
</div>
    
<div class="tab-pane" id="coating<?php echo e($order_data->id); ?>" role="tabpanel" aria-labelledby="deals-tab">
<div class="container">
              
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Coating Name</th>
        <th>Coating Price</th>
      </tr>
    </thead>
    <tbody>
        
<?php $__currentLoopData = $coatings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>        
<?php
 $coat = DB::table('lens_coatings')->where('coating_id',$coating->coating_id)->first();
 $name = DB::table('lens_brands')->where('id',$coat->coating_id)->first();
?> 
  <tr>
    <td><?php echo e($name->category_name); ?></td>
    <td><?php echo e($order_parent_data->order_currency_symbol.$coating->coating_price); ?></td>
  </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>      
    </tbody>
  </table>
</div>
</div>
    
  </div>
</div>
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


  </div>


 <?php echo e($order_detail->links()); ?>

  


</form>
 </div>

 <?php else: ?>
 <div class="alert alert-danger fade show" id="no_record_found">
    <strong style="font-size: 22px">No Record Found...!</strong>
 </div>
 <?php endif; ?>

</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/admin/order-detail.blade.php ENDPATH**/ ?>