<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'id','name','contact','address','email','organisation','profile','user_id'
    ];

    protected  $casts = [
        'profile' => 'array'
    ];


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    public function LegalCase()
    {
        return $this->belongsToMany(LegalCase::class,'case_clients','client_id','legalCase_id');
    }

}
