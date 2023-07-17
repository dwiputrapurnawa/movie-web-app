<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view("home.index", [
            "movies" => Movie::latest()->paginate(6)->withQueryString(),
            "popularMovies" => Movie::mostPopular(8)->limit(5)->get(),
        ]);
    }
}
