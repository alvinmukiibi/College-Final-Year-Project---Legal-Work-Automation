<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Proceeding;

class ImportantDate extends Model
{
    protected $table = 'important_dates';

    public function proceeding()
    {
        return $this->belongsTo(Proceeding::class);
    }
}
