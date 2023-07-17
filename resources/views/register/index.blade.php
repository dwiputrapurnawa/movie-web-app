@extends('layouts.auth')

@section('title')
    Register
@endsection

@section('content')
<form action="/register" method="post">
  @csrf
    <h1 class="h3 mb-3 fw-normal">Please Register</h1>

    <div class="form-floating">
      <input type="email" class="form-control @error("email") is-invalid @enderror" id="email" placeholder="name@example.com" name="email" required>
      <label for="email">Email address</label>
      @error('email')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
      @enderror
    </div>

    <div class="form-floating">
        <input type="text" class="form-control @error("username") is-invalid @enderror" id="username" placeholder="jonhdoe" name="username" required>
        <label for="name">Username</label>
        @error('username')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
    @enderror
    </div>

    <div class="form-floating">
        <input type="text" class="form-control @error("name") is-invalid @enderror" id="name" placeholder="John Doe" name="name" required>
        <label for="name">Name</label>
        @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-floating">
      <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
      <label for="password">Password</label>
    </div>

    <div class="form-check text-start my-3">
      <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        Remember me
      </label>
    </div>
    <button class="btn btn-primary w-100 py-2" type="submit">Register</button>
    <small class="d-block text-center mt-3">Already registered? <a href="/login">Login</a></small>
    <p class="copyright-date mt-5 mb-3 text-body-secondary"></p>
  </form>
@endsection