<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Admin_model\Category;
use App\Admin_model\Blog;
use App\Admin_model\manage_page;
use App\Admin_model\Enquiry;
use App\Admin_model\OurTeam;
use App\Admin_model\OurClient;
use App\Admin_model\Wishlist;
use App\Admin_model\Lens;
use App\Admin_model\ProductColor;
use App\Admin_model\Admin;
use Mail;
use Validator;
use Redirect;
use Response;



class PageController extends Controller
{
    protected $gender_filter = "";
    protected $shape_filter = "";
    protected $frame_filter = "";
    protected $material_filter = "";
    protected $brand_filter = "";
    protected $color_filter = "";
    protected $ip_country;
    protected $admin_data;



    public function __construct()
    {
       $ip = \Request::ip();

        //$ip = '1.32.239.255';

        $location = \Location::get($ip);

        $this->ip_country = $location->countryName;

        //$this->ip_country="India";

    }

// ============================ testing phase =========================

//     public function testing_phase()
//     {
//     $ip = \Request::ip();
//  	//$ip = '1.32.239.255';
//  	$location = \Location::get($ip);
//  	$ip_country=$location->countryName;    
//     // Get Page Meta
//      $meta_tag = manage_page::where('page_status','Active')->where('id','1')->first();
//     // Get Brands
//     $brands = Category::where('category_status','Active')->where('category_parent_id','0')->where('category_for_home','Yes')->get(); 
//      // Get SunGlasses
//      $sunglasses = Category::where('category_frame','Sunglasses')->where('category_type','Product')->where('category_status','Active')->limit(30)->where('category_qty','>',0)->where('category_is_top','Yes')->get();
//      $frames = Category::where('category_status','Active')->where('category_type','Product')->latest()->get();  
//     return view('amantest.index',compact('meta_tag','brands','sunglasses','frames','ip_country'));

//     }


// =================== Ajax ====================
    public function getArticles(Request $request)
    {
        // $results = Category::orderBy('id')->where('category_type', 'Product')->where('category_status', 'Active')->paginate(3);
        // $products = '';
        // if ($request->ajax()) {
        //     foreach ($results as $key => $result) {
        //         $products .= '<div class="col-md-6 col-xl-4">
        //         <div class="cardStyle1">
        //           <span class="discountCol">20% off</span>
        //           <div class="productImg">
        //           <div class="imgCol"><img src="https://luxuryeyewear.in/uploaded_files/product/463540063.jpeg" alt="...">
        //             </div>
        //             <div class="color_builts">
        //               <ul>
        //                 <li>
        //                   <a href="javascript:void(0)"  class="colorCol actColor"><img src="{{asset("assets/images/black.jpg")}}" alt="..."></a>
        //                 </li>
        //                 <li>
        //                   <a href="javascript:void(0)"  class="colorCol"><img src="{{asset("assets/images/brown.jpg")}}" alt="..."></a>
        //                 </li>
        //               </ul>
        //             </div>
        //           </div>
        //           <div class="contentCol">
        //             <h4 class="brandCol">' . $result->category_name . '</h4>
        //             <p>' . $result->category_name . '</p>
        //             <span class="priceCol">₹8900 </span>
        //             <div class="row gx-2">
        //               <div class="col-auto">
        //                 <a href="javascript:void(0)" class="btn btnDark w-100 addCartBtn">ADD TO CART</a>
        //               </div>
        //               <div class="col">
        //                 <a href="javascript:void(0)" class="btn btnDark_outline w-100">ADD TO WISHLIST</a>
        //               </div>
        //             </div>
        //           </div>
        //         </div>
        //       </div>';
        //     }
        //     return $products;
        // }
        // return view('amantest.index');
    }

// ============================ testing phase =========================

