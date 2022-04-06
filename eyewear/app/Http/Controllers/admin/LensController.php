<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin_model\Lens;
use App\Admin_model\Vision;
use App\Admin_model\LensColorType;
use App\Admin_model\LensBrand;
use Illuminate\Support\Str;
use Image;
use DB;
use App\Exports\LensExport;
use Maatwebsite\Excel\Facades\Excel;

class LensController extends Controller
{
    public function __construct(){
    	$this->middleware('auth:admin');
    }

    public function index(){
    	$lens = Lens::orderBy('id','asc')->paginate(50);
    	$brands = LensBrand::where('category_status','Active')->where('category_parent_id','0')->get();
    	$lens_index = DB::table('lens_index')->where('status','Active')->get();
    	$lens_visions = Vision::get();
    	$lens_color_types = LensColorType::where('category_status','Active')->get();
    	return view('admin.manage-lens',compact('lens','brands','lens_index','lens_visions','lens_color_types'));
    }

    public function add_lens_form(){
        $visions = Vision::where('vision_parent_id','0')->get();
        $lens_color_types = LensColorType::where('category_parent_id','0')->get();
        $lens_brands = LensBrand::where('category_parent_id','0')->get();
    	$lens_index = DB::table('lens_index')->where('status','Active')->get();
    	
    	$lens_toggles = DB::table('lens_toggles')->where('toggle_status','Active')->get();
    	return view('admin.addedit-lens',compact('visions','lens_color_types','lens_brands','lens_index','lens_toggles'));
    }

    public function add_lens(Request $request){
        
        $request->validate([
            'lens_image_name' => 'image|mimes:png,jpg,jpeg',
            'name' => 'required',
            'lens_index' => 'required',
            'price' => 'required'
        ]);

    // Image uploading code
    $lens_image_name="";
    if($request->hasfile('lens_image_name')){

     $lens_image = $request->file('lens_image_name');
     $lens_image_name = rand(100000000,500000000).".".$lens_image->getClientOriginalExtension();

// Comment below lines if you dont'nt want original size image start
            $destinationPath = public_path('/uploaded_files/lens');
            $lens_image->move($destinationPath, $lens_image_name);
       // Comment below lines if you dont'nt want original size image end     

    }

    $lens_slug_name = Str::slug($request->name, '-');


$lens_toggles="";
if(!empty($request->lens_toggles)){
$lens_toggles=implode(',',$request->lens_toggles);    
}


$limit_minus_val=0.00;
if(!empty($request->limit_minus)){
$limit_minus_val=str_replace('-','',$request->limit_minus);
}

$limit_plus_val=0.00;
if(!empty($request->limit_plus)){
$limit_plus_val=str_replace('-','',$request->limit_plus);
}

$sph_minus_val=0.00;
if(!empty($request->min_sph)){
$sph_minus_val=str_replace('-','',$request->min_sph);
}

$sph_plus_val=0.00;
if(!empty($request->max_sph)){
$sph_plus_val=str_replace('-','',$request->max_sph);
}


    // INSERT DATA INTO DB

    $lens = new Lens;
    $lens->lens_image_name = $lens_image_name;
    $lens->name = $request->name;
    $lens->slug_name = $lens_slug_name;
    $lens->lens_index = $request->lens_index;
    $lens->brand = $request->brand;
    $lens->diameter = $request->diameter;
    $lens->vision_id = $request->vision_id;
    $lens->color_type_id = $request->color_type_id;
    $lens->description = $request->description;
    $lens->bifocal_type = $request->bifocal_type;
    $lens->lens_toggles = $lens_toggles;
    $lens->cost = $request->cost;
    $lens->price = $request->price;
    $lens->min_sph = $request->min_sph;
    $lens->max_sph = $request->max_sph;
    $lens->min_cyl = $request->min_cyl;
    $lens->max_cyl = $request->max_cyl;
    $lens->limit_minus = $request->limit_minus;
    $lens->limit_plus = $request->limit_plus;
    $lens->limit_minus_val = $limit_minus_val;
    $lens->limit_plus_val = $limit_plus_val;
    $lens->sph_minus_val = $sph_minus_val;
    $lens->sph_plus_val = $sph_plus_val;
    $lens->min_add = $request->min_add;
    $lens->max_add = $request->max_add;
    
    $lens->save();
    
if(isset($request->tint_id)){      
    $tint_id=$request->tint_id;
    if(COUNT($tint_id)>0){
     for($i=0;$i<COUNT($tint_id);$i++){
      if(!empty($request->tint_price[$i])){     
         DB::table('lens_tints')->insert([
                'lens_id'=>$lens->id,
                'color_type_id'=>$request->color_type_id,
                'tint_id'=>$request->tint_id[$i],
                'tint_price'=>$request->tint_price[$i]
            ]);
     }    
    }
    }      
}    
    
    /* Add Coating */
 if(isset($request->coating_id)){  
    $coating_id=$request->coating_id;
    if(COUNT($coating_id)>0){
     for($i=0;$i<COUNT($coating_id);$i++){
      if($request->coating_cost[$i]!="" && $request->coating_price[$i]!="" ){     
         DB::table('lens_coatings')->insert([
                'lens_id'=>$lens->id,
                'brand_id' => $request->brand,
                'coating_id'=>$request->coating_id[$i],
                'coating_cost'=>$request->coating_cost[$i],
                'coating_price'=>$request->coating_price[$i]
            ]);
     }    
    } 
 }    
 }

   return back()->with('success','Lens Added Successfuly...!');

    }

