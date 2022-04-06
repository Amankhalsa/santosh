<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Admin_model\Admin;
use App\Admin_model\LensBrand;
use App\Admin_model\Lens;
use DB;

class LensBrandController extends Controller
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
        $child_ids = LensBrand::where('category_parent_id',$category_parent_id)->get();
        if($child_ids->isNotEmpty()){
         foreach($child_ids as $child){
           $this->delete_child($child->id);
           $del_ids[]=$child->id;
        
    
        }}
   //Deleting Nested Childs Images
       foreach($del_ids as $del_id){
       $delete_image = LensBrand::findOrFail($del_id, ['category_image_name','category_type']);
       $delete_image_path = "uploaded_files/lens/".$delete_image->category_image_name;
        @unlink($delete_image_path);
       

       }
   // Deleting Nested Childs
       LensBrand::whereIn('id',$del_ids)->delete();
   }

   //Deleting parent records
       public function delete_parent($parent_id){
   //Deleting Parent Image
        $del_img = LensBrand::findOrFail($parent_id, ['category_image_name','category_type']);
        $del_image_path = "uploaded_files/lens/".$del_img->category_image_name;
       
        @unlink($del_image_path);
        

   // Deleting Parent
       LensBrand::where('id',$parent_id)->delete();
   }

//***********************************************************************************************

    public function index(){
        $lens_brands = LensBrand::where('category_parent_id','0')->paginate(8);
        return view('admin.manage-lens-brand', compact('lens_brands'));
    }

    // FUNCTIONS FOR MAIN CATEGORY START

    public function add_lens_brand_form(Request $request){
        return view('admin.addedit-lens-brand');
    }


    public function add_lens_brand(Request $request){
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

    $category = new LensBrand;
    $category->category_image_name = $category_image_name;
    $category->category_name = $request->category_name;
    $category->category_slug_name = $category_slug_name;
    $category->category_tag_line = $request->category_tag_line;
    $category->category_type = 'cat';
    $category->category_status = $request->category_status;

    $category->save();

    return back()->with('success','Lens Brand Added Successfuly...!');

    }

    public function edit_lens_brand(Request $request){
          
       $edit_lens_brand = LensBrand::findOrFail($request->id);
       
       return view('admin.addedit-lens-brand', compact('edit_lens_brand'));
    }


    public function update_lens_brand(Request $request){
        $category_id = $request->id;
        $category = LensBrand::findOrFail($request->id);
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
    $category->category_tag_line = $request->category_tag_line;
    $category->category_slug_name = $category_slug_name;
    $category->category_status = $request->category_status;

    $category->update();

    return back()->with('success','Lens Brand Updated Successfuly...!');

    }


    public function bottom_button_action_lens_brand(Request $request){
        $category_ids = $request->category_ids;
        $request_for = $request->req_for;

        if($request_for =="Delete"){

            for($i=0;$i<COUNT($category_ids);$i++){
                $this->delete_child($category_ids[$i]);
                $this->delete_parent($category_ids[$i]);
            }
            $sess_msg = "Selected Lens Brand(s) Deleted...";
          }else if($request_for=="Update Order"){
            $category_order_by_ids = $request->category_order_by_ids;
            $category_order_by = $request->category_order_by;
            for($i=0;$i<COUNT($category_order_by_ids);$i++){
             LensBrand::where('id', $category_order_by_ids[$i])->update([
                 'category_order_by' => $category_order_by[$i]
             ]);
            }
            $sess_msg="Lens Lens Brand Order Updated Successfully...";
           }else if($request_for == "Set for home" || $request_for == "Remove from home"){
              $category_for_home = ($request_for == "Set for home") ? "Yes" : "No";
            LensBrand::whereIn('id', $category_ids)->update(["category_for_home" => $category_for_home]);
             $sess_msg = ($request_for == "Set for home") ? "Selected Category(s) set for home..." : "Selected Lens Brand(s) remove from home...";
           }else{
        LensBrand::whereIn('id', $category_ids)->update(["category_status" => $request_for]);
        $sess_msg = "Selected Lens Brand(s) Status Updated...";
    }

    return back()->with('success',$sess_msg);

   }

    public function remove_lens_brand_image(Request $request){
        $remove_image = LensBrand::findOrFail($request->id, ['category_image_name']);
        $remove_image_path = "uploaded_files/lens/".$remove_image->category_image_name;
    
        @unlink($remove_image_path);

        LensBrand::where('id', $request->id)->update([ 'category_image_name' => '']);
        return back()->with('success','Image removed successfully...!');
    }

 

    
    // FUNCTIONS FOR MAIN CATEGORY END

