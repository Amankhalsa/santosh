<aside class="menu-sidebar d-none d-lg-block">
<div class="logo">
<a href="{{url('/admin')}}">
<img @if(isset($admin_data) && !empty($admin_data->admin_logo) ) src="{{ asset('uploaded_files/logo/'.$admin_data->admin_logo) }}" alt="{{ $admin_data->admin_company_name }}" title="{{ $admin_data->admin_company_name }}" @else src="{{ asset('admin_assets/images/dummy_logo.png') }}"  @endif style="height:55px;" />
</a>
</div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                <ul class="list-unstyled navbar__list">
                    <li>
                    <a href="{{url('/')}}" target="_blank">
                    <i class="fas fa-home"></i>Visit Website</a>
                    </li>
                @if(Auth::user()->admin_type != "SuperAdmin")
                @php
                 $admin_roles=explode(',',Auth::user()->admin_roles);
                @endphp
                @if( in_array('1',$admin_roles) )
                    <li class="{{ Request::path() == 'admin/manage-pages' ? 'active' : '' }}">
                        <a href="{{url('/admin/manage-pages')}}">
                            <i class="fas fa-chart-bar"></i>Manage Site Pages</a>
                    </li>
                @endif
                @if( in_array('13',$admin_roles) )
                <li class="{{ Request::path() == 'admin/manage-registration' ? 'active' : '' }}">
                    <a href="{{url('/admin/manage-registration')}}">
                        <i class="fas fa-user-plus"></i>Manage Registration</a>
                </li>
                @endif

         @if( in_array('2', $admin_roles) || in_array('23', $admin_roles) || in_array('17', $admin_roles))       
            <li class="has-sub">
            <a class="js-arrow" href="#">
            <i class="fas fa-cogs"></i>Frame Settings</a>
            <ul class="list-unstyled navbar__sub-list js-sub-list">
        @if(in_array('2', $admin_roles))
            <li class="{{ Request::path() == 'admin/manage-category' ? 'active' : '' }}">
            <a href="{{ route('manage-finalcategory',[0,0]) }}"><i class="fas fa-list-alt"></i>Manage Frame</a>
            </li>
            <li class="{{ Request::path() == 'admin/manage-frame' ? 'active' : '' }}">
            <a href="{{ route('manage-frame') }}"><i class="fas fa-list-alt"></i>All Frames</a>
            </li>
        @endif    

        @if(in_array('23', $admin_roles))
            <li class="{{ Request::path() == 'admin/manage-attribute-type' ? 'active' : '' }}">
            <a href="{{route('manage-attribute-type')}}">
            <i class="fas fa-list-alt"></i>Product Attributes</a>
            </li>
        @endif
        
        @if(in_array('17', $admin_roles))    
            <li class="nav-item {{ Request::path() == 'admin/manage-product-colors' ? 'active' : '' }}">
            <a class="nav-link" href="{{url('/admin/manage-product-colors')}}"><i class="fas fa-adjust"></i><span>Product Colors</span></a></li>
        @endif
            </ul>
            </li>
        @endif    

 @if( in_array('21', $admin_roles) || in_array('25', $admin_roles) || in_array('27', $admin_roles) || in_array('26', $admin_roles) || in_array('24', $admin_roles) || in_array('20', $admin_roles) || in_array('22', $admin_roles))  
        <li class="has-sub">
        <a class="js-arrow" href="#">
        <i class="fas fa-cogs"></i>Lens Settings</a>
        <ul class="list-unstyled navbar__sub-list js-sub-list">
   @if(in_array('21', $admin_roles))
        <li class="nav-item {{ Request::path() == 'admin/manage-lens' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('manage-lens')}}"><i class="fas fa-eye"></i><span>Manage Lens</span></a></li>
   @endif
   @if(in_array('25', $admin_roles))
        <li class="{{ Request::path() == 'admin/manage-lens-brand' ? 'active' : '' }}">
        <a href="{{ route('manage-lens-brand') }}">
            <i class="fas fa-eye"></i>Lens Brand</a>
        </li>
    @endif    

    @if(in_array('27', $admin_roles))
        <li class="{{ Request::path() == 'admin/manage-lens-index' ? 'active' : '' }}">
        <a href="{{ route('manage-lens-index') }}">
            <i class="fas fa-eye"></i>Lens Index</a>
        </li>
    @endif

    @if(in_array('26', $admin_roles))
        <li class="nav-item {{ Request::path() == 'admin/lens-toggle' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('lens-toggle')}}"><i class="fas fa-eye"></i><span>Lens Toggle</span></a></li> 
    @endif 

    @if(in_array('24', $admin_roles))
        <li class="nav-item {{ Request::path() == 'admin/manage-lens-color-type' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('manage-lens-color-type')}}"><i class="fas fa-eye"></i><span>Lens Color Type</span></a></li>
    @endif
    
    @if(in_array('20', $admin_roles))    
        
        <li class="nav-item {{ Request::path() == 'admin/manage-vision' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('manage-vision')}}"><i class="fas fa-eye"></i><span>Manage Vision</span></a></li>  
    @endif   

    @if(in_array('22', $admin_roles))
        <li class="{{ Request::path() == 'admin/manage-prescription-type' ? 'active' : '' }}">
        <a href="{{route('manage-prescription-type')}}">
            <i class="fas fa-users"></i>Prescription</a>
        </li>
    @endif    

        </ul>
        </li>
    @endif         
            
    <li class="{{ Request::path() == 'admin/lens-replace' ? 'active' : '' }}">
    <a href="{{url('/admin/lens-replace')}}">
    <i class="fas fa-exchange-alt"></i>Lens Replace</a>
    </li>
                
                @if( in_array('3',$admin_roles) )
                    <li class="{{ Request::path() == 'admin/manage-users' ? 'active' : '' }}">
                        <a href="{{url('/admin/manage-users')}}">
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
                 
                @if( in_array('14',$admin_roles) || in_array('15',$admin_roles) || in_array('29',$admin_roles) )  
                <li class="has-sub">
                <a class="js-arrow" href="#">
                <i class="fas fa-shopping-cart"></i>Order Management</a>
                <ul class="list-unstyled navbar__sub-list js-sub-list">
            @if( in_array('14',$admin_roles) )
                <li class="{{ Request::path() == 'admin/manage-order' ? 'active' : '' }}">
                <a href="{{url('/admin/manage-order')}}">
                <i class="fas fa-list-alt"></i>Manage Orders</a>
                </li>
            @endif 
            @if( in_array('15',$admin_roles) )   
                <li class="{{ Request::path() == 'admin/manage-invoice' ? 'active' : '' }}">
                <a href="{{ route('manage-invoice') }}"><i class="fas fa-file"></i>Manage Invoice</a>
                </li>
            @endif  
            @if( in_array('29',$admin_roles) )
            <li class="{{ Request::path() == 'admin/uploaded-prescription' ? 'active' : '' }}">
            <a href="{{ route('uploaded-prescription') }}"><i class="fas fa-users"></i>Uploaded Prescription</a>
            </li>
            @endif
                </ul>
                </li>
               @endif

             @if( in_array('16', $admin_roles))
                <li class="{{ Request::path() == 'admin/manage-coupon' ? 'active' : '' }}">
                    <a href="{{url('/admin/manage-coupon')}}">
                        <i class="fas fa-gift"></i>Manage Coupon</a>
                </li>
             @endif
            

             @if( in_array('18', $admin_roles))            
               <li class="{{ Request::path() == 'admin/manage-rating' ? 'active' : '' }}">
                    <a href="{{ route('manage-rating') }}">
                        <i class="fas fa-star"></i>Manage Rating</a>
                </li>
             @endif

             @if( in_array('19', $admin_roles))            
               <li class="{{ Request::path() == 'admin/manage-subscriber' ? 'active' : '' }}">
                    <a href="{{ route('manage-subscriber') }}">
                        <i class="fas fa-envelope"></i>Manage Subscriber</a>
                </li>
             @endif               

              @if( in_array('28', $admin_roles))
             <li class="{{ Request::path() == 'admin/manage-currency' ? 'active' : '' }}">
                    <a href="{{ route('manage-currency') }}">
                        <i class="fas fa-rupee"></i>Manage Currency</a>
                </li>
                @endif

                @if( in_array('12',$admin_roles) )
                    <li class="{{ Request::path() == 'admin/manage-blog' ? 'active' : '' }}">
                        <a href="{{ route('manage-blog') }}">
                            <i class="fas fa-newspaper"></i>Manage Blog</a>
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
                         <li class="{{ Request::path() == 'admin/frontend-brands-page' ? 'active' : '' }}">
                    <a href="{{route('manage.brands')}}">
                        <i class="fas fa-image"></i>Manage brands <img src="{{asset('/uploaded_files/assets/images/gif/new2.gif')}}" ></a>
                </li>

                <li class="{{ Request::path() == 'admin/manage-image-resize' ? 'active' : '' }}">
                    <a href="{{ route('manage-image-resize') }}">
                        <i class="fas fa-file-photo-o"></i>Manage Image Resize</a>
                </li>

                <li class="{{ Request::path() == 'admin/manage-pages' ? 'active' : '' }}">
                    <a href="{{url('/admin/manage-pages')}}">
                        <i class="fas fa-chart-bar"></i>Manage Site Pages</a>
                </li>

                <li class="{{ Request::path() == 'admin/manage-registration' ? 'active' : '' }}">
                    <a href="{{url('/admin/manage-registration')}}">
                        <i class="fas fa-user-plus"></i>Manage Registration</a>
                </li>
                
    <li class="has-sub">
    <a class="js-arrow" href="#">
    <i class="fas fa-cogs"></i>Frame Settings</a>
    <ul class="list-unstyled navbar__sub-list js-sub-list">
    
    <li class="{{ Request::path() == 'admin/manage-category' ? 'active' : '' }}">
         <a href="{{ route('manage-finalcategory',[0,0]) }}"><i class="fas fa-list-alt"></i>Manage Frame</a>
         </li>
    
    <li class="{{ Request::path() == 'admin/manage-attribute-type' ? 'active' : '' }}">
            <a href="{{route('manage-attribute-type')}}">
                <i class="fas fa-list-alt"></i>Product Attributes</a>
        </li>
    
    <li class="nav-item {{ Request::path() == 'admin/manage-product-colors' ? 'active' : '' }}">
        <a class="nav-link" href="{{url('/admin/manage-product-colors')}}"><i class="fas fa-adjust"></i><span>Product Colors</span></a></li>
    
    <li class="{{ Request::path() == 'admin/manage-frame' ? 'active' : '' }}">
    <a href="{{ route('manage-frame') }}"><i class="fas fa-list-alt"></i>All Frames</a>
    </li>

    
    </ul>
    </li>    
                
                
