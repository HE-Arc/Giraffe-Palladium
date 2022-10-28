@extends('layout')

@section('title')
    Profil utilisateur
@endsection

@section('content')
    @php($user = session('user'))
    <form action="/users/{{ $user->id }}" method="post">
        {{ method_field('PUT') }}
        @csrf
        <div class="form-group">
            <label for="name">Nom d'utilisateur</label>
            <input id="name" name="name" type="text" value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label for="email">Adresse email</label>
            <input id="email" name="email" type="email" value="{{ $user->email }}">
        </div>
        <div class="form-group">
            <label for="password">Nouveau mot de passe (optionnel)</label>
            <input id="password" name="password" type="password">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ $user->description }}</textarea>
        </div>
        <button type="submit">Modifier mon profil</button>
    </form>
@endsection
