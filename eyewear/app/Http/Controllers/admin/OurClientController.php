<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\admin_model\OurClient;
use Intervention\Image\Facades\Image;
use App\admin_model\ImageResize;

class OurClientController extends Controller
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
        $our_clients = OurClient::all();
        return view('admin.manage-client-logo', compact('our_clients'));
    }

    public function add_client_logo(Request $request){

        $request->validate([
            'client_image_name.*' => 'image|mimes:png,jpg,jpeg'
        ],[
            'client_image_name.*.image' => 'File must be an image',
            'client_image_name.*.mimes' => 'Image type must be a ( jpg, jpeg or png )'
        ]);

    // Fetch Image Size from Image Resize Table START
        $image_resize_data = ImageResize::where('resize_section_name','ClientLogo')->first();
        if(!empty($image_resize_data)){
            $resize_width=$image_resize_data->resize_width;
            $resize_height=$image_resize_data->resize_height;
        }else{
            $resize_width=179;
            $resize_height=150;
        }

    // Fetch Image Size from Image Resize Table END

        $images = array();
        if($files=$request->file('client_image_name')){
            foreach($files as $file){
             $client_image_name = rand(100000000,500000000).".".$file->getClientOriginalExtension();
             $destinationPath = public_path('/client_logo');
             $resize_client_logo = Image::make($file->getRealPath());
             $resize_client_logo->resize($resize_width,$resize_height, function($constraint){
                $constraint->aspectRatio();
             })->save($destinationPath . '/' . $client_image_name);
            $images[] = $client_image_name;
            }
        }
    // INSERT DATA

    foreach($images as $image){
        OurClient::create([ 'client_image_name' => $image ]);
    }
    return back()->with('success','Client logo added successfully...!');
    }

    public function delete_client_logo(Request $request){
        $remove_image = OurClient::findOrFail($request->id, ['client_image_name']);
        $remove_image_path = "client_logo/".$remove_image->client_image_name;
        @unlink($remove_image_path);

        OurClient::where('id', $request->id)->delete();
        return back()->with('success','Client logo deleted successfully...!');

    }

}
