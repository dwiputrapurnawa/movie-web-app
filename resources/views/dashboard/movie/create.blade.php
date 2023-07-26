@extends('layouts.dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add Movie</h1>

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="/dashboard/movie">Movie</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Movie</li>
      </ol>
    </nav>
</div>

<img id="preview-img" class="d-block mb-3" width="300px" >


@error('video')
<div class="alert alert-danger alert-dismissible fade show col-lg-8" role="alert">
  {{ $message }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@enderror

<label for=myDropzone class="form-label">Video</label>
<form action="/upload" method="post" class="dropzone mb-3 col-lg-8" id="myDropzone">
  @csrf
</form>



<form action="/dashboard/movie" method="post" class="col-md-8 mb-3" enctype="multipart/form-data">
  @csrf

  <div class="mb-3">
    <label for="img" class="form-label">Image</label>
    <input class="form-control" type="file" id="img" name="img" accept=".png,.jpg">
  </div>

  <input type="hidden" id="video" name="video">

    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control @error("title") is-invalid @enderror" id="title" name="title" value="{{ old("title") }}" required>
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
          <option value="{{ $genre->id }}">{{ $genre->name }}</option>
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
            <input type="number" class="form-control @error("rating") is-invalid @enderror" id="rating" max="5" min="0" name="rating" value="{{ old("rating") }}" required>
            @error('rating')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="metascore" class="form-label">Metascore</label>
            <input type="number" class="form-control @error("metascore") is-invalid @enderror" id="metascore" max="100" min="1" name="metascore" value="{{ old("metascore") }}" required>
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
            <input type="number" class="form-control @error("duration") is-invalid @enderror" id="duration" name="duration" value="{{ old("duration") }}" required>
            @error('duration')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="datepicker" class="form-label">Release Date</label>
            <input type="text" class="form-control @error("release_date") is-invalid @enderror" id="datepicker" placeholder="Select date" name="release_date" value="{{ old("release_date") }}" required>
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
        <textarea class="form-control @error("synopsis") is-invalid @enderror" id="synopsis" style="height: 100px" name="synopsis" required>{{ old("synopsis") }}</textarea>
        @error('synopsis')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
    <button type="submit" class="btn btn-dark"><i class="bi bi-camera-reels"></i> Post Movie</button>
</form>
@endsection