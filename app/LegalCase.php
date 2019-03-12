<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LegalCase extends Model
{
    protected $table = 'legal_cases';

    protected $fillable = [
      'id','case_No','category','description','date','user_id', 'amount','proceedings', 'lawyer'
    ];

    protected  $casts = [
        'proceedings' => 'array'
    ];


    public function payments()
    {
        return $this->hasmany(payment::class,'LegalCase_id');
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class,'case_clients','legalCase_id','client_id');
    }

    public function  duedeligences()
    {
        $this->hasMany(DueDeligence::class,'case_id');
    }

}
