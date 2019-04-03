<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    public function __construct(){

    }

    public function showProfile(Request $request){
        $user = auth()->user();
        return view("firm.admin.profile")->with('user', $user);
    }
    public function saveAdminProfile(Request $request){
        $data = $this->validate($request, [
            "firstName"=>"required|max:150",
            "lastName"=>"required|max:150",
            "contact"=>"required|max:15",
            "profilePicture"=>"mimes:jpeg,jpg,gif,png,webp"
        ]);

       $user = new User;
       $user->userData = $data;
       $save = $user->saveAdminProfile();
       if($save){
            return redirect()->back()->with("success", "Profile Saved Successfully");
       }else{
        return redirect()->back()->with("error", "Failed to Save");
       }

    }
}

