<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin_model\Category;
use App\Admin_model\CategoryMoreImages;
use App\Admin_model\Color;
use App\Admin_model\ImageResize;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use App\Admin_model\Admin;
use App\Admin_model\ProductColor;
use App\Admin_model\Vision;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class CategoryController extends Controller
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
        $child_ids = Category::where('category_parent_id',$category_parent_id)->get();
        if($child_ids->isNotEmpty()){
         foreach($child_ids as $child){
           $this->delete_child($child->id);
           $del_ids[]=$child->id;
   // Deleting Category More Images
           $child_data = $child->more_images;
           if($child_data){
           foreach($child_data as $more_img){
               $del_more_img_path = "uploaded_files/category_more_images/".$more_img->category_image_name;
               @unlink($del_more_img_path);
               CategoryMoreImages::where('id', $more_img->id)->delete();
           }}
           
    
        }}else{
// Deleting Category More Images
        $child = Category::where('id',$category_parent_id)->first();
        $child_data = $child->more_images;
        if($child_data){
        foreach($child_data as $more_img){
        $del_more_img_path = "uploaded_files/category_more_images/".$more_img->category_image_name;
        @unlink($del_more_img_path);
        CategoryMoreImages::where('id', $more_img->id)->delete();
        }}


        }
//Deleting Nested Childs Images
   foreach($del_ids as $del_id){
   $delete_image = Category::findOrFail($del_id, ['category_image_name','category_image_name2','category_image_name3','category_image_name4','category_image_name5','category_inner_banner','category_type']);
   $delete_image_path = "uploaded_files/".$delete_image->category_type."/".$delete_image->category_image_name;
   $delete_resize_image_path = "uploaded_files/".$delete_image->category_type."/thumb/".$delete_image->category_image_name;
    @unlink($delete_image_path);
    @unlink($delete_resize_image_path);
    
   $delete_image_path2 = "uploaded_files/".$delete_image->category_type."/".$delete_image->category_image_name2;
    @unlink($delete_image_path2);
    
    $delete_image_path3 = "uploaded_files/".$delete_image->category_type."/".$delete_image->category_image_name3;
    @unlink($delete_image_path3);
    
    $delete_image_path4 = "uploaded_files/".$delete_image->category_type."/".$delete_image->category_image_name4;
    @unlink($delete_image_path4);
    
    $delete_image_path5 = "uploaded_files/".$delete_image->category_type."/".$delete_image->category_image_name5;
    @unlink($delete_image_path5);
    

    $delete_banner = "uploaded_files/".$delete_image->category_type."/".$delete_image->category_inner_banner;
    @unlink($delete_banner);

   }
   // Deleting Nested Childs
       Category::whereIn('id',$del_ids)->delete();
   }

   //Deleting parent records
       public function delete_parent($parent_id){
   //Deleting Parent Image
        $del_img = Category::findOrFail($parent_id, ['category_image_name','category_type']);
        $del_image_path = "uploaded_files/".$del_img->category_type."/".$del_img->category_image_name;
        $del_resize_image_path = "uploaded_files/".$del_img->category_type."/thumb/".$del_img->category_image_name;
        @unlink($del_image_path);
        @unlink($del_resize_image_path);
        
//Deleting Parent Image2
    $del_img2 = Category::findOrFail($parent_id, ['category_image_name2','category_type']);
    $del_image_path2 = "uploaded_files/".$del_img->category_type."/".$del_img2->category_image_name2;
    @unlink($del_image_path2);
    
//Deleting Parent Image3
    $del_img3 = Category::findOrFail($parent_id, ['category_image_name3','category_type']);
    $del_image_path3 = "uploaded_files/".$del_img->category_type."/".$del_img3->category_image_name3;
    @unlink($del_image_path3);
    
//Deleting Parent Image4
    $del_img4 = Category::findOrFail($parent_id, ['category_image_name4','category_type']);
    $del_image_path4 = "uploaded_files/".$del_img->category_type."/".$del_img4->category_image_name4;
    @unlink($del_image_path4);
    
//Deleting Parent Image5
    $del_img5 = Category::findOrFail($parent_id, ['category_image_name5','category_type']);
    $del_image_path5 = "uploaded_files/".$del_img->category_type."/".$del_img5->category_image_name5;
    @unlink($del_image_path5);
        
        
    //Deleting Parent Banner
        $del_banner = Category::findOrFail($parent_id, ['category_inner_banner','category_type']);
        $del_banner_path = "uploaded_files/".$del_banner->category_type."/".$del_banner->category_inner_banner;
        @unlink($del_banner_path);

   // Deleting Parent
       Category::where('id',$parent_id)->delete();
   }

