<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Firm;
use App\LegalCase;
use App\Invoice;
use PDF;
use App\Events\SendReceiptToClient;
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

        // check if the paidfor field contains and invoice number for an invoice thats unpaid
        // then change its status to paid

        $invoice = new Invoice;
        $invoice->invoice_no = $data['paidfor'];
        $invoice->case_id = $data['caseID'];
        $invoice->amount = $data['amount'];
        $check = $invoice->checkIfInvoiceExistsAndItHasPendingPayments();
        if($check){
            $invoice->addPaymentToInvoice();
        }else{
            // invoice exists and it is fully settled or hes not paying for an invoice
            $checkForPaid = $invoice->checkIfInvoiceExistsAndItIsFullySettled();
            if($checkForPaid){
                return redirect()->back()->with('error', 'Invoice '. $data['paidfor']. ' is fully settled, please make payment on something else!!');
            }else{
                // no connection to invoice, just another payment i.e. do nothing
            }
        }

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
    public function getReceiptData($case_number, $payment_ref){
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

        return $data = [
            'firm' => $firm,
            'client' => $client,
            'payment' => $payment,
            'case' => $case
        ];
    }
    public function viewReceipt(Request $request){
        $case_number = $request->segment(4);
        $payment_ref = $request->segment(5);
        $data = $this->getReceiptData($case_number, $payment_ref);
        return PDF::loadView('firm.finance.receipt', ['firm' => $data['firm'], 'client' => $data['client'], 'payment' => $data['payment'], 'case' => $data['case']])->stream($data['payment']->ref. '.pdf');

    }

    public function sendReceipt(Request $request){
        $case_number = $request->segment(4);
        $payment_ref = $request->segment(5);
        $data = $this->getReceiptData($case_number, $payment_ref);

        $event = new SendReceiptToClient;
        $event->data = $data;
        $event->recipient = $data['client']->email;
        $event->attachment = PDF::loadView('firm.finance.receipt', ['firm' => $data['firm'], 'client' => $data['client'], 'payment' => $data['payment'], 'case' => $data['case']]);
        event($event);

        //update payments table to receipted
        $pay = new Payment;
        $pay->ref = $data['payment']->ref;
        $pay->case_id = $data['case']->id;
        $pay->firm_id = $data['firm']->id;

        $pay->markAsReceipted();


        return redirect()->back()->with('success', "Receipt has been successfully sent to the client!! Please confirm with client!!");


    }
}
