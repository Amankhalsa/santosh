<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Admin_model\Admin;
use App\Admin_model\LensColorType;
use App\Admin_model\Lens;

class LensColorTypeController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $admin_data="";
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->admin_data = Admin::where("admin_type","Admin")->first();
    }

// **************************************************************************************

//Deleting Child records
    public function delete_child($id){
        $del_ids=array();
        $category_parent_id = $id;
        $child_ids = LensColorType::where('category_parent_id',$category_parent_id)->get();
        if($child_ids->isNotEmpty()){
         foreach($child_ids as $child){
           $this->delete_child($child->id);
           $del_ids[]=$child->id;
        
    
        }}
   //Deleting Nested Childs Images
       foreach($del_ids as $del_id){
       $delete_image = LensColorType::findOrFail($del_id, ['category_image_name','category_type']);
       $delete_image_path = "uploaded_files/lens/".$delete_image->category_image_name;
        @unlink($delete_image_path);
       

       }
   // Deleting Nested Childs
       LensColorType::whereIn('id',$del_ids)->delete();
   }

   //Deleting parent records
       public function delete_parent($parent_id){
   //Deleting Parent Image
        $del_img = LensColorType::findOrFail($parent_id, ['category_image_name','category_type']);
        $del_image_path = "uploaded_files/lens/".$del_img->category_image_name;
       
        @unlink($del_image_path);
        

   // Deleting Parent
       LensColorType::where('id',$parent_id)->delete();
   }

//***********************************************************************************************

    public function index(){
        $lens_color_types = LensColorType::where('category_parent_id','0')->orderBy('category_order_by')->paginate(8);
        return view('admin.manage-lens-color-type', compact('lens_color_types'));
    }

    // FUNCTIONS FOR MAIN CATEGORY START

    public function add_lens_color_type_form(Request $request){
        return view('admin.addedit-lens-color-type');
    }


    public function add_lens_color_type(Request $request){
        $request->validate([
            'category_image_name' => 'image|mimes:png,jpg,jpeg' ]);

    // Image uploading code
    $category_image_name="";
    if($request->hasfile('category_image_name')){

     $category_image = $request->file('category_image_name');
     $category_image_name = rand(100000000,500000000).".".$category_image->getClientOriginalExtension();


    // Comment below lines if you dont'nt want original size image
        $destinationPath = public_path('/uploaded_files/lens');
        $category_image->move($destinationPath, $category_image_name);

    }


    // Creating Category URL
   $category_slug_name = Str::slug($request->category_name, '-');
    // $category_slug_name = $request->category_slug_name;



    // INSERT DATA INTO DB

    $category = new LensColorType;
    $category->category_image_name = $category_image_name;
    $category->category_name = $request->category_name;
    $category->category_slug_name = $category_slug_name;
    $category->category_type = 'cat';
    $category->category_tag_line = $request->category_tag_line;
    $category->category_description = $request->category_description;
    $category->category_status = $request->category_status;

    $category->save();

    return back()->with('success','Lens Color type Added Successfuly...!');

    }

    public function edit_lens_color_type(Request $request){
          
       $edit_lens_color_type = LensColorType::findOrFail($request->id);
       
       return view('admin.addedit-lens-color-type', compact('edit_lens_color_type'));
    }


    public function update_lens_color_type(Request $request){
        $category_id = $request->id;
        $category = LensColorType::findOrFail($request->id);
        $request->validate([
            'category_image_name' => 'image|mimes:png,jpg,jpeg']);

    // Image uploading code
    if($request->hasfile('category_image_name')){

  // Delete Old Image Start
     $image_path = "uploaded_files/lens/".$category->category_image_name;
    
     if(file_exists($image_path)){
         @unlink($image_path);
     }
   // Delete Old Image End

$category_image = $request->file('category_image_name');
$category_image_name = rand(100000000,500000000).".".$category_image->getClientOriginalExtension();


      // Comment below lines if you dont'nt want original size image
        $destinationPath = public_path('/uploaded_files/lens');
        $category_image->move($destinationPath, $category_image_name);
     $category->category_image_name = $category_image_name;
    }

   
    // Creating Category URL
    $category_slug_name = Str::slug($request->category_name, '-');
    //$category_slug_name = $request->category_slug_name;
    // UPDATE DATA INTO DB

    $category->category_name = $request->category_name;
    $category->category_slug_name = $category_slug_name;
    $category->category_tag_line = $request->category_tag_line;
    $category->category_description = $request->category_description;
    $category->category_status = $request->category_status;

    $category->update();

    return back()->with('success','Lens Color Type Updated Successfuly...!');

    }


    public function bottom_button_action_lens_color_type(Request $request){
        $category_ids = $request->category_ids;
        $request_for = $request->req_for;

        if($request_for =="Delete"){

            for($i=0;$i<COUNT($category_ids);$i++){
                $this->delete_child($category_ids[$i]);
                $this->delete_parent($category_ids[$i]);
            }
            $sess_msg = "Selected Lens Color Type(s) Deleted...";
          }else if($request_for=="Update Order"){
            $category_order_by_ids = $request->category_order_by_ids;
            $category_order_by = $request->category_order_by;
            for($i=0;$i<COUNT($category_order_by_ids);$i++){
             LensColorType::where('id', $category_order_by_ids[$i])->update([
                 'category_order_by' => $category_order_by[$i]
             ]);
            }
            $sess_msg="Lens Color Type Order Updated Successfully...";
           }else if($request_for == "Set for home" || $request_for == "Remove from home"){
              $category_for_home = ($request_for == "Set for home") ? "Yes" : "No";
            LensColorType::whereIn('id', $category_ids)->update(["category_for_home" => $category_for_home]);
             $sess_msg = ($request_for == "Set for home") ? "Selected Category(s) set for home..." : "Selected Lens Color Type(s) remove from home...";
           }else{
        LensColorType::whereIn('id', $category_ids)->update(["category_status" => $request_for]);
        $sess_msg = "Selected Lens Color Type(s) Status Updated...";
    }

    return back()->with('success',$sess_msg);

   }

    public function remove_lens_color_type_image(Request $request){
        $remove_image = LensColorType::findOrFail($request->id, ['category_image_name']);
        $remove_image_path = "uploaded_files/lens/".$remove_image->category_image_name;
    
        @unlink($remove_image_path);

        LensColorType::where('id', $request->id)->update([ 'category_image_name' => '']);
        return back()->with('success','Image removed successfully...!');
    }

 

    
    // FUNCTIONS FOR MAIN CATEGORY END