    public function test()
    {
        return view('test');
    }

// ================ eyeglasses ===============
    public function eyeglasses()
    {

        $ip = \Request::ip();
        //$ip = '1.32.239.255';
        $location = \Location::get($ip);
        $ip_country = $location->countryName;
        // Get Page Meta
        $meta_tag = manage_page::where('page_status', 'Active')->where('id', '1')->first();
        // Get Brands-
        $brands = Category::where('category_status', 'Active')->where('category_parent_id', '0')->where('category_for_home', 'Yes')->get();
        // Get SunGlasses
        $sunglasses = Category::where('category_frame', 'Eyeglasses')->where('category_type', 'Product')->where('category_status', 'Active')->where('category_qty', '>', 0)->get();
        $frames = Category::where('category_status', 'Active')->where('category_type', 'Product')->latest()->get();
        return view('eye_glasses_new', compact('meta_tag', 'brands', 'sunglasses', 'frames', 'ip_country'));

    }

// ================ eyeglasses ===============

// =============== sunglasses ===================

    public function sunglasses(Request $request)
    {
        $ip = \Request::ip();
        //$ip = '1.32.239.255';
        $location = \Location::get($ip);
        $ip_country = $location->countryName;
        // Get Page Meta
        $meta_tag = manage_page::where('page_status', 'Active')->where('id', '1')->first();
        // Get Brands
        $brands = Category::where('category_status', 'Active')->where('category_parent_id', '0')->where('category_for_home', 'Yes')->get();
        // Get SunGlasses
        $sunglasses_count = Category::where('category_frame', 'Sunglasses')->where('category_type', 'Product')->where('category_status', 'Active')->where('category_qty', '>', 0)->count();
        $sunglasses = Category::where('category_frame', 'Sunglasses')->where('category_type', 'Product')->where('category_status', 'Active')->where('category_qty', '>', 0)->get();
        $frames = Category::where('category_status', 'Active')->where('category_type', 'Product')->latest()->get();
        if ($request->page) {
            $sunglasses = Category::where('category_frame', 'Sunglasses')->where('category_type', 'Product')->where('category_status', 'Active')->where('category_qty', '>', 0)->get()->skip($request->page)->take(9);
            return view('eye_glasses_ajax', compact('meta_tag', 'brands', 'sunglasses', 'frames', 'ip_country', 'sunglasses_count'));

        }

        return view('sun_glasses_new', compact('meta_tag', 'brands', 'sunglasses', 'frames', 'ip_country'));

    }

// ============= sunglasses =================



// =============== brands ===================

    public function brand_page()
    {
        $data['brand_img'] = DB::table('newbrands')->where('status', 'Active')->orderBy('name')->get();

        return view('brands_page_new', $data);
    }

// ============= brands =================



    public function about()
    {
        // Get Page Meta

        $meta_tag = manage_page::where('page_status', 'Active')->where('page_link', 'about-us')->first();
        return view('about-us', compact('meta_tag'));

    }
    public function contact()

    {

        // Get Page Meta

        $meta_tag = manage_page::where('page_status', 'Active')->where('page_link', 'contact-us')->first();



        return view('contact-us', compact('meta_tag'));

    }



    public function faq()

    {

        // Get Page Meta

        $meta_tag = manage_page::where('page_status', 'Active')->where('page_link', 'faq')->first();

        return view('faq', compact('meta_tag'));

    }



    public function return_and_exchange()

    {

        // Get Page Meta

        $meta_tag = manage_page::where('page_status', 'Active')->where('page_link', 'return-and-exchange')->first();

        return view('return-and-exchange', compact('meta_tag'));

    }





    public function terms_and_conditions()

    {

        // Get Page Meta

        $meta_tag = manage_page::where('page_status', 'Active')->where('page_link', 'terms-and-conditions')->first();

        return view('terms-and-conditions', compact('meta_tag'));

    }



    public function payment_options()

    {

        // Get Page Meta

        $meta_tag = manage_page::where('page_status', 'Active')->where('page_link', 'payment-options')->first();

        return view('payment-options', compact('meta_tag'));

    }



    public function track_order()

