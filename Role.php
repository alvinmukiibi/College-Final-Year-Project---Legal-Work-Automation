<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'id', 'name'
    ];


    public function users()
    {
        return $this->belongsToMany(User::class,'role_user','role_id','user_id');
    }
}
