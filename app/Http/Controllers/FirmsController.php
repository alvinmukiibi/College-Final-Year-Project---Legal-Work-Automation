<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Firms;
use Webpatser\Countries\Countries;
use App\Practice_groups;

class FirmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $firms = Firms::orderBy('name', 'asc')->paginate(10);

        return view('home.firms')->with("firms", $firms);
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
        // $firm_data = $this->validate($request, [
        //     "name" => "required|max:150",
        //     "email"=>"required|email",
        //     "work_contact"=>"required",
        //     "country"=>"required",
        //     "region"=>"required",
        //     "city"=>"required",
        //     "street_address"=>"required",
            
            
        // ]);

        $count = Firms::where('email', $request->input('email'))->count();
       
        if($count > 0){
            redirect()->action('FirmsController@showRegister')->with("error", "Email Already Exists");
        }

        

        // if(Firms::registerFirm($request)){
        //     return redirect()->back();
        // }

        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $firm = Firms::find($id);

        return view('home.view')->with("firm", $firm);
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
    public function showRegister(){
        $data = [
            "countries" => Countries::getListForSelect()
        ];
       
        return view("ulc.register")->with($data);
    }
}