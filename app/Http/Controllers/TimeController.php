<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Time;
use App\Firm;
use App\LegalCase;
class TimeController extends Controller
{
    public function addEntry(Request $request){
        $data = [];
        if($request->input('choice') == 1){
            $data = $this->validate($request, [
                'time' => 'required|numeric',
                'event' => 'required',
                'caseID' => 'required'
            ]);
        }else{
            $data = $this->validate($request, [
                'from' => 'required',
                'to' => 'required',
                'event' => 'required',
                'caseID' => 'required'
            ]);
            $time_in_seconds = strtotime($data['to']) - strtotime($data['from']);
            $time_in_hours = $time_in_seconds / 3600;

            $data['time'] = $time_in_hours;
        }

        $case_number = LegalCase::where(['id' => $data['caseID']])->value('case_number');

        $entry = new Time;
        $entry->event = $data['event'];
        $entry->time = $data['time'];
        $entry->case_id = $data['caseID'];
        $entry->addedBy = auth()->user()->id;
        $entry->firm_id = Firm::where(['firm_id' => auth()->user()->firm_id])->value('id');

        $entry->addEntry();

        return redirect()->intended('/associate/view/times/'.$case_number)->with('success', "Time Entry Added!!");

    }
    public function viewEntries(Request $request){
        $case_number = $request->segment(4);
        $time = new Time;
        $time->case_id = LegalCase::where(['case_number' => $case_number])->value('id');
        $time->firm_id = Firm::where(['firm_id' => auth()->user()->firm_id])->value('id');
        $entries = $time->getAllTimeEntriesOnCase();

        $totalhrs = $time->countTotalHrs();
        $invoicedhrs = $time->countBilledHrs();

        return view('firm.associate.times')->with(['entries' => $entries, 'totalhrs' => $totalhrs, 'invoicedhrs' => $invoicedhrs]);


    }
}
