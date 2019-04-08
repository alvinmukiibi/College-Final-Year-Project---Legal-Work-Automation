<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Firm;
class WebsiteController extends Controller
{
    /*public function showWebsite(Request $request){
        $site = Firm::where(['firm_id'=>auth()->user()->firm_id])->get();
        //dd($site);
        return view('firm.admin.website')->with("website", $site);
    }
*/
    public function showWebsite(Request $request){
        $user = auth()->user();
        if($user->user_role=="administrator"){
            return view("firm.admin.website")->with('user', $user);
        }else if($user->user_role=="Associate"){
            $user->dept = Department::find($user->department);
            return view("firm.associate.profile")->with('user', $user);
        }

    }

    public function savelawfirmProfile(Request $request){
        return view("firm.admin.website");
    }
}
