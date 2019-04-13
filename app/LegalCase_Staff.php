<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class LegalCase_Staff extends Model
{
    protected $table = 'legal_case__staffs';

    public function ownCase(){
        return DB::table($this->table)->insert(['case_id' => $this->case_id, 'owner' => auth()->user()->id]);
    }
    public function assignCase(){
        return DB::table($this->table)->where('case_id', $this->case_id)->update(['assignee' => $this->assignee]);
    }
}
