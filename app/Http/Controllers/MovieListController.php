<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;

class MovieListController extends Controller
{
    public function index() {

        if(request("genre")) {

            $genre = Genre::filter(request("genre"));
            
            return view("movie.index", [
                "movies" => $genre->movie()->paginate(9)->withQueryString(),
                "genres" => Genre::all(),
                "title" => "Movie By Genre " . ucfirst(request("genre"))
            ]);
            
        } elseif(request("watchlater")) {

            $user = User::where("id", auth()->user()->id)->first();

            return view("movie.index", [
                "movies" => $user->movie()->paginate(9)->withQueryString(),
                "genres" => Genre::all(),
                "title" => "Watch Later"
            ]);
        }
        
        return view("movie.index", [
            "movies" => Movie::filter(request("search"))->orderBy("title")->paginate(9)->withQueryString(),
            "genres" => Genre::all(),
            "title" => "All Movie"
        ]);
    }

    public function show(Movie $movie) {
        return view("movie.show", [
            "movie" => $movie,
            "comments" => Comment::where("movie_id", $movie->id)->where("parent_id", null)->get(),
        ]);
        
    }
}
