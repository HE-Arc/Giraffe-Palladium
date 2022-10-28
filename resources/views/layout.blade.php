<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Site web</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/" class="nav-link">Accueil</a></li>
                <li><a href="/users" class="nav-link">Liste des utilisateurs</a></li>
                @if(session('user'))
                    <li><a href="/users/{{ session('user')->id }}" class="nav-link">Mon profil ({{ session('user')->name }})</a></li>
                    <li><a href="/signout" class="nav-link">Déconnexion</a></li>
                @else
                    <li><a href="/signin" class="nav-link">Connexion</a></li>
                    <li><a href="/signup" class="nav-link">Inscription</a></li>
                @endif
                <li><a href="/about" class="nav-link">À propos</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <main>
            <h1>@yield('title')</h1>
            @if (session('success'))
                <p class="msgbox msg-success">{{ session('success') }}</p>
            @endif
            @if (session('error'))
                <p class="msgbox msg-error">{{ session('error') }}</p>
            @endif
            @yield('content')
        </main>
    </div>
    <footer>&copy; HE-Arc &ndash; {{ date('Y') }}</footer>
</body>
</html>
