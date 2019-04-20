<?php

namespace App;
use Illuminate\Support\Facades\DB;
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
    public function addRole(){
        $data = $this->data;
        return DB::table($this->table)->insert(['name' => $data['name'], 'description' => $data['description'], 'firm_id' => auth()->user()->firm_id]);

    }
    public function saveRole(){
        $role = $this->role;
        $edit = DB::table($this->table)->where(['id'=>$role['id']])->update(['name'=>$role['name'], 'description'=>$role['description']]);
        return $edit;
    }
}
