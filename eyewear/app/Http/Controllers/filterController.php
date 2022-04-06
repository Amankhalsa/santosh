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

class filterController extends Controller
{
    protected $gender_filter="";
    protected $shape_filter="";
    protected $frame_filter="";
    protected $material_filter="";
    protected $brand_filter="";
    protected $color_filter="";
    protected $ip_country;
    protected $admin_data;

    public function __construct(){
        $ip = \Request::ip();
        //$ip = '1.32.239.255';
        $location = \Location::get($ip);
        $this->ip_country=$location->countryName;
        //$this->ip_country="India";
    }


   
public function filter_product_for(Request $request)

    {

        $product_for = $request->product_for;

        $glass_type = $request->glass_type;

        $frame_type = $request->frame_type;

        $top_products = Category::where('category_status', 'Active')->where('category_frame', 'Eyeglasses')->where('category_qty', '>', 0)->get();



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

        $cat_for = [$product_for,'Unisex',$product_for,'Woman',$product_for,'men',$product_for, 'Gentle Man'];

        



        $arr = Category::where('category_status', 'Active')->where('category_frame', 'Eyeglasses')->where('category_type', 'Product')->whereIn('category_for', $cat_for)->where('category_qty', '>', 0);



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



        $arr = $arr->paginate(1000);

        $data = $arr;

        $arr = json_encode($arr);

        $products = json_decode($arr, true);





       return view('eyeglass_filter_test', compact('product_for', 'products', 'all_brands', 'top_products', 'search_product', 'min_price', 'max_price', 'order_filter', 'gender_array', 'shape_array', 'frame_types', 'frame_array', 'material_array', 'frame_shapes', 'frame_materials', 'brand_array', 'data', 'frame_colors', 'color_array', 'ip_country', 'glass_type'));


    }

    //   
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





        return view('eyeglass_filter_test', compact('main_category', 'products', 'all_brands', 'top_products', 'search_product', 'min_price', 'max_price', 'order_filter', 'gender_array', 'shape_array', 'frame_types', 'frame_shapes', 'frame_materials', 'frame_array', 'material_array', 'data', 'frame_colors', 'color_array', 'ip_country'));

    }
// ================================= added ================================================
// ============================== main_cat end =======================

    public function gentle_man()
    {
        $ip_country = $this->ip_country;
        $product_for = "Gentle Man";
        $arr = Category::where('category_for', '!=', 'Woman')->where('category_frame', 'Eyeglasses')->where('category_qty', '>', 0)->where('category_status', 'Active')->get();
        $all_brands = Category::where('category_parent_id', '0')->where('category_status', 'Active')->get();
        $top_products = Category::where('category_status', 'Active')->where('category_is_top', 'Yes')->where('category_qty', '>', 0)->get();
        $frame_types = DB::table('product_attributes')->where('type', '!=', '')->get();
        $frame_shapes = DB::table('product_attributes')->where('shape', '!=', '')->get();
        $frame_materials = DB::table('product_attributes')->where('material', '!=', '')->get();
        $frame_colors = ProductColor::all();
        $data = $arr;
        $arr = json_encode($arr);
        $products = json_decode($arr, true);
       return view('eyeglass_filter_test', compact('products', 'product_for', 'all_brands', 'top_products', 'data', 'frame_types', 'frame_types', 'frame_shapes', 'frame_materials', 'ip_country', 'frame_colors'));

    }



    public function woman()
    {
        $ip_country = $this->ip_country;
        $product_for = "Woman";
        $arr = Category::where('category_for', '!=', 'Gentle Man')->where('category_frame', 'Eyeglasses')->where('category_qty', '>', 0)->where('category_status', 'Active')->get();
        $all_brands = Category::where('category_parent_id', '0')->where('category_status', 'Active')->get();
        $top_products = Category::where('category_status', 'Active')->where('category_is_top', 'Yes')->where('category_qty', '>', 0)->get();
        $frame_types = DB::table('product_attributes')->where('type', '!=', '')->get();
        $frame_shapes = DB::table('product_attributes')->where('shape', '!=', '')->get();
        $frame_materials = DB::table('product_attributes')->where('material', '!=', '')->get();
        $frame_colors = ProductColor::all();
        $data = $arr;
        $arr = json_encode($arr);
        $products = json_decode($arr, true);
        return view('eyeglass_filter_test', compact('products', 'product_for', 'all_brands', 'top_products', 'data', 'frame_types', 'frame_shapes', 'frame_materials', 'ip_country', 'frame_colors'));

    }
    public function junior()
    {
        $ip_country = $this->ip_country;
        $product_for = "Junior";
        $arr = Category::where('category_for', '!=', 'Junior')->where('category_frame', 'Eyeglasses')->where('category_qty', '>', 0)->where('category_status', 'Active')->get();
        $all_brands = Category::where('category_parent_id', '0')->where('category_status', 'Active')->get();
        $top_products = Category::where('category_status', 'Active')->where('category_is_top', 'Yes')->where('category_qty', '>', 0)->get();
        $frame_types = DB::table('product_attributes')->where('type', '!=', '')->get();
        $frame_shapes = DB::table('product_attributes')->where('shape', '!=', '')->get();
        $frame_materials = DB::table('product_attributes')->where('material', '!=', '')->get();
        $frame_colors = ProductColor::all();
        $data = $arr;
        $arr = json_encode($arr);
        $products = json_decode($arr, true);
        return view('eyeglass_filter_test', compact('products', 'product_for', 'all_brands', 'top_products', 'data', 'frame_types', 'frame_shapes', 'frame_materials', 'ip_country', 'frame_colors'));

    }





