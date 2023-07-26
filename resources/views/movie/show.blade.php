@extends('layouts.main')

@section('title')
    {{ $movie->title }}
@endsection

@section('content')
    <div class="row">

        <div class="col-lg-8">

            <div class="bg-white rounded w-100">
                <video class="w-100" controls>
                    <source src="/{{ $movie->video }}" type="video/mp4">
                  Your browser does not support the video tag.
                  </video>
        
                  <div class="p-3">
                    <h3 class="mb-3">{{ $movie->title }}</h3>

                    <div class="row">
                        <div class="col-lg-8 mb-3">
                            <small class="text-body-secondary">{{ $movie->created_at->diffForHumans() }}</small>
                        </div>
                        <div class="col-lg">
                            <form action="/watchlater" method="post">
                                @csrf
                                <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                                
                                @auth
                                    @if (auth()->user()->movie->contains("id", $movie->id))
                                        <button class="btn btn-dark mb-3 d-block ms-auto" type="submit" disabled><i class="bi bi-stopwatch-fill"></i> Watch Later <i class="bi bi-check"></i></button>
                                    @else
                                        <button class="btn btn-dark mb-3 d-block ms-auto" type="submit"><i class="bi bi-stopwatch"></i> Watch Later</button>
                                    @endif
                                @endauth

                            </form>
                        </div>
                        
                    </div>


                    

                    
                  </div>
            </div>
        
            <div class="bg-white rounded mt-5">
        
                <div class="bg-dark p-2 rounded-top">
                    <h6 class="text-white">Comment</h6>
                </div>
        
                @auth
                <form id="commentForm" action="/comment" method="post">
                    @csrf
                    <div class="p-3">
                        <textarea class="form-control mb-3" id="content" name="content" rows="3"></textarea>
                        <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <button class="btn btn-dark" id="postComment" type="submit">Post Comment</button>
                    </div>
                </form>
                @else
                    <div class="p-3">
                        <div class="alert alert-info m-3" role="alert">
                            Please Login to leave comment!
                          </div>
                    </div>
                @endauth
        
            </div>
        
            <div class="bg-white rounded mt-5">
        
                <div class="bg-dark p-2 rounded-top">
                    <h6 class="text-white">All Comment</h6>
                </div>
        
                @if ($movie->comment->count() === 0)
                <div class="p-3">
                    <div class="alert alert-info m-3" role="alert">
                        There is no comment!
                    </div>
                </div>
                @endif
        
                @foreach ($movie->comment->sortByDesc("created_at") as $comment)
                    <div class="p-3">
                       <div class="bg-light p-3 rounded row">
                        
                        
                          
                            <div class="col-lg-11">
                                <h6>{{ $comment->user->name }}</h6>
                                <small class="text-body-secondary">{{ $comment->created_at->diffForHumans() }}</small>
                                <p>{{ $comment->content }}</p>
                            </div>

                            @auth
                                @if ($comment->user->id === auth()->user()->id)
                                <div class="col-lg d-flex justify-content-end">
                                    <div class="dropdown">
                                        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        </button>
                                        <ul class="dropdown-menu">
                                        <form action="/comment" method="post">
                                            @method("delete")
                                            @csrf
                                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                            <button class="dropdown-item" type="submit">Delete</button>
                                        </form>
                                        </ul>
                                    </div>
                                </div>
                                @endif                            
                            @endauth

                            
                       </div>

                       
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-lg">
            <div class="bg-white rounded-bottom">

                <div class="bg-dark p-2 rounded-top">
                    <h6 class="text-white">Movie</h6>
                </div>

                <div class="p-3 position-relative">
                    <img class="img-fluid mb-3 position-relative w-100" src="/{{ $movie->img ?? "images/no-image.jpg"  }}" alt="movie-img">

                    @if ($movie->metascore >= 80)
                    <div class="position-absolute bg-success p-2 rounded" style="top: 19px; right: 19px;">
                        <h3 class="text-white">{{ $movie->metascore }}</h3>
                    </div>

                    @elseif($movie->metascore > 40)
                    <div class="position-absolute bg-warning p-2 rounded" style="top: 19px; right: 19px;">
                        <h3 class="text-white">{{ $movie->metascore }}</h3>
                    </div>

                    @else
                    <div class="position-absolute bg-danger p-2 rounded" style="top: 19px; right: 19px;">
                        <h3 class="text-white">{{ $movie->metascore }}</h3>
                    </div>
                    @endif

                  

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
        </div>

    </div>
@endsection