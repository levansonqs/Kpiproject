<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
class TasksController extends Controller
{
    public function createTask(Request $request){
        if($request->ajax()){
//            return $request->all();
            $task = new Task;
            $task->title = $request->name;
            $task->board_id = $request->board_id;
            $task->save();
            return response()->json($task);
        }
    }
    public function updateTask(Request $request){

    }
    public function deleteTask(Request $request){
//        return $request->all();
        $task = Task::findOrFail($request->task_id);
        $task->delete();
        return response()->json($task);
    }
}
