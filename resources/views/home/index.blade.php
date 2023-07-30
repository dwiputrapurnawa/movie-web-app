@extends('layouts.main')

@section('title')
    Movie - Home
@endsection

@section('content')

  @if (session()->has("error"))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session("error") }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  @if ($movies->count() === 0)
    <div class="bg-white me-auto text-align p-3 d-flex justify-content-center">
      <img style="height: 20%; width: 20%;" src="/images/notfound.png" alt="data-not-found">
    </div>
  @else

  <div class="row mb-3">
    <div class="col-lg-8">


          <div class="item-list row bg-white rounded">

            <div class="bg-dark text-white p-2 mb-2 rounded-top">
              <h6 class="mt-2">Recent Release</h6>
            </div>
            
            @foreach ($movies as $movie)
            <div class="card col-lg-4 ms-2 me-1 mb-4" style="width: 15rem;">

              <a href="/movie/{{ $movie->slug }}" class="text-decoration-none" data-bs-toggle="tooltip" data-bs-title="{{ $movie->title }}">
                <img src="{{ $movie->img ? asset("storage/" . $movie->img) : "/images/no-image.jpg"  }}" class="card-img-top mt-2" alt="movie-img">
              
                <div class="card-body">
                    <h5 class="card-title text-dark">{{ \Illuminate\Support\Str::limit($movie->title, 30, $end='...') }}</h5>
                    <p><small class="text-body-secondary">{{ $movie->created_at->diffForHumans() }}</small></p>
                    @for ($i = 0; $i < $movie->rating->avg("value"); $i++)
                      <i class="bi bi-star-fill text-warning"></i>
                    @endfor

                    @for ($i = 0; $i < (5-$movie->rating->avg("value")); $i++)
                      <i class="bi bi-star text-warning"></i>
                    @endfor
                </div>
              </a>
            </div>
            @endforeach
            
            <div class="mt-4">
              {{ $movies->links() }}
            </div>
            


          </div>

    </div>

    <div class="col-lg-4">

      <div class="bg-white rounded mx-2 mt-2">
        <div class="bg-dark text-white p-2 mb-2 rounded-top">
          <h6 class="mt-2">Most Popular By Rating</h6>
        </div>

        @foreach ($popularMovies as $popularMovie)
        <div class="card mb-2 p-2" style="max-width: 540px;">
          <a class="text-decoration-none" href="/movie/{{ $popularMovie->slug }}" data-bs-toggle="tooltip" data-bs-title="{{ $movie->title }}">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="{{ $popularMovie->img ? asset("storage/" . $popularMovie->img) : "/images/no-image.jpg"  }}" class="img-fluid rounded-start h-100" alt="movie-img">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title text-dark">{{ \Illuminate\Support\Str::limit($popularMovie->title, 30, $end='...') }}</h5>
                  @for ($i = 0; $i < $popularMovie->avg_rating; $i++)
                    <i class="bi bi-star-fill text-warning"></i>
                  @endfor
                  @for ($i = 0; $i < (5-$popularMovie->avg_rating); $i++)
                    <i class="bi bi-star text-warning"></i>
                  @endfor
                  <p class="card-text"><small class="text-body-secondary">{{ $popularMovie->created_at->diffForHumans() }}</small></p>
                </div>
              </div>
            </div></a>
        </div>
        @endforeach




      
        
      </div>

     
        
    </div>
</div>
  @endif

    
@endsection