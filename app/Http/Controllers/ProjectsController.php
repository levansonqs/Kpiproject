<?php

namespace App\Http\Controllers;

use App\Board;
use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Show the project detail.
     * param $id - id project
     * @return \Illuminate\Http\Response
     */
    public function index($id){
        $relate = [
            'boards.tasks',
            'permission',
        ];
        $project = Project::with($relate)->findOrFail($id);
        return view('Tasks.project_detail',compact('project'));
    }
    /**
     * Add task for board.
     * param $id - id project
     * @return \Illuminate\Http\Response
     */
    public function createBoard(Request $request){
        if($request->ajax()){
            $board = new Board;
            $board->name = $request->name;
            $board->description = $request->description;
            $board->project_id = $request->project_id;
            $board->save();
            return json_encode($board);
        }
    }
}
