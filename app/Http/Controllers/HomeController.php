<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {


        $movies = Movie::all();

        foreach($movies as $movie) {
            $movie["avg_rating"] = $movie->rating->avg("value");
        }

        
        return view("home.index", [
            "movies" => Movie::latest()->paginate(6)->withQueryString(),
            // "popularMovies" => Movie::mostPopular(4)->limit(5)->orderBy("rating", "desc")->get(),
            "popularMovies" => collect($movies)->sortByDesc("avg_rating")->take(5),
        ]);
    }
}
