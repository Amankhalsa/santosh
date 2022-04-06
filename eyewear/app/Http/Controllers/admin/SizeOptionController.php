<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin_model\SizeOption;

class SizeOptionController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
    	$category_parent_id = $request->cat_parent_id;
    	$sub_cat_id = $request->sub_cat_id;
    	$final_cat_id = $request->final_cat_id;
        $product_id = $request->product_id;
    	$size_options = SizeOption::where('product_id',$product_id)->get();
    	return view('admin.size-option',compact('size_options','category_parent_id','sub_cat_id','final_cat_id','product_id'));
    }

    public function add_size_option_form(Request $request){
    	$category_parent_id = $request->cat_parent_id;
    	$sub_cat_id = $request->sub_cat_id;
    	$final_cat_id = $request->final_cat_id;
        $product_id = $request->product_id;
    	return view('admin.addedit-size-option',compact('category_parent_id','sub_cat_id','final_cat_id','product_id'));
    }

    public function add_size_option(Request $request){
    	$category_parent_id = $request->cat_parent_id;
    	$sub_cat_id = $request->sub_cat_id;
    	$final_cat_id = $request->final_cat_id;
        $product_id = $request->product_id;
    	$request->validate([
    		'size' => 'required',
            'price' => 'required'
    	]);

    	SizeOption::create([
            'product_id' => $product_id,
    		'size' => $request->size,
            'price' => $request->price,
    		'status' => $request->status
    	]);

    	return back()->with('success','Size option added successfully...!');
    }

    public function edit_size_option(Request $request){
    	$category_parent_id = $request->cat_parent_id;
    	$sub_cat_id = $request->sub_cat_id;
    	$final_cat_id = $request->final_cat_id;
        $product_id = $request->product_id;
    	$size_option_id = $request->id;

    	$edit_size_option = SizeOption::find($size_option_id);
    	return view('admin.addedit-size-option',compact('edit_size_option','category_parent_id','sub_cat_id','final_cat_id','product_id'));
    }

    public function update_size_option(Request $request){
    	$category_parent_id = $request->cat_parent_id;
    	$sub_cat_id = $request->sub_cat_id;
    	$final_cat_id = $request->final_cat_id;
        $product_id = $request->product_id; 
    	$size_option_id = $request->id;

    	$request->validate([
    		'size' => 'required',
            'price' => 'required'
    	]);

    	SizeOption::where('id',$size_option_id)->update([
    		'size' => $request->size,
            'price' => $request->price,
            'status' => $request->status
    	]);

    	return back()->with('success','Size option updated successfully...!');
    }

    public function bottom_button_size_option(Request $request){
            $size_ids = $request->size_ids;
            $request_for = $request->req_for;
            if($request_for =="Delete"){
                SizeOption::whereIn('size_parent_id', $size_ids)->delete();
                SizeOption::whereIn('id', $size_ids)->delete();
                $sess_msg = "Selected Size Option Deleted...";
            }else{
            SizeOption::whereIn('id', $size_ids)->update(["status" => $request_for]);
            $sess_msg = "Selected Size Option Status Updated...";
        }
        return back()->with('success',$sess_msg);
    }

  /*####################################################################################*/
  
    public function size_list(Request $request){
    	$category_parent_id = $request->cat_parent_id;
    	$sub_cat_id = $request->sub_cat_id;
    	$final_cat_id = $request->final_cat_id;
    	$size_option_id = $request->size_option_id;

    	$sizes = SizeOption::where('size_parent_id',$size_option_id)->get();
    	return view('admin.size',compact('sizes','category_parent_id','sub_cat_id','final_cat_id','size_option_id'));
    }

      public function add_size_form(Request $request){
    	$category_parent_id = $request->cat_parent_id;
    	$sub_cat_id = $request->sub_cat_id;
    	$final_cat_id = $request->final_cat_id;
    	$size_option_id = $request->size_option_id;

    	return view('admin.addedit-size',compact('category_parent_id','sub_cat_id','final_cat_id','size_option_id'));
    }

        public function add_size(Request $request){
    	$category_parent_id = $request->cat_parent_id;
    	$sub_cat_id = $request->sub_cat_id;
    	$final_cat_id = $request->final_cat_id;
    	$size_option_id = $request->size_option_id;

    	$request->validate([
            'size' => 'required',
            'size_price' => 'required',
            'size_stock' => 'required'
    	]);

    	SizeOption::create([
    		'size_parent_id' => $size_option_id,
    		'size' => $request->size,
            'size_price' => $request->size_price,
            'size_stock' => $request->size_stock,
    		'status' => $request->status
    	]);

    	return back()->with('success','Size added successfully...!');
    }

      public function edit_size(Request $request){
    	$category_parent_id = $request->cat_parent_id;
    	$sub_cat_id = $request->sub_cat_id;
    	$final_cat_id = $request->final_cat_id;
    	$size_option_id = $request->size_option_id;
    	$size_id = $request->id;

    	$edit_size = SizeOption::find($size_id);
    	return view('admin.addedit-size',compact('edit_size','category_parent_id','sub_cat_id','final_cat_id','size_option_id'));
    }

       public function update_size(Request $request){
    	$category_parent_id = $request->cat_parent_id;
    	$sub_cat_id = $request->sub_cat_id;
    	$final_cat_id = $request->final_cat_id;
    	$size_option_id = $request->size_option_id;
    	$size_id = $request->id;

    	$request->validate([
    		'size' => 'required',
            'size_price' => 'required',
            'size_stock' => 'required'
    	]);

    	SizeOption::where('id',$size_id)->update([
    		'size' => $request->size,
            'size_price' => $request->size_price,
            'size_stock' => $request->size_stock,
    		'status' => $request->status
    	]);

    	return back()->with('success','Size updated successfully...!');
    }

    public function bottom_button_size(Request $request){
            $size_ids = $request->size_ids;
            $request_for = $request->req_for;
            if($request_for =="Delete"){
               
                SizeOption::whereIn('id', $size_ids)->delete();
                $sess_msg = "Selected Size Deleted...";
            }else{
            SizeOption::whereIn('id', $size_ids)->update(["status" => $request_for]);
            $sess_msg = "Selected Size Status Updated...";
        }
        return back()->with('success',$sess_msg);
    }
}
