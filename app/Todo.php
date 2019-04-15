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
<<<<<<< HEAD
        $add = DB::table($this->table)->insert(['tagline' => $this->todo, 'user_id' => $this->owner, 'firm_id' => $this->firm_id]);
=======
        $add = DB::table($this->table)->insert(['tagline' => $this->todo, 'dueBy' => $this->dueBy, 'user_id' => $this->owner, 'firm_id' => $this->firm_id]);
>>>>>>> f4cf954a6372a68079d7470bb8c466c2279f74f0

        if($add){
            $addedTodo = [
                "id" => DB::getPdo()->lastInsertId(),
<<<<<<< HEAD
                "tagline" => $this->todo
=======
                "tagline" => $this->todo,
                "dueBy" => $this->dueBy
>>>>>>> f4cf954a6372a68079d7470bb8c466c2279f74f0
            ];
            return $addedTodo;
        }else{
            return false;
        }
    }
}
