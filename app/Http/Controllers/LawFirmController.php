<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Firms;

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
       
        Firms::where('uuid', $token)->update(["verification_flag" => "verified"]);
        //return redirect()->route("firms.login");
        return response()->json(["error" => false, "message" => "Email Verified successfully"]);
        // return response(["error" => false, "message" => "Email Verified successfully"], 200)->header("Content-Type","application/json");
        
            // return response()->json(["error" => true, "message" => "Bad Request"]);
       
    }
}
