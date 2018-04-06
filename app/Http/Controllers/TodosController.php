<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    public function updateTodo(Request $request){
        if($request->ajax()){
            $todo = Todo::findOrFail($request->todo_id);
            $todo->content = $request->content;
            $todo->save();
            return response()->json($todo);
        };
    }
    public function createTodo(Request $request){
        if($request->ajax()){
            $todo = new Todo;
            $todo->content = $request->content;
            $todo->task_id = $request->task_id;
            $todo->save();
            return response()->json($todo);
        };
    }
    public function deleteTodo(Request $request){
        if($request->ajax()){
            $todo = Todo::findOrFail($request->todo_id);
            $todo->delete();
            return response()->json($todo);
        };
    }
}
