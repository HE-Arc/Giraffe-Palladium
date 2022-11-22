@extends('layout.app')

@section('title')
    Connexion
@endsection

@section('content')
    <form action="/signin" method="post">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input id="email" class="form-control" name="email" type="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input id="password" class="form-control" name="password" type="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    @endsection
