<?php

namespace App\Http\Controllers\admin;
use App\Admin_model\manage_page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class ManagePagesController extends Controller
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
        $pages = manage_page::orderBy('page_order_by')->get();
        return view('admin.manage-pages',compact('pages'));
    }

    public function edit(Request $request, $id){
        $page_edit = manage_page::findOrFail($id);
        return view('admin.page-edit',compact('page_edit'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'page_name' => 'required',
            'page_image' => 'image|mimes:jpeg,png,jpg|max:1024',
            
        ]);


        $page_data = manage_page::find($id);
        $page_data->page_name = $request->input('page_name');
        $page_data->page_link = $request->page_link;
        $page_data->page_content = $request->input('page_content');
        $page_data->page_status = $request->input('page_status');
        $page_data->page_meta_title = $request->page_meta_title;
        $page_data->page_meta_keywords = $request->page_meta_keywords;
        $page_data->page_meta_description = $request->page_meta_description;
        $page_data->page_video = $request->page_video;

        // Upload Image
        if($request->hasfile('page_image')){

        // Delete Old File
        $image_path = "uploaded_files/page/".$page_data->page_image;
        if (file_exists($image_path)) {
        @unlink($image_path);
        }

        $image = $request->file('page_image');
        $new_name = rand().'.'.$image->getClientOriginalExtension();
        $image->move(public_path("uploaded_files/page"),$new_name);
        $page_data->page_image = $new_name;
        }
        
    // Upload Video
        if($request->hasfile('page_video')){

        // Delete Old File
        $video_path = "uploaded_files/page/video/".$page_data->page_video;
        if (file_exists($video_path)) {
        @unlink($video_path);
        }

        $video = $request->file('page_video');
        $new_name = rand().'.'.$video->getClientOriginalExtension();
        $video->move(public_path("uploaded_files/page/video"),$new_name);
        $page_data->page_video = $new_name;
        }    
        
        $page_data->update();

        return back()->with('success','Page data is updated successfully...');
    }

    public function update_status(Request $request){
        $sess_msg="";
        $req_for = $request->input('req_for');
        $page_ids = $request->input('page_ids');
       if($req_for=="Active" || $req_for=="Inactive"){
        manage_page::whereIn('id', $page_ids)->update([
            'page_status' => $req_for ]);
        $sess_msg="Selected Page(s) status is updated";
        }else if($req_for=="Set for header" || $req_for=="Remove from header"){
         $request_for = ($req_for=="Set for header") ? 'Yes' :'No';
         manage_page::whereIn('id', $page_ids)->update([
             'set_for_header' => $request_for ]);
        $sess_msg="Selected Page(s) ".$req_for;
        }else if($req_for=="Set for footer" || $req_for=="Remove from footer"){
         $request_for = ($req_for=="Set for footer") ? 'Yes' :'No';
         manage_page::whereIn('id', $page_ids)->update([
             'set_for_footer' => $request_for ]);
        $sess_msg="Selected Page(s) ".$req_for;
        }else if($req_for=="Update Order"){
         $page_ids_upd = $request->input('page_ids_upd');
         $page_order_by = $request->input('page_order');
         for($i=0;$i<COUNT($page_ids_upd);$i++){
          manage_page::where('id', $page_ids_upd[$i])->update([
              'page_order_by' => $page_order_by[$i]
          ]);
         }
         $sess_msg="Page Order Updated Successfully...";
        }
        return redirect('/admin/manage-pages')->with('msg_page_status',$sess_msg);
    }

    public function remove_page_image(Request $request){
        $remove_image = manage_page::findOrFail($request->id, ['page_image']);
        $remove_image_path = "uploaded_files/page/".$remove_image->page_image;
        @unlink($remove_image_path);

        manage_page::where('id', $request->id)->update([ 'page_image' => '']);
        return back()->with('success','Image removed successfully...!');
    }
    
    public function remove_page_video(Request $request){
        $remove_video = manage_page::findOrFail($request->id, ['page_video']);
        $remove_video_path = "uploaded_files/page/video/".$remove_video->page_video;
        @unlink($remove_video_path);

        manage_page::where('id', $request->id)->update([ 'page_video' => '']);
        return back()->with('success','Video removed successfully...!');
    }
}
