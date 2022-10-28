@extends('layout')

@section('title')
    Créer un compte
@endsection

@section('content')
    <form action="/signup" method="post">
        @csrf
        <div class="form-group">
            <label for="email" class="form-item">Adresse email</label>
            <input id="email" class="form-item" name="email" type="email" required>
        </div>
        <div class="form-group">
            <label for="password" class="form-item">Mot de passe</label>
            <input id="password" class="form-item" name="password" type="password" required>
        </div>
        <div class="form-group">
            <label for="name" class="form-item">Nom d'utilisateur</label>
            <input id="name" class="form-item" name="name" type="text" required>
        </div>
        <div class="form-group">
            <label for="description" class="form-item">Description</label>
            <textarea id="description" class="form-item" name="description"></textarea>
        </div>
        <button type="submit" class="btn form-item">Créer mon compte</button>
    </form>
@endsection
