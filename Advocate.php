<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advocate extends Model
{
    protected $table = 'advocates';
    protected $fillable =['id','name','case_no'];

    public function legalcase()
    {
        return $this->hasMany(legalcase::class,'');
    }
}
