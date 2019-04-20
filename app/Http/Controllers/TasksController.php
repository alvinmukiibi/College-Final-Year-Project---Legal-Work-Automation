<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\InterTask;
class TasksController extends Controller
{
    public function viewTasks(Request $request){
        $departments = Department::where('firm_id', auth()->user()->firm_id)->get();
        $task = new InterTask;
        $task->creator = auth()->user()->id;
        $tasksIAssigned = $task->getTasksIAssigned();
        $task->assignee = auth()->user()->id;
        $tasksAssignedToMe = $task->getTasksAssignedToMe();

        return view('firm.tasks')->with(['departments' => $departments, 'tasksIAssigned' => $tasksIAssigned, 'tasksAssignedToMe' => $tasksAssignedToMe]);
    }
    public function assignTask(Request $request){
        $data = $this->validate($request, [
            'assignee' => 'required|numeric',
            'deadline' => 'required',
            'task' => 'required|max:255'
        ]);

        $task = new InterTask;
        $task->data = $data;
        $task->creator = auth()->user()->id;

        $task->assignTask();

        return redirect()->back()->with('success', 'Task Assigned Successfully!!');


    }
    public function completeTask(Request $request){

        $task = new InterTask;
        $task->id = $request->input('taskID');
        $task->completeTask();

        return redirect()->back()->with('success', 'Task Completed!!');

    }
    public function countUncompletedTasks(Request $request){

        $unCompleted = InterTask::where(['assignee' => $request->input('user'), 'completion_status' => 'pending'])->count();
        return response()->json(['noOfunCompleted' => $unCompleted]);

    }
}
