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

        return $add;
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

        $cases = DB::table($this->table)->join('clients', 'legal_cases.client', '=', 'clients.id')->join('users', 'users.id', '=', 'legal_cases.staff')->join('case_types', 'case_types.id', '=', 'legal_cases.case_type')->select('clients.name', 'legal_cases.*', 'case_types.type', 'case_types.description')->where('users.id', auth()->user()->id)->get();
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
}
