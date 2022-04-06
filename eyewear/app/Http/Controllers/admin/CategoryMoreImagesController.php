<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\admin_model\CategoryMoreImages;
use App\Admin_model\ImageResize;
use Intervention\Image\Facades\Image;

class CategoryMoreImagesController extends Controller
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
        $more_images = CategoryMoreImages::where('category_id',$request->product_id)->get();
        return view('admin.category-more-images', compact('more_images','category_parent_id','sub_cat_id','final_cat_id','product_id'));
    }

    public function add_more_images(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $sub_cat_id = $request->sub_cat_id;
        $final_cat_id = $request->final_cat_id;
        $product_id = $request->product_id;

        $request->validate([
            'category_image_name.*' => 'image|mimes:png,jpg,jpeg'
        ],[
            'category_image_name.*.image' => 'File must be an image',
            'category_image_name.*.mimes' => 'Image type must be a ( jpg, jpeg or png )'
        ]);

    // Fetch Image Size from Image Resize Table START
        $image_resize_data = ImageResize::where('resize_section_name','CategoryMoreImages')->first();
        if(!empty($image_resize_data)){
            $resize_width=$image_resize_data->resize_width;
            $resize_height=$image_resize_data->resize_height;
        }else{
            $resize_width=179;
            $resize_height=150;
        }

    // Fetch Image Size from Image Resize Table END

        $images = array();
        if($files=$request->file('category_image_name')){
            foreach($files as $file){
             $category_image_name = rand(100000000,500000000).".".$file->getClientOriginalExtension();
             $destinationPath = public_path('/uploaded_files/category_more_images');
             $resize_cat_more_image = Image::make($file->getRealPath());
             $resize_cat_more_image->resize($resize_width,$resize_height, function($constraint){
                $constraint->aspectRatio();
             })->save($destinationPath . '/' . $category_image_name);
            $images[] = $category_image_name;
            }
        }
    // INSERT DATA

    foreach($images as $image){
        CategoryMoreImages::create([ 'category_id' => $product_id, 'category_image_name' => $image ]);
    }
    return redirect('/admin/manage-product/more-images/'.$category_parent_id.'/'.$sub_cat_id.'/'.$final_cat_id.'/'.$product_id)->with('success','Images Added Successfully...!');
    }

    public function delete_more_image(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $sub_cat_id = $request->sub_cat_id;
        $final_cat_id = $request->final_cat_id;
        $product_id = $request->product_id;

        $remove_image = CategoryMoreImages::findOrFail($request->id, ['category_image_name']);
        $remove_image_path = "uploaded_files/category_more_images/".$remove_image->category_image_name;
        @unlink($remove_image_path);

        CategoryMoreImages::where('id', $request->id)->delete();
        return redirect('/admin/manage-product/more-images/'.$category_parent_id.'/'.$sub_cat_id.'/'.$final_cat_id.'/'.$product_id)->with('success','Image Deleted Successfully...!');

    }
}
