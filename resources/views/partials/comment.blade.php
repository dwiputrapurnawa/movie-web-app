            <button class="btn-text replies mb-3" value="{{ $parent_id }}" style="margin-left: {{ $count . "0" }}%"><i class="bi bi-arrow-return-right"></i> View {{ $comments->count() }} more replies</button>

            <div class="{{ "reply-container-" . $parent_id }}">
                @foreach ($comments->sortByDesc("created_at") as $comment)
                    
                    <div class="p-3" style="margin-left: {{ $count . "0" }}%">
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
                        @include('partials.comment', ["comments" => $comment->reply, "count" => $count+1, "parent_id" => $comment->id])
                    @endif
                    
                @endforeach
            </div>