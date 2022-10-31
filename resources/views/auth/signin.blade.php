@extends('layout.app')

@section('title')
    Connexion
@endsection

@section('content')
    <form action="/signin" method="post">
        @csrf
        <div class="form-group">
            <label for="email" class="form-item">Adresse email</label>
            <input id="email" class="form-item" name="email" type="email" required>
        </div>
        <div class="form-group">
            <label for="password" class="form-item">Mot de passe</label>
            <input id="password" class="form-item" name="password" type="password" required>
        </div>
        <button type="submit" class="btn form-item">Se connecter</button>
    @endsection
