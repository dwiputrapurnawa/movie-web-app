@extends('layouts.auth')

@section('title')
    Login
@endsection

@section('content')
<form action="/login" method="post">
  @csrf

  @if (session()->has("registerSuccess"))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session("registerSuccess") }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

    @if (session()->has("loginError"))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session("loginError") }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <h1 class="h3 mb-3 fw-normal">Please Login</h1>

    <div class="form-floating">
      <input type="email" class="form-control @error("email") is-invalid @enderror" id="email" placeholder="name@example.com" name="email" required>
      <label for="floatingInput">Email address</label>
      @error('email')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
      <label for="floatingPassword">Password</label>
    </div>

    <div class="form-check text-start my-3">
      <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        Remember me
      </label>
    </div>
    <button class="btn btn-primary w-100 py-2" type="submit">Login</button>
    <small class="d-block text-center mt-3">Not registered? <a href="/register">Register Now!</a></small>
    <p class="copyright-date mt-5 mb-3 text-body-secondary"></p>
  </form>

  
@endsection