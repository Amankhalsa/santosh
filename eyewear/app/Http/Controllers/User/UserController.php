<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;
use Auth;
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(){
        $states = DB::table('states')->get();
        $countries = DB::table('countries')->get();
        $shipping_address = DB::table('shipping_address')->where('user_id',Auth::guard('user')->user()->id)->first();
        return view('user.shipping-address',compact('shipping_address','states','countries'));
    }

    public function profile()
    {
        $dial_codes = DB::table('countries')->select(['phonecode','name'])->get();
        $states = DB::table('states')->get();
        $countries = DB::table('countries')->get();
        return view('user.profile',compact('dial_codes','states','countries'));
    }

    public function orders(){
       $orders = DB::table('orders')->where('order_user_id',Auth::guard('user')->user()->id)->get();
       return view('user.orders',compact('orders'));
    }

    public function change_password_form(Request $request){
        return view('user.change-password');
    }

     // Function for change password

    public function change_password(Request $request){
        // Fetch logged in user id
           $id=Auth::guard('user')->user()->id;
           $pass=Auth::guard('user')->user()->password;

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
            return back()->with('pass_err','Old Password is Invalid');
        }else{
            User::where("id",$id)->update(['password' => Hash::make($request->new_password)]);
            return back()->with('success','Password updated successfully...!');
        }

     }

    //For fetching states
    public function getStates(Request $request)
    {
     $states = DB::table("states")
            ->where("country_id",$request->cid)
            ->pluck("name","id");
     return response()->json($states);
    }

    public function update_user(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email,'.Auth::guard('user')->user()->id,
            'mobile' => 'required|numeric|unique:users,mobile,'.Auth::guard('user')->user()->id
        ]);

    User::where('id',Auth::guard('user')->user()->id)->update([
        'name' => $request->name,
        'email' => $request->email,
        'dial_code' => $request->dial_code,
        'mobile' => $request->mobile,
        'city' => $request->city,
        'pincode' => $request->pincode,
        'state' => $request->state,
        'country' => $request->country,
        'address' => $request->address,
        'address2' => $request->address2
    ]);    

    return back()->with('success','Your details updated successfully...!');

    }

    public function track_your_order(Request $request){
        $order = DB::table('orders')->where('id',$request->order_id)->first();
        return view('track-order',compact('order'));
    }

    public function shipping_address(){
        $states = DB::table('states')->get();
        $countries = DB::table('countries')->get();
        $shipping_address = DB::table('shipping_address')->where('user_id',Auth::guard('user')->user()->id)->first();
        return view('user.shipping-address',compact('shipping_address','states','countries'));
    }

    public function addedit_shipping_address(Request $request){
        $request->validate([
            'ship_name' => 'required|string',
            'ship_email' => 'required|string|email',
            'ship_mobile' => 'required|numeric',
            'ship_city' => 'required',
            'ship_pincode' => 'required',
            'ship_address' => 'required',
            'ship_country' => 'required',
            'ship_state' => 'required'
        ]); 

$check_row = DB::table('shipping_address')->where('user_id',Auth::guard('user')->user()->id)->count();
   if($check_row>0){
      DB::table('shipping_address')->where('user_id',Auth::guard('user')->user()->id)->update([
        'ship_name' => $request->ship_name,
        'ship_email' => $request->ship_email,
        'ship_mobile' => $request->ship_mobile,
        'ship_city' => $request->ship_city,
        'ship_pincode' => $request->ship_pincode,
        'ship_state' => $request->ship_state,
        'ship_country' => $request->ship_country,
        'ship_address' => $request->ship_address,
        'ship_address2' => $request->ship_address2
    ]); 
   }else{
            DB::table('shipping_address')->insert([
            'user_id' => Auth::guard('user')->user()->id,
            'ship_name' => $request->ship_name,
            'ship_email' => $request->ship_email,
            'ship_mobile' => $request->ship_mobile,
            'ship_city' => $request->ship_city,
            'ship_pincode' => $request->ship_pincode,
            'ship_state' => $request->ship_state,
            'ship_country' => $request->ship_country,
            'ship_address' => $request->ship_address
    ]);
   }

   return back()->with('success','Shipping address updated...!');

    }
    
}
