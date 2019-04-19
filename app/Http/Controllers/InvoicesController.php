<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Firm;
use App\LegalCase;
use PDF;
use App\Events\SendInvoiceToClient;

class InvoicesController extends Controller
{
    public function viewInvoices(Request $request){
        $case_number = $request->segment(4);
        $invoice = new Invoice;
        $invoice->case_id = LegalCase::where(['case_number' => $case_number])->value('id');
        $invoice->firm_id = Firm::where(['firm_id' => auth()->user()->firm_id])->value('id');
        $invoices = $invoice->getCaseInvoices();

        return view('firm.associate.invoices')->with(['invoices' => $invoices, 'case_number' => $case_number]);


    }
    public function makeInvoice(Request $request){
        if($request->input('choice') == '1'){
            $data = $this->validate($request, [
                'amount' => 'required|numeric',
                'reason' => 'required|max:100'
            ]);
            $data['time'] = null;
            $data['rate'] = null;

        }else{
            $data = $this->validate($request, [
                'time' => 'required',
                'rate' => 'required|numeric',
                'total' => 'required'
            ]);
            $data['amount'] = $data['total'];
            $data['reason'] = "Time Billing";

        }


        $invoice = new Invoice;
        $invoice->data = $data;
        $invoice->case_id = $request->input('caseID');
        $invoice->invoicer = auth()->user()->id;
        $invoice->firm_id = Firm::where(['firm_id' => auth()->user()->firm_id])->value('id');

        $invoice->makeInvoice();


        return redirect()->back()->with('success', 'Invoiced Created!!');

    }
    public function getInvoiceData($case_number, $invoice_no){
        $case_id = LegalCase::where('case_number', $case_number)->value('id');

        $firm = Firm::where('firm_id', auth()->user()->firm_id)->first();

        $case = new LegalCase();
        $case->case_number = $case_number;
        $client = $case->getCaseClient()->first();

        $inv = new Invoice;
        $inv->invoice_no = $invoice_no;
        $inv->case_id = $case_id;
        $invoice = $inv->getInvoiceInfo();

        $case = LegalCase::find($case_id);

        return $data = [
            'firm' => $firm,
            'client' => $client,
            'invoice' => $invoice,
            'case' => $case
        ];
    }

    public function printInvoice(Request $request){
        $case_number = $request->segment(4);
        $invoice_no = $request->segment(5);
        $data = $this->getInvoiceData($case_number, $invoice_no);

        return PDF::loadView('firm.associate.invoice', ['firm' => $data['firm'], 'client' => $data['client'], 'invoice' => $data['invoice'], 'case' => $data['case']])->stream($data['invoice']->invoice_no. '.pdf');

    }
    public function manageInvoices(Request $request){
        $invoice = new Invoice;
        $invoice->firm_id = Firm::where(['firm_id' => auth()->user()->firm_id])->value('id');
        $invoices = $invoice->fetchAllInvoices();

        return view('firm.finance.invoices')->with(['invoices' => $invoices]);
    }
    public function sendInvoice(request $request){
        $case_number = $request->segment(4);
        $invoice_no = $request->segment(5);
        $data = $this->getInvoiceData($case_number, $invoice_no);

        $event = new SendInvoiceToClient;
        $event->data = $data;
        $event->recipient = $data['client']->email;
        $event->attachment = PDF::loadView('firm.associate.invoice', ['firm' => $data['firm'], 'client' => $data['client'], 'invoice' => $data['invoice'], 'case' => $data['case']]);
        event($event);

        //update invoices table to sent
        $inv = new Invoice;
        $inv->invoice_no = $data['invoice']->invoice_no;
        $inv->case_id = $data['case']->id;
        $inv->firm_id = $data['firm']->id;

        $inv->markAsInvoiced();

        return redirect()->back()->with('success', "Invoice " . $invoice_no . " has been successfully sent to the client!! Please confirm with client!!");

    }
}
