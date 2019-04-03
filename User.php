<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','profile','contact','user_name','department_id','firm_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'profile' => 'array'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class,'role_user','user_id','role_id');
    }


    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }

    public function firm()
    {
        return $this->belongsTo(Firm::class,'firm_id');
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class,'user_id');
    }

    public function  duedeligences()
    {
        $this->hasMany(DueDeligence::class,'user_id');
    }

}
