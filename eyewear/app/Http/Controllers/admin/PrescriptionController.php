<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class PrescriptionController extends Controller
{
    public function __construct(){
    	$this->middleware('auth:admin');
    }

    public function index(){
    	return view('admin.prescription-type');
    }
    
    public function prescription_list(Request $request){
        $type=$request->type;
        $prescription_data = DB::table('prescription_data')->where($type,'!=','')->get();
        return view('admin.prescription-list',compact('prescription_data','type'));
    }
    
    public function add_prescription_form(Request $request){
        $type=$request->type;
        return view('admin.addedit-prescription',compact('type'));
    }
    
    public function add_prescription(Request $request){
        $type=$request->type;
        $prescription_value=$request->prescription_value;
        DB::table('prescription_data')->insert([$type=>$prescription_value,'date'=>date('Y-m-d')]);
        return back()->with('success','Successfully added!');
    }
    
    public function edit_prescription(Request $request){
        $type=$request->type;
        $id = $request->id;
    $edit_prescription = DB::table('prescription_data')->where('id',$id)->first();
    return view('admin.addedit-prescription',compact('edit_prescription','type'));
    }
    
    public function update_prescription(Request $request){
        $type=$request->type;
        $id = $request->id;
        $prescription_value=$request->prescription_value;
        DB::table('prescription_data')->where('id',$id)->update([$type=>$prescription_value]);
        return back()->with('success','Successfully updated!');
    }
    
    public function bottom_button_action_prescription(Request $request){
        $prescription_ids = $request->prescription_ids;
     DB::table('prescription_data')->whereIn('id', $prescription_ids)->delete();
     return back()->with('success','Successfully deleted!');  
    }


}
