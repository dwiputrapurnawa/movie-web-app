<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function comment(Request $request) {

        $validatedData = $request->validate([
            "user_id" => "required",
            "movie_id" => "required",
            "content" => "required"
        ]);

        Comment::create($validatedData);

        return back();

    }

    public function delete(Request $request) {
        
        $commentId = $request->comment_id;

        Comment::where("id", $commentId)->delete();

        return back();
    }
}