// **********************************************************************************************************

    // FUNCTIONS FOR SUB CATEGORY START

    public function sub_lens_color_type_list(Request $request){
        $category_parent_id = $request->id;
        $subcategories = LensColorType::where('category_parent_id',$category_parent_id)->paginate(8);
        return view('admin.manage-sub-lens-color-type', compact('subcategories','category_parent_id'));
    }

    public function add_sub_lens_color_type_form(Request $request){
        $category_parent_id = $request->id;
        return view('admin.addedit-sub-lens-color-type',compact('category_parent_id'));
    }

    public function add_sub_lens_color_type(Request $request){
    // parent id received
        $category_parent_id = $request->id;

       
    // Creating Category URL
    $category_slug_name = Str::slug($request->category_name, '-');
    //$category_slug_name = $request->category_slug_name;


$price=0.00;
if(!empty($request->category_price)){
 $price = $request->category_price;    
}

    // INSERT DATA INTO DB

    $subcategory = new LensColorType;
    $subcategory->category_parent_id = $category_parent_id;
    $subcategory->category_name = $request->category_name;
    $subcategory->category_tag_line = $request->category_tag_line;
    $subcategory->category_description = $request->category_description;
    $subcategory->category_slug_name = $category_slug_name;
    $subcategory->category_type = 'subcat';
    $subcategory->category_price = $price;
    $subcategory->category_status = $request->category_status;

    $subcategory->save();

    return back()->with('success','Color Type Added Successfuly...!');


    }

    public function edit_sub_lens_color_type(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $edit_subcategory = LensColorType::findOrFail($request->id);
       
        return view('admin.addedit-sub-lens-color-type', compact('edit_subcategory','category_parent_id'));
    }

    public function update_sub_lens_color_type(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $subcategory_id = $request->id;
        $subcategory = LensColorType::findOrFail($request->id);


$price=0.00;
if(!empty($request->category_price)){
 $price = $request->category_price;    
}
    // Creating Category URL
    $category_slug_name = Str::slug($request->category_name, '-');
    //$category_slug_name = $request->category_slug_name;
    // UPDATE DATA INTO DB

    $subcategory->category_name = $request->category_name;
    $subcategory->category_tag_line = $request->category_tag_line;
    $subcategory->category_description = $request->category_description;
    $subcategory->category_slug_name = $category_slug_name;
    $subcategory->category_price = $price;
    $subcategory->category_status = $request->category_status;
    $subcategory->update();

    return back()->with('success','Color Type Updated Successfuly...!');

    }

    public function bottom_button_action_sub_lens_color_type(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $category_ids = $request->category_ids;
        $request_for = $request->req_for;

        if($request_for =="Delete"){
            for($i=0;$i<COUNT($category_ids);$i++){
                $this->delete_child($category_ids[$i]);
                $this->delete_parent($category_ids[$i]);
            }
            $sess_msg = "Selected Color Type(s) Deleted...";
          }else if($request_for=="Update Order"){
            $category_order_by_ids = $request->category_order_by_ids;
            $category_order_by = $request->category_order_by;
            for($i=0;$i<COUNT($category_order_by_ids);$i++){
             LensColorType::where('id', $category_order_by_ids[$i])->update([
                 'category_order_by' => $category_order_by[$i]
             ]);
            }
            $sess_msg="Sub Color Type Order Updated Successfully...";
           }else if($request_for == "Set for home" || $request_for == "Remove from home"){
              $category_for_home = ($request_for == "Set for home") ? "Yes" : "No";
            LensColorType::whereIn('id', $category_ids)->update(["category_for_home" => $category_for_home]);
             $sess_msg = ($request_for == "Set for home") ? "Selected Category(s) set for home..." : "Selected Color Type(s) remove from home...";
           }else{
        LensColorType::whereIn('id', $category_ids)->update(["category_status" => $request_for]);
        $sess_msg = "Selected Color Type(s) Status Updated...";
    }
    return back()->with('success',$sess_msg);
}




  

    // FUNCTIONS FOR SUB CATEGORY END

