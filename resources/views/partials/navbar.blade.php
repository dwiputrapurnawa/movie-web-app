<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="/">Movie App</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('/')) ? 'active' : '' }}" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('movie')) ? 'active' : '' }}" href="/movie">Movie List</a>
          </li>
        </ul>
        

        <form class="nav-item ms-4" action="/movie" method="get">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search..." name="search" id="search" value="{{ request("search") }}">
            <button class="btn btn-outline-secondary" type="submit" id="searchButton">Search</button>
          </div>
        </form>

        
      
        <div class="navbar-nav ms-auto">

          @auth

          <div class="nav-item dropdown">

            <a class="dropdown-toggle text-decoration-none text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Welcome, {{ auth()->user()->name }}
            </a>
            
            <ul class="dropdown-menu">
              
              @can("admin")
              <li><a href="/dashboard" class="dropdown-item"><i class="bi bi-graph-up-arrow"></i> Dashboard</a></li>
              @endcan

              <li><a href="/watchlater" class="dropdown-item"><i class="bi bi-stopwatch"></i> Watch Later</a></li>

              <form action="/logout" method="post">
                @csrf
                <button class="dropdown-item" type="submit"><i class="bi bi-box-arrow-right"></i> Logout</button>
              </form>
            </ul>

          </div>

          @else
          <li class="nav-item">
            <a href="/login" class="nav-link"><i class="bi bi-box-arrow-in-left"></i> Login</a>
          </li>
          @endauth

           

           
        </div>
      </div>
    </div>
  </nav>