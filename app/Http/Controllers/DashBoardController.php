<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Member;
class DashBoardController extends Controller
{
    public function dashboard()
    {
        $members = Member::where('user_id',1)
            ->with(['group' => function($query){
                    $query->where('permission_id',1);
            }])
            ->get();
               dd($members);

        return view('Tasks.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
//    public function
}
