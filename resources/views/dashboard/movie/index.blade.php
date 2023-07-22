@extends('layouts.dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Movie</h1>
</div>

    @if (session()->has("success"))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session("success") }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <a class="btn btn-dark mb-4" href="/dashboard/movie/create">Add Movie</a>

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
            <td>{{ $movie->rating }}</td>
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