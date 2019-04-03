<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DueDeligence extends Model
{
    protected  $table ='due_deligences';

    protected  $fillable = [
      'id','case_id','user_id','information','date'
    ];

    public function  user()
    {
        $this->belongsTo(User::class,'user_id');
    }

    public function  case()
    {
        $this->belongsTo(LegalCase::class,'case_id');
    }
}