    public function edit_lens(Request $request){
        $visions = Vision::where('vision_parent_id','0')->get();
        $lens_color_types = LensColorType::where('category_parent_id','0')->get();
    	$edit_lens = Lens::find($request->id);
    	$color_details = LensColorType::where('category_parent_id',$edit_lens->color_type_id)->get();
    	
    	$lens_brands = LensBrand::where('category_parent_id','0')->get();
    	$lens_index = DB::table('lens_index')->where('status','Active')->get();
    	$coatings = LensBrand::where('category_parent_id',$edit_lens->brand)->where('type','coating')->get();
    	
    	$lens_coatings = DB::table('lens_coatings')->where('lens_id',$edit_lens->id)->get();
    	
    	$lens_tints = DB::table('lens_tints')->where('lens_id',$edit_lens->id)->get();
    	
	$lens_toggles = DB::table('lens_toggles')->where('toggle_status','Active')->get();
	
	$edit_toggles = explode(',',$edit_lens->lens_toggles);
  
    $copied_products = Lens::where('id','!=',$request->id)->get();
  
     return view('admin.addedit-lens',compact('edit_lens','visions','lens_color_types','color_details','lens_brands','lens_index','coatings','lens_coatings','lens_tints','lens_toggles','edit_toggles','copied_products'));
    }

