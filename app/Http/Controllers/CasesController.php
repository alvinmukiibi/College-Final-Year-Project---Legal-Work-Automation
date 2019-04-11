<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Webpatser\Countries\Countries;
use App\Client;
use App\LegalCase;
use App\User;
use App\Firm;
use App\CaseType;
use App\DueDiligence;
class CasesController extends Controller
{
    public function showIntakeForm(Request $request){
        $countries = new Countries;
        $data = [
            "countries" => $countries->getListForSelect()
        ];
        $firm = new Firm;
        $firm->firm_id = auth()->user()->firm_id;
        $caseTypes = $firm->caseTypes;
        return view('firm.associate.intake')->with(['countries' => $data['countries'], 'caseTypes' => $caseTypes]);
    }
    public function makeIntake(Request $request){
        $data = $this->validate($request, [
            'caseType' => 'required',
            'clientName' => 'required',
            'nationality' => 'required',
            'dob' => 'date|nullable',
            'nin' => 'numeric|nullable',
            'email' => 'required|email',
            'city' => 'required',
            'district' => 'required',
            'country' => 'required',
            'address' => 'required',
            'work_no' => 'numeric|nullable',
            'mobile_no' => 'required|numeric',
            'home_no' => 'required|numeric',
            'synopsis' => 'required|min:20',
            'maritalStatus' => 'nullable'
        ]);

        $currentDate = date('d-m-Y', time());
        $staff = auth()->user()->id;
        $takenBy = auth()->user()->user_role;


        $client = new Client;
        $client->data = $data;
        $client->firm_id = auth()->user()->firm_id;
        $clientID = $client->createNewClient();
        if($clientID){

           //create a new case
           $case = new LegalCase;
           $case->data = $data;
           $case->client = $clientID;
           $case->staff = $staff;
           $case->date_taken = $currentDate;
           $case->takenBy = $takenBy;
           $case->status = 'intake';
           $case->firm = auth()->user()->firm_id;

           $case->makeNewIntake();

           return redirect()->back()->with('success', 'New Intake Made Successfully');
        }else{
            return redirect()->back()->with('error', 'Client not created, Please Try Again!!');
        }
    }
    public function viewIntakes(){

        $case = new LegalCase;
        $case->staff = auth()->user()->id;
        $cases = $case->getLawyerCases();
        return view('firm.associate.cases')->with(['cases' => $cases]);
    }

    public function viewCase(Request $request){
        $case = LegalCase::find($request->input('caseID'));
        $caseType = CaseType::find($case->case_type);
        $client = Client::find($case->client);
        $staff = User::find($case->staff);
        $dd = new DueDiligence;
        $dd->case_id = $case->case_number;
        $diligences = $dd->getCaseDueDiligences();

        return view('firm.associate.case')->with(['case' => $case, 'caseType' => $caseType, 'client' => $client, 'staff' => $staff, 'dds' => $diligences]);

    }
    public function makeCase(Request $request){

        $case = new LegalCase;
        $case->case_number = $request->segment(4);
        $case->makeCase();

        return redirect()->intended('/associate/view/intakes/')->with('success', 'INTAKE '. $case->case_number. ' has been made a case!! Congratulations!!');



    }
    public function rejectCase(Request $request){
        $case = new LegalCase;
        $case->case_number = $request->segment(4);
        $case->rejectCase();

        return redirect()->intended('/associate/view/intakes/')->with('error', 'INTAKE '. $case->case_number. ' has been rejected');

    }
}
