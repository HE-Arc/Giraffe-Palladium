@extends('layout')

@section('title')
    Connexion
@endsection

@section('content')
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