//***********************************************************************************************

    public function index(){
        $categories = Category::where('category_parent_id','0')->paginate(8);
        return view('admin.manage-category', compact('categories'));
    }

    // FUNCTIONS FOR MAIN CATEGORY START

    public function add_category_form(Request $request){
        return view('admin.addedit-category');
    }


    public function add_category(Request $request){
        $request->validate([
            'category_image_name' => 'image|mimes:png,jpg,jpeg',
            'category_name' => 'required|unique:categories,category_name'
        ]);

    // Image uploading code
    $category_image_name="";
    if($request->hasfile('category_image_name')){

     $category_image = $request->file('category_image_name');
     $category_image_name = rand(100000000,500000000).".".$category_image->getClientOriginalExtension();

if($this->admin_data->admin_cat_thumb == "Yes"){
  // Fetch Image Size for Category(thumb) from Image Resize Table START
    $image_resize_data_thumb = ImageResize::where('resize_section_name','CategoryThumb')->where('resize_status','Active')->first();
    if(!empty($image_resize_data_thumb)){
     $resize_width=$image_resize_data_thumb->resize_width;
     $resize_height=$image_resize_data_thumb->resize_height;
    }else{
     $resize_width=179;
     $resize_height=100;
    }
  // Fetch Image Size for Category(thumb) from Image Resize Table END

  // Image Resizing for category(thumb) start
     $destinationPath = public_path('/uploaded_files/cat/thumb');
     $resize_cat_image = Image::make($category_image->getRealPath());
     $resize_cat_image->resize($resize_width,$resize_height, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_image_name);
  // Image Resizing for Category(thumb) end
}
//*****************########################################***************************

  // Fetch Image Size for Category from Image Resize Table START
    $image_resize_data = ImageResize::where('resize_section_name','Category')->where('resize_status','Active')->first();
    if(!empty($image_resize_data)){
     $resize_width=$image_resize_data->resize_width;
     $resize_height=$image_resize_data->resize_height;
    }else{
     $resize_width=400;
     $resize_height=450;
    }
  // Fetch Image Size for Category from Image Resize Table END

  // Image Resizing for category start
     $destinationPath = public_path('/uploaded_files/cat');
     $resize_cat_image = Image::make($category_image->getRealPath());
     $resize_cat_image->resize($resize_width,$resize_height, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_image_name);
  // Image Resizing for Category end



    // Comment below lines if you dont'nt want original size image
        //$destinationPath = public_path('/uploaded_files/cat');
        //$category_image->move($destinationPath, $category_image_name);

    }

    // Code For Category INNER BANNER
    $category_inner_banner="";
    if($request->hasfile('category_inner_banner')){

$category_banner = $request->file('category_inner_banner');
$category_inner_banner = rand(100000000,500000000).".".$category_banner->getClientOriginalExtension();

  // Image Resizing for subcategory start
     $destinationPath = public_path('/uploaded_files/cat');
     $resize_cat_banner = Image::make($category_banner->getRealPath());
     $resize_cat_banner->resize(1600,469, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_inner_banner);
  // Image Resizing for SubCategory end
}

    // Creating Category URL
   $category_slug_name = Str::slug($request->category_name, '-');
    // $category_slug_name = $request->category_slug_name;

    // INSERT DATA INTO DB

    $category = new Category;
    $category->category_image_name = $category_image_name;
    $category->category_inner_banner = $request->category_inner_banner;
    $category->category_inner_banner_width = $request->category_inner_banner_width;
    $category->category_inner_banner_height = $request->category_inner_banner_height;
    $category->category_name = $request->category_name;
    $category->category_slug_name = $category_slug_name;
    $category->category_type = 'cat';
    $category->category_video_name = $request->category_video_name;
    $category->category_short_description = $request->category_short_description;
    $category->category_description = $request->category_description;
    $category->category_meta_title = $request->category_meta_title;
    $category->category_meta_keywords = $request->category_meta_keywords;
    $category->category_meta_description = $request->category_meta_description;
    $category->category_status = $request->category_status;

    $category->save();

    return back()->with('success','Category Added Successfuly...!');

    }

    public function edit_category(Request $request){
       $edit_category = Category::findOrFail($request->id);
       return view('admin.addedit-category', compact('edit_category'));
    }


    public function update_category(Request $request){
        $category_id = $request->id;
        $category = Category::findOrFail($request->id);
        $request->validate([
            'category_image_name' => 'image|mimes:png,jpg,jpeg',
            'category_name' => 'required|unique:categories,category_name,'.$category_id
        ]);

    // Image uploading code
    if($request->hasfile('category_image_name')){

  // Delete Old Image Start
     $image_path = "uploaded_files/cat/".$category->category_image_name;
     $image_path_resize = "uploaded_files/cat/thumb/".$category->category_image_name;
     if(file_exists($image_path)){
         @unlink($image_path);
     }if(file_exists($image_path_resize)){
         @unlink($image_path_resize);
     }
   // Delete Old Image End

$category_image = $request->file('category_image_name');
$category_image_name = rand(100000000,500000000).".".$category_image->getClientOriginalExtension();

if($this->admin_data->admin_cat_thumb == "Yes"){
  // Fetch Image Size for Category(thumb) from Image Resize Table START
    $image_resize_data_thumb = ImageResize::where('resize_section_name','CategoryThumb')->where('resize_status','Active')->first();
    if(!empty($image_resize_data_thumb)){
     $resize_width=$image_resize_data_thumb->resize_width;
     $resize_height=$image_resize_data_thumb->resize_height;
    }else{
     $resize_width=179;
     $resize_height=100;
    }
  // Fetch Image Size for Category(thumb) from Image Resize Table END

  // Image Resizing for category(thumb) start
     $destinationPath = public_path('/uploaded_files/cat/thumb');
     $resize_cat_image = Image::make($category_image->getRealPath());
     $resize_cat_image->resize($resize_width,$resize_height, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_image_name);
  // Image Resizing for Category(thumb) end
}
//*****************########################################***************************

  // Fetch Image Size for Category from Image Resize Table START
    $image_resize_data = ImageResize::where('resize_section_name','Category')->where('resize_status','Active')->first();
    if(!empty($image_resize_data)){
     $resize_width=$image_resize_data->resize_width;
     $resize_height=$image_resize_data->resize_height;
    }else{
     $resize_width=400;
     $resize_height=450;
    }
  // Fetch Image Size for Category from Image Resize Table END

  // Image Resizing for category start
     $destinationPath = public_path('/uploaded_files/cat');
     $resize_cat_image = Image::make($category_image->getRealPath());
     $resize_cat_image->resize($resize_width,$resize_height, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_image_name);
  // Image Resizing for Category end

      // Comment below lines if you dont'nt want original size image
        //$destinationPath = public_path('/uploaded_files/cat');
        //$category_image->move($destinationPath, $category_image_name);
     $category->category_image_name = $category_image_name;
    }

    // Code For Category INNER BANNER
if($request->hasfile('category_inner_banner')){
 // Delete Old Baanner Start
  $banner_path = "uploaded_files/cat/".$category->category_inner_banner;
   if(file_exists($banner_path)){
         @unlink($banner_path);
   }
   // Delete Old Banner End
$category_banner = $request->file('category_inner_banner');
$category_inner_banner = rand(100000000,500000000).".".$category_banner->getClientOriginalExtension();

  // Image Resizing for subcategory start
     $destinationPath = public_path('/uploaded_files/cat');
     $resize_cat_banner = Image::make($category_banner->getRealPath());
     $resize_cat_banner->resize(1600,469, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_inner_banner);
  // Image Resizing for SubCategory end
     $category->category_inner_banner = $category_inner_banner;

}

    // Creating Category URL
    $category_slug_name = Str::slug($request->category_name, '-');
    //$category_slug_name = $request->category_slug_name;
    // UPDATE DATA INTO DB
    $category->category_inner_banner_width = $request->category_inner_banner_width;
    $category->category_inner_banner_height = $request->category_inner_banner_height;
    $category->category_name = $request->category_name;
    $category->category_slug_name = $category_slug_name;
    $category->category_video_name = $request->category_video_name;
    $category->category_short_description = $request->category_short_description;
    $category->category_description = $request->category_description;
    $category->category_meta_title = $request->category_meta_title;
    $category->category_meta_keywords = $request->category_meta_keywords;
    $category->category_meta_description = $request->category_meta_description;
    $category->category_status = $request->category_status;

    $category->update();

    return back()->with('success','Category Updated Successfuly...!');

    }


    public function bottom_button_action_category(Request $request){
        $category_ids = $request->category_ids;
        $request_for = $request->req_for;

        if($request_for =="Delete"){

            for($i=0;$i<COUNT($category_ids);$i++){
                $this->delete_child($category_ids[$i]);
                $this->delete_parent($category_ids[$i]);
            }
            $sess_msg = "Selected Category(s) Deleted...";
          }else if($request_for=="Update Order"){
            $category_order_by_ids = $request->category_order_by_ids;
            $category_order_by = $request->category_order_by;
            for($i=0;$i<COUNT($category_order_by_ids);$i++){
             Category::where('id', $category_order_by_ids[$i])->update([
                 'category_order_by' => $category_order_by[$i]
             ]);
            }
            $sess_msg="Category Order Updated Successfully...";
           }else if($request_for == "Set for home" || $request_for == "Remove from home"){
              $category_for_home = ($request_for == "Set for home") ? "Yes" : "No";
            Category::whereIn('id', $category_ids)->update(["category_for_home" => $category_for_home]);
             $sess_msg = ($request_for == "Set for home") ? "Selected Category(s) set for home..." : "Selected Category(s) remove from home...";
           }else{
        Category::whereIn('id', $category_ids)->update(["category_status" => $request_for]);
        $sess_msg = "Selected Category(s) Status Updated...";
    }

    return back()->with('success',$sess_msg);

   }

    public function remove_category_image(Request $request){
        $remove_image = Category::findOrFail($request->id, ['category_image_name']);
        $remove_image_path = "uploaded_files/cat/".$remove_image->category_image_name;
        $remove_resize_image_path = "uploaded_files/cat/thumb/".$remove_image->category_image_name;
        @unlink($remove_image_path);
        @unlink($remove_resize_image_path);

        Category::where('id', $request->id)->update([ 'category_image_name' => '']);
        return back()->with('success','Image removed successfully...!');
    }

    public function cat_search(Request $request){
        $search_keyword = $request->search_keyword;
        $request->validate([
            'search_keyword' => 'required'
        ]);
        $categories = Category::where('category_name','LIKE','%'.$search_keyword.'%')->where('category_parent_id','0')->paginate(8);
        $categories->appends(array(
            'search_keyword' => $search_keyword
        ));
        return view('admin.manage-category', compact('categories','search_keyword'));
    }


      public function remove_category_banner(Request $request){
        $remove_banner = Category::findOrFail($request->id, ['category_inner_banner']);
        $remove_banner_path = "uploaded_files/cat/".$remove_banner->category_inner_banner;
        @unlink($remove_banner_path);

        Category::where('id', $request->id)->update([ 'category_inner_banner' => '']);
        return back()->with('success','Banner removed successfuly...!');
    }

    // FUNCTIONS FOR MAIN CATEGORY END