     public function update_lens(Request $request){
        
        
    	$lens_id = $request->id;
        $lens = Lens::findOrFail($request->id);
        $request->validate([
            'lens_image_name' => 'image|mimes:png,jpg,jpeg',
            'name' => 'required',
        ]);

    // Image uploading code
    if($request->hasfile('lens_image_name')){

  // Delete Old Image Start
     $image_path = "uploaded_files/lens/".$lens->lens_image_name;
     if(file_exists($image_path)){
         @unlink($image_path);
     }
   // Delete Old Image End

$lens_image = $request->file('lens_image_name');
$lens_image_name = rand(100000000,500000000).".".$lens_image->getClientOriginalExtension();


  // Image Resizing for category start
   /*  $destinationPath = public_path('/uploaded_files/lens');
     $resize_lens_image = Image::make($vision_image->getRealPath());
     $resize_lens_image->resize(326,202, function($constraint){
        $constraint->aspectRatio();
     })->save($destinationPath . '/' . $lens_image_name);*/
  // Image Resizing for Category end

     // Comment below lines if you dont'nt want original size image start
            $destinationPath = public_path('/uploaded_files/lens');
            $lens_image->move($destinationPath, $lens_image_name);
       // Comment below lines if you dont'nt want original size image end     

     $lens->lens_image_name = $lens_image_name;
    }else{
     $lens_image_name = $lens->lens_image_name;	
    }

    $lens_slug_name = Str::slug($request->name, '-');

    // UPDATE DATA INTO DB
    
$lens_toggles="";
if(!empty($request->lens_toggles)){
$lens_toggles=implode(',',$request->lens_toggles);    
}

$group_ids="";

if(!empty($request->category_group_ids)){
$group_ids=implode(',',$request->category_group_ids).','.$request->id;    
for($i=0;$i<COUNT($request->category_group_ids);$i++){
 Lens::where('id',$request->category_group_ids[$i])
    ->update(['category_group_ids'=>$group_ids]);
}

Lens::where('category_copy_id',$request->id)->whereNotIn('id',$request->category_group_ids)->update(['category_group_ids'=>'']);
}else{
 $grp = explode(',',$lens->category_group_ids); 
  if(!empty($grp[0])){
   $group_ids = "";
  }else{    
   $group_ids = $lens->category_group_ids; 
}}

$limit_minus_val=0.00;
if(!empty($request->limit_minus)){
$limit_minus_val=str_replace('-','',$request->limit_minus);
}

$limit_plus_val=0.00;
if(!empty($request->limit_plus)){
$limit_plus_val=str_replace('-','',$request->limit_plus);
}

$sph_minus_val=0.00;
if(!empty($request->min_sph)){
$sph_minus_val=str_replace('-','',$request->min_sph);
}

$sph_plus_val=0.00;
if(!empty($request->max_sph)){
$sph_plus_val=str_replace('-','',$request->max_sph);
}

    $lens->lens_image_name = $lens_image_name;
    $lens->name = $request->name;
    $lens->slug_name = $lens_slug_name;
    $lens->lens_index = $request->lens_index;
    $lens->brand = $request->brand;
    $lens->vision_id = $request->vision_id;
    $lens->category_group_ids = $group_ids;
    $lens->color_type_id = $request->color_type_id;
    $lens->diameter = $request->diameter;
    $lens->description = $request->description;
    $lens->bifocal_type = $request->bifocal_type;
    $lens->lens_toggles = $lens_toggles;
     $lens->cost = $request->cost;
    $lens->price = $request->price;
    $lens->min_sph = $request->min_sph;
    $lens->max_sph = $request->max_sph;
    $lens->min_cyl = $request->min_cyl;
    $lens->max_cyl = $request->max_cyl;
    $lens->limit_minus = $request->limit_minus;
    $lens->limit_plus = $request->limit_plus;
    $lens->limit_minus_val = $limit_minus_val;
    $lens->limit_plus_val = $limit_plus_val;
    $lens->sph_minus_val = $sph_minus_val;
    $lens->sph_plus_val = $sph_plus_val;
    $lens->min_add = $request->min_add;
    $lens->max_add = $request->max_add;
   
 
    // update Lens Tints
    
          if(isset($request->tint_id)){ 
           
       for($i=0;$i<COUNT($request->tint_id);$i++){
           
        if($request->tint_status[$i]=="update"){
           
         if(empty($request->tint_price[$i])){
          DB::table('lens_tints')->where('id',$request->tint_id[$i])->delete();   
         }else{  
           DB::table('lens_tints')->where('id',$request->tint_id[$i])->update([
               'tint_price'=>$request->tint_price[$i]
              ]);
         }  
       } if($request->tint_status[$i]=="add"){
       
        DB::table('lens_tints')->where('lens_id',$lens_id)->where('color_type_id','!=',$request->color_type_id)->delete();
          
         if(!empty($request->tint_price[$i])){
             
          DB::table('lens_tints')->insert([
                'lens_id'=>$lens_id,
                'color_type_id'=>$request->color_type_id,
                'tint_id'=>$request->tint_id[$i],
                'tint_price'=>$request->tint_price[$i]
            ]); 
         }    
       }
    } 
  } 
    
     // update Lens Coating


       if(isset($request->coating_id)){ 
           
       for($i=0;$i<COUNT($request->coating_id);$i++){
           
        if($request->coating_status[$i]=="update"){
           
         if($request->coating_cost[$i]=="" && $request->coating_price[$i]==""){
          DB::table('lens_coatings')->where('id',$request->coating_id[$i])->delete();   
         }else{  
           DB::table('lens_coatings')->where('id',$request->coating_id[$i])->update([
               'coating_price'=>$request->coating_price[$i],
               'coating_cost'=>$request->coating_cost[$i]
              ]);
         }  
       } if($request->coating_status[$i]=="add"){
          
        DB::table('lens_coatings')->where('lens_id',$lens_id)->where('brand_id','!=',$request->brand)->delete();  
        
          
        if($request->coating_cost[$i]!="" && $request->coating_price[$i]!=""){
            
          DB::table('lens_coatings')->insert([
                'lens_id'=>$lens_id,
                'brand_id' => $request->brand,
                'coating_id'=>$request->coating_id[$i],
                'coating_price'=>$request->coating_price[$i],
                'coating_cost'=>$request->coating_cost[$i]
            ]); 
         }    
       }
    } 
  }    
       
     
 
    $lens->update();
    return back()->with('success','Lens Updated Successfuly...!');
    }

    public function remove_lens_image(Request $request){
    	$remove_image = Lens::findOrFail($request->id, ['lens_image_name']);
        $remove_image_path = "uploaded_files/lens/".$remove_image->lens_image_name;
        @unlink($remove_image_path);

        Lens::where('id', $request->id)->update([ 'lens_image_name' => '']);
        return back()->with('success','Image removed successfully...!');
    }

