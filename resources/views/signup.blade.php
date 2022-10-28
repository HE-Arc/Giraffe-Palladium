@extends('layout')

@section('title')
    Créer un compte
@endsection

@section('content')
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
    </form>
@endsection
