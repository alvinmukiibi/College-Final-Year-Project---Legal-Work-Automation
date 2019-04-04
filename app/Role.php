<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'name', 'description', 'firm_id', 'created_at',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
