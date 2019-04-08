<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\User;
class Todo extends Model
{
    protected $table = "todos";

    protected $fillable = [
        'tagline', 'owner', 'firm_id'
    ];

    public function owner(){
        return $this->belongsTo(User::class);
    }

    public function addTodo(){
        $add = DB::table($this->table)->insert(['tagline' => $this->todo, 'user_id' => $this->owner, 'firm_id' => $this->firm_id]);

        if($add){
            $addedTodo = [
                "id" => DB::getPdo()->lastInsertId(),
                "tagline" => $this->todo
            ];
            return $addedTodo;
        }else{
            return false;
        }
    }
}
