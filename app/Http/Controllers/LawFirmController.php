<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Firms;
use App\User;

class LawFirmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function verifyEmail(Request $request){


            $token = $request->segment(4);

        if(Firms::where('uuid', $token)->update(["verification_flag" => "verified"])){

            $values = Firms::select('firm_id','email','password','uuid')->where(['uuid'=>$token,'verification_flag'=>'verified'])->get();

            foreach($values as $value){
                $newUser = new User;
                $newUser->firm_id = $value->firm_id;
                $newUser->email = $value->email;
                $newUser->password = $value->password;
                $newUser->identification_token = $value->uuid;
                $newUser->user_role = "administrator";
                $newUser->account_status = "inactive";
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
