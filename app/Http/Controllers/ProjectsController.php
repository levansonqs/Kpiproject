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
            return response()->json($board);
        }
    }
    public function updateBoard(Request $request){
//        return $request->all();
        if($request->ajax()){
            $board = Board::findOrFail($request->board_id);
            $board->name = $request->name;
            $board->save();
            return response()->json($board);
        }
    }
    public function deleteBoard(Request $request){
        if($request->ajax()){
            $board = Board::findOrFail($request->id);
            $board->delete();
            return response()->json('ok');
        }
    }
}
