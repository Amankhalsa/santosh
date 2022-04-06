@extends('layouts.app')

{{-- Meta tag Section Start --}}
@php
$meta_title = $meta_description = $meta_keywords = "";
$meta_title = (!empty($meta_tag->page_meta_title)) ? $meta_tag->page_meta_title : "Cart Meta Title";
$meta_description = (!empty($meta_tag->page_meta_description)) ? $meta_tag->page_meta_description : "Cart Meta Description";
$meta_keywords = (!empty($meta_tag->page_meta_keywords)) ? $meta_tag->page_meta_keywords : "Cart Meta Keywords";


@endphp

@section('title',$meta_title)
@section('description',$meta_description)
@section('keywords',$meta_keywords)

{{-- Meta tag Section End --}}
<style >
.coupon_area {
    padding: 15px;
    border: solid 1px #ccc;
    border-top: unset;
    margin-bottom: 50px;
}
.table_desc {
    padding: 15px;
    border: solid 1px #ccc;
}
.cart_page table {
    width: 100%;
}
.coupon_code.right {
    border-left: solid 1px #ccc;
    text-align: center;
}
.coupon_inner #coupon_code {
    border-radius: unset;
    padding: 2px;
    color: #222;
}
table {
  width: 100%;
}
</style>
@section('content')

<br>
<div class="sun-breadcrumb-01 pt-5">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="breadcrumb-01">
<!--<h3>Cart</h3>-->

</div>
</div>
</div>
</div>
</div>

@if($carts->isNotEmpty())
<div class="privacy-page pt-5">
<div class="container">
    <div class="row mb-5">
       <div class="col-12 text-center">
           
<h3><b>Cart</b></h3>
       </div> 
    </div>
<div class="row">
<div class="col-lg-12">
<div class="table_desc">
<form method="post" action="{{url('/update-row-qty')}}">
<div class="cart_page">

@csrf
@method('PUT')
<div  style="overflow-x:auto;"
>
<table class="table table-responsive  "  style="overflow-x:auto !important;">
<thead class="thead-dark">
    <tr>
        <th scope="col" class="">Delete</th>
        <th scope="col" class="product_thumb">Image</th>
        <th scope="col" class="product_name">Product</th>
        <th  scope="col" class="product-price">Price</th>
        <th scope="col" class="product_quantity">Quantity</th>
        <th scope="col" class="product_total">Total</th>
    </tr>
</thead>
<tbody>
   
@foreach($carts as $cart)
@php
 $product = DB::table('categories')->where('id',$cart->product_id)->first();
@endphp

<input type="hidden" name="cart_ids[]" id="cart_ids[]" value="{{$cart->id}}">   
<tr>
<td class="product_remove"><a href="{{url('/remove-cart',$cart->id)}}"><i class="far fa-trash-alt"></i></a>
<!--/
<a title="Edit" href="{{url('/update-cart',$cart->id)}}"><i class="fas fa-edit"></i></a>-->
</td>
<td class="product_thumb"><a href="{{url('/frame/'.$product->category_slug_name.'.html')}}">
    <img src="{{asset('uploaded_files/product/'.$product->category_image_name)}}" width="150"></a></td>
<td class="product_name"><a href="{{url('/frame/'.$product->category_slug_name.'.html')}}">{{$product->category_name}}</a> ({{$cart->color}})

@if(!empty($cart->lens_id)) 
<h5>Lens Detail</h5>
@php
$vision_detail = DB::table('visions')->where('id',$cart->vision_id)->first();
$lens_detail = DB::table('lenses')->where('id',$cart->lens_id)->first();
$lens_color_type = DB::table('lens_color_types')->where('id',$cart->lens_color_id)->first();
@endphp
<p>Vision: {{$vision_detail->vision_name}}
@if($cart->vision_price==0.00)

@else
({{$cart->currency_symbol}}{{$cart->vision_price}})
@endif
</p>

@php
 $lens_color_parent=DB::table('lens_color_types')->where('id',$lens_color_type->category_parent_id)->first();
@endphp
@if($cart->is_tint=="tint")

<p>Color Type: {{$lens_color_parent->category_name}} - {{$lens_color_type->category_name}}
@if($cart->lens_color_price==0.00)

