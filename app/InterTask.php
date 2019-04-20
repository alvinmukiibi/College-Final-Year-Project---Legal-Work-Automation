<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class InterTask extends Model
{
    protected $table = 'inter_tasks';

    public function assignTask(){
        $data = $this->data;
        return DB::table($this->table)->insert(['creator' => $this->creator, 'task' => $data['task'], 'deadline' => $data['deadline'], 'assignee' =>  $data['assignee']]);

    }
    public function getTasksIAssigned(){
        $tasks = DB::table($this->table)->join('users', 'users.id', '=', 'inter_tasks.assignee')->where('inter_tasks.creator', $this->creator)->select('users.fname','users.lname','inter_tasks.*')->get();
        return $tasks;
    }
    public function getTasksAssignedToMe(){
        $tasks = DB::table($this->table)->join('users', 'users.id', '=', 'inter_tasks.creator')->where('inter_tasks.assignee', $this->assignee)->select('users.fname','users.lname','inter_tasks.*')->get();
        //dd($tasks);
        return $tasks;
    }
    public function completeTask(){
        return DB::table($this->table)->where('id', $this->id)->update(['completion_status' => 'completed']);

    }
}
