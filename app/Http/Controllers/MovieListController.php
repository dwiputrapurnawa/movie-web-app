<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieListController extends Controller
{
    public function index() {
        return view("movie.index", [
            "movies" => Movie::filter(request("search"))->orderBy("title")->paginate(9)->withQueryString(),
            "genres" => Genre::all(),
        ]);
    }

    public function show(Movie $movie) {
        return view("movie.show", [
            "movie" => $movie
        ]);
        
    }
}
