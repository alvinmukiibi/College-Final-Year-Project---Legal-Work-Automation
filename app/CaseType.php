<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Firm;
use Illuminate\Support\Facades\DB;
class CaseType extends Model
{
    protected $table = 'case_types';

    public function firm(){
        return $this->belongsTo(Firm::class, 'firm_id');
    }
    public function addCaseType(){
        $data = $this->data;
        return DB::table($this->table)->insert(['casetype' => $data['casetype'], 'acronym' => $data['acronym'], 'firm_id' => $this->firm_id ]);
    }
    public function saveCaseType(){
        $type = $this->type;
        return DB::table($this->table)->where('id', $type['id'])->update(['casetype' => $type['casetype'], 'acronym' => $type['acronym']]);

    }

}
