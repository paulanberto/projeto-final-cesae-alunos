<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Código Aberto</title>
    <link rel="shortcut icon" href="{{ asset('imagens/logoOficial.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>


<body class="d-flex flex-column min-vh-100">
    <nav>
        <div class="container-fluid ">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

                <img src="{{ asset('imagens/navTeste.png') }}" alt="" width="200">
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="{{ route('tema') }}" class="nav-link px-2 link-body-emphasis">Temas</a></li>
                    <li><a href="{{ route('forum.index') }}"class="nav-link px-2 link-body-emphasis">Fórum</a></li>

                </ul>
                <div class="dropdown text-end">
                    <a href="#" class="user d-block link-body-emphasis text-decoration-none dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-regular fa-user fa-1x"></i>

                    </a>
                    <ul class="dropdown-menu text-small" style="">
                        <li><a class="dropdown-item" href="{{ route('dashboard.view') }}">Perfil</a></li>
                        <li>

                            <hr class="dropdown-divider">

                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Log out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    @section('full_width_content')
    @show

    <div class="container flex-grow-1">
        @yield('content')
    </div>
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 mt-5 border-top mt-auto">
        <div class="col-md-7 d-flex align-items-center">
            <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                <svg class="bi" width="30" height="24">

                    <use xlink:href="#bootstrap"></use>

                </svg>
            </a>
            <span class="text-body-secondary">© 2025 Desenvolvido por: Bruno Balmant | Filipe Costa | Guilherme Carasek | Paula Berto</span>
        </div>
        <ul class="nav col-md-1 justify-content list-unstyled d-flex md-5">
            <li class="ms-3"><a class="text-body-secondary" href="https://www.linkedin.com/school/cesae-digital/"><i
                        class="fa-brands fa-linkedin"></i></a></li>
            <li class="ms-3"><a class="text-body-secondary" href="https://www.instagram.com/cesae.digital/"><i
                        class="fa-brands fa-instagram"></i></a></li>
            <li class="ms-3"><a class="text-body-secondary" href="https://www.facebook.com/CesaeDigital"><i
                        class="fa-brands fa-facebook"></i></a></li>
        </ul>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>


</html>
