<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Department;
class StaffController extends Controller
{
    public function showStaff(Request $request){
        $user = new User;
        

        $staff = $user->getAllStaffExceptMe();
        //$departments = Department::where(['firm_id'=>auth()->user()->firm_id])->get();
        
        return view('firm.admin.staff')->with(['staff'=>$staff]);
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
        //generate OTP for this user
        $users_otp = $user->generateOtp();

        //send confirmation email with otp embedded
        
        $user->data = $data;
        $user->account_status = 'inactive';
        $user->verification_status = 'unverified';
        $user->firm_id = auth()->user()->firm_id;
        $user->password = $users_otp;
       
        //register the user
        $added = $user->addStaff();

        if($added){
            return redirect()->intended('/admin/manage/staff')->with("success", "User Added Succesfully");
        }else{
            return redirect()->intended('/admin/manage/staff')->with("error", "Failed to add");
        }




    }
}