<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\admin_model\OurTeam;
use Intervention\Image\Facades\Image;
use App\admin_model\ImageResize;

class OurTeamController extends Controller
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
        $our_teams = OurTeam::all();
        return view('admin.manage-our-team', compact('our_teams'));
    }

    public function add_member_form(){
        return view('admin.addedit-our-team');
    }

    public function add_member(Request $request){
        $request->validate([
            'member_image_name' => 'required|image|mimes:png,jpg,jpeg',
            'member_name' => 'required',
            'member_designation' => 'required'
        ]);
        $member_image="";
        if($request->hasFile("member_image_name")){

            // Fetch Image Size from Image Resize Table START
            $image_resize_data = ImageResize::where('resize_section_name','OurTeam')->first();
            if(!empty($image_resize_data)){
                $resize_width=$image_resize_data->resize_width;
                $resize_height=$image_resize_data->resize_height;
            }else{
                $resize_width=179;
                $resize_height=100;
            }
            // Fetch Image Size from Image Resize Table END

            $member = $request->file('member_image_name');
            $member_image = rand(100000000,500000000).".".$member->getClientOriginalExtension();
            $destinationPath = public_path("/our_team");
            $resize_member_image = Image::make($member->getRealPath());
            $resize_member_image->resize($resize_width,$resize_height, function($constraint){
                $constraint->aspectRatio();
            })->save($destinationPath. '/' .$member_image);
        }

        //INSERT DATA
        OurTeam::create([
            'member_image_name' => $member_image,
            'member_name' => $request->member_name,
            'member_designation' => $request->member_designation,
            'member_status' => $request->member_status
        ]);
        return back()->with('success','Team member added successfully...!');
    }

    public function edit_member(Request $request){
        $edit_our_team = OurTeam::findOrFail($request->id);
        return view('admin.addedit-our-team',compact('edit_our_team'));
    }

    public function update_member(Request $request){
        $request->validate([
            'member_image_name' => 'image|mimes:png,jpg,jpeg',
            'member_name' => 'required',
            'member_designation' => 'required'
        ]);

        $update_member = OurTeam::findOrFail($request->id);
        $member_image = "";
        if($request->hasFile("member_image_name")){

            // Fetch Image Size from Image Resize Table START
            $image_resize_data = ImageResize::where('resize_section_name','OurTeam')->first();
            if(!empty($image_resize_data)){
                $resize_width=$image_resize_data->resize_width;
                $resize_height=$image_resize_data->resize_height;
            }else{
                $resize_width=179;
                $resize_height=100;
            }
            // Fetch Image Size from Image Resize Table END

             // Delete Old File
             $image_path = "our_team/".$update_member->member_image_name;
             if(file_exists($image_path)){
             @unlink($image_path);
             }

            $member = $request->file('member_image_name');
            $member_image = rand(100000000,500000000).".".$member->getClientOriginalExtension();
            $destinationPath = public_path("/our_team");
            $resize_member_image = Image::make($member->getRealPath());
            $resize_member_image->resize($resize_width,$resize_height, function($constraint){
                $constraint->aspectRatio();
            })->save($destinationPath. '/' .$member_image);
        }else{
            $member_image = $update_member->member_image_name;
        }

        //UPDATE DATA

        OurTeam::where('id',$request->id)->update([
            'member_image_name' => $member_image,
            'member_name' => $request->member_name,
            'member_designation' => $request->member_designation,
            'member_status' => $request->member_status
        ]);
       return back()->with('success','Member updated successfully...!');

    }

    public function bottom_button_action_our_team(Request $request){
        $our_team_ids = $request->our_team_ids;
        $request_for = $request->req_for;
        if($request_for =="Delete"){
            for($i=0;$i<COUNT($our_team_ids);$i++){
               $delMember = OurTeam::find($our_team_ids[$i], ['member_image_name']);
               $member_path = "our_team/".$delMember->member_image_name;
               @unlink($member_path);
            }
            OurTeam::whereIn('id', $our_team_ids)->delete();
            $sess_msg = "Selected Member(s) Deleted...";
        }else{
        OurTeam::whereIn('id', $our_team_ids)->update(["member_status" => $request_for]);
        $sess_msg = "Selected Member(s) Status Updated...";
    }
    return back()->with('success',$sess_msg);
}
}