    public function bottom_button_action_lens(Request $request){
    	$lens_ids = $request->lens_ids;
        $request_for = $request->req_for;

    if($request_for =="Delete"){
        for($i=0;$i<COUNT($lens_ids);$i++){
         // Delete Coatings
          DB::table('lens_coatings')->where('lens_id',$lens_ids[$i])->delete();
         // Delete Tints
          DB::table('lens_tints')->where('lens_id',$lens_ids[$i])->delete();
            
			$del_img = Lens::findOrFail($lens_ids[$i], ['lens_image_name']);
			$del_image_path = "uploaded_files/lens/".$del_img->lens_image_name;
			@unlink($del_image_path);
			Lens::where('id',$lens_ids[$i])->delete();
        }
        $sess_msg = "Selected Lens(s) Deleted...";
      }else{
        Lens::whereIn('id', $lens_ids)->update(["category_status" => $request_for]);
        $sess_msg = "Selected Lens(s) Status Updated...";
    }
    return back()->with('success',$sess_msg);
    }
    
    public function get_colors(Request $request){
        $color_details = DB::table("lens_color_types")->where("category_parent_id",$request->cid)->get();
        return view('admin.color-tint-preview',compact('color_details'));
    }
    
    public function get_coating(Request $request){
      $brand_id = $request->brand_id;    
      $coatings = LensBrand::where('category_parent_id',$brand_id)->where('type','coating')->get();
      return view('admin.coating-preview',compact('coatings'));
    }
    
    public function copy_lens(Request $request){
       $copy_id=$request->id;
       $copy = Lens::find($copy_id);
       
    $lens = new Lens;
    $lens->name = $copy->name."1";
    $lens->slug_name = $copy->slug_name."1";
    $lens->lens_index = $copy->lens_index;
    $lens->brand = $copy->brand;
    $lens->diameter = $copy->diameter;
    $lens->vision_id = $copy->vision_id;
    $lens->color_type_id = $copy->color_type_id;
    $lens->description = $copy->description;
    $lens->bifocal_type = $copy->bifocal_type;
    $lens->cost = $copy->cost;
    $lens->price = $copy->price;
    $lens->special_price = $copy->special_price;
    $lens->prism_price = $copy->prism_price;
    $lens->min_sph = $copy->min_sph;
    $lens->sph_minus_val = $copy->sph_minus_val;
    $lens->max_sph = $copy->max_sph;
    $lens->sph_plus_val = $copy->sph_plus_val;
    $lens->min_cyl = $copy->min_cyl;
    $lens->max_cyl = $copy->max_cyl;
    $lens->limit_minus = $copy->limit_minus;
    $lens->limit_minus_val = $copy->limit_minus_val;
    $lens->limit_plus = $copy->limit_plus;
    $lens->limit_plus_val = $copy->limit_plus_val;
    $lens->min_add = $copy->min_add;
    $lens->max_add = $copy->max_add;
    $lens->lens_toggles = $copy->lens_toggles;
   
    $lens->save();
    
    return back()->with('success','copied successfully...!');
    }
    
    public function lens_filter(Request $request){
        $is_filter = "Yes";
        $brand_wise=$request->brand_wise;
        $index_wise=$request->index_wise;
        $vision_wise=$request->vision_wise;
        $lens_color_wise=$request->lens_color_wise;
        
        $lens = Lens::where('name','!=','');
        
        if(!empty($brand_wise)){
          $lens->where('brand',$brand_wise);    
        }
        if(!empty($index_wise)){
          $lens->where('lens_index',$index_wise);    
        }
        if(!empty($vision_wise)){
          $lens->where('vision_id',$vision_wise);    
        }
        if(!empty($lens_color_wise)){
          $lens->where('color_type_id',$lens_color_wise);    
        }
        
        $lens = $lens->paginate(50);
        
    	$brands = LensBrand::where('category_status','Active')->where('category_parent_id','0')->get();
    	$lens_index = DB::table('lens_index')->where('status','Active')->get();
    	$lens_visions = Vision::get();
    	$lens_color_types = LensColorType::where('category_status','Active')->get();
    	return view('admin.manage-lens',compact('lens','brands','lens_index','lens_visions','lens_color_types','brand_wise','index_wise','vision_wise','lens_color_wise','is_filter'));
        
    }
    public function exportLens(){
        return Excel::download(new LensExport, 'lenses.xlsx');
    }
}
