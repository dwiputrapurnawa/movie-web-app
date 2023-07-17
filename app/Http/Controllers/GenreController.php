<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index(Genre $genre) {
        return view("genre.index", [
            "genre" => $genre,
            "movies" => $genre->movie()->paginate(9),
        ]);
    }
}
