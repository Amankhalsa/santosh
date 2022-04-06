<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use App\Admin_model\Vision;
use App\Admin_model\Lens;

class VisionController extends Controller
{
    public function __construct(){
    	return $this->middleware('auth:admin');
    }

    //Deleting Child records
    public function delete_child($id){
        $del_ids=array();
        $vision_parent_id = $id;
        $child_ids = Vision::where('vision_parent_id',$vision_parent_id)->get();
        if($child_ids->isNotEmpty()){
         foreach($child_ids as $child){
           $this->delete_child($child->id);
           $del_ids[]=$child->id;       
    
        }}

   //Deleting Nested Childs Images
       foreach($del_ids as $del_id){
       $delete_image = Vision::findOrFail($del_id, ['vision_image_name']);
       $delete_image_path = "uploaded_files/vision/".$delete_image->vision_image_name;
        @unlink($delete_image_path);
       }
   // Deleting Nested Childs
       Vision::whereIn('id',$del_ids)->delete();
   }

   //Deleting parent records
       public function delete_parent($parent_id){
   //Deleting Parent Image
        $del_img = Vision::findOrFail($parent_id, ['vision_image_name']);
        $del_image_path = "uploaded_files/vision/".$del_img->vision_image_name;
        @unlink($del_image_path);

   // Deleting Parent
       Vision::where('id',$parent_id)->delete();
   }

    public function index(){
    	$visions = Vision::where('vision_parent_id',0)->paginate(10);
    	return view('admin.manage-vision',compact('visions'));
    }

    public function add_vision_form(){
    	return view('admin.addedit-vision');
    }

    public function add_vision(Request $request){
        $request->validate([
            'vision_image_name' => 'image|mimes:png,jpg,jpeg',
            'vision_name' => 'required|unique:visions,vision_name'
        ]);

    // Image uploading code
    $vision_image_name="";
    if($request->hasfile('vision_image_name')){

     $vision_image = $request->file('vision_image_name');
     $vision_image_name = rand(100000000,500000000).".".$vision_image->getClientOriginalExtension();

  // Image Resizing for vision start
    /* $destinationPath = public_path('/uploaded_files/vision');
     $resize_vision_image = Image::make($vision_image->getRealPath());
     $resize_vision_image->resize(326,202, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $vision_image_name);*/
  // Image Resizing for vision end

     // Comment below lines if you dont'nt want original size image start
            $destinationPath = public_path('/uploaded_files/vision');
            $vision_image->move($destinationPath, $vision_image_name);
       // Comment below lines if you dont'nt want original size image end 

    }


    // INSERT DATA INTO DB

    $vision = new Vision;
    $vision->vision_image_name = $vision_image_name;
    $vision->vision_name = $request->vision_name;
    $vision->vision_tag_line = $request->vision_tag_line;
    $vision->vision_description = $request->vision_description;
    $vision->vision_disable_description = $request->vision_disable_description;
    $vision->is_power = $request->is_power;
    $vision->vision_type = $request->vision_type;
    $vision->save();

    return back()->with('success','Vision Added Successfuly...!');

    }

    public function edit_vision(Request $request){
    	$edit_vision = Vision::find($request->id);
    	return view('admin.addedit-vision',compact('edit_vision'));
    }

    public function update_vision(Request $request){
    	$vision_id = $request->id;
        $vision = Vision::findOrFail($request->id);
        $request->validate([
            'vision_image_name' => 'image|mimes:png,jpg,jpeg',
            'vision_name' => 'required|unique:visions,vision_name,'.$vision_id
        ]);

    // Image uploading code
    if($request->hasfile('vision_image_name')){

  // Delete Old Image Start
     $image_path = "uploaded_files/vision/".$vision->vision_image_name;
     if(file_exists($image_path)){
         @unlink($image_path);
     }
   // Delete Old Image End

$vision_image = $request->file('vision_image_name');
$vision_image_name = rand(100000000,500000000).".".$vision_image->getClientOriginalExtension();


  // Image Resizing for category start
    /* $destinationPath = public_path('/uploaded_files/vision');
     $resize_vision_image = Image::make($vision_image->getRealPath());
     $resize_vision_image->resize(326,202, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $vision_image_name);*/
  // Image Resizing for Category end

     // Comment below lines if you dont'nt want original size image start
            $destinationPath = public_path('/uploaded_files/vision');
            $vision_image->move($destinationPath, $vision_image_name);
       // Comment below lines if you dont'nt want original size image end 

     $vision->vision_image_name = $vision_image_name;
    }else{
     $vision_image_name = $vision->vision_image_name;	
    }


    // UPDATE DATA INTO DB

    $vision->vision_image_name = $vision_image_name;
    $vision->vision_name = $request->vision_name;
    $vision->vision_tag_line = $request->vision_tag_line;
    $vision->vision_description = $request->vision_description;
    $vision->vision_disable_description = $request->vision_disable_description;
    $vision->is_power = $request->is_power;
    $vision->vision_type = $request->vision_type;
    $vision->update();
    return back()->with('success','Vision Updated Successfuly...!');
    }

    public function remove_vision_image(Request $request){
    	$remove_image = Vision::findOrFail($request->id, ['vision_image_name']);
        $remove_image_path = "uploaded_files/vision/".$remove_image->vision_image_name;
        @unlink($remove_image_path);

        Vision::where('id', $request->id)->update([ 'vision_image_name' => '']);
        return back()->with('success','Image removed successfully...!');
    }

