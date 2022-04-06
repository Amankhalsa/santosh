<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin_model\Color;
use App\Admin_model\ProductColor;
use Image;

class ColorController extends Controller
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
    	$colors = Color::where('product_id',$product_id)->where('color_parent_id',0)->get();
    	return view('admin.color',compact('colors','category_parent_id','sub_cat_id','final_cat_id','product_id'));
    }

    public function add_color_form(Request $request){
    	$category_parent_id = $request->cat_parent_id;
    	$sub_cat_id = $request->sub_cat_id;
    	$final_cat_id = $request->final_cat_id;
    	$product_id = $request->product_id;

        $product_colors = ProductColor::all();

    	return view('admin.addedit-color',compact('category_parent_id','sub_cat_id','final_cat_id','product_id','product_colors'));
    }

    public function add_color(Request $request){
    	$category_parent_id = $request->cat_parent_id;
    	$sub_cat_id = $request->sub_cat_id;
    	$final_cat_id = $request->final_cat_id;
    	$product_id = $request->product_id;

         $request->validate([
            'image.*' => 'image|mimes:png,jpg,jpeg'
        ],[
            'image.*.image' => 'File must be an image',
            'image.*.mimes' => 'Image type must be a ( jpg, jpeg or png )'
        ]);

          $images = array();
        if($files=$request->file('image')){
            foreach($files as $file){
             $image_name = rand(100000000,500000000).".".$file->getClientOriginalExtension();
             $destinationPath = public_path('/uploaded_files/category_more_images');
             $resize_image_logo = Image::make($file->getRealPath());
             $resize_image_logo->resize(750,750, function($constraint){
                $constraint->aspectRatio();
             })->save($destinationPath . '/' . $image_name);
            $images[] = $image_name;
            }
        }

        $color = new Color;
        $color->product_id = $product_id;
        $color->color = $request->color;
    	$color->save();

        foreach($images as $image){
        Color::create([ 'image' => $image, 'color_parent_id' => $color->id, 'product_id' => $product_id ]);
    }

    	return back()->with('success','Color added successfully...!');
    }

    public function edit_color(Request $request){
    	$category_parent_id = $request->cat_parent_id;
    	$sub_cat_id = $request->sub_cat_id;
    	$final_cat_id = $request->final_cat_id;
    	$product_id = $request->product_id;
    	$color_id = $request->id;
        $product_colors = ProductColor::all();

    	$edit_color = Color::find($color_id);
    	return view('admin.addedit-color',compact('edit_color','category_parent_id','sub_cat_id','final_cat_id','product_id','product_colors'));
    }

    public function update_color(Request $request){
    	$category_parent_id = $request->cat_parent_id;
    	$sub_cat_id = $request->sub_cat_id;
    	$final_cat_id = $request->final_cat_id;
    	$product_id = $request->product_id;
    	$color_id = $request->id;
 
          $request->validate([
            'image.*' => 'image|mimes:png,jpg,jpeg'
        ],[
            'image.*.image' => 'File must be an image',
            'image.*.mimes' => 'Image type must be a ( jpg, jpeg or png )'
        ]);

          $images = array();
        if($files=$request->file('image')){
            foreach($files as $file){
             $image_name = rand(100000000,500000000).".".$file->getClientOriginalExtension();
             $destinationPath = public_path('/uploaded_files/category_more_images');
             $resize_image_logo = Image::make($file->getRealPath());
             $resize_image_logo->resize(750,750, function($constraint){
                $constraint->aspectRatio();
             })->save($destinationPath . '/' . $image_name);
            $images[] = $image_name;
            }
        }

    	Color::where('id',$color_id)->update([
    		'product_id' => $product_id,
    		'color' => $request->color
    	]);

         foreach($images as $image){
        Color::create([ 'image' => $image, 'color_parent_id' => $color_id, 'product_id' => $product_id ]);
        }

    	return back()->with('success','Color updated successfully...!');
    }

    public function bottom_button_color(Request $request){
            $color_ids = $request->color_ids;
            $request_for = $request->req_for;
            if($request_for =="Delete"){
               for($i=0;$i<COUNT($color_ids);$i++){
                  $color_images = Color::where('color_parent_id',$color_ids[$i])->get();
                   foreach($color_images as $image){
                    $color_path = "uploaded_files/category_more_images/".$image->image;
                    @unlink($color_path);
                    Color::where('id',$image->id)->delete(); 
                   } 
                }
                Color::whereIn('id', $color_ids)->delete();
                $sess_msg = "Selected Color Deleted...";
            }
        return back()->with('success',$sess_msg);
    }

     public function remove_color_image(Request $request){
        $remove_image = Color::findOrFail($request->id, ['image']);
        $remove_image_path = "uploaded_files/category_more_images/".$remove_image->image;
        @unlink($remove_image_path);

        Color::where('id', $request->id)->delete();
        return back()->with('success','Image removed successfully...!');
    }
}
