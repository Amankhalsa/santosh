
<div class="wsmainfull clearfix" id="myHeader">
<div class="wsmainwp clearfix">
<div class="desktoplogo"><a href="{{url('/')}}"><img src="{{asset('uploaded_files/logo/'.$admin_data->admin_logo)}}" alt="logo"></a></div>
<!--Main Menu HTML Code-->
<nav class="wsmenu clearfix">
<ul class="wsmenu-list">
@php
 $count_carts = DB::table('carts')->where('session_id',Session::get('session_id'))->count();
$final_total_price=0;
$total_cart = DB::table('carts')->where('session_id',Session::get('session_id'))->get();
foreach ($total_cart as $total) {
$final_total_price += $total->lens_price+$total->price;
} 
@endphp    
<li aria-haspopup="true" class="rightmenu mini_cart_wrapper cart-btn">
<a href="javascript:void(0)"><i class="fas fa-shopping-bag" style="padding-left:10px; color:#000"></i>

<span class="shop-badge">{{DB::table('carts')->where('session_id',Session::get('session_id'))->count()}}</span>

<div class="sun-login"><!--Bag({{$count_carts}})--> 
</div>

<!--mini cart-->
<div class="mini_cart my-cart">
@if($count_carts>0)    
<div class="cart_gallery">
<div class="cart_close">
	<div class="cart_text">
		<h3>cart</h3>
	</div>
	<div class="mini_cart_close cart-close">
		<a href="javascript:void(0)"><i class="icon-x"></i></a>
	</div>
</div>

@php
$show_carts = DB::table('carts')->where('session_id',Session::get('session_id'))->get();
@endphp   
 @foreach($show_carts as $cart)
@php
$getImg=DB::table('categories')->where('id',$cart->product_id)->select(['category_image_name','category_slug_name'])->first();
@endphp
<div class="cart_item">
<div class="cart_img">
   <a href="{{url('/frame/'.$getImg->category_slug_name.'.html')}}"><img src="{{asset('uploaded_files/product/'.$getImg->category_image_name)}}" alt=""></a>
</div>
<div class="cart_info">
    <a href="{{url('/frame/'.$getImg->category_slug_name.'.html')}}">{{$cart->product_name}} ({{$cart->color}})</a>
    <p>{{$cart->quantity}} x <span> {{$cart->currency_symbol.$cart->price}} </span></p>    
</div>
<div class="cart_remove">
    <a href="{{url('/remove-cart',$cart->id)}}"><i class="fas fa-times"></i></a>
</div>
</div>

@endforeach

</div>
<div class="mini_cart_table">
<div class="cart_table_border">
    <div class="cart_total">
        <span>Sub total:</span>
        <span class="price">{{$final_total_price}}</span>
    </div>
    <div class="cart_total mt-10">
        <span>total:</span>
        <span class="price">{{$final_total_price}}</span>
    </div>
</div>
</div>
<div class="mini_cart_footer">
<div class="cart_button">
    <a href="{{url('/cart.html')}}"><i class="fa fa-shopping-cart"></i> View cart</a>
</div>
<div class="cart_button">
    <a href="{{url('/checkout.html')}}"><i class="fa fa-sign-in"></i> Checkout</a>
</div>
</div>
@else
Your Cart is empty!
@endif
</div>
<!--mini cart end-->

</a>
</li>


<li aria-haspopup="true" class="rightmenu mini_cart_wrapper wishlist-btn">
<a href="javascript:void(0)"><i class="fas fa-heart" style="padding-left:10px; color:#000"></i>
<span class="shop-badge">
@auth('user')
{{DB::table('wishlists')->where('user_id',Auth::guard('user')->user()->id)->count()}}
@else
0
@endauth
    </span>

<div class="sun-login">
</div>

<!--mini wishlist-->
<div class="mini_cart my-wishlist">
@auth('user')    
<div class="cart_gallery">
<div class="cart_close">
	<div class="cart_text">
		<h3>Wishlist</h3>
	</div>
	<div class="mini_cart_close wishlist-close">
		<a href="javascript:void(0)"><i class="icon-x"></i></a>
	</div>
</div>

@php
$wishlist_count = DB::table('wishlists')->where('user_id',Auth::guard('user')->user()->id)->count();
$wishlists = DB::table('wishlists')->where('user_id',Auth::guard('user')->user()->id)->get();
@endphp 
@if($wishlist_count>0)
@foreach($wishlists as $wishlist)
 @php
  $product = DB::table('categories')->where('id',$wishlist->product_id)->first();
 @endphp
<div class="cart_item">
<div class="cart_img">
<a href="{{url('/frame/'.$product->category_slug_name.'.html')}}">
<img alt="{{$product->category_name}}" title="{{$product->category_name}}" src="{{asset('uploaded_files/product/'.$product->category_image_name)}}" style="width: 100%;">
</a>
</div>
<div class="cart_info">
    <a href="{{url('/frame/'.$product->category_slug_name.'.html')}}">{{$product->category_name}} </a>
</div>
<div class="cart_remove">
    <a href="{{url('remove-wishlist',$wishlist->id)}}"><i class="fas fa-times"></i></a>
</div>
</div>
@endforeach
@endif
</div>

@else
Your Wishlist is empty!
@endauth
</div>
<!--mini wishlist end-->

</a>
</li>


@auth('user')

<li class="rightmenu mini_cart_wrapper menu-item menu-item-has-children animate-dropdown dropdown">
<a title="My Account" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true" href="{{url('/user')}}"><i class="fas fa-user mr-0 text-dark"></i>
<!--{{Str::limit(Auth::guard('user')->user()->name,4,$end='...')}}--><span class="caret"></span></a>
<ul class="sub-menu">
		
