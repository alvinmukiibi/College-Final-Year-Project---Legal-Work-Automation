<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $table = 'times';

    public function addEntry(){
        return DB::table($this->table)->insert(['time' => $this->time, 'event' => $this->event, 'case_id' => $this->case_id, 'added_by' => $this->addedBy, 'firm_id' => $this->firm_id]);

    }
    public function getAllTimeEntriesOnCase(){
        $entries = DB::table($this->table)->join('users', 'users.id', '=', 'times.added_by')->where(['times.case_id' => $this->case_id, 'times.firm_id' => $this->firm_id])->select('users.fname', 'users.lname', 'times.*')->orderBy('times.created_at', 'desc')->get();
        return $entries;
    }
    public function countTotalHrs(){
        $hrs = DB::table($this->table)->where(['case_id' => $this->case_id, 'firm_id' => $this->firm_id])->sum('time');
        return $hrs;

    }
    public function countBilledHrs(){
        $invoicedhrs = DB::table('invoices')->where(['reason' => 'Time Billing', 'case_id' => $this->case_id, 'firm_id' => $this->firm_id])->sum('time');

        return $invoicedhrs;


    }
}
