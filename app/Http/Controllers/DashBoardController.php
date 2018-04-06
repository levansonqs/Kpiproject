<?php

namespace App\Http\Controllers;


use App\Group;
use App\Project;
use Illuminate\Http\Request;
use Auth;
use App\Member;
class DashBoardController extends Controller
{
    public function dashboard()

    {
        $mems = Member::where('user_id',Auth::user()->id)->with(['projects' => function($query){
            $query->where('projects.permission_id','1');
        }])->get()->toArray();
        $projects = [];
        foreach($mems as $mem){
            $project = $mem['projects'];
            if(!empty($project)){
                $projects[] = $project;
            }
        }

        $groups = Member::where('user_id',Auth::user()->id)->with(['group','projects'])->get()->toArray();
//        dd($groups);

        return view('Tasks.dashboard',compact('projects','groups'));
    }

    public function boardpersonal(Request $request)
    {
        $mem = new Member;
        $mem->user_id = Auth::user()->id;
        $mem->save();
        $addproject = new Project;
        $addproject->name = $request->name;
        $addproject->description = $request->des;
        $addproject->dealine = $request->dealine;
        $addproject->member_id = $mem->id;
        $addproject->permission_id = 1;
        $addproject->save();
        return response()->json($addproject,200);
    }
    public function delete_board_personal($id)
    {
        $project = Project::find($id);
        $project->delete();
        $member = Member::destroy($project['member_id']);

        return response()->json([$project,$member], 200);
    }

    public function get_board_personal($id)
    {
        $project = Project::findorFail($id);
        return response()->json($project,200);
    }

    public function edit_board_personal(Request $request,$id)
    {
        $project = Project::findorFail($id);
        $project->update($request->all());
        return response()->json($project,200);
    }

    public function boardgroup(Request $request)
    {
        $group = new Group;
        $group->name = $request->name;
        $group->save();
        $mem = new Member;
        $mem->user_id = Auth::user()->id;
        $mem->group_id = $group->id;
        $mem->save();
        return response()->json([$group,$mem] , 200);
    }

    public function get_group_edit($id)
    {
        $group = Group::findorFail($id);
        return response()->json($group,200);
    }

    public function edit_group(Request $request,$id)
    {
        $group = Group::findorFail($id);
        $group->update($request->all());
        return response()->json($group,200);
    }

    public function delete_group($id)
    {
        $group = Group::destroy($id);
        return response()->json($group,200);
    }

    public function board_group_project(Request $request)
    {
        $project = new Project;
        $project->name = $request->name;
        $project->description = $request->description;
        $project->dealine = $request->dealine;
        $project->member_id = $request->member_id;
        $project->permission_id = 2;
        $project->save();
        $group = Member::where('user_id',Auth::user()->id)->where('id',$request->member_id)->with(['group','projects'])->get()->toArray();
        return response()->json([$project,$group],200);
    }

    public function del_project_group($id)
    {
        $project = Project::findorFail($id);
        $project->delete();
        return response()->json($project,200);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }


}
