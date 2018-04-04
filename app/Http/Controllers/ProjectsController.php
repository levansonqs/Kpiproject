<?php

namespace App\Http\Controllers;

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
    public function add_board(Request $request){
        if($request->ajax()){
            $project = Project::findOrFail($request->project_id);
        }


    }
}
