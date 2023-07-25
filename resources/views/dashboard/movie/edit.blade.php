@extends('layouts.dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit {{ $movie->title }}</h1>
</div>

<img src="/{{ $movie->img }}" id="preview-img" class="d-block mb-3" width="300px" >

<label for=myDropzone class="form-label">Video</label>
<form action="/upload" method="post" class="dropzone mb-3 col-lg-8" id="myDropzone">
  @csrf
</form>


<form action="/dashboard/movie/{{ $movie->slug }}" method="post" class="col-md-8 mb-3" enctype="multipart/form-data">
  @method("PUT")
  @csrf

  <div class="mb-3">
    <label for="img" class="form-label">Image</label>
    <input class="form-control" type="file" id="img" name="img">
    <input type="hidden" name="oldImg" value="{{ $movie->img }}">
  </div>

  <input type="hidden" id="video" name="video">
  <input type="hidden" name="oldVideo" value="{{ $movie->video }}">

    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control @error("title") is-invalid @enderror" id="title" name="title" value="{{ $movie->title }}" required>
      @error('title')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="id" class="form-label">Genre</label>
      <select class="form-select @error("genre") is-invalid @enderror" id="genre" multiple>
        @foreach ($genres as $genre)

          @if ($movie->genre->contains("name", $genre->name))
          <option value="{{ $genre->id }}" selected>{{ $genre->name }}</option>

          @else
          <option value="{{ $genre->id }}">{{ $genre->name }}</option>

          @endif

        @endforeach
      </select>
      <input type="hidden" name="genre">
      @error('genre')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

      <div class="row">

        <div class="col-lg">
          <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <input type="number" class="form-control @error("rating") is-invalid @enderror" id="rating" max="10" min="1" name="rating" value="{{ $movie->rating }}" required>
            @error('rating')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="metascore" class="form-label">Metascore</label>
            <input type="number" class="form-control @error("metascore") is-invalid @enderror" id="metascore" max="100" min="1" name="metascore" value="{{ $movie->metascore }}" required>
            @error('metascore')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
        
        <div class="col-lg">
          <div class="mb-3">
            <label for="duration" class="form-label">Duration</label>
            <input type="number" class="form-control @error("duration") is-invalid @enderror" id="duration" name="duration" value="{{ $movie->duration }}" required>
            @error('duration')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="datepicker" class="form-label">Release Date</label>
            <input type="text" class="form-control @error("release_date") is-invalid @enderror" id="datepicker" placeholder="Select date" name="release_date" value="{{ $movie->release_date }}" required>
            @error('release_date')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>

        </div>

      <div class="mb-3">
        <label for="synopsis" class="form-label">Synopsis</label>
        <textarea class="form-control @error("synopsis") is-invalid @enderror" id="synopsis" style="height: 100px" name="synopsis" required>{{ $movie->synopsis }}</textarea>
        @error('synopsis')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
    <button type="submit" class="btn btn-dark">Update Movie</button>
</form>
@endsection