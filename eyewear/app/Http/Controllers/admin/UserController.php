<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\User;
use DB;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(){
    	$users = User::orderBy('created_at','desc')->paginate(10);
    	return view('admin.manage-registration',compact('users'));
    }

    public function edit_user(Request $request){
    	$edit_user = User::findOrFail($request->id);
    	$dial_codes = DB::table('countries')->select(['phonecode','name'])->get();
        $states = DB::table('states')->get();
        $countries = DB::table('countries')->get();
    	return view('admin.addedit-registration',compact('edit_user','dial_codes','states','countries'));
    }

	//For fetching states
	public function getStates(Request $request)
	{
	 $states = DB::table("states")
	        ->where("country_id",$request->cid)
	        ->pluck("name","id");
	 return response()->json($states);
	}

    public function update_user(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required'
        ]);

      User::where('id',$request->id)->update([
        'name' => $request->name,
        'email' => $request->email,
        'dial_code' => $request->dial_code,
        'mobile' => $request->mobile,
        'city' => $request->city,
        'state' => $request->state,
        'pincode' => $request->pincode,
        'country' => $request->country,
        'address' => $request->address,
        'status' => $request->status
      ]); 
    return back()->with('success','User updated successfully...!');   
    }

    public function bottom_button_action_users(Request $request){
        $user_ids = $request->user_ids;
        $request_for = $request->req_for;
      if($request_for =="Delete"){
       for($i=0;$i<COUNT($user_ids);$i++){      
         $order = DB::table('orders')->where('order_user_id',$user_ids[$i])->first(); 
  if(!empty($order)){         
    //Del Invoice
    $del_inv = DB::table('invoices')->where('order_id',$order->id)->first();
      if(!empty($del_inv)){
         $inv_file = "invoice/".$del_inv->invoice_pdf;
         @unlink($inv_file);
         DB::table('invoices')->where('order_id',$order->id)->delete();  
      }
    $order_details = DB::table('order_details')->where('order_id', $order->id)->get();
        foreach($order_details as $ord){
        DB::table('order_coating')->where('order_id',$ord->id)->delete();     
        $prescription_path = "uploaded_files/prescription/".$ord->uploaded_prescription;
        @unlink($prescription_path);
        }
        
        DB::table('order_details')->where('order_id', $order->id)->delete();
        DB::table('orders')->where('id', $order->id)->delete();
        
        }
     User::where('id', $user_ids[$i])->delete();
     $sess_msg = "Selected User(s) Deleted...";       
       }  
       }else{
        User::whereIn('id', $user_ids)->update(["status" => $request_for]);
        $sess_msg = "Selected User(s) Status Updated...";
    }
    return back()->with('success',$sess_msg);
}

}
