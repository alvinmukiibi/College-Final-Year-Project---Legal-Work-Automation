<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DueDiligence extends Model
{
    protected  $table ='due_diligences';

    public function legalcase(){
        return $this->belongsTo(LegalCase::class, 'case_id', 'case_number');
    }

    public function addDueDiligence(){
        $data = $this->data;
        $add = DB::table($this->table)->insert(['description' => $data['description'], 'date_carried_out' => $data['date_carried_out'], 'case_id' => $this->case_id, 'file1' => $this->file1, 'file2' => $this->file2, 'file3' => $this->file3, 'file4' => $this->file4  ]);
        return DB::getPdo()->lastInsertId();

    }
    public function getCaseDueDiligences(){
        $dds = DB::table($this->table)->where('case_id', $this->case_id)->get();
        return $dds;
    }
}
