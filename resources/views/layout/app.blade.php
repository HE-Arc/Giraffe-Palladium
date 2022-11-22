<!DOCTYPE html>
<html lang="fr" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Site web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body class="d-flex flex-column h-100">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32">
                <use xlink:href="#bootstrap"></use>
            </svg>
            <span class="fs-4">Giraffe Palladium</span>
        </a>
        <ul class="nav nav-pills">
            <li><a href="/" class="nav-link">Accueil</a></li>
            <li><a href="/users" class="nav-link">Liste des utilisateurs</a></li>
            @if (session('user'))
                <li><a href="/users/{{ session('user')->id }}" class="nav-link">Mon profil
                        ({{ session('user')->name }})</a></li>
                <li><a href="/signout" class="nav-link">Déconnexion</a></li>
            @else
                <li><a href="/signin" class="nav-link">Connexion</a></li>
                <li><a href="/signup" class="nav-link">Inscription</a></li>
            @endif
            <li><a href="/about" class="nav-link">À propos</a></li>
        </ul>
    </header>
    <main class="flex-shrink-0">
        <div class="container">
            <h1>@yield('title')</h1>
            @if (session('success'))
                <p class="msgbox msg-success">{{ session('success') }}</p>
            @endif
            @if (session('error'))
                <p class="msgbox msg-error">{{ session('error') }}</p>
            @endif
            <div class="container">
                @yield('content')
            </div>
        </div>
    </main>
    <footer class="footer mt-auto d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="container">
            <div class="col-md-4 d-flex align-items-center">
                <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
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
</body>

</html>