// **********************************************************************************************************

    // FUNCTIONS FOR SUB CATEGORY START

    public function brand_tint_list(Request $request){
        $category_parent_id = $request->id;
        $subcategories = LensBrand::where('category_parent_id',$category_parent_id)->paginate(8);
        return view('admin.manage-brand-tint', compact('subcategories','category_parent_id'));
    }

    public function add_brand_tint_form(Request $request){
        $category_parent_id = $request->id;
        return view('admin.addedit-brand-tint',compact('category_parent_id'));
    }

    public function add_brand_tint(Request $request){
    // parent id received
        $category_parent_id = $request->id;

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
    //$category_slug_name = $request->category_slug_name;




    // INSERT DATA INTO DB

    $subcategory = new LensBrand;
    $subcategory->category_image_name = $category_image_name;
    $subcategory->category_parent_id = $category_parent_id;
    $subcategory->category_name = $request->category_name;
    $subcategory->category_slug_name = $category_slug_name;
    $subcategory->category_type = 'subcat';
    $subcategory->category_status = $request->category_status;

    $subcategory->save();

    return back()->with('success','Brand Tint Added Successfuly...!');


    }

    public function edit_brand_tint(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $edit_subcategory = LensBrand::findOrFail($request->id);
       
        return view('admin.addedit-brand-tint', compact('edit_subcategory','category_parent_id'));
    }

    public function update_brand_tint(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $subcategory_id = $request->id;
        $subcategory = LensBrand::findOrFail($request->id);


    // Creating Category URL
    $category_slug_name = Str::slug($request->category_name, '-');
    //$category_slug_name = $request->category_slug_name;
    // UPDATE DATA INTO DB

    $subcategory->category_name = $request->category_name;
    $subcategory->category_slug_name = $category_slug_name;
    $subcategory->category_status = $request->category_status;
    $subcategory->update();

    return back()->with('success','Brand Tint Updated Successfuly...!');

    }

    public function bottom_button_action_brand_tint(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $category_ids = $request->category_ids;
        $request_for = $request->req_for;

        if($request_for =="Delete"){
            for($i=0;$i<COUNT($category_ids);$i++){
                $this->delete_child($category_ids[$i]);
                $this->delete_parent($category_ids[$i]);
            }
            $sess_msg = "Selected Brand Tint(s) Deleted...";
          }else if($request_for=="Update Order"){
            $category_order_by_ids = $request->category_order_by_ids;
            $category_order_by = $request->category_order_by;
            for($i=0;$i<COUNT($category_order_by_ids);$i++){
             LensBrand::where('id', $category_order_by_ids[$i])->update([
                 'category_order_by' => $category_order_by[$i]
             ]);
            }
            $sess_msg="Sub Lens Brand Order Updated Successfully...";
           }else if($request_for == "Set for home" || $request_for == "Remove from home"){
              $category_for_home = ($request_for == "Set for home") ? "Yes" : "No";
            LensBrand::whereIn('id', $category_ids)->update(["category_for_home" => $category_for_home]);
             $sess_msg = ($request_for == "Set for home") ? "Selected Category(s) set for home..." : "Selected Brand Tint(s) remove from home...";
           }else{
        LensBrand::whereIn('id', $category_ids)->update(["category_status" => $request_for]);
        $sess_msg = "Selected Brand Tint(s) Status Updated...";
    }
    return back()->with('success',$sess_msg);
}


    public function remove_brand_tint_image(Request $request){
        $remove_image = LensBrand::findOrFail($request->id, ['category_image_name']);
        $remove_image_path = "uploaded_files/lens/".$remove_image->category_image_name;
    
        @unlink($remove_image_path);

        LensBrand::where('id', $request->id)->update([ 'category_image_name' => '']);
        return back()->with('success','Image removed successfully...!');
    }

  

    // FUNCTIONS FOR SUB CATEGORY END

