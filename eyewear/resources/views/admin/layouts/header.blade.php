<header class="header-mobile d-block d-lg-none">
<div class="header-mobile__bar">
 <div class="container-fluid">
  <div class="header-mobile-inner">

<a class="logo" href="{{url('/admin')}}">
<img @if(isset($admin_data) && !empty($admin_data->admin_logo) ) src="{{ asset('uploaded_files/logo/'.$admin_data->admin_logo) }}" alt="{{ $admin_data->admin_company_name }}" title="{{ $admin_data->admin_company_name }}" @else src="{{ asset('admin_assets/images/dummy_logo.png') }}"  @endif  style="height:55px;" />
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

                        @if(Auth::user()->admin_type != "SuperAdmin")
                        @php
                         $admin_roles=explode(',',Auth::user()->admin_roles);
                        @endphp
                        @if( in_array('1',$admin_roles) )
                            <li class="{{ Request::path() == 'admin/manage-pages' ? 'active' : '' }}">
                                <a href="/admin/manage-pages">
                                    <i class="fas fa-chart-bar"></i>Manage Site Pages</a>
                            </li>
                        @endif
                        @if( in_array('14',$admin_roles) )
                        <li class="{{ Request::path() == 'admin/manage-registration' ? 'active' : '' }}">
                        <a href="/admin/manage-registration">
                        <i class="fas fa-user-plus"></i>Manage Registration</a>
                        </li>
                        @endif
                        @if( in_array('2',$admin_roles) )
                         @if($admin_data->admin_category_level == 3)
                        <li class="{{ Request::path() == 'admin/manage-category' ? 'active' : '' }}">
                         <a href="{{ route('manage-category') }}"><i class="fas fa-list-alt"></i>Manage Category</a>
                        </li>
                         @elseif($admin_data->admin_category_level == 2)
                          <li class="{{ Request::path() == 'admin/manage-category' ? 'active' : '' }}">
                         <a href="{{ route('manage-subcategory',0) }}"><i class="fas fa-list-alt"></i>Manage Category</a>
                        </li>
                        @elseif($admin_data->admin_category_level == 1)
                         <li class="{{ Request::path() == 'admin/manage-category' ? 'active' : '' }}">
                         <a href="{{ route('manage-finalcategory',[0,0]) }}"><i class="fas fa-list-alt"></i>Manage Category</a>
                         </li>
                         @elseif($admin_data->admin_category_level == 0)
                          <li class="{{ Request::path() == 'admin/manage-category' ? 'active' : '' }}">
                          <a href="{{ route('manage-product',[0,0,0]) }}"><i class="fas fa-list-alt"></i>Manage Category</a>
                          </li>
                          @endif
                        @endif
                       
                        @if( in_array('3',$admin_roles) )
                            <li class="{{ Request::path() == 'admin/manage-users' ? 'active' : '' }}">
                                <a href="/admin/manage-users">
                                    <i class="fas fa-users"></i>Manage User</a>
                            </li>
                        @endif
                        @if( in_array('4',$admin_roles) )
                            <li class="{{ Request::path() == 'admin/manage-slider' ? 'active' : '' }}">
                                <a href="{{ route('manage-slider') }}">
                                    <i class="fas fa-image"></i>Manage Slider</a>
                            </li>
                        @endif
                        @if( in_array('5',$admin_roles) )
                            <li class="{{ Request::path() == 'admin/manage-testimonial' ? 'active' : '' }}">
                                <a href="{{ route('manage-testimonial') }}">
                                    <i class="fas fa-quote-right"></i>Manage Testimonial</a>
                            </li>
                        @endif
                        @if( in_array('6',$admin_roles) )
                            <li class="{{ Request::path() == 'admin/manage-our-team' ? 'active' : '' }}">
                                <a href="{{ route('manage-our-team') }}">
                                    <i class="fas fa-user-secret"></i>Manage Our Team</a>
                            </li>
                        @endif
                        @if( in_array('7',$admin_roles) )
                            <li class="{{ Request::path() == 'admin/manage-our-client' ? 'active' : '' }}">
                                <a href="{{ route('manage-our-client') }}">
                                    <i class="fas fa-id-card"></i>Manage Client Logo</a>
                            </li>
                        @endif
                        @if( in_array('8',$admin_roles) )
                            <li class="{{ Request::path() == 'admin/manage-enquiry' ? 'active' : '' }}">
                                <a href="{{ route('manage-enquiry') }}">
                                    <i class="fas fa-envelope"></i>Manage Enquiry</a>
                            </li>
                        @endif
                        @if( in_array('15',$admin_roles) )
                        <li class="{{ Request::path() == 'admin/manage-order' ? 'active' : '' }}">
                        <a href="/admin/manage-order">
                        <i class="fas fa-list-alt"></i>Manage Orders</a>
                        </li>
                        @endif
                        @if( in_array('9',$admin_roles) || in_array('10',$admin_roles) || in_array('11',$admin_roles) )
                            <li class="has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-cogs"></i>Manage Settings</a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                @if( in_array('9',$admin_roles) )
                                    <li class="{{ Request::path() == 'admin/contact-update' ? 'active' : '' }}">
                                        <a href="{{ route('contact-update') }}"><i class="fas fa-address-book"></i>Contact Update</a>
                                    </li>
                                @endif
                                @if( in_array('10',$admin_roles) )
                                    <li class="{{ Request::path() == 'admin/change-password' ? 'active' : '' }}">
                                        <a href="{{ route('change-password-form') }}"><i class="fas fa-key"></i>Change Password</a>
                                    </li>
                                @endif
                                @if( in_array('11',$admin_roles) )
                                    <li class="{{ Request::path() == 'admin/social-media-links' ? 'active' : '' }}">
                                        <a href="{{ route('social-media-links') }}"><i class="fas fa-share-alt"></i>Social Links</a>
                                    </li>
                                @endif
                                </ul>
                            </li>
                            @endif

                        @else

                       <li class="{{ Request::path() == 'admin/manage-feature' ? 'active' : '' }}">
                    <a href="{{ route('manage-feature') }}">
                        <i class="fas fa-bookmark"></i>Manage Feature & SEO</a>
                </li>

                        <li class="{{ Request::path() == 'admin/manage-image-resize' ? 'active' : '' }}">
                            <a href="{{ route('manage-image-resize') }}">
                                <i class="fas fa-file-photo-o"></i>Manage Image Resize</a>
                        </li>

                        <li class="{{ Request::path() == 'admin/manage-pages' ? 'active' : '' }}">
                            <a href="/admin/manage-pages">
                                <i class="fas fa-chart-bar"></i>Manage Site Pages</a>
                        </li>

                        <li class="{{ Request::path() == 'admin/manage-registration' ? 'active' : '' }}">
                    <a href="/admin/manage-registration">
                        <i class="fas fa-user-plus"></i>Manage Registration</a>
                        </li>

                        @if($admin_data->admin_category_level == 3)
                        <li class="{{ Request::path() == 'admin/manage-category' ? 'active' : '' }}">
                         <a href="{{ route('manage-category') }}"><i class="fas fa-list-alt"></i>Manage Category</a>
                        </li>
                         @elseif($admin_data->admin_category_level == 2)
                          <li class="{{ Request::path() == 'admin/manage-category' ? 'active' : '' }}">
                         <a href="{{ route('manage-subcategory',0) }}"><i class="fas fa-list-alt"></i>Manage Category</a>
                        </li>
                        @elseif($admin_data->admin_category_level == 1)
                         <li class="{{ Request::path() == 'admin/manage-category' ? 'active' : '' }}">
                         <a href="{{ route('manage-finalcategory',[0,0]) }}"><i class="fas fa-list-alt"></i>Manage Category</a>
                         </li>
                         @elseif($admin_data->admin_category_level == 0)
                          <li class="{{ Request::path() == 'admin/manage-category' ? 'active' : '' }}">
                          <a href="{{ route('manage-product',[0,0,0]) }}"><i class="fas fa-list-alt"></i>Manage Category</a>
                          </li>
                          @endif

                       
                        
                        <li class="{{ Request::path() == 'admin/manage-users' ? 'active' : '' }}">
                            <a href="/admin/manage-users">
                                <i class="fas fa-users"></i>Manage User</a>
                        </li>

                        <li class="{{ Request::path() == 'admin/manage-slider' ? 'active' : '' }}">
                            <a href="{{ route('manage-slider') }}">
                                <i class="fas fa-image"></i>Manage Slider</a>
                        </li>

                        <li class="{{ Request::path() == 'admin/manage-testimonial' ? 'active' : '' }}">
                            <a href="{{ route('manage-testimonial') }}">
                                <i class="fas fa-quote-right"></i>Manage Testimonial</a>
                        </li>

                        <li class="{{ Request::path() == 'admin/manage-our-team' ? 'active' : '' }}">
                            <a href="{{ route('manage-our-team') }}">
                                <i class="fas fa-user-secret"></i>Manage Our Team</a>
                        </li>

                        <li class="{{ Request::path() == 'admin/manage-our-client' ? 'active' : '' }}">
                            <a href="{{ route('manage-our-client') }}">
                                <i class="fas fa-id-card"></i>Manage Client Logo</a>
                        </li>

                        <li class="{{ Request::path() == 'admin/manage-enquiry' ? 'active' : '' }}">
                            <a href="{{ route('manage-enquiry') }}">
                                <i class="fas fa-envelope"></i>Manage Enquiry</a>
                        </li>

                         <li class="{{ Request::path() == 'admin/manage-order' ? 'active' : '' }}">
                    <a href="/admin/manage-order">
                        <i class="fas fa-list-alt"></i>Manage Orders</a>
                        </li>

                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-cogs"></i>Manage Settings</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">

                                <li class="{{ Request::path() == 'admin/contact-update' ? 'active' : '' }}">
                                    <a href="{{ route('contact-update') }}"><i class="fas fa-address-book"></i>Contact Update</a>
                                </li>

                                <li class="{{ Request::path() == 'admin/change-password' ? 'active' : '' }}">
                                    <a href="{{ route('change-password-form') }}"><i class="fas fa-key"></i>Change Password</a>
                                </li>

                                <li class="{{ Request::path() == 'admin/social-media-links' ? 'active' : '' }}">
                                    <a href="{{ route('social-media-links') }}"><i class="fas fa-share-alt"></i>Social Links</a>
                                </li>

                            </ul>
                        </li>

                        @endif

                    </ul>
                </div>
            </nav>
        </header>