// **********************************************************************************************************

    // FUNCTIONS FOR SUB CATEGORY START

    public function subcategory_list(Request $request){
        $category_parent_id = $request->id;
        $subcategories = Category::where('category_parent_id',$category_parent_id)->paginate(8);
        return view('admin.manage-subcategory', compact('subcategories','category_parent_id'));
    }

    public function add_subcategory_form(Request $request){
        $category_parent_id = $request->id;
        return view('admin.addedit-subcategory',compact('category_parent_id'));
    }

    public function add_subcategory(Request $request){
    // parent id received
        $category_parent_id = $request->id;

        $request->validate([
            'category_image_name' => 'image|mimes:png,jpg,jpeg',
            'category_name' => 'required|unique:categories,category_name'
        ]);

    // Image uploading code
    $category_image_name="";
    if($request->hasfile('category_image_name')){

$category_image = $request->file('category_image_name');
$category_image_name = rand(100000000,500000000).".".$category_image->getClientOriginalExtension();

if($this->admin_data->admin_subcat_thumb == "Yes"){
  // Fetch Image Size for SubCategory(thumb) from Image Resize Table START
    $image_resize_data_thumb = ImageResize::where('resize_section_name','SubcategoryThumb')->where('resize_status','Active')->first();
    if(!empty($image_resize_data_thumb)){
     $resize_width=$image_resize_data_thumb->resize_width;
     $resize_height=$image_resize_data_thumb->resize_height;
    }else{
     $resize_width=179;
     $resize_height=100;
    }
  // Fetch Image Size for SubCategory(thumb) from Image Resize Table END

  // Image Resizing for Subcategory(thumb) start
     $destinationPath = public_path('/uploaded_files/subcat/thumb');
     $resize_cat_image = Image::make($category_image->getRealPath());
     $resize_cat_image->resize($resize_width,$resize_height, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_image_name);
  // Image Resizing for SubCategory(thumb) end
}
//*****************########################################***************************

  // Fetch Image Size for SubCategory from Image Resize Table START
    $image_resize_data = ImageResize::where('resize_section_name','Subcategory')->where('resize_status','Active')->first();
    if(!empty($image_resize_data)){
     $resize_width=$image_resize_data->resize_width;
     $resize_height=$image_resize_data->resize_height;
    }else{
     $resize_width=400;
     $resize_height=450;
    }
  // Fetch Image Size for SubCategory from Image Resize Table END

  // Image Resizing for subcategory start
     /*$destinationPath = public_path('/uploaded_files/subcat');
     $resize_cat_image = Image::make($category_image->getRealPath());
     $resize_cat_image->resize($resize_width,$resize_height, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_image_name);*/
  // Image Resizing for SubCategory end
  $destinationPath = public_path('/uploaded_files/subcat');
  $category_image->move($destinationPath, $category_image_name);

    }

// Code For Category INNER BANNER
    $category_inner_banner="";
    if($request->hasfile('category_inner_banner')){

$category_banner = $request->file('category_inner_banner');
$category_inner_banner = rand(100000000,500000000).".".$category_banner->getClientOriginalExtension();

  // Image Resizing for subcategory start
    /* $destinationPath = public_path('/uploaded_files/subcat');
     $resize_cat_banner = Image::make($category_banner->getRealPath());
     $resize_cat_banner->resize(1600,469, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_inner_banner);*/
  // Image Resizing for SubCategory end
  
  $destinationPath = public_path('/uploaded_files/subcat');
  $category_banner->move($destinationPath, $category_inner_banner);
}

    // Creating Category URL
    $category_slug_name = Str::slug($request->category_name, '-');
    //$category_slug_name = $request->category_slug_name;

    // INSERT DATA INTO DB

    $subcategory = new Category;
    $subcategory->category_parent_id = $category_parent_id;
    $subcategory->category_image_name = $category_image_name;
    $subcategory->category_inner_banner = $category_inner_banner;
    $subcategory->category_name = $request->category_name;
    $subcategory->category_slug_name = $category_slug_name;
    $subcategory->category_type = 'subcat';
    $subcategory->category_video_name = $request->category_video_name;
    $subcategory->category_short_description = $request->category_short_description;
    $subcategory->category_description = $request->category_description;
    $subcategory->category_meta_title = $request->category_meta_title;
    $subcategory->category_meta_keywords = $request->category_meta_keywords;
    $subcategory->category_meta_description = $request->category_meta_description;
    $subcategory->category_status = $request->category_status;

    $subcategory->save();

    return back()->with('success','Category Added Successfuly...!');


    }

    public function edit_subcategory(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $edit_subcategory = Category::findOrFail($request->id);
        return view('admin.addedit-subcategory', compact('edit_subcategory','category_parent_id'));
    }

    public function update_subcategory(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $subcategory_id = $request->id;
        $subcategory = Category::findOrFail($request->id);
        $request->validate([
            'category_image_name' => 'image|mimes:png,jpg,jpeg',
            'category_name' => 'required|unique:categories,category_name,'.$subcategory_id
        ]);

    // Image uploading code
    if($request->hasfile('category_image_name')){

  // Delete Old Image Start
     $image_path = "uploaded_files/subcat/".$subcategory->category_image_name;
     $image_path_resize = "uploaded_files/subcat/thumb/".$subcategory->category_image_name;
     if(file_exists($image_path)){
         @unlink($image_path);
     }if(file_exists($image_path_resize)){
         @unlink($image_path_resize);
     }
   // Delete Old Image End

$category_image = $request->file('category_image_name');
$category_image_name = rand(100000000,500000000).".".$category_image->getClientOriginalExtension();

if($this->admin_data->admin_subcat_thumb == "Yes"){
  // Fetch Image Size for SubCategory(thumb) from Image Resize Table START
    $image_resize_data_thumb = ImageResize::where('resize_section_name','SubcategoryThumb')->where('resize_status','Active')->first();
    if(!empty($image_resize_data_thumb)){
     $resize_width=$image_resize_data_thumb->resize_width;
     $resize_height=$image_resize_data_thumb->resize_height;
    }else{
     $resize_width=179;
     $resize_height=100;
    }
  // Fetch Image Size for SubCategory(thumb) from Image Resize Table END

  // Image Resizing for Subcategory(thumb) start
     $destinationPath = public_path('/uploaded_files/subcat/thumb');
     $resize_cat_image = Image::make($category_image->getRealPath());
     $resize_cat_image->resize($resize_width,$resize_height, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_image_name);
  // Image Resizing for SubCategory(thumb) end
}
//*****************########################################***************************

  // Fetch Image Size for SubCategory from Image Resize Table START
    $image_resize_data = ImageResize::where('resize_section_name','Subcategory')->where('resize_status','Active')->first();
    if(!empty($image_resize_data)){
     $resize_width=$image_resize_data->resize_width;
     $resize_height=$image_resize_data->resize_height;
    }else{
     $resize_width=400;
     $resize_height=450;
    }
  // Fetch Image Size for SubCategory from Image Resize Table END

  // Image Resizing for subcategory start
    /* $destinationPath = public_path('/uploaded_files/subcat');
     $resize_cat_image = Image::make($category_image->getRealPath());
     $resize_cat_image->resize($resize_width,$resize_height, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_image_name);*/
  // Image Resizing for SubCategory end


      // Comment below lines if you dont'nt want original size image start
        $destinationPath = public_path('/uploaded_files/subcat');
        $category_image->move($destinationPath, $category_image_name);
      // Comment below lines if you dont'nt want original size image end

     $subcategory->category_image_name = $category_image_name;

    }

// Code For Category INNER BANNER
if($request->hasfile('category_inner_banner')){
 // Delete Old Baanner Start
  $banner_path = "uploaded_files/subcat/".$subcategory->category_inner_banner;
   if(file_exists($banner_path)){
         @unlink($banner_path);
   }
   // Delete Old Banner End
$category_banner = $request->file('category_inner_banner');
$category_inner_banner = rand(100000000,500000000).".".$category_banner->getClientOriginalExtension();

  // Image Resizing for subcategory start
    /* $destinationPath = public_path('/uploaded_files/subcat');
     $resize_cat_banner = Image::make($category_banner->getRealPath());
     $resize_cat_banner->resize(1600,469, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_inner_banner);*/
  // Image Resizing for SubCategory end
  
        $destinationPath = public_path('/uploaded_files/subcat');
        $category_banner->move($destinationPath, $category_inner_banner);
     $subcategory->category_inner_banner = $category_inner_banner;

}

    // Creating Category URL
    $category_slug_name = Str::slug($request->category_name, '-');
    //$category_slug_name = $request->category_slug_name;
    // UPDATE DATA INTO DB

    $subcategory->category_name = $request->category_name;
    $subcategory->category_slug_name = $category_slug_name;
    $subcategory->category_video_name = $request->category_video_name;
    $subcategory->category_short_description = $request->category_short_description;
    $subcategory->category_description = $request->category_description;
    $subcategory->category_meta_title = $request->category_meta_title;
    $subcategory->category_meta_keywords = $request->category_meta_keywords;
    $subcategory->category_meta_description = $request->category_meta_description;
    $subcategory->category_status = $request->category_status;

    $subcategory->update();

    return back()->with('success','Category Updated Successfuly...!');

    }

    public function bottom_button_action_subcategory(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $category_ids = $request->category_ids;
        $request_for = $request->req_for;

        if($request_for =="Delete"){
            for($i=0;$i<COUNT($category_ids);$i++){
                $this->delete_child($category_ids[$i]);
                $this->delete_parent($category_ids[$i]);
            }
            $sess_msg = "Selected Category(s) Deleted...";
          }else if($request_for=="Update Order"){
            $category_order_by_ids = $request->category_order_by_ids;
            $category_order_by = $request->category_order_by;
            for($i=0;$i<COUNT($category_order_by_ids);$i++){
             Category::where('id', $category_order_by_ids[$i])->update([
                 'category_order_by' => $category_order_by[$i]
             ]);
            }
            $sess_msg="Sub category Order Updated Successfully...";
           }else if($request_for == "Set for home" || $request_for == "Remove from home"){
              $category_for_home = ($request_for == "Set for home") ? "Yes" : "No";
            Category::whereIn('id', $category_ids)->update(["category_for_home" => $category_for_home]);
             $sess_msg = ($request_for == "Set for home") ? "Selected Category(s) set for home..." : "Selected Category(s) remove from home...";
           }else{
        Category::whereIn('id', $category_ids)->update(["category_status" => $request_for]);
        $sess_msg = "Selected Category(s) Status Updated...";
    }
    return back()->with('success',$sess_msg);
}

    public function subcat_search(Request $request){
        $search_keyword = $request->search_keyword;
        $category_parent_id = $request->category_parent_id;

        $subcategories = Category::where('category_name','LIKE','%'.$search_keyword.'%')->where('category_parent_id',$category_parent_id)->paginate(8);
        $subcategories->appends(array(
            'search_keyword' => $search_keyword
        ));

        return view('admin.manage-subcategory', compact('subcategories','category_parent_id','search_keyword'));
    }



    public function remove_subcategory_image(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $remove_image = Category::findOrFail($request->id, ['category_image_name']);
        $remove_image_path = "uploaded_files/subcat/".$remove_image->category_image_name;
        $remove_resize_image_path = "uploaded_files/subcat/thumb/".$remove_image->category_image_name;
        @unlink($remove_image_path);
        @unlink($remove_resize_image_path);

        Category::where('id', $request->id)->update([ 'category_image_name' => '']);
        return back()->with('success','Image removed successfuly...!');
    }

      public function remove_subcategory_banner(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $remove_banner = Category::findOrFail($request->id, ['category_inner_banner']);
        $remove_banner_path = "uploaded_files/subcat/".$remove_banner->category_inner_banner;
        @unlink($remove_banner_path);

        Category::where('id', $request->id)->update([ 'category_inner_banner' => '']);
        return back()->with('success','Banner removed successfuly...!');
    }

    // FUNCTIONS FOR SUB CATEGORY END

