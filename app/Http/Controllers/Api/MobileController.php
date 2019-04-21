<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LegalCase;
use App\Client;
use App\Meeting;
use App\LegalCase_Staff;
use App\Task;
use App\User;
use App\Note;
use Auth;
use Validator;
use App\Events\MeetingScheduled;
use Illuminate\Http\Response;
class MobileController extends Controller
{
    // pull out all cases belonging to the authenticated user
    // synonymous to CasesController@viewIntakes
    public $statusCode200 = 200;
    public $statusCode422 = 422;
    public $statusCode201 = 201;

    public function getCases(Request $request){

        $case = new LegalCase;
        $case->staff = Auth::user()->id;
        $cases = $case->getLawyerCases();
        $count = $cases->count();
        $res['error'] = false;
        $res['cases'] = $cases;

        return response()->json($res, $this->statusCode200);

    }
    // pull out all information on a single case that has been clicked on
    // synonymous to CasesController@viewCase
    public function getCase(Request $request){
        $case_number = $request->input('case_number');
        $id = LegalCase::where('case_number', $case_number)->value('id');
        $case = LegalCase::find($id);
        $client = Client::find($case->client);
        $meetings = Meeting::where(['attendance' => $case_number])->orderBy('created_at', 'desc')->get();
        $legalCase = new LegalCase;
        $legalCase->id = $id;
        $tasks = $legalCase->tasks()->orderBy('created_at', 'desc')->get();
        $notes = [];

        $data['error'] = false;
        $res['case'] = $case;
        $res['client'] = $client;
        $res['meetings'] = $meetings;
        $res['tasks'] = $tasks;
        $res['notes'] = $notes;

        $data['data'] = $res;

        return response()->json($data, $this->statusCode200);
    }

    // schedule a meeting on a case
    // synonymous to MeetingsController@scheduleCaseMeeting
    public function scheduleMeeting(Request $request){
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'time' => 'required',
            'agenda' => 'required',
            'venue' => 'required|max:255'
        ]);

        if($validator->fails()){
            $res['error'] = true;
            $res['message'] = $validator->errors()->first();
            return response()->json($res, $this->statusCode422);
        }
        $data = [
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'agenda' => $request->input('agenda'),
            'venue' => $request->input('venue'),
            'caseID' => $request->input('caseID'),
        ];

        $meeting = new Meeting;
        $meeting->data = $data;
        $meeting->attendance = $data['caseID']; //all people concerned with this case id

        $data['name'] = "Client Case Number " . $data['caseID'];
        $this->data = $data;
        $caseStaff = new LegalCase_Staff;
        $caseStaff->id = LegalCase::where('case_number', $data['caseID'])->value('id');
        $myRecipients = $caseStaff->getAllStaffonCase();
        foreach($myRecipients as $rec){
            $this->recipients = $rec;
            $this->sendMail();
        }
        $meeting->scheduleCaseMeeting();

        $res['error'] = false;
        $res['message'] = "Meeting successfully Scheduled! Concerned People have been emailed!";

        return response()->json($res, $this->statusCode201);



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

    // add a task on a case
    // synonymous to CasesController@addCaseTask

    public function addCaseTask(Request $request){

        $validator = Validator::make($request->all(), [
            'task' => 'required|max:255',
            'caseID' => 'required|numeric'
        ]);

        if($validator->fails()){
            $res['error'] = true;
            $res['message'] = $validator->errors()->first();
            return response()->json($res, $this->statusCode422);
        }

        $data = [
            'task' => $request->input('task'),
            'caseID' => $request->input('caseID'),
        ];

        $task = new Task;
        $task->task = $data['task'];
        $task->case_id = $data['caseID'];

        $task->createTask();

        $res['error'] = false;
        $res['message'] = "Task Successfully Added!!";

        return response()->json($res, $this->statusCode201);

    }
    // add a note on a case
    // synonymous to CasesController@addCaseNote
    public function addCaseNote(Request $request){
        $validator = Validator($request->all(), [
            'note' => 'required|max:255'
        ]);

        if($validator->fails()){
            $res['error'] = true;
            $res['message'] = $validator->errors()->first();
            return response()->json($res, $this->statusCode422);
        }
        $data = [
            'note' => $request->input('note'),
            'caseID' => $request->input('caseID'),
        ];


        $note = new Note;
        $note->note = $data['note'];
        $note->case_id = $data['caseID'];

        $note->createNote();

        $res['error'] = false;
        $res['message'] = "Note Successfully Added!!";

        return response()->json($res, $this->statusCode201);

    }


    public function logout()
    {
        User::where(['id' => Auth::user()->id])->update(['online_status' => 'offline']);
        auth('web')->logout();
        $res['error'] = false;
        $res['message'] = "User Session Killed!!";
        return response()->json($res, $this->statusCode200);
    }
}
