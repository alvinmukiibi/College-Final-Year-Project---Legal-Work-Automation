<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

class AuthController extends Controller

{
    public function showLogin()
    {
        return view("login");
    }
    public function doLogin(Request $request)
    {


        //handle login

        /* 
            validate the data that comes in the request (i.e. POST request)
            after validating, the array containing the indexes is stored in the variable $user_data which is
            then passed to the attempt() method of the Auth facade to login the user
        */
        $user_data = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|alphaNum|min:8'
        ]);


        if (Auth::attempt($user_data)) {
            return redirect('/dashboard');
        } else {
            return redirect()->back()->with('error', 'Wrong Login Details');
        }
    }
    public function dashboard()
    {
        if (auth()->guest()) {
            return redirect()->route("login");
        }
        return view('dashboard')->with('user', auth()->user());
    }
    public function logout()
    {
        Auth::logout();
    }
}