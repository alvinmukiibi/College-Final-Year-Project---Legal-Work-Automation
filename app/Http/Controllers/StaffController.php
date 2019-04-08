<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Department;
use App\Role;
use Ramsey\Uuid\Uuid;
use App\Events\UserRegistered;
class StaffController extends Controller
{
    public function showStaff(Request $request){
        $user = new User;

        $staff = $user->getAllStaffExceptMe();
        $departments = Department::where(['firm_id'=>auth()->user()->firm_id])->get();
        $roles = Role::where(['firm_id'=>auth()->user()->firm_id])->get();

        return view('firm.admin.staff')->with(['staff'=>$staff, 'departments'=>$departments, 'roles'=>$roles]);
    }
    public function addStaff(Request $request){

        $data = $this->validate($request, [
            "firstName"=> 'required|max:255',
            "lastName"=> 'required|max:255',
            "email"=> 'required|unique:users|email',
            "phone"=> 'required|numeric',
            "gender"=> 'required',
            "department"=> 'required',
            "role"=> 'required'

        ]);
        $user = new User;
        //generate OTP and persist it for this user
        $users_otp = $user->generateOtp();


         //
        $user->data = $data;
        $user->profile_pic = 'default_user.jpg';
        $user->account_status = 'inactive';
        $user->verification_status = 'unverified';
        $user->firm_id = auth()->user()->firm_id;
        $user->password = $users_otp;
        $user->id_token = Uuid::uuid1()->toString();

        //persist user otp
        $persistOtp = $user->persistOtp();
        if(!$persistOtp){
            return  redirect()->intended('/admin/manage/staff')->with("error", "Failed to generate OTP for the user");
        }

        //send confirmation email with otp embedded
        $email_data = [
            "name" => $data['firstName'],
            "email" => $data['email'],
            "otp" => $users_otp,
            "token" => $user->id_token,
        ];
        event(new UserRegistered($email_data));

        //register the user
        $added = $user->addStaff();


        if($added){
            return redirect()->intended('/admin/manage/staff')->with("success", "User Added Succesfully");
        }else{
            return redirect()->intended('/admin/manage/staff')->with("error", "Failed to add");
        }




    }
    public function activateStaff(Request $request){
        $user = new User;
        $user->id = $request->segment(4);
        $done = $user->activateStaff();
        if($done){
            return redirect()->back()->with("success", "Successfully Activated!!");
        }else{
            return redirect()->back()->with("error", "Failed to activate");
        }
    }
    public function deactivateStaff(Request $request){
        $user = new User;
        $user->id = $request->segment(4);
        $done = $user->deactivateStaff();
        if($done){
            return redirect()->back()->with("success", "Successfully Deactivated!!");
        }else{
            return redirect()->back()->with("error", "Failed to deactivate");
        }
    }
    public function verifyEmail(Request $request){
        $identifier = $request->segment(4);

        $user = new User;
        $user->identifier = $identifier;
        $verified = $user->verifyEmail();

        if($verified){
            return redirect()->intended("login")->with("info", "Your email has been verified");
        }else{
            return redirect()->intended("login")->with("error", "Email verification failed");
        }


    }
}