@else
- {{$cart->currency_symbol}}{{$cart->lens_color_price}}
@endif
</p>

@else

<p>Color Type: {{$lens_color_type->category_name}}
@if($cart->lens_color_price==0.00)

@else
- {{$cart->currency_symbol}}{{$cart->lens_color_price}}
@endif
</p>
@endif

<p>Lens: {{$lens_detail->name}} ({{$lens_detail->lens_index}}) + {{$cart->lens_price}} 

@if($cart->is_power!="No" && $cart->is_prescription_uploaded=="No")
<br>
<a style="font-size:12px !important;text-decoration:none" href="javascript:void(0)" id="pre"><strong>View Prescription</strong></a>
@endif
</p>

<div class="row prescr" id="prescr" style="display:none;">
 <div class="col-12 col-lg-12 col-md-12 col-sm-12" >
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Prescription</th>
      <th scope="col">SPH</th>
      <th scope="col">CYL</th>
      <th scope="col">AXIS</th>
      <th scope="col">ADD</th>
      <th scope="col">PD</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Right</th>
      <td>{{$cart->sph_right}}</td>
      <td>{{$cart->cyl_right}}</td>
       <td>{{$cart->axis_right}}</td>
        <td>{{$cart->add_right}}</td>
       @if($cart->is_pd2=="Yes")
         <td>{{$cart->pupillary_distance_right}}</td>
       @else
         <td>{{$cart->pupillary_distance}}</td>
       @endif     
    </tr>
    <tr>
      <th scope="row">Left</th>
      <td>{{$cart->sph_left}}</td>
      <td>{{$cart->cyl_left}}</td>
      <td>{{$cart->axis_left}}</td>
        <td>{{$cart->add_left}}</td>
         <td>{{$cart->pupillary_distance_left}}</td>

    </tr>
  </tbody>
    <tfoot>
    <tr>
      <td>Description</td>
      <td>{{$cart->prescription_comment}}</td>
       
    </tr>
  </tfoot>
</table>

@if($cart->is_prism=="Yes")
<table class="table">
  <thead class="thead-light">
    <tr>
      <th class="min" scope="col">Prism</th>
      <th class="min" scope="col">VERTICAL (Δ)</th>
      <th class="min" scope="col">BASE DIRECTION</th>
      <th class="min" scope="col">HORIZONTAL (Δ)</th>
      <th class="min" scope="col">BASE DIRECTION</th>
    </tr>
  </thead>
   <tbody>
    <tr>
      <th scope="row">Right</th>
      <td>{{$cart->prism_right_vertical}}</td>
      <td>{{$cart->prism_right_vertical_direction}}</td>
       <td>{{$cart->prism_right_horizontal}}</td>
        <td>{{$cart->prism_right_horizontal_direction}}</td>
    </tr>
    <tr>
      <th scope="row">Left</th>
      <td>{{$cart->prism_left_vertical}}</td>
      <td>{{$cart->prism_left_vertical_direction}}</td>
      <td>{{$cart->prism_left_horizontal}}</td>
       <td>{{$cart->prism_left_horizontal_direction}}</td>
    </tr>
  </tbody>
    
</table>
@endif
</div>   
</div>

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

</td>
<td class="product-price">{{$cart->currency_symbol}}{{$cart->price}}</td>
<td class="product_quantity"><label>Quantity</label> <input min="1" name="qty[]" max="100" value="{{$cart->quantity}}" type="number"></td>

@if(!empty($cart->lens_id))
<td class="product_total">
{{$cart->currency_symbol}}{{($cart->price*$cart->quantity)+($cart->lens_price*$cart->lens_qty)+$cart->vision_price+$cart->lens_color_price+$cart->prism_price+$coat_price}}</td>
@else
<td class="product_total">
{{$cart->currency_symbol}}{{($cart->price*$cart->quantity)+($cart->lens_price*$cart->lens_qty)}}
</td>
@endif

</tr>
@endforeach

</tbody>
</table> 
</div>  
<div class="cart_submit">
    <button type="submit" class="btn btn-dark">update cart</button>