    {

        // Get Page Meta

        $meta_tag = manage_page::where('page_status', 'Active')->where('page_link', 'track-order')->first();

        return view('track-order', compact('meta_tag'));

    }



    public function find_a_store()

    {

        // Get Page Meta

        $meta_tag = manage_page::where('page_status', 'Active')->where('page_link', 'find-a-store')->first();

        return view('find-a-store', compact('meta_tag'));

    }



    public function cancellation()

    {

        // Get Page Meta

        $meta_tag = manage_page::where('page_status', 'Active')->where('page_link', 'cancellation')->first();

        return view('cancellation', compact('meta_tag'));

    }



    public function shipping()

    {

        // Get Page Meta

        $meta_tag = manage_page::where('page_status', 'Active')->where('page_link', 'shipping')->first();

        return view('shipping', compact('meta_tag'));

    }



    public function privacy_policy()

    {

        // Get Page Meta

        $meta_tag = manage_page::where('page_status', 'Active')->where('page_link', 'privacy-policy')->first();

        return view('privacy-policy', compact('meta_tag'));

    }





    public function blog()

    {

        // Get Page Meta

        $meta_tag = manage_page::where('page_status', 'Active')->where('page_link', 'blog')->first();

        // Get Blogs

        $blogs = Blog::where('blog_status', 'Active')->get();



        return view('blog', compact('meta_tag', 'blogs'));

    }



    public function blog_detail(Request $request)

    {

        // Get Blog

        $blog = Blog::where('blog_slug_name', $request->blog_url)->first();

        return view('blog-detail', compact('blog'));

    }





    public function contact_form_submit(Request $request)

    {

        $this->admin_data = Admin::where('admin_type', 'Admin')->first();



        $name = $request->name;

        $email = $request->email;

        $phone = $request->mobile;

        $source = $request->source;

        $message = $request->message;



        Enquiry::create([

            'enq_name' => $name,

            'enq_email' => $email,

            'enq_mobile' => $phone,

            'enq_source' => $source,

            'enq_msg' => $message

        ]);



        $data['name'] = $name;

        $data['email'] = $email;

        $data['phone'] = $phone;

        $data['msg'] = $message;



        Mail::send('email_template.contact-mail', $data, function ($message) use ($email, $name) {

            $message->to($email, $name)

                ->subject('Enquiry received From ' . $this->admin_data->email)

                ->from($this->admin_data->email, $this->admin_data->admin_company_name);

        });



        return back()->with('form_success', 'Form Submitted successfully, we will contact you soon!');



    }



// ============================== main_cat start =======================

    public function main_cat(Request $request)
    {
        $ip_country = $this->ip_country;

        /*$frame_types = array();*/
        $main_category = Category::where('category_slug_name', $request->main_cat)->first();

        $all_brands = Category::where('category_parent_id', '0')->orderBy('category_name')->where('category_slug_name', '!=', $request->main_cat)->where('category_status', 'Active')->get();

        $arr = Category::where('category_status', 'Active')->where('category_parent_id', $main_category->id)->where('category_qty', '>', 0)->paginate(100);

        $top_products = Category::where('category_status', 'Active')->where('category_is_top', 'Yes')->where('category_qty', '>', 0)->get();

        $frame_types = DB::table('product_attributes')->where('type', '!=', '')->get();

        $frame_shapes = DB::table('product_attributes')->where('shape', '!=', '')->get();

        $frame_materials = DB::table('product_attributes')->where('material', '!=', '')->get();

        $frame_colors = ProductColor::all();
        $data = $arr;
        $arr = json_encode($arr);
        $products = json_decode($arr, true);
        return view('category', compact('main_category', 'products', 'all_brands', 'top_products', 'frame_types', 'frame_shapes', 'frame_materials', 'data', 'ip_country', 'frame_colors'));

    }

// ============================== main_cat end =======================

