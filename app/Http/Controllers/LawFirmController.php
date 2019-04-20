<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Firm;
use App\User;

class LawFirmController extends Controller
{

    public function verifyEmail(Request $request){


            $token = $request->segment(4);

        if(Firm::where('uuid', $token)->update(["verification_flag" => "verified"])){

            $values = Firm::select('firm_id','email','password','uuid')->where(['uuid'=>$token,'verification_flag'=>'verified'])->get();

            foreach($values as $value){
                $newUser = new User;
                $newUser->firm_id = $value->firm_id;
                $newUser->email = $value->email;
                $newUser->password = $value->password;
                $newUser->identification_token = $value->uuid;
                $newUser->user_role = "administrator";
                $newUser->account_status = "inactive";
                $newUser->profile_pic = "default_user.jpg";
                $newUser->save();

            }


            return redirect()->intended("login");



        }



        return redirect()->intended("login");
       // return response()->json(["error" => false, "message" => "Email Verified successfully"]);
        // return response(["error" => false, "message" => "Email Verified successfully"], 200)->header("Content-Type","application/json");

            // return response()->json(["error" => true, "message" => "Bad Request"]);

    }


}
