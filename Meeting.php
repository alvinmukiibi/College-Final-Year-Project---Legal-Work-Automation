<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $table = 'meetings';

    protected  $fillable = [
      'id','date','agenda','venue','category','outcome','description','user_id'
    ];

    protected  $casts = [
        'outcome' => 'array'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
