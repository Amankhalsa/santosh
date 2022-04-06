<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class ProductAttributesController extends Controller
{
    public function __construct(){
    	$this->middleware('auth:admin');
    }

    public function index(){
    	return view('admin.frame-attribute-type');
    }
    
    public function attribute_list(Request $request){
        $type=$request->type;
        $attribute_data = DB::table('product_attributes')->where($type,'!=','')->get();
        return view('admin.attribute-list',compact('attribute_data','type'));
    }
    
    public function add_attribute_form(Request $request){
        $type=$request->type;
        return view('admin.addedit-attribute',compact('type'));
    }
    
    public function add_attribute(Request $request){
        $type=$request->type;
        $attribute_value=$request->attribute_value;
        DB::table('product_attributes')->insert([$type=>$attribute_value,'date'=>date('Y-m-d')]);
        return back()->with('success','Successfully added!');
    }
    
    public function edit_attribute(Request $request){
        $type=$request->type;
        $id = $request->id;
    $edit_attribute = DB::table('product_attributes')->where('id',$id)->first();
    return view('admin.addedit-attribute',compact('edit_attribute','type'));
    }
    
    public function update_attribute(Request $request){
        $type=$request->type;
        $id = $request->id;
        $attribute_value=$request->attribute_value;
        DB::table('product_attributes')->where('id',$id)->update([$type=>$attribute_value]);
        return back()->with('success','Successfully updated!');
    }
    
    public function bottom_button_action_attribute(Request $request){
        $attribute_ids = $request->attribute_ids;
     DB::table('product_attributes')->whereIn('id', $attribute_ids)->delete();
     return back()->with('success','Successfully deleted!');  
    }


}
