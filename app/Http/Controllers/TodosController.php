<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\User;
class TodosController extends Controller
{

    public function getTodos(Request $request){
        $user = new User;
        $user->id = $request->input('owner');
        $todos = $user->todos()->orderBy('date', 'desc')->get();
        return response()->json($todos, 200);
    }

    public function addTodo(Request $request){


        $data = $this->validate($request, [
            "todo" => "required|max:100|",

        ]);

        $todo = new Todo;
        $todo->todo = $data['todo'];
        $todo->dueBy = $request->input('dueBy') == null? date('Y-m-d'): $request->input('dueBy');
        $todo->owner = $request->input('owner');
        $todo->firm_id = $request->input('firm_id');

        $added = $todo->addTodo();

        return response()->json($added);


    }
}
