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
                <li><a href="/">Accueil</a></li>
                <li><a href="/users">Liste des utilisateurs</a></li>
                @if(session('user'))
                    <li><a href="/users/{{ session('user')->id }}">Mon profil</a></li>
                    <li><a href="/signout">Déconnexion</a></li>
                @else
                    <li><a href="/signin">Connexion</a></li>
                    <li><a href="/signup">Inscription</a></li>
                @endif
                <li><a href="/about">À propos</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <main>
            @if(session('user'))
                <p>Bonjour <strong>{{ session('user')->name }}</strong> ! <a href="/signout">Se déconnecter</a></p>
            @else
                <p>Bonjour visiteur !</p>
            @endif
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
    <footer>FOOTER</footer>
</body>
</html>