    public function bottom_button_action_vision(Request $request){
    	$vision_ids = $request->vision_ids;
        $request_for = $request->req_for;

    if($request_for =="Delete"){
        for($i=0;$i<COUNT($vision_ids);$i++){
            $this->delete_child($vision_ids[$i]);
            $this->delete_parent($vision_ids[$i]);
        }
        $sess_msg = "Selected Vision(s) Deleted...";
      }
    return back()->with('success',$sess_msg);
    }

    public function subvision_list(Request $request){
    	$vision_parent_id = $request->id;
    	$subvisions = Vision::where('vision_parent_id',$vision_parent_id)->paginate(10);
    	return view('admin.manage-subvision',compact('subvisions','vision_parent_id'));
    }

    public function add_subvision_form(Request $request){
    	$vision_parent_id = $request->id;
    	return view('admin.addedit-subvision',compact('vision_parent_id'));
    }

     public function add_subvision(Request $request){
     	$vision_parent_id = $request->id;
        $request->validate([
            'vision_image_name' => 'image|mimes:png,jpg,jpeg',
            'vision_name' => 'required|unique:visions,vision_name'
        ]);

        
    // Image uploading code
    $vision_image_name="";
    if($request->hasfile('vision_image_name')){

     $vision_image = $request->file('vision_image_name');
     $vision_image_name = rand(100000000,500000000).".".$vision_image->getClientOriginalExtension();

  // Image Resizing for vision start
    /* $destinationPath = public_path('/uploaded_files/vision');
     $resize_vision_image = Image::make($vision_image->getRealPath());
     $resize_vision_image->resize(326,202, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $vision_image_name);*/
  // Image Resizing for vision end

     // Comment below lines if you dont'nt want original size image start
            $destinationPath = public_path('/uploaded_files/vision');
            $vision_image->move($destinationPath, $vision_image_name);
       // Comment below lines if you dont'nt want original size image end 

    }

    $vision_price=0;
    if(!empty($request->vision_price)){
      $vision_price = $request->vision_price;    
    }

$vision_data = Vision::find($vision_parent_id);

    // INSERT DATA INTO DB

    $vision = new Vision;
    $vision->vision_parent_id = $vision_parent_id;
    $vision->vision_image_name = $vision_image_name;
    $vision->vision_name = $request->vision_name;
    $vision->vision_price = $vision_price;
    $vision->vision_tag_line = $request->vision_tag_line;
    $vision->vision_description = $request->vision_description;
    $vision->vision_type = $vision_data->vision_type;
    $vision->save();

    return back()->with('success','Sub Vision Added Successfuly...!');

    }

    public function edit_subvision(Request $request){
    	$vision_parent_id = $request->vision_parent_id;
    	$edit_subvision = Vision::find($request->id);
    	return view('admin.addedit-subvision',compact('edit_subvision','vision_parent_id'));
    }

    public function update_subvision(Request $request){
    	$vision_parent_id = $request->vision_parent_id;
    	$vision_id = $request->id;
        $vision = Vision::findOrFail($request->id);
        $request->validate([
            'vision_image_name' => 'image|mimes:png,jpg,jpeg',
            'vision_name' => 'required|unique:visions,vision_name,'.$vision_id
        ]);


    // Image uploading code
    if($request->hasfile('vision_image_name')){

  // Delete Old Image Start
     $image_path = "uploaded_files/vision/".$vision->vision_image_name;
     if(file_exists($image_path)){
         @unlink($image_path);
     }
   // Delete Old Image End

$vision_image = $request->file('vision_image_name');
$vision_image_name = rand(100000000,500000000).".".$vision_image->getClientOriginalExtension();



     // Comment below lines if you dont'nt want original size image start
            $destinationPath = public_path('/uploaded_files/vision');
            $vision_image->move($destinationPath, $vision_image_name);
       // Comment below lines if you dont'nt want original size image end 

     $vision->vision_image_name = $vision_image_name;
    }else{
     $vision_image_name = $vision->vision_image_name;	
    }
    
    $vision_price=0;
    if(!empty($request->vision_price)){
      $vision_price = $request->vision_price;    
    }

    // UPDATE DATA INTO DB
$vision_data = Vision::find($vision_parent_id);

    $vision->vision_image_name = $vision_image_name;
    $vision->vision_name = $request->vision_name;
    $vision->vision_tag_line = $request->vision_tag_line;
    $vision->vision_description = $request->vision_description;
    $vision->vision_price = $vision_price;
    $vision->vision_type = $vision_data->vision_type;
    $vision->update();
    return back()->with('success','Sub Vision Updated Successfuly...!');
    }

    public function remove_subvision_image(Request $request){
    	$vision_parent_id = $request->vision_parent_id;
    	$remove_image = Vision::findOrFail($request->id, ['vision_image_name']);
        $remove_image_path = "uploaded_files/vision/".$remove_image->vision_image_name;
        @unlink($remove_image_path);

        Vision::where('id', $request->id)->update([ 'vision_image_name' => '']);
        return back()->with('success','Image removed successfully...!');
    }

    public function bottom_button_action_subvision(Request $request){
    	$vision_ids = $request->vision_ids;
        $request_for = $request->req_for;

    if($request_for =="Delete"){
        for($i=0;$i<COUNT($vision_ids);$i++){
            $this->delete_child($vision_ids[$i]);
            $this->delete_parent($vision_ids[$i]);
        }
        $sess_msg = "Selected Sub Vision(s) Deleted...";
      }
    return back()->with('success',$sess_msg);
    }
}
