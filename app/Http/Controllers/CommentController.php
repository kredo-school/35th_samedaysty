<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $plan_id){
        $request->validate([
            'comment_body'.$plan_id =>'required|max:100',
        ],[
            "comment_body$plan_id.required" => 'A comment is required.',
            "comment_body$plan_id.max" => 'Maximum of 100 characters only.'
        ]);

        $comment = new Comment();
        $comment->body = $request->input('comment_body'.$plan_id);
        $comment->user_id = Auth::id();
        $comment->plan_id = $plan_id;
        $comment->save();

        return redirect()->back();

    }

    public function destroy($id){
        Comment::destroy($id);

        return redirect()->back();
    }

}
