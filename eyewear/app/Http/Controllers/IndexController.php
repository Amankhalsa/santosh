<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin_model\Slider;
use App\Admin_model\manage_page;
use App\Admin_model\Category;
use App\Admin_model\Enquiry;
use App\Admin_model\Admin;
use App\Admin_model\OurClient;
use App\Admin_model\Lens;

use Mail;

class IndexController extends Controller
{
    protected $sender_name;
    protected $sender_email;
    protected $recevier_name;
    protected $recevier_email;
    protected $admin_data;

    public function __construct(){
        $this->admin_data = Admin::where('admin_type','Admin')->first();
    }



public function frontendview(){
    return view('frontend/index');
}
    public function index(){
    $ip = \Request::ip();
 	//$ip = '1.32.239.255';
 	$location = \Location::get($ip);
 	$ip_country=$location->countryName;    
        
    // Get Page Meta
     $meta_tag = manage_page::where('page_status','Active')->where('id','1')->first();

    // Get Brands
     $brands = Category::where('category_status','Active')->where('category_parent_id','0')->where('category_for_home','Yes')->get(); 

    // Get EyeGlasses
     $eyeglasses = Category::where('category_frame','Eyeglasses')->where('category_for','=','Woman')->where('category_type','Product')->where('category_status','Active')->limit(6)->where('category_qty','>',0)->where('category_is_top','Yes')->get();
 
    $sunglasses = Category::where('category_frame','Sunglasses')->where('category_for','=','Woman')->where('category_type','Product')->where('category_status','Active')->limit(6)->where('category_qty','>',0)->where('category_is_top','Yes')->get();
    
    // men
     $male_eyeglasses = Category::where('category_frame','Eyeglasses')->where('category_for','=','Gentle Man')->where('category_type','Product')->where('category_status','Active')->limit(6)->where('category_qty','>',0)->where('category_is_top','Yes')->get();
//  male_sunglasses
    $male_sunglasses = Category::where('category_frame','Sunglasses')->where('category_for','=','Gentle Man')->where('category_type','Product')->where('category_status','Active')->limit(6)->where('category_qty','>',0)->where('category_is_top','Yes')->get();
    
    // unisex_eyeglasses
     $unisex_eyeglasses = Category::where('category_frame','Eyeglasses')->where('category_for','=','Unisex')->where('category_type','Product')->where('category_status','Active')->limit(6)->where('category_qty','>',0)->where('category_is_top','Yes')->get();
// unisex_sunglasses
   $unisex_sunglasses = Category::where('category_frame','Eyeglasses')->where('category_for','=','Unisex')->where('category_type','Product')->where('category_status','Active')->limit(6)->where('category_qty','>',0)->where('category_is_top','Yes')->get();

     // Get SunGlasses
  

     $frames = Category::where('category_status','Active')->where('category_type','Product')->latest()->get();  

    $sliders = Slider::where('slider_status','Active')->get();
 	
    return view('index',compact('meta_tag','brands','eyeglasses','sunglasses','unisex_eyeglasses','male_eyeglasses','male_sunglasses','unisex_sunglasses','frames','ip_country','sliders'));
    }

    public function header_search(Request $request){
        $ip = \Request::ip();
 	//$ip = '1.32.239.255';
 	$location = \Location::get($ip);
 	$ip_country=$location->countryName; 
 	
        $search_keyword = $request->search_keyword;
        $search_result = Category::where('category_type','product')->where('category_status','Active')->where('category_qty','>',0)->where('category_name','LIKE','%'.$search_keyword.'%')->orWhere('category_sku_code','LIKE','%'.$search_keyword.'%')->paginate(30);
        
       
       /*$arr=json_encode($arr);
       $search_result=json_decode($arr,true);*/
       
       return view('search-result',compact('search_result','search_keyword','ip_country'));
    }


}