<li class="has-sub">
    <a class="js-arrow" href="#">
    <i class="fas fa-cogs"></i>Lens Settings</a>
    <ul class="list-unstyled navbar__sub-list js-sub-list">
    
    <li class="nav-item {{ Request::path() == 'admin/manage-lens' ? 'active' : '' }}">
    <a class="nav-link" href="{{route('manage-lens')}}"><i class="fas fa-eye"></i><span>Manage Lens</span></a></li>
    
    <li class="{{ Request::path() == 'admin/manage-lens-brand' ? 'active' : '' }}">
        <a href="{{ route('manage-lens-brand') }}">
            <i class="fas fa-eye"></i>Lens Brand</a>
    </li>
    
    <li class="{{ Request::path() == 'admin/manage-lens-index' ? 'active' : '' }}">
        <a href="{{ route('manage-lens-index') }}">
            <i class="fas fa-eye"></i>Lens Index</a>
    </li>
    
    <li class="nav-item {{ Request::path() == 'admin/lens-toggle' ? 'active' : '' }}">
    <a class="nav-link" href="{{route('lens-toggle')}}"><i class="fas fa-eye"></i><span>Lens Toggle</span></a></li> 
    
    <li class="nav-item {{ Request::path() == 'admin/manage-lens-color-type' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('manage-lens-color-type')}}"><i class="fas fa-eye"></i><span>Lens Color Type</span></a></li>

    <li class="nav-item {{ Request::path() == 'admin/manage-vision' ? 'active' : '' }}">
    <a class="nav-link" href="{{route('manage-vision')}}"><i class="fas fa-eye"></i><span>Manage Vision</span></a></li>  

     <li class="{{ Request::path() == 'admin/manage-prescription-type' ? 'active' : '' }}">
        <a href="{{route('manage-prescription-type')}}">
            <i class="fas fa-users"></i>Prescription</a>
    </li>
    
    </ul>
    </li> 

    <li class="{{ Request::path() == 'admin/lens-replace' ? 'active' : '' }}">
    <a href="{{url('/admin/lens-replace')}}">
        <i class="fas fa-exchange-alt"></i>Lens Replace</a>
    </li>
                

                <li class="{{ Request::path() == 'admin/manage-users' ? 'active' : '' }}">
                    <a href="{{url('/admin/manage-users')}}">
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

                 <li class="{{ Request::path() == 'admin/manage-rating' ? 'active' : '' }}">
                    <a href="{{ route('manage-rating') }}">
                        <i class="fas fa-star"></i>Manage Rating</a>
                </li>

                 <li class="has-sub">
                <a class="js-arrow" href="#">
                <i class="fas fa-shopping-cart"></i>Order Management</a>
                <ul class="list-unstyled navbar__sub-list js-sub-list">

                <li class="{{ Request::path() == 'admin/manage-order' ? 'active' : '' }}">
                    <a href="{{url('/admin/manage-order')}}">
                        <i class="fas fa-list-alt"></i>Manage Orders</a>
                </li>

                <li class="{{ Request::path() == 'admin/manage-invoice' ? 'active' : '' }}">
                <a href="{{ route('manage-invoice') }}"><i class="fas fa-file"></i>Manage Invoice</a>
                </li>
                
