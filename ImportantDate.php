<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportantDate extends Model
{
    protected $table = 'important_dates';
    protected $fillable=['id','date','description'];

    public function caseproceedings()
    {
        return $this->belongsTo(caseproceedings::class,'legalcase_id');
    }

}
