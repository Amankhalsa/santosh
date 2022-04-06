<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Admin_model\Admin;
use App\Admin_model\Category;
use DB;
use PDF;
use Auth;
use Session;
use Mail;
use App\User;

class CheckoutController extends Controller
{
	protected $date;
	protected $admin_data;
	protected $reciever_name;
	protected $reciever_email;
	protected $ip_country;
	protected $order_ip;
	protected $shipping_charges;
	
	public function __construct(){
	    ini_set('memory_limit', '-1');
        $this->middleware('auth:user');

		$this->date = Date('Y-m-d');
		$this->admin_data = Admin::where('admin_type','Admin')->first();
		if(Auth::guard('user')->check()){
		 $this->reciever_name = Auth::guard('user')->user()->name;
		 $this->reciever_email = Auth::guard('user')->user()->email;
		}
		
        $this->date = Date('Y-m-d');
        $ip = \Request::ip();
        //$ip = '1.32.239.255';
        $location = \Location::get($ip);
        $this->ip_country=$location->countryName;
        //$this->ip_country="India";
        $this->order_ip = $ip;
        
        if($this->ip_country=="India"){
         $this->shipping_charges = $this->admin_data->shipping_charges_domestic;
       }else{
         $this->shipping_charges = $this->admin_data->shipping_charges_international;
       }
	}

    public function index(){
      
        $ip_country = $this->ip_country;
        $dial_codes = DB::table('countries')->select(['phonecode','name'])->get();
        $states = DB::table('states')->get();
     
        $countries = DB::table('countries')->get();
        $shipping_address = DB::table('shipping_address')->where('user_id',Auth::guard('user')->user()->id)->first();

        $carts = Cart::where('session_id',Session::get('session_id'))->get();
        $shipping_charges = $this->shipping_charges;
        return view('checkout',compact('dial_codes','states','countries','carts','shipping_address','ip_country','shipping_charges'));
    }


    public function address_form_submit(Request $request){
        $ship_to_different_address="";
    	 $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email,'.Auth::guard('user')->user()->id,
            'mobile' => 'required|numeric|unique:users,mobile,'.Auth::guard('user')->user()->id,
            'city' => 'required',
            'pincode' => 'required',
            'address' => 'required',
            'country' => 'required',
            'state' => 'required'
        ]);	
        

    	if ($request->ship_to_different_address) {
		  $request->validate([
            'ship_name' => 'required|string',
            'ship_email' => 'required|string|email',
            'ship_mobile' => 'required|numeric',
            'ship_city' => 'required',
            'ship_pincode' => 'required',
            'ship_address' => 'required',
            'ship_country' => 'required',
            'ship_state' => 'required'
        ]);	
		}
    	
$check_row = DB::table('shipping_address')->where('user_id',Auth::guard('user')->user()->id)->count();
   if($check_row>0){

     $request->validate([
            'ship_name' => 'required|string',
            'ship_email' => 'required|string|email',
            'ship_mobile' => 'required|numeric|digits:10',
            'ship_city' => 'required',
            'ship_pincode' => 'required',
            'ship_address' => 'required',
            'ship_country' => 'required',
            'ship_state' => 'required'
        ]); 

    }
	
       User::where('id',Auth::guard('user')->user()->id)->update([
        'name' => $request->name,
        'email' => $request->email,
        'mobile' => $request->mobile,
        'city' => $request->city,
        'pincode' => $request->pincode,
        'state' => $request->state,
        'country' => $request->country,
        'address' => $request->address
    ]);    

if (isset($request->ship_to_different_address)) {
 $ship_to_different_address = "Yes";
}else{
 $ship_to_different_address = "No";   
}

