<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Firm;
class CaseType extends Model
{
    protected $table = 'case_types';

    public function firm(){
        return $this->belongsTo(Firm::class, 'firm_id');
    }

}
