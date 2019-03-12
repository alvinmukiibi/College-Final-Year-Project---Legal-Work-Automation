<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    protected $fillable = [
        'id','name','code','HOD'
    ];

    protected  $casts = [
        'status' => 'boolean'
    ];

    public function users()
    {
        return $this->hasMany(User::class,'department_id');
    }



}