<li class="{{ Request::path() == 'admin/uploaded-prescription' ? 'active' : '' }}">
<a href="{{ route('uploaded-prescription') }}"><i class="fas fa-users"></i>Uploaded Prescription</a>
</li>

                </ul>
                </li>

                 <li class="{{ Request::path() == 'admin/manage-coupon' ? 'active' : '' }}">
                    <a href="{{url('/admin/manage-coupon')}}">
                        <i class="fas fa-gift"></i>Manage Coupon</a>
                </li>
                
                <li class="{{ Request::path() == 'admin/manage-blog' ? 'active' : '' }}">
                    <a href="{{ route('manage-blog') }}">
                        <i class="fas fa-newspaper"></i>Manage Blog</a>
                </li>

                 <li class="{{ Request::path() == 'admin/manage-subscriber' ? 'active' : '' }}">
                    <a href="{{ route('manage-subscriber') }}">
                        <i class="fas fa-envelope"></i>Manage Subscriber</a>
                </li>
                
                 <li class="{{ Request::path() == 'admin/manage-currency' ? 'active' : '' }}">
                    <a href="{{ route('manage-currency') }}">
                        <i class="fas fa-rupee"></i>Manage Currency</a>
                </li>

                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-cogs"></i>Manage Settings</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">

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
                </nav>
            </div>
        </aside>
