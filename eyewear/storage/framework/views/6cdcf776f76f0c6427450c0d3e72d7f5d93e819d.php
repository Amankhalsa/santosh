

<?php $__env->startSection('user-content'); ?>

<style type="text/css">

.panel-heading {
background-color: #d3d3d326;
padding: 10px;
border-radius: 5px;
}

.panel-group{
cursor: pointer;
}
</style> 

<h4>Order History</h4>
<br>
<div class="container">
<?php
$i=1;
?>
<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<div class="panel-group">
<div class="panel panel-default">
<div class="panel-heading MyAccount-content">
<h4 class="panel-title">
<a data-toggle="collapse" data-toggle="collapse" href="#collapse<?php echo e($i); ?>">
        View Order Detail</a>
</h4>
<table class="m-0 table-bordered table-responsive" style="width:100%;">
<thead>
<tr>
<th class=""><span class="nobr">Order</span></th>
<th class=""><span class="nobr">Net Amount</span></th>
<th class=""><span class="nobr">Date</span></th>
<th class=""><span class="nobr">Order Status</span></th>
<?php if(!empty($order->tracking_no)): ?>
<th class=""><span class="nobr">Tracking No</span></th>
<?php endif; ?>
</tr>
</thead>

<tbody>
<tr class="">
<td class="" data-title="Order">
<a>#EYEWEAR<?php echo e($order->id); ?></a>

</td>
<td class="" data-title="Net Amount"><a><i class="fas fa-inr"></i> <?php echo e($order->order_net_amount); ?></a>
</td>
<td class="" data-title="Date">
<a><i class="fas fa-calendar"></i> <?php echo e($order->order_date); ?></a>
</td>
<td class="" data-title="Order Status">
<a><span class="badge <?php if($order->order_delivery_status == "Delivered"): ?> badge-success <?php else: ?> badge-warning <?php endif; ?>"> <?php echo e($order->order_delivery_status); ?></a>
</td>
<?php if(!empty($order->tracking_no)): ?>
<td class="" data-title="Order Tracking">
<a> <?php echo e($order->tracking_no); ?> </a>
</td>
<?php endif; ?>
</tr>

</tbody>
</table>
</div>
<div id="collapse<?php echo e($i); ?>" class="panel-collapse collapse">
<div class="panel-body">

<div class="row">
<?php
$order_detail = DB::table('order_details')->where('order_id',$order->id)->where('order_parent_id',0)->get();
?>    
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
$product_name=DB::table('categories')->where('id',$order_data->product_id)->first();
$item_name = $product_name->category_name; 
?> 
<div class="col-12 col-sm-12 col-md-12 col-lg-12">
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
<img src="<?php echo e(asset('uploaded_files/product/'.$product_name->category_image_name)); ?>" width="200"/>
      X
      <?php echo e($order_data->product_qty); ?>

      <br>
      <span>Price: <?php echo e($order->order_currency_symbol.$order_data->product_unit_price); ?></span>
      
      </p>
      <a target="_blank" href="<?php echo e(url('/frame/'.$product_name->category_slug_name.'.html')); ?>" class="card-link text-danger">Read more</a>
    </div>

   <?php if(!empty($order_data->lens_id)): ?>     
    <div class="tab-pane" id="lens<?php echo e($order_data->id); ?>" role="tabpanel" aria-labelledby="history-tab">  
      <p class="card-text">
        <?php
        $get_lens=DB::table('lenses')->where('id',$order_data->lens_id)->first();
        $lens_color_type = DB::table('lens_color_types')->where('id',$order_data->lens_color_id)->first();    
        ?>
        <?php echo e($get_lens->name); ?> (<?php echo e($order->order_currency_symbol.$order_data->lens_price); ?>) * <?php echo e($order_data->lens_qty); ?><br>
        
        <?php
        $get_vision=DB::table('visions')->where('id',$order_data->vision_id)->first();
        ?>
        <b>Vision: </b> <?php echo e($get_vision->vision_name); ?>

        <?php if($get_vision->vision_price==0.00): ?>
        (Free)
        <?php else: ?>
        (<?php echo e($order->order_currency_symbol.$order_data->vision_price); ?>)
        <?php endif; ?>
        <br>
        <b>Color Type: </b> <?php echo e($lens_color_type->category_name); ?>

        <?php if($lens_color_type->category_price==0.00): ?>
        - Free
        <?php else: ?>
        - <?php echo e($order->order_currency_symbol.$order_data->lens_color_price); ?>

        <?php endif; ?>
        <br>
        
        <b>Prism: </b> <?php echo e($order->order_currency_symbol.$order_data->prism_price); ?>

        <br>
      <?php if($order_coating_count>0): ?>    
        <b>Coating: </b> <?php echo e($order->order_currency_symbol.$coat_price); ?>

        <br>
      <?php endif; ?>    
        <b>subtotal: </b> <?php echo e($order->order_currency_symbol); ?><?php echo e($order_data->product_net_price); ?>

        
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
    <td><?php echo e($order->order_currency_symbol.$coating->coating_price); ?></td>
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

</div>

</div>
</div>
</div>
<br>
<?php
$i++;
?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/user/orders.blade.php ENDPATH**/ ?>