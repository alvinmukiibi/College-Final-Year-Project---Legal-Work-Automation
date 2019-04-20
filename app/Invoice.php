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
        return DB::table($this->table)->insert(['invoice_no' => $invoice_no, 'rate' => $data['rate'], 'time' => $data['time'], 'amount' => $data['amount'], 'balance' => $data['amount'], 'reason' => $data['reason'], 'invoicer' => $this->invoicer, 'case_id' => $this->case_id, 'firm_id' => $this->firm_id]);

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
    public function checkIfInvoiceExistsAndItHasPendingPayments(){
        $invoice =  DB::table($this->table)->where(['invoice_no' => $this->invoice_no, 'case_id' => $this->case_id, 'status' => 'unpaid'])->orWhere(['status' => 'partpaid'])->orWhere(['status' => 'invoiced'])->get();
        $count = $invoice->count();
        if($count > 0){
            return true;
        }else{
            return false;
        }
    }
    public function checkIfInvoiceExistsAndItIsFullySettled(){
        $invoice =  DB::table($this->table)->where(['invoice_no' => $this->invoice_no, 'case_id' => $this->case_id, 'status' => 'paid'])->get();
        $count = $invoice->count();
        if($count > 0){
            return true;
        }else{
            return false;
        }
    }
    public function addPaymentToInvoice(){
        $moneyBeingPaid = $this->amount;
        $originalBalance = DB::table($this->table)->where(['invoice_no' => $this->invoice_no, 'case_id' => $this->case_id])->value('balance');
        $sumOfFormerPayments = DB::table('payments')->where(['paid_for' => $this->invoice_no, 'case_id' => $this->case_id])->sum('amount');
        if($sumOfFormerPayments == 0){
            // if no former payments
            if($moneyBeingPaid < $originalBalance){
                $balance = $originalBalance - $moneyBeingPaid;
                return DB::table($this->table)->where(['invoice_no' => $this->invoice_no, 'case_id' => $this->case_id])->update(['status' => 'partpaid', 'balance' => $balance]);
            }else{
                $balance = $originalBalance - $moneyBeingPaid;
                return DB::table($this->table)->where(['invoice_no' => $this->invoice_no, 'case_id' => $this->case_id])->update(['status' => 'paid', 'balance' => $balance]);
            }
        }else{
            // with some former payments
            $newBalance = DB::table($this->table)->where(['invoice_no' => $this->invoice_no, 'case_id' => $this->case_id])->value('balance');
            if($moneyBeingPaid <= $newBalance){
                $balance = $newBalance - $moneyBeingPaid;
                if($balance == 0){
                    return DB::table($this->table)->where(['invoice_no' => $this->invoice_no, 'case_id' => $this->case_id])->update(['status' => 'paid', 'balance' => $balance]);
                }else{
                    return DB::table($this->table)->where(['invoice_no' => $this->invoice_no, 'case_id' => $this->case_id])->update(['status' => 'partpaid', 'balance' => $balance]);
                }
            }else{
                // client is paying more than his balance on the invoice
                $balance = $newBalance - $moneyBeingPaid;
                return DB::table($this->table)->where(['invoice_no' => $this->invoice_no, 'case_id' => $this->case_id])->update(['status' => 'paid', 'balance' => $balance]);
            }


        }

    }
}
