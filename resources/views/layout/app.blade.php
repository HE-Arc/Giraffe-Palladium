<!DOCTYPE html>
<html lang="fr" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>@yield('title') - Giraffe Palladium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ url('images/logo.png') }}">
</head>

<body class="d-flex flex-column h-100">
    <header>
        <nav class="navbar navbar-expand-xl bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{url('images/logo.png')}}" alt="Logo" height="30" class="d-inline-block align-text-top" />
                    Giraffe Palladium
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex justify-content-end align-items-center">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteNamed('users.index') ? 'active' : '' }}"
                                aria-current="page" href="{{ route('users.index') }}">Utilisateurs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteNamed('items.index') ? 'active' : '' }}"
                                aria-current="page" href="{{ route('items.index') }}">Objets empruntables</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('users.show') ? 'active' : '' }}"
                                    aria-current="page" href="{{ route('users.show', Auth::user()->id) }}">
                                    Mon profil
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('users.borrows') ? 'active' : '' }}"
                                    aria-current="page" href="{{ route('users.borrows', Auth::user()->id) }}">
                                    Mes emprunts
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('users.lends') ? 'active' : '' }}"
                                    aria-current="page" href="{{ route('users.lends', Auth::user()->id) }}">
                                    Mes prêts
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('users.asks') ? 'active' : '' }}"
                                    aria-current="page" href="{{ route('users.asks', Auth::user()->id) }}">
                                    Demandes d'emprunt
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('auth.signout.disconnect') ? 'active' : '' }}"
                                    aria-current="page" href="{{ route('auth.signout.disconnect') }}">
                                    Déconnexion
                                </a>
                            </li>
                        @endauth
                        @guest
                            <li class="nav-item">
                                <a href="{{ route('auth.signin.index') }}"
                                    class="nav-link {{ Route::currentRouteNamed('auth.signin.index') ? 'active' : '' }}">Connexion</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('auth.signup.create') }}"
                                    class="nav-link  {{ Route::currentRouteNamed('auth.signup.create') ? 'active' : '' }}">Inscription</a>
                            </li>
                        @endguest
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteNamed('about') ? 'active' : '' }}"
                                aria-current="page" href="{{ route('about') }}">À propos</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="flex-shrink-0 mt-4">
        <div class="container">
            <h1>@yield('title')</h1>
            @yield('content')
        </div>
    </main>
    <footer class="footer mt-auto d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="container">
            <div class="col-md-4 d-flex align-items-center">
                <a href="{{ route('home') }}" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                    <svg class="bi" width="30" height="24">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>
                <span class="mb-3 mb-md-0 text-muted">&copy; HE-Arc &ndash; {{ date('Y') }}</span>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

    @yield('js')
</body>

</html>
