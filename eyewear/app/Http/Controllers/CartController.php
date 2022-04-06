<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Admin_model\Category;
use App\Admin_model\Wishlist;
use App\Admin_model\Subscriber;
use App\Admin_model\Rating;
use App\Admin_model\OurClient;
use App\Admin_model\Coupon;
use App\Admin_model\Vision;
use App\Admin_model\Lens;
use App\Admin_model\LensBrand;
use App\Admin_model\LensColorType;
use App\Admin_model\ProductColor;
use App\Admin_model\Admin;
use App\Cart;
use Auth;
use Session;
use DB;

class CartController extends Controller
{
    protected $date;
    protected $ip_country;
    protected $admin_data;

    public function __construct()
    {
        $this->date = Date('Y-m-d');
        $ip = \Request::ip();
        //$ip = '1.32.239.255';
        $location = \Location::get($ip);
        $this->ip_country = $location->countryName;
        //$this->ip_country="India";

        $this->admin_data = Admin::where('admin_type', 'Admin')->first();
    }


    public function index()
    {
        // Get Cart Items
        $ip_country = $this->ip_country;
        $carts = Cart::where('session_id', Session::get('session_id'))->get();

        return view('cart', compact('carts', 'ip_country'));
    }


// ===============================
// public function new_add_wishlist(Request $request,$product_id ){
//     if(Auth::guard('user')->check()){


//     }
//     else{
//         return response()->json(['success'=>'At first login your account']);

//     }

// }
// =================================


    public function add_wishlist(Request $request)
    {
        if (Auth::guard('user')->check()) {
            $product_id = $request->product_id;
            $check_row = Wishlist::where('product_id', $product_id)->where('user_id', Auth::guard('user')->user()->id)->first();
        
            if (empty($check_row)) {
                Wishlist::create(['product_id' => $product_id, 'user_id' => Auth::guard('user')->user()->id]);
                $total_wishlist = Wishlist::where('user_id', Auth::guard('user')->user()->id)->count();
                return response()->json(["status" => 1, "total_wishlist" => $total_wishlist,"message"=>"Wishlist added successfully"]);
            } else {
                return response()->json(["status" => 2,"message"=>"Wishlist Already added"]);
            }
        } else {
          return  response()->json(["status" => 0,"message"=>"At First Login your Account"]);
            //return redirect()->back()->with('error_msg', 'At First Login your Account');

        }


    }


    public function remove_wishlist(Request $request)
    {
        Wishlist::where('id', $request->id)->delete();
        return back()->with('success_msg', 'Wishlist removed!');
    }

    public function add_to_cart(Request $request)
    {
        $ip_country = $this->ip_country;

        $product_id = $request->product_id;
        $qty = $request->qty;
        $product_detail = Category::findOrFail($product_id);
        $price = getCurrencyPrice($ip_country, $product_detail->category_discount_price);
        $color_data = ProductColor::find($product_detail->category_color);

        if ($product_detail->category_qty > 0) {

            //Calculate GST
            $gst_percent = ($product_detail->category_frame == "Eyeglasses") ? 12 : 18;
            $gst_amount = gst($price, $gst_percent);
            $price += $gst_amount;

            $cart = new Cart;
            $cart->product_id = $product_detail->id;
            $cart->product_name = $product_detail->category_name;
            $cart->quantity = $qty;
            $cart->price = $price;
            $cart->currency_code = getCurrencyCode($ip_country);
            $cart->currency_symbol = getCurrencySymbol($ip_country);
            $cart->color = $color_data->color_name;
            $cart->frame_gst = $gst_amount;
            if (Auth::guard('user')->check()) {
                $cart->user_email = Auth::guard('user')->user()->email;
            }
            $cart->session_id = Session::get('session_id');
            $cart->save();
            return back()->with('success_msg', 'Item added in cart!');
        } else {
            return back()->with('error_msg', 'Out of stock!');
        }
    }

    public function load_mini_cart()
    {
        return view('view-carts');
    }


    public function add_subscriber(Request $request)
    {
        $subscriber_email = $request->subscriber_email;
        $check_row = Subscriber::where('subscriber_email', $subscriber_email)->count();
        if ($check_row > 0) {
            echo 0;
        } else {
            Subscriber::create(['subscriber_email' => $subscriber_email]);
            echo 1;
        }

    }

