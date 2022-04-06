<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin_model\Admin;
use Illuminate\Support\Facades\Hash;
use Auth;

class ManageUserController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(){
        $users = (Auth::user()->admin_type=="SuperAdmin") ? Admin::where('admin_type','!=','SuperAdmin')->orderBy('admin_type','asc')->get() : Admin::where('admin_type','SubAdmin')->where('id','!=',Auth::user()->id)->get();
        return view('admin.manage-users',compact('users'));
    }

    public function update_user_status(Request $request){
        $users_id = $request->user_ids;
        $request_for = $request->req_for;
        Admin::whereIn('id', $users_id)->update([
            'admin_status' => $request_for
        ]);
        $sess_msg = "Selected User(s) Status Updated...";

        return redirect("/admin/manage-users")->with('user_msg_status',$sess_msg);
    }

    public function add_user(Request $request){
        $request->validate([
            'admin_name' => 'required',
            'admin_email' => 'required|email|unique:admins,email',
            'admin_mobile' => 'required|numeric|digits:10',
            'admin_password' => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
            'admin_roles' => 'required'
        ]);

        // Convert 'Admin Roles' Array into String.
        $admin_roles = implode(',',$request->admin_roles);

         Admin::create([
             'admin_name' => $request->admin_name,
             'email' => $request->admin_email,
             'admin_mobile' => $request->admin_mobile,
             'password' => Hash::make($request->admin_password),
             'admin_roles' => $admin_roles,
             'admin_type'  => $request->admin_type
         ]);

         return redirect('/admin/manage-users')->with('user_msg_status','User added successfully...');

    }

    public function edit_user(Request $request){
        $users = (Auth::user()->admin_type=="SuperAdmin") ? Admin::where('admin_type','!=','SuperAdmin')->orderBy('admin_type','asc')->get() : Admin::where('admin_type','SubAdmin')->get();
        $edit_user  = Admin::findOrFail($request->id);
        return view('admin.manage-users',compact('users','edit_user'));
    }

    public function update_user(Request $request){
        $update_user = Admin::findOrFail($request->id);
        $request->validate([
            'admin_name' => 'required',
            'admin_email' => 'required|email|unique:admins,email,'.$update_user->id,
            'admin_mobile' => 'required|numeric:digits:10',
            'admin_roles' => 'required'
        ]);

        // Convert 'Admin Roles' Array into String.
        $admin_roles = implode(',',$request->admin_roles);

        $update_user->admin_name = $request->admin_name;
        $update_user->email = $request->admin_email;
        $update_user->admin_mobile = $request->admin_mobile;
        $update_user->admin_roles = $admin_roles;
        $update_user->admin_type = $request->admin_type;
        $update_user->update();

       return redirect('/admin/manage-users')->with('user_msg_status','User updated successfully...');
    }

    public function delete_user(Request $request){
         $user = Admin::find($request->id);
         $user->delete();
    }

    public function change_password(Request $request){

        //GET OLD PASSWORD FROM DB
        $admin_pass = Admin::findOrFail($request->id);
        $old_pass = $admin_pass->password;

         /*$uppercase_old_pass = preg_match('@[A-Z]@', $request->old_password);
         $lowercase_old_pass = preg_match('@[a-z]@', $request->old_password);
         $number_old_pass    = preg_match('@[0-9]@', $request->old_password);*/

         $uppercase_new_pass = preg_match('@[A-Z]@', $request->new_password);
         $lowercase_new_pass = preg_match('@[a-z]@', $request->new_password);
         $number_new_pass    = preg_match('@[0-9]@', $request->new_password);

         $uppercase_confirm_pass = preg_match('@[A-Z]@', $request->confirm_password);
         $lowercase_confirm_pass = preg_match('@[a-z]@', $request->confirm_password);
         $number_confirm_pass    = preg_match('@[0-9]@', $request->confirm_password);

          /*if(!$uppercase_old_pass || !$lowercase_old_pass || !$number_old_pass || strlen($request->old_password) < 8) {echo 0;}

          else if(!Hash::check($request->old_password, $old_pass))
          {echo 1;}*/

          if(!$uppercase_new_pass || !$lowercase_new_pass || !$number_new_pass || strlen($request->new_password) < 8) {echo 2;}

          else if($request->old_password==$request->new_password)
          {echo 3;}

          else if(!$uppercase_confirm_pass || !$lowercase_confirm_pass || !$number_confirm_pass || strlen($request->confirm_password) < 8) {echo 4;}

          else if($request->new_password!=$request->confirm_password)
          {echo 5;}

          else{
            Admin::where("id",$request->id)->update(["password" => Hash::make($request->new_password)]);
              echo 6;
          }

    }


}
