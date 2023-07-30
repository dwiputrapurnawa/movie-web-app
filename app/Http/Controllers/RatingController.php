<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function submit(Request $request) {
        $validatedData = $request->validate([
            "movie_id" => "required",
            "value" => "required|min:1|max:5"
        ]);

        $validatedData["user_id"] = auth()->user()->id;

        Rating::create($validatedData);

        return back();
    }

    public function update(Request $request) {
        $validatedData = $request->validate([
            "movie_id" => "required",
            "value" => "required|min:1|max:5"
        ]);

        $validatedData["user_id"] = auth()->user()->id;

        Rating::where("user_id", auth()->user()->id)->where("movie_id", $request->movie_id)->update($validatedData);

        return back();

    }
}