    public function submit_rating(Request $request)
    {
        $rating = $request->rating;
        $product_id = $request->product_id;
        $user_id = Auth::guard('user')->user()->id;

        $check_row = Rating::where('user_id', $user_id)->where('product_id', $product_id)->count();
        if ($check_row >= 1) {

            Rating::where('user_id', $user_id)->where('product_id', $product_id)->update([
                'rating' => $rating
            ]);

        } else {

            Rating::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'rating' => $rating
            ]);

        }

        return back();

    }

    public function remove_cart(Request $request)
    {
        $cart_id = $request->cart_id;
        $get_prescription = Cart::find($cart_id);
        if (!empty($get_prescription->uploaded_prescription)) {
            $path = "uploaded_files/prescription/" . $get_prescription->uploaded_prescription;
            @unlink($path);
        }
        DB::table('cart_coating')->where('cart_id', $cart_id)->delete();
        Cart::where('id', $cart_id)->delete();
        return back();
    }

    public function update_row_qty(Request $request)
    {
        $cart_ids = $request->cart_ids;
        $qty = $request->qty;
        $cart_count = COUNT($cart_ids);
        for ($i = 0; $i < $cart_count; $i++) {
            $prd_id = Cart::find($cart_ids[$i]);
            $check_qty = Category::where('id', $prd_id->product_id)->first();
            if ($check_qty->category_qty > 0) {
                Cart::where('id', $cart_ids[$i])->update(['lens_qty' => $qty[$i]]);
                Cart::where('id', $cart_ids[$i])->update(['quantity' => $qty[$i]]);
            }
        }
        return back();
    }


    public function apply_coupon(Request $request)
    {
        if (Auth::guard('user')->check()) {
            $coupon_code = $request->coupon_code;
            $cid = Coupon::where('coupon_code', $coupon_code)->first();
            if (empty($cid)) {
                return response()->json(['condition' => 'InvalidCode']);
            } else {

                $carts = Cart::where('session_id', Session::get('session_id'))->get();
                $coupon = Coupon::where('id', $cid->id)->first();

                $user_coupon = DB::table('user_coupon')->where('user_id', Auth::guard('user')->user()->id)->where('coupon_id', $cid->id)->where('status', 'Used')->first();
                $total_amount = 0;
                $discount = 0;
                $final_amount = 0;
                foreach ($carts as $cart) {
                    $total_amount += $cart->price * $cart->quantity;
                }

                if (!empty($user_coupon)) {
                    return response()->json(['condition' => 'Used']);
                } else if ($total_amount < $coupon->coupon_condition) {
                    return response()->json(['condition' => 'Invalid']);
                } else {
                    /*if($coupon->coupon_type == "Fixed"){
                      $discount = $coupon->coupon_amount;
                      $final_amount = $total_amount - $discount; 
                    }else if($coupon->coupon_type == "Percent_off"){
                      $discount = ($total_amount/100)*$coupon->coupon_amount;
                      $final_amount = $total_amount - $discount;  
                    }*/

                    // Add data in user_coupon table

                    DB::table('user_coupon')->insert([
                        'user_id' => Auth::guard('user')->user()->id,
                        'coupon_id' => $cid->id,
                        'date' => $this->date]);

                    return response()->json(['condition' => 'Valid']);
                }
            }
        } else {
            return response()->json(['condition' => 'Nologin']);
        }

    }

    public function remove_coupon(Request $request)
    {
        DB::table('user_coupon')->where('id', $request->id)->delete();
        return back();
    }


    /* Functions for Lens */
    public function buy_with_lens(Request $request)
    {
        $ip_country = $this->ip_country;
        $product_id = $request->product_id;
        $prd_qty = $request->prd_qty;

        $product_data = Category::find($product_id);
        $color_data = ProductColor::where('id', $product_data->category_color)->first();
        $color_name = $color_data->color_name;
        return view('buy-with-lens', compact('product_id', 'prd_qty', 'product_data', 'color_name', 'ip_country'));

    }


    public function get_lens_brands(Request $request)
    {
        $compare_right = "";
        $compare_left = "";
        $ip_country = $this->ip_country;
        $lens_data = "";
        $prescription_data = Session::get('prescription_array');

        $sph_right = $prescription_data['sph_right'];
        $sph_left = $prescription_data['sph_left'];

        $cyl_right = $prescription_data['cyl_right'];
        $cyl_left = $prescription_data['cyl_left'];

        $add_right = $prescription_data['add_right'];
        $add_left = $prescription_data['add_left'];

        $is_prescription_upload = Session::get('is_prescription_upload');

        $vision_id = $request->vision_id;
        $is_tint = $request->is_tint;

        $vision_data = Vision::find($vision_id);

        $lens_color_id = $request->lens_color_id;

        $lens_data = Lens::where('category_status', 'Active')->where('vision_id', $vision_id);

        if ($is_prescription_upload == "No") {

// Condition For Tint   
            if ($is_tint == "tint") {
                $color_type_parent = LensColorType::where('id', $lens_color_id)->first();
                $lens_data->where('color_type_id', $color_type_parent->category_parent_id);
                // Condition For Reading Vision      
                if ($vision_data->vision_type == "Reading") {
                    if ($add_right == "") {
                        $compare_right = $sph_right + $cyl_right;
                    } else {
                        $compare_right = $sph_right + $cyl_right + $add_right;
                    }

                    if ($add_left == "") {
                        $compare_left = $sph_left + $cyl_left;
                    } else {
                        $compare_left = $sph_left + $cyl_left + $add_left;
                    }


                    $compare_right = number_format($compare_right, 2);
                    $compare_left = number_format($compare_left, 2);

                    if ($compare_right > 0) {
                        $lens_data->whereRaw("(limit_plus_val >= $compare_right)")->whereRaw("(sph_plus_val >= REPLACE($sph_right,'+',''))");
                        if ($cyl_right > 0) {
                            $lens_data->whereRaw("(min_cyl <= '$cyl_right' AND max_cyl >= '$cyl_right')");
                        } else {
                            if ($cyl_right != "0.00") {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_right' AND max_cyl >= '$cyl_right')");
                            }
                        }
                    } else {
                        if ($compare_right == "0.00") {
                            $lens_data->whereRaw("(limit_minus <= $compare_right AND limit_plus >= $compare_right)");
                        } else {
                            $lens_data->whereRaw("(limit_minus_val >= REPLACE($compare_right,'-',''))");
                        }

                        if ($sph_right == "0.00") {
                            $lens_data->whereRaw("(min_sph <= $sph_right AND max_sph >= $sph_right)");
                        } else {
                            $lens_data->whereRaw("(sph_minus_val >= REPLACE($sph_right,'-',''))");
                        }

                        if ($cyl_right == "0.00") {
                            $lens_data->whereRaw("(min_cyl <= $cyl_right AND max_cyl >= $cyl_right)");
                        } else {
                            if ($sph_right > 0) {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_right' AND max_cyl >= '$cyl_right')");
                            } else {
                                $lens_data->whereRaw("(min_cyl >= REPLACE('$cyl_right','+','-') AND max_cyl >= REPLACE('$cyl_right','+','-'))");
                            }
                        }

                    }

                    if ($compare_left > 0) {
                        $lens_data->whereRaw("(limit_plus_val >= $compare_left)")->whereRaw("(sph_plus_val >= REPLACE($sph_left,'+',''))");
                        if ($cyl_left > 0) {
                            $lens_data->whereRaw("(min_cyl <= '$cyl_left' AND max_cyl >= '$cyl_left')");
                        } else {
                            if ($cyl_left != "0.00") {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_left' AND max_cyl >= '$cyl_left')");
                            }
                        }

                    } else {
                        if ($compare_left == "0.00") {
                            $lens_data->whereRaw("(limit_minus <= $compare_left AND limit_plus >= $compare_left)");
                        } else {
                            $lens_data->whereRaw("(limit_minus_val >= REPLACE($compare_left,'-',''))");
                        }


                        if ($sph_left == "0.00") {
                            $lens_data->whereRaw("(min_sph <= $sph_left AND max_sph >= $sph_left)");
                        } else {
                            $lens_data->whereRaw("(sph_minus_val >= REPLACE($sph_left,'-',''))");
                        }

                        if ($cyl_left == "0.00") {
                            $lens_data->whereRaw("(min_cyl <= $cyl_left AND max_cyl >= $cyl_left)");
                        } else {
                            if ($sph_left > 0) {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_left' AND max_cyl >= '$cyl_left')");
                            } else {
                                $lens_data->whereRaw("(min_cyl >= REPLACE('$cyl_left','+','-') AND max_cyl >= REPLACE('$cyl_left','+','-'))");
                            }

                        }

                    }

                    //$lens_data->where('limit_minus','>=',$compare_right)->where('limit_minus','>=',$compare_left)->where('limit_plus','>=',$compare_right)->where('limit_plus','>=',$compare_left);     

                } else if ($vision_data->vision_type == "Bifocal" || $vision_data->vision_type == "Progressive") {

// Condition For Bifocal       
                    $compare_right = $sph_right + $cyl_right;
                    $compare_left = $sph_left + $cyl_left;

                    $compare_right = number_format($compare_right, 2);
                    $compare_left = number_format($compare_left, 2);

                    if ($compare_right > 0) {
                        $lens_data->whereRaw("(limit_plus_val >= $compare_right)")->whereRaw("(sph_plus_val >= REPLACE($sph_right,'+',''))");
                        if ($cyl_right > 0) {
                            $lens_data->whereRaw("(min_cyl <= '$cyl_right' AND max_cyl >= '$cyl_right')");
                        } else {
                            $lens_data->whereRaw("(min_cyl >= '$cyl_right' AND max_cyl >= '$cyl_right')");
                        }

                        if ($add_right != "") {
                            $lens_data->whereRaw("(min_add <= '$add_right' AND max_add >= '$add_right')");
                        }

                    } else {
                        if ($compare_right == "0.00") {
                            $lens_data->whereRaw("(limit_minus <= $compare_right AND limit_plus >= $compare_right)");
                        } else {
                            $lens_data->whereRaw("(limit_minus_val >= REPLACE($compare_right,'-',''))");
                        }

                        if ($sph_right == "0.00") {
                            $lens_data->whereRaw("(min_sph <= $sph_right AND max_sph >= $sph_right)");
                        } else {
                            $lens_data->whereRaw("(sph_minus_val >= REPLACE($sph_right,'-',''))");
                        }

                        if ($cyl_right == "0.00") {
                            $lens_data->whereRaw("(min_cyl <= $cyl_right AND max_cyl >= $cyl_right)");
                        } else {
                            if ($sph_right > 0) {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_right' AND max_cyl >= '$cyl_right')");
                            } else {
                                $lens_data->whereRaw("(min_cyl >= REPLACE('$cyl_right','+','-') AND max_cyl >= REPLACE('$cyl_right','+','-'))");
                            }
                        }

                        if ($add_right != "") {
                            $lens_data->whereRaw("(min_add <= '$add_right' AND max_add >= '$add_right')");
                        }

                    }

                    if ($compare_left > 0) {
                        $lens_data->whereRaw("(limit_plus_val >= $compare_left)")->whereRaw("(sph_plus_val >= REPLACE($sph_left,'+',''))");
                        if ($cyl_left > 0) {
                            $lens_data->whereRaw("(min_cyl <= '$cyl_left' AND max_cyl >= '$cyl_left')");
                        } else {
                            $lens_data->whereRaw("(min_cyl >= '$cyl_left' AND max_cyl >= '$cyl_left')");
                        }

                        if ($add_left != "") {
                            $lens_data->whereRaw("(min_add <= '$add_left' AND max_add >= '$add_left')");
                        }

                    } else {
                        if ($compare_left == "0.00") {
                            $lens_data->whereRaw("(limit_minus <= $compare_left AND limit_plus >= $compare_left)");
                        } else {
                            $lens_data->whereRaw("(limit_minus_val >= REPLACE($compare_left,'-',''))");
                        }


                        if ($sph_left == "0.00") {
                            $lens_data->whereRaw("(min_sph <= $sph_left AND max_sph >= $sph_left)");
                        } else {
                            $lens_data->whereRaw("(sph_minus_val >= REPLACE($sph_left,'-',''))");
                        }

                        if ($cyl_left == "0.00") {
                            $lens_data->whereRaw("(min_cyl <= $cyl_left AND max_cyl >= $cyl_left)");
                        } else {
                            if ($sph_left > 0) {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_left' AND max_cyl >= '$cyl_left')");
                            } else {
                                $lens_data->whereRaw("(min_cyl >= REPLACE('$cyl_left','+','-') AND max_cyl >= REPLACE('$cyl_left','+','-'))");
                            }

                        }

                        if ($add_left != "") {
                            $lens_data->whereRaw("(min_add <= '$add_left' AND max_add >= '$add_left')");
                        }

                    }

                    //$lens_data->where('limit_minus','>=',$compare_right)->where('limit_minus','>=',$compare_left)->where('limit_plus','>=',$compare_right)->where('limit_plus','>=',$compare_left); 

                } else {
// Condition For Other Distance Vision       
                    $compare_right = $sph_right + $cyl_right;
                    $compare_left = $sph_left + $cyl_left;

                    $compare_right = number_format($compare_right, 2);
                    $compare_left = number_format($compare_left, 2);

                    if ($compare_right > 0) {
                        $lens_data->whereRaw("(limit_plus_val >= $compare_right)")->whereRaw("(sph_plus_val >= REPLACE($sph_right,'+',''))");
                        if ($cyl_right > 0) {
                            $lens_data->whereRaw("(min_cyl <= '$cyl_right' AND max_cyl >= '$cyl_right')");
                        } else {
                            $lens_data->whereRaw("(min_cyl >= '$cyl_right' AND max_cyl >= '$cyl_right')");
                        }
                    } else {
                        if ($compare_right == "0.00") {
                            $lens_data->whereRaw("(limit_minus <= $compare_right AND limit_plus >= $compare_right)");
                        } else {
                            $lens_data->whereRaw("(limit_minus_val >= REPLACE($compare_right,'-',''))");
                        }

                        if ($sph_right == "0.00") {
                            $lens_data->whereRaw("(min_sph <= $sph_right AND max_sph >= $sph_right)");
                        } else {
                            $lens_data->whereRaw("(sph_minus_val >= REPLACE($sph_right,'-',''))");
                        }

                        if ($cyl_right == "0.00") {
                            $lens_data->whereRaw("(min_cyl <= $cyl_right AND max_cyl >= $cyl_right)");
                        } else {
                            if ($sph_right > 0) {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_right' AND max_cyl >= '$cyl_right')");
                            } else {
                                $lens_data->whereRaw("(min_cyl >= REPLACE('$cyl_right','+','-') AND max_cyl >= REPLACE('$cyl_right','+','-'))");
                            }
                        }

                    }

                    if ($compare_left > 0) {
                        $lens_data->whereRaw("(limit_plus_val >= $compare_left)")->whereRaw("(sph_plus_val >= REPLACE($sph_left,'+',''))");
                        if ($cyl_left > 0) {
                            $lens_data->whereRaw("(min_cyl <= '$cyl_left' AND max_cyl >= '$cyl_left')");
                        } else {
                            $lens_data->whereRaw("(min_cyl >= '$cyl_left' AND max_cyl >= '$cyl_left')");
                        }

                    } else {
                        if ($compare_left == "0.00") {
                            $lens_data->whereRaw("(limit_minus <= $compare_left AND limit_plus >= $compare_left)");
                        } else {
                            $lens_data->whereRaw("(limit_minus_val >= REPLACE($compare_left,'-',''))");
                        }


                        if ($sph_left == "0.00") {
                            $lens_data->whereRaw("(min_sph <= $sph_left AND max_sph >= $sph_left)");
                        } else {
                            $lens_data->whereRaw("(sph_minus_val >= REPLACE($sph_left,'-',''))");
                        }

                        if ($cyl_left == "0.00") {
                            $lens_data->whereRaw("(min_cyl <= $cyl_left AND max_cyl >= $cyl_left)");
                        } else {
                            if ($sph_left > 0) {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_left' AND max_cyl >= '$cyl_left')");
                            } else {
                                $lens_data->whereRaw("(min_cyl >= REPLACE('$cyl_left','+','-') AND max_cyl >= REPLACE('$cyl_left','+','-'))");
                            }

                        }

                    }

                    //$lens_data->where('limit_minus','>=',$compare_right)->where('limit_minus','>=',$compare_left)->where('limit_plus','>=',$compare_right)->where('limit_plus','>=',$compare_left);  

                }

            } // Condition For No Tint  
            else {
                $lens_data->where('color_type_id', $lens_color_id);
// Condition For Reading Vision      
                if ($vision_data->vision_type == "Reading") {
                    if ($add_right == "") {
                        $compare_right = $sph_right + $cyl_right;
                    } else {
                        $compare_right = $sph_right + $cyl_right + $add_right;
                    }

                    if ($add_left == "") {
                        $compare_left = $sph_left + $cyl_left;
                    } else {
                        $compare_left = $sph_left + $cyl_left + $add_left;
                    }


                    $compare_right = number_format($compare_right, 2);
                    $compare_left = number_format($compare_left, 2);

                    if ($compare_right > 0) {
                        $lens_data->whereRaw("(limit_plus_val >= $compare_right)")->whereRaw("(sph_plus_val >= REPLACE($sph_right,'+',''))");
                        if ($cyl_right > 0) {
                            $lens_data->whereRaw("(min_cyl <= '$cyl_right' AND max_cyl >= '$cyl_right')");
                        } else {
                            $lens_data->whereRaw("(min_cyl >= '$cyl_right' AND max_cyl >= '$cyl_right')");
                        }
                    } else {
                        if ($compare_right == "0.00") {
                            $lens_data->whereRaw("(limit_minus <= $compare_right AND limit_plus >= $compare_right)");
                        } else {
                            $lens_data->whereRaw("(limit_minus_val >= REPLACE($compare_right,'-',''))");
                        }

                        if ($sph_right == "0.00") {
                            $lens_data->whereRaw("(min_sph <= $sph_right AND max_sph >= $sph_right)");
                        } else {
                            $lens_data->whereRaw("(sph_minus_val >= REPLACE($sph_right,'-',''))");
                        }

                        if ($cyl_right == "0.00") {
                            $lens_data->whereRaw("(min_cyl <= $cyl_right AND max_cyl >= $cyl_right)");
                        } else {
                            if ($sph_right > 0) {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_right' AND max_cyl >= '$cyl_right')");
                            } else {
                                $lens_data->whereRaw("(min_cyl >= REPLACE('$cyl_right','+','-') AND max_cyl >= REPLACE('$cyl_right','+','-'))");
                            }
                        }

                    }

                    if ($compare_left > 0) {
                        $lens_data->whereRaw("(limit_plus_val >= $compare_left)")->whereRaw("(sph_plus_val >= REPLACE($sph_left,'+',''))");
                        if ($cyl_left > 0) {
                            $lens_data->whereRaw("(min_cyl <= '$cyl_left' AND max_cyl >= '$cyl_left')");
                        } else {
                            $lens_data->whereRaw("(min_cyl >= '$cyl_left' AND max_cyl >= '$cyl_left')");
                        }

                    } else {
                        if ($compare_left == "0.00") {
                            $lens_data->whereRaw("(limit_minus <= $compare_left AND limit_plus >= $compare_left)");
                        } else {
                            $lens_data->whereRaw("(limit_minus_val >= REPLACE($compare_left,'-',''))");
                        }


                        if ($sph_left == "0.00") {
                            $lens_data->whereRaw("(min_sph <= $sph_left AND max_sph >= $sph_left)");
                        } else {
                            $lens_data->whereRaw("(sph_minus_val >= REPLACE($sph_left,'-',''))");
                        }

                        if ($cyl_left == "0.00") {
                            $lens_data->whereRaw("(min_cyl <= $cyl_left AND max_cyl >= $cyl_left)");
                        } else {
                            if ($sph_left > 0) {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_left' AND max_cyl >= '$cyl_left')");
                            } else {
                                $lens_data->whereRaw("(min_cyl >= REPLACE('$cyl_left','+','-') AND max_cyl >= REPLACE('$cyl_left','+','-'))");
                            }

                        }

                    }

                    //$lens_data->where('limit_minus','>=',$compare_right)->where('limit_minus','>=',$compare_left)->where('limit_plus','>=',$compare_right)->where('limit_plus','>=',$compare_left);     

                } else if ($vision_data->vision_type == "Bifocal" || $vision_data->vision_type == "Progressive") {

// Condition For Bifocal       
                    $compare_right = $sph_right + $cyl_right;
                    $compare_left = $sph_left + $cyl_left;

                    $compare_right = number_format($compare_right, 2);
                    $compare_left = number_format($compare_left, 2);

                    if ($compare_right > 0) {
                        $lens_data->whereRaw("(limit_plus_val >= $compare_right)")->whereRaw("(sph_plus_val >= REPLACE($sph_right,'+',''))");
                        if ($cyl_right > 0) {
                            $lens_data->whereRaw("(min_cyl <= '$cyl_right' AND max_cyl >= '$cyl_right')");
                        } else {
                            $lens_data->whereRaw("(min_cyl >= '$cyl_right' AND max_cyl >= '$cyl_right')");
                        }

                        if ($add_right != "") {
                            $lens_data->whereRaw("(min_add <= '$add_right' AND max_add >= '$add_right')");
                        }

                    } else {
                        if ($compare_right == "0.00") {
                            $lens_data->whereRaw("(limit_minus <= $compare_right AND limit_plus >= $compare_right)");
                        } else {
                            $lens_data->whereRaw("(limit_minus_val >= REPLACE($compare_right,'-',''))");
                        }

                        if ($sph_right == "0.00") {
                            $lens_data->whereRaw("(min_sph <= $sph_right AND max_sph >= $sph_right)");
                        } else {
                            $lens_data->whereRaw("(sph_minus_val >= REPLACE($sph_right,'-',''))");
                        }

                        if ($cyl_right == "0.00") {
                            $lens_data->whereRaw("(min_cyl <= $cyl_right AND max_cyl >= $cyl_right)");
                        } else {
                            if ($sph_right > 0) {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_right' AND max_cyl >= '$cyl_right')");
                            } else {
                                $lens_data->whereRaw("(min_cyl >= REPLACE('$cyl_right','+','-') AND max_cyl >= REPLACE('$cyl_right','+','-'))");
                            }
                        }

                        if ($add_right != "") {
                            $lens_data->whereRaw("(min_add <= '$add_right' AND max_add >= '$add_right')");
                        }

                    }

                    if ($compare_left > 0) {
                        $lens_data->whereRaw("(limit_plus_val >= $compare_left)")->whereRaw("(sph_plus_val >= REPLACE($sph_left,'+',''))");
                        if ($cyl_left > 0) {
                            $lens_data->whereRaw("(min_cyl <= '$cyl_left' AND max_cyl >= '$cyl_left')");
                        } else {
                            $lens_data->whereRaw("(min_cyl >= '$cyl_left' AND max_cyl >= '$cyl_left')");
                        }

                        if ($add_left != "") {
                            $lens_data->whereRaw("(min_add <= '$add_left' AND max_add >= '$add_left')");
                        }

                    } else {
                        if ($compare_left == "0.00") {
                            $lens_data->whereRaw("(limit_minus <= $compare_left AND limit_plus >= $compare_left)");
                        } else {
                            $lens_data->whereRaw("(limit_minus_val >= REPLACE($compare_left,'-',''))");
                        }


                        if ($sph_left == "0.00") {
                            $lens_data->whereRaw("(min_sph <= $sph_left AND max_sph >= $sph_left)");
                        } else {
                            $lens_data->whereRaw("(sph_minus_val >= REPLACE($sph_left,'-',''))");
                        }

                        if ($cyl_left == "0.00") {
                            $lens_data->whereRaw("(min_cyl <= $cyl_left AND max_cyl >= $cyl_left)");
                        } else {
                            if ($sph_left > 0) {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_left' AND max_cyl >= '$cyl_left')");
                            } else {
                                $lens_data->whereRaw("(min_cyl >= REPLACE('$cyl_left','+','-') AND max_cyl >= REPLACE('$cyl_left','+','-'))");
                            }

                        }

                        if ($add_left != "") {
                            $lens_data->whereRaw("(min_add <= '$add_left' AND max_add >= '$add_left')");
                        }

                    }

                    //$lens_data->where('limit_minus','>=',$compare_right)->where('limit_minus','>=',$compare_left)->where('limit_plus','>=',$compare_right)->where('limit_plus','>=',$compare_left); 

                } else {
// Condition For Other Distance Vision       
                    $compare_right = $sph_right + $cyl_right;
                    $compare_left = $sph_left + $cyl_left;

                    $compare_right = number_format($compare_right, 2);
                    $compare_left = number_format($compare_left, 2);

                    if ($compare_right > 0) {
                        $lens_data->whereRaw("(limit_plus_val >= $compare_right)")->whereRaw("(sph_plus_val >= REPLACE($sph_right,'+',''))");
                        if ($cyl_right > 0) {
                            $lens_data->whereRaw("(min_cyl <= '$cyl_right' AND max_cyl >= '$cyl_right')");
                        } else {
                            if ($cyl_right != "0.00") {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_right' AND max_cyl >= '$cyl_right')");

                            }
                        }
                    } else {
                        if ($compare_right == "0.00") {
                            $lens_data->whereRaw("(limit_minus <= $compare_right AND limit_plus >= $compare_right)");
                        } else {
                            $lens_data->whereRaw("(limit_minus_val >= REPLACE($compare_right,'-',''))");
                        }

                        if ($sph_right == "0.00") {
                            $lens_data->whereRaw("(min_sph <= $sph_right AND max_sph >= $sph_right)");
                        } else {
                            $lens_data->whereRaw("(sph_minus_val >= REPLACE($sph_right,'-',''))");
                        }

                        if ($cyl_right == "0.00") {
                            $lens_data->whereRaw("(min_cyl <= $cyl_right AND max_cyl >= $cyl_right)");
                        } else {
                            if ($sph_right > 0) {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_right' AND max_cyl >= '$cyl_right')");
                            } else {
                                $lens_data->whereRaw("(min_cyl >= REPLACE('$cyl_right','+','-') AND max_cyl >= REPLACE('$cyl_right','+','-'))");
                            }
                        }

                    }

                    if ($compare_left > 0) {
                        $lens_data->whereRaw("(limit_plus_val >= $compare_left)")->whereRaw("(sph_plus_val >= REPLACE($sph_left,'+',''))");
                        if ($cyl_left > 0) {
                            $lens_data->whereRaw("(min_cyl <= '$cyl_left' AND max_cyl >= '$cyl_left')");
                        } else {
                            if ($cyl_left != "0.00") {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_left' AND max_cyl >= '$cyl_left')");

                            }
                        }

                    } else {
                        if ($compare_left == "0.00") {
                            $lens_data->whereRaw("(limit_minus <= $compare_left AND limit_plus >= $compare_left)");
                        } else {
                            $lens_data->whereRaw("(limit_minus_val >= REPLACE($compare_left,'-',''))");
                        }


                        if ($sph_left == "0.00") {
                            $lens_data->whereRaw("(min_sph <= $sph_left AND max_sph >= $sph_left)");
                        } else {
                            $lens_data->whereRaw("(sph_minus_val >= REPLACE($sph_left,'-',''))");
                        }

                        if ($cyl_left == "0.00") {
                            $lens_data->whereRaw("(min_cyl <= $cyl_left AND max_cyl >= $cyl_left)");
                        } else {
                            if ($sph_left > 0) {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_left' AND max_cyl >= '$cyl_left')");
                            } else {
                                $lens_data->whereRaw("(min_cyl >= REPLACE('$cyl_left','+','-') AND max_cyl >= REPLACE('$cyl_left','+','-'))");
                            }

                        }

                    }

                    //$lens_data->where('limit_minus','>=',$compare_right)->where('limit_minus','>=',$compare_left)->where('limit_plus','>=',$compare_right)->where('limit_plus','>=',$compare_left);  

                }
            }
        }
        $lens_data = $lens_data->get();
        $arr = array();
        foreach ($lens_data as $data) {
            $arr[] = $data->brand;
        }
        $arr = array_unique($arr);

        $lens_brands = LensBrand::where('category_status', 'Active')->where('category_parent_id', '0')->whereIn('id', $arr)->get();

        // return $sph_right;
        Session::put('vision_id', $vision_id);
        return view('view-lens-brands', compact('lens_brands', 'lens_color_id', 'is_tint'));

    }

    public function get_lenses(Request $request)
    {
        $compare_right = "";
        $compare_left = "";
        $ip_country = $this->ip_country;
        $lens_data = "";
        $brand_id = $request->lens_brand;
        $prescription_data = Session::get('prescription_array');

        $is_prescription_upload = Session::get('is_prescription_upload');

        $sph_right = $prescription_data['sph_right'];
        $sph_left = $prescription_data['sph_left'];

        $cyl_right = $prescription_data['cyl_right'];
        $cyl_left = $prescription_data['cyl_left'];

        $add_right = $prescription_data['add_right'];
        $add_left = $prescription_data['add_left'];

        $func_type = $request->func_type;
        $vision_id = $request->vision_id;
        $product_id = $request->product_id;
        $qty = $request->qty;
        $is_tint = $request->is_tint;

        $vision_data = Vision::find($vision_id);

        $lens_color_id = $request->lens_color_id;

        $lens_data = Lens::where('brand', $brand_id)->where('category_status', 'Active')->where('vision_id', $vision_id)->groupBy('lens_index');

        if ($is_prescription_upload == "No") {
// Condition For Tint   
            if ($is_tint == "tint") {
                $color_type_parent = LensColorType::where('id', $lens_color_id)->first();
                $lens_data->where('color_type_id', $color_type_parent->category_parent_id);
                // Condition For Reading Vision      
                if ($vision_data->vision_type == "Reading") {
                    if ($add_right == "") {
                        $compare_right = $sph_right + $cyl_right;
                    } else {
                        $compare_right = $sph_right + $cyl_right + $add_right;
                    }

                    if ($add_left == "") {
                        $compare_left = $sph_left + $cyl_left;
                    } else {
                        $compare_left = $sph_left + $cyl_left + $add_left;
                    }


                    $compare_right = number_format($compare_right, 2);
                    $compare_left = number_format($compare_left, 2);

                    if ($compare_right > 0) {
                        $lens_data->whereRaw("(limit_plus_val >= $compare_right)")->whereRaw("(sph_plus_val >= REPLACE($sph_right,'+',''))");
                        if ($cyl_right > 0) {
                            $lens_data->whereRaw("(min_cyl <= '$cyl_right' AND max_cyl >= '$cyl_right')");
                        } else {
                            $lens_data->whereRaw("(min_cyl >= '$cyl_right' AND max_cyl >= '$cyl_right')");
                        }
                    } else {
                        if ($compare_right == "0.00") {
                            $lens_data->whereRaw("(limit_minus <= $compare_right AND limit_plus >= $compare_right)");
                        } else {
                            $lens_data->whereRaw("(limit_minus_val >= REPLACE($compare_right,'-',''))");
                        }

                        if ($sph_right == "0.00") {
                            $lens_data->whereRaw("(min_sph <= $sph_right AND max_sph >= $sph_right)");
                        } else {
                            $lens_data->whereRaw("(sph_minus_val >= REPLACE($sph_right,'-',''))");
                        }

                        if ($cyl_right == "0.00") {
                            $lens_data->whereRaw("(min_cyl <= $cyl_right AND max_cyl >= $cyl_right)");
                        } else {
                            if ($sph_right > 0) {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_right' AND max_cyl >= '$cyl_right')");
                            } else {
                                $lens_data->whereRaw("(min_cyl >= REPLACE('$cyl_right','+','-') AND max_cyl >= REPLACE('$cyl_right','+','-'))");
                            }
                        }

                    }

                    if ($compare_left > 0) {
                        $lens_data->whereRaw("(limit_plus_val >= $compare_left)")->whereRaw("(sph_plus_val >= REPLACE($sph_left,'+',''))");
                        if ($cyl_left > 0) {
                            $lens_data->whereRaw("(min_cyl <= '$cyl_left' AND max_cyl >= '$cyl_left')");
                        } else {
                            $lens_data->whereRaw("(min_cyl >= '$cyl_left' AND max_cyl >= '$cyl_left')");
                        }

                    } else {
                        if ($compare_left == "0.00") {
                            $lens_data->whereRaw("(limit_minus <= $compare_left AND limit_plus >= $compare_left)");
                        } else {
                            $lens_data->whereRaw("(limit_minus_val >= REPLACE($compare_left,'-',''))");
                        }


                        if ($sph_left == "0.00") {
                            $lens_data->whereRaw("(min_sph <= $sph_left AND max_sph >= $sph_left)");
                        } else {
                            $lens_data->whereRaw("(sph_minus_val >= REPLACE($sph_left,'-',''))");
                        }

                        if ($cyl_left == "0.00") {
                            $lens_data->whereRaw("(min_cyl <= $cyl_left AND max_cyl >= $cyl_left)");
                        } else {
                            if ($sph_left > 0) {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_left' AND max_cyl >= '$cyl_left')");
                            } else {
                                $lens_data->whereRaw("(min_cyl >= REPLACE('$cyl_left','+','-') AND max_cyl >= REPLACE('$cyl_left','+','-'))");
                            }

                        }

                    }

                    //$lens_data->where('limit_minus','>=',$compare_right)->where('limit_minus','>=',$compare_left)->where('limit_plus','>=',$compare_right)->where('limit_plus','>=',$compare_left);     

                } else if ($vision_data->vision_type == "Bifocal" || $vision_data->vision_type == "Progressive") {

// Condition For Bifocal       
                    $compare_right = $sph_right + $cyl_right;
                    $compare_left = $sph_left + $cyl_left;

                    $compare_right = number_format($compare_right, 2);
                    $compare_left = number_format($compare_left, 2);

                    if ($compare_right > 0) {
                        $lens_data->whereRaw("(limit_plus_val >= $compare_right)")->whereRaw("(sph_plus_val >= REPLACE($sph_right,'+',''))");
                        if ($cyl_right > 0) {
                            $lens_data->whereRaw("(min_cyl <= '$cyl_right' AND max_cyl >= '$cyl_right')");
                        } else {
                            $lens_data->whereRaw("(min_cyl >= '$cyl_right' AND max_cyl >= '$cyl_right')");
                        }

                        if ($add_right != "") {
                            $lens_data->whereRaw("(min_add <= '$add_right' AND max_add >= '$add_right')");
                        }

                    } else {
                        if ($compare_right == "0.00") {
                            $lens_data->whereRaw("(limit_minus <= $compare_right AND limit_plus >= $compare_right)");
                        } else {
                            $lens_data->whereRaw("(limit_minus_val >= REPLACE($compare_right,'-',''))");
                        }

                        if ($sph_right == "0.00") {
                            $lens_data->whereRaw("(min_sph <= $sph_right AND max_sph >= $sph_right)");
                        } else {
                            $lens_data->whereRaw("(sph_minus_val >= REPLACE($sph_right,'-',''))");
                        }

                        if ($cyl_right == "0.00") {
                            $lens_data->whereRaw("(min_cyl <= $cyl_right AND max_cyl >= $cyl_right)");
                        } else {
                            if ($sph_right > 0) {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_right' AND max_cyl >= '$cyl_right')");
                            } else {
                                $lens_data->whereRaw("(min_cyl >= REPLACE('$cyl_right','+','-') AND max_cyl >= REPLACE('$cyl_right','+','-'))");
                            }
                        }

                        if ($add_right != "") {
                            $lens_data->whereRaw("(min_add <= '$add_right' AND max_add >= '$add_right')");
                        }

                    }

                    if ($compare_left > 0) {
                        $lens_data->whereRaw("(limit_plus_val >= $compare_left)")->whereRaw("(sph_plus_val >= REPLACE($sph_left,'+',''))");
                        if ($cyl_left > 0) {
                            $lens_data->whereRaw("(min_cyl <= '$cyl_left' AND max_cyl >= '$cyl_left')");
                        } else {
                            $lens_data->whereRaw("(min_cyl >= '$cyl_left' AND max_cyl >= '$cyl_left')");
                        }

                        if ($add_left != "") {
                            $lens_data->whereRaw("(min_add <= '$add_left' AND max_add >= '$add_left')");
                        }

                    } else {
                        if ($compare_left == "0.00") {
                            $lens_data->whereRaw("(limit_minus <= $compare_left AND limit_plus >= $compare_left)");
                        } else {
                            $lens_data->whereRaw("(limit_minus_val >= REPLACE($compare_left,'-',''))");
                        }


                        if ($sph_left == "0.00") {
                            $lens_data->whereRaw("(min_sph <= $sph_left AND max_sph >= $sph_left)");
                        } else {
                            $lens_data->whereRaw("(sph_minus_val >= REPLACE($sph_left,'-',''))");
                        }

                        if ($cyl_left == "0.00") {
                            $lens_data->whereRaw("(min_cyl <= $cyl_left AND max_cyl >= $cyl_left)");
                        } else {
                            if ($sph_left > 0) {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_left' AND max_cyl >= '$cyl_left')");
                            } else {
                                $lens_data->whereRaw("(min_cyl >= REPLACE('$cyl_left','+','-') AND max_cyl >= REPLACE('$cyl_left','+','-'))");
                            }

                        }

                        if ($add_left != "") {
                            $lens_data->whereRaw("(min_add <= '$add_left' AND max_add >= '$add_left')");
                        }

                    }

                    //$lens_data->where('limit_minus','>=',$compare_right)->where('limit_minus','>=',$compare_left)->where('limit_plus','>=',$compare_right)->where('limit_plus','>=',$compare_left); 

                } else {
// Condition For Other Distance Vision       
                    $compare_right = $sph_right + $cyl_right;
                    $compare_left = $sph_left + $cyl_left;

                    $compare_right = number_format($compare_right, 2);
                    $compare_left = number_format($compare_left, 2);

                    if ($compare_right > 0) {
                        $lens_data->whereRaw("(limit_plus_val >= $compare_right)")->whereRaw("(sph_plus_val >= REPLACE($sph_right,'+',''))");
                        if ($cyl_right > 0) {
                            $lens_data->whereRaw("(min_cyl <= '$cyl_right' AND max_cyl >= '$cyl_right')");
                        } else {
                            if ($cyl_right != "0.00") {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_right' AND max_cyl >= '$cyl_right')");
                            }
                        }
                    } else {
                        if ($compare_right == "0.00") {
                            $lens_data->whereRaw("(limit_minus <= $compare_right AND limit_plus >= $compare_right)");
                        } else {
                            $lens_data->whereRaw("(limit_minus_val >= REPLACE($compare_right,'-',''))");
                        }

                        if ($sph_right == "0.00") {
                            $lens_data->whereRaw("(min_sph <= $sph_right AND max_sph >= $sph_right)");
                        } else {
                            $lens_data->whereRaw("(sph_minus_val >= REPLACE($sph_right,'-',''))");
                        }

                        if ($cyl_right == "0.00") {
                            $lens_data->whereRaw("(min_cyl <= $cyl_right AND max_cyl >= $cyl_right)");
                        } else {
                            if ($sph_right > 0) {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_right' AND max_cyl >= '$cyl_right')");
                            } else {
                                $lens_data->whereRaw("(min_cyl >= REPLACE('$cyl_right','+','-') AND max_cyl >= REPLACE('$cyl_right','+','-'))");
                            }
                        }

                    }

                    if ($compare_left > 0) {
                        $lens_data->whereRaw("(limit_plus_val >= $compare_left)")->whereRaw("(sph_plus_val >= REPLACE($sph_left,'+',''))");
                        if ($cyl_left > 0) {
                            $lens_data->whereRaw("(min_cyl <= '$cyl_left' AND max_cyl >= '$cyl_left')");
                        } else {
                            if ($cyl_left != "0.00") {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_left' AND max_cyl >= '$cyl_left')");
                            }
                        }

                    } else {
                        if ($compare_left == "0.00") {
                            $lens_data->whereRaw("(limit_minus <= $compare_left AND limit_plus >= $compare_left)");
                        } else {
                            $lens_data->whereRaw("(limit_minus_val >= REPLACE($compare_left,'-',''))");
                        }


                        if ($sph_left == "0.00") {
                            $lens_data->whereRaw("(min_sph <= $sph_left AND max_sph >= $sph_left)");
                        } else {
                            $lens_data->whereRaw("(sph_minus_val >= REPLACE($sph_left,'-',''))");
                        }

                        if ($cyl_left == "0.00") {
                            $lens_data->whereRaw("(min_cyl <= $cyl_left AND max_cyl >= $cyl_left)");
                        } else {
                            if ($sph_left > 0) {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_left' AND max_cyl >= '$cyl_left')");
                            } else {
                                $lens_data->whereRaw("(min_cyl >= REPLACE('$cyl_left','+','-') AND max_cyl >= REPLACE('$cyl_left','+','-'))");
                            }

                        }

                    }

                    //$lens_data->where('limit_minus','>=',$compare_right)->where('limit_minus','>=',$compare_left)->where('limit_plus','>=',$compare_right)->where('limit_plus','>=',$compare_left);  

                }

            } // Condition For No Tint  
            else {
                $lens_data->where('color_type_id', $lens_color_id);
// Condition For Reading Vision      
                if ($vision_data->vision_type == "Reading") {
                    if ($add_right == "") {
                        $compare_right = $sph_right + $cyl_right;
                    } else {
                        $compare_right = $sph_right + $cyl_right + $add_right;
                    }

                    if ($add_left == "") {
                        $compare_left = $sph_left + $cyl_left;
                    } else {
                        $compare_left = $sph_left + $cyl_left + $add_left;
                    }


                    $compare_right = number_format($compare_right, 2);
                    $compare_left = number_format($compare_left, 2);

                    if ($compare_right > 0) {
                        $lens_data->whereRaw("(limit_plus_val >= $compare_right)")->whereRaw("(sph_plus_val >= REPLACE($sph_right,'+',''))");
                        if ($cyl_right > 0) {
                            $lens_data->whereRaw("(min_cyl <= '$cyl_right' AND max_cyl >= '$cyl_right')");
                        } else {
                            $lens_data->whereRaw("(min_cyl >= '$cyl_right' AND max_cyl >= '$cyl_right')");
                        }
                    } else {
                        if ($compare_right == "0.00") {
                            $lens_data->whereRaw("(limit_minus <= $compare_right AND limit_plus >= $compare_right)");
                        } else {
                            $lens_data->whereRaw("(limit_minus_val >= REPLACE($compare_right,'-',''))");
                        }

                        if ($sph_right == "0.00") {
                            $lens_data->whereRaw("(min_sph <= $sph_right AND max_sph >= $sph_right)");
                        } else {
                            $lens_data->whereRaw("(sph_minus_val >= REPLACE($sph_right,'-',''))");
                        }

                        if ($cyl_right == "0.00") {
                            $lens_data->whereRaw("(min_cyl <= $cyl_right AND max_cyl >= $cyl_right)");
                        } else {
                            if ($sph_right > 0) {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_right' AND max_cyl >= '$cyl_right')");
                            } else {
                                $lens_data->whereRaw("(min_cyl >= REPLACE('$cyl_right','+','-') AND max_cyl >= REPLACE('$cyl_right','+','-'))");
                            }
                        }

                    }

                    if ($compare_left > 0) {
                        $lens_data->whereRaw("(limit_plus_val >= $compare_left)")->whereRaw("(sph_plus_val >= REPLACE($sph_left,'+',''))");
                        if ($cyl_left > 0) {
                            $lens_data->whereRaw("(min_cyl <= '$cyl_left' AND max_cyl >= '$cyl_left')");
                        } else {
                            $lens_data->whereRaw("(min_cyl >= '$cyl_left' AND max_cyl >= '$cyl_left')");
                        }

                    } else {
                        if ($compare_left == "0.00") {
                            $lens_data->whereRaw("(limit_minus <= $compare_left AND limit_plus >= $compare_left)");
                        } else {
                            $lens_data->whereRaw("(limit_minus_val >= REPLACE($compare_left,'-',''))");
                        }


                        if ($sph_left == "0.00") {
                            $lens_data->whereRaw("(min_sph <= $sph_left AND max_sph >= $sph_left)");
                        } else {
                            $lens_data->whereRaw("(sph_minus_val >= REPLACE($sph_left,'-',''))");
                        }

                        if ($cyl_left == "0.00") {
                            $lens_data->whereRaw("(min_cyl <= $cyl_left AND max_cyl >= $cyl_left)");
                        } else {
                            if ($sph_left > 0) {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_left' AND max_cyl >= '$cyl_left')");
                            } else {
                                $lens_data->whereRaw("(min_cyl >= REPLACE('$cyl_left','+','-') AND max_cyl >= REPLACE('$cyl_left','+','-'))");
                            }

                        }

                    }

                    //$lens_data->where('limit_minus','>=',$compare_right)->where('limit_minus','>=',$compare_left)->where('limit_plus','>=',$compare_right)->where('limit_plus','>=',$compare_left);     

                } else if ($vision_data->vision_type == "Bifocal" || $vision_data->vision_type == "Progressive") {

// Condition For Bifocal       
                    $compare_right = $sph_right + $cyl_right;
                    $compare_left = $sph_left + $cyl_left;

                    $compare_right = number_format($compare_right, 2);
                    $compare_left = number_format($compare_left, 2);

                    if ($compare_right > 0) {
                        $lens_data->whereRaw("(limit_plus_val >= $compare_right)")->whereRaw("(sph_plus_val >= REPLACE($sph_right,'+',''))");
                        if ($cyl_right > 0) {
                            $lens_data->whereRaw("(min_cyl <= '$cyl_right' AND max_cyl >= '$cyl_right')");
                        } else {
                            $lens_data->whereRaw("(min_cyl >= '$cyl_right' AND max_cyl >= '$cyl_right')");
                        }

                        if ($add_right != "") {
                            $lens_data->whereRaw("(min_add <= '$add_right' AND max_add >= '$add_right')");
                        }

                    } else {
                        if ($compare_right == "0.00") {
                            $lens_data->whereRaw("(limit_minus <= $compare_right AND limit_plus >= $compare_right)");
                        } else {
                            $lens_data->whereRaw("(limit_minus_val >= REPLACE($compare_right,'-',''))");
                        }

                        if ($sph_right == "0.00") {
                            $lens_data->whereRaw("(min_sph <= $sph_right AND max_sph >= $sph_right)");
                        } else {
                            $lens_data->whereRaw("(sph_minus_val >= REPLACE($sph_right,'-',''))");
                        }

                        if ($cyl_right == "0.00") {
                            $lens_data->whereRaw("(min_cyl <= $cyl_right AND max_cyl >= $cyl_right)");
                        } else {
                            if ($sph_right > 0) {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_right' AND max_cyl >= '$cyl_right')");
                            } else {
                                $lens_data->whereRaw("(min_cyl >= REPLACE('$cyl_right','+','-') AND max_cyl >= REPLACE('$cyl_right','+','-'))");
                            }
                        }

                        if ($add_right != "") {
                            $lens_data->whereRaw("(min_add <= '$add_right' AND max_add >= '$add_right')");
                        }

                    }

                    if ($compare_left > 0) {
                        $lens_data->whereRaw("(limit_plus_val >= $compare_left)")->whereRaw("(sph_plus_val >= REPLACE($sph_left,'+',''))");
                        if ($cyl_left > 0) {
                            $lens_data->whereRaw("(min_cyl <= '$cyl_left' AND max_cyl >= '$cyl_left')");
                        } else {
                            $lens_data->whereRaw("(min_cyl >= '$cyl_left' AND max_cyl >= '$cyl_left')");
                        }

                        if ($add_left != "") {
                            $lens_data->whereRaw("(min_add <= '$add_left' AND max_add >= '$add_left')");
                        }

                    } else {
                        if ($compare_left == "0.00") {
                            $lens_data->whereRaw("(limit_minus <= $compare_left AND limit_plus >= $compare_left)");
                        } else {
                            $lens_data->whereRaw("(limit_minus_val >= REPLACE($compare_left,'-',''))");
                        }


                        if ($sph_left == "0.00") {
                            $lens_data->whereRaw("(min_sph <= $sph_left AND max_sph >= $sph_left)");
                        } else {
                            $lens_data->whereRaw("(sph_minus_val >= REPLACE($sph_left,'-',''))");
                        }

                        if ($cyl_left == "0.00") {
                            $lens_data->whereRaw("(min_cyl <= $cyl_left AND max_cyl >= $cyl_left)");
                        } else {
                            if ($sph_left > 0) {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_left' AND max_cyl >= '$cyl_left')");
                            } else {
                                $lens_data->whereRaw("(min_cyl >= REPLACE('$cyl_left','+','-') AND max_cyl >= REPLACE('$cyl_left','+','-'))");
                            }

                        }

                        if ($add_left != "") {
                            $lens_data->whereRaw("(min_add <= '$add_left' AND max_add >= '$add_left')");
                        }

                    }

                    //$lens_data->where('limit_minus','>=',$compare_right)->where('limit_minus','>=',$compare_left)->where('limit_plus','>=',$compare_right)->where('limit_plus','>=',$compare_left); 

                } else {
// Condition For Other Distance Vision       
                    $compare_right = $sph_right + $cyl_right;
                    $compare_left = $sph_left + $cyl_left;

                    $compare_right = number_format($compare_right, 2);
                    $compare_left = number_format($compare_left, 2);

                    if ($compare_right > 0) {
                        $lens_data->whereRaw("(limit_plus_val >= $compare_right)")->whereRaw("(sph_plus_val >= REPLACE($sph_right,'+',''))");
                        if ($cyl_right > 0) {
                            $lens_data->whereRaw("(min_cyl <= '$cyl_right' AND max_cyl >= '$cyl_right')");
                        } else {
                            if ($cyl_right != "0.00") {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_right' AND max_cyl >= '$cyl_right')");
                            }
                        }
                    } else {
                        if ($compare_right == "0.00") {
                            $lens_data->whereRaw("(limit_minus <= $compare_right AND limit_plus >= $compare_right)");
                        } else {
                            $lens_data->whereRaw("(limit_minus_val >= REPLACE($compare_right,'-',''))");
                        }

                        if ($sph_right == "0.00") {
                            $lens_data->whereRaw("(min_sph <= $sph_right AND max_sph >= $sph_right)");
                        } else {
                            $lens_data->whereRaw("(sph_minus_val >= REPLACE($sph_right,'-',''))");
                        }

                        if ($cyl_right == "0.00") {
                            $lens_data->whereRaw("(min_cyl <= $cyl_right AND max_cyl >= $cyl_right)");
                        } else {
                            if ($sph_right > 0) {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_right' AND max_cyl >= '$cyl_right')");
                            } else {
                                $lens_data->whereRaw("(min_cyl >= REPLACE('$cyl_right','+','-') AND max_cyl >= REPLACE('$cyl_right','+','-'))");
                            }
                        }

                    }

                    if ($compare_left > 0) {
                        $lens_data->whereRaw("(limit_plus_val >= $compare_left)")->whereRaw("(sph_plus_val >= REPLACE($sph_left,'+',''))");
                        if ($cyl_left > 0) {
                            $lens_data->whereRaw("(min_cyl <= '$cyl_left' AND max_cyl >= '$cyl_left')");
                        } else {
                            if ($cyl_left != "0.00") {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_left' AND max_cyl >= '$cyl_left')");

                            }
                        }

                    } else {
                        if ($compare_left == "0.00") {
                            $lens_data->whereRaw("(limit_minus <= $compare_left AND limit_plus >= $compare_left)");
                        } else {
                            $lens_data->whereRaw("(limit_minus_val >= REPLACE($compare_left,'-',''))");
                        }


                        if ($sph_left == "0.00") {
                            $lens_data->whereRaw("(min_sph <= $sph_left AND max_sph >= $sph_left)");
                        } else {
                            $lens_data->whereRaw("(sph_minus_val >= REPLACE($sph_left,'-',''))");
                        }

                        if ($cyl_left == "0.00") {
                            $lens_data->whereRaw("(min_cyl <= $cyl_left AND max_cyl >= $cyl_left)");
                        } else {
                            if ($sph_left > 0) {
                                $lens_data->whereRaw("(min_cyl >= '$cyl_left' AND max_cyl >= '$cyl_left')");
                            } else {
                                $lens_data->whereRaw("(min_cyl >= REPLACE('$cyl_left','+','-') AND max_cyl >= REPLACE('$cyl_left','+','-'))");
                            }

                        }

                    }

                    //$lens_data->where('limit_minus','>=',$compare_right)->where('limit_minus','>=',$compare_left)->where('limit_plus','>=',$compare_right)->where('limit_plus','>=',$compare_left);  

                }
            }
        }
        $lens_data = $lens_data->get();

        Session::put('vision_id', $vision_id);
        // return $lens_data;
        //return $compare_right;
        return view('view-lenses', compact('lens_data', 'product_id', 'func_type', 'qty', 'lens_color_id', 'is_tint', 'ip_country'));
    }

    public function add_prescription(Request $request)
    {
        $is_prescription_upload = $request->is_prescription_upload;
        $func_type = $request->func_type;
        if ($is_prescription_upload == "No") {

            $prescription_array = array("sph_right" => $request->sph_right, "sph_left" => $request->sph_left, "cyl_right" => $request->cyl_right, "cyl_left" => $request->cyl_left, "axis_right" => $request->axis_right, "axis_left" => $request->axis_left, "add_right" => $request->add_right, "add_left" => $request->add_left, "pupillary_distance" => $request->pupillary_distance, "pupillary_distance_right" => $request->pupillary_distance_right, "pupillary_distance_left" => $request->pupillary_distance_left, "is_pd2" => $request->is_pd2, "is_prism" => $request->is_prism, "prism_right_vertical" => $request->prism_right_vertical, "prism_right_vertical_direction" => $request->prism_right_vertical_direction, "prism_right_horizontal" => $request->prism_right_horizontal, "prism_right_horizontal_direction" => $request->prism_right_horizontal_direction, "prism_left_vertical" => $request->prism_left_vertical, "prism_left_vertical_direction" => $request->prism_left_vertical_direction, "prism_left_horizontal" => $request->prism_left_horizontal, "prism_left_horizontal_direction" => $request->prism_left_horizontal_direction, "prescription_comment" => $request->prescription_comment);

            Session::put('prescription_array', $prescription_array);
            Session::put('is_prescription_upload', $is_prescription_upload);

        } else {
            $prescription = $request->file('upload_prescription');
            $upload_prescription = rand(100000000, 500000000) . "." . $prescription->getClientOriginalExtension();
            $destinationPath = public_path('/uploaded_files/prescription');
            $prescription->move($destinationPath, $upload_prescription);
            $prescription_id = DB::table('prescription')->insertGetId(['prescription' => $upload_prescription, 'session_id' => Session::get('session_id'), 'date' => date('Y-m-d')]);
            Session::put('prescription_id', $prescription_id);
            Session::put('is_prescription_upload', $is_prescription_upload);
        }
    }

    public function review_cart(Request $request)
    {
        $ip_country = $this->ip_country;
        $coating_ids = $request->coating_ids;
        $func_type = $request->func_type;
        $is_tint = $request->is_tint;
        $lens_id = $request->lens_id;
        $product_id = $request->product_id;
        $qty = $request->qty;
        $lens_color_id = $request->lens_color_id;

        return view('review-cart', compact('func_type', 'lens_id', 'product_id', 'qty', 'lens_color_id', 'is_tint', 'ip_country', 'coating_ids'));
    }

    public function add_lens_cart(Request $request)
    {
        $ip_country = $this->ip_country;
        $coating_ids = $request->coating_ids;
        $product_id = $request->product_id;
        $lens_id = $request->lens_id;
        $func_type = $request->func_type;
        $qty = $request->qty;
        $lens_color_id = $request->lens_color_id;
        $lens_color_data = LensColorType::find($lens_color_id);

        $vision_id = Session::get('vision_id');
        $vision_data = Vision::find($vision_id);
        $prescription_array = Session::get('prescription_array');
        $is_prescription_upload = "No";
        if (Session::has('is_prescription_upload')) {
            $is_prescription_upload = Session::get('is_prescription_upload');
        }
        $lens_detail = Lens::findOrFail($lens_id);

        $product_detail = Category::findOrFail($product_id);
        $color_data = ProductColor::find($product_detail->category_color);
        $frame_price = getCurrencyPrice($ip_country, $product_detail->category_discount_price);
        $lens_price = getCurrencyPrice($ip_country, $lens_detail->price);
//Calculate GST FRAME
        $frame_gst_percent = ($product_detail->category_frame == "Eyeglasses") ? 12 : 18;
        $frame_gst_amount = gst($frame_price, $frame_gst_percent);
        $frame_price += $frame_gst_amount;

//Calculate GST LENS
        $lens_gst_percent = 12;
        $lens_gst_amount = gst($lens_price, $lens_gst_percent);
        $lens_price += $lens_gst_amount;

        $cart = new Cart;
        $cart->product_id = $product_detail->id;
        $cart->product_name = $product_detail->category_name;
        $cart->quantity = $qty;
        $cart->lens_qty = 1;
        $cart->prescription_comment = $prescription_array['prescription_comment'];
        $cart->lens_color_id = $lens_color_id;
        $cart->lens_color_price = getCurrencyPrice($ip_country, $lens_color_data->category_price);
        $cart->price = $frame_price;
        $cart->color = $color_data->color_name;
        $cart->is_tint = $request->is_tint;
        $cart->currency_code = getCurrencyCode($ip_country);
        $cart->currency_symbol = getCurrencySymbol($ip_country);
        if ($prescription_array['is_prism'] == "Yes") {
            $cart->prism_price = getCurrencyPrice($ip_country, $this->admin_data->prism_price);
        } else {
            $cart->prism_price = "0.00";
        }
        if (Auth::guard('user')->check()) {
            $cart->user_email = Auth::guard('user')->user()->email;
        }
        $cart->vision_id = $vision_id;
        $cart->vision_price = getCurrencyPrice($ip_country, $vision_data->vision_price);
        $cart->lens_id = $lens_id;
        $cart->lens_name = $lens_detail->name;
        $cart->lens_price = $lens_price;
        $cart->frame_gst = $frame_gst_amount;
        $cart->lens_gst = $lens_gst_amount;
        $cart->is_prescription_uploaded = $is_prescription_upload;
        $cart->is_power = $vision_data->is_power;
        if ($vision_data->is_power == "Yes") {
            if ($is_prescription_upload == "No") {
                if (!empty($prescription_array['is_prism'])) {
                    $cart->is_prism = $prescription_array['is_prism'];
                } else {
                    $cart->is_prism = 'No';
                }

                $cart->prism_right_vertical = $prescription_array['prism_right_vertical'];
                $cart->prism_right_vertical_direction = $prescription_array['prism_right_vertical_direction'];
                $cart->prism_right_horizontal = $prescription_array['prism_right_horizontal'];
                $cart->prism_right_horizontal_direction = $prescription_array['prism_right_horizontal_direction'];
                $cart->prism_left_vertical = $prescription_array['prism_left_vertical'];
                $cart->prism_left_vertical_direction = $prescription_array['prism_left_vertical_direction'];
                $cart->prism_left_horizontal = $prescription_array['prism_left_horizontal'];
                $cart->prism_left_horizontal_direction = $prescription_array['prism_left_horizontal_direction'];

                $cart->sph_right = $prescription_array['sph_right'];
                $cart->sph_left = $prescription_array['sph_left'];
                $cart->cyl_right = $prescription_array['cyl_right'];
                $cart->cyl_left = $prescription_array['cyl_left'];
                $cart->axis_right = $prescription_array['axis_right'];
                $cart->axis_left = $prescription_array['axis_left'];
                $cart->add_right = $prescription_array['add_right'];
                $cart->add_left = $prescription_array['add_left'];
                $cart->is_pd2 = $prescription_array['is_pd2'];
                if ($prescription_array['is_pd2'] == "Yes") {
                    $cart->pupillary_distance_right = $prescription_array['pupillary_distance_right'];
                    $cart->pupillary_distance_left = $prescription_array['pupillary_distance_left'];
                } else {
                    $cart->pupillary_distance = $prescription_array['pupillary_distance'];
                }


            } else {
                $get_prescription = DB::table('prescription')
                    ->where('id', Session::get('prescription_id'))
                    ->where('session_id', Session::get('session_id'))
                    ->select('prescription')->first();
                $cart->uploaded_prescription = $get_prescription->prescription;

                $get_prescription = DB::table('prescription')
                    ->where('id', Session::get('prescription_id'))
                    ->where('session_id', Session::get('session_id'))->delete();
            }
        }
        $cart->session_id = Session::get('session_id');
        $cart->save();

// Add Coating Cart
        if (!empty($coating_ids)) {
            $coat_price = DB::table('lens_coatings')->where('coating_id', $coating_ids)->first();
            DB::table('cart_coating')->insert([
                'cart_id' => $cart->id,
                'coating_id' => $coating_ids,
                'coating_price' => getCurrencyPrice($ip_country, $coat_price->coating_price),
                'session_id' => Session::get('session_id'),
                'date' => date('Y-m-d')
            ]);

        }
        Session::forget('is_prescription_upload');
        Session::forget('prescription_array');
        return redirect('/cart.html');

    }

    public function update_cart(Request $request)
    {
        $cart_id = $request->id;
        return view('update-cart', compact('cart_id'));
    }

    public function preview_product(Request $request)
    {
        $product_id = $request->product_id;
        $product_detail = Category::find($product_id);
        return view('product-preview', compact('product_detail'));
    }


    public function get_vision_price(Request $request)
    {
        $vision_data = Vision::find($request->vision_id);

        return response()->json(['is_power' => $vision_data->is_power]);
    }

    public function uploadPrescription(Request $request)
    {
        $request->validate([
            "prescription" => "required|max:2000",
            "email" => "required|email"
        ]);
        $prescription = $request->file('prescription');
        $upload_prescription = rand(100000000, 500000000) . "." . $prescription->getClientOriginalExtension();
        $destinationPath = public_path('/uploaded_files/prescription');
        $prescription->move($destinationPath, $upload_prescription);
        DB::table('prescription')->insertGetId(['prescription' => $upload_prescription, 'session_id' => Session::get('session_id'), 'email' => $request->email, 'date' => date('Y-m-d')]);
        return back()->with('success_msg', 'Prescription submitted, we will contact you soon!');
    }

    public function check_prescription(Request $request)
    {
        $product_id = $request->prd_id;
        $sph_right = $request->sph_right;
        $sph_left = $request->sph_left;
        $cyl_right = $request->cyl_right;
        $cyl_left = $request->cyl_left;
        $product_data = Category::find($product_id);

        $prescription_data = Category::where('min_sph', '<', $sph_right)
            ->where('max_sph', '>', $sph_right)
            ->toSql();
        echo $prescription_data;
    }

    public function viewPrescription(Request $request)
    {
        $prescription = Cart::find($request->cart_id);
        return view('view-prescription', compact('prescription'));
    }

}
