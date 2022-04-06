<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use PDF;
use Mail;
use App\Admin_model\Admin;
use App\User;
use App\Admin_model\Category;

class OrderController extends Controller
{
    protected $admin_data;
	public function __construct(){
	    $this->admin_data = Admin::where('admin_type','Admin')->first();
		$this->middleware('auth:admin');
	}
  public function index(){
  	$orders = DB::table('orders')->orderBy('id','desc')->paginate(50);
    return view('admin.manage-order',compact('orders'));
  }

  public function order_detail(Request $request){
  	$order_id = $request->id;
  	$order_parent_data = DB::table('orders')->where('id',$order_id)->first();

  	$order_detail = DB::table('order_details')->where('order_id',$order_id)->where('order_parent_id',0)->paginate(10);
  	return view('admin.order-detail',compact('order_detail','order_id','order_parent_data'));
  }

 public function view_address(Request $request){
     $order_id = $request->order_id;
     $address = DB::table('orders')->where('id',$order_id)->first();
     return view('admin.view-address',compact('address'));
 }

  public function bottom_button_action_orders(Request $request){

  	  $order_ids = $request->order_ids;
        $request_for = $request->req_for;
        if($request_for =="Delete"){

        //Del Invoice
        for($i=0;$i<COUNT($order_ids);$i++){    
         $del_inv = DB::table('invoices')->where('order_id',$order_ids[$i])->first();
        if(!empty($del_inv)){
         $inv_file = "invoice/".$del_inv->invoice_pdf;
         @unlink($inv_file);
         DB::table('invoices')->where('order_id',$order_ids[$i])->delete();  
        }}      
         $order_details = DB::table('order_details')->whereIn('order_id', $order_ids)->get();
         foreach($order_details as $ord){
           DB::table('order_coating')->where('order_id',$ord->id)->delete();     
            $prescription_path = "uploaded_files/prescription/".$ord->uploaded_prescription;
            @unlink($prescription_path);
         }
            DB::table('order_details')->whereIn('order_id', $order_ids)->delete();
            DB::table('orders')->whereIn('id', $order_ids)->delete();
            $sess_msg = "Selected Order(s) Deleted...";
        }else if($request_for == "Paid" || $request_for == "Unpaid"){
        DB::table('orders')->whereIn('id', $order_ids)->update(["order_payment_status" => $request_for]);
        $sess_msg = "Selected Order(s) Payment Status Updated...";
     }else if($request_for=="Dispatch"){
        // Mail Sent
      for($i=0;$i<COUNT($order_ids);$i++){    
        $info['order_id'] = $order_ids[$i];
        $user_id = DB::table('orders')->where('id',$order_ids[$i])->select('order_user_id')->first();
        
        $user = DB::table('users')->where('id',$user_id->order_user_id)->first(); 
        
        Mail::send('email_template.order-dispatch-mail', $info, function($message) use($user) {
        $message->to($user->email,$user->name)
         ->cc($this->admin_data->email,$this->admin_data->admin_company_name)
        ->subject('Order is Disptach From '.$this->admin_data->email)
        ->from($this->admin_data->email,$this->admin_data->admin_company_name);
      });
      }
          
        DB::table('orders')->whereIn('id', $order_ids)->update(["order_delivery_status" => $request_for]);
        $sess_msg = "Selected Order(s) Status Updated...";
    }
    else if($request_for=="Shipped"){
        // Mail Sent
      for($i=0;$i<COUNT($order_ids);$i++){    
        $info['order_id'] = $order_ids[$i];
        $user_id = DB::table('orders')->where('id',$order_ids[$i])->select('order_user_id')->first();
        
        $user = DB::table('users')->where('id',$user_id->order_user_id)->first(); 
        
        Mail::send('email_template.order-shipped-mail', $info, function($message) use($user) {
        $message->to($user->email,$user->name)
         ->cc($this->admin_data->email,$this->admin_data->admin_company_name)
        ->subject('Order is ready for shipment From '.$this->admin_data->email)
        ->from($this->admin_data->email,$this->admin_data->admin_company_name);
      });
      }
          
        DB::table('orders')->whereIn('id', $order_ids)->update(["order_delivery_status" => $request_for]);
        $sess_msg = "Selected Order(s) Status Updated...";
    }
    else if($request_for=="Out For Delivery"){
        // Mail Sent
      for($i=0;$i<COUNT($order_ids);$i++){    
        $info['order_id'] = $order_ids[$i];
        $user_id = DB::table('orders')->where('id',$order_ids[$i])->select('order_user_id')->first();
        
        $user = DB::table('users')->where('id',$user_id->order_user_id)->first(); 
        
        Mail::send('email_template.order-out-for-delivery-mail', $info, function($message) use($user) {
        $message->to($user->email,$user->name)
         ->cc($this->admin_data->email,$this->admin_data->admin_company_name)
        ->subject('Order is out for delivery From '.$this->admin_data->email)
        ->from($this->admin_data->email,$this->admin_data->admin_company_name);
      });
      }
          
        DB::table('orders')->whereIn('id', $order_ids)->update(["order_delivery_status" => $request_for]);
        $sess_msg = "Selected Order(s) Status Updated...";
    }
    else if($request_for=="Delivered"){
        // Mail Sent
      for($i=0;$i<COUNT($order_ids);$i++){    
        $info['order_id'] = $order_ids[$i];
        $user_id = DB::table('orders')->where('id',$order_ids[$i])->select('order_user_id')->first();
        
        $user = DB::table('users')->where('id',$user_id->order_user_id)->first(); 
        
        Mail::send('email_template.order-delivered-mail', $info, function($message) use($user) {
        $message->to($user->email,$user->name)
         ->cc($this->admin_data->email,$this->admin_data->admin_company_name)
        ->subject('Order is delivered From '.$this->admin_data->email)
        ->from($this->admin_data->email,$this->admin_data->admin_company_name);
      });
      }
          
        DB::table('orders')->whereIn('id', $order_ids)->update(["order_delivery_status" => $request_for]);
        $sess_msg = "Selected Order(s) Status Updated...";
    }
    
    else if($request_for=="Cancel"){
        // Mail Sent
      for($i=0;$i<COUNT($order_ids);$i++){    
        $info['order_id'] = $order_ids[$i];
        $user_id = DB::table('orders')->where('id',$order_ids[$i])->select('order_user_id')->first();
        
        $user = DB::table('users')->where('id',$user_id->order_user_id)->first(); 
        
        Mail::send('email_template.order-cancel-mail', $info, function($message) use($user) {
        $message->to($user->email,$user->name)
         ->cc($this->admin_data->email,$this->admin_data->admin_company_name)
        ->subject('Order is cancelled From '.$this->admin_data->email)
        ->from($this->admin_data->email,$this->admin_data->admin_company_name);
      });
      }
          
        DB::table('orders')->whereIn('id', $order_ids)->update(["order_delivery_status" => $request_for]);
        $sess_msg = "Selected Order(s) Status Updated...";
    }
    
    else if($request_for=="Hold"){
        // Mail Sent
      for($i=0;$i<COUNT($order_ids);$i++){    
        $info['order_id'] = $order_ids[$i];
        $user_id = DB::table('orders')->where('id',$order_ids[$i])->select('order_user_id')->first();
        
        $user = DB::table('users')->where('id',$user_id->order_user_id)->first(); 
        
        Mail::send('email_template.order-hold-mail', $info, function($message) use($user) {
        $message->to($user->email,$user->name)
         ->cc($this->admin_data->email,$this->admin_data->admin_company_name)
        ->subject('Order is hold From '.$this->admin_data->email)
        ->from($this->admin_data->email,$this->admin_data->admin_company_name);
      });
      }
          
        DB::table('orders')->whereIn('id', $order_ids)->update(["order_delivery_status" => $request_for]);
        $sess_msg = "Selected Order(s) Status Updated...";
    }
    
    else if($request_for=="Refund"){
        // Mail Sent
      for($i=0;$i<COUNT($order_ids);$i++){    
        $info['order_id'] = $order_ids[$i];
        $user_id = DB::table('orders')->where('id',$order_ids[$i])->select('order_user_id')->first();
        
        $user = DB::table('users')->where('id',$user_id->order_user_id)->first(); 
        
        Mail::send('email_template.order-refund-mail', $info, function($message) use($user) {
        $message->to($user->email,$user->name)
         ->cc($this->admin_data->email,$this->admin_data->admin_company_name)
        ->subject('Order is refunded From '.$this->admin_data->email)
        ->from($this->admin_data->email,$this->admin_data->admin_company_name);
      });
      }
          
        DB::table('orders')->whereIn('id', $order_ids)->update(["order_delivery_status" => $request_for]);
        $sess_msg = "Selected Order(s) Status Updated...";
    }
    else if($request_for=="Pending"){
        // Mail Sent
      for($i=0;$i<COUNT($order_ids);$i++){    
        $info['order_id'] = $order_ids[$i];
        $user_id = DB::table('orders')->where('id',$order_ids[$i])->select('order_user_id')->first();
        
        $user = DB::table('users')->where('id',$user_id->order_user_id)->first(); 
        
        Mail::send('email_template.order-pending-mail', $info, function($message) use($user) {
        $message->to($user->email,$user->name)
         ->cc($this->admin_data->email,$this->admin_data->admin_company_name)
        ->subject('Order is in process From '.$this->admin_data->email)
        ->from($this->admin_data->email,$this->admin_data->admin_company_name);
      });
      }
          
        DB::table('orders')->whereIn('id', $order_ids)->update(["order_delivery_status" => $request_for]);
        $sess_msg = "Selected Order(s) Status Updated...";
    }
    
    return back()->with('success',$sess_msg);	
  }

  public function get_prescription($order_detail_id){
     $prescription = DB::table('order_details')->where('id',$order_detail_id)->first();
     return view('admin.view-prescription',compact('prescription'));
  }
  
  public function get_coating($order_detail_id){
     $coatings = DB::table('order_coating')->where('order_id',$order_detail_id)->get();
     return view('admin.view-order-coating',compact('coatings'));
  }
  
  public function update_tracking(Request $request){
      $order_id  = $request->order_id;
      $tracking_no = $request->tracking_no;
      DB::table('orders')->where('id',$order_id)->update(['tracking_no'=>$tracking_no]);
      return back()->with('success','Tracking no updated...!');
  }
  
  public function print_order($order_id){
     $order = DB::table('orders')->where('id',$order_id)->first();
     $order_detail = DB::table('order_details')->where('order_id',$order_id)->get();
     $user = User::where('id',$order->order_user_id)->first();

     $info['order'] = $order;
     $info['order_detail'] = $order_detail;
     $info['user'] = $user;
     $pdf = PDF::loadView('admin.order-receipt',$info);
     $pdf->setOptions(['isPhpEnabled'=>true,'isRemoteEnabled'=>true]);
     return $pdf->download('receipt.pdf');
  }
  
}
