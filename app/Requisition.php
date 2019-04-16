<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Firm;

class Requisition extends Model
{
    protected $table = 'requisitions';

    public function requisitor(){
        return $this->belongsTo(User::class);
    }
    public function firm(){
        return $this->belongsTo(Firm::class);
    }
    public function checkForPendingReqs(){
        $check = DB::table($this->table)->where(['requisitor' => $this->requisitor, 'status' => 'pending'])->get();
        $count = $check->count();
        if($count >= 2){
            return true;
        }else{
            return false;
        }
    }

    public function makeRequisition(){
        $data = $this->data;
        $make = DB::table($this->table)->insert(['subject' => $data['subject'], 'reason' => $data['reason'], 'amount' => $data['amount'], 'requisitor' => $this->requisitor, 'supporting_document' => $this->doc, 'firm_id' => $this->firm_id]);
        return $make;
    }

    public function cancelRequisition(){
        $cancel = DB::table($this->table)->where(['id' => $this->id, 'requisitor' => $this->requisitor,'firm_id' => $this->firm_id, 'status' => 'pending'])->update(['status' => 'cancelled']);
        return $cancel;
    }
    public function fetchRequisitions(){
        $reqs = DB::table($this->table)->join('users', 'users.id', '=', 'requisitions.requisitor')->where(['requisitions.firm_id' => $this->firm_id])->whereNotIn('status', ['cancelled'])->select('users.fname','users.lname','requisitions.*')->orderBy('created_at', 'desc')->get();

        return $reqs;
    }
    public function approveRequisition(){

        return DB::table($this->table)->where(['id' => $this->id])->update(['status' => 'approved','status_updated_by' => $this->updator]);

    }
    public function markAsServed(){

        return DB::table($this->table)->where(['id' => $this->id])->update(['status' => 'served', 'status_updated_by' => $this->server]);

    }
    public function declineRequisition(){
        $data = $this->data;
        return DB::table($this->table)->where(['id' => $data['reqID']])->update(['status' => 'declined','status_updated_by' => $this->declinor, 'reason_for_update' => $data['reason']]);

    }
    public function submitRequisition(){

        return DB::table($this->table)->where(['id' => $this->id])->update(['status' => 'submitted','status_updated_by' => $this->submittor]);

    }
    public function fetchPartnerRequisitions(){

        $reqs = DB::table($this->table)->join('users', 'users.id', '=', 'requisitions.requisitor')->where(['status' => 'submitted', 'requisitions.firm_id' => $this->firm_id])->orWhere(['status_updated_by' => $this->partner])->select('users.fname', 'users.lname', 'requisitions.*')->orderBy('created_at', 'desc')->get();
       return $reqs;

    }
}