// **********************************************************************************************************

    // FUNCTIONS FOR FINAL CATEGORY START

    public function tint_color_list(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $sub_cat_id = $request->sub_cat_id;

        $finalcategories = LensBrand::where('category_parent_id',$sub_cat_id)->paginate(10);
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

        $finalcategory = new LensBrand;
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
            $edit_finalcategory = LensBrand::findOrFail($request->id);
            return view('admin.addedit-color-tint', compact('edit_finalcategory','category_parent_id','sub_cat_id'));
        }

        public function update_color_tint(Request $request){
            $category_parent_id = $request->cat_parent_id;
            $sub_cat_id = $request->sub_cat_id;
            $finalcategory_id = $request->id;
            $finalcategory = LensBrand::findOrFail($request->id);
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
                 LensBrand::where('id', $category_order_by_ids[$i])->update([
                     'category_order_by' => $category_order_by[$i]
                 ]);
                }
                $sess_msg="Tint Order Updated Successfully...";
               }else if($request_for == "Set for home" || $request_for == "Remove from home"){
                  $category_for_home = ($request_for == "Set for home") ? "Yes" : "No";
                LensBrand::whereIn('id', $category_ids)->update(["category_for_home" => $category_for_home]);
                 $sess_msg = ($request_for == "Set for home") ? "Selected Tint(s) set for home..." : "Selected Category(s) remove from home...";
               }else{
            LensBrand::whereIn('id', $category_ids)->update(["category_status" => $request_for]);
            $sess_msg = "Selected Tint(s) Status Updated...";
        }

        return back()->with('success',$sess_msg);

}

        public function finalcat_search(Request $request){
            $search_keyword = $request->search_keyword;
            $category_parent_id = $request->category_parent_id;
            $sub_cat_id = $request->sub_cat_id;

            $finalcategories = LensBrand::where('category_name','LIKE','%'.$search_keyword.'%')->where('category_parent_id',$sub_cat_id)->paginate(8);
            $finalcategories->appends(array(
                'search_keyword' => $search_keyword
            ));

            return view('admin.manage-finalcategory', compact('finalcategories','category_parent_id','sub_cat_id','search_keyword'));
        }

        public function remove_finalcategory_image(Request $request){
            $category_parent_id = $request->cat_parent_id;
            $sub_cat_id = $request->sub_cat_id;
            $finalcategory_id = $request->id;

            $remove_image = LensBrand::findOrFail($finalcategory_id, ['category_image_name']);
            $remove_image_path = "uploaded_files/finalcat/".$remove_image->category_image_name;
            $remove_resize_image_path = "uploaded_files/finalcat/thumb/".$remove_image->category_image_name;
            @unlink($remove_image_path);
            @unlink($remove_resize_image_path);

            LensBrand::where('id', $finalcategory_id)->update([ 'category_image_name' => '']);
            return back()->with('success','Image Removed Successfuly...!');
        }

    public function remove_finalcategory_banner(Request $request){
        $remove_banner = LensBrand::findOrFail($request->id, ['category_inner_banner']);
        $remove_banner_path = "uploaded_files/finalcat/".$remove_banner->category_inner_banner;
        @unlink($remove_banner_path);

        LensBrand::where('id', $request->id)->update([ 'category_inner_banner' => '']);
        return back()->with('success','Banner removed successfuly...!');
    }

    // FUNCTIONS FOR FINAL CATEGORY END

