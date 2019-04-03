<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseProceeding extends Model
{
    protected $table ='case_proceedings';
    protected $fillable = ['id','case_id','date','time','court','user_id'];

    public function LegalCase()
    {
        return $this->belongsTo(LegalCase::class,'user_id');
    }

    public function importantdates()
    {
        return $this->hasMany(importantdates::class,'legalcase_id');
    }

    public function Resoultion()
    {
        return $this->hasMany(resolution::class,'legalcase_id');
    }
}
