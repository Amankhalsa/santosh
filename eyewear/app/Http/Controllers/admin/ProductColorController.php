<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin_model\ProductColor;

class ProductColorController extends Controller
{
    public function __construct(){
    	$this->middleware('auth:admin');
    }

    public function index(){
    	$product_colors = ProductColor::get();
    	return view('admin.manage-product-colors',compact('product_colors'));
    }

    public function add_color(Request $request){
    	$color_name = $request->color_name;
    	$color_id = $request->color_id;
      if(!empty($request->color_id)){
         $color_data = ProductColor::findOrFail($color_id); 
      	 $request->validate([
            'color_name' => 'required|unique:product_colors,color_name,'.$color_id,
            'color_image_name' => 'image|mimes:png,jpg,jpeg'
        ]);
        
    // Color Image
    if($request->hasfile('color_image_name')){

  // Delete Old Image Start
     $image_path = "uploaded_files/color_image/".$color_data->color_image_name;
     if(file_exists($image_path)){
         @unlink($image_path);
     }
   // Delete Old Image End

$color_image = $request->file('color_image_name');
$color_image_name = rand(100000000,500000000).".".$color_image->getClientOriginalExtension();


  // Comment below lines if you dont'nt want original size image start
    $destinationPath = public_path('/uploaded_files/color_image');
    $color_image->move($destinationPath, $color_image_name);
  // Comment below lines if you dont'nt want original size image end

 $color_data->color_image_name = $color_image_name;
}    
        $color_data->color_name = $color_name;
        $color_data->update();
    	
    return back()->with('success','Color Updated successfully...!');
      }	else{
          
      	 $request->validate([
            'color_name' => 'required|unique:product_colors,color_name',
            'color_image_name' => 'required|image|mimes:png,jpg,jpeg'
        ]);
        
        // Color Image
        $color_image_name="";
        if($request->hasfile('color_image_name')){
        
        $color_image = $request->file('color_image_name');
        $color_image_name = rand(100000000,500000000).".".$color_image->getClientOriginalExtension();
        $destinationPath = public_path('/uploaded_files/color_image');
        $color_image->move($destinationPath, $color_image_name);
        
        }
        
      	ProductColor::create([
      	    'color_image_name' => $color_image_name,
    		'color_name' => $color_name
    	]);
    return back()->with('success','Color Added successfully...!');
      }	
    }

    public function bottom_button_action_product_colors(Request $request){
    	$product_color_ids = $request->product_color_ids;
    	 for($i=0;$i<COUNT($product_color_ids);$i++){
    	    $color_data = ProductColor::find($product_color_ids[$i]); 
    	    $image_path = "uploaded_files/color_image/".$color_data->color_image_name;
            @unlink($image_path);
    	 }
    	ProductColor::whereIn('id',$product_color_ids)->delete();
    	return back()->with('success','Color Deleted successfully...!');
    }
}
