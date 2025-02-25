<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CesaeAlunos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
   <nav>
      <div class="container-fluid ">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

          <img src="{{ asset('imagens/logo.png')}}" alt="" width="32" height="32">
          <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li><a href="#" class="nav-link px-2 link-secondary">Overview</a></li>
            <li><a href="#" class="nav-link px-2 link-body-emphasis">Inventory</a></li>
            <li><a href="#" class="nav-link px-2 link-body-emphasis">Customers</a></li>
            <li><a href="#" class="nav-link px-2 link-body-emphasis">Products</a></li>
          </ul>

          <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
            <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
          </form>

          <div class="dropdown text-end">
            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
            </a>
            <ul class="dropdown-menu text-small" style="">
              <li><a class="dropdown-item" href="#">New project...</a></li>
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
          </div>
        </div>
    </nav>
      </div><div class="container flex-grow-1">
        @yield('content')
    </div>
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 mt-5 border-top">
        <div class="col-md-4 d-flex align-items-center">
          <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
            <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
          </a>
          <span class="text-body-secondary">© 2025 desenvolvido</span>
        </div>
        <ul class="nav col-md-1 justify-content list-unstyled d-flex">
          <li class="ms-3"><a class="text-body-secondary" href="#"><img src="{{asset('imagens/linkedin.svg')}}" alt=""></a></li>
          <li class="ms-3"><a class="text-body-secondary" href="#"><img src="{{asset('imagens/instagram.svg')}}" alt=""></a></li>
          <li class="ms-3"><a class="text-body-secondary" href="#"><img src="{{asset('imagens/facebook.svg')}}" alt=""></a></li>
        </ul>
      </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>
</html>
