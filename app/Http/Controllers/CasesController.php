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
use App\File;
use App\Note;
use App\Task;
use App\Proceeding;
use App\LegalCase_Staff;
use App\Department;
use App\Meeting;
use App\Time;
use App\Payment;
use App\Lawyer_Case;
use App\Events\CaseShared;
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

           $case_id = $case->makeNewIntake();

           $case_staff = new LegalCase_Staff;
           $case_staff->case_id = $case_id;
           $case_staff->ownCase();

           $rec = new Lawyer_Case;
           $rec->lawyer = $staff;

           $check = $rec->checkLawyerCases();

           if($check !== false){
                $newValue = $check + 1;
                $rec->newValue = $newValue;
                $rec->incrementValue();
           }else{
                $rec->addRecord();

           }


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
        $id = LegalCase::where('case_number', $request->segment(4))->value('id');
        $case = LegalCase::find($id);
        $caseType = CaseType::find($case->case_type);
        $client = Client::find($case->client);
        $staff = User::find($case->staff);
        $dd = new DueDiligence;
        $dd->case_id = $case->case_number;
        $diligences = $dd->getCaseDueDiligences();

        $doc = new File;
        $doc->case_id = $request->segment(4);
        $docs = $doc->getCaseDocuments();

        $legalCase = new LegalCase;
        $legalCase->id = $id;
        $tasks = $legalCase->tasks()->orderBy('created_at', 'desc')->get();
        // $proc = new Proceeding;
        // $proceedings = $proc->testProc();
        $notes = $legalCase->notes()->orderBy('created_at')->get();

        $proceedings = $legalCase->proceedings()->orderBy('created_at', 'desc')->get();
        $staffCase = new LegalCase_Staff;
        $staffCase->id = $id;
        $staff_on_case = $staffCase->getAllStaffonCase();

        $owner = null; $referee1 = null; $referee2 = null; $assignee = null;
        if(!empty($staff_on_case['owner'])){
            $owners = $staff_on_case['owner'];
            foreach($owners as $own){
                $owner = $own->fname . ' ' . $own->lname;
            }
        }
        if(!empty($staff_on_case['referee1'])){
            $referees = $staff_on_case['referee1'];
            foreach($referees as $referee){
                $referee1 = $referee->fname . ' ' . $referee->lname;
            }
        }
        if(!empty($staff_on_case['referee2'])){
            $referees = $staff_on_case['referee2'];
            foreach($referees as $referee){
                $referee2 = $referee->fname . ' ' . $referee->lname;

            }
        }
        if(!empty($staff_on_case['assignee'])){
            $assignees = $staff_on_case['assignee'];
            foreach($assignees as $assign){
                $assignee = $assign->fname . ' ' . $assign->lname;

            }
        }
        $staff_on_the_case = [
            'owner' => $owner,
            'referee1' => $referee1,
            'referee2' => $referee2,
            'assignee' => $assignee
        ];

        $meetings = Meeting::where(['attendance' => $request->segment(4)])->orderBy('created_at', 'desc')->get();
        $firm_id = Firm::where(['firm_id' => auth()->user()->firm_id])->value('id');
        $time = new Time;
        $time->case_id = $id;
        $time->firm_id = $firm_id;
        $totalhrs = $time->countTotalHrs();
        $invoicedhrs = $time->countBilledHrs();
        $remaininghrs = $totalhrs - $invoicedhrs;

        $totalpayment = Payment::where(['case_id' => $id, 'firm_id' => $firm_id ])->sum('amount');

        return view('firm.associate.case')->with(['notes' => $notes, 'totalpayment' => $totalpayment, 'remaininghrs' => $remaininghrs,'staff_on_the_case' => $staff_on_the_case, 'meetings' => $meetings, 'proceedings' => $proceedings, 'case' => $case, 'caseType' => $caseType, 'client' => $client, 'staff' => $staff, 'dds' => $diligences, 'docs' => $docs, 'tasks' => $tasks]);

    }

    public function shareCase(Request $request){
        $case_id = $request->segment(4);
        $case = new LegalCase;
        $case->case_number = $case_id;
        $client = $case->getCaseClient()[0]->name;

        $departments = Department::where(['firm_id' => auth()->user()->firm_id])->get();
        return view('firm.associate.share')->with(['case' => $case_id, 'client' => $client, 'departments' => $departments]);
    }
    public function submitShare(Request $request){
        $data = $this->validate($request, [
            'department' => 'required|numeric',
            'sharingType' => 'required',
            'assignee' => 'required|numeric'
        ]);

        $case_number = $request->input('caseID');
        $case_id = LegalCase::where('case_number', $case_number)->value('id');

        $owner = LegalCase_Staff::where('case_id', $case_id)->value('owner');
        if($data['sharingType'] === 'assign'){
            if($owner !== auth()->user()->id){
                return redirect()->back()->with('error', "You have no rights to assign this case!!");
            }else{
                $assign = new LegalCase_Staff;
                $assign->assignee = $data['assignee'];
                $assign->case_id = $case_id;
                // send email and message to notify assignee of the action

                $assign->assignCase();

                $event = new CaseShared;
                $event->data = $data;
                $event->case_id =  $case_number;
                $event->sharer = auth()->user();
                $event->sharee = User::find($data['assignee']);

                event($event);

                return redirect()->intended('/associate/view/intakes')->with('success', 'Case Number ' . $case_number . ' has been assigned succesfully!!');

            }

        }else{
            // if sharing type is referring
            $refer = new LegalCase_Staff;
            $refer->referee = $data['assignee'];
            $refer->case_id = $case_id;
            $checkRef = $refer->referCase();
            if(!$checkRef){
                return redirect()->back()->with('error', 'Case has already been assigned to the maximum number of people');

            }else if($checkRef == 'same'){
                return redirect()->back()->with('error', 'You cannot refer a case to the same user twice!!');

            }
            return redirect()->back()->with('success', 'Case has been referred to another associate!!');

        }


    }

    public function makeCase(Request $request){

        $case = new LegalCase;
        $case->case_number = $request->segment(4);
        $case->makeCase();

        $rec = new Lawyer_Case;
        $rec->lawyer = auth()->user()->id;
        $rec->addOpenCount();

        return redirect()->back()->with('success', 'INTAKE '. $case->case_number. ' has been made a case!! Congratulations!!');



    }
    public function rejectCase(Request $request){
        $case = new LegalCase;
        $case->case_number = $request->segment(4);
        $case->rejectCase();

        return redirect()->back()->with('error', 'INTAKE '. $case->case_number. ' has been rejected');

    }
    public function storeAndGenerateNewName(){
        $fileName = $this->fileName;
        $request = $this->request;
        if($request->hasFile($fileName) && $request->file($fileName)->isValid()){
            $file = $request->file($fileName);
            $savedTo = 'public'.DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR;
            $originalName = $file->getClientOriginalName();
            $name = pathinfo($originalName, PATHINFO_FILENAME);
            $replaced = \str_replace(' ', '_', $name);
            $newName = $replaced . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs($savedTo, $newName);
            return $newName;
    }else{
        return null;
    }
    }

    public function addDocumentToCase(Request $request){
        $data = $this->validate($request, [
            'name' => 'required|max:255',
            'file' => 'required|mimes:pdf,rtf,jpg,jpeg,png,docx,doc,ppt,pptx,xls,xlsx,txt,mp3,webp,mp4,mkv,zip,rar|max:10240'
        ]);

        $case_id = $request->input('caseID');

        $this->request = $request;
        $this->fileName = 'file';
        $newFileName = $this->storeAndGenerateNewName();

        $file = new File;
        $file->data = $data;
        $file->case_id = $case_id;
        $file->location = $newFileName;

        $file->saveFile();

        return redirect()->back()->with('success', 'Document Saved Successfully!!');



    }
    public function addCaseTask(Request $request){
        $data = $this->validate($request, [
            'task' => 'required|max:255'
        ]);

        $task = new Task;
        $task->task = $data['task'];
        $task->case_id = $request->input('caseID');

        $task->createTask();

        return redirect()->back()->with('success', 'Task Added Successfully!!');


    }
    public function completeTask(Request $request){

        $task = new Task;
        $task->id = $request->segment(4);

        $task->complete();

        return redirect()->back();

    }

    public function addNote(Request $request){
        $data = $this->validate($request, [
            'note' => 'required|max:255'
        ]);

        $note = new Note;
        $note->note = $data['note'];
        $note->case_id = $request->input('caseID');

        $note->createNote();

        return redirect()->back()->with('success', 'Note Added Successfully!!');
    }

    public function viewProceedings(Request $request){
        $case_id = $request->segment(4);
        $case = new LegalCase;
        $case->id = LegalCase::where(['case_number' => $case_id])->value('id');
        $proceedings = $case->proceedings()->orderBy('created_at', 'desc')->get();
        return view('firm.associate.proceedings')->with(['case' => $case_id, 'proceedings' => $proceedings]);

    }
    public function addProceeding(Request $request){
        $data = $this->validate($request, [
            'date_of_proceeding' => 'required|date',
            'description' => 'required',
            'outcome' => 'required|max:255',
            'court' => 'required|max:255',
            'date_of_next_proceeding' => 'required|date',
            'caseID' => 'required|numeric'
        ]);

        $proceeding = new Proceeding;
        $proceeding->data = $data;
        $proceeding->case_id = LegalCase::where('case_number', $data['caseID'])->value('id');
        $proceeding->addProceeding();

        return redirect()->back()->with('success', 'Proceeding Recorded!!');


    }
    public function countAllCases(Request $request){
        $case = new LegalCase;
        $case->staff =  $request->input('id');
        $cases = $case->getLawyerCases()->count();
        return response()->json(['count' => $cases]);
    }
    public function countOpenCases(Request $request){
        $case = new LegalCase;
        $case->staff =  $request->input('id');
        $cases = $case->getLawyerOpenCases()->count();
        return response()->json(['count' => $cases]);
    }
    public function closeCase(Request $request){

        $data = $this->validate($request, [
            'closure' => 'required',
            'reason' => 'max:255|nullable',
            'caseID' => 'required',
        ]);

        $case = new LegalCase;
        $case->data = $data;

        $case->closeCase();

        // we want to update the cases_staff table and subtract 1 from everyone who was seeing the case

        $rec = new Lawyer_Case;
        $rec->closer = auth()->user()->id;
        $rec->case_id = LegalCase::where('case_number', $data['caseID'])->value('id');
        $rec->decrementRecords();

        return redirect()->back()->with('success', 'Case has been closed!!');




    }



}
