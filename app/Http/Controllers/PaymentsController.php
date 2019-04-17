<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Firm;
use App\LegalCase;
class PaymentsController extends Controller
{

    public function viewPayments(Request $request){

        $case = new LegalCase;
        $case->case_number = $request->segment(4);
        $case->firm_id = auth()->user()->firm_id;
        $checkIfCaseBelongsToFirm = $case->checkIfCaseBelongsToFirm();

        if($checkIfCaseBelongsToFirm){
            $payment = new Payment;
            $payment->case_id = LegalCase::where(['case_number' => $request->segment(4)])->value('id');
            $payments = $payment->fetchCasePayments();

            return view('firm.associate.payments')->with(['payments' => $payments]);
        }else{
            redirect()->back()->with('error', 'Sorry!! System Error!!');
        }

    }

    public function recordPayment(Request $request){
        $data = $this->validate($request, [
            'amount' => 'required|numeric',
            'paidfor' => 'required',
            'paidby' => 'required',
            'date' => 'nullable|date',
            'caseID' => 'required|numeric'
        ]);

        $payment = new Payment;
        $payment->data = $data;
        $payment->receivedBy = auth()->user()->id;
        $payment->firm_id = Firm::where(['firm_id' => auth()->user()->firm_id])->value('id');
        $case_number = LegalCase::where('id', $data['caseID'])->value('case_number');
        $payment->recordPayment();

        return redirect()->intended('/associate/view/payments/'.$case_number)->with('success', "Payment Made!! Receipt shall be sent to client");


    }
    public function managePayments(Request $request){

        $payment = new Payment;
        $payment->firm_id = Firm::where(['firm_id' => auth()->user()->firm_id])->value('id');
        $payments = $payment->fetchAllPayments();

        return view('firm.finance.payments')->with(['payments' => $payments]);

    }
    public function viewReceipt(Request $request){
        $case_number = $request->segment(4);
        $payment_ref = $request->segment(5);
        $case_id = LegalCase::where('case_number', $case_number)->value('id');

        $firm = Firm::where('firm_id', auth()->user()->firm_id)->get()[0];

        $case = new LegalCase();
        $case->case_number = $case_number;
        $client = $case->getCaseClient()[0];

        $pay = new Payment;
        $pay->ref = $payment_ref;
        $pay->case_id = $case_id;
        $payment = $pay->getPaymentInfo()[0];

        $case = LegalCase::find($case_id);

        return view('firm.finance.receipt')->with(['firm' => $firm, 'case' => $case, 'client' => $client, 'payment' => $payment]);

    }
}
