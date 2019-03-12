<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';

    protected $fillable = ['id','file_No','LegalCase_id','description','document'
        ];

    public function LegalCase()
    {
        return $this->belongsTo(LegalCase::class,'LegalCase_id');
    }
}
