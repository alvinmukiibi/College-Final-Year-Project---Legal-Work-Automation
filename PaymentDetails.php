<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentDetails extends Model
{
    protected $table = 'payment_details';

    protected  $fillable = [
        'id','payment_id','total_amount','balance','description','commentable_id','commentable_type','amount_paid'
    ];

    public function commentable()
    {
        return $this->morphTo();
    }

}
