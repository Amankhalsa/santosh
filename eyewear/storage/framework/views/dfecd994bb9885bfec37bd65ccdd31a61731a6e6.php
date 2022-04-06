<?php $__env->startSection('title','Manage Users'); ?>

<?php $__env->startSection('content'); ?>

<style>
.swal-wide{
width:500px !important;
font-size:16px !important;
}
</style>

<?php
$flag1=0;
?>

<div class="container-fluid" style="background-color:#f1f1f6;padding:15px;border-radius:0px;box-shadow:2px 2px 3px grey;margin-top:-39px;width:100%">
<div class="row">
<div class="col-lg-12">
<h4 style="float:left;margin-top:5px;">Manage Users &nbsp; <i style="font-size:20px;" class="fas fa-users"></i></h4>

<span style="float:right;padding:8px;font-size:16px;box-shadow:2px 2px 2px grey;" class="badge badge-pill badge-secondary"><b>Total:</b> <?php echo e(count($users)); ?></span>
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

<?php if(session('user_msg_status')): ?>
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo e(session('user_msg_status')); ?>

</div>
<?php endif; ?>


<div class="container-fluid" >
<div class="row">
<div class="col-lg-12">
<div class="card">
        <div class="card-header">
        <strong><?php if(isset($edit_user)): ?> Edit <?php else: ?> Add <?php endif; ?></strong> User
        </div>
        <div class="card-body card-block">
        <form <?php if(isset($edit_user)): ?> action="<?php echo e(route('user.update',$edit_user->id)); ?>" <?php else: ?> action="<?php echo e(route('user.add')); ?>" <?php endif; ?> method="post" class="form-inline">
        <?php echo csrf_field(); ?>
        <?php if(isset($edit_user)): ?>
        <?php echo method_field('PUT'); ?>
        <?php endif; ?>
        <div class="row">

        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" >
        <div class="form-group">
        <input type="text" placeholder="Name" required name="admin_name" class="form-control" id="add-user-form" <?php if(isset($edit_user)): ?> value="<?php echo e($edit_user->admin_name); ?>" <?php else: ?> value="<?php echo e(old('admin_name')); ?>" <?php endif; ?> >
        </div></div>

        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="form-group">
        <input type="text" placeholder="Email" required name="admin_email" class="form-control" id="add-user-form"  <?php if(isset($edit_user)): ?> value="<?php echo e($edit_user->email); ?>" <?php else: ?> value="<?php echo e(old('admin_email')); ?>" <?php endif; ?> >
        </div></div>

        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="form-group">
        <input type="text" placeholder="Mobile No" required name="admin_mobile" maxlength="10" class="form-control user-mobile" id="add-user-form" <?php if(isset($edit_user)): ?> value="<?php echo e($edit_user->admin_mobile); ?>" <?php else: ?> value="<?php echo e(old('admin_mobile')); ?>" <?php endif; ?> >
        </div></div>

       </div>

       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

       <div class="row"  style="margin-top:10px;" >
<?php if(!isset($edit_user)): ?>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
        <div class="form-group">
        <input type="password" placeholder="Password" required name="admin_password" class="form-control" id="add-user-form">
        </div></div>

        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
        <i class="fas fa-question-circle" class="password_rules"></i>
        </div>
<?php endif; ?>

<!-- Convert String to array -->
<?php if(isset($edit_user)): ?>
<?php
$admin_roles=explode(',',$edit_user->admin_roles);
if($edit_user->admin_type=="Admin"){
$flag1 = 1;
}
?>
<?php endif; ?>

<?php
 $login_user_roles=explode(',',Auth::user()->admin_roles);
