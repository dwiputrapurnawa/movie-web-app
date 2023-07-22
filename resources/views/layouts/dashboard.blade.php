<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.5/datatables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
</head>
<body>

    <header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">Movie App</a>

        <ul class="navbar-nav flex-row d-md-none">
            <li class="nav-item text-nowrap">
              <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span data-feather="list"></span>
              </button>
            </li>
          </ul>
        
      </header>
      
      <div class="container-fluid">
        <div class="row">
          <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary" style="height: 100vh">
            <div class="offcanvas-lg offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
              <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="sidebarMenuLabel">Movie App</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto  ">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="/dashboard">
                        <span data-feather="home"></span>
                      Dashboard
                    </a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" aria-current="page" href="/dashboard/movie">
                        <span data-feather="film"></span>
                      Movie
                    </a>
                  </li>
                </ul>

                <hr class="my-3">

                <ul class="nav flex-column mb-auto">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2" href="/logout">
                            <span data-feather="log-out"></span>
                            Logout
                        </a>
                    </li>
                </ul>
              </div>
            </div>
          </div>
      
          <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            

            @yield('content')

          </main>
        </div>
      </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.5/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script src="/js/dashboard.js"></script>
    <script src="/js/dropzone.js"></script>
</body>
</html>