</div>   
</form>
</div>
</div>
</div>

@php
$final_total_price=0;
$total_cart = DB::table('carts')->where('session_id',Session::get('session_id'))->get();
foreach ($total_cart as $total) {
if(!empty($total->lens_id)){

$final_total_price += ($total->quantity*$total->price)+($total->lens_price*$total->lens_qty)+$cart->vision_price+$cart->lens_color_price+$cart->prism_price+$coat_price;
}else{ 
$final_total_price += ($total->quantity*$total->price)+($total->lens_price*$total->lens_qty);
}
}
@endphp
<!--coupon code area start-->
<div class="coupon_area">
<div class="row">

@if(Auth::guard('user')->check())
@php
$checkUserCoupon = DB::table('user_coupon')->where('user_id',Auth::guard('user')->user()->id)->where('status','Applied')->first();  
if(!empty($checkUserCoupon)){
$couponCondition = DB::table('coupons')->where('id',$checkUserCoupon->coupon_id)->first();
if($final_total_price<getCurrencyPrice($couponCondition->coupon_condition)){
DB::table('user_coupon')->where('id',$checkUserCoupon->id)->delete();
}}

$checkUserCoupon = DB::table('user_coupon')->where('user_id',Auth::guard('user')->user()->id)->where('status','Applied')->first();
@endphp
@if(empty($checkUserCoupon))
<div class="col-lg-6 col-md-6">
<div class="coupon_code left">
<h3>Coupon</h3>
<div class="coupon_inner">   
<p>Enter your coupon code if you have one.</p>                                
<input placeholder="Coupon code" type="text" id="coupon_code" name="coupon_code">
<button type="submit" onclick="applyCoupon()" class="btn btn-dark">Apply coupon</button>
</div>    
</div>
</div>
@else
@php
 $coupon_code = DB::table('coupons')->where('id',$checkUserCoupon->coupon_id)->first();
@endphp
<div class="col-lg-6 col-md-6">
<div class="coupon_code left">
<h3>Coupon Applied:</h3>
<div class="coupon_inner">   
<p><a href="javascript:void(0)" class="btn btn-warning"><i class="fa fa-gift"></i> {{$coupon_code->coupon_code}}</a> <a title="Remove" href="{{url('/remove-coupon',$checkUserCoupon->id)}}"><i class="fa fa-times-circle" style="color: red"></i></a></p>
</div>    
</div>
</div>

@endif

@else
<div class="col-lg-6 col-md-6">
<div class="coupon_code left">
<h3>Coupon</h3>
<div class="coupon_inner">   
<p>Enter your coupon code if you have one.</p>                                
<input placeholder="Please Login First!" type="text" disabled>
<button type="submit" disabled class="btn btn-dark">Apply coupon</button>
</div>    
</div>
</div>
@endauth


<div class="col-lg-6 col-md-6">
<div class="coupon_code right">
    <h3>Cart Totals</h3>
    <div class="coupon_inner">
       <div class="cart_subtotal">
           <p>Subtotal</p>
           <p class="cart_amount">{{$cart->currency_symbol}}{{$final_total_price}}</p>
       </div>
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
       <div class="cart_subtotal ">
           <p>Discount</p>
           <p class="cart_amount"><span>-</span> {{$cart->currency_symbol}}{{$discount}}</p>
       </div>
    @endif
       <div class="cart_subtotal">
           <p>Total</p>
           <p class="cart_amount">{{$cart->currency_symbol}}@if(!empty($checkUserCoupon))
           {{$final_amount}}
          @else
           {{$final_total_price}}
          @endif</p>
       </div>
       <div class="checkout_btn btn btn-light">
           <a href="{{url('/checkout.html')}}" class="btn btn-warning">Pay with <span style="color:#0a2e8c ">pay</span><span style="color:#149dea">pal</span></a>
           

       </div>
    </div>
</div>
</div>
</div>
</div>
<!--coupon code area end-->
</div>
</div>

@else
<div class="" style="text-align: center;
    padding: 200px;">
    <img src="http://luxuryeyewear.in/img/Capture.JPG" style="width:200px;">
<h3>Your Cart is Empty!</h3>
</div>
@endif

@endsection
