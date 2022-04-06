  <header>
    <div class="headerCol">
      <div class="container">
        <div class="header_content">
          <div class="row align-items-center g-2">
            <div class="col-auto">
              <div class="header_logo">
                <a href="{{url('/')}}">
                  <img src="{{asset('uploaded_files/navbar/luxuryeyewear.png')}}" alt="logo of luxuryeyewear">
                  
                </a>
              </div>
            </div>
            <div class="col">
              <div class="header_nav_links">
                <ul class="header_nav_links_style ">
                  <li class="dropchoose">
                    <a href="{{route('eyeglasses.page')}}" target="_blank">Eyeglasses</a>
                    <ul class="dropdownCol">
                      <li><a href="{{url('/')}}/eyeglasses/men"  target="_blank"> Men </a></li>
                      <li><a href="{{url('/')}}/eyeglasses/women"  target="_blank">Women</a></li>
                    </ul>
                    
                  </li>
                  <li class="dropchoose">
                    <a href="{{route('sunglasses.page')}}"  target="_blank">Sunglasses</a>
                    <ul class="dropdownCol">
                      <li><a href="{{url('/')}}/sunglasses/men"  target="_blank">Men</a></li>
                      <li><a href="{{url('/')}}/sunglasses/women"  target="_blank">Women</a></li>
                    </ul>
                  </li>
                  <li>
                    <a href="{{route('brands.page')}}"  target="_blank">Brands</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-auto">
              <div class="header_right_link_icon">
                <ul class="header_right_link_icon_style">
                  <li>
                    <!--<a href="javascript:void(0)"><img src="./images/search-icon.svg" alt="Image Not Found"></a>-->
                             <form class="topmenusearch" method="get" action="{{route('header-search')}}" style="width: 10rem;">
                        @csrf
                        @method('GET')     
                        <input type="text" class="form-control" placeholder="Search Products..." name="search_keyword" id="search_keyword" @isset($search_keyword) value="{{$search_keyword}}" @endisset required>
                        
                        <span class="btnstyle"></span>
                        </form>
                        
                  </li>
                  <li class="dropchoose">
                      
                    <a href="{{route('login')}}"><img src="{{asset('uploaded_files/navbar/login.png')}}" title="Click here for Login"alt="Image Not Found"></a>
             @auth('user')
                    <ul class="dropdownCol" style="margin-top:1rem; width:2rem">
                     <li><a href="{{ url('/user') }}"><b>Name:</b> {{Str::limit(Auth::guard('user')->user()->name,20,$end='...')}}</a></li>
                     <li style="padding:0.500rem;"><a href="{{route('login')}}">login</a></li>
                      <li style="padding:0.500rem;"><a href="{{ url('/user/profile') }}">My Profile </a></li>
                      <li style="padding:0.500rem;"><a href="{{ url('/user/orders') }}">My Orders</a> </li>
                       <li style="padding:0.500rem;"><a href="{{ url('/user/change-password') }}">Change Password</a> </li>
                      <li style="padding:0.500rem;"> <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                        </form>
                    </ul>
           
                 @endauth
                  </li>
                  
          
                  <li>
                    <a href="{{('/wishlist.html')}}">
                        <img src="{{asset('uploaded_files/navbar/like-icon.svg')}}" alt="Image Not Found" style="width:22px; height:22px;">
                        <span class="">
                        @auth('user')
                        {{DB::table('wishlists')->where('user_id',Auth::guard('user')->user()->id)->count()}}
                        @else
                        0
                        @endauth
                            
                        </span>
                        </a>
               
                  </li>
                  
                  <li>
                    <a href="{{url('/cart.html')}}" class="cartCol">
                        <img src="{{asset('uploaded_files/navbar/cart-icon.svg')}}" alt="Image Not Found">
                        <span class="cartCount">{{DB::table('carts')->where('session_id',Session::get('session_id'))->count()}}</span>
                        </a>
                  </li>
                  <li class="d-lg-none">
                    <a href="javascript:void(0)" class="navTrigger">
                        <img src="{{asset('uploaded_files/navbar/nav-toggle.svg')}}" alt="Image Not Found"></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

