<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function showWebsite(Request $request){
        return view('firm.admin.website');
    }
}
