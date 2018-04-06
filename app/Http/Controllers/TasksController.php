<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use App\Task;
class TasksController extends Controller
{
    public function detailTask(Request $request){
        if($request->ajax()){
            $task = Task::where('id',$request->task_id)->with('comments')->get();
            $todos = Todo::where('task_id',$request->task_id)->get();
            $data = [$task,$todos];
        }
        return response()->json($data);
    }
    public function createTask(Request $request){
        if($request->ajax()){
//            return $request->all();
            $task = new Task;
            $task->title = $request->name;
            $task->board_id = $request->board_id;
            $task->save();
        }
        return response()->json($task);
    }
    public function updateTask(Request $request){

    }
    public function deleteTask(Request $request){
        if($request->ajax()) {
            $task = Task::findOrFail($request->task_id);
            $task->delete();
        }
        return response()->json($task);
    }
}
