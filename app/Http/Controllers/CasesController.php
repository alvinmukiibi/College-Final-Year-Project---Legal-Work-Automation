<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CasesController extends Controller
{
    public function showIntakeForm(Request $request){
        return view('firm.associate.intake');
    }
}
