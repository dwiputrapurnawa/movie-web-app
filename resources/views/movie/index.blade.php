@extends('layouts.main')

@section('title')
    Movie List
@endsection

@section('content')

    <div class="bg-white rounded-bottom">

        <div class="bg-dark p-2 rounded-top">
            <h6 class="text-white">All Movie</h6>
        </div>


        <div class="row p-3">

            @foreach ($movies as $movie)
            <div class="col-lg-4">
                <a class="text-decoration-none" href="/movie/{{ $movie->slug }}">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                          <div class="col-md-4">
                            <img src="{{ $movie->img ?? "images/no-image.jpg"  }}" class="img-fluid rounded-start" alt="...">
                          </div>
                          <div class="col-md-8">
                            <div class="card-body">
                              <h5 class="card-title">{{ $movie->title }}</h5>
                              <p class="card-text"><small class="text-body-secondary">{{ $movie->created_at->diffForHumans() }}</small></p>
                            </div>
                          </div>
                        </div>
                      </div>
                </a>
            </div>
            @endforeach
            

            {{ $movies->links() }}
            
        </div>

    </div>
@endsection