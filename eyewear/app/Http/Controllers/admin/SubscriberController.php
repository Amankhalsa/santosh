<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin_model\Subscriber;

class SubscriberController extends Controller
{
    public function __construct(){
    	$this->middleware('auth:admin');
    }

    public function index(){
    	$subscribers = Subscriber::paginate(20);
    	return view('admin.manage-subscriber',compact('subscribers'));
    }

    public function bottom_button_action_subscriber(Request $request){
        $subscriber_ids = $request->subscriber_ids;
        $request_for = $request->req_for;

        if($request_for =="Delete"){
            Subscriber::whereIn('id', $subscriber_ids)->delete();
            $sess_msg = "Selected subscriber deleted...";
        }
    return back()->with('success',$sess_msg);

    }

}