// ======================= frame_type_men start==================================

    public function frame_type_men(Request $request)

    {

        $ip_country = $this->ip_country;

        $glass_type = $request->frame_type;

        $product_for = "Gentle Man";

        $arr = Category::where('category_for', '!=', 'Woman')->where('category_frame', 'Eyeglasses')->where('category_frame', $glass_type)->where('category_qty', '>', 0)->where('category_status', 'Active')->paginate(39);

        $all_brands = Category::where('category_parent_id', '0')->where('category_status', 'Active')->get();



        $top_products = Category::where('category_status', 'Active')->where('category_is_top', 'Yes')->where('category_qty', '>', 0)->get();



        $frame_types = DB::table('product_attributes')->where('type', '!=', '')->get();

        $frame_shapes = DB::table('product_attributes')->where('shape', '!=', '')->get();

        $frame_materials = DB::table('product_attributes')->where('material', '!=', '')->get();

        $frame_colors = ProductColor::all();



        $data = $arr;



        $arr = json_encode($arr);

        $products = json_decode($arr, true);



        return view('eyeglass_filter_test', compact('products', 'product_for', 'all_brands', 'top_products', 'data', 'frame_types', 'frame_shapes', 'frame_materials', 'ip_country', 'frame_colors', 'glass_type'));

    }



// ======================= frame_type_men end ==================================

    public function frame_type_women(Request $request)

    {

        $ip_country = $this->ip_country;

        $glass_type = $request->frame_type;

        $product_for = "Woman";

        $arr = Category::where('category_for', '!=', 'Gentle Man')->where('category_frame', 'Eyeglasses')->where('category_frame', $glass_type)->where('category_qty', '>', 0)->where('category_status', 'Active')->paginate(100);

        $all_brands = Category::where('category_parent_id', '0')->where('category_status', 'Active')->get();



        $top_products = Category::where('category_status', 'Active')->where('category_is_top', 'Yes')->where('category_qty', '>', 0)->get();





        $frame_types = DB::table('product_attributes')->where('type', '!=', '')->get();

        $frame_shapes = DB::table('product_attributes')->where('shape', '!=', '')->get();

        $frame_materials = DB::table('product_attributes')->where('material', '!=', '')->get();

        $frame_colors = ProductColor::all();

        $data = $arr;



        $arr = json_encode($arr);

        $products = json_decode($arr, true);





        return view('eyeglass_filter_test', compact('products', 'product_for', 'all_brands', 'top_products', 'data', 'frame_types', 'frame_shapes', 'frame_materials', 'ip_country', 'frame_colors', 'glass_type'));

    }



    

}
