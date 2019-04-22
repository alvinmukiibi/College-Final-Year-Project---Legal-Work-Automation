<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Validator;

use Illuminate\Http\Request;

class OauthController extends Controller
{
    public $statusCode200 = 200;
    public $statusCode422 = 422;

    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if($validator->fails()){
            $res['error'] = true;
            $res['message'] = $validator->errors()->first();
            return response()->json($res, $this->statusCode422);
        }

        if(Auth::attempt(["email" => $request->input('email'), "password" => $request->input('password')]))
        {
            $user = Auth::user();
            //This uses OAuth to issue an access token to the authenticated user, first arg is the name of the token
            //and the second which is optional can be the array of scopes in which that token shall work fro
            if($user->account_status !== "active"){
                return response()->json(["error" => true, "message" => "Your Account is Inactive, See System Administrator"]);
            }
            $body['token'] = $user->createToken('wat_login_token')->accessToken;
            $body['error'] = false;

            if($user->firm_id !== NULL){
                if($user->user_role == 'Associate' || $user->user_role == 'Partner'){
                    $mobileUser = new User;
                    $mobileUser->user = $user;
                    $requiresChangeOfPassword = $mobileUser->checkIfRequiresChangeOfPassword();
                    if($requiresChangeOfPassword){
                        $body["defaultPassword"] = true;
                        return response()->json($body, $this->statusCode200);
                    }else{
                       $body["defaultPassword"] = false;
                       return response()->json($body, $this->statusCode200);
                    }
                }else{
                    return response()->json(["error" => "true", "message" => "Please Use the Web version of the Tool"], 401);
                }
            }else{
                return response()->json(["error" => "true", "message" => "Please Use the Web version of the Tool"], 401);
            }
        }else{
            return response()->json(["error" => "true", "message" => "Wrong Login Details"], 401);
        }
    }

    public function getAuthenticatedUser(){
        $user = Auth::user();

        $res['error'] = false;
        $res['user'] = $user;

        return response()->json($res, $this->statusCode200);
    }

}
