<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("dashboard.movie.index", [
            "movies" => Movie::latest()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("dashboard.movie.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "title" => "required",
            "rating" => "required|min:1|max:10",
            "metascore" => "required|min:1|max:100",
            "duration" => "required",
            "release_date" => "required",
            "synopsis" => "required",
            "video" => "required"
        ]);

        if($request->file("img")) {
            $validatedData["img"] = $request->file("img")->store("movie_images");
        }

        Movie::create($validatedData);

        return redirect("/dashboard/movie")->with("success", "New post has been added!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        return view("dashboard.movie.show", [
            "movie" => $movie
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        Movie::destroy($movie->id);

        return back()->with("success", "Successfully deleted");
    }
}
