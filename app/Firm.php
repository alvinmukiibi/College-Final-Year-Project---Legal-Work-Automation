<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firm extends Model
{
    protected $table = 'firms';

    protected  $fillable =[
      'id','name','contact','address','dateOfRegistration','website','description','status'
    ];

    protected  $casts = [
        'status' => 'boolean'
    ];

    public function users()
    {
        return $this->hasMany(User::class,'firm_id');
    }


}
