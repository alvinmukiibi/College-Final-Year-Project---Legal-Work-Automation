<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\legalCase;
class Task extends Model
{
    protected $table = 'tasks';

    public function legalCase(){
        return $this->belongsTo(LegalCase::class);
    }

    public function createTask(){
        return DB::table($this->table)->insert(['task' => $this->task, 'case_id' => $this->case_id]);
    }
    public function complete(){
        return DB::table($this->table)->where(['id' => $this->id])->update(['status' => 'done']);

    }
}
