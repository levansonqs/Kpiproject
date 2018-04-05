<?php

namespace App\Http\Middleware;

use App\Project;
use Closure;
use App\Member;
use Illuminate\Support\Facades\Auth;
class CheckProject
{
    /**
     * check project of user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $project_id = $request->route('id');
        $projects = Member::where('user_id',Auth::user()->id)->with(['projects' => function($query) use($project_id){
            $query->where('id',$project_id);
        }])->get()->toArray();
        foreach ($projects as $project){
            if(!empty($project['projects'])){
                return $next($request);
            }
        }
           return redirect('/dashboard')->with('error','Bạn không có quyền quản lý dự án này!');
    }
}
