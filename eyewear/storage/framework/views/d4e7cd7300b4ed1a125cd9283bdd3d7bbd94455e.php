<header class="header-mobile d-block d-lg-none">
<div class="header-mobile__bar">
 <div class="container-fluid">
  <div class="header-mobile-inner">

<a class="logo" href="<?php echo e(url('/admin')); ?>">
<img <?php if(isset($admin_data) && !empty($admin_data->admin_logo) ): ?> src="<?php echo e(asset('uploaded_files/logo/'.$admin_data->admin_logo)); ?>" alt="<?php echo e($admin_data->admin_company_name); ?>" title="<?php echo e($admin_data->admin_company_name); ?>" <?php else: ?> src="<?php echo e(asset('admin_assets/images/dummy_logo.png')); ?>"  <?php endif; ?>  style="height:55px;" />
</a>
<button class="hamburger hamburger--slider" type="button">
<span class="hamburger-box">
    <span class="hamburger-inner"></span>
</span>
</button>
        </div>
    </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">

                        <?php if(Auth::user()->admin_type != "SuperAdmin"): ?>
                        <?php
                         $admin_roles=explode(',',Auth::user()->admin_roles);
                        ?>
                        <?php if( in_array('1',$admin_roles) ): ?>
                            <li class="<?php echo e(Request::path() == 'admin/manage-pages' ? 'active' : ''); ?>">
                                <a href="/admin/manage-pages">
                                    <i class="fas fa-chart-bar"></i>Manage Site Pages</a>
                            </li>
                        <?php endif; ?>
                        <?php if( in_array('14',$admin_roles) ): ?>
                        <li class="<?php echo e(Request::path() == 'admin/manage-registration' ? 'active' : ''); ?>">
                        <a href="/admin/manage-registration">
                        <i class="fas fa-user-plus"></i>Manage Registration</a>
                        </li>
                        <?php endif; ?>
                        <?php if( in_array('2',$admin_roles) ): ?>
                         <?php if($admin_data->admin_category_level == 3): ?>
                        <li class="<?php echo e(Request::path() == 'admin/manage-category' ? 'active' : ''); ?>">
                         <a href="<?php echo e(route('manage-category')); ?>"><i class="fas fa-list-alt"></i>Manage Category</a>
                        </li>
                         <?php elseif($admin_data->admin_category_level == 2): ?>
                          <li class="<?php echo e(Request::path() == 'admin/manage-category' ? 'active' : ''); ?>">
                         <a href="<?php echo e(route('manage-subcategory',0)); ?>"><i class="fas fa-list-alt"></i>Manage Category</a>
                        </li>
                        <?php elseif($admin_data->admin_category_level == 1): ?>
                         <li class="<?php echo e(Request::path() == 'admin/manage-category' ? 'active' : ''); ?>">
                         <a href="<?php echo e(route('manage-finalcategory',[0,0])); ?>"><i class="fas fa-list-alt"></i>Manage Category</a>
                         </li>
                         <?php elseif($admin_data->admin_category_level == 0): ?>
                          <li class="<?php echo e(Request::path() == 'admin/manage-category' ? 'active' : ''); ?>">
                          <a href="<?php echo e(route('manage-product',[0,0,0])); ?>"><i class="fas fa-list-alt"></i>Manage Category</a>
                          </li>
                          <?php endif; ?>
                        <?php endif; ?>
                       
                        <?php if( in_array('3',$admin_roles) ): ?>
                            <li class="<?php echo e(Request::path() == 'admin/manage-users' ? 'active' : ''); ?>">
                                <a href="/admin/manage-users">
                                    <i class="fas fa-users"></i>Manage User</a>
                            </li>
                        <?php endif; ?>
                        <?php if( in_array('4',$admin_roles) ): ?>
                            <li class="<?php echo e(Request::path() == 'admin/manage-slider' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('manage-slider')); ?>">
                                    <i class="fas fa-image"></i>Manage Slider</a>
                            </li>
                        <?php endif; ?>
                        <?php if( in_array('5',$admin_roles) ): ?>
                            <li class="<?php echo e(Request::path() == 'admin/manage-testimonial' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('manage-testimonial')); ?>">
                                    <i class="fas fa-quote-right"></i>Manage Testimonial</a>
                            </li>
                        <?php endif; ?>
                        <?php if( in_array('6',$admin_roles) ): ?>
                            <li class="<?php echo e(Request::path() == 'admin/manage-our-team' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('manage-our-team')); ?>">
                                    <i class="fas fa-user-secret"></i>Manage Our Team</a>
                            </li>
                        <?php endif; ?>
                        <?php if( in_array('7',$admin_roles) ): ?>
                            <li class="<?php echo e(Request::path() == 'admin/manage-our-client' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('manage-our-client')); ?>">
                                    <i class="fas fa-id-card"></i>Manage Client Logo</a>
                            </li>
                        <?php endif; ?>
                        <?php if( in_array('8',$admin_roles) ): ?>
                            <li class="<?php echo e(Request::path() == 'admin/manage-enquiry' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('manage-enquiry')); ?>">
                                    <i class="fas fa-envelope"></i>Manage Enquiry</a>
                            </li>
                        <?php endif; ?>
                        <?php if( in_array('15',$admin_roles) ): ?>
                        <li class="<?php echo e(Request::path() == 'admin/manage-order' ? 'active' : ''); ?>">
                        <a href="/admin/manage-order">
                        <i class="fas fa-list-alt"></i>Manage Orders</a>
                        </li>
                        <?php endif; ?>
                        <?php if( in_array('9',$admin_roles) || in_array('10',$admin_roles) || in_array('11',$admin_roles) ): ?>
                            <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-cogs"></i>Manage Settings</a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <?php if( in_array('9',$admin_roles) ): ?>
                                    <li class="<?php echo e(Request::path() == 'admin/contact-update' ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('contact-update')); ?>"><i class="fas fa-address-book"></i>Contact Update</a>
                                    </li>
                                <?php endif; ?>
                                <?php if( in_array('10',$admin_roles) ): ?>
                                    <li class="<?php echo e(Request::path() == 'admin/change-password' ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('change-password-form')); ?>"><i class="fas fa-key"></i>Change Password</a>
                                    </li>
                                <?php endif; ?>
                                <?php if( in_array('11',$admin_roles) ): ?>
                                    <li class="<?php echo e(Request::path() == 'admin/social-media-links' ? 'active' : ''); ?>">
                                        <a href="<?php echo e(route('social-media-links')); ?>"><i class="fas fa-share-alt"></i>Social Links</a>
                                    </li>
                                <?php endif; ?>
                                </ul>
                            </li>
                            <?php endif; ?>

                        <?php else: ?>

                       <li class="<?php echo e(Request::path() == 'admin/manage-feature' ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('manage-feature')); ?>">
                        <i class="fas fa-bookmark"></i>Manage Feature & SEO</a>
                </li>

                        <li class="<?php echo e(Request::path() == 'admin/manage-image-resize' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('manage-image-resize')); ?>">
                                <i class="fas fa-file-photo-o"></i>Manage Image Resize</a>
                        </li>

                        <li class="<?php echo e(Request::path() == 'admin/manage-pages' ? 'active' : ''); ?>">
                            <a href="/admin/manage-pages">
                                <i class="fas fa-chart-bar"></i>Manage Site Pages</a>
                        </li>

                        <li class="<?php echo e(Request::path() == 'admin/manage-registration' ? 'active' : ''); ?>">
                    <a href="/admin/manage-registration">
                        <i class="fas fa-user-plus"></i>Manage Registration</a>
                        </li>

                        <?php if($admin_data->admin_category_level == 3): ?>
                        <li class="<?php echo e(Request::path() == 'admin/manage-category' ? 'active' : ''); ?>">
                         <a href="<?php echo e(route('manage-category')); ?>"><i class="fas fa-list-alt"></i>Manage Category</a>
                        </li>
                         <?php elseif($admin_data->admin_category_level == 2): ?>
                          <li class="<?php echo e(Request::path() == 'admin/manage-category' ? 'active' : ''); ?>">
                         <a href="<?php echo e(route('manage-subcategory',0)); ?>"><i class="fas fa-list-alt"></i>Manage Category</a>
                        </li>
                        <?php elseif($admin_data->admin_category_level == 1): ?>
                         <li class="<?php echo e(Request::path() == 'admin/manage-category' ? 'active' : ''); ?>">
                         <a href="<?php echo e(route('manage-finalcategory',[0,0])); ?>"><i class="fas fa-list-alt"></i>Manage Category</a>
                         </li>
                         <?php elseif($admin_data->admin_category_level == 0): ?>
                          <li class="<?php echo e(Request::path() == 'admin/manage-category' ? 'active' : ''); ?>">
                          <a href="<?php echo e(route('manage-product',[0,0,0])); ?>"><i class="fas fa-list-alt"></i>Manage Category</a>
                          </li>
                          <?php endif; ?>

                       
                        
                        <li class="<?php echo e(Request::path() == 'admin/manage-users' ? 'active' : ''); ?>">
                            <a href="/admin/manage-users">
                                <i class="fas fa-users"></i>Manage User</a>
                        </li>

                        <li class="<?php echo e(Request::path() == 'admin/manage-slider' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('manage-slider')); ?>">
                                <i class="fas fa-image"></i>Manage Slider</a>
                        </li>

                        <li class="<?php echo e(Request::path() == 'admin/manage-testimonial' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('manage-testimonial')); ?>">
                                <i class="fas fa-quote-right"></i>Manage Testimonial</a>
                        </li>

                        <li class="<?php echo e(Request::path() == 'admin/manage-our-team' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('manage-our-team')); ?>">
                                <i class="fas fa-user-secret"></i>Manage Our Team</a>
                        </li>

                        <li class="<?php echo e(Request::path() == 'admin/manage-our-client' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('manage-our-client')); ?>">
                                <i class="fas fa-id-card"></i>Manage Client Logo</a>
                        </li>

                        <li class="<?php echo e(Request::path() == 'admin/manage-enquiry' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('manage-enquiry')); ?>">
                                <i class="fas fa-envelope"></i>Manage Enquiry</a>
                        </li>

                         <li class="<?php echo e(Request::path() == 'admin/manage-order' ? 'active' : ''); ?>">
                    <a href="/admin/manage-order">
                        <i class="fas fa-list-alt"></i>Manage Orders</a>
                        </li>

                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-cogs"></i>Manage Settings</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">

                                <li class="<?php echo e(Request::path() == 'admin/contact-update' ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('contact-update')); ?>"><i class="fas fa-address-book"></i>Contact Update</a>
                                </li>

                                <li class="<?php echo e(Request::path() == 'admin/change-password' ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('change-password-form')); ?>"><i class="fas fa-key"></i>Change Password</a>
                                </li>

                                <li class="<?php echo e(Request::path() == 'admin/social-media-links' ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('social-media-links')); ?>"><i class="fas fa-share-alt"></i>Social Links</a>
                                </li>

                            </ul>
                        </li>

                        <?php endif; ?>

                    </ul>
                </div>
            </nav>
        </header>
<?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/admin/layouts/header.blade.php ENDPATH**/ ?>