<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    public function setRQA(){

        return DB::table($this->table)->insert(['requisition_critical_amount' => $this->rqa, 'firm_id' => $this->firm_id]);


    }

    public function getSettings(){

        return DB::table($this->table)->where(['firm_id' => $this->firm_id])->get();

    }

    public function updateRQA(){

        return DB::table($this->table)->where(['firm_id' => $this->firm_id])->update(['requisition_critical_amount' => $this->rqa]);

    }


}
