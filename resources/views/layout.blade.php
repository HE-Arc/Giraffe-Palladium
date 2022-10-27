<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
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
                <li><a href="/signin">Connexion</a></li>
                <li><a href="/signup">Création de compte</a></li>
                <li><a href="/account/edit">Profil utilisateur</a></li>
                <li><a href="/account">Liste des utilisateurs</a></li>
            </ul>
        </nav>
    </header>
    <main>
        @if(session('user'))
            <p>Bonjour <strong>{{ session('user')->name }}</strong> ! <a href="/signout">Se déconnecter</a></p>
        @else
            <p>Bonjour visiteur !</p>
        @endif
        @yield('content')
    </main>
    <footer>FOOTER</footer>
</body>
</html>
