<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;

class CommentController extends Controller
{
    public function store (Request $request) {

        $comment = new Comment();

        $request->validate([
            'name' => 'sometimes',
            'comment' => 'required',
        ]);

        $comment->comment = $request->comment;
        $comment->post_id = $request->post_id;

        $comment->name = $request->user_name;

        if($request->name) {
           $comment->name = $request->name;
        }

        $comment->save();

        return redirect()->back();

    }

    public function destroy($id) {

        $comment = Comment::findOrFail($id);

        $comment->delete();

        return redirect()->back();
    }
}
