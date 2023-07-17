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
            "movies" => Auth()->user()->movie,
        ]);
    }

    public function watchLater(Request $request) {

        $data["movie_id"] = $request->movie_id;
        $data["user_id"] = Auth()->user()->id;

        WatchLater::create($data);

        return back();

    }
}
