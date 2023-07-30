<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\WatchLater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchLaterController extends Controller
{
    public function index() {
        return view("watchlater.index", [
            "movies" => auth()->user()->movie,
        ]);
    }

    public function watchLater(Request $request) {

        $data["movie_id"] = $request->movie_id;
        $data["user_id"] = auth()->user()->id;

        WatchLater::create($data);

        return back();

    }

    public function destroy(Request $request) {

        $data["movie_id"] = $request->movie_id;
        $data["user_id"] = auth()->user()->id;

        WatchLater::where("movie_id", $data["movie_id"])->where("user_id", $data["user_id"])->delete();

        return back();
    }
}
