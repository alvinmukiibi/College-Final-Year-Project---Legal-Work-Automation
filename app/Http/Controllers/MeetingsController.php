<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meeting;
use App\User;
use App\Firm;
use App\LegalCase_Staff;
use App\LegalCase;
use App\Events\MeetingScheduled;
class MeetingsController extends Controller
{
    public function showMeetings(Request $request){

        $meetings = Meeting::where(["scheduledBy"=>auth()->user()->id])->get();

        return view('firm.meetings')->with(['meetings'=>$meetings]);
    }
    public function scheduleMeeting(Request $request){

        $data = $this->validate($request, [
            'name' => 'required|max:50',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'venue' => 'required',
            'agenda' => 'required',
            'attendee' => 'required'
        ]);
        //if attendee field is a string, we dont create a row in the meetingattendees table
        //according to string value, get those staff and notify them

        $this->data = $data;
        $this->notifyAccordingToAttendance();

        $meeting = new Meeting;
        $meeting->scheduledBy = auth()->user()->id;
        $meeting->firm_id = auth()->user()->firm_id;
        $meeting->data = $data;

        $scheduled = $meeting->scheduleMeeting();
        if($scheduled){
            return redirect()->back()->with("success", "Meeting Scheduled successfully");
        }else{
            return redirect()->back()->with("error", "Failed, Please retry");
        }
    }

    public function notifyAccordingToAttendance(){
        $attendance = $this->data['attendee'];
        $firm = new Firm;
        $firm->id = auth()->user()->firm_id;
        if($attendance == 'all'){
            //fetch all staff except the admins
            $allUsers = $firm->user()->where(['account_status'=>'active'])->get();
            $this->recipients = $allUsers;
            $this->sendMail();


        }else if($attendance == 'all_assoc'){
            //fetch all associates in the law firm
            $allAssocs = $firm->user()->where(['user_role'=>'Associate','account_status'=>'active'])->get();
            $this->recipients = $allAssocs;
            $this->sendMail();
        }else if($attendance == 'all_assoc_in_dept'){
            //fetch all associates in the dept
            $allAssocsInDept = $firm->user()->where(['user_role' => 'Associate','department' => auth()->user()->department, 'account_status'=>'active'])->get();
            $this->recipients = $allAssocsInDept;
            $this->sendMail();
        }else if($attendance == 'all_part'){
            //fetch all partners in the firm
            $allPart = $firm->user()->where(['user_role'=>'Partner', 'account_status'=>'active'])->get();
            $this->recipients = $allPart;
            $this->sendMail();
        }else{
            //if specified, not yet

        }
    }
    public function sendMail(){
        //send a meeting notification to each of the users specified as attendee
        foreach($this->recipients as $recipient){
            $event = new MeetingScheduled;
            $event->details = $this->data;
            $event->recipient = $recipient;
            $event->sender = auth()->user()->fname . " " . auth()->user()->lname;
            event($event);
        }
    }
    public function scheduleCaseMeeting(Request $request){
        $data = $this->validate($request, [
            'date' => 'required|date',
            'time' => 'required',
            'agenda' => 'required',
            'venue' => 'required|max:255'
        ]);

        $meeting = new Meeting;
        $meeting->data = $data;
        $meeting->attendance = $request->input('caseID'); //all people concerned with this case id

        $data['name'] = "Client Case Number " . $request->input('caseID');
        $this->data = $data;
        $caseStaff = new LegalCase_Staff;
        $caseStaff->id = LegalCase::where('case_number', $request->input('caseID'))->value('id');
        $myRecipients = $caseStaff->getAllStaffonCase();
        foreach($myRecipients as $rec){
            $this->recipients = $rec;
            $this->sendMail();
        }
        $meeting->scheduleCaseMeeting();

        return redirect()->back()->with('success', 'Meeting has been sheduled, Attendees shall be informed');


    }
}
