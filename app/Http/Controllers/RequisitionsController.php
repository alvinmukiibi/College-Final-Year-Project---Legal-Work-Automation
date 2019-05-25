<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requisition;
use App\User;
use App\Firm;
use App\Setting;
class RequisitionsController extends Controller
{
    public function viewRequisitions(Request $request){
        $user = new User;
        $user->id = auth()->user()->id;
        $requisitions = $user->requisitions()->orderBy('created_at', 'desc')->get();
        return view('firm.associate.requisitions')->with(['requisitions' => $requisitions]);
    }
    public function makeRequisition(Request $request){
        $data = $this->validate($request, [
             'amount' => 'required|numeric',
             'subject' => 'required|max:100',
             'reason' => 'max:255|nullable',
             'supportingDocument' => 'mimes:pdf,doc,docx,xlsx,xls,ppt,pptx,jpeg,jpg,png,webp,bmp,txt|max:10240|nullable'
        ]);

        $req = new Requisition;
        $req->requisitor = auth()->user()->id;

        $check = $req->checkForPendingReqs();
        if($check){
            return redirect()->back()->with('error', 'You have 2 pending requisitions!! Ensure they are cleared first before you make another');
        }else{

            $this->request = $request;
            $this->fileName = 'supportingDocument';
            $doc = $this->storeAndGenerateNewName();

            $req->data = $data;
            $req->doc = $doc;
            $req->firm_id = Firm::where('firm_id',auth()->user()->firm_id)->value('id');

            $req->makeRequisition();
        }

        return redirect()->back()->with('success', 'Requisition Sent!! Wait for feedback');

    }
    public function cancelRequisition(Request $request){

        $req = new Requisition;
        $req->id = $request->segment(4);
        $req->requisitor = auth()->user()->id;
        $req->firm_id = Firm::where('firm_id',auth()->user()->firm_id)->value('id');

        $cancel = $req->cancelRequisition();

        if($cancel){
            return redirect()->back()->with('success', 'Requsition has been cancelled!!');
        }else{
            return redirect()->back()->with('error', 'Requisition Cancelling failed!!');
        }

    }

    public function manageRequisitions(Request $request){

        $req = new Requisition;
        $req->firm_id = Firm::where('firm_id', auth()->user()->firm_id)->value('id');

        $requisitions = $req->fetchRequisitions();
        $rqa = Setting::where(['firm_id' => $req->firm_id])->value('requisition_critical_amount');
        return view('firm.finance.requisitions')->with(['requisitions' => $requisitions, 'rqa' => $rqa]);

    }
    public function approveRequisition(Request $request){

        $req = new Requisition;
        $req->id = $request->segment(4);
        $req->updator = auth()->user()->id;

        $req->approveRequisition();

        return redirect()->back()->with('success', 'Requisition Approved!!');


    }
    public function markAsServed(Request $request){
        $req = new Requisition;
        $req->id = $request->segment(4);
        $req->server = auth()->user()->id;

        $req->markAsServed();

        return redirect()->back()->with('success', 'Requisition Served!!');
    }

    public function declineRequisition(Request $request){
        $data = $this->validate($request, [
            'reason' => 'required|max:255',
            'reqID' => 'required|numeric'
        ]);

        $req = new Requisition;
        $req->data = $data;
        $req->declinor = auth()->user()->id;

        $req->declineRequisition();

        return redirect()->back()->with('success', 'Requisition Declined!!');
    }

    public function submitRequisition(Request $request){

        $req = new Requisition;
        $req->id = $request->segment(4);
        $req->submittor = auth()->user()->id;

        $req->submitRequisition();

        return redirect()->back()->with('success', 'Requisition Submitted To Partners For Consideration!!');
    }

    public function partnerManageRequisitions(Request $request){
        $req = new Requisition;
        $req->partner = auth()->user()->id;
        $req->firm_id = Firm::where(['firm_id' => auth()->user()->firm_id])->value('id');

        $requisitions = $req->fetchPartnerRequisitions();
        return view('firm.partner.requisitions')->with(['requisitions' => $requisitions]);
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

}
