<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Department;
use Intervention\Image\ImageManagerStatic as InterventionImage;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function __construct(){

    }

    public function showProfile(Request $request){
        $user = auth()->user();
        if($user->user_role=="administrator"){
            return view("firm.admin.profile")->with('user', $user);
        }else {
            $user->dept = Department::find($user->department);
            return view("firm.profile")->with('user', $user);
        }

    }
    public function saveUserProfile(Request $request){
        $data = $this->validate($request, [
            "firstName"=>"required|max:150",
            "lastName"=>"required|max:150",
            "contact"=>"required|max:15",
            "profilePicture"=>"mimes:jpeg,jpg,gif,png,webp|dimensions:min_width=100,min_height=100"

        ]);
        $image_name = false;
        if($request->hasFile('profilePicture')){  //if user uploaded a profile picture
            if($request->file('profilePicture')->isValid()){ //if upload was successful
                $file = $request->file('profilePicture');
                $image = InterventionImage::make($file);
                $image->fit(200,200, null, 'center');
                $image_name = str_replace(' ', '_', $data['firstName'].'_'.$data['lastName']).'_'.time().'.'.$file->getClientOriginalExtension();
                $saved_to = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profiles'.DIRECTORY_SEPARATOR.$image_name;
                $image->save($saved_to);

            }else{
                return redirect()->back()->with("error", "File Upload Failed, please retry");
            }
        }

        //if password is being changed
        $password = auth()->user()->password;
        if($request->has('password') && $request->input('password') !== null)
        {
            $validate = $this->validate($request,[
                "password"=> "min:8|confirmed|alpha_num"
            ]);
            $password = Hash::make($validate["password"]);

        }

       $user = new User;
       $user->profilePicture = $image_name ? $image_name : false;
       $user->password = $password;
       $user->userData = $data;
       $save = $user->saveUserProfile();
       if($save){
            return redirect()->back()->with("success", "Profile Saved Successfully");
       }else{
        return redirect()->back()->with("error", "Nothing was changed");
       }

    }
    public function showCalendar(){

        return view('firm.calendar');
    }
}

