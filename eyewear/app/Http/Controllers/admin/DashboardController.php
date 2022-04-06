<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin_model\Admin;
use App\Admin_model\Category;
use Image;
use Auth;
use DB;
use App\Admin_model\ImageResize;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.index');
    }

    // Show contact details of user
    public function contact_update_show(Request $request){
        $admin_data = Admin::where('admin_type','Admin')->first();
        return view('admin.contact-update',compact('admin_data'));
    }

    // Update contact details of user
    public function contact_update_data(Request $request){
        $admin_contact_update = Admin::where('admin_type','Admin')->first();
        $id=$admin_contact_update->id;
        $request->validate([
            'admin_company_name' => 'required',
            'admin_name' => 'required',
            'admin_email' => 'required|email|unique:admins,email,'.$id,
            'admin_mobile' => 'required|numeric|digits:10',
            'admin_city' => 'required',
            'admin_state' => 'required',
            'admin_country' => 'required',
            'admin_zip_code' => 'required',
            'admin_favicon' => 'image|mimes:jpeg,png,jpg|max:1024',
            'admin_logo' => 'image|mimes:jpeg,png,jpg|max:1024',
            'admin_address' => 'required'
        ]);

        // Upload Favicon
        if($request->hasfile('admin_favicon')){

        // Delete Old File
        $image_path = "uploaded_files/favicon/".$admin_contact_update->admin_favicon;
        $image_path_resize = $admin_contact_update->admin_favicon;
        if(file_exists($image_path)){
            @unlink($image_path);
         }if(file_exists($image_path_resize)){
           @unlink($image_path_resize);
        }

  // Fetch Image Size for FAVICON from Image Resize Table START
    $image_resize_favicon = ImageResize::where('resize_section_name','Favicon')->where('resize_status','Active')->first();
    if(!empty($image_resize_favicon)){
     $resize_width_favicon=$image_resize_favicon->resize_width;
     $resize_height_favicon=$image_resize_favicon->resize_height;
    }else{
     $resize_width_favicon=32;
     $resize_height_favicon=32;
    }
  // Fetch Image Size for FAVICON from Image Resize Table END

        $image = $request->file('admin_favicon');
        $image_name = "favicon".'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('');
        $resize_image = Image::make($image->getRealPath());
        $resize_image->resize($resize_width_favicon, $resize_height_favicon, function($constraint){
        $constraint->aspectRatio();
        })->save($destinationPath . '/' . $image_name);

      // Comment below lines if you dont'nt want original size image
         $destinationPath = public_path('/uploaded_files/favicon');
         $image->move($destinationPath, $image_name);

        $admin_contact_update->admin_favicon = $image_name;

        }

        // Upload Logo
        if($request->hasfile('admin_logo')){

    // Fetch Image Size for LOGO from Image Resize Table START
    $image_resize_logo = ImageResize::where('resize_section_name','Logo')->where('resize_status','Active')->first();
    if(!empty($image_resize_logo)){
     $resize_width_logo=$image_resize_logo->resize_width;
     $resize_height_logo=$image_resize_logo->resize_height;
    }else{
     $resize_width_logo=179;
     $resize_height_logo=100;
    }
  // Fetch Image Size for LOGO from Image Resize Table END

            // Delete Old File
            $image_path = "uploaded_files/logo/".$admin_contact_update->admin_logo;
            $image_path_resize = $admin_contact_update->admin_logo;
            if(file_exists($image_path)){
                @unlink($image_path);
            }if(file_exists($image_path_resize)){
                @unlink($image_path_resize);
            }

            $image = $request->file('admin_logo');
            $image_name = rand(100000,500000).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploaded_files/logo');
            $resize_image = Image::make($image->getRealPath());
            $resize_image->resize($resize_width_logo, $resize_height_logo, function($constraint){
            $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_name);

            // Comment below lines if you dont'nt want original size image
                // $destinationPath = public_path('/admin_assets/images');
                // $image->move($destinationPath, $image_name);

            $admin_contact_update->admin_logo = $image_name;

            }
            
        $is_prism="No";
        if(isset($request->is_prism)){
          $is_prism="Yes";    
        }
        $admin_contact_update->admin_company_name = $request->admin_company_name;
        $admin_contact_update->is_prism = $is_prism;
        $admin_contact_update->admin_name = $request->admin_name;
        $admin_contact_update->email = $request->admin_email;
        $admin_contact_update->prism_price = $request->prism_price;
        $admin_contact_update->available_with_lens_desc = $request->available_with_lens_desc;
        $admin_contact_update->admin_alternate_email = $request->admin_alternate_email;
        $admin_contact_update->admin_return_info = $request->admin_return_info;
        $admin_contact_update->admin_phone = $request->admin_phone;
        $admin_contact_update->admin_fax = $request->admin_fax;
        $admin_contact_update->admin_website_url = $request->admin_website_url;
        $admin_contact_update->admin_mobile = $request->admin_mobile;
        $admin_contact_update->admin_city = $request->admin_city;
        $admin_contact_update->admin_state = $request->admin_state;
        $admin_contact_update->admin_country = $request->admin_country;
        $admin_contact_update->admin_zip_code = $request->admin_zip_code;
        $admin_contact_update->admin_address = $request->admin_address;
        $admin_contact_update->admin_map = $request->admin_map;
        $admin_contact_update->admin_prescription_desc = $request->admin_prescription_desc;
        $admin_contact_update->admin_prescription_pd_desc = $request->admin_prescription_pd_desc;
        $admin_contact_update->admin_whatsapp_number = $request->admin_whatsapp_number;
        $admin_contact_update->shipping_charges_domestic = $request->shipping_charges_domestic;
        $admin_contact_update->shipping_charges_international = $request->shipping_charges_international;
        $admin_contact_update->update();

        return back()->with('success','Contact detail updated successfully...!');
    }

    // Function for Removing Favicon
    public function contact_update_favicon_remove(Request $request){
        $admin_favicon_remove = Admin::where('admin_type','Admin')->first();
        $image_path_original = "uploaded_files/favicon/".$admin_favicon_remove->admin_favicon;
        $image_path_resize = $admin_favicon_remove->admin_favicon;
        if(file_exists($image_path_original)){
            @unlink($image_path_original);
        }if(file_exists($image_path_resize)){
            @unlink($image_path_resize);
        }

        $admin_favicon_remove->admin_favicon="";
        $admin_favicon_remove->update();

        return redirect("/admin/contact-update")->with('success','Favicon removed successfully...!');
    }


        // Function for Removing Logo
        public function contact_update_logo_remove(Request $request){
            $admin_logo_remove = Admin::where('admin_type','Admin')->first();
            $image_path_original = "uploaded_files/logo/".$admin_logo_remove->admin_logo;
            if(file_exists($image_path_original)){
                @unlink($image_path_original);
            }

            $admin_logo_remove->admin_logo="";
            $admin_logo_remove->update();

            return redirect("/admin/contact-update")->with('success','Logo removed successfully...!');
        }

    // Function for change password Form

    public function change_password_form(Request $request){
       // Fetch logged in user id
       // $id=Auth::user()->id;
        return view('admin.change-password');
    }

       // Function for change password

    public function change_password(Request $request){
        // Fetch logged in user id
           $id=Auth::user()->id;
           $pass=Auth::user()->password;

        $request->validate([
            'old_password' => ['required','string','min:8',
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'new_password' =>  ['required','string','min:8',
            'regex:/[a-z]/',      // must contain at least one lowercase letter
            'regex:/[A-Z]/',      // must contain at least one uppercase letter
            'regex:/[0-9]/',      // must contain at least one digit
            'regex:/[@$!%*#?&]/', // must contain a special character
        ],
            'confirm_password' =>  ['required','string','min:8',
            'regex:/[a-z]/',      // must contain at least one lowercase letter
            'regex:/[A-Z]/',      // must contain at least one uppercase letter
            'regex:/[0-9]/',      // must contain at least one digit
            'regex:/[@$!%*#?&]/', // must contain a special character
            'same:new_password'
        ]
        ]);

        if(!Hash::check($request->old_password,$pass)){
            return redirect('/admin/change-password')->with('pass_err','Old Password is Invalid');
        }else{
            Admin::where("id",$id)->update(['password' => Hash::make($request->new_password)]);
            return redirect('/admin/change-password')->with('success','Password updated successfully...!');
        }

     }

     // Function for Social media links form

     public function social_media_links_form(Request $request){
        $social_media_links = Admin::where('admin_type','Admin')->first();
        return view('admin.manage-social-links',compact('social_media_links'));

     }

     // Function for Social media links update

     public function social_media_links(Request $request){

    // Validate Inputs
        $request->validate([
            'admin_facebook_link' => 'nullable|url',
            'admin_twitter_link' => 'nullable|url',
            'admin_linkedin_link' => 'nullable|url',
            'admin_instagram_link' => 'nullable|url',
            'admin_pinterest_link' => 'nullable|url',
            'admin_youtube_link' => 'nullable|url',
            'admin_tumblr_link' => 'nullable|url',
            'admin_vimeo_link' => 'nullable|url'
        ],[ 'admin_facebook_link.url' => 'Facebook link URL format is invalid',
            'admin_twitter_link.url' => 'Twitter link URL format is invalid',
            'admin_linkedin_link.url' => 'Linkedin link URL format is invalid',
            'admin_instagram_link.url' => 'Instagram link URL format is invalid',
            'admin_pinterest_link.url' => 'Pinterest link URL format is invalid',
            'admin_youtube_link.url' => 'Youtube link URL format is invalid',
            'admin_tumblr_link.url' => 'Tumblr link URL format is invalid',
            'admin_vimeo_link.url' => 'Vimeo Link URL format is invalid'
        ]);

    // Insert Data

    Admin::where('admin_type','Admin')->update([
        'admin_facebook_link' => $request->admin_facebook_link,
        'admin_twitter_link' => $request->admin_twitter_link,
        'admin_linkedin_link' => $request->admin_linkedin_link,
        'admin_instagram_link' => $request->admin_instagram_link,
        'admin_pinterest_link' => $request->admin_pinterest_link,
        'admin_youtube_link' => $request->admin_youtube_link,
        'admin_tumblr_link' => $request->admin_tumblr_link,
        'admin_vimeo_link' => $request->admin_vimeo_link
    ]);

    return redirect('/admin/manage-social-media-links')->with('success','Social media links updated successfully...!');

     }

     public function admin_feature(){
         $is_category_exist = Category::count();
         return view('admin.manage-feature',compact('is_category_exist'));
     }

     public function update_admin_feature(Request $request){
        $admin_feature = Admin::where('admin_type','Admin')->first();
        $admin_feature->admin_category_level = $request->admin_category_level;
        $admin_feature->admin_cat_thumb = $request->admin_cat_thumb;
        $admin_feature->admin_subcat_thumb = $request->admin_subcat_thumb;
        $admin_feature->admin_finalcat_thumb = $request->admin_finalcat_thumb;
        $admin_feature->admin_product_thumb = $request->admin_product_thumb;
        $admin_feature->admin_search_option = $request->admin_search_option;
        $admin_feature->update();
    return redirect('/admin/manage-feature')->with('success','Admin features updated successfully...!');
     }

     public function update_site_feature(Request $request){
        $site_feature = Admin::where('admin_type','Admin')->first();
        $site_feature->admin_backup_option = $request->admin_backup_option;
        $site_feature->admin_backup_schedule = $request->admin_backup_schedule;
        $site_feature->admin_sitemap_option = $request->admin_sitemap_option;
        $site_feature->admin_sitemap_schedule = $request->admin_sitemap_schedule;
        $site_feature->admin_meta_robots = $request->admin_meta_robots;
        $site_feature->update();
    return redirect('/admin/manage-feature')->with('success','Site features updated successfully...!');
     }


     public function manage_chief(Request $request){
        $edit_chief = Chief::first();
        return view('admin.manage-chief',compact('edit_chief'));
     }

     public function add_edit_chief(Request $request){
        $request->validate([
            'chief_name' => 'required',
            'chief_email' => 'required',
            'chief_mobile' => 'required|min:10',
            'chief_age' => 'required|numeric'
        ]);

$chief_exist = Chief::count();

if($chief_exist==0){
$chief_image="";
if($request->hasfile('chief_image')){

$chief_image_data = $request->file('chief_image');
$chief_image = rand(100000000,500000000).".".$chief_image_data->getClientOriginalExtension();

 $destinationPath = public_path('/chief');
 $resize_cat_image = Image::make($chief_image_data->getRealPath());
 $resize_cat_image->resize(330,415, function($constraint){
    $constraint->aspectRatio();
 })->save($destinationPath . '/' . $chief_image);
}

Chief::create([
    'chief_image' => $chief_image,
    'chief_name' => $request->chief_name,
    'chief_email' => $request->chief_email,
    'chief_mobile' => $request->chief_mobile,
    'chief_age' => $request->chief_age
]);

}else{
$chief_image="";    
$chief_upd = Chief::first();    
if($request->hasfile('chief_image')){

$image_path = "chief/".$chief_upd->chief_image;
if(file_exists($image_path)){ @unlink($image_path); }

$chief_image_data = $request->file('chief_image');
$chief_image = rand(100000000,500000000).".".$chief_image_data->getClientOriginalExtension();

 $destinationPath = public_path('/chief');
 $resize_cat_image = Image::make($chief_image_data->getRealPath());
 $resize_cat_image->resize(330,415, function($constraint){
    $constraint->aspectRatio();
 })->save($destinationPath . '/' . $chief_image);
}else{ $chief_image = $chief_upd->chief_image; }

$chief_upd->chief_image = $chief_image;
$chief_upd->chief_name = $request->chief_name;
$chief_upd->chief_email = $request->chief_email;
$chief_upd->chief_mobile = $request->chief_mobile;
$chief_upd->chief_age = $request->chief_age;

$chief_upd->update();
}

return back()->with('success','Chief Updated successfully...!');

     }

     public function rating_list(){
        $ratings = DB::table('ratings')->paginate(10);
        return view('admin.manage-rating',compact('ratings'));
     }

     public function bottom_button_action_rating(Request $request){
        $rating_ids = $request->rating_ids;
        $request_for = $request->req_for;

        if($request_for =="Delete"){
            DB::table('ratings')->whereIn('id', $rating_ids)->delete();
            $sess_msg = "Selected reviews deleted...";
        }else{
            DB::table('ratings')->whereIn('id', $rating_ids)->update(["rating_status" => $request_for]);
            $sess_msg = "Selected reviews Status Updated...";
        }
    return back()->with('success',$sess_msg);
     }

    public function currency_list(){
        $currencies = DB::table('currencies')->paginate(20);
        return view('admin.manage-currency',compact('currencies'));
    }
    
    public function add_currency_form(){
        $countries = DB::table('countries')->where('name','!=','India')->get();
        return view('admin.addedit-currency',compact('countries'));
    }
    
    public function add_currency(Request $request){
        $request->validate([
                'country_name'=>'required',
                'currency_symbol'=>'required',
                'exchange_rate'=>'required']);
        
        DB::table('currencies')->insert([
                'country_name'=>$request->country_name,
                'currency_symbol'=>$request->currency_symbol,
                'exchange_rate'=>$request->exchange_rate,
                'status'=>$request->status]);
        
        return back()->with('success','Currency added successfully...!');
    }
    
    public function edit_currency(Request $request){
        $edit_currency = DB::table('currencies')->where('id',$request->id)->first();
        $countries = DB::table('countries')->where('name','!=','India')->get();
        return view('admin.addedit-currency',compact('edit_currency','countries'));
    }
    
    public function update_currency(Request $request){
        $request->validate([
                'country_name'=>'required',
                'currency_symbol'=>'required',
                'exchange_rate'=>'required']);
        
        DB::table('currencies')->where('id',$request->id)->update([
                'country_name'=>$request->country_name,
                'currency_symbol'=>$request->currency_symbol,
                'exchange_rate'=>$request->exchange_rate,
                'status'=>$request->status]);
        
        return back()->with('success','Currency updated successfully...!');
    }
    
    public function bottom_button_action_currency(Request $request){
        $currency_ids = $request->currency_ids;
        $request_for = $request->req_for;
        if($request_for =="Delete"){
            DB::table('currencies')->whereIn('id', $currency_ids)->delete();
            $sess_msg = "Selected Currency(s) Deleted...";
        }else{
        DB::table('currencies')->whereIn('id', $currency_ids)->update(["status" => $request_for]);
        $sess_msg = "Selected Currency(s) Status Updated...";
        }
        return back()->with('success',$sess_msg);
 }
 
  public function uploaded_prescription(Request $request){
      $prescriptions = DB::table('prescription')->get();
      return view('admin.uploaded-prescription',compact('prescriptions'));
  }
  
  public function delete_prescription(Request $request){
      $pres = DB::table('prescription')->where('id',$request->id)->first();
      $del_pres = "uploaded_files/prescription/".$pres->prescription;
      @unlink($del_pres);
      DB::table('prescription')->where('id',$request->id)->delete();
      return back()->with('success','Prescription deleted...!');
  }

      public function lens_replace(){
         $lens_replaces = DB::table('lens_replaces')->get();
         return view('admin.lens-replace',compact('lens_replaces'));
     }
 
     public function add_lens_replace_form(){
         return view('admin.addedit-lens-replace');
     }
     
     public function add_lens_replace(Request $request){
      $count = DB::table('lens_replaces')->count();
      if($count<3){
         $request->validate([
            'replace_image_name' => 'required|image|mimes:jpeg,png,jpg',
            'replace_text' => 'required',
            'replace_link' => 'required'
            
        ],[ 'replace_image_name.required' => 'Upload an image',
            'replace_image_name.mimes' => 'Image must be a file of type: jpeg, png, jpg.',
            'replace_image_name.image' => 'File must be an image.',
            'replace_text.required' => 'Replace Text is required.',
            'replace_link.required' => 'Replace Link is required.'
          ] ); 
          
        if($request->hasfile('replace_image_name')){
        
        $replace = $request->file('replace_image_name');
        $replace_image = rand(100000,500000).".".$replace->getClientOriginalExtension();
        $destinationPath = public_path('/uploaded_files');
        $replace->move($destinationPath, $replace_image);
        
        }
        
        DB::table('lens_replaces')->insert([
          "replace_image_name"=> $replace_image,
          "replace_text" => $request->replace_text,
          "replace_link" => $request->replace_link,
            ]);
         return back()->with('success','Lens Replace added successfully...!');
      }else{
          return back();
      }
     }
     
     public function edit_lens_replace(Request $request){
         $edit_lens_replace = DB::table('lens_replaces')->where('id',$request->id)->first();
         return view('admin.addedit-lens-replace',compact('edit_lens_replace'));
     }
     
     public function update_lens_replace(Request $request){
          $request->validate([
            'replace_image_name' => 'image|mimes:jpeg,png,jpg',
            'replace_text' => 'required',
            'replace_link' => 'required'
            
        ],[ 'replace_image_name.required' => 'Upload an image',
            'replace_image_name.mimes' => 'Image must be a file of type: jpeg, png, jpg.',
            'replace_image_name.image' => 'File must be an image.',
            'replace_text.required' => 'Replace Text is required.',
            'replace_link.required' => 'Replace Link is required.'
          ] );
          
        $replace_data = DB::table('lens_replaces')->where('id',$request->id)->first();  
        $replace_image_name = $replace_data->replace_image_name;
          // Image uploading code
        if($request->hasfile('replace_image_name')){

      // Delete Old Image Start
         $image_path = "uploaded_files/".$replace_data->replace_image_name;
         if(file_exists($image_path)){@unlink($image_path);}
       // Delete Old Image End

$replace_image = $request->file('replace_image_name');
$replace_image_name = rand(100000000,500000000).".".$replace_image->getClientOriginalExtension();


  // Comment below lines if you dont'nt want original size image start
    $destinationPath = public_path('/uploaded_files');
    $replace_image->move($destinationPath, $replace_image_name);
  // Comment below lines if you dont'nt want original size image end

    }
    
    DB::table('lens_replaces')->where('id',$request->id)->update([
        'replace_image_name'=>$replace_image_name,
        'replace_text'=>$request->replace_text,
        'replace_link'=>$request->replace_link
       ]);
       
    return back()->with('success','Lens Replace updated successfully...!');      
     }
     
     public function bottom_button_action_replace(Request $request){
        $lens_replace_ids = $request->lens_replace_ids;
        $request_for = $request->req_for;
        if($request_for =="Delete"){
        for($i=0;$i<COUNT($lens_replace_ids);$i++){
          $del_data = DB::table('lens_replaces')->where('id',$lens_replace_ids[$i])->first();
           $path = "uploaded_files/".$del_data->replace_image_name;
           @unlink($path);
        }
        DB::table('lens_replaces')->whereIn('id', $lens_replace_ids)->delete();
        $sess_msg = "Selected Lens replace(s) Deleted...";
        }
        return back()->with('success',$sess_msg);
     }
    //  ================================= brands 
public function frontend_brands(){
        $data['brand_img'] = DB::table('newbrands')->orderBy('name')->get();
    return view('admin.frontend_brands',$data);
}

public function frontend_add_brands(){
    
    return view('admin.frontend_brand_add');
}
public function frontend_store_brands(Request $request){
    
    $image =$request->file('image');
   $name_gen= hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
   Image::make($image)->save('uploaded_files/brand/'.$name_gen);
//   ->resize(1000,720)  //can use this  for resize 
   $last_img='uploaded_files/brand/'.$name_gen;

    DB::table('newbrands')->insert([
'name'=>$request->name,
'url'=>$request->url,
'image'=>$last_img,
'status'=>'active',
'created_at'=>Carbon::now()

]);

return redirect()->route('manage.brands')->with('success','Brands inserted successfully...!');
}
// ======================= Edit brand ======================
public function frontend_edit_brands(Request $request, $id){
    
     $data = DB::table('newbrands')->where('id',$id)->first();

    return view('admin.frontend_brand_edit', compact('data'));
}

// ================== update ====================

public function frontend_update_brands(Request $request, $id){
    $old_img = $request->old_image;
    
    $image =$request->file('image');
if($image){    
    unlink($old_img);
   $name_gen= hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
   Image::make($image)->save('uploaded_files/brand/'.$name_gen);
//   ->resize(1000,720)  //can use this  for resize 
   $last_img='uploaded_files/brand/'.$name_gen;

    DB::table('newbrands')->where('id',$id)->update([
'image'=>$last_img,
'updated_at'=>Carbon::now()
]);


return redirect()->route('manage.brands')->with('success','Brands Image updated successfully...!');
}
// ============================== if not image =============================
else{
    
    DB::table('newbrands')->where('id',$id)->update([
'name'=>$request->name,
'url'=>$request->url,
'status'=>'active',
'updated_at'=>Carbon::now()

]);


return redirect()->route('manage.brands')->with('success','Brands Name updated successfully...!');
    
}

    
}
// ======================= active inactive ===================


public function frontend_inactive_brands(Request $request, $id){

    DB::table('newbrands')->where('id',$id)->update([
    'status'=>'inactive',
'created_at'=>Carbon::now()

]);

return redirect()->route('manage.brands')->with('success','Brands inactive successfully...!');
    
    
}


// ===================== Detete ============================
public function frontend_delete_brands($id){
  $data = DB::table('newbrands')->find($id);
    $old_img = $data->image;
    unlink($old_img);
 $data = DB::table('newbrands')->where('id',$id)->delete();
 
return redirect()->route('manage.brands')->with('success','Brands Deleted successfully...!');
 
    
    
}

// ======================== active inactive ==================
}