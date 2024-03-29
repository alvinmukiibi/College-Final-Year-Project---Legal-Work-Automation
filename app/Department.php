<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Firm;
use App\User;
class Department extends Model
{
    protected $table = "departments";

    protected $fillable = [
         'name', 'description','created_at','firm_id',
    ];
    public function firm(){
        return $this->belongsTo(Firm::class);
    }
    public function staff(){
        return $this->hasMany(User::class);
    }
    public function addDepartment(){
        $dept = $this->dept;
        $add = DB::table($this->table)->insert(['name'=>$dept['name'], 'description'=>$dept['description'],'firm_id'=>auth()->user()->firm_id ]);
        return $add;
    }
    public function saveDepartment(){
        $dept = $this->dept;
        $edit = DB::table($this->table)->where(['id'=>$dept['id']])->update(['name'=>$dept['name'], 'description'=>$dept['description']]);
        return $edit;
    }
}
