<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Webpatser\Countries\Countries;
use App\Client;
use App\LegalCase;
class CasesController extends Controller
{
    public function showIntakeForm(Request $request){
        $countries = new Countries;
        $data = [
            "countries" => $countries->getListForSelect()
        ];
        return view('firm.associate.intake')->with(['countries' => $data['countries']]);
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


        $case = new LegalCase;






    }
}
