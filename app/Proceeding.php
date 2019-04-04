<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\LegalCase;
use App\ImportantDate;
use App\Resolution;
class Proceeding extends Model
{
    protected $table ='proceedings';

    public function legalcase()
    {
        return $this->belongsTo(LegalCase::class);
    }
    public function importantdates()
    {
        return $this->hasMany(ImportantDate::class);
    }
    public function resolutions()
    {
        return $this->hasMany(Resolution::class);
    }
}
