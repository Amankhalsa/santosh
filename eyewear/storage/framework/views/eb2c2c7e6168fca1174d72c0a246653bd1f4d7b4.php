  <header>
    <div class="headerCol">
      <div class="container">
        <div class="header_content">
          <div class="row align-items-center g-2">
            <div class="col-auto">
              <div class="header_logo">
                <a href="<?php echo e(url('/')); ?>">
                  <img src="<?php echo e(asset('uploaded_files/navbar/luxuryeyewear.png')); ?>" alt="logo of luxuryeyewear">
                  
                </a>
              </div>
            </div>
            <div class="col">
              <div class="header_nav_links">
                <ul class="header_nav_links_style ">
                  <li class="dropchoose">
                    <a href="<?php echo e(route('eyeglasses.page')); ?>" target="_blank">Eyeglasses</a>
                    <ul class="dropdownCol">
                      <li><a href="<?php echo e(url('/')); ?>/eyeglasses/men"  target="_blank"> Men </a></li>
                      <li><a href="<?php echo e(url('/')); ?>/eyeglasses/women"  target="_blank">Women</a></li>
                    </ul>
                    
                  </li>
                  <li class="dropchoose">
                    <a href="<?php echo e(route('sunglasses.page')); ?>"  target="_blank">Sunglasses</a>
                    <ul class="dropdownCol">
                      <li><a href="<?php echo e(url('/')); ?>/sunglasses/men"  target="_blank">Men</a></li>
                      <li><a href="<?php echo e(url('/')); ?>/sunglasses/women"  target="_blank">Women</a></li>
                    </ul>
                  </li>
                  <li>
                    <a href="<?php echo e(route('brands.page')); ?>"  target="_blank">Brands</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-auto">
              <div class="header_right_link_icon">
                <ul class="header_right_link_icon_style">
                  <li>
                    <!--<a href="javascript:void(0)"><img src="./images/search-icon.svg" alt="Image Not Found"></a>-->
                             <form class="topmenusearch" method="get" action="<?php echo e(route('header-search')); ?>" style="width: 10rem;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('GET'); ?>     
                        <input type="text" class="form-control" placeholder="Search Products..." name="search_keyword" id="search_keyword" <?php if(isset($search_keyword)): ?> value="<?php echo e($search_keyword); ?>" <?php endif; ?> required>
                        
                        <span class="btnstyle"></span>
                        </form>
                        
                  </li>
                  <li class="dropchoose">
                      
                    <a href="<?php echo e(route('login')); ?>"><img src="<?php echo e(asset('uploaded_files/navbar/login.png')); ?>" title="Click here for Login"alt="Image Not Found"></a>
             <?php if(auth()->guard('user')->check()): ?>
                    <ul class="dropdownCol" style="margin-top:1rem; width:2rem">
                     <li><a href="<?php echo e(url('/user')); ?>"><b>Name:</b> <?php echo e(Str::limit(Auth::guard('user')->user()->name,20,$end='...')); ?></a></li>
                     <li style="padding:0.500rem;"><a href="<?php echo e(route('login')); ?>">login</a></li>
                      <li style="padding:0.500rem;"><a href="<?php echo e(url('/user/profile')); ?>">My Profile </a></li>
                      <li style="padding:0.500rem;"><a href="<?php echo e(url('/user/orders')); ?>">My Orders</a> </li>
                       <li style="padding:0.500rem;"><a href="<?php echo e(url('/user/change-password')); ?>">Change Password</a> </li>
                      <li style="padding:0.500rem;"> <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          <?php echo e(__('Logout')); ?></a></li>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                        </form>
                    </ul>
           
                 <?php endif; ?>
                  </li>
                  
          
                  <li>
                    <a href="<?php echo e(('/wishlist.html')); ?>">
                        <img src="<?php echo e(asset('uploaded_files/navbar/like-icon.svg')); ?>" alt="Image Not Found" style="width:22px; height:22px;">
                        <span class="">
                        <?php if(auth()->guard('user')->check()): ?>
                        <?php echo e(DB::table('wishlists')->where('user_id',Auth::guard('user')->user()->id)->count()); ?>

                        <?php else: ?>
                        0
                        <?php endif; ?>
                            
                        </span>
                        </a>
               
                  </li>
                  
                  <li>
                    <a href="<?php echo e(url('/cart.html')); ?>" class="cartCol">
                        <img src="<?php echo e(asset('uploaded_files/navbar/cart-icon.svg')); ?>" alt="Image Not Found">
                        <span class="cartCount"><?php echo e(DB::table('carts')->where('session_id',Session::get('session_id'))->count()); ?></span>
                        </a>
                  </li>
                  <li class="d-lg-none">
                    <a href="javascript:void(0)" class="navTrigger">
                        <img src="<?php echo e(asset('uploaded_files/navbar/nav-toggle.svg')); ?>" alt="Image Not Found"></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

<?php /**PATH /home2/luxurjhf/public_html/eyewear/resources/views/layouts/navbar_new.blade.php ENDPATH**/ ?>