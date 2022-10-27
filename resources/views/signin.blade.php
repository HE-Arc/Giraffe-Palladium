@extends('layout')

@section('content')
    <h1>Connexion</h1>
    @if($error)
        @if($error == 'email_already_exists')
            <p class="msg-error">Cette adresse email est déjà utilisée.</p>
        @if($error == 'unknown_error')
            <p class="msg-error">Une erreur est survenue lors de l'édition du compte.</p>
        @endif
    @endif
    <form action="/signin" method="post">
        @csrf
        <div class="form-group">
            <label for="email">Adresse email</label>
            <input id="email" name="email" type="email">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input id="password" name="password" type="password">
        </div>
        <button type="submit">Se connecter</button>
@endsection
