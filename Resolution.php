<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resolution extends Model
{
    protected $table = 'resolutions';
    protected $fillable =['id','name'];

    public function caseproceedings()
    {
        return $this->belongsTo(caseproceedings::class,'legalcase_id');
    }

}
