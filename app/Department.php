<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Firms;
use App\User;
class Department extends Model
{
    protected $table = "departments";

    protected $fillable = [
         'name', 'description','created_at','firm_id','update_at',
    ];
    public function firm(){
        return $this->belongsTo(Firms::class);
    }
    public function staff(){
        return $this->hasMany(User::class);
    }
    public function addDepartment(){
        $dept = $this->dept;
        $add = DB::table($this->table)->insert(['name'=>$dept['name'], 'description'=>$dept['description'],'firm_id'=>auth()->user()->firm_id ]);
        if($add){
            return true;
        }else{
            return false;
        }
    }
    public function saveDepartment(){
        $dept = $this->dept;
        $edit = DB::table($this->table)->where(['id'=>$dept['id']])->update(['name'=>$dept['name'], 'description'=>$dept['description']]);
        if($edit){
            return true;
        }else{
            return false;
        }
    }
}
