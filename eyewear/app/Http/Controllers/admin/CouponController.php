<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin_model\Coupon;

class CouponController extends Controller
{
    public function __construct(){
    	$this->middleware('auth:admin');
    }

    public function index(){
    	$coupons = Coupon::all();
    	return view('admin.manage-coupon',compact('coupons'));
    }

    public function add_coupon_form(){
    	return view('admin.addedit-coupon');
    }

    public function add_coupon(Request $request){
    	$request->validate([
    		'coupon_code' => 'required|unique:coupons,coupon_code',
    		'coupon_amount' => 'required|numeric',
    		'coupon_desc' => 'required',
    		'coupon_condition' => 'required',
    		'coupon_expiry_date' => 'required'
    	]);

    	Coupon::create([
    		'coupon_code' => $request->coupon_code,
    		'coupon_desc' => $request->coupon_desc,
    		'coupon_amount' => $request->coupon_amount,
    		'coupon_condition' => $request->coupon_condition,
    		'coupon_type' => $request->coupon_type,
    		'coupon_status' => $request->coupon_status,
    		'coupon_expiry_date' => $request->coupon_expiry_date
    	]);

    	return back()->with('success','Coupon added successfully...!');
    }

    public function edit_coupon(Request $request){
    	$edit_coupon = Coupon::find($request->id);
    	return view('admin.addedit-coupon',compact('edit_coupon'));
    }

        public function update_coupon(Request $request){
    	$request->validate([
    		'coupon_code' => 'required|unique:coupons,coupon_code,'.$request->id,
    		'coupon_amount' => 'required|numeric',
    		'coupon_desc' => 'required',
    		'coupon_condition' => 'required',
    		'coupon_expiry_date' => 'required'
    	]);

    	Coupon::where('id',$request->id)->update([
    		'coupon_code' => $request->coupon_code,
    		'coupon_desc' => $request->coupon_desc,
    		'coupon_amount' => $request->coupon_amount,
    		'coupon_condition' => $request->coupon_condition,
    		'coupon_type' => $request->coupon_type,
    		'coupon_status' => $request->coupon_status,
    		'coupon_expiry_date' => $request->coupon_expiry_date
    	]);

    	return back()->with('success','Coupon updated successfully...!');
    }

        public function bottom_button_coupon(Request $request){
            $coupon_ids = $request->coupon_ids;
            $request_for = $request->req_for;
            if($request_for =="Delete"){
                Coupon::whereIn('id', $coupon_ids)->delete();
                $sess_msg = "Selected Coupon(s) Deleted...";
            }else{
            Coupon::whereIn('id', $coupon_ids)->update(["coupon_status" => $request_for]);
            $sess_msg = "Selected Coupon(s) Status Updated...";
        }
        return back()->with('success',$sess_msg);
    }

}
