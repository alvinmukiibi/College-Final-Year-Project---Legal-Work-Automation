<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CaseType;
use App\Firm;
class CaseTypesController extends Controller
{
    public function viewCaseTypes(Request $request){
        $firm = new Firm;
        $firm->firm_id = auth()->user()->firm_id;
        $caseTypes = $firm->caseTypes()->orderBy('created_at', 'desc')->get();
        return view('firm.admin.casetypes')->with(['casetypes' => $caseTypes]);
    }
    public function addCaseType(Request $request){

        $data = $this->validate($request, [
        'casetype' => 'required|max:100',
        'acronym' => 'required|max:4'
        ]);
        $casetype = new CaseType;
        $casetype->data = $data;
        $casetype->firm_id = auth()->user()->firm_id;

        $casetype->addCaseType();

        return redirect()->back()->with('success', 'Case Type Added!!');

    }

    public function getCaseType(CaseType $casetype){
        return redirect()->back()->with('casetype', $casetype);
    }
    public function editCaseType(Request $request){
        $data = $this->validate($request, [
            'casetype' => 'required|max:100',
            'acronym' => 'required|max:4'
        ]);


        $type = [
            'casetype' => $data["casetype"],
            'acronym' => $data["acronym"],
            'id' => $request->input('id'),
        ];

        $casetype = new CaseType;
        $casetype->type = $type;
        $edited = $casetype->saveCaseType();
        if($edited){
            return redirect()->back()->with("success", "Updated Successfully");
        }else{
            return redirect()->back()->with("error", "Failed to Edit");
        }
    }

}
