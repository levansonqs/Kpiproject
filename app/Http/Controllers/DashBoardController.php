<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Member;
class DashBoardController extends Controller
{
    public function dashboard()
    {
//        $members = Member::where('user_id',3)->with('group')->get();
//           foreach($members as $mb){
//               dump($mb->group);
//           }

        return view('Tasks.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
//    public function
}
