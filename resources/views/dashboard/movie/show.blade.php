@extends('layouts.dashboard')

@section('content')

    <div class="p-3 row">
       <div class="col-lg-2">
        <img class="img-fluid" src="/{{ $movie->img }}">
       </div>

       <div class="col-lg">
        
        <h3>{{ $movie->title }}</h3>

        <ul>
            <li class="movie-list">Release Date: {{ Carbon\Carbon::parse($movie->release_date)->format('F j, Y ')}}</li>
            <li class="movie-list">Duration: {{ round($movie->duration/60) }} hours</li>
            <li class="movie-list">Rating: {{ $movie->rating }}/10</li>
            <li class="movie-list">Metascore: {{ $movie->metascore }}/100</li>
        </ul>

        <p>{{ $movie->synopsis }}</p>

        

       </div>

    </div>

    <hr>

    <video class="w-100 my-3" controls>
        <source src="/{{ $movie->video }}" type="video/mp4">
      Your browser does not support the video tag.
    </video>

@endsection