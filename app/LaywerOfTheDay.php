<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaywerOfTheDay extends Model
{
    protected $table = 'laywer_of_the_days';
    protected $fillable = ['user_id', 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
