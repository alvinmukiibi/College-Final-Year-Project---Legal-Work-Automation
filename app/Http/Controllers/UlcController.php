<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
class UlcController extends Controller
{
    public function showLogin()
    {
        return view("login");
    }
    public function doLogin(Request $request)
    {
        //handle login

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|alphaNum|min:8'
        ]);

        $userdata = array(
            'email' => $request->get('email'),
            'password' => $request->get('password')
        );

        if(Auth::attempt($user_data)){
            return redirect('/dashboard');
        }else{
            return back()->with('error', 'Wrong Login Details');
        }
       
    }
}
