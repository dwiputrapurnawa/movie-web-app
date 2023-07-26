@extends('layouts.dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Show Movie {{ $movie->title }}</h1>

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="/dashboard/movie">Movie</a></li>
        <li class="breadcrumb-item active" aria-current="page">Show</li>
      </ol>
    </nav>
</div>

    <div class="row bg-light mt-3 mb-3">

        <div class="bg-dark p-2 rounded-top">
            <h5 class="text-white">Movie Info</h5>
        </div>
        

       <div class="col-lg-2 my-3">
        
        <img class="img-fluid w-100 h-100" src="/{{ $movie->img ?? "images/no-image.jpg" }}">
       </div>

       <div class="col-lg my-3">

        
        <h3>{{ $movie->title }}</h3>
        
        <div class="mb-3">
                        @for ($i = 0; $i < $movie->rating; $i++)
                            <i class="bi bi-star-fill text-warning" style="font-size: 25px"></i>
                        @endfor

                        @for ($i = 0; $i < (5-$movie->rating); $i++)
                            <i class="bi bi-star text-warning" style="font-size: 25px"></i>
                        @endfor
                    </div>
                    <div class="mb-3">
                        @foreach ($movie->genre as $genre)
                            <a href="/genre/{{ $genre->slug }}"><span class="badge bg-dark">{{ ucfirst($genre->name) }}</span></a>
                        @endforeach
                    </div>

        <ul>
            <li class="movie-list">Release Date: {{ Carbon\Carbon::parse($movie->release_date)->format('F j, Y ')}}</li>
            <li class="movie-list">Duration: {{ round($movie->duration/60) }} hours</li>
        </ul>

        <p>{{ $movie->synopsis }}</p>

        

       </div>

    </div>


    <div class="bg-light mb-3">

        <div class="bg-dark p-2 rounded-top">
            <h5 class="text-white">Video Streaming {{ $movie->title }}</h5>
        </div>

        <video class="w-100" controls>
            <source src="/{{ $movie->video }}" type="video/mp4">
          Your browser does not support the video tag.
        </video>
    </div>

@endsection