    public function gentle_man()
    {
        $ip_country = $this->ip_country;
        $product_for = "Gentle Man";
        $arr = Category::where('category_for', '!=', 'Woman')->where('category_qty', '>', 0)->where('category_status', 'Active')->get();
        $all_brands = Category::where('category_parent_id', '0')->where('category_status', 'Active')->get();
        $top_products = Category::where('category_status', 'Active')->where('category_is_top', 'Yes')->where('category_qty', '>', 0)->get();
        $frame_types = DB::table('product_attributes')->where('type', '!=', '')->get();
        $frame_shapes = DB::table('product_attributes')->where('shape', '!=', '')->get();
        $frame_materials = DB::table('product_attributes')->where('material', '!=', '')->get();
        $frame_colors = ProductColor::all();
        $data = $arr;
        $arr = json_encode($arr);
        $products = json_decode($arr, true);
       return view('product-for', compact('products', 'product_for', 'all_brands', 'top_products', 'data', 'frame_types', 'frame_types', 'frame_shapes', 'frame_materials', 'ip_country', 'frame_colors'));

    }



    public function woman()
    {
        $ip_country = $this->ip_country;
        $product_for = "Woman";
        $arr = Category::where('category_for', '!=', 'Gentle Man')->where('category_qty', '>', 0)->where('category_status', 'Active')->get();
        $all_brands = Category::where('category_parent_id', '0')->where('category_status', 'Active')->get();
        $top_products = Category::where('category_status', 'Active')->where('category_is_top', 'Yes')->where('category_qty', '>', 0)->get();
        $frame_types = DB::table('product_attributes')->where('type', '!=', '')->get();
        $frame_shapes = DB::table('product_attributes')->where('shape', '!=', '')->get();
        $frame_materials = DB::table('product_attributes')->where('material', '!=', '')->get();
        $frame_colors = ProductColor::all();
        $data = $arr;
        $arr = json_encode($arr);
        $products = json_decode($arr, true);
        return view('product-for', compact('products', 'product_for', 'all_brands', 'top_products', 'data', 'frame_types', 'frame_shapes', 'frame_materials', 'ip_country', 'frame_colors'));

    }
    public function junior()
    {
        $ip_country = $this->ip_country;
        $product_for = "Junior";
        $arr = Category::where('category_for', '!=', 'Junior')->where('category_qty', '>', 0)->where('category_status', 'Active')->get();
        $all_brands = Category::where('category_parent_id', '0')->where('category_status', 'Active')->get();
        $top_products = Category::where('category_status', 'Active')->where('category_is_top', 'Yes')->where('category_qty', '>', 0)->get();
        $frame_types = DB::table('product_attributes')->where('type', '!=', '')->get();
        $frame_shapes = DB::table('product_attributes')->where('shape', '!=', '')->get();
        $frame_materials = DB::table('product_attributes')->where('material', '!=', '')->get();
        $frame_colors = ProductColor::all();
        $data = $arr;
        $arr = json_encode($arr);
        $products = json_decode($arr, true);
        return view('product-for', compact('products', 'product_for', 'all_brands', 'top_products', 'data', 'frame_types', 'frame_shapes', 'frame_materials', 'ip_country', 'frame_colors'));

    }





// ======================= frame_type_men start==================================

    public function frame_type_men(Request $request)

    {

        $ip_country = $this->ip_country;

        $glass_type = $request->frame_type;

        $product_for = "Gentle Man";

        $arr = Category::where('category_for', '!=', 'Woman')->where('category_frame', $glass_type)->where('category_qty', '>', 0)->where('category_status', 'Active')->paginate(39);

        $all_brands = Category::where('category_parent_id', '0')->where('category_status', 'Active')->get();



        $top_products = Category::where('category_status', 'Active')->where('category_is_top', 'Yes')->where('category_qty', '>', 0)->get();



        $frame_types = DB::table('product_attributes')->where('type', '!=', '')->get();

        $frame_shapes = DB::table('product_attributes')->where('shape', '!=', '')->get();

        $frame_materials = DB::table('product_attributes')->where('material', '!=', '')->get();

        $frame_colors = ProductColor::all();



        $data = $arr;



        $arr = json_encode($arr);

        $products = json_decode($arr, true);



        return view('product-for', compact('products', 'product_for', 'all_brands', 'top_products', 'data', 'frame_types', 'frame_shapes', 'frame_materials', 'ip_country', 'frame_colors', 'glass_type'));

    }



// ======================= frame_type_men end ==================================