// **********************************************************************************************************

    // FUNCTIONS FOR FINAL CATEGORY START

    public function tint_color_list(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $sub_cat_id = $request->sub_cat_id;

        $finalcategories = LensColorType::where('category_parent_id',$sub_cat_id)->paginate(10);
        return view('admin.manage-tint-color', compact('finalcategories','category_parent_id','sub_cat_id'));
    }

    public function add_color_tint_form(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $sub_cat_id = $request->sub_cat_id;
        return view('admin.addedit-color-tint',compact('category_parent_id','sub_cat_id'));
    }

    public function add_color_tint(Request $request){
        // parent id received
            $category_parent_id = $request->cat_parent_id;
            $sub_cat_id = $request->sub_cat_id;

            $request->validate([
                'category_image_name' => 'image|mimes:png,jpg,jpeg',
                'category_name' => 'required|unique:categories,category_name'
            ]);

        // Image uploading code
        $category_image_name="";
        if($request->hasfile('category_image_name')){

$category_image = $request->file('category_image_name');
$category_image_name = rand(100000000,500000000).".".$category_image->getClientOriginalExtension();

// Comment below lines if you dont'nt want original size image start
    $destinationPath = public_path('/uploaded_files/finalcat');
    $category_image->move($destinationPath, $category_image_name);
// Comment below lines if you dont'nt want original size image end

}



        // Creating Category URL
        $category_slug_name = Str::slug($request->category_name, '-');
          //$category_slug_name = $request->category_slug_name;
        // INSERT DATA INTO DB

        $finalcategory = new LensColorType;
        $finalcategory->category_parent_id = $sub_cat_id;
        $finalcategory->category_image_name = $category_image_name;
        $finalcategory->category_name = $request->category_name;
        $finalcategory->category_price = $request->category_price;
        $finalcategory->category_slug_name = $category_slug_name;
        $finalcategory->category_type = 'finalcat';
        $finalcategory->category_status = $request->category_status;

        $finalcategory->save();

        return back()->with('success','Tint Added Successfuly...!');


        }

        public function edit_color_tint(Request $request){
            $category_parent_id = $request->cat_parent_id;
            $sub_cat_id = $request->sub_cat_id;
            $edit_finalcategory = LensColorType::findOrFail($request->id);
            return view('admin.addedit-color-tint', compact('edit_finalcategory','category_parent_id','sub_cat_id'));
        }

        public function update_color_tint(Request $request){
            $category_parent_id = $request->cat_parent_id;
            $sub_cat_id = $request->sub_cat_id;
            $finalcategory_id = $request->id;
            $finalcategory = LensColorType::findOrFail($request->id);
            $request->validate([
                'category_image_name' => 'image|mimes:png,jpg,jpeg',
                'category_name' => 'required|unique:categories,category_name,'.$finalcategory_id
            ]);

        // Image uploading code
        if($request->hasfile('category_image_name')){

      // Delete Old Image Start
         $image_path = "uploaded_files/finalcat/".$finalcategory->category_image_name;
         $image_path_resize = "uploaded_files/finalcat/thumb/".$finalcategory->category_image_name;
         if(file_exists($image_path)){
             @unlink($image_path);
         }if(file_exists($image_path_resize)){
             @unlink($image_path_resize);
         }
       // Delete Old Image End

$category_image = $request->file('category_image_name');
$category_image_name = rand(100000000,500000000).".".$category_image->getClientOriginalExtension();


  // Comment below lines if you dont'nt want original size image start
    $destinationPath = public_path('/uploaded_files/finalcat');
    $category_image->move($destinationPath, $category_image_name);
  // Comment below lines if you dont'nt want original size image end

 $finalcategory->category_image_name = $category_image_name;

}



        // Creating Category URL
        $category_slug_name = Str::slug($request->category_name, '-');
        //$category_slug_name = $request->category_slug_name;
        // UPDATE DATA INTO DB

        $finalcategory->category_name = $request->category_name;
        $finalcategory->category_price = $request->category_price;
        $finalcategory->category_slug_name = $category_slug_name;
        $finalcategory->category_type = 'finalcat';
        $finalcategory->category_status = $request->category_status;

        $finalcategory->update();

        return back()->with('success','Tint Updated Successfuly...!');

        }

        public function bottom_button_action_tint(Request $request){
            $category_parent_id = $request->cat_parent_id;
            $sub_cat_id = $request->sub_cat_id;
            $category_ids = $request->category_ids;
            $request_for = $request->req_for;

            if($request_for =="Delete"){
                for($i=0;$i<COUNT($category_ids);$i++){
                    $this->delete_child($category_ids[$i]);
                    $this->delete_parent($category_ids[$i]);
                }
                $sess_msg = "Selected Tint(s) Deleted...";
              }else if($request_for=="Update Order"){
                $category_order_by_ids = $request->category_order_by_ids;
                $category_order_by = $request->category_order_by;
                for($i=0;$i<COUNT($category_order_by_ids);$i++){
                 LensColorType::where('id', $category_order_by_ids[$i])->update([
                     'category_order_by' => $category_order_by[$i]
                 ]);
                }
                $sess_msg="Tint Order Updated Successfully...";
               }else if($request_for == "Set for home" || $request_for == "Remove from home"){
                  $category_for_home = ($request_for == "Set for home") ? "Yes" : "No";
                LensColorType::whereIn('id', $category_ids)->update(["category_for_home" => $category_for_home]);
                 $sess_msg = ($request_for == "Set for home") ? "Selected Tint(s) set for home..." : "Selected Category(s) remove from home...";
               }else{
            LensColorType::whereIn('id', $category_ids)->update(["category_status" => $request_for]);
            $sess_msg = "Selected Tint(s) Status Updated...";
        }

        return back()->with('success',$sess_msg);

}

        public function finalcat_search(Request $request){
            $search_keyword = $request->search_keyword;
            $category_parent_id = $request->category_parent_id;
            $sub_cat_id = $request->sub_cat_id;

            $finalcategories = LensColorType::where('category_name','LIKE','%'.$search_keyword.'%')->where('category_parent_id',$sub_cat_id)->paginate(8);
            $finalcategories->appends(array(
                'search_keyword' => $search_keyword
            ));

            return view('admin.manage-finalcategory', compact('finalcategories','category_parent_id','sub_cat_id','search_keyword'));
        }

        public function remove_finalcategory_image(Request $request){
            $category_parent_id = $request->cat_parent_id;
            $sub_cat_id = $request->sub_cat_id;
            $finalcategory_id = $request->id;

            $remove_image = LensColorType::findOrFail($finalcategory_id, ['category_image_name']);
            $remove_image_path = "uploaded_files/finalcat/".$remove_image->category_image_name;
            $remove_resize_image_path = "uploaded_files/finalcat/thumb/".$remove_image->category_image_name;
            @unlink($remove_image_path);
            @unlink($remove_resize_image_path);

            LensColorType::where('id', $finalcategory_id)->update([ 'category_image_name' => '']);
            return back()->with('success','Image Removed Successfuly...!');
        }

    public function remove_finalcategory_banner(Request $request){
        $remove_banner = LensColorType::findOrFail($request->id, ['category_inner_banner']);
        $remove_banner_path = "uploaded_files/finalcat/".$remove_banner->category_inner_banner;
        @unlink($remove_banner_path);

        LensColorType::where('id', $request->id)->update([ 'category_inner_banner' => '']);
        return back()->with('success','Banner removed successfuly...!');
    }

    // FUNCTIONS FOR FINAL CATEGORY END

