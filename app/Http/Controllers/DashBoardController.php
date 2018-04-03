<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class DashBoardController extends Controller
{
    public function dashboard()
    {
        return view('Tasks.master');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
