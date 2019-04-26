<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\User;
use App\DueDiligence;
use App\File;
use App\Task;
use App\Note;
class LegalCase extends Model
{
    protected $table = 'legal_cases';


    public function workedOnBy(){
        return $this->belongsTo(User::class);
    }
    public function duediligences(){
        return $this->hasMany(DueDiligence::class, 'case_id');
    }
    public function documents(){
        return $this->hasMany(File::class, 'case_id');
    }
    public function tasks(){
        return $this->hasMany(Task::class, 'case_id');
    }
    public function notes(){
        return $this->hasMany(Note::class, 'case_id');
    }
    public function proceedings(){
        return $this->hasMany(Proceeding::class, 'case_id');
    }


    public function makeNewIntake(){
        $data = $this->data;
        $caseNumber = $this->generateUniqueCaseNumber();
        $add = DB::table($this->table)->insert(['case_number'=> $caseNumber, 'client' => $this->client, 'staff' => $this->staff, 'case_type' => $data['caseType'], 'date_taken' => $this->date_taken, 'taken_by' => $this->takenBy, 'synopsis' => $data['synopsis'], 'case_status' => $this->status, 'firm' => $this->firm]);

        return DB::getPdo()->lastInsertId();
    }
    public function generateUniqueCaseNumber($length = 7){
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return '200'.$randomString;

    }
    public function getLawyerCases(){
        $user_id = $this->staff;
        $cases = DB::table($this->table)->join('clients', 'legal_cases.client', '=', 'clients.id')->join('case_types', 'case_types.id', '=', 'legal_cases.case_type')->select('clients.name', 'legal_case__staffs.owner','legal_case__staffs.referee1','legal_case__staffs.referee2','legal_case__staffs.assignee', 'legal_cases.*', 'case_types.acronym', 'case_types.casetype')->join('legal_case__staffs', 'legal_case__staffs.case_id', '=', 'legal_cases.id')->where('legal_case__staffs.owner',$user_id)->orWhere('legal_case__staffs.referee1', $user_id)->orWhere('legal_case__staffs.referee2', $user_id)->orWhere('legal_case__staffs.assignee', $user_id)->orderBy('created_at','desc')->get();
        return $cases;

    }
    public function makeCase(){
        $make = DB::table($this->table)->where('case_number', $this->case_number)->update(['case_status' => 'open']);
        return $make;
    }
    public function rejectCase(){
        $reject = DB::table($this->table)->where('case_number', $this->case_number)->update(['case_status' => 'closed-rejected']);
        return $reject;
    }
    public function getCaseClient(){
        $client = DB::table($this->table)->join('clients', 'clients.id', '=', 'legal_cases.client')->where(['legal_cases.case_number' => $this->case_number])->select('clients.*')->get();
        return $client;
    }
    public function checkIfCaseBelongsToFirm(){
        $check = DB::table($this->table)->where(['case_number' => $this->case_number, 'firm' => $this->firm_id])->get();
        $count = $check->count();
        if($count > 0){
            return true;
        }else{
            return false;
        }
    }

    public function closeCase(){
        $data = $this->data;
        $close = DB::table($this->table)->where('case_number', $data['caseID'])->update(['case_status' => 'closed', 'closure_status' => $data['closure'], 'reason_for_closure' => $data['reason']]);
        return $close;
    }
    public function getLawyerOpenCases(){
        $user_id = $this->staff;
        $cases = DB::table($this->table)->where(['legal_cases.staff' => $user_id, 'case_status' => 'open'])->get();
        return $cases;
    }

}