//**********************************************************************************************************

    // FUNCTIONS FOR PRODUCT START

    public function product_list(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $sub_cat_id = $request->sub_cat_id;
        $final_cat_id = $request->final_cat_id;

    $products = LensColorType::where('category_parent_id',$final_cat_id)->paginate(8);
    return view('admin.manage-product', compact('products','category_parent_id','sub_cat_id','final_cat_id'));
    }

    public function add_product_form(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $sub_cat_id = $request->sub_cat_id;
        $final_cat_id = $request->final_cat_id;
        return view('admin.addedit-product',compact('category_parent_id','sub_cat_id','final_cat_id'));
    }

    public function add_product(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $sub_cat_id = $request->sub_cat_id;
        $final_cat_id = $request->final_cat_id;

            $request->validate([
                'category_image_name' => 'image|mimes:png,jpg,jpeg',
                'category_name' => 'required|unique:categories,category_name',
                'category_price' => 'required|numeric',
                'shape' => 'required',
                'type' => 'required',
                'material' => 'required'
            ]);

        // Image uploading code
        $category_image_name="";
        if($request->hasfile('category_image_name')){

$category_image = $request->file('category_image_name');
$category_image_name = rand(100000000,500000000).".".$category_image->getClientOriginalExtension();

if($this->admin_data->admin_product_thumb == "Yes"){
  // Fetch Image Size for Product(thumb) from Image Resize Table START
    $image_resize_data_thumb = ImageResize::where('resize_section_name','ProductThumb')->where('resize_status','Active')->first();
    if(!empty($image_resize_data_thumb)){
     $resize_width=$image_resize_data_thumb->resize_width;
     $resize_height=$image_resize_data_thumb->resize_height;
    }else{
     $resize_width=179;
     $resize_height=100;
    }
  // Fetch Image Size for Product(thumb) from Image Resize Table END

  // Image Resizing for Product(thumb) start
     $destinationPath = public_path('/uploaded_files/product/thumb');
     $resize_cat_image = Image::make($category_image->getRealPath());
     $resize_cat_image->resize($resize_width,$resize_height, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_image_name);
  // Image Resizing for Product(thumb) end
}
//*****************########################################***************************

  // Fetch Image Size for Product from Image Resize Table START
   /* $image_resize_data = ImageResize::where('resize_section_name','Product')->where('resize_status','Active')->first();
    if(!empty($image_resize_data)){
     $resize_width=$image_resize_data->resize_width;
     $resize_height=$image_resize_data->resize_height;
    }else{
     $resize_width=400;
     $resize_height=450;
    }*/
  // Fetch Image Size for Product from Image Resize Table END

  // Image Resizing for Product start
    /* $destinationPath = public_path('/uploaded_files/product');
     $resize_cat_image = Image::make($category_image->getRealPath());
     $resize_cat_image->resize($resize_width,$resize_height, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_image_name);*/
  // Image Resizing for Product end

       // Comment below lines if you dont'nt want original size image start
            $destinationPath = public_path('/uploaded_files/product');
            $category_image->move($destinationPath, $category_image_name);
       // Comment below lines if you dont'nt want original size image end

        }
        
        
/* Back Image */        

 // Image uploading code
        $category_image_name2="";
        if($request->hasfile('category_image_name2')){

$category_image2 = $request->file('category_image_name2');
$category_image_name2 = rand(100000000,500000000).".".$category_image2->getClientOriginalExtension();

if($this->admin_data->admin_product_thumb == "Yes"){
  // Fetch Image Size for Product(thumb) from Image Resize Table START
    $image_resize_data_thumb = ImageResize::where('resize_section_name','ProductThumb')->where('resize_status','Active')->first();
    if(!empty($image_resize_data_thumb)){
     $resize_width=$image_resize_data_thumb->resize_width;
     $resize_height=$image_resize_data_thumb->resize_height;
    }else{
     $resize_width=179;
     $resize_height=100;
    }
  // Fetch Image Size for Product(thumb) from Image Resize Table END

  // Image Resizing for Product(thumb) start
     $destinationPath = public_path('/uploaded_files/product/thumb');
     $resize_cat_image = Image::make($category_image->getRealPath());
     $resize_cat_image->resize($resize_width,$resize_height, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_image_name);
  // Image Resizing for Product(thumb) end
}
//*****************########################################***************************

  // Fetch Image Size for Product from Image Resize Table START
   /* $image_resize_data = ImageResize::where('resize_section_name','Product')->where('resize_status','Active')->first();
    if(!empty($image_resize_data)){
     $resize_width=$image_resize_data->resize_width;
     $resize_height=$image_resize_data->resize_height;
    }else{
     $resize_width=400;
     $resize_height=450;
    }*/
  // Fetch Image Size for Product from Image Resize Table END

  // Image Resizing for Product start
    /* $destinationPath = public_path('/uploaded_files/product');
     $resize_cat_image = Image::make($category_image->getRealPath());
     $resize_cat_image->resize($resize_width,$resize_height, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_image_name);*/
  // Image Resizing for Product end

       // Comment below lines if you dont'nt want original size image start
            $destinationPath = public_path('/uploaded_files/product');
            $category_image2->move($destinationPath, $category_image_name2);
       // Comment below lines if you dont'nt want original size image end

        }

                // Code For Category INNER BANNER
$category_inner_banner="";
if($request->hasfile('category_inner_banner')){

$category_banner = $request->file('category_inner_banner');
$category_inner_banner = rand(100000000,500000000).".".$category_banner->getClientOriginalExtension();

// Image Resizing for subcategory start
/* $destinationPath = public_path('/uploaded_files/product');
 $resize_cat_banner = Image::make($category_banner->getRealPath());
 $resize_cat_banner->resize(1600,469, function($constraint){
    $constraint->aspectRatio();
 })->save($destinationPath . '/' . $category_inner_banner);*/
// Image Resizing for SubCategory end

// Comment below lines if you dont'nt want original size image start
            $destinationPath = public_path('/uploaded_files/product');
            $category_banner->move($destinationPath, $category_inner_banner);
       // Comment below lines if you dont'nt want original size image end

}

        // Creating Category URL
        $category_slug_name = Str::slug($request->category_name, '-');
         // $category_slug_name = $request->category_slug_name;
        // INSERT DATA INTO DB

        $product = new Category;
        $product->category_parent_id = $final_cat_id;
        $product->category_image_name = $category_image_name;
        $product->category_image_name2 = $category_image_name2;
        $product->category_video_name = $request->category_video_name;
        $product->category_inner_banner = $category_inner_banner;
        $product->category_name = $request->category_name;
        $product->category_slug_name = $category_slug_name;
        $product->category_price = $request->category_price;
        $product->category_type = 'product';
        $product->category_frame = $request->category_frame;
        $product->category_for = $request->category_for;
        $product->shape = $request->shape;
        $product->type = $request->type;
        $product->material = $request->material;
        $product->category_short_description = $request->category_short_description;
        $product->category_description = $request->category_description;
        $product->category_meta_title = $request->category_meta_title;
        $product->category_meta_keywords = $request->category_meta_keywords;
        $product->category_meta_description = $request->category_meta_description;
        $product->category_status = $request->category_status;
        $product->save();

        return redirect()->route('add-color-form', [$category_parent_id, $sub_cat_id, $final_cat_id, $product->id])->with('success','Product Added Successfuly...!');
        //return back()->with('success','Product Added Successfuly...!');


        }

        public function edit_product(Request $request){
            $category_parent_id = $request->cat_parent_id;
            $sub_cat_id = $request->sub_cat_id;
            $final_cat_id = $request->final_cat_id;
            $edit_product = LensColorType::findOrFail($request->id);
            return view('admin.addedit-product', compact('edit_product','category_parent_id','sub_cat_id','final_cat_id'));
        }

        public function update_product(Request $request){
            $category_parent_id = $request->cat_parent_id;
            $sub_cat_id = $request->sub_cat_id;
            $final_cat_id = $request->final_cat_id;
            $product_id = $request->id;
            $product = LensColorType::findOrFail($product_id);
            $request->validate([
                'category_image_name' => 'image|mimes:png,jpg,jpeg',
                'category_name' => 'required|unique:categories,category_name,'.$product_id,
                'category_price' => 'required|numeric',
                'shape' => 'required',
                'type' => 'required',
                'material' => 'required'
            ]);

        // Image uploading code
        if($request->hasfile('category_image_name')){

      // Delete Old Image Start
         $image_path = "uploaded_files/product/".$product->category_image_name;
         $image_path_resize = "uploaded_files/product/thumb/".$product->category_image_name;
         if(file_exists($image_path)){
             @unlink($image_path);
         }if(file_exists($image_path_resize)){
             @unlink($image_path_resize);
         }
       // Delete Old Image End

$category_image = $request->file('category_image_name');
$category_image_name = rand(100000000,500000000).".".$category_image->getClientOriginalExtension();

if($this->admin_data->admin_product_thumb == "Yes"){
  // Fetch Image Size for Product(thumb) from Image Resize Table START
    $image_resize_data_thumb = ImageResize::where('resize_section_name','ProductThumb')->where('resize_status','Active')->first();
    if(!empty($image_resize_data_thumb)){
     $resize_width=$image_resize_data_thumb->resize_width;
     $resize_height=$image_resize_data_thumb->resize_height;
    }else{
     $resize_width=179;
     $resize_height=100;
    }
  // Fetch Image Size for Product(thumb) from Image Resize Table END

  // Image Resizing for Product(thumb) start
     $destinationPath = public_path('/uploaded_files/product/thumb');
     $resize_cat_image = Image::make($category_image->getRealPath());
     $resize_cat_image->resize($resize_width,$resize_height, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_image_name);
  // Image Resizing for Product(thumb) end
}
//*****************########################################***************************

  // Fetch Image Size for Product from Image Resize Table START
   /* $image_resize_data = ImageResize::where('resize_section_name','Product')->where('resize_status','Active')->first();
    if(!empty($image_resize_data)){
     $resize_width=$image_resize_data->resize_width;
     $resize_height=$image_resize_data->resize_height;
    }else{
     $resize_width=400;
     $resize_height=450;
    }*/
  // Fetch Image Size for Product from Image Resize Table END

  // Image Resizing for Product start
     /*$destinationPath = public_path('/uploaded_files/product');
     $resize_cat_image = Image::make($category_image->getRealPath());
     $resize_cat_image->resize($resize_width,$resize_height, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_image_name);*/
  // Image Resizing for Product end


          // Comment below lines if you dont'nt want original size image start
            $destinationPath = public_path('/uploaded_files/product');
            $category_image->move($destinationPath, $category_image_name);
          // Comment below lines if you dont'nt want original size image end

         $product->category_image_name = $category_image_name;

        }
        
/* Back Image */        

// Image uploading code
        if($request->hasfile('category_image_name2')){

      // Delete Old Image Start
         $image_path2 = "uploaded_files/product/".$product->category_image_name2;
         $image_path_resize2 = "uploaded_files/product/thumb/".$product->category_image_name2;
         if(file_exists($image_path2)){
             @unlink($image_path2);
         }if(file_exists($image_path_resize2)){
             @unlink($image_path_resize2);
         }
       // Delete Old Image End

$category_image2 = $request->file('category_image_name2');
$category_image_name2 = rand(100000000,500000000).".".$category_image2->getClientOriginalExtension();

if($this->admin_data->admin_product_thumb == "Yes"){
  // Fetch Image Size for Product(thumb) from Image Resize Table START
    $image_resize_data_thumb = ImageResize::where('resize_section_name','ProductThumb')->where('resize_status','Active')->first();
    if(!empty($image_resize_data_thumb)){
     $resize_width=$image_resize_data_thumb->resize_width;
     $resize_height=$image_resize_data_thumb->resize_height;
    }else{
     $resize_width=179;
     $resize_height=100;
    }
  // Fetch Image Size for Product(thumb) from Image Resize Table END

  // Image Resizing for Product(thumb) start
     $destinationPath = public_path('/uploaded_files/product/thumb');
     $resize_cat_image = Image::make($category_image->getRealPath());
     $resize_cat_image->resize($resize_width,$resize_height, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_image_name);
  // Image Resizing for Product(thumb) end
}
//*****************########################################***************************

  // Fetch Image Size for Product from Image Resize Table START
   /* $image_resize_data = ImageResize::where('resize_section_name','Product')->where('resize_status','Active')->first();
    if(!empty($image_resize_data)){
     $resize_width=$image_resize_data->resize_width;
     $resize_height=$image_resize_data->resize_height;
    }else{
     $resize_width=400;
     $resize_height=450;
    }*/
  // Fetch Image Size for Product from Image Resize Table END

  // Image Resizing for Product start
     /*$destinationPath = public_path('/uploaded_files/product');
     $resize_cat_image = Image::make($category_image->getRealPath());
     $resize_cat_image->resize($resize_width,$resize_height, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_image_name);*/
  // Image Resizing for Product end


          // Comment below lines if you dont'nt want original size image start
            $destinationPath = public_path('/uploaded_files/product');
            $category_image2->move($destinationPath, $category_image_name2);
          // Comment below lines if you dont'nt want original size image end

         $product->category_image_name2 = $category_image_name2;

        }

           // Code For Category INNER BANNER
if($request->hasfile('category_inner_banner')){
 // Delete Old Baanner Start
  $banner_path = "uploaded_files/product/".$product->category_inner_banner;
   if(file_exists($banner_path)){
         @unlink($banner_path);
   }
   // Delete Old Banner End
$category_banner = $request->file('category_inner_banner');
$category_inner_banner = rand(100000000,500000000).".".$category_banner->getClientOriginalExtension();

  // Image Resizing for subcategory start
     /*$destinationPath = public_path('/uploaded_files/product');
     $resize_cat_banner = Image::make($category_banner->getRealPath());
     $resize_cat_banner->resize(1600,469, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_inner_banner);*/
  // Image Resizing for SubCategory end

     // Comment below lines if you dont'nt want original size image start
            $destinationPath = public_path('/uploaded_files/product');
            $category_banner->move($destinationPath, $category_inner_banner);
       // Comment below lines if you dont'nt want original size image end
     $product->category_inner_banner = $category_inner_banner;

}

        // Creating Category URL
        $category_slug_name = Str::slug($request->category_name, '-');
        //$category_slug_name = $request->category_slug_name;
        // UPDATE DATA INTO DB

        $product->category_name = $request->category_name;
        $product->category_slug_name = $category_slug_name;
        $product->category_video_name = $request->category_video_name;
        $product->category_short_description = $request->category_short_description;
        $product->category_description = $request->category_description;
        $product->category_price = $request->category_price;
        $product->category_for = $request->category_for;
        $product->shape = $request->shape;
        $product->type = $request->type;
        $product->category_frame = $request->category_frame;
        $product->material = $request->material;
        $product->category_meta_title = $request->category_meta_title;
        $product->category_meta_keywords = $request->category_meta_keywords;
        $product->category_meta_description = $request->category_meta_description;
        $product->category_status = $request->category_status;
        $product->update();

        return back()->with('success','Product Updated Successfuly...!');

        }

        public function bottom_button_action_product(Request $request){
            $category_parent_id = $request->cat_parent_id;
            $sub_cat_id = $request->sub_cat_id;
            $final_cat_id = $request->final_cat_id;
            $category_ids = $request->category_ids;
            $request_for = $request->req_for;

            if($request_for =="Delete"){
                for($i=0;$i<COUNT($category_ids);$i++){
                    $this->delete_child($category_ids[$i]);
                    $this->delete_parent($category_ids[$i]);
                }
                $sess_msg = "Selected Product(s) Deleted...";
              }else if($request_for=="Update Order"){
                $category_order_by_ids = $request->category_order_by_ids;
                $category_order_by = $request->category_order_by;
                for($i=0;$i<COUNT($category_order_by_ids);$i++){
                 LensColorType::where('id', $category_order_by_ids[$i])->update([
                     'category_order_by' => $category_order_by[$i]
                 ]);
                }
                $sess_msg="Product Order Updated Successfully...";
               }else if($request_for == "Set for Top" || $request_for == "Remove from Top"){
                  $category_is_top = ($request_for == "Set for Top") ? "Yes" : "No";
                LensColorType::whereIn('id', $category_ids)->update(["category_is_top" => $category_is_top]);
                 $sess_msg = ($request_for == "Set for Top") ? "Selected product(s) Set for Top..." : "Selected Product(s) Remove from Top...";
               }
               else if($request_for == "Set for Sale Off" || $request_for == "Remove from Sale Off"){
                  $category_is_sale_off = ($request_for == "Set for Sale Off") ? "Yes" : "No";
                LensColorType::whereIn('id', $category_ids)->update(["category_is_sale_off" => $category_is_sale_off]);
                 $sess_msg = ($request_for == "Set for Sale Off") ? "Selected product(s) Set for Sale Off..." : "Selected Product(s) Remove from Sale Off...";
               }
               else if($request_for == "Set for Deal" || $request_for == "Remove from Deal"){
                  $category_deal = ($request_for == "Set for Deal") ? "Yes" : "No";
                LensColorType::whereIn('id', $category_ids)->update(["category_deal" => $category_deal]);
                 $sess_msg = ($request_for == "Set for Deal") ? "Selected product(s) Set for Deal..." : "Selected Product(s) Remove from Deal...";
               }
               else{
            LensColorType::whereIn('id', $category_ids)->update(["category_status" => $request_for]);
            $sess_msg = "Selected Product(s) Status Updated...";
        }

        return back()->with('success',$sess_msg);

}

        public function product_search(Request $request){
            $search_keyword = $request->search_keyword;
            $category_parent_id = $request->category_parent_id;
            $sub_cat_id = $request->sub_cat_id;
            $final_cat_id = $request->final_cat_id;

            $products = LensColorType::where('category_name','LIKE','%'.$search_keyword.'%')->where('category_parent_id',$final_cat_id)->paginate(8);
            $products->appends(array(
                'search_keyword' => $search_keyword
            ));

            return view('admin.manage-product', compact('products','category_parent_id','sub_cat_id','final_cat_id','search_keyword'));
        }

        public function remove_product_image(Request $request){
            $category_parent_id = $request->cat_parent_id;
            $sub_cat_id = $request->sub_cat_id;
            $final_cat_id = $request->final_cat_id;
            $product_id = $request->id;

            $remove_image = LensColorType::findOrFail($product_id, ['category_image_name']);
            $remove_image_path = "uploaded_files/product/".$remove_image->category_image_name;
            $remove_resize_image_path = "uploaded_files/product/thumb/".$remove_image->category_image_name;
            @unlink($remove_image_path);
            @unlink($remove_resize_image_path);

            LensColorType::where('id', $product_id)->update([ 'category_image_name' => '']);
            return back()->with('success','Image Removed Successfuly...!');
        }
        



    }