?>


      <div <?php if(isset($edit_user)): ?> class="col-lg-8 col-md-8 col-sm-12 col-xs-12" <?php else: ?> class="col-lg-4 col-md-4 col-sm-4 col-xs-12" <?php endif; ?>>
        <div class="form-group">
      <?php if(Auth::user()->admin_type=="SuperAdmin"): ?>

        <select name="admin_roles[]" id="admin_roles" required class="selectpicker" multiple data-live-search="true" >
        <option value="1" <?php if(isset($admin_roles)): ?> <?php if(in_array('1',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Site Pages</option>
        <option value="2" <?php if(isset($admin_roles)): ?> <?php if(in_array('2',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Frame</option>
        <option value="3" <?php if(isset($admin_roles)): ?> <?php if(in_array('3',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage User</option>
        <option value="4" <?php if(isset($admin_roles)): ?> <?php if(in_array('4',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Slider</option>
        <option value="5" <?php if(isset($admin_roles)): ?> <?php if(in_array('5',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Testimonial</option>
        <option value="6" <?php if(isset($admin_roles)): ?> <?php if(in_array('6',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Our Team</option>
        <option value="7" <?php if(isset($admin_roles)): ?> <?php if(in_array('7',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Client Logo</option>
        <option value="8" <?php if(isset($admin_roles)): ?> <?php if(in_array('8',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Enquiry</option>
        <option value="9" <?php if(isset($admin_roles)): ?> <?php if(in_array('9',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Contact Update</option>
        <option value="10" <?php if(isset($admin_roles)): ?> <?php if(in_array('10',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Change Password</option>
        <option value="11" <?php if(isset($admin_roles)): ?> <?php if(in_array('11',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Social Links</option>
        <option value="12" <?php if(isset($admin_roles)): ?> <?php if(in_array('12',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Blog</option>
        <option value="13" <?php if(isset($admin_roles)): ?> <?php if(in_array('13',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Registration</option>
        <option value="14" <?php if(isset($admin_roles)): ?> <?php if(in_array('14',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Orders</option>
        <option value="15" <?php if(isset($admin_roles)): ?> <?php if(in_array('15',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Invoice</option>
        <option value="16" <?php if(isset($admin_roles)): ?> <?php if(in_array('16',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Coupon</option>
        <option value="17" <?php if(isset($admin_roles)): ?> <?php if(in_array('17',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Product Color</option>
        <option value="18" <?php if(isset($admin_roles)): ?> <?php if(in_array('18',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Rating</option>
        <option value="19" <?php if(isset($admin_roles)): ?> <?php if(in_array('19',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Subscriber</option>
        <option value="20" <?php if(isset($admin_roles)): ?> <?php if(in_array('20',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Vision</option>
        <option value="21" <?php if(isset($admin_roles)): ?> <?php if(in_array('21',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Lens</option>
        <option value="22" <?php if(isset($admin_roles)): ?> <?php if(in_array('22',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Prescription Type</option>
        <option value="23" <?php if(isset($admin_roles)): ?> <?php if(in_array('23',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Attribute Type</option>
        <option value="24" <?php if(isset($admin_roles)): ?> <?php if(in_array('24',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Lens Color</option>
        <option value="25" <?php if(isset($admin_roles)): ?> <?php if(in_array('25',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Lens Brand</option>
        <option value="26" <?php if(isset($admin_roles)): ?> <?php if(in_array('26',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Lens Toggle</option>
        <option value="27" <?php if(isset($admin_roles)): ?> <?php if(in_array('27',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Lens Index</option>
        <option value="28" <?php if(isset($admin_roles)): ?> <?php if(in_array('28',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Currency</option>
        <option value="29" <?php if(isset($admin_roles)): ?> <?php if(in_array('29',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Uploaded Prescription</option>
        </select>
      
      <?php else: ?>

        <select name="admin_roles[]" id="admin_roles" required class="selectpicker" multiple data-live-search="true" >
      <?php if(in_array('1', $login_user_roles)): ?>
        <option value="1" <?php if(isset($admin_roles)): ?> <?php if(in_array('1',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Site Pages</option>
      <?php endif; ?> 
       <?php if(in_array('2', $login_user_roles)): ?>
        <option value="2" <?php if(isset($admin_roles)): ?> <?php if(in_array('2',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Frame</option>
      <?php endif; ?>
       <?php if(in_array('3', $login_user_roles)): ?>
        <option value="3" <?php if(isset($admin_roles)): ?> <?php if(in_array('3',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage User</option>
      <?php endif; ?>
      <?php if(in_array('4', $login_user_roles)): ?>
        <option value="4" <?php if(isset($admin_roles)): ?> <?php if(in_array('4',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Slider</option>
      <?php endif; ?>
      <?php if(in_array('5', $login_user_roles)): ?>
        <option value="5" <?php if(isset($admin_roles)): ?> <?php if(in_array('5',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Testimonial</option>
      <?php endif; ?>
      <?php if(in_array('6', $login_user_roles)): ?>
        <option value="6" <?php if(isset($admin_roles)): ?> <?php if(in_array('6',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Our Team</option>
      <?php endif; ?>
      <?php if(in_array('7', $login_user_roles)): ?>
        <option value="7" <?php if(isset($admin_roles)): ?> <?php if(in_array('7',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Client Logo</option>
      <?php endif; ?>
      <?php if(in_array('8', $login_user_roles)): ?>
        <option value="8" <?php if(isset($admin_roles)): ?> <?php if(in_array('8',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Enquiry</option>
      <?php endif; ?>
      <?php if(in_array('9', $login_user_roles)): ?>
        <option value="9" <?php if(isset($admin_roles)): ?> <?php if(in_array('9',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Contact Update</option>
      <?php endif; ?>
      <?php if(in_array('10', $login_user_roles)): ?>
        <option value="10" <?php if(isset($admin_roles)): ?> <?php if(in_array('10',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Change Password</option>
      <?php endif; ?>
      <?php if(in_array('11', $login_user_roles)): ?>
        <option value="11" <?php if(isset($admin_roles)): ?> <?php if(in_array('11',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Social Links</option>
      <?php endif; ?>
      <?php if(in_array('12', $login_user_roles)): ?>
        <option value="12" <?php if(isset($admin_roles)): ?> <?php if(in_array('12',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Blog</option>
      <?php endif; ?>
      <?php if(in_array('13', $login_user_roles)): ?>
        <option value="13" <?php if(isset($admin_roles)): ?> <?php if(in_array('13',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Registration</option>
      <?php endif; ?>
      <?php if(in_array('14', $login_user_roles)): ?>
        <option value="14" <?php if(isset($admin_roles)): ?> <?php if(in_array('14',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Orders</option>
      <?php endif; ?>
      <?php if(in_array('15', $login_user_roles)): ?>
        <option value="15" <?php if(isset($admin_roles)): ?> <?php if(in_array('15',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Invoice</option>
      <?php endif; ?>
      <?php if(in_array('16', $login_user_roles)): ?>
        <option value="16" <?php if(isset($admin_roles)): ?> <?php if(in_array('16',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Rating</option>
      <?php endif; ?>
      <?php if(in_array('17', $login_user_roles)): ?>
        <option value="17" <?php if(isset($admin_roles)): ?> <?php if(in_array('17',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Product Color</option>
      <?php endif; ?>
      <?php if(in_array('18', $login_user_roles)): ?>
        <option value="18" <?php if(isset($admin_roles)): ?> <?php if(in_array('18',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Rating</option>
      <?php endif; ?>
      <?php if(in_array('19', $login_user_roles)): ?>
        <option value="19" <?php if(isset($admin_roles)): ?> <?php if(in_array('19',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Subscriber</option>
      <?php endif; ?>
      <?php if(in_array('20', $login_user_roles)): ?>
        <option value="20" <?php if(isset($admin_roles)): ?> <?php if(in_array('20',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Vision</option>
      <?php endif; ?>
      <?php if(in_array('21', $login_user_roles)): ?>
        <option value="21" <?php if(isset($admin_roles)): ?> <?php if(in_array('21',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Lens</option>
      <?php endif; ?>
      <?php if(in_array('22', $login_user_roles)): ?>
        <option value="22" <?php if(isset($admin_roles)): ?> <?php if(in_array('22',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Prescription Type</option>
      <?php endif; ?>
      <?php if(in_array('23', $login_user_roles)): ?>
        <option value="23" <?php if(isset($admin_roles)): ?> <?php if(in_array('23',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Attribute Type</option>
      <?php endif; ?>
      <?php if(in_array('24', $login_user_roles)): ?>
        <option value="24" <?php if(isset($admin_roles)): ?> <?php if(in_array('24',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Color Type</option>
      <?php endif; ?>
      <?php if(in_array('25', $login_user_roles)): ?>
        <option value="25" <?php if(isset($admin_roles)): ?> <?php if(in_array('25',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Lens Brand</option>
      <?php endif; ?>
      <?php if(in_array('26', $login_user_roles)): ?>
        <option value="26" <?php if(isset($admin_roles)): ?> <?php if(in_array('26',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Lens Toggle</option>
      <?php endif; ?>
      <?php if(in_array('27', $login_user_roles)): ?>
        <option value="27" <?php if(isset($admin_roles)): ?> <?php if(in_array('27',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Lens Index</option>
      <?php endif; ?>
      <?php if(in_array('28', $login_user_roles)): ?>
        <option value="28" <?php if(isset($admin_roles)): ?> <?php if(in_array('28',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Currency</option>
      <?php endif; ?>
      <?php if(in_array('29', $login_user_roles)): ?>
        <option value="29" <?php if(isset($admin_roles)): ?> <?php if(in_array('29',$admin_roles)): ?> selected <?php endif; ?> <?php endif; ?> >Uploaded Prescription</option>
      <?php endif; ?>
    
        </select>

      <?php endif; ?>  

      </div>
    </div>

  <?php
  $flag=0;
    if(!empty($admin_data)){
      $flag = ($admin_data->admin_type=="Admin") ? 1 : 0;
    }
  ?>

        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <div class="form-group">
        <select name="admin_type" id="admin_type" class="form-control">
         <?php if($flag == 0 || $flag1 == 1): ?>
         <option value="Admin">Admin</option>
         <?php endif; ?>
         <option value="SubAdmin">Sub Admin</option>
        </select>
        </div></div>

        </div>


        </div>
        <div class="card-footer">
        <button type="submit" class="btn btn-primary btn-sm">
        <i class="fa fa-dot-circle-o"></i> Submit
        </button>
        <button type="reset" class="btn btn-danger btn-sm">
        <i class="fa fa-ban"></i> Reset
        </button>
        </form>
        </div>
        </div>
</div>
</div>
</div>
<br><br>

<!-- ############## SHOW USERS SECTION START ################-->

 <div class="container-fluid">
  <form action="<?php echo e(route('user.update.status')); ?>" method="post" onsubmit="return checkboxValidation()">
  <?php echo csrf_field(); ?>
  <?php echo method_field('PUT'); ?>
  <div class="row">

        <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-30">
        <table id="userTable" class="table table-borderless table-striped table-earning">
        <thead>
        <tr>
        <th class="text-center"><input type="checkbox" id="checkAll"> S.No</th>
        <th class="text-center">User Name</th>
        <th class="text-center">User Email</th>
        <th class="text-center">User Mobile</th>
        <th class="text-center">User Status</th>
        <th class="text-center">Action</th>
        </tr>
        </thead>
        <tbody>
     <?php
     $i=1;
     $status="";
     ?>
     <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
        <td class="text-center"><input type="checkbox" name="user_ids[]" id="ids[]" class="user_ids" value="<?php echo e($user_data->id); ?>"/> <?php echo e($i++); ?></td>
        <td class="text-center"><?php echo e(strtolower($user_data->admin_name)); ?> <br>
        <a href="#" class="btn btn-warning" onclick="admin_roles('<?php echo e($user_data->admin_roles); ?>');">Accessibility</a>
         </td>
        <td class="text-center"><?php echo e($user_data->email); ?>


        <?php if($user_data->admin_type == "Admin"): ?>
         <br>
         <b>( <?php echo e($user_data->admin_type); ?> )</b>
        <?php endif; ?>
        </td>
        <td class="text-center"><?php echo e($user_data->admin_mobile); ?></td>
        <td class="text-center" >
        <?php if($user_data->admin_status=="Active"): ?>
        <span class="badge badge-success"><?php echo e($user_data->admin_status); ?></span>
        <?php else: ?>
        <span class="badge badge-danger"><?php echo e($user_data->admin_status); ?></span>
        <?php endif; ?>
        </td>

        <td class="text-center">
        <a title="Edit User" href="<?php echo e(route('user.edit',$user_data->id)); ?>" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
        /
        <a onClick="delete_user('<?php echo e($user_data->id); ?>','<?php echo e($admin_data->admin_website_url); ?>')" title="Delete User" style="color:red;" href="#" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
        /
        <a onClick="change_user_password('<?php echo e($user_data->id); ?>','<?php echo e($admin_data->admin_website_url); ?>')" title="Change Password" style="color:#705546;" href="#" data-toggle="tooltip"><i class="fa fa-key"></i></a>
        </td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
        </table>
        </div>
        </div>

  </div>

<!-- BOTTOM BUTTONS -->

<div class="row" style="background-color:lightgrey;padding:10px;box-shadow:2px 2px 2px grey;">
 <div class="col-md-12">
   <!-- ******** -->
   <input type="submit" class="btn btn-success req_for" name="req_for" value="Active">
   <input type="submit" class="btn btn-danger req_for" name="req_for" value="Inactive" style="margin-left:10px;">


 </div>
</div>
</form>
 </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/admin/manage-users.blade.php ENDPATH**/ ?>