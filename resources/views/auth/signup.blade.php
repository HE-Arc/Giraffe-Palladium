@extends('layout.app')

@section('title')
    Créer un compte
@endsection

@section('content')
    <form action="/signup" method="post">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input id="email" class="form-control" name="email" type="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input id="password" class="form-control" name="password" type="password" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nom d'utilisateur</label>
            <input id="name" class="form-control" name="name" type="text" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" class="form-control" name="description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Créer mon compte</button>
    </form>
@endsection
