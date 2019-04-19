<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Invoice extends Model
{
    protected $table = 'invoices';

    public function makeInvoice(){
        $data = $this->data;
        $invoice_no = $this->generateUniqueInvoiceNumber();
        return DB::table($this->table)->insert(['invoice_no' => $invoice_no, 'rate' => $data['rate'], 'time' => $data['time'], 'amount' => $data['amount'], 'reason' => $data['reason'], 'invoicer' => $this->invoicer, 'case_id' => $this->case_id, 'firm_id' => $this->firm_id]);

    }
    public function getCaseInvoices(){

        $invoices = DB::table($this->table)->join('users', 'users.id', '=', 'invoices.invoicer')->where(['invoices.case_id' => $this->case_id, 'invoices.firm_id' => $this->firm_id])->select('users.fname', 'users.lname','invoices.*')->orderBy('invoices.created_at', 'desc')->get();

        return $invoices;

    }
    public function getInvoiceInfo(){
        $invoice = DB::table($this->table)->join('users', 'users.id', '=', 'invoices.invoicer')->where(['case_id' => $this->case_id, 'invoice_no' => $this->invoice_no])->select('users.fname', 'users.lname', 'invoices.*')->first();
        return $invoice;
    }
    public function fetchAllInvoices(){
        $invoices = DB::table($this->table)->join('users', 'invoices.invoicer', '=', 'users.id')->join('legal_cases', 'invoices.case_id', '=', 'legal_cases.id')->where('invoices.firm_id', $this->firm_id)->select('legal_cases.case_number', 'users.fname', 'users.lname', 'invoices.*')->orderBy('invoices.created_at', 'desc')->get();
        return $invoices;
    }
    public function markAsInvoiced(){
        $mark = DB::table($this->table)->where(['invoice_no' => $this->invoice_no, 'case_id' => $this->case_id, 'firm_id' => $this->firm_id])->update(['status' => 'invoiced']);

        return $mark;
    }
    public function generateUniqueInvoiceNumber($length = 8){
        $characters = '0123456ABCDEFGHI';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
