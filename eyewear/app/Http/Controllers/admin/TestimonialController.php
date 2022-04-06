<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin_model\Testimonial;
use App\Admin_model\ImageResize;
use Image;
use Auth;

class TestimonialController extends Controller
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
        $testimonials = Testimonial::all();
        return view('admin.manage-testimonial',compact('testimonials'));
    }

    public function add_edit_form(Request $request){
        return view('admin.addedit-testimonial');
    }

    public function add_testimonial(Request $request){

        $request->validate([
            'testimonial_image_name' => 'required|image|mimes:jpeg,png,jpg',
            'testimonial_given_by' => 'required',
            'testimonial_desig' => 'required',
            'testimonial_company' => 'required',
            'testimonial_status' => 'required'
        ],[ 'testimonial_image_name.required' => 'Upload an image',
            'testimonial_image_name.mimes' => 'Image must be a file of type: jpeg, png, jpg.',
            'testimonial_image_name.image' => 'File must be an image.',
            'testimonial_given_by.required' => 'Name is required.',
            'testimonial_desig.required' => 'Designation is required.',
            'testimonial_company.required' => 'Company name is required.'
          ] );

          if($request->hasfile('testimonial_image_name')){

            // Fetch Image Size from Image Resize Table START
            $image_resize_data = ImageResize::where('resize_section_name','Testimonial')->first();
            if(!empty($image_resize_data)){
                $resize_width=$image_resize_data->resize_width;
                $resize_height=$image_resize_data->resize_height;
            }else{
                $resize_width=179;
                $resize_height=100;
            }
            // Fetch Image Size from Image Resize Table END

            $testimonial = $request->file('testimonial_image_name');
            $testimonial_image = rand(100000,500000).".".$testimonial->getClientOriginalExtension();
            $destinationPath = public_path('/testimonial');
            $resize_testimonial_image = Image::make($testimonial->getRealPath());
            $resize_testimonial_image->resize($resize_width,$resize_height, function($constraint){
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$testimonial_image);

            }

              // INSERT DATA INTO TABLE

            Testimonial::create([
                'testimonial_image_name' => $testimonial_image,
                'testimonial_given_by' => $request->testimonial_given_by,
                'testimonial_desig' => $request->testimonial_desig,
                'testimonial_company' => $request->testimonial_company,
                'testimonial_status' => $request->testimonial_status
            ]);

            return back()->with('success','Testimonial added successfully...!');

    }

        // UPDATE TESTIMONIAL STATUS
        public function update_testimonial_status(Request $request){
            $testimonial_ids = $request->testimonial_ids;
            $request_for = $request->req_for;
            if($request_for =="Delete"){
                for($i=0;$i<COUNT($testimonial_ids);$i++){
                   $delTestimonial = Testimonial::find($testimonial_ids[$i], ['testimonial_image_name']);
                   $testimonial_path = "testimonial/".$delTestimonial->testimonial_image_name;
                   @unlink($testimonial_path);
                }
                Testimonial::whereIn('id', $testimonial_ids)->delete();
                $sess_msg = "Selected Testimonial(s) Deleted...";
            }else{
            Testimonial::whereIn('id', $testimonial_ids)->update(["testimonial_status" => $request_for]);
            $sess_msg = "Selected Testimonial(s) Status Updated...";
        }
        return back()->with('success',$sess_msg);
    }

    public function edit_testimonial(Request $request){
        $edit_testimonial = Testimonial::find($request->id);
        return view('admin.addedit-testimonial',compact('edit_testimonial'));
    }

    public function update_testimonial(Request $request){

        $request->validate([
            'testimonial_image_name' => 'image|mimes:jpeg,png,jpg',
            'testimonial_given_by' => 'required',
            'testimonial_desig' => 'required',
            'testimonial_company' => 'required',
            'testimonial_status' => 'required'
        ],[ 'testimonial_image_name.mimes' => 'Image must be a file of type: jpeg, png, jpg.',
            'testimonial_image_name.image' => 'File must be an image.',
            'testimonial_given_by.required' => 'Name is required.',
            'testimonial_desig.required' => 'Designation is required.',
            'testimonial_company.required' => 'Company name is required.'
          ] );

          $update_testimonial = Testimonial::find($request->id);

        if($request->hasfile('testimonial_image_name')){

        // Fetch Image Size from Image Resize Table START
        $image_resize_data = ImageResize::where('resize_section_name','Testimonial')->first();
        if(!empty($image_resize_data)){
            $resize_width=$image_resize_data->resize_width;
            $resize_height=$image_resize_data->resize_height;
        }else{
            $resize_width=179;
            $resize_height=100;
        }
        // Fetch Image Size from Image Resize Table END

        // Delete Old File
            $image_path = "testimonial/".$update_testimonial->testimonial_image_name;
            if(file_exists($image_path)){
            @unlink($image_path);
            }

            $testimonial = $request->file('testimonial_image_name');
            $testimonial_image = rand(100000,500000).".".$testimonial->getClientOriginalExtension();
            $destinationPath = public_path('/testimonial');
            $resize_testimonial_image = Image::make($testimonial->getRealPath());
            $resize_testimonial_image->resize($resize_width,$resize_height, function($constraint){
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$testimonial_image);

        }else{
            $testimonial_image = $update_testimonial->testimonial_image_name;
        }

        // UPDATE DATA INTO TABLE

            Testimonial::where('id',$request->id)->update([
                'testimonial_image_name' => $testimonial_image,
                'testimonial_given_by' => $request->testimonial_given_by,
                'testimonial_desig' => $request->testimonial_desig,
                'testimonial_company' => $request->testimonial_company,
                'testimonial_status' => $request->testimonial_status
            ]);

            return back()->with('success','Testimonial updated successfully...!');

    }

}
