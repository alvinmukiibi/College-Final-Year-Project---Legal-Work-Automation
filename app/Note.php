<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\legalCase;

class Note extends Model
{
    protected $table = 'notes';

    public function legalCase(){
        return $this->belongsTo(LegalCase::class);
    }

    public function createNote(){
        return DB::table($this->table)->insert(['note' => $this->note, 'case_id' => $this->case_id]);
    }
}
