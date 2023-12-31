@extends('layouts.main')

@section('title')
    Movie List - {{ $title }}
@endsection

@section('content')

  @if ($movies->count() === 0)
  <div class="bg-white me-auto text-align p-3 d-flex justify-content-center">
    <img style="height: 20%; width: 20%;" src="/images/notfound.png" alt="data-not-found">
  </div>
  @else
  <div class="bg-white rounded-bottom">

    <div class="bg-dark p-2 rounded-top">
        <h6 class="text-white">{{ $title }}</h6>
    </div>


    <div class="row p-3">

        @foreach ($movies as $movie)
        <div class="col-lg-4">
            <a class="text-decoration-none" href="/movie/{{ $movie->slug }}" data-bs-toggle="tooltip" data-bs-title="{{ $movie->title }}">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img src="{{ $movie->img ? asset("storage/" . $movie->img) : "/images/no-image.jpg"  }}" class="img-fluid rounded-start h-100" alt="movie-img">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">{{ \Illuminate\Support\Str::limit($movie->title, 30, $end='...') }}</h5>
                          @for ($i = 0; $i < $movie->rating->avg("value"); $i++)
                            <i class="bi bi-star-fill text-warning"></i>
                          @endfor

                          @for ($i = 0; $i < (5-$movie->rating->avg("value")); $i++)
                              <i class="bi bi-star text-warning"></i>
                          @endfor
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
  @endif


@endsection