    public function frame_type_women(Request $request)

    {

        $ip_country = $this->ip_country;

        $glass_type = $request->frame_type;

        $product_for = "Woman";

        $arr = Category::where('category_for', '!=', 'Gentle Man')->where('category_frame', $glass_type)->where('category_qty', '>', 0)->where('category_status', 'Active')->paginate(100);

        $all_brands = Category::where('category_parent_id', '0')->where('category_status', 'Active')->get();



        $top_products = Category::where('category_status', 'Active')->where('category_is_top', 'Yes')->where('category_qty', '>', 0)->get();





        $frame_types = DB::table('product_attributes')->where('type', '!=', '')->get();

        $frame_shapes = DB::table('product_attributes')->where('shape', '!=', '')->get();

        $frame_materials = DB::table('product_attributes')->where('material', '!=', '')->get();

        $frame_colors = ProductColor::all();

        $data = $arr;



        $arr = json_encode($arr);

        $products = json_decode($arr, true);





        return view('product-for', compact('products', 'product_for', 'all_brands', 'top_products', 'data', 'frame_types', 'frame_shapes', 'frame_materials', 'ip_country', 'frame_colors', 'glass_type'));

    }





    public function product_detail(Request $request)

    {

        $ip_country = $this->ip_country;

        $product_data = Category::where('category_status', 'Active')->where('category_type', 'product')->where('category_slug_name', $request->product_url)->first();

        if (empty($product_data)) {

            return redirect('/');

        }

        $main_cat = Category::where('id', $product_data->category_parent_id)->first();



        $lens_types = DB::table('product_attributes')->whereIn('id', explode(',', $product_data->lens_type))->get();

        $extras = DB::table('product_attributes')->whereIn('id', explode(',', $product_data->extra))->get();



        $related_data = Category::where('category_status', 'Active')->where('category_type', 'product')->where('category_frame', $product_data->category_frame)->where('id', '!=', $product_data->id)->where('category_qty', '>', 0)->where('shape', $product_data->shape)->limit(8);

        if ($product_data->category_for != "Unisex") {

            $related_data->where('category_for', $product_data->category_for);

        }

        $related_products = $related_data->get();



        return view('product-detail', compact('main_cat', 'product_data', 'related_products', 'ip_country', 'lens_types', 'extras'));

    }



    public function lens_detail(Request $request)

    {



        $product_data = Lens::where('slug_name', $request->lens_url)->first();



        return view('lens-detail', compact('product_data'));

    }



    public function search_product(Request $request)

    {

        // Get Brands

        $brands = OurClient::where('client_status', 'Active')->get();

        $search_keyword = $request->search_keyword;

        $product_cat = $request->product_cat;

        if ($product_cat == "0") {



            // Get Result

            $search_result = Category::where('category_status', 'Active')

                ->where('category_name', 'LIKE', '%' . $search_keyword . '%')

                ->where('category_type', 'product')

                ->get();



        } else {

            $name = array();

            $cat_id = Category::where('category_name', $product_cat)->select('id')->first();

            $subcat_data = Category::where('category_status', 'Active')

                ->where('category_parent_id', $cat_id)->get();

            foreach ($subcat_data as $subcat) {

                $prd_data = Category::where('category_status', 'Active')

                    ->where('category_parent_id', $subcat->id)->get();

                foreach ($prd_data as $prd) {

                    $name[] = $prd->category_name;

                }

            }



// Get Result

            $search_result = Category::where('category_status', 'Active')

                ->where('category_name', 'LIKE', '%' . $search_keyword . '%')

                ->where('category_type', 'product')

                ->get();



            //print_r($name);

        }



        return view('search-result', compact('brands', 'search_result', 'search_keyword'));





    }



