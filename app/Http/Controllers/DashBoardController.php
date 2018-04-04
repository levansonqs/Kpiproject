<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Member;
class DashBoardController extends Controller
{
    public function dashboard()

    {

        return view('Tasks.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
