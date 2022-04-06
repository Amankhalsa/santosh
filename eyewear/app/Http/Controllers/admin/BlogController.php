<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin_model\Blog;
use Intervention\Image\Facades\Image;
use App\admin_model\ImageResize;
use Illuminate\Support\Str;

class BlogController extends Controller
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

    public function index(){
        $blogs = Blog::paginate(8);
        return view('admin.manage-blog',compact('blogs'));
    }

    public function add_blog_form(){
        return view('admin.addedit-blog');
    }

    public function add_blog(Request $request){
        $request->validate([
            'blog_image_name' => 'required|image|mimes:png,jpg,jpeg',
            'blog_name' => 'required|unique:blogs,blog_name',
            'blog_desc' => 'required'
        ],[
            'blog_image_name.required' => 'blog image mandatory',
            'blog_image_name.image' => 'file type must be an image',
            'blog_image_name.mimes' => 'file type must be in ( jpg, jpeg, png )'
        ]);
    $blog_image="";
    if($request->hasFile('blog_image_name')){
        $blog = $request->file('blog_image_name');
        $blog_image = rand(100000000,500000000).'.'.$blog->getClientOriginalExtension();
        // Fetch Image Size from Image Resize Table START
        $image_resize_data = ImageResize::where('resize_section_name','BlogThumb')->first();
        if(!empty($image_resize_data)){
            $resize_width=$image_resize_data->resize_width;
            $resize_height=$image_resize_data->resize_height;
        }else{
            $resize_width=179;
            $resize_height=100;
        }
        // Fetch Image Size from Image Resize Table END

     $destinationPath = public_path("/blog/thumb");
     $resize_blog_image = Image::make($blog->getRealPath());
     $resize_blog_image->resize($resize_width,$resize_height, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath.'/'.$blog_image);

//*************************######################################################***************************

// Fetch Image Size for Blog from Image Resize Table START
$image_resize_data = ImageResize::where('resize_section_name','Blog')->where('resize_status','Active')->first();
    if(!empty($image_resize_data)){
     $resize_width=$image_resize_data->resize_width;
     $resize_height=$image_resize_data->resize_height;
    }else{
     $resize_width=400;
     $resize_height=450;
    }
  // Fetch Image Size for Blog from Image Resize Table END

  // Image Resizing for Blog start
     $destinationPath = public_path('/blog');
     $resize_blog_image = Image::make($blog->getRealPath());
     $resize_blog_image->resize($resize_width,$resize_height, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $blog_image);
  // Image Resizing for Blog end
    }

// INSERT DATA
$blog_slug_name = Str::slug($request->blog_name);
   Blog::create([
       'blog_image_name' => $blog_image,
       'blog_name' => $request->blog_name,
       'blog_slug_name' => $blog_slug_name,
       'blog_desc' => $request->blog_desc,
       'blog_status' => $request->blog_status,
       'blog_meta_title' => $request->blog_meta_title,
       'blog_meta_keywords' => $request->blog_meta_keywords,
       'blog_meta_description' => $request->blog_meta_description
   ]);
return back()->with('success','Blog added successfully...!');

    }

    public function edit_blog(Request $request){
        $edit_blog = Blog::findOrFail($request->id);
        return view('admin.addedit-blog',compact('edit_blog'));
    }

    public function update_blog(Request $request){
        $request->validate([
            'blog_image_name' => 'image|mimes:png,jpg,jpeg',
            'blog_name' => 'required|unique:blogs,blog_name,'.$request->id,
            'blog_desc' => 'required'
        ],[
            'blog_image_name.image' => 'file type must be an image',
            'blog_image_name.mimes' => 'file type must be in ( jpg, jpeg, png )'
        ]);

    $blog_update = Blog::findOrFail($request->id);
    $blog_image="";
    if($request->hasFile('blog_image_name')){
     $image_path = "blog/".$blog_update->blog_image_name;
     $image_thumb_path = "blog/thumb/".$blog_update->blog_image_name;
    if(file_exists($image_path)){
        unlink($image_path);
    }if(file_exists($image_thumb_path)){
        unlink($image_thumb_path);
    }

     $blog = $request->file('blog_image_name');
     $blog_image = rand(100000000,500000000).'.'.$blog->getClientOriginalExtension();

        // Fetch Image Size from Image Resize Table START
        $image_resize_data = ImageResize::where('resize_section_name','BlogThumb')->first();
        if(!empty($image_resize_data)){
            $resize_width=$image_resize_data->resize_width;
            $resize_height=$image_resize_data->resize_height;
        }else{
            $resize_width=179;
            $resize_height=100;
        }
        // Fetch Image Size from Image Resize Table END

     $destinationPath = public_path("/blog/thumb");
     $resize_blog_image = Image::make($blog->getRealPath());
     $resize_blog_image->resize($resize_width,$resize_height, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath.'/'.$blog_image);

//*************************######################################################***************************

// Fetch Image Size for Blog from Image Resize Table START
$image_resize_data = ImageResize::where('resize_section_name','Blog')->where('resize_status','Active')->first();
    if(!empty($image_resize_data)){
     $resize_width=$image_resize_data->resize_width;
     $resize_height=$image_resize_data->resize_height;
    }else{
     $resize_width=400;
     $resize_height=450;
    }
  // Fetch Image Size for Blog from Image Resize Table END

  // Image Resizing for Blog start
     $destinationPath = public_path('/blog');
     $resize_blog_image = Image::make($blog->getRealPath());
     $resize_blog_image->resize($resize_width,$resize_height, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $blog_image);
  // Image Resizing for Blog end
    }else{
        $blog_image = $blog_update->blog_image_name;
    }

 $blog_slug_name = Str::slug($request->blog_name);
// UPDATE DATA
 $blog_update->blog_image_name = $blog_image;
 $blog_update->blog_name = $request->blog_name;
 $blog_update->blog_slug_name = $blog_slug_name;
 $blog_update->blog_desc = $request->blog_desc;
 $blog_update->blog_status = $request->blog_status;
 $blog_update->blog_meta_title = $request->blog_meta_title;
 $blog_update->blog_meta_keywords = $request->blog_meta_keywords;
 $blog_update->blog_meta_description = $request->blog_meta_description;
 $blog_update->update();

return back()->with('success','Blog updated successfully...!');
}

 public function bottom_button_action_blog(Request $request){
    $blog_ids = $request->blog_ids;
    $request_for = $request->req_for;
    if($request_for =="Delete"){
        for($i=0;$i<COUNT($blog_ids);$i++){
           $delBlog = Blog::find($blog_ids[$i], ['blog_image_name']);
           $blog_path = "blog/".$delBlog->blog_image_name;
           $blog_thumb_path = "blog/thumb/".$delBlog->blog_image_name;
           @unlink($blog_path);
           @unlink($blog_thumb_path);

        }
        Blog::whereIn('id', $blog_ids)->delete();
        $sess_msg = "Selected Blog(s) Deleted...";
    }else{
    Blog::whereIn('id', $blog_ids)->update(["blog_status" => $request_for]);
    $sess_msg = "Selected Blog(s) Status Updated...";
}
return back()->with('success',$sess_msg);

 }

}