    public function wishlist()

    {

        // Get Brands

        $brands = OurClient::where('client_status', 'Active')->get();

        return view('wishlist', compact('brands'));

    }



    // =================== wishlist testing ================

    public function wishlisttest()

    {

        // Get Brands

        $data['getwishlist'] = DB::table('wishlists')->get();



        return view('wishlisttest', $data);

    }



    // =================== wishlist testing ================

    public function filter(Request $request)

    {

        $top_products = Category::where('category_status', 'Active')->where('category_is_top', 'Yes')->where('category_qty', '>', 0)->get();

        $ip_country = $this->ip_country;



        $all_brands = Category::where('category_parent_id', '0')->get();



        $search_product = "";

        $order_filter = "";

        $min_price = "";

        $max_price = "";

        $gender_array = "";

        $shape_array = "";

        $frame_array = "";

        $material_array = "";

        $color_array = "";



        $main_category = Category::where('id', $request->main_category)->first();



        $arr = Category::where('category_status', 'Active')->where('category_parent_id', $main_category->id)->where('category_qty', '>', 0);



        if (!empty($request->order_filter)) {

            $order_filter = $request->order_filter;



            if ($order_filter == "Latest") {

                $arr->latest();

            } else if ($order_filter == "Low") {

                $arr->orderBy('category_price', 'ASC');

            } else if ($order_filter == "High") {

                $arr->orderBy('category_price', 'DESC');

            } else if ($order_filter == "Sort_ASC") {

                $arr->orderBy('category_name', 'ASC');

            } else if ($order_filter == "Sort_DESC") {

                $arr->orderBy('category_name', 'DESC');

            }

        }



        if (!empty($request->min_price) && !empty($request->max_price)) {

            $min_price = $request->min_price;

            $max_price = $request->max_price;

            $arr->whereBetween('category_price', [$min_price, $max_price]);

        }

        if (!empty($request->search_product)) {

            $search_product = $request->search_product;

            $arr->where('category_name', 'LIKE', '%' . $search_product . '%');

        }

        // Condition for Gender Filter

        if (!empty($request->gender_array)) {

            $gender_array = $request->gender_array;

            $this->gender_filter = explode(',', $request->gender_array);

        } else {

            $this->gender_filter = "";

        }



        if (!empty($this->gender_filter)) {

            $arr->where(function ($q) {

                $q->where('category_for', $this->gender_filter[0]);

                $q->orWhere('category_for', 'UNISEX');

                for ($i = 1; $i < COUNT($this->gender_filter); $i++) {

                    $q->orWhere('category_for', $this->gender_filter[$i]);

                }

            });

        }



        // Condition for Shape Filter

        if (!empty($request->shape_array)) {

            $shape_array = $request->shape_array;

            $this->shape_filter = explode(',', $request->shape_array);

        } else {

            $this->shape_filter = "";

        }



        if (!empty($this->shape_filter)) {

            $arr->where(function ($q) {

                $q->where('shape', $this->shape_filter[0]);

                for ($i = 1; $i < COUNT($this->shape_filter); $i++) {

                    $q->orWhere('shape', $this->shape_filter[$i]);

                }

            });

        }



        // Condition for Frame Filter

        if (!empty($request->frame_array)) {

            $frame_array = $request->frame_array;

            $this->frame_filter = explode(',', $request->frame_array);

        } else {

            $this->frame_filter = "";

        }



        if (!empty($this->frame_filter)) {

            $arr->where(function ($q) {

                $q->where('type', $this->frame_filter[0]);

                for ($i = 1; $i < COUNT($this->frame_filter); $i++) {

                    $q->orWhere('type', $this->frame_filter[$i]);

                }

            });

        }



        // Condition for Frame Material

        if (!empty($request->material_array)) {

            $material_array = $request->material_array;

            $this->material_filter = explode(',', $request->material_array);

        } else {

            $this->material_filter = "";

        }



        if (!empty($this->material_filter)) {

            $arr->where(function ($q) {

                $q->where('material', $this->material_filter[0]);

                for ($i = 1; $i < COUNT($this->material_filter); $i++) {

                    $q->orWhere('material', $this->material_filter[$i]);

                }

            });

        }





        // Condition for Frame Color

        if (!empty($request->color_array)) {

            $color_array = $request->color_array;

            $this->color_filter = explode(',', $request->color_array);

        } else {

            $this->color_filter = "";

        }



        if (!empty($this->color_filter)) {

            $arr->where(function ($q) {

                $q->where('category_color', $this->color_filter[0]);

                for ($i = 1; $i < COUNT($this->color_filter); $i++) {

                    $q->orWhere('category_color', $this->color_filter[$i]);

                }

            });

        }





        $frame_types = DB::table('product_attributes')->where('type', '!=', '')->get();

        $frame_shapes = DB::table('product_attributes')->where('shape', '!=', '')->get();

        $frame_materials = DB::table('product_attributes')->where('material', '!=', '')->get();

        $frame_colors = ProductColor::all();



        $arr = $arr->paginate(39);

        $data = $arr;

        $arr = json_encode($arr);

        $products = json_decode($arr, true);





        return view('category', compact('main_category', 'products', 'all_brands', 'top_products', 'search_product', 'min_price', 'max_price', 'order_filter', 'gender_array', 'shape_array', 'frame_types', 'frame_shapes', 'frame_materials', 'frame_array', 'material_array', 'data', 'frame_colors', 'color_array', 'ip_country'));

    }



