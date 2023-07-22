@extends('layouts.dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add New Movie</h1>
</div>

<img id="preview-img" class="d-block mb-3" width="300px" >

<label for=myDropzone class="form-label">Video</label>
<form action="/upload" method="post" class="dropzone mb-3" id="myDropzone">
  @csrf
</form>


<form action="/dashboard/movie" method="post" class="col-md-8 mb-3" enctype="multipart/form-data">
  @csrf

  <div class="mb-3">
    <label for="img" class="form-label">Image</label>
    <input class="form-control" type="file" id="img" name="img">
  </div>

  <input type="hidden" id="video" name="video">

    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control" id="title" name="title">
    </div>

      <div class="row">

        <div class="col-lg">
          <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <input type="number" class="form-control" id="rating" max="10" min="1" name="rating">
          </div>

          <div class="mb-3">
            <label for="metascore" class="form-label">Metascore</label>
            <input type="number" class="form-control" id="metascore" max="100" min="1" name="metascore">
          </div>
        </div>
        
        <div class="col-lg">
          <div class="mb-3">
            <label for="duration" class="form-label">Duration</label>
            <input type="number" class="form-control" id="duration" name="duration">
          </div>

          <div class="mb-3">
            <label for="datepicker" class="form-label">Release Date</label>
            <input type="text" class="form-control" id="datepicker" placeholder="Select date" name="release_date">
          </div>
        </div>

          

        </div>

        
      

      <div class="mb-3">
        <label for="synopsis" class="form-label">Synopsis</label>
        <textarea class="form-control" id="synopsis" style="height: 100px" name="synopsis"></textarea>
      </div>
    <button type="submit" class="btn btn-dark">Post Movie</button>
</form>
@endsection