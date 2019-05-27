<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'name', 'description', 'firm_id'
    ];
    public function users()
    {
        return $this->belongsToMany(User::class,'user_roles','role_id','user_id');
    }
}
