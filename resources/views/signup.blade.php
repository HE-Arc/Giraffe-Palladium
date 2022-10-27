@extends('layout')

@section('content')
    <h1>Création de compte</h1>
    @if($error)
        @if($error == 'some_fields_required')
            <p class="msg-error">L'email et le nom d'utilisateur sont requis.</p>
        @elseif($error == 'email_already_exists')
            <p class="msg-error">Cette adresse email est déjà utilisée.</p>
        @endif
    @endif
    <form action="/signup" method="post">
        @csrf
        <div class="form-group">
            <label for="email">Adresse email</label>
            <input id="email" name="email" type="email">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input id="password" name="password" type="password">
        </div>
        <div class="form-group">
            <label for="name">Nom d'utilisateur</label>
            <input id="name" name="name" type="text">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description"></textarea>
        </div>
        <button type="submit">Créer mon compte</button>
@endsection
