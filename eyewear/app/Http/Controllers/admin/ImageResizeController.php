<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin_model\ImageResize;

class ImageResizeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
       $this->middleware('auth:admin');
    }

    public function index(){
      $image_resize = ImageResize::paginate(8);
      return view('admin.manage-image-resize',compact('image_resize'));
    }

    public function add_image_resize_form(Request $request){
      return view('admin.addedit-image-resize');
    }

    public function add_image_resize(Request $request){
      $request->validate([
        'resize_section_name' => 'required|unique:image_resizes,resize_section_name',
        'resize_width' => 'required|numeric|min:10',
        'resize_height' => 'required|numeric|min:10'
      ]);

    ImageResize::create([
      'resize_section_name' => $request->resize_section_name,
      'resize_width' => $request->resize_width,
      'resize_height' => $request->resize_height,
      'resize_status' => $request->resize_status
    ]);

    return redirect('/admin/manage-image-resize')->with('success','Image Resize Section added successfully...!');

    }

    public function edit_image_resize(Request $request){
      $edit_image_resize = ImageResize::findOrFail($request->id);
      return view('admin.addedit-image-resize',compact('edit_image_resize'));
    }

    public function update_image_resize(Request $request){
      $request->validate([
        'resize_section_name' => 'required|unique:image_resizes,resize_section_name,'.$request->id,
        'resize_width' => 'required|numeric|min:10',
        'resize_height' => 'required|numeric|min:10'
      ]);

    ImageResize::where('id',$request->id)->update([
      'resize_section_name' => $request->resize_section_name,
      'resize_width' => $request->resize_width,
      'resize_height' => $request->resize_height,
      'resize_status' => $request->resize_status
    ]);

    return redirect('/admin/manage-image-resize')->with('success','Image Resize Section updated successfully...!');

    }

    public function bottom_button_action(Request $request){
        $image_resize_id = $request->image_resize_id;
        $request_for = $request->req_for;

        if($request_for =="Delete"){
            for($i=0;$i<COUNT($image_resize_id);$i++){
               $delImageResizeData = ImageResize::find($image_resize_id[$i]);
               $delImageResizeData->delete();
            }
            $sess_msg = "Selected Image Resize Section(s) Deleted...";
        }else{
        ImageResize::whereIn('id', $image_resize_id)->update(["resize_status" => $request_for]);
        $sess_msg = "Selected Image Resize Section(s) Status Updated...";
    }
    return redirect("/admin/manage-image-resize")->with('success',$sess_msg);
    }


}
