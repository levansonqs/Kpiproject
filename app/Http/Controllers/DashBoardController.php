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

    public function boardgroup(Request $request)
    {
        $group = new Group;
        $group->name = $request->name;
        $group->save();
        $mem = new Member;
        $mem->user_id = Auth::user()->id;
        $mem->group_id = $group->id;
        $mem->save();
        return response()->json($group , 200);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
