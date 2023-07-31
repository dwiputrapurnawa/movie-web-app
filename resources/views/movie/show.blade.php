@extends('layouts.main')

@section('title')
    {{ $movie->title }}
@endsection

@section('content')

<div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="ratingModalLabel">Submit Rating</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/rating" method="post">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <input type="number" class="form-control" name="value" min="1" max="5" required>
                    <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-dark">Submit</button>
              </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="editRatingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editRatingModalLabel">Edit Rating</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/rating" method="post">
            @method("put")
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <input type="number" class="form-control" name="value" min="1" max="5" required>
                    <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-dark">Update Rating</button>
              </div>
        </form>
      </div>
    </div>
  </div>

    <div class="row">

        <div class="col-lg-8">

            <div class="bg-white rounded w-100">
                <video class="w-100" controls>
                    <source src="{{ asset("storage/" . $movie->video) }}" type="video/mp4">
                  Your browser does not support the video tag.
                  </video>
        
                  <div class="p-3">
                    <h3 class="mb-3">{{ $movie->title }}</h3>

                    <div class="row">
                        <div class="col-lg mb-3">
                            <small class="text-body-secondary">{{ $movie->created_at->diffForHumans() }}</small>
                        </div>
                        <div class="col-lg">

                            
                          @auth
                            @if (auth()->user()->movie->contains("id", $movie->id))
                            <form action="/watchlater" method="post">
                                @method("delete")
                                @csrf
                                <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                                <button class="btn btn-dark mb-3 d-block ms-auto" type="submit" data-bs-toggle="tooltip" data-bs-title="Remove From Watch Later"><i class="bi bi-stopwatch-fill"></i> Watch Later <i class="bi bi-check"></i></button>
                            </form>
                            @else
                            <form action="/watchlater" method="post">
                                @csrf
                                <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                                
                                <button class="btn btn-dark mb-3 d-block ms-auto" type="submit" data-bs-toggle="tooltip" data-bs-title="Add to Watch Later"><i class="bi bi-stopwatch"></i> Watch Later</button>

                            </form>
                            @endif
                          @endauth
   
                        </div>

                        @auth
                            @if ($movie->rating->contains("user_id", auth()->user()->id))
                            <div class="col-lg">
                                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#editRatingModal"><i class="bi bi-star-fill"></i> Edit Rating</button>
                            </div>  
                            @else
                            <div class="col-lg">
                                <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#ratingModal"><i class="bi bi-star-fill"></i> Submit Rating</button>
                            </div>
                            @endif
                        @endauth



                        
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
        
            <div class="bg-white rounded mt-5 mb-5">
        
                <div class="bg-dark p-2 rounded-top">
                    <h6 class="text-white">All Comment</h6>
                </div>
        
                @if ($movie->comment->count() === 0)
                <div class="p-3">
                    <div class="alert alert-info m-3" role="alert">
                        Be the first to comment
                    </div>
                </div>
                @endif
        
                @foreach ($comments->sortByDesc("created_at") as $comment)
                    <div class="p-3">
                       <div class="bg-light p-3 rounded row">
                        
                            <div class="col-lg-11">
                                <h6>{{ $comment->user->name }}</h6>
                                <small class="text-body-secondary">{{ $comment->created_at->diffForHumans() }}</small>
                                <p>{{ $comment->content }}</p>
                                <button class="btn-text" value="{{ $comment->id }}">Reply</button>
                            </div>

                            <form id="{{ "commentForm-" . $comment->id }}" action="/comment" method="post" hidden>
                                @csrf
                                <div class="p-3">
                                    <textarea class="form-control mb-3" id="content" name="content" rows="3"></textarea>
                                    <input type="hidden" name="movie_id" value="{{ $movie->id }}">
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                    <button class="btn btn-dark" id="postComment" type="submit">Post Comment</button>
                                </div>
                            </form>

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

                    @if (!$comment->reply->isEmpty())
                        @include('partials.comment', ["comment" => $comment->reply, "count" => 1])
                    @endif

                @endforeach


            </div>
        </div>

        <div class="col-lg">
            <div class="bg-white rounded-bottom">

                <div class="bg-dark p-2 rounded-top">
                    <h6 class="text-white">Movie</h6>
                </div>

                <div class="p-3 position-relative">
                    <img class="img-fluid mb-3 position-relative w-100" src="{{ $movie->img ? asset("storage/" . $movie->img) : "/images/no-image.jpg" }}" alt="movie-img">

                    @if ($movie->metascore >= 80)
                    <div class="position-absolute bg-success p-2" style="top: 17px; right: 17px;" data-bs-toggle="tooltip" data-bs-title="Metascore">
                        <h3 class="text-white">{{ $movie->metascore }}</h3>
                    </div>

                    @elseif($movie->metascore > 40)
                    <div class="position-absolute bg-warning p-2" style="top: 17px; right: 17px;" data-bs-toggle="tooltip" data-bs-title="Metascore">
                        <h3 class="text-white">{{ $movie->metascore }}</h3>
                    </div>

                    @else
                    <div class="position-absolute bg-danger p-2" style="top: 17px; right: 17px;" data-bs-toggle="tooltip" data-bs-title="Metascore">
                        <h3 class="text-white">{{ $movie->metascore }}</h3>
                    </div>
                    @endif

                  

                    <h3>{{ $movie->title }}</h3>

                    <div class="mb-3">
                        @for ($i = 0; $i < $movie->rating->avg("value"); $i++)
                            <i class="bi bi-star-fill text-warning" style="font-size: 25px"></i>
                        @endfor

                        @for ($i = 0; $i < (5-$movie->rating->avg("value")); $i++)
                            <i class="bi bi-star text-warning" style="font-size: 25px"></i>
                        @endfor
                    </div>
                    <div class="mb-3">
                        @foreach ($movie->genre as $genre)
                            <a href="/movie?genre={{ $genre->name }}"><span class="badge bg-dark">{{ ucfirst($genre->name) }}</span></a>
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