// **********************************************************************************************************

    // FUNCTIONS FOR FINAL CATEGORY START

    public function finalcategory_list(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $sub_cat_id = $request->sub_cat_id;

        $finalcategories = Category::where('category_parent_id',$sub_cat_id)->paginate(50);
        return view('admin.manage-finalcategory', compact('finalcategories','category_parent_id','sub_cat_id'));
    }

    public function add_finalcategory_form(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $sub_cat_id = $request->sub_cat_id;
        return view('admin.addedit-finalcategory',compact('category_parent_id','sub_cat_id'));
    }

    public function add_finalcategory(Request $request){
        // parent id received
            $category_parent_id = $request->cat_parent_id;
            $sub_cat_id = $request->sub_cat_id;

            $request->validate([
                'category_image_name' => 'image|mimes:png,jpg,jpeg',
                'category_name' => 'required'
            ]);

        // Image uploading code
        $category_image_name="";
        if($request->hasfile('category_image_name')){

$category_image = $request->file('category_image_name');
$category_image_name = rand(100000000,500000000).".".$category_image->getClientOriginalExtension();

if($this->admin_data->admin_finalcat_thumb == "Yes"){
  // Fetch Image Size for FinalCategory(thumb) from Image Resize Table START
    $image_resize_data_thumb = ImageResize::where('resize_section_name','FinalcategoryThumb')->where('resize_status','Active')->first();
    if(!empty($image_resize_data_thumb)){
     $resize_width=$image_resize_data_thumb->resize_width;
     $resize_height=$image_resize_data_thumb->resize_height;
    }else{
     $resize_width=179;
     $resize_height=100;
    }
  // Fetch Image Size for FinalCategory(thumb) from Image Resize Table END

  // Image Resizing for Finalcategory(thumb) start
     $destinationPath = public_path('/uploaded_files/finalcat/thumb');
     $resize_cat_image = Image::make($category_image->getRealPath());
     $resize_cat_image->resize($resize_width,$resize_height, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_image_name);
  // Image Resizing for FinalCategory(thumb) end
}
//*****************########################################***************************

  // Fetch Image Size for FinalCategory from Image Resize Table START
   /* $image_resize_data = ImageResize::where('resize_section_name','Finalcategory')->where('resize_status','Active')->first();
    if(!empty($image_resize_data)){
     $resize_width=$image_resize_data->resize_width;
     $resize_height=$image_resize_data->resize_height;
    }else{
     $resize_width=400;
     $resize_height=450;
    }*/
  // Fetch Image Size for FinalCategory from Image Resize Table END

  // Image Resizing for Finalcategory start
     /*$destinationPath = public_path('/uploaded_files/finalcat');
     $resize_cat_image = Image::make($category_image->getRealPath());
     $resize_cat_image->resize($resize_width,$resize_height, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_image_name);*/
  // Image Resizing for FinalCategory end

       // Comment below lines if you dont'nt want original size image start
            $destinationPath = public_path('/uploaded_files/finalcat');
            $category_image->move($destinationPath, $category_image_name);
       // Comment below lines if you dont'nt want original size image end

        }

           // Code For Category INNER BANNER
    $category_inner_banner="";
    if($request->hasfile('category_inner_banner')){

$category_banner = $request->file('category_inner_banner');
$category_inner_banner = rand(100000000,500000000).".".$category_banner->getClientOriginalExtension();

  // Image Resizing for subcategory start
    /* $destinationPath = public_path('/uploaded_files/finalcat');
     $resize_cat_banner = Image::make($category_banner->getRealPath());
     $resize_cat_banner->resize(1600,469, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_inner_banner);*/
  // Image Resizing for SubCategory end

     // Comment below lines if you dont'nt want original size image start
            $destinationPath = public_path('/uploaded_files/finalcat');
            $category_banner->move($destinationPath, $category_inner_banner);
       // Comment below lines if you dont'nt want original size image end
}

        // Creating Category URL
        $category_slug_name = Str::slug($request->category_name, '-');
          //$category_slug_name = $request->category_slug_name;
        // INSERT DATA INTO DB

        $finalcategory = new Category;
        $finalcategory->category_parent_id = $sub_cat_id;
        $finalcategory->category_discount = $request->category_discount;
        $finalcategory->category_image_name = $category_image_name;
        $finalcategory->category_warranty = $request->category_warranty;
        $finalcategory->category_inner_banner = $category_inner_banner;
        $finalcategory->category_inner_banner_width = $request->category_inner_banner_width;
        $finalcategory->category_inner_banner_height = $request->category_inner_banner_height;
        $finalcategory->category_name = $request->category_name;
        $finalcategory->category_slug_name = $category_slug_name;
        $finalcategory->category_type = 'finalcat';
        $finalcategory->category_video_name = $request->category_video_name;
        $finalcategory->category_short_description = $request->category_short_description;
        $finalcategory->category_description = $request->category_description;
        $finalcategory->category_meta_title = $request->category_meta_title;
        $finalcategory->category_meta_keywords = $request->category_meta_keywords;
        $finalcategory->category_meta_description = $request->category_meta_description;
        $finalcategory->category_status = $request->category_status;

        $finalcategory->save();

        return back()->with('success','Category Added Successfuly...!');


        }

        public function edit_finalcategory(Request $request){
            $category_parent_id = $request->cat_parent_id;
            $sub_cat_id = $request->sub_cat_id;
            $edit_finalcategory = Category::findOrFail($request->id);
            return view('admin.addedit-finalcategory', compact('edit_finalcategory','category_parent_id','sub_cat_id'));
        }

        public function update_finalcategory(Request $request){
            $category_parent_id = $request->cat_parent_id;
            $sub_cat_id = $request->sub_cat_id;
            $finalcategory_id = $request->id;
            $finalcategory = Category::findOrFail($request->id);
            $request->validate([
                'category_image_name' => 'image|mimes:png,jpg,jpeg',
                'category_name' => 'required'
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

if($this->admin_data->admin_finalcat_thumb == "Yes"){
  // Fetch Image Size for FinalCategory(thumb) from Image Resize Table START
    $image_resize_data_thumb = ImageResize::where('resize_section_name','FinalcategoryThumb')->where('resize_status','Active')->first();
    if(!empty($image_resize_data_thumb)){
     $resize_width=$image_resize_data_thumb->resize_width;
     $resize_height=$image_resize_data_thumb->resize_height;
    }else{
     $resize_width=179;
     $resize_height=100;
    }
  // Fetch Image Size for FinalCategory(thumb) from Image Resize Table END

  // Image Resizing for Finalcategory(thumb) start
     $destinationPath = public_path('/uploaded_files/finalcat/thumb');
     $resize_cat_image = Image::make($category_image->getRealPath());
     $resize_cat_image->resize($resize_width,$resize_height, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_image_name);
  // Image Resizing for FinalCategory(thumb) end
}
//*****************########################################***************************

  // Fetch Image Size for FinalCategory from Image Resize Table START
   /* $image_resize_data = ImageResize::where('resize_section_name','Finalcategory')->where('resize_status','Active')->first();
    if(!empty($image_resize_data)){
     $resize_width=$image_resize_data->resize_width;
     $resize_height=$image_resize_data->resize_height;
    }else{
     $resize_width=400;
     $resize_height=450;
    }*/
  // Fetch Image Size for FinalCategory from Image Resize Table END

  // Image Resizing for Finalcategory start
     /*$destinationPath = public_path('/uploaded_files/finalcat');
     $resize_cat_image = Image::make($category_image->getRealPath());
     $resize_cat_image->resize($resize_width,$resize_height, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_image_name);*/
  // Image Resizing for FinalCategory end


          // Comment below lines if you dont'nt want original size image start
            $destinationPath = public_path('/uploaded_files/finalcat');
            $category_image->move($destinationPath, $category_image_name);
          // Comment below lines if you dont'nt want original size image end

         $finalcategory->category_image_name = $category_image_name;

        }

            // Code For Category INNER BANNER
if($request->hasfile('category_inner_banner')){
 // Delete Old Baanner Start
  $banner_path = "uploaded_files/finalcat/".$finalcategory->category_inner_banner;
   if(file_exists($banner_path)){
         @unlink($banner_path);
   }
   // Delete Old Banner End
$category_banner = $request->file('category_inner_banner');
$category_inner_banner = rand(100000000,500000000).".".$category_banner->getClientOriginalExtension();

  // Image Resizing for subcategory start
     $destinationPath = public_path('/uploaded_files/finalcat');
     $resize_cat_banner = Image::make($category_banner->getRealPath());
     $resize_cat_banner->resize(1600,469, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $category_inner_banner);
  // Image Resizing for SubCategory end

     // Comment below lines if you dont'nt want original size image start
            $destinationPath = public_path('/uploaded_files/finalcat');
            $category_banner->move($destinationPath, $category_inner_banner);
          // Comment below lines if you dont'nt want original size image end

     $finalcategory->category_inner_banner = $category_inner_banner;

}

        // Creating Category URL
        $category_slug_name = Str::slug($request->category_name, '-');
        //$category_slug_name = $request->category_slug_name;
        // UPDATE DATA INTO DB
        $finalcategory->category_discount = $request->category_discount;
         $finalcategory->category_inner_banner_width = $request->category_inner_banner_width;
        $finalcategory->category_inner_banner_height = $request->category_inner_banner_height;
        $finalcategory->category_warranty = $request->category_warranty;
        $finalcategory->category_name = $request->category_name;
        $finalcategory->category_slug_name = $category_slug_name;
        $finalcategory->category_video_name = $request->category_video_name;
        $finalcategory->category_short_description = $request->category_short_description;
        $finalcategory->category_description = $request->category_description;
        $finalcategory->category_meta_title = $request->category_meta_title;
        $finalcategory->category_meta_keywords = $request->category_meta_keywords;
        $finalcategory->category_meta_description = $request->category_meta_description;
        $finalcategory->category_status = $request->category_status;

        $finalcategory->update();

        return back()->with('success','Category Updated Successfuly...!');

        }

        public function bottom_button_action_finalcategory(Request $request){
            $category_parent_id = $request->cat_parent_id;
            $sub_cat_id = $request->sub_cat_id;
            $category_ids = $request->category_ids;
            $request_for = $request->req_for;

            if($request_for =="Delete"){
                for($i=0;$i<COUNT($category_ids);$i++){
                    $this->delete_child($category_ids[$i]);
                    $this->delete_parent($category_ids[$i]);
                }
                $sess_msg = "Selected Sub category(s) Deleted...";
              }else if($request_for=="Update Order"){
                $category_order_by_ids = $request->category_order_by_ids;
                $category_order_by = $request->category_order_by;
                for($i=0;$i<COUNT($category_order_by_ids);$i++){
                 Category::where('id', $category_order_by_ids[$i])->update([
                     'category_order_by' => $category_order_by[$i]
                 ]);
                }
                $sess_msg="Sub category Order Updated Successfully...";
               }else if($request_for == "Set for home" || $request_for == "Remove from home"){
                  $category_for_home = ($request_for == "Set for home") ? "Yes" : "No";
                Category::whereIn('id', $category_ids)->update(["category_for_home" => $category_for_home]);
                 $sess_msg = ($request_for == "Set for home") ? "Selected Category(s) set for home..." : "Selected Category(s) remove from home...";
               }else{
            Category::whereIn('id', $category_ids)->update(["category_status" => $request_for]);
            $sess_msg = "Selected Category(s) Status Updated...";
        }

        return back()->with('success',$sess_msg);

}

        public function finalcat_search(Request $request){
            $search_keyword = $request->search_keyword;
            $category_parent_id = $request->category_parent_id;
            $sub_cat_id = $request->sub_cat_id;

            $finalcategories = Category::where('category_name','LIKE','%'.$search_keyword.'%')->where('category_parent_id',$sub_cat_id)->paginate(50);
            $finalcategories->appends(array(
                'search_keyword' => $search_keyword
            ));

            return view('admin.manage-finalcategory', compact('finalcategories','category_parent_id','sub_cat_id','search_keyword'));
        }

        public function remove_finalcategory_image(Request $request){
            $category_parent_id = $request->cat_parent_id;
            $sub_cat_id = $request->sub_cat_id;
            $finalcategory_id = $request->id;

            $remove_image = Category::findOrFail($finalcategory_id, ['category_image_name']);
            $remove_image_path = "uploaded_files/finalcat/".$remove_image->category_image_name;
            $remove_resize_image_path = "uploaded_files/finalcat/thumb/".$remove_image->category_image_name;
            @unlink($remove_image_path);
            @unlink($remove_resize_image_path);

            Category::where('id', $finalcategory_id)->update([ 'category_image_name' => '']);
            return back()->with('success','Image Removed Successfuly...!');
        }

    public function remove_finalcategory_banner(Request $request){
        $remove_banner = Category::findOrFail($request->id, ['category_inner_banner']);
        $remove_banner_path = "uploaded_files/finalcat/".$remove_banner->category_inner_banner;
        @unlink($remove_banner_path);

        Category::where('id', $request->id)->update([ 'category_inner_banner' => '']);
        return back()->with('success','Banner removed successfuly...!');
    }

    // FUNCTIONS FOR FINAL CATEGORY END

//**********************************************************************************************************

    // FUNCTIONS FOR PRODUCT START

    public function product_list(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $sub_cat_id = $request->sub_cat_id;
        $final_cat_id = $request->final_cat_id;

    $products = Category::where('category_parent_id',$final_cat_id)->orderBy('id')->paginate(50);
    return view('admin.manage-product', compact('products','category_parent_id','sub_cat_id','final_cat_id'));
    }

    public function add_product_form(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $sub_cat_id = $request->sub_cat_id;
        $final_cat_id = $request->final_cat_id;
        $product_colors = ProductColor::all();
        
        $visions = Vision::where('vision_parent_id','0')->get();
        
        $shapes = DB::table('product_attributes')->where('shape','!=','')->get();
        $materials = DB::table('product_attributes')->where('material','!=','')->get();
        $types = DB::table('product_attributes')->where('type','!=','')->get();
        $lens_types = DB::table('product_attributes')->where('lens_type','!=','')->get();
        $extras = DB::table('product_attributes')->where('extra','!=','')->get();
        
        return view('admin.addedit-product',compact('category_parent_id','sub_cat_id','final_cat_id','shapes','materials','types','lens_types','extras','product_colors','visions'));
    }

    public function add_product(Request $request){
        $category_parent_id = $request->cat_parent_id;
        $sub_cat_id = $request->sub_cat_id;
        $final_cat_id = $request->final_cat_id;
        $available_with_lens="No";
        if(isset($request->available_with_lens)){
          $available_with_lens="Yes";    
        }

        // Creating Category URL
        $color_data = ProductColor::find($request->category_color);
        $category_slug_name = Str::slug($request->category_name, '-');
        $category_slug_name .= "-".Str::slug($color_data->color_name, '-');
         // $category_slug_name = $request->category_slug_name;

$check_url = Category::where('category_slug_name',$category_slug_name)->count();
if($check_url>0){
  return back()->with('error','Product with same name & color is already exist...!');  
}else{
            $request->validate([
                'category_image_name' => 'image|mimes:png,jpg,jpeg',
                'category_name' => 'required',
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


// Comment below lines if you dont'nt want original size image start
    $destinationPath = public_path('/uploaded_files/product');
    $category_image2->move($destinationPath, $category_image_name2);
// Comment below lines if you dont'nt want original size image end

}

 // Image uploading code 3
        $category_image_name3="";
        if($request->hasfile('category_image_name3')){

$category_image3 = $request->file('category_image_name3');
$category_image_name3 = rand(100000000,500000000).".".$category_image3->getClientOriginalExtension();


// Comment below lines if you dont'nt want original size image start
    $destinationPath = public_path('/uploaded_files/product');
    $category_image3->move($destinationPath, $category_image_name3);
// Comment below lines if you dont'nt want original size image end

}


 // Image uploading code 4
        $category_image_name4="";
        if($request->hasfile('category_image_name4')){

$category_image4 = $request->file('category_image_name4');
$category_image_name4 = rand(100000000,500000000).".".$category_image4->getClientOriginalExtension();


// Comment below lines if you dont'nt want original size image start
    $destinationPath = public_path('/uploaded_files/product');
    $category_image4->move($destinationPath, $category_image_name4);
// Comment below lines if you dont'nt want original size image end

}

 // Image uploading code 5
        $category_image_name5="";
        if($request->hasfile('category_image_name5')){

$category_image5 = $request->file('category_image_name5');
$category_image_name5 = rand(100000000,500000000).".".$category_image5->getClientOriginalExtension();


// Comment below lines if you dont'nt want original size image start
    $destinationPath = public_path('/uploaded_files/product');
    $category_image5->move($destinationPath, $category_image_name5);
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

// Get Visions
$vision_ids="";
if(!empty($request->visions)){
 $vision_ids = implode(',',$request->visions);    
}

$lens_type = "";
if(!empty($request->lens_type)){
 $lens_type = implode(',',$request->lens_type);    
}
$extra = "";
if(!empty($request->extra)){
 $extra = implode(',',$request->extra);    
}

        // INSERT DATA INTO DB

        $product = new Category;
        $product->category_parent_id = $final_cat_id;
        $product->category_uan_code = $request->category_uan_code;
        $product->category_image_name = $category_image_name;
        $product->category_color = $request->category_color;
        $product->visions = $vision_ids;
        $product->category_total_width = $request->category_total_width;
        $product->category_image_name2 = $category_image_name2;
        $product->category_image_name3 = $category_image_name3;
        $product->category_video_name = $request->category_video_name;
        $product->category_inner_banner = $category_inner_banner;
        $product->category_name = $request->category_name;
        $product->category_slug_name = $category_slug_name;
        $product->category_discount_price = $request->category_price;
        $product->category_mrp = $request->category_mrp;
        $product->category_price = $request->category_price;
        $product->category_qty = $request->category_qty;
        $product->category_type = 'product';
        $product->category_sku_code = $request->category_sku_code;
        $product->category_frame = $request->category_frame;
        $product->category_for = $request->category_for;
        $product->available_with_lens = $available_with_lens;
        $product->shape = $request->shape;
        $product->type = $request->type;
        $product->material = $request->material;
        $product->lens_type = $lens_type;
        $product->extra = $extra;
        $product->category_short_description = $request->category_short_description;
        $product->category_description = $request->category_description;
        $product->category_meta_title = $request->category_meta_title;
        $product->category_meta_keywords = $request->category_meta_keywords;
        $product->category_meta_description = $request->category_meta_description;
        $product->category_status = $request->category_status;
        
        $product->category_lens_width = $request->category_lens_width;
        $product->category_lens_height = $request->category_lens_height;
        $product->category_bridge = $request->category_bridge;
        $product->category_arm_length = $request->category_arm_length;
        
        $product->min_sph = $request->min_sph;
        $product->max_sph = $request->max_sph;
        $product->min_cyl = $request->min_cyl;
        $product->max_cyl = $request->max_cyl;
        
        $product->save();

        return back()->with('success','Product Added Successfuly...!');
        
 }
}

        public function edit_product(Request $request){
            $category_parent_id = $request->cat_parent_id;
            $sub_cat_id = $request->sub_cat_id;
            $final_cat_id = $request->final_cat_id;
            $edit_product = Category::findOrFail($request->id);
            $product_colors = ProductColor::all();
            $shapes = DB::table('product_attributes')->where('shape','!=','')->get();
            $materials = DB::table('product_attributes')->where('material','!=','')->get();
            $types = DB::table('product_attributes')->where('type','!=','')->get();
            $lens_types = DB::table('product_attributes')->where('lens_type','!=','')->get();
            $extras = DB::table('product_attributes')->where('extra','!=','')->get();
            $edit_lens_type="";
            $edit_extra="";
            if(!empty($edit_product->lens_type)){
             $edit_lens_type = explode(',',$edit_product->lens_type);   
            }if(!empty($edit_product->extra)){
             $edit_extra = explode(',',$edit_product->extra);   
            }
            
            $visions = Vision::where('vision_parent_id','0')->get();
            
            $copied_products = Category::where('id','!=',$request->id)->where('category_parent_id','!=',0)->get();
            
            return view('admin.addedit-product', compact('edit_product','category_parent_id','sub_cat_id','final_cat_id','shapes','materials','types','product_colors','copied_products','visions','lens_types','extras','edit_lens_type','edit_extra'));
        }

        public function update_product(Request $request){
            $category_parent_id = $request->cat_parent_id;
            $sub_cat_id = $request->sub_cat_id;
            $final_cat_id = $request->final_cat_id;
            $product_id = $request->id;
            $product = Category::findOrFail($product_id);
            $available_with_lens="No";
            if(isset($request->available_with_lens)){
            $available_with_lens="Yes";    
            }
            
        // Creating Category URL
        $color_data = ProductColor::find($request->category_color);
       $category_slug_name = Str::slug($request->category_name, '-');
       $category_slug_name .= "-".Str::slug($color_data->color_name, '-');
        //$category_slug_name = $request->category_slug_name;    

$check_url = Category::where('category_slug_name',$category_slug_name)->where('id','!=',$product_id)->count();
if($check_url>0){
 return back()->with('error','product with same name & color is already exist...!');    
}else{
            
            $request->validate([
                'category_image_name' => 'image|mimes:png,jpg,jpeg',
                'category_name' => 'required',
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


  // Comment below lines if you dont'nt want original size image start
    $destinationPath = public_path('/uploaded_files/product');
    $category_image2->move($destinationPath, $category_image_name2);
  // Comment below lines if you dont'nt want original size image end

 $product->category_image_name2 = $category_image_name2;

}

// Image uploading code 3
    if($request->hasfile('category_image_name3')){

  // Delete Old Image Start
     $image_path3 = "uploaded_files/product/".$product->category_image_name3;
     if(file_exists($image_path3)){
         @unlink($image_path3);
     }
   // Delete Old Image End

$category_image3 = $request->file('category_image_name3');
$category_image_name3 = rand(100000000,500000000).".".$category_image3->getClientOriginalExtension();


  // Comment below lines if you dont'nt want original size image start
    $destinationPath = public_path('/uploaded_files/product');
    $category_image3->move($destinationPath, $category_image_name3);
  // Comment below lines if you dont'nt want original size image end

 $product->category_image_name3 = $category_image_name3;
}

// Image uploading code 4
    if($request->hasfile('category_image_name4')){

  // Delete Old Image Start
     $image_path4 = "uploaded_files/product/".$product->category_image_name4;
     if(file_exists($image_path4)){
         @unlink($image_path4);
     }
   // Delete Old Image End

$category_image4 = $request->file('category_image_name4');
$category_image_name4 = rand(100000000,500000000).".".$category_image4->getClientOriginalExtension();


  // Comment below lines if you dont'nt want original size image start
    $destinationPath = public_path('/uploaded_files/product');
    $category_image4->move($destinationPath, $category_image_name4);
  // Comment below lines if you dont'nt want original size image end

 $product->category_image_name4 = $category_image_name4;
}

// Image uploading code 5
    if($request->hasfile('category_image_name5')){

  // Delete Old Image Start
     $image_path5 = "uploaded_files/product/".$product->category_image_name5;
     if(file_exists($image_path5)){
         @unlink($image_path5);
     }
   // Delete Old Image End

$category_image5 = $request->file('category_image_name5');
$category_image_name5 = rand(100000000,500000000).".".$category_image5->getClientOriginalExtension();


  // Comment below lines if you dont'nt want original size image start
    $destinationPath = public_path('/uploaded_files/product');
    $category_image5->move($destinationPath, $category_image_name5);
  // Comment below lines if you dont'nt want original size image end

 $product->category_image_name5 = $category_image_name5;
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

        // UPDATE DATA INTO DB

$group_ids="";

if(!empty($request->category_group_ids)){
$group_ids=implode(',',$request->category_group_ids).','.$request->id;    
for($i=0;$i<COUNT($request->category_group_ids);$i++){
 Category::where('id',$request->category_group_ids[$i])
    ->update(['category_group_ids'=>$group_ids]);
}

Category::where('category_copy_id',$request->id)->whereNotIn('id',$request->category_group_ids)->update(['category_group_ids'=>'']);

}else{
   $grp = explode(',',$product->category_group_ids); 
  if(!empty($grp[0])){
   $group_ids = "";
  }else{  
   $group_ids = $product->category_group_ids; 
}}

// Get Visions
$vision_ids="";
if(!empty($request->visions)){
 $vision_ids = implode(',',$request->visions);    
}

// Update Prices
$final_price = $request->category_price;
if($product->category_is_discount=="Yes"){
$main_cat = Category::find($final_cat_id);    
$discount_price = ($request->category_price/100)*$main_cat->category_discount;
$final_price= $request->category_price-$discount_price;
}

$lens_type = "";
if(!empty($request->lens_type)){
 $lens_type = implode(',',$request->lens_type);    
}
$extra = "";
if(!empty($request->extra)){
 $extra = implode(',',$request->extra);    
}

        $product->category_name = $request->category_name;
        $product->category_uan_code = $request->category_uan_code;
        $product->category_color = $request->category_color;
        $product->category_slug_name = $category_slug_name;
        $product->visions = $vision_ids;
        $product->category_total_width = $request->category_total_width;
        $product->category_video_name = $request->category_video_name;
        $product->category_short_description = $request->category_short_description;
        $product->available_with_lens = $available_with_lens;
        $product->category_group_ids = $group_ids;
        $product->category_description = $request->category_description;
        $product->category_discount_price = $final_price;
        $product->category_mrp = $request->category_mrp;
        $product->category_price = $request->category_price;
        $product->category_qty = $request->category_qty;
        $product->category_for = $request->category_for;
        $product->shape = $request->shape;
        $product->type = $request->type;
        $product->lens_type = $lens_type;
        $product->extra = $extra;
        $product->category_sku_code = $request->category_sku_code;
        $product->category_frame = $request->category_frame;
        $product->material = $request->material;
        $product->category_meta_title = $request->category_meta_title;
        $product->category_meta_keywords = $request->category_meta_keywords;
        $product->category_meta_description = $request->category_meta_description;
        $product->category_status = $request->category_status;
         $product->category_lens_width = $request->category_lens_width;
        $product->category_lens_height = $request->category_lens_height;
        $product->category_bridge = $request->category_bridge;
        $product->category_arm_length = $request->category_arm_length;
        
        $product->min_sph = $request->min_sph;
        $product->max_sph = $request->max_sph;
        $product->min_cyl = $request->min_cyl;
        $product->max_cyl = $request->max_cyl;
        
        $product->update();

        return back()->with('success','Product Updated Successfuly...!');

        }
    }    

public function bottom_button_action_product(Request $request){
    $category_parent_id = $request->cat_parent_id;
    $sub_cat_id = $request->sub_cat_id;
    $final_cat_id = $request->final_cat_id;
    $category_ids = $request->category_ids;
    $request_for = $request->req_for;
    
    $main_cat=Category::find($final_cat_id);

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
         Category::where('id', $category_order_by_ids[$i])->update([
             'category_order_by' => $category_order_by[$i]
         ]);
        }
        $sess_msg="Product Order Updated Successfully...";
       }else if($request_for == "Set for Top" || $request_for == "Remove from Top"){
          $category_is_top = ($request_for == "Set for Top") ? "Yes" : "No";
        Category::whereIn('id', $category_ids)->update(["category_is_top" => $category_is_top]);
         $sess_msg = ($request_for == "Set for Top") ? "Selected product(s) Set for Top..." : "Selected Product(s) Remove from Top...";
       }
else if($request_for == "Set for Discount"){
for($i=0;$i<COUNT($category_ids);$i++){       
$prd = Category::find($category_ids[$i]);
if($prd->category_is_discount=="No"){ 
$discount_price = ($prd->category_discount_price/100)*$main_cat->category_discount;
$final_price= $prd->category_discount_price-$discount_price;
Category::where('id',$category_ids[$i])->update(['category_discount_price'=>$final_price,'category_is_discount'=>'Yes','category_discount'=>$main_cat->category_discount]);
}}
$sess_msg = "Selected product(s) Set for Discount...";
}
else if($request_for == "Remove from Discount"){
for($i=0;$i<COUNT($category_ids);$i++){       
$prd = Category::find($category_ids[$i]);
Category::where('id',$category_ids[$i])->update(['category_discount_price'=>$prd->category_price,'category_is_discount'=>'No']);
}
$sess_msg = "Selected product(s) Remove from Discount...";
}

       else if($request_for == "Set for Deal" || $request_for == "Remove from Deal"){
          $category_deal = ($request_for == "Set for Deal") ? "Yes" : "No";
        Category::whereIn('id', $category_ids)->update(["category_deal" => $category_deal]);
         $sess_msg = ($request_for == "Set for Deal") ? "Selected product(s) Set for Deal..." : "Selected Product(s) Remove from Deal...";
       }
       else{
    Category::whereIn('id', $category_ids)->update(["category_status" => $request_for]);
    $sess_msg = "Selected Product(s) Status Updated...";
}

return back()->with('success',$sess_msg);
}

public function bottomButtonAllFrame(Request $request){
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
         Category::where('id', $category_order_by_ids[$i])->update([
             'category_order_by' => $category_order_by[$i]
         ]);
        }
        $sess_msg="Product Order Updated Successfully...";
       }else if($request_for == "Set for Top" || $request_for == "Remove from Top"){
          $category_is_top = ($request_for == "Set for Top") ? "Yes" : "No";
        Category::whereIn('id', $category_ids)->update(["category_is_top" => $category_is_top]);
         $sess_msg = ($request_for == "Set for Top") ? "Selected product(s) Set for Top..." : "Selected Product(s) Remove from Top...";
       }
else if($request_for == "Set for Discount"){
for($i=0;$i<COUNT($category_ids);$i++){ 
$prd = Category::find($category_ids[$i]);
$main_cat = Category::where('id',$prd->category_parent_id)->first();

if($prd->category_is_discount=="No"){ 
$discount_price = ($prd->category_discount_price/100)*$main_cat->category_discount;
$final_price= $prd->category_discount_price-$discount_price;
Category::where('id',$category_ids[$i])->update(['category_discount_price'=>$final_price,'category_is_discount'=>'Yes','category_discount'=>$main_cat->category_discount]);
}}
$sess_msg = "Selected product(s) Set for Discount...";
}
else if($request_for == "Remove from Discount"){
for($i=0;$i<COUNT($category_ids);$i++){       
$prd = Category::find($category_ids[$i]);
$main_cat = Category::where('id',$prd->category_parent_id)->first();
Category::where('id',$category_ids[$i])->update(['category_discount_price'=>$prd->category_price,'category_is_discount'=>'No']);
}
$sess_msg = "Selected product(s) Remove from Discount...";
}

       else if($request_for == "Set for Deal" || $request_for == "Remove from Deal"){
          $category_deal = ($request_for == "Set for Deal") ? "Yes" : "No";
        Category::whereIn('id', $category_ids)->update(["category_deal" => $category_deal]);
         $sess_msg = ($request_for == "Set for Deal") ? "Selected product(s) Set for Deal..." : "Selected Product(s) Remove from Deal...";
       }
       else{
    Category::whereIn('id', $category_ids)->update(["category_status" => $request_for]);
    $sess_msg = "Selected Product(s) Status Updated...";
}

return back()->with('success',$sess_msg);
}

        public function product_search(Request $request){
            $search_keyword = $request->search_keyword;
            $category_parent_id = $request->category_parent_id;
            $sub_cat_id = $request->sub_cat_id;
            $final_cat_id = $request->final_cat_id;

            $products = Category::where('category_name','LIKE','%'.$search_keyword.'%')->where('category_parent_id',$final_cat_id)->paginate(8);
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

            $remove_image = Category::findOrFail($product_id, ['category_image_name']);
            $remove_image_path = "uploaded_files/product/".$remove_image->category_image_name;
            $remove_resize_image_path = "uploaded_files/product/thumb/".$remove_image->category_image_name;
            @unlink($remove_image_path);
            @unlink($remove_resize_image_path);

            Category::where('id', $product_id)->update([ 'category_image_name' => '']);
            return back()->with('success','Image Removed Successfuly...!');
        }
        
        public function remove_product_back_image(Request $request){
            $category_parent_id = $request->cat_parent_id;
            $sub_cat_id = $request->sub_cat_id;
            $final_cat_id = $request->final_cat_id;
            $product_id = $request->id;

            $remove_image = Category::findOrFail($product_id, ['category_image_name2']);
            $remove_image_path = "uploaded_files/product/".$remove_image->category_image_name2;
            $remove_resize_image_path = "uploaded_files/product/thumb/".$remove_image->category_image_name2;
            @unlink($remove_image_path);
            @unlink($remove_resize_image_path);

            Category::where('id', $product_id)->update([ 'category_image_name2' => '']);
            return back()->with('success','Image Removed Successfuly...!');
        }
        
        public function remove_product_image3(Request $request){
            $category_parent_id = $request->cat_parent_id;
            $sub_cat_id = $request->sub_cat_id;
            $final_cat_id = $request->final_cat_id;
            $product_id = $request->id;

            $remove_image3 = Category::findOrFail($product_id, ['category_image_name3']);
            $remove_image_path3 = "uploaded_files/product/".$remove_image3->category_image_name3;
            @unlink($remove_image_path3);
            
            Category::where('id', $product_id)->update([ 'category_image_name3' => '']);
            return back()->with('success','Image Removed Successfuly...!');
        }
        
         public function remove_product_image4(Request $request){
            $category_parent_id = $request->cat_parent_id;
            $sub_cat_id = $request->sub_cat_id;
            $final_cat_id = $request->final_cat_id;
            $product_id = $request->id;

            $remove_image4 = Category::findOrFail($product_id, ['category_image_name4']);
            $remove_image_path4 = "uploaded_files/product/".$remove_image4->category_image_name4;
            @unlink($remove_image_path4);
            
            Category::where('id', $product_id)->update([ 'category_image_name4' => '']);
            return back()->with('success','Image Removed Successfuly...!');
        }
        
         public function remove_product_image5(Request $request){
            $category_parent_id = $request->cat_parent_id;
            $sub_cat_id = $request->sub_cat_id;
            $final_cat_id = $request->final_cat_id;
            $product_id = $request->id;

            $remove_image5 = Category::findOrFail($product_id, ['category_image_name5']);
            $remove_image_path5 = "uploaded_files/product/".$remove_image5->category_image_name5;
            @unlink($remove_image_path5);
            
            Category::where('id', $product_id)->update([ 'category_image_name5' => '']);
            return back()->with('success','Image Removed Successfuly...!');
        }

      public function remove_product_banner(Request $request){
        $remove_banner = Category::findOrFail($request->id, ['category_inner_banner']);
        $remove_banner_path = "uploaded_files/product/".$remove_banner->category_inner_banner;
        @unlink($remove_banner_path);

        Category::where('id', $request->id)->update([ 'category_inner_banner' => '']);
        return back()->with('success','Banner removed successfuly...!');
    }


    public function copy_product(Request $request){
        $copy_data = Category::find($request->id);
        // Copy Product
        $copy = new Category;
        $copy->category_parent_id = $copy_data->category_parent_id;
        $copy->category_copy_id = $request->id;
        $copy->category_color = $copy_data->category_color;
        $copy->category_name = $copy_data->category_name."1";
        $copy->category_slug_name = $copy_data->category_slug_name."1";
        $copy->category_discount_price = $copy_data->category_discount_price;
        $copy->category_mrp = $copy_data->category_mrp;
        $copy->category_price = $copy_data->category_price;
        $copy->category_type = 'product';
        $copy->category_sku_code = $copy_data->category_sku_code;
        $copy->category_uan_code = $copy_data->category_uan_code;
        $copy->category_frame = $copy_data->category_frame;
        $copy->category_for = $copy_data->category_for;
        $copy->available_with_lens = $copy_data->available_with_lens;
        $copy->shape = $copy_data->shape;
        $copy->type = $copy_data->type;
        $copy->material = $copy_data->material;
        $copy->category_short_description = $copy_data->category_short_description;
        $copy->category_description = $copy_data->category_description;
        $copy->category_meta_title = $copy_data->category_meta_title;
        $copy->category_meta_keywords = $copy_data->category_meta_keywords;
        $copy->category_meta_description = $copy_data->category_meta_description;
        $copy->category_status = $copy_data->category_status;
        $copy->category_lens_width = $copy_data->category_lens_width;
        $copy->category_lens_height = $copy_data->category_lens_height;
        $copy->category_bridge = $copy_data->category_bridge;
        $copy->category_arm_length = $copy_data->category_arm_length;
        $copy->category_total_width = $copy_data->category_total_width;
        $copy->category_group_ids = $copy_data->category_group_ids;
        $copy->visions = $copy_data->visions;
        $copy->category_discount = $copy_data->category_discount;
        $copy->category_is_discount = $copy_data->category_is_discount;
        $copy->category_qty = $copy_data->category_qty;
        $copy->min_sph = $copy_data->min_sph;
        $copy->max_sph = $copy_data->max_sph;
        $copy->min_cyl = $copy_data->min_cyl;
        $copy->max_cyl = $copy_data->max_cyl;
        
        $copy->save();
        
        return back()->with('success','Frame Copied successfully...!');
    }
    
   public function frame_type_list(Request $request){
       $products = Category::where('category_type','Product')->latest()->paginate(100);
       return view('admin.manage-frame-type', compact('products'));
   }
   
   public function frame_type_filter(Request $request){
       $type = $request->type;
       $search_keyword = $request->search_keyword;
       $products = Category::where('category_type','Product');
       if(!empty($search_keyword)){
          $products->where('category_name','LIKE','%'.$search_keyword.'%'); 
       }if(!empty($type)){
          $products->where('category_frame',$type); 
      
          
       }
       $products = $products->paginate(50);
       return view('admin.manage-frame-type', compact('products','type','search_keyword'));
   }

public function exportProduct(){
        return Excel::download(new ProductExport, 'products.xlsx');
    }

}
