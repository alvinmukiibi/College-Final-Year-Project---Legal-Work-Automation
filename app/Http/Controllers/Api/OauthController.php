<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Validator;

use Illuminate\Http\Request;

class OauthController extends Controller
{
    public $successStatusCode = 200;

    public function login(Request $request){

        if(Auth::attempt(["email" => $request->input('email'), "password" => $request->input('password')]))
        {
            $user = Auth::user();
            //This uses OAuth to issue an access toen to the authenticated user, first arg is the name of the token
            //and the second which is optional can be the array of scopes in which that token shall work fro
            if($user->account_status !== "active"){
                return response()->json(["error" => true, "message" => "Your Account is Inactive, See System Administrator"]);
            }
            $body['token'] = $user->createToken('wat')->accessToken;
            $body['error'] = false;

            if($user->firm_id !== NULL){

                $mobileUser = new User;
                $mobileUser->user = $user;
                $requiresChangeOfPassword = $mobileUser->checkIfRequiresChangeOfPassword();
                if($requiresChangeOfPassword){
                    $body["defaultPassword"] = true;
                    return response()->json($body, $this->successStatusCode);


                }else{
                   $body["defaultPassword"] = false;
                   return response()->json($body, $this->successStatusCode);
                }

            }




        }else{
            return response()->json(["error" => "true", "message" => "Wrong Login Details"], 401);
        }


    }

    public function details(){
        $user = Auth::user();
        return response()->json(["user" => $user], $this->successStatusCode);
    }

}
