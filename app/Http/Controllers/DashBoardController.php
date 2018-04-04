<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Auth;
use App\Member;
class DashBoardController extends Controller
{
    public function dashboard()

    {
        $members = Member::where('user_id',Auth::user()->id)->with(['projects' => function($query){
            $query->where('projects.permission_id',1);
        }])->get()->toArray();
        $projects = [];
        foreach ($members as $member){
            $project = $member['projects'];
            if(!empty($project)){
                $projects[] = $project;
            }
        }
        return view('Tasks.dashboard',compact('projects'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }


}
