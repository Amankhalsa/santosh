<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin_model\Slider;
use App\Admin_model\ImageResize;
use Image;
use Auth;

class SliderController extends Controller
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
        $sliders = Slider::all();
        return view('admin.manage-slider',compact('sliders'));
    }

    public function add_edit_form(Request $request){
        return view('admin.addedit-slider');
    }

    public function add_slider(Request $request){
        $request->validate([
            'slider_image_name' => 'required|image|mimes:jpeg,webp,png,jpg',
            'slider_status' => 'required'
        ],[ 'slider_image_name.required' => 'Upload an image',
            'slider_image_name.mimes' => 'Image must be a file of type: jpeg, webp, png, jpg.',
            'slider_image_name.image' => 'File must be an image.'
          ] );

    if($request->hasfile('slider_image_name')){

    // Fetch Image Size from Image Resize Table START
    $image_resize_data = ImageResize::where('resize_section_name','Slider')->first();
    $resize_width=$image_resize_data->resize_width;
    $resize_height=$image_resize_data->resize_height;
    // Fetch Image Size from Image Resize Table END

    $slider = $request->file('slider_image_name');
    $slider_image = rand(100000,500000).".".$slider->getClientOriginalExtension();
    $destinationPath = public_path('/slider');
    $resize_slider_image = Image::make($slider->getRealPath());
    $resize_slider_image->resize($resize_width,$resize_height, function($constraint){
        $constraint->aspectRatio();
    })->save($destinationPath.'/'.$slider_image);

    }

    // INSERT DATA INTO TABLE

    Slider::create([
        'slider_image_name' => $slider_image,
        'slider_title1' => $request->slider_title1,
        'slider_title2' => $request->slider_title2,
        'slider_button_text' => $request->slider_button_text,
        'slider_button_link' => $request->slider_button_link,
        'slider_status' => $request->slider_status
    ]);

    return back()->with('success','Slider added successfully...!');

    }

    // UPDATE SLIDER STATUS
    public function update_slider_status(Request $request){
        $slider_ids = $request->slider_ids;
        $request_for = $request->req_for;
        if($request_for =="Delete"){
            for($i=0;$i<COUNT($slider_ids);$i++){
               $delSlider = Slider::find($slider_ids[$i], ['slider_image_name']);
               $slider_path = "slider/".$delSlider->slider_image_name;
               @unlink($slider_path);
            }
            Slider::whereIn('id', $slider_ids)->delete();
            $sess_msg = "Selected Slider(s) Deleted...";
        }else{
        Slider::whereIn('id', $slider_ids)->update(["slider_status" => $request_for]);
        $sess_msg = "Selected Slider(s) Status Updated...";
    }
    return back()->with('success',$sess_msg);
}

    // EDIT SLIDER FORM
    public function edit_slider(Request $request){
        $edit_slider = Slider::find($request->id);
        return view('admin.addedit-slider',compact('edit_slider'));
    }

     // UPDATE SLIDER
     public function update_slider(Request $request){

        $request->validate([
            'slider_image_name' => 'image|mimes:jpeg,png,jpg,webp',
            'slider_status' => 'required'
        ],[ 'slider_image_name.required' => 'Upload an image',
            'slider_image_name.mimes' => 'Image must be a file of type: jpeg, webp, png,jpg.',
            'slider_image_name.image' => 'File must be an image.'
          ] );

          $update_slider = Slider::find($request->id);

        if($request->hasfile('slider_image_name')){

    // Fetch Image Size from Image Resize Table START
    $image_resize_data = ImageResize::where('resize_section_name','Slider')->first();
    $resize_width=$image_resize_data->resize_width;
    $resize_height=$image_resize_data->resize_height;
    // Fetch Image Size from Image Resize Table END

        // Delete Old File
            $image_path = "slider/".$update_slider->slider_image_name;
            if(file_exists($image_path)){
            @unlink($image_path);
            }

            $slider = $request->file('slider_image_name');
            $slider_image = rand(100000,500000).".".$slider->getClientOriginalExtension();
            $destinationPath = public_path('/slider');
            $resize_slider_image = Image::make($slider->getRealPath());
            $resize_slider_image->resize($resize_width,$resize_height, function($constraint){
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$slider_image);

        }else{
            $slider_image = $update_slider->slider_image_name;
        }

        // UPDATE DATA INTO TABLE

    Slider::where('id',$request->id)->update([
        'slider_image_name' => $slider_image,
        'slider_title1' => $request->slider_title1,
        'slider_title2' => $request->slider_title2,
        'slider_button_text' => $request->slider_button_text,
        'slider_button_link' => $request->slider_button_link,
        'slider_status' => $request->slider_status
    ]);

    return back()->with('success','Slider updated successfully...!');

    }

}
