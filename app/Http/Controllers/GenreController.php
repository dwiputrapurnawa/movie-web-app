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

    public function create(Request $request) {

        $validateData = $request->validate([
            "name" => "required|min:3",
        ]);

        Genre::create($validateData);

        return back()->with("success", "Successfully add new genre!");
    }
}