if($ship_to_different_address=="Yes"){
$check_row = DB::table('shipping_address')->where('user_id',Auth::guard('user')->user()->id)->count();
   if($check_row>0){
   	  DB::table('shipping_address')->where('user_id',Auth::guard('user')->user()->id)->update([
        'ship_name' => $request->ship_name,
        'ship_email' => $request->ship_email,
        'ship_mobile' => $request->ship_mobile,
        'ship_city' => $request->ship_city,
        'ship_pincode' => $request->ship_pincode,
        'ship_state' => $request->ship_state,
        'ship_country' => $request->ship_country,
        'ship_to_diff_addr' => $ship_to_different_address,
        'ship_address' => $request->ship_address
    ]); 
   }else{
   			DB::table('shipping_address')->insert([
        	'user_id' => Auth::guard('user')->user()->id,
        	'ship_name' => $request->ship_name,
	        'ship_email' => $request->ship_email,
	        'ship_mobile' => $request->ship_mobile,
	        'ship_city' => $request->ship_city,
	        'ship_pincode' => $request->ship_pincode,
	        'ship_state' => $request->ship_state,
	        'ship_country' => $request->ship_country,
            'ship_to_diff_addr' => $ship_to_different_address,
	        'ship_address' => $request->ship_address
    ]);
   }}
	   		

    return back()->with('success','Your details updated successfully...!');		

    }

    public function pay_now(Request $request){
     $ip_country = $this->ip_country;
     $payment_method = $request->payment_method;
     $order_amount=0;
     $discount=0;
     $final_amount=0;
     $order_coupon_id=0;
     $product_net_price=0;
     $carts = Cart::where('session_id',Session::get('session_id'))->get();	

$coat_price="0.00";
foreach($carts as $cart){
    
$check_cart_coating = DB::table('cart_coating')->where('cart_id',$cart->id)->count();    
if($check_cart_coating>0){
$coating_data = DB::table('cart_coating')->where('cart_id',$cart->id)->get();
 foreach($coating_data as $data){
       $coat_price += $data->coating_price;
  }
}

if(!empty($cart->lens_id)){
$order_amount += ($cart->price*$cart->quantity)+($cart->lens_price*$cart->lens_qty)+$cart->vision_price+$cart->lens_color_price+$cart->prism_price;    
}else{
 $order_amount += ($cart->price*$cart->quantity)+($cart->lens_price*$cart->lens_qty);    
}    

}

$order_amount += $coat_price;

$checkUserCoupon = DB::table('user_coupon')->where('user_id',Auth::guard('user')->user()->id)->where('status','Applied')->first(); 
if(!empty($checkUserCoupon)){
$order_coupon_id = $checkUserCoupon->coupon_id;	
$coupon = DB::table('coupons')->where('id',$checkUserCoupon->coupon_id)->first();
  if($coupon->coupon_type == "Fixed"){
        $discount = getCurrencyPrice($coupon->coupon_amount);
        $final_amount = $order_amount - $discount; 
      }else if($coupon->coupon_type == "Percent_off"){
        $discount = ($order_amount/100)*$coupon->coupon_amount;
        $final_amount = $order_amount - $discount;  
      }
DB::table('user_coupon')->where('user_id',Auth::guard('user')->user()->id)->update([
 'status'=>'Used' ]);     
}else{
	$final_amount = $order_amount;
}       

$state_name = DB::table('states')->select('name')->where('id',Auth::guard('user')->user()->state)->first();
$country_name = DB::table('countries')->select('name')->where('id',Auth::guard('user')->user()->country)->first();
$shipp_addr = DB::table('shipping_address')->where('user_id',Auth::guard('user')->user()->id)->first();
if(!empty($shipp_addr)){
 if($shipp_addr->ship_to_diff_addr=="Yes"){

$ship_state_name = DB::table('states')->select('name')->where('id',$shipp_addr->ship_state)->first();
$ship_country_name = DB::table('countries')->select('name')->where('id',$shipp_addr->ship_country)->first();

// ADD SHIPPING PRICE
$final_amount+=$this->shipping_charges;

       $order_id = DB::table('orders')->insertGetId([
            'order_user_id' => Auth::guard('user')->user()->id,
            'order_amount'  => $order_amount,
            'order_net_amount' => $final_amount,
            'order_discount' => $discount,
            'order_coupon_id' => $order_coupon_id,
            'order_payment_method' => $payment_method,
            'order_delivery_status' => 'Pending',
            'order_currency_code' => getCurrencyCode($this->ip_country),
            'order_currency_symbol' => getCurrencySymbol($this->ip_country),
            'order_date' => $this->date,
            'bill_name' => Auth::guard('user')->user()->name,
            'bill_email' => Auth::guard('user')->user()->email,
            'bill_mobile' => Auth::guard('user')->user()->mobile,
            'bill_address' => Auth::guard('user')->user()->address,
            'bill_city' => Auth::guard('user')->user()->city,
            'bill_state' => $state_name->name,
            'bill_pincode' => Auth::guard('user')->user()->pincode,
            'bill_country' => $country_name->name,
            'ship_name' => $shipp_addr->ship_name,
            'ship_email' => $shipp_addr->ship_email,
            'ship_mobile' => $shipp_addr->ship_mobile,
            'ship_city' => $shipp_addr->ship_city,
            'ship_pincode' => $shipp_addr->ship_pincode,
            'ship_state' => $ship_state_name->name,
            'ship_country' => $ship_country_name->name,
            'ship_address' => $shipp_addr->ship_address,
            'order_ip' => $this->order_ip,
            'order_country' => $this->ip_country,
            'shipping_charges' => $this->shipping_charges
             ]);
 }else{
       $order_id = DB::table('orders')->insertGetId([
            'order_user_id' => Auth::guard('user')->user()->id,
            'order_amount'  => $order_amount,
            'order_net_amount' => $final_amount,
            'order_discount' => $discount,
            'order_coupon_id' => $order_coupon_id,
            'order_payment_method' => $payment_method,
             'order_currency_code' => getCurrencyCode($this->ip_country),
            'order_currency_symbol' => getCurrencySymbol($this->ip_country),
            'order_delivery_status' => 'Pending',
            'order_date' => $this->date,
            'bill_name' => Auth::guard('user')->user()->name,
            'bill_email' => Auth::guard('user')->user()->email,
            'bill_mobile' => Auth::guard('user')->user()->mobile,
            'bill_address' => Auth::guard('user')->user()->address,
            'bill_city' => Auth::guard('user')->user()->city,
            'bill_state' => $state_name->name,
            'bill_pincode' => Auth::guard('user')->user()->pincode,
            'bill_country' => $country_name->name,
            'ship_name' => Auth::guard('user')->user()->name,
            'ship_email' => Auth::guard('user')->user()->email,
            'ship_mobile' => Auth::guard('user')->user()->mobile,
            'ship_city' => Auth::guard('user')->user()->city,
            'ship_pincode' => Auth::guard('user')->user()->pincode,
            'ship_state' => $state_name->name,
            'ship_country' => $country_name->name,
            'ship_address' => Auth::guard('user')->user()->address,
            'order_ip' => $this->order_ip,
            'order_country' => $this->ip_country,
            'shipping_charges' => $this->shipping_charges
             ]);
 }
}else{
       $order_id = DB::table('orders')->insertGetId([
            'order_user_id' => Auth::guard('user')->user()->id,
            'order_amount'  => $order_amount,
            'order_net_amount' => $final_amount,
            'order_discount' => $discount,
            'order_coupon_id' => $order_coupon_id,
            'order_payment_method' => $payment_method,
             'order_currency_code' => getCurrencyCode($this->ip_country),
            'order_currency_symbol' => getCurrencySymbol($this->ip_country),
            'order_delivery_status' => 'Pending',
            'order_date' => $this->date,
            'bill_name' => Auth::guard('user')->user()->name,
            'bill_email' => Auth::guard('user')->user()->email,
            'bill_mobile' => Auth::guard('user')->user()->mobile,
            'bill_address' => Auth::guard('user')->user()->address,
            'bill_city' => Auth::guard('user')->user()->city,
            'bill_state' => $state_name->name,
            'bill_pincode' => Auth::guard('user')->user()->pincode,
            'bill_country' => $country_name->name,
            'ship_name' => Auth::guard('user')->user()->name,
            'ship_email' => Auth::guard('user')->user()->email,
            'ship_mobile' => Auth::guard('user')->user()->mobile,
            'ship_city' => Auth::guard('user')->user()->city,
            'ship_pincode' => Auth::guard('user')->user()->pincode,
            'ship_state' => $state_name->name,
            'ship_country' => $country_name->name,
            'ship_address' => Auth::guard('user')->user()->address,
            'order_ip' => $this->order_ip,
            'order_country' => $this->ip_country,
            'shipping_charges' => $this->shipping_charges
             ]);
}
    

 $carts = Cart::where('session_id',Session::get('session_id'))->get();
foreach($carts as $cart){
if(!empty($cart->lens_id)){
$product_net_price = ($cart->price*$cart->quantity)+($cart->lens_price*$cart->lens_qty)+$cart->vision_price+$cart->lens_color_price+$cart->prism_price+$coat_price;    
}else{
$product_net_price = ($cart->price*$cart->quantity)+($cart->lens_price*$cart->lens_qty);    
}    

 //Update Qty
$update_qty;
$check_qty = Category::where('id',$cart->product_id)->first();
if($check_qty->category_qty<$cart->quantity){
$update_qty = $check_qty->category_qty;    
}else{
$update_qty = $cart->quantity;    
}
Category::where('id',$cart->product_id)->decrement('category_qty',$update_qty);
 
$order_detail_id = DB::table('order_details')->insertGetId([
	        'order_id' => $order_id,	
	    	'order_user_id' => Auth::guard('user')->user()->id,
	    	'product_id' => $cart->product_id,
	    	'product_qty'  => $update_qty,
	    	'lens_qty'  => $update_qty,
	    	'product_color'  => $cart->color,
	    	'product_unit_price'  => $cart->price,
	    	'product_net_price' => $product_net_price,
	    	'order_type' => 'Product',
            'vision_id'  => $cart->vision_id,
            'vision_price'  => $cart->vision_price,
            'lens_id'  => $cart->lens_id,
            'lens_color_id' => $cart->lens_color_id,
            'lens_color_price' => $cart->lens_color_price,
            'sph_right'  => $cart->sph_right,
            'sph_left'  => $cart->sph_left,
            'cyl_right'  => $cart->cyl_right,
            'cyl_left'  => $cart->cyl_left,
            'axis_right'  => $cart->axis_right,
            'axis_left'  => $cart->axis_left,
            'add_right'  => $cart->add_right,
            'add_left'  => $cart->add_left,
            'pupillary_distance'  => $cart->pupillary_distance,
            'pupillary_distance_right'  => $cart->pupillary_distance_right,
            'pupillary_distance_left'  => $cart->pupillary_distance_left,
            'is_pd2' => $cart->is_pd2,
            'is_power' => $cart->is_power,
            'is_prism' => $cart->is_prism,
            'prism_price' => $cart->prism_price,
            
            'prism_right_vertical' => $cart->prism_right_vertical,
            'prism_right_vertical_direction' => $cart->prism_right_vertical_direction,
            'prism_right_horizontal' => $cart->prism_right_horizontal,
            'prism_right_horizontal_direction' => $cart->prism_right_horizontal_direction,
            
            'prism_left_vertical' => $cart->prism_left_vertical,
            'prism_left_vertical_direction' => $cart->prism_left_vertical_direction,
            'prism_left_horizontal' => $cart->prism_left_horizontal,
            'prism_left_horizontal_direction' => $cart->prism_left_horizontal_direction,
            
            'prescription_comment' => $cart->prescription_comment,
            
            'is_tint' => $cart->is_tint,
            'uploaded_prescription'  => $cart->uploaded_prescription,
            'is_prescription_uploaded' => $cart->is_prescription_uploaded,
            'lens_price'  => $cart->lens_price,
            'frame_gst' => $cart->frame_gst,
            'lens_gst' => $cart->lens_gst,
	    	'order_date' => $this->date ]); 
	    
	    	
	    	
// Add Order Coating
   $check_cart_coating = DB::table('cart_coating')->where('cart_id',$cart->id)->count();    
    if($check_cart_coating>0){
    $coating_data = DB::table('cart_coating')->where('cart_id',$cart->id)->get();
   foreach($coating_data as $data){    
     DB::table('order_coating')->insert([
         'order_id'=>$order_detail_id,
         'coating_id'=>$data->coating_id,
         'coating_price'=>$data->coating_price,
         'date'=>date('Y-m-d')
         ]);
    }
   }	
}
    
    // Delete Cart Item against session id
    DB::table('cart_coating')->where('session_id',Session::get('session_id'))->delete();
    Cart::where('session_id',Session::get('session_id'))->delete();     
    
    if($payment_method=="Online"){
       $cashfree = config()->get('app');
       $action = ($cashfree['testMode']) ?
                'https://test.cashfree.com/billpay/checkout/post/submit' :
                'https://www.cashfree.com/checkout/post/submit';

        $appId = $cashfree['appID'];
        $secretKey = $cashfree['secretKey'];
        $orderCurrency = getCurrencyCode($this->ip_country);
        $orderAmount = $final_amount;
        $orderNote = $order_id;
       

        $returnUrl = url('cashfree/response');
        $notifyUrl = url('notify');

        $customerName = Auth::guard('user')->user()->name;
        $customerEmail = Auth::guard('user')->user()->email;
        $customerPhone = Auth::guard('user')->user()->mobile;
        $orderId = $order_id;

        $postData = array(
            "appId" => $appId,
            "orderId" => $orderId,
            "orderAmount" => $final_amount,
            "orderCurrency" => $orderCurrency,
            "orderNote" => $orderNote,
            "customerName" => $customerName,
            "customerPhone" => $customerPhone,
            "customerEmail" => $customerEmail,
            "returnUrl" => $returnUrl,
            "notifyUrl" => $notifyUrl,
        );

        ksort($postData);

        $signatureData = "";
        foreach ($postData as $key => $value) {
            $signatureData .= $key . $value;
        }
        $signature = hash_hmac('sha256', $signatureData, $secretKey, true);
        $signature = base64_encode($signature);
        
        return view('cashfree',compact('action','appId','orderId','orderAmount','orderCurrency','orderNote','customerName','customerEmail','customerPhone','returnUrl','notifyUrl','signature'));
    }

/* Generate Invoice */

    $info['order_id'] = $order_id;
    $pdf="";
    /*$info['invoice_no'] = generate_invoice_no();
    $pdf = PDF::loadView('invoice.invoice', $info);
    $pdf->setOptions(['isPhpEnabled' => true,'isRemoteEnabled' => true]);
    $filename = "invoice".rand(1111111,5555555).".pdf";
    $pdf->save('invoice/'.$filename);

    DB::table('invoices')->insert([
        'invoice_no' => generate_invoice_no(),
        'order_id' => $order_id,
        'invoice_pdf' => $filename,
        'invoice_date' => date('Y-m-d')
    ]);*/

/* Send Mail to User Start*/
    
    Mail::send('email_template.order-process-mail', $info, function($message) use($pdf) {
        $message->to(Auth::guard('user')->user()->email, Auth::guard('user')->user()->name)
        ->subject('Order in Process From '.$this->admin_data->email)
        //->attachData($pdf->output(), "invoice.pdf")
        ->from($this->admin_data->email,$this->admin_data->admin_company_name);
    });

/* Send Mail to User End*/


/* Send Mail to Admin Start*/
    
    Mail::send('email_template.order-process-mail', $info, function($message) {
        $message->to($this->admin_data->email, $this->admin_data->admin_company_name)
        ->subject('Order in Process From '.$this->admin_data->email)
        ->from($this->admin_data->email,$this->admin_data->admin_company_name);
    });

/* Send Mail to Admin End*/

if($payment_method == "COD"){
	return view('payment.success');
}
    

}

    public function get_amount(Request $request){
    $final_total_price=0;
    $final_amount=0;
    $checkUserCoupon = DB::table('user_coupon')->where('user_id',Auth::guard('user')->user()->id)->where('status','Applied')->first();
    $total_cart = DB::table('carts')->where('session_id',Session::get('session_id'))->get();
foreach($total_cart as $cart) {
if(!empty($cart->lens_id)){
    
$final_total_price += ($cart->price*$cart->quantity)+($cart->lens_price*$cart->lens_qty)+$cart->vision_price+$cart->lens_color_price;

}else{
$final_total_price += ($cart->price*$cart->quantity)+($cart->lens_price*$cart->lens_qty);    
    
}}

    if(empty($checkUserCoupon)){
        echo $final_total_price;
    }else{
        $coupon = DB::table('coupons')->where('id',$checkUserCoupon->coupon_id)->first();
        if($coupon->coupon_type == "Fixed"){
        $discount = getCurrencyPrice($coupon->coupon_amount);
        $final_amount = $final_total_price - $discount; 
      }else if($coupon->coupon_type == "Percent_off"){
        $discount = ($final_total_price/100)*$coupon->coupon_amount;
        $final_amount = $final_total_price - $discount;  
      }

      echo $final_amount;
    }

  }

 public function cashfreeSuccess(Request $request){
     
     if ($request->input('orderId')) {
         $cashfree = config()->get('app');
         $secretKey = $cashfree['secretKey'];
            $orderId = $request->input('orderId');
            $appointmentId=$request->input('appointment_id');
            $orderAmount = $request->input('orderAmount');
            $referenceId = $request->input('referenceId');
            $txStatus = $request->input('txStatus');
            $paymentMode = $request->input('paymentMode');
            $txMsg = $request->input('txMsg');
            $txTime = $request->input('txTime');
            $signature = $request->input('signature');
            $data = $orderId . $appointmentId . $orderAmount . $referenceId . $txStatus . $paymentMode . $txMsg . $txTime;
            $hash_hmac = hash_hmac('sha256', $data, $secretKey, true);
            $computedSignature = base64_encode($hash_hmac);
        if ($signature == $computedSignature) {
           $status = ($txStatus == 'SUCCESS') ? 1 : 2; 
           if($status==1){
               /* Generate Invoice */
    DB::table('orders')->where('id',$orderId)->update(['order_payment_status'=>'Paid']);
    
    $info['order_id'] = $orderId;
    $pdf="";
    /*$info['invoice_no'] = generate_invoice_no();
    $pdf = PDF::loadView('invoice.invoice', $info);
    $pdf->setOptions(['isPhpEnabled' => true,'isRemoteEnabled' => true]);
    $filename = "invoice".rand(1111111,5555555).".pdf";
    $pdf->save('invoice/'.$filename);

    DB::table('invoices')->insert([
        'invoice_no' => generate_invoice_no(),
        'order_id' => $orderId,
        'invoice_pdf' => $filename,
        'invoice_date' => date('Y-m-d')
    ]);*/

/* Send Mail to User Start*/
    
    Mail::send('email_template.order-process-mail', $info, function($message) use($pdf) {
        $message->to(Auth::guard('user')->user()->email, Auth::guard('user')->user()->name)
        ->subject('Order in Process From '.$this->admin_data->email)
        //->attachData($pdf->output(), "invoice.pdf")
        ->from($this->admin_data->email,$this->admin_data->admin_company_name);
    });

/* Send Mail to User End*/


/* Send Mail to Admin Start*/
    
    Mail::send('email_template.order-process-mail', $info, function($message) {
        $message->to($this->admin_data->email, $this->admin_data->admin_company_name)
        ->subject('Order in Process From '.$this->admin_data->email)
        ->from($this->admin_data->email,$this->admin_data->admin_company_name);
    });

/* Send Mail to Admin End*/
return redirect('/success');
           }else{
               return redirect('/fail');
           }
           
        }    
     }
 } 

}
