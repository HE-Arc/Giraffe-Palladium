@extends('layout')

@section('content')
    <h1>Création de compte</h1>
    <form action="/signup" method="post">
        @csrf
        <div class="form-group">
            <label for="email">Adresse email</label>
            <input id="email" name="email", type="email">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input id="password" name="password", type="password">
        </div>
        <div class="form-group">
            <label for="username">Adresse email</label>
            <input id="username" name="username", type="text">
        </div>
        <button type="submit">Créer mon compte</button>
@endsection
