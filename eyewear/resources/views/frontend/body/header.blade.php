  <header>
    <div class="headerCol">
      <div class="container">
        <div class="header_content">
          <div class="row align-items-center g-2">
            <div class="col-auto">
              <div class="header_logo">
                <a href="{{route('home.page')}}">
                  <img src="{{asset('assets/images/logo.svg')}}" alt="logo">
                </a>
              </div>
            </div>
            <div class="col">
              <div class="header_nav_links">
                <ul class="header_nav_links_style ">
                  <li>
                    <a href="{{route('home.eyeglass')}}">Eyeglasses</a>
                  </li>
                  <li>
                    <a href="{{route('home.sunglasses')}}">Sunglasses</a>
                  </li>
                  <li>
                    <a href="{{route('home.brands')}}">Brands</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-auto">
              <div class="header_right_link_icon">
                <ul class="header_right_link_icon_style">
                  <li>
                    <a href="javascript:void(0)"><img src="{{asset('assets/images/search-icon.svg')}}" alt="Image Not Found"></a>
                  </li>
                  <li>
                    <a href="javascript:void(0)"><img src="{{asset('assets/images/login-icon.svg')}}" alt="Image Not Found"></a>
                  </li>
                  <li>
                    <a href="javascript:void(0)"><img src="{{asset('assets/images/like-icon.svg')}}" alt="Image Not Found"></a>
                  </li>
                  <li>
                    <a href="javascript:void(0)"><img src="{{asset('assets/images/cart-icon.svg')}}" alt="Image Not Found"></a>
                  </li>
                  <li class="d-lg-none">
                    <a href="javascript:void(0)" class="navTrigger"><img src="{{asset('assets/images/nav-toggle.svg')}}" alt="Image Not Found"></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>