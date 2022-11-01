@extends('layout.app')

@section('title')
    Profil utilisateur
@endsection

@section('content')
    @php($user = session('user'))
    <form action="{{ route('users.update', $user->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name" class="form-item">Nom d'utilisateur</label>
            <input id="name" class="form-item" name="name" type="text" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label for="email" class="form-item">Adresse email</label>
            <input id="email" class="form-item" name="email" type="email" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label for="password" class="form-item">Nouveau mot de passe</label>
            <input id="password" class="form-item" name="password" type="password">
        </div>
        <div class="form-group">
            <label for="description" class="form-item">Description</label>
            <textarea id="description" class="form-item" name="description">{{ $user->description }}</textarea>
        </div>
        <button type="submit" class="btn form-item">Modifier mon profil</button>
    </form>
@endsection
