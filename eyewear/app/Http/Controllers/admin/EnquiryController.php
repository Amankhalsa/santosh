<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin_model\Enquiry;

class EnquiryController extends Controller
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
       $enquiry = Enquiry::paginate(8);
       return view('admin.manage-enquiry',compact('enquiry'));
    }

    public function bottom_button_action_enquiry(Request $request){
        $enquiry_id = $request->enquiry_id;
        $request_for = $request->req_for;

        if($request_for =="Delete"){
            // for($i=0;$i<COUNT($enquiry_id);$i++){
            //    $delEnquiryData = Enquiry::find($enquiry_id[$i]);
            //    $delEnquiryData->delete();
            // }

            Enquiry::whereIn('id', $enquiry_id)->delete();
            $sess_msg = "Selected enquiry deleted...";
        }
    return back()->with('success',$sess_msg);

    }
}
