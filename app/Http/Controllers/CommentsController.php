<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function comment(Request $request){
        if($request->ajax()){
            $user_id = Auth::user()->id;
            $comment = new Comment();
            $comment->content = $request->comment;
            $comment->task_id = $request->task_id;
            $comment->user_id = $user_id;
            $comment->save();
            $data = Comment::where('id',$comment->id)->with('user')->get();
            return response()->json($data);
        }
    }
}