    public function filter_product_for(Request $request)

    {

        $product_for = $request->product_for;

        $glass_type = $request->glass_type;

        $frame_type = $request->frame_type;

        $top_products = Category::where('category_status', 'Active')->where('category_is_top', 'Yes')->where('category_qty', '>', 0)->get();



        $ip_country = $this->ip_country;

        $all_brands = Category::where('category_parent_id', '0')->where('category_status', 'Active')->get();



        $search_product = "";

        $order_filter = "";

        $min_price = "";

        $max_price = "";

        $gender_array = "";

        $shape_array = "";

        $frame_array = "";

        $material_array = "";

        $brand_array = "";

        $color_array = "";

        $cat_for = [$product_for,'Unisex'];

        



        $arr = Category::where('category_status', 'Active')->where('category_type', 'Product')->whereIn('category_for', $cat_for)->where('category_qty', '>', 0);



        if (!empty($glass_type)) {

            $arr->where('category_frame', $glass_type);

        }

        //dd($request->all());



        if (!empty($request->order_filter)) {

            $order_filter = $request->order_filter;



            if ($order_filter == "Latest") {

                $arr->latest();

            } else if ($order_filter == "Low") {

                $arr->orderBy('category_price', 'ASC');

            } else if ($order_filter == "High") {

                $arr->orderBy('category_price', 'DESC');

            } else if ($order_filter == "Sort_ASC") {

                $arr->orderBy('category_name', 'ASC');

            } else if ($order_filter == "Sort_DESC") {

                $arr->orderBy('category_name', 'DESC');

            }

        }



        if (!empty($request->min_price) && !empty($request->max_price)) {

            $min_price = $request->min_price;

            $max_price = $request->max_price;

            $arr->whereBetween('category_price', [$min_price, $max_price]);

        }

        if (!empty($request->search_product)) {

            $search_product = $request->search_product;

            $arr->where('category_name', 'LIKE', '%' . $search_product . '%');

        }

        // Condition for Gender Filter

        if (!empty($request->gender_array)) {

            $gender_array = $request->gender_array;

            $this->gender_filter = explode(',', $request->gender_array);

        } else {

            $this->gender_filter = "";

        }



        if (!empty($this->gender_filter)) {

            $arr->where(function ($q) {

                $q->where('category_for', $this->gender_filter[0]);

                for ($i = 1; $i < COUNT($this->gender_filter); $i++) {

                    $q->orWhere('category_for', $this->gender_filter[$i]);

                }

            });

        }



        // Condition for Shape Filter

        if (!empty($request->shape_array)) {

            $shape_array = $request->shape_array;

            $this->shape_filter = explode(',', $request->shape_array);

        } else {

            $this->shape_filter = "";

        }



        if (!empty($this->shape_filter)) {

            $arr->where(function ($q) {

                $q->where('shape', $this->shape_filter[0]);

                for ($i = 1; $i < COUNT($this->shape_filter); $i++) {

                    $q->orWhere('shape', $this->shape_filter[$i]);

                }

            });

        }



        // Condition for Frame Filter

        if (!empty($request->frame_array)) {

            $frame_array = $request->frame_array;

            $this->frame_filter = explode(',', $request->frame_array);

        } else {

            $this->frame_filter = "";

        }



        if (!empty($this->frame_filter)) {

            $arr->where(function ($q) {

                $q->where('type', $this->frame_filter[0]);

                for ($i = 1; $i < COUNT($this->frame_filter); $i++) {

                    $q->orWhere('type', $this->frame_filter[$i]);

                }

            });

        }





        // Condition for Frame Material

        if (!empty($request->material_array)) {

            $material_array = $request->material_array;

            $this->material_filter = explode(',', $request->material_array);

        } else {

            $this->material_filter = "";

        }



        if (!empty($this->material_filter)) {

            $arr->where(function ($q) {

                $q->where('material', $this->material_filter[0]);

                for ($i = 1; $i < COUNT($this->material_filter); $i++) {

                    $q->orWhere('material', $this->material_filter[$i]);

                }

            });

        }



        // Condition for Frame Brand

        if (!empty($request->brand_array)) {

            $brand_array = $request->brand_array;

            $this->brand_filter = explode(',', $request->brand_array);

        } else {

            $this->brand_filter = "";

        }



        if (!empty($this->brand_filter)) {

            $arr->where(function ($q) {

                $q->where('category_parent_id', $this->brand_filter[0]);

                for ($i = 1; $i < COUNT($this->brand_filter); $i++) {

                    $q->orWhere('category_parent_id', $this->brand_filter[$i]);

                }

            });

        }

        

        // Condition for Frame Color

        if (!empty($request->color_array)) {

            $color_array = $request->color_array;

            $this->color_filter = explode(',', $request->color_array);

        } else {

            $this->color_filter = "";

        }



        if (!empty($this->color_filter)) {

            $arr->where(function ($q) {

                $q->where('category_color', $this->color_filter[0]);

                for ($i = 1; $i < COUNT($this->color_filter); $i++) {

                    $q->orWhere('category_color', $this->color_filter[$i]);

                }

            });

        }

        

        $frame_types = DB::table('product_attributes')->where('type', '!=', '')->get();

        $frame_shapes = DB::table('product_attributes')->where('shape', '!=', '')->get();

        $frame_materials = DB::table('product_attributes')->where('material', '!=', '')->get();

        $frame_colors = ProductColor::all();



        $arr = $arr->paginate(39);

        $data = $arr;

        $arr = json_encode($arr);

        $products = json_decode($arr, true);





        return view('product-for', compact('product_for', 'products', 'all_brands', 'top_products', 'search_product', 'min_price', 'max_price', 'order_filter', 'gender_array', 'shape_array', 'frame_types', 'frame_array', 'material_array', 'frame_shapes', 'frame_materials', 'brand_array', 'data', 'frame_colors', 'color_array', 'ip_country', 'glass_type'));

    }



}