<li><a href="{{ url('/user') }}"><i class="fas fa-angle-right"></i>{{Str::limit(Auth::guard('user')->user()->name,15,$end='...')}}</a></li>

<li><a href="{{ url('/user/profile') }}"><i class="fas fa-angle-right"></i>My Profile</a></li>

<li><a href="{{ url('/user/orders') }}"><i class="fas fa-angle-right"></i>My Orders</a></li>

<li><a href="{{ url('/user/change-password') }}"><i class="fas fa-angle-right"></i>Change Password</a></li>

<li><!--<span class="wsmenu-click02"><i class="wsmenu-arrow"></i></span>--><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-angle-right"></i>{{ __('Logout') }}</a></li>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
@csrf
</form>

</ul>


</li>


@else

<li aria-haspopup="true" class="rightmenu">
<a href="{{route('login')}}"><i class="fas fa-user" style="color:#000"></i>
<!--<div class="sun-login">Sign In/Sign Up
</div>-->
</a>
</li>

@endif

<li aria-haspopup="true" class="rightmenu">
<form class="topmenusearch" method="get" action="{{route('header-search')}}">
@csrf
@method('GET')     
<input type="text" class="form-control" placeholder="Search Products..... " name="search_keyword" id="search_keyword" @isset($search_keyword) value="{{$search_keyword}}" @endisset required>
<span class="btnstyle"></span>
</form>
</li>

@php
$pages = DB::table('manage_pages')
->where('set_for_header','Yes')
->orderBy('page_order_by')
->where('page_status','Active')
->get();
@endphp

@foreach($pages as $page)

@if($page->page_link=="eyeglasses")

<li aria-haspopup="true"><a href="{{url($page->page_name)}}">{{$page->page_name}} <span class="fas fa-caret-down"></span></a>
<div class="wsmegamenu clearfix">
<div class="typography-text clearfix">
<div class="container-fluid">
<div class="row">
<div class="cl"></div>
<div class="col-lg-6 col-sm-12">
<ul>
 <li><a href="{{url('/'.$page->page_link.'/'.'men')}}"><img style="float:right" src="{{asset('img/eyeglass-men.jpg')}}"></a></li>
</ul>
</div>

<div class="col-lg-6 col-sm-12">
<ul>
<li><a href="{{url('/'.$page->page_link.'/'.'women')}}"><img style="float:right" src="{{asset('img/eyeglass-women.jpeg')}}"></a></li>

</ul>
</div>


<div class="col-lg-3 col-sm-12">

</div>

<div class="col-lg-3 col-sm-12">

</div>
</div>

</div>

</div>
</div>
</li>

@elseif($page->page_link=="sunglasses")
<li aria-haspopup="true"><a href="#">{{$page->page_name}} <span class="fas fa-caret-down"></span></a>
<div class="wsmegamenu clearfix">
<div class="typography-text clearfix">
<div class="container-fluid">
<div class="row" style="background-color:#F7F8F3">
<div class="cl"></div>
<div class="col-lg-6 col-sm-12">
<ul>
<li><a href="{{url('/'.$page->page_link.'/'.'men')}}"><img style="float:right" src="{{asset('img/sunglass-men.jpg')}}"></a></li>
</ul>
</div>

<div class="col-lg-6 col-sm-12">
<ul>
<li><a href="{{url('/'.$page->page_link.'/'.'women')}}"><img style="float:right" src="{{asset('img/sunglass-women.jpeg')}}"></a></li>

</ul>
</div>



<div class="col-lg-3 col-sm-12">

</div>

<div class="col-lg-3 col-sm-12">

</div>
</div>

</div>

</div>
</div>
</li>

@elseif($page->page_link=="contact-lenses")

<li aria-haspopup="true"><a href="#">{{$page->page_name}} <span class="fas fa-caret-down"></span></a>
<div class="wsmegamenu clearfix">
<div class="typography-text clearfix">
<div class="container">
<div class="row" >
<div class="cl"></div>

@php
$lens_replaces = DB::table('lens_replaces')->get();
@endphp
@if(!empty($lens_replaces))
 @foreach($lens_replaces as $data)
<div class="col-lg-4 col-sm-12">
<ul>
<li><a href="{{$data->replace_link}}"><img style="float:right" src="{{asset('uploaded_files/'.$data->replace_image_name)}}"></a>
{{$data->replace_text}}
</li>
</ul>
</div>
 @endforeach
@endif

</div>

</div>

</div>
</div>
</li>

@elseif($page->page_link=="brands")

<li aria-haspopup="true"><a href="#"> {{$page->page_name}} <span class="fas fa-caret-down"></span></a>
<div class="wsmegamenu clearfix">
<div class="typography-text clearfix">
<div class="container-fluid">
<div class="row">
<div class="cl"></div>
@php
$brands = DB::table('categories')->select(['id','category_name','category_slug_name'])->where('category_status','Active')->where('category_parent_id','0')->get();
@endphp

@foreach($brands as $brand)

<div class="col-lg-3 col-sm-12">
    <ul>
        <li><a href="{{url('/brand/'.$brand->category_slug_name.'.html')}}">{{$brand->category_name}}</a></li>
        
    </ul>
</div>

@endforeach

</div>

</div>

</div>
</div>
</li>

@endif
@endforeach



</ul>
</nav>
<!--Menu HTML Code-->
</div>
</div>