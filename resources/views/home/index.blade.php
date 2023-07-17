@extends('layouts.main')

@section('title')
    Movie App
@endsection

@section('content')
    <div class="row mb-3">
        <div class="col-md-8">
    
            {{-- <div id="carouselHeader" class="carousel slide mb-3">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselHeader" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselHeader" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselHeader" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="https://source.unsplash.com/1200x400?movie" class="d-block w-100" alt="header-1">
                  </div>
                  <div class="carousel-item">
                    <img src="https://source.unsplash.com/1200x400?movie" class="d-block w-100" alt="header-2">
                  </div>
                  <div class="carousel-item">
                    <img src="https://source.unsplash.com/1200x400?movie" class="d-block w-100" alt="header-3">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselHeader" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselHeader" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div> --}}

              <div class="item-list row bg-white rounded">

                <div class="bg-dark text-white p-2 mb-2 rounded-top">
                  <h6>Recent Release</h6>
                </div>

                
                @foreach ($movies as $movie)
                <div class="card col-lg-4 ms-2 me-1 mb-2" style="width: 15rem;">

                  <a href="/movie/{{ $movie->slug }}" class="text-decoration-none">
                    <img src="https://cdn.marvel.com/content/1x/snh_online_6072x9000_posed_01.jpg" class="card-img-top mt-2" alt="...">
                  
                    <div class="card-body">
                        <h5 class="card-title text-dark">{{ $movie->title }}</h5>
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
              <h6>Most Popular</h6>
            </div>

            @foreach ($popularMovies as $popularMovie)
            <div class="card mb-2 p-2" style="max-width: 540px;">
              <a class="text-decoration-none" href="/movie/{{ $popularMovie->slug }}">
                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="https://cdn.marvel.com/content/1x/snh_online_6072x9000_posed_01.jpg" class="img-fluid rounded-start" alt="...">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title text-dark">{{ $popularMovie->title }}</h5>
                      <p class="card-text"><small class="text-body-secondary">{{ $popularMovie->created_at->diffForHumans() }}</small></p>
                    </div>
                  </div>
                </div></a>
            </div>
            @endforeach




          
            
          </div>

         
            
        </div>
    </div>
@endsection