//**********************************************************************************************************

    // FUNCTIONS FOR PRODUCT START

    public function product_list(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $sub_cat_id = $request->sub_cat_id;
        $final_cat_id = $request->final_cat_id;

    $products = LensBrand::where('category_parent_id',$final_cat_id)->paginate(8);
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
            $edit_product = LensBrand::findOrFail($request->id);
            return view('admin.addedit-product', compact('edit_product','category_parent_id','sub_cat_id','final_cat_id'));
        }

        public function update_product(Request $request){
            $category_parent_id = $request->cat_parent_id;
            $sub_cat_id = $request->sub_cat_id;
            $final_cat_id = $request->final_cat_id;
            $product_id = $request->id;
            $product = LensBrand::findOrFail($product_id);
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
                 LensBrand::where('id', $category_order_by_ids[$i])->update([
                     'category_order_by' => $category_order_by[$i]
                 ]);
                }
                $sess_msg="Product Order Updated Successfully...";
               }else if($request_for == "Set for Top" || $request_for == "Remove from Top"){
                  $category_is_top = ($request_for == "Set for Top") ? "Yes" : "No";
                LensBrand::whereIn('id', $category_ids)->update(["category_is_top" => $category_is_top]);
                 $sess_msg = ($request_for == "Set for Top") ? "Selected product(s) Set for Top..." : "Selected Product(s) Remove from Top...";
               }
               else if($request_for == "Set for Sale Off" || $request_for == "Remove from Sale Off"){
                  $category_is_sale_off = ($request_for == "Set for Sale Off") ? "Yes" : "No";
                LensBrand::whereIn('id', $category_ids)->update(["category_is_sale_off" => $category_is_sale_off]);
                 $sess_msg = ($request_for == "Set for Sale Off") ? "Selected product(s) Set for Sale Off..." : "Selected Product(s) Remove from Sale Off...";
               }
               else if($request_for == "Set for Deal" || $request_for == "Remove from Deal"){
                  $category_deal = ($request_for == "Set for Deal") ? "Yes" : "No";
                LensBrand::whereIn('id', $category_ids)->update(["category_deal" => $category_deal]);
                 $sess_msg = ($request_for == "Set for Deal") ? "Selected product(s) Set for Deal..." : "Selected Product(s) Remove from Deal...";
               }
               else{
            LensBrand::whereIn('id', $category_ids)->update(["category_status" => $request_for]);
            $sess_msg = "Selected Product(s) Status Updated...";
        }

        return back()->with('success',$sess_msg);

}

        public function product_search(Request $request){
            $search_keyword = $request->search_keyword;
            $category_parent_id = $request->category_parent_id;
            $sub_cat_id = $request->sub_cat_id;
            $final_cat_id = $request->final_cat_id;

            $products = LensBrand::where('category_name','LIKE','%'.$search_keyword.'%')->where('category_parent_id',$final_cat_id)->paginate(8);
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

            $remove_image = LensBrand::findOrFail($product_id, ['category_image_name']);
            $remove_image_path = "uploaded_files/product/".$remove_image->category_image_name;
            $remove_resize_image_path = "uploaded_files/product/thumb/".$remove_image->category_image_name;
            @unlink($remove_image_path);
            @unlink($remove_resize_image_path);

            LensBrand::where('id', $product_id)->update([ 'category_image_name' => '']);
            return back()->with('success','Image Removed Successfuly...!');
        }
        
        public function lens_index_list(){
            $lens_index = DB::table('lens_index')->paginate(20);
            return view('admin.manage-lens-index',compact('lens_index'));
        }
        
        public function add_lens_index_form(){
            return view('admin.addedit-lens-index');
        }
        
        public function add_lens_index(Request $request){
            $request->validate(['lens_index'=>'required']);
            DB::table('lens_index')->insert(['lens_index'=>$request->lens_index,'description'=>$request->description,'status'=>$request->status,'date'=>date('Y-m-d')]);
            return back()->with('success','Lens Index added successfully...!');
        }
        
        public function edit_lens_index(Request $request){
            $edit_lens_index = DB::table('lens_index')->where('id',$request->id)->first();
            return view('admin.addedit-lens-index',compact('edit_lens_index'));
        }
        
        public function update_lens_index(Request $request){
            $request->validate(['lens_index'=>'required']);
            DB::table('lens_index')->where('id',$request->id)->update(['lens_index'=>$request->lens_index,'description'=>$request->description,'status'=>$request->status,'date'=>date('Y-m-d')]);
            return back()->with('success','Lens Index updated successfully...!');
        }
        
        public function bottom_button_action_lens_index(Request $request){
           $lens_index_ids = $request->lens_index_ids;
           $request_for = $request->req_for;

        if($request_for =="Delete"){
            DB::table('lens_index')->whereIn('id',$lens_index_ids)->delete();
            $sess_msg = "Selected Lens Index(s) Deleted...";
        }else{
        DB::table('lens_index')->whereIn('id', $lens_index_ids)->update(["status" => $request_for]);
        $sess_msg = "Selected Lens Index(s) Status Updated...";
    }
    return back()->with('success',$sess_msg);
    }
        
       public function brand_coating_list(Request $request){
        $category_parent_id = $request->id;
        $subcategories = LensBrand::where('category_parent_id',$category_parent_id)->paginate(20);
        return view('admin.manage-brand-coating', compact('subcategories','category_parent_id'));
    }
    
    public function add_brand_coating_form(Request $request){
        $category_parent_id = $request->id;
        return view('admin.addedit-brand-coating',compact('category_parent_id'));
    }    
 

    public function add_brand_coating(Request $request){
    // parent id received
        $category_parent_id = $request->id;
       
    // Creating Category URL
    $category_slug_name = Str::slug($request->category_name, '-');
    //$category_slug_name = $request->category_slug_name;

// Image uploading code
$coating_image_name="";
if($request->hasfile('coating_image_name')){

$coating_image = $request->file('coating_image_name');
$coating_image_name = rand(100000000,500000000).".".$coating_image->getClientOriginalExtension();
// Comment below lines if you dont'nt want original size image
$destinationPath = public_path('/uploaded_files/lens');
$coating_image->move($destinationPath, $coating_image_name);

}

    // INSERT DATA INTO DB

    $subcategory = new LensBrand;
    $subcategory->category_image_name = $coating_image_name;
    $subcategory->category_parent_id = $category_parent_id;
    $subcategory->category_name = $request->category_name;
    $subcategory->type = "coating";
    $subcategory->category_slug_name = $category_slug_name;
    $subcategory->category_type = 'subcat';
    $subcategory->category_tag_line = $request->category_tag_line;
    $subcategory->category_status = $request->category_status;

    $subcategory->save();

    return back()->with('success','Brand Coating Added Successfuly...!');


    }

    public function edit_brand_coating(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $edit_subcategory = LensBrand::findOrFail($request->id);
       
        return view('admin.addedit-brand-coating', compact('edit_subcategory','category_parent_id'));
    }

    public function update_brand_coating(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $subcategory_id = $request->id;
        $subcategory = LensBrand::findOrFail($request->id);


    // Creating Category URL
    $category_slug_name = Str::slug($request->category_name, '-');
    //$category_slug_name = $request->category_slug_name;
    // UPDATE DATA INTO DB

$coat_img = $subcategory->category_image_name;       
// Image uploading code
if($request->hasfile('coating_image_name')){
// Delete Old Image Start
 $image_path = "uploaded_files/lens/".$subcategory->category_image_name;
 if(file_exists($image_path)){
     @unlink($image_path);
 }
$coating_image = $request->file('coating_image_name');
$coating_image_name = rand(100000000,500000000).".".$coating_image->getClientOriginalExtension();

  // Comment below lines if you dont'nt want original size image
    $destinationPath = public_path('/uploaded_files/lens');
    $coating_image->move($destinationPath, $coating_image_name);
    $coat_img = $coating_image_name;
  }

    $subcategory->category_image_name = $coat_img;
    $subcategory->category_name = $request->category_name;
    $subcategory->category_slug_name = $category_slug_name;
    $subcategory->type = "coating";
    $subcategory->category_tag_line = $request->category_tag_line;
    $subcategory->category_status = $request->category_status;
    $subcategory->update();

    return back()->with('success','Brand Coating Updated Successfuly...!');

    }

    public function bottom_button_action_brand_coating(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $category_ids = $request->category_ids;
        $request_for = $request->req_for;

        if($request_for =="Delete"){
            for($i=0;$i<COUNT($category_ids);$i++){
                $this->delete_child($category_ids[$i]);
                $this->delete_parent($category_ids[$i]);
            }
            $sess_msg = "Selected Brand Coating(s) Deleted...";
          }else if($request_for=="Update Order"){
            $category_order_by_ids = $request->category_order_by_ids;
            $category_order_by = $request->category_order_by;
            for($i=0;$i<COUNT($category_order_by_ids);$i++){
             LensBrand::where('id', $category_order_by_ids[$i])->update([
                 'category_order_by' => $category_order_by[$i]
             ]);
            }
            $sess_msg="Sub Lens Brand Order Updated Successfully...";
           }else if($request_for == "Set for home" || $request_for == "Remove from home"){
              $category_for_home = ($request_for == "Set for home") ? "Yes" : "No";
            LensBrand::whereIn('id', $category_ids)->update(["category_for_home" => $category_for_home]);
             $sess_msg = ($request_for == "Set for home") ? "Selected Category(s) set for home..." : "Selected Brand Coating(s) remove from home...";
           }else{
        LensBrand::whereIn('id', $category_ids)->update(["category_status" => $request_for]);
        $sess_msg = "Selected Brand Coating(s) Status Updated...";
    }
    return back()->with('success',$sess_msg);
}

    public function lens_toggle(){
        $lens_toggles = DB::table('lens_toggles')->paginate(20);
        return view('admin.manage-lens-toggle',compact('lens_toggles'));
    }
    
    public function add_lens_toggle_form(){
        return view('admin.addedit-lens-toggle');
    }
    
    public function add_lens_toggle(Request $request){
        $request->validate(['toggle_name'=>'required']);
        
// Image uploading code
$coating_image_name="";
if($request->hasfile('coating_image_name')){

$coating_image = $request->file('coating_image_name');
$coating_image_name = rand(100000000,500000000).".".$coating_image->getClientOriginalExtension();
// Comment below lines if you dont'nt want original size image
$destinationPath = public_path('/uploaded_files/coating');
$coating_image->move($destinationPath, $coating_image_name);

}
        
        DB::table('lens_toggles')->insert([
            'coating_image_name'=>$coating_image_name,
            'toggle_name'=>$request->toggle_name,
            'toggle_desc'=>$request->toggle_desc,
            'toggle_status'=>$request->toggle_status,
            'toggle_date'=>date('Y-m-d')
            ]);
        return back()->with('success','Toggle added successfully...!');    
    }
    
    public function edit_lens_toggle(Request $request){
        $edit_lens_toggle = DB::table('lens_toggles')->where('id',$request->id)->first();
        return view('admin.addedit-lens-toggle',compact('edit_lens_toggle'));
    }
    
    public function update_lens_toggle(Request $request){
        
       $request->validate(['toggle_name'=>'required']);
       $toggle = DB::table('lens_toggles')->where('id',$request->id)->first();
   
$coat_img = $toggle->coating_image_name;       
// Image uploading code
    if($request->hasfile('coating_image_name')){
  // Delete Old Image Start
     $image_path = "uploaded_files/coating/".$toggle->coating_image_name;
     if(file_exists($image_path)){
         @unlink($image_path);
     }

$coating_image = $request->file('coating_image_name');
$coating_image_name = rand(100000000,500000000).".".$coating_image->getClientOriginalExtension();

  // Comment below lines if you dont'nt want original size image
    $destinationPath = public_path('/uploaded_files/coating');
    $coating_image->move($destinationPath, $coating_image_name);
    $coat_img = $coating_image_name;
  }
       
        DB::table('lens_toggles')->where('id',$request->id)->update([
            'coating_image_name'=>$coat_img,
            'toggle_name'=>$request->toggle_name,
            'toggle_desc'=>$request->toggle_desc,
            'toggle_status'=>$request->toggle_status,
            'toggle_date'=>date('Y-m-d')
            ]);
        return back()->with('success','Toggle updated successfully...!');   
    }
    
    public function bottom_button_action_lens_toggle(Request $request){
       
        $lens_toggle_ids = $request->lens_toggle_ids;
        $request_for = $request->req_for;

    if($request_for =="Delete"){
     // Delete image
      for($i=0;$i<COUNT($lens_toggle_ids);$i++){
        $del_img = DB::table('lens_toggles')->where('id',$lens_toggle_ids[$i])->first();
        $path = "uploaded_files/coating/".$del_img->coating_image_name;
        @unlink($path);
        DB::table('lens_toggles')->where('id',$lens_toggle_ids[$i])->delete();     
      } 
     
        $sess_msg = "Selected Toggle(s) Deleted...";
          }else{
        DB::table('lens_toggles')->whereIn('id',$lens_toggle_ids)->update(["toggle_status" => $request_for]);
        $sess_msg = "Selected Toggle(s) Status Updated...";
    }
    return back()->with('success',$sess_msg);
}

}
