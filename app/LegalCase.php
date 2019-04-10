<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class LegalCase extends Model
{
    protected $table = 'legal_cases';


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
}
