@extends('layouts.dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Movie</h1>

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Home</li>
      </ol>
    </nav>
</div>

    @if (session()->has("success"))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session("success") }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <a class="btn btn-dark mb-4" href="/dashboard/movie/create"><i class="bi bi-camera-reels"></i> Add Movie</a>
    <button class="btn btn-dark mb-4" data-bs-toggle="modal" data-bs-target="#genreModal"><i class="bi bi-plus-square-fill"></i> Add Genre</button>


    <div class="modal fade" id="genreModal" tabindex="-1" aria-labelledby="genreModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Genre</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="/dashboard/genre/create" method="post">
            @csrf
          <div class="modal-body">
 
              <div class="mb-3">
                <label for="name" class="form-label">Genre Name</label>
                <input type="text" class="form-control" id="name" name="name">
              </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-dark">Save Genre</button>
          </div>
        </form>
        </div>
      </div>
    </div>

<div class="table-responsive small">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Duration</th>
          <th scope="col">Release Date</th>
          <th scope="col">Rating</th>
          <th scope="col">Metascore</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>

        @foreach ($movies as $movie)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $movie->title }}</td>
            <td>{{ $movie->duration }}</td>
            <td>{{ $movie->release_date }}</td>
            <td>{{ $movie->rating->avg("value") ?? 0 }}</td>
            <td>{{ $movie->metascore }}</td>
            <td>
                <a class="badge text-bg-primary text-decoration-none" href="/dashboard/movie/{{ $movie->slug }}">Show</a>
                <a class="badge text-bg-warning text-decoration-none" href="/dashboard/movie/{{ $movie->slug }}/edit">Edit</a>
                <form class="d-inline" action="/dashboard/movie/{{ $movie->slug }}" method="post">
                    @method("delete")
                    @csrf
                    <button class="badge text-bg-danger border-0" type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
          </tr>
        @endforeach
       
      </tbody>
    </table>
  </div>
@endsection