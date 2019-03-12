<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'id','amount','LegalCase_id','balance','extra_information'
    ];

    protected  $casts = [
        'extra_information' => 'array'
    ];



    public function legalCase()
    {
        return $this->belongsTo(LegalCase::class,"LegalCase_id");
    }


    public function paymentDetails()
    {
        return $this->morphMany(PaymentDetails::class, 'commentable');
    }
}
