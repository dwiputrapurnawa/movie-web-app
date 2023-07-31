<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function comment(Request $request) {

        $validatedData = $request->validate([
            "movie_id" => "required",
            "content" => "required"
        ]);

        $validatedData["user_id"] = auth()->user()->id;

        if($request->parent_id) {
            $validatedData["parent_id"] = $request->parent_id;
        }

        Comment::create($validatedData);

        return back();

    }

    public function delete(Request $request) {
        
        $commentId = $request->comment_id;

        Comment::where("id", $commentId)->delete();

        return back();
    }
}
