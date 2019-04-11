<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DueDiligence extends Model
{
    protected  $table ='due_diligences';

    public function addDueDiligence(){
        $data = $this->data;
        $add = DB::table($this->table)->insert(['description' => $data['description'], 'date_carried_out' => $data['date_carried_out'], 'case_id' => $this->case_id ]);
        return DB::getPdo()->lastInsertId();

    }
    public function getCaseDueDiligences(){
        //$dds = DB::table($this->table)->join('files', 'due_diligences.case_id', '=', 'files.case_id')->select('files.location','due_diligences.*')->where('due_diligences.case_id', $this->case_id)->get();
        $dds = DB::table($this->table)->where('case_id', $this->case_id)->get();
        return $dds;
    }
}
