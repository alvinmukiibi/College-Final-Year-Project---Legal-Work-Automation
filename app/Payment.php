<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Payment extends Model
{
    protected $table = 'payments';

    public function recordPayment(){
        $data = $this->data;
        $ref = $this->generatePaymentReference();
        $rec = DB::table($this->table)->insert(['case_id' => $data['caseID'] ,'ref' => $ref, 'amount' => $data['amount'], 'paid_by' => $data['paidby'], 'paid_for' => $data['paidfor'], 'date_of_payment' => $data['date'], 'received_by' => $this->receivedBy, 'firm_id' => $this->firm_id ]);
        return $rec;
    }
    public function fetchCasePayments(){

        $payments = DB::table($this->table)->join('users', 'payments.received_by', '=', 'users.id')->where(['case_id' => $this->case_id])->select('payments.*', 'users.fname', 'users.lname')->orderBy('created_at', 'desc')->get();
        return $payments;
    }

    public function fetchAllPayments(){

        $allPayments = DB::table($this->table)->join('users', 'payments.received_by', '=', 'users.id')->join('legal_cases', 'payments.case_id', '=', 'legal_cases.id')->where('payments.firm_id',$this->firm_id)->select('legal_cases.case_number', 'users.fname', 'users.lname', 'payments.*')->orderBy('payments.created_at', 'desc')->get();
        return $allPayments;
    }
    public function getPaymentInfo(){
        $info = DB::table($this->table)->join('users', 'users.id', '=', 'payments.received_by')->where(['ref' => $this->ref, 'case_id' => $this->case_id])->select('users.fname','users.lname','payments.*')->get();
        return $info;
    }
    public function markAsReceipted(){
        $mark = DB::table($this->table)->where(['ref' => $this->ref, 'case_id' => $this->case_id, 'firm_id' => $this->firm_id])->update(['status' => 'receipted']);

        return $mark;

    }
    public function generatePaymentReference($length = 6){
        $characters = '0123456789ABC';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
