<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\MovieGenre;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        return view("dashboard.movie.create", [
            "genres" => Genre::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        
        $validatedData = $request->validate([
            "title" => "required|max:255",
            "rating" => "required|min:1|max:10",
            "metascore" => "required|min:1|max:100",
            "duration" => "required",
            "release_date" => "required",
            "synopsis" => "required",
            "video" => "required",
            "genre" => "required",
        ]);


        if($request->file("img")) {
            $validatedData["img"] = $request->file("img")->store("movie_images");
        }


        $movie = Movie::create($validatedData);

        $genre_id = explode(",", $request->genre);

        foreach($genre_id as $id) {
            MovieGenre::create([
                "movie_id" => $movie->id,
                "genre_id" => $id
            ]);
        }


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
    public function edit(Movie $movie)
    {
        return view("dashboard.movie.edit", [
            "movie" => $movie,
            "genres" => Genre::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {

        $validatedData = $request->validate([
            "title" => "required|max:255",
            "rating" => "required|min:1|max:10",
            "metascore" => "required|min:1|max:100",
            "duration" => "required",
            "release_date" => "required",
            "synopsis" => "required",
        ]);


        if($request->file("img")) {
            if($request->oldImg) {
                Storage::delete($request->oldImg);
            }
            $validatedData["img"] = $request->file("img")->store("movie_images");
        }


        if($request->video) {
            if($request->oldVideo) {
                Storage::delete($request->oldVideo);
            }

            $validatedData["video"] = $request->video;
        } else {
            $validatedData["video"] = $request->oldVideo;
        }

        if($request->genre) {

            MovieGenre::where("movie_id", $movie->id)->delete();
            
            $genre_id = explode(",", $request->genre);

            foreach($genre_id as $id) {
                MovieGenre::create([
                    "movie_id" => $movie->id,
                    "genre_id" => $id
                ]);
            }
        }

        $validatedData["slug"] = SlugService::createSlug(Movie::class, "slug", $request->title);

        Movie::where("id", $movie->id)->update($validatedData);

        
        return redirect("/dashboard/movie")->with("success", "Movie has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        Storage::delete($movie->img);
        Storage::delete($movie->video);
        Movie::destroy($movie->id);

        return back()->with("success", "Successfully deleted");
    }
}
