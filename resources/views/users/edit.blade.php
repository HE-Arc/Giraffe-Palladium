@extends('layout.app')

@section('title')
    Profil utilisateur
@endsection

@section('content')
    @php($user = session('user'))
    <div class="row">
        <form action="{{ route('users.update', $user->id) }}" method="post" class="col-md-8 col-lg-6 col-xxl-4">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nom d'utilisateur</label>
                <input id="name" class="form-control" name="name" type="text" value="{{ $user->name }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Adresse email</label>
                <input id="email" class="form-control" name="email" type="email" value="{{ $user->email }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Nouveau mot de passe</label>
                <input id="password" class="form-control" name="password" type="password">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" class="form-control" name="description">{{ $user->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Modifier mon profil</button>
        </form>
    </div>
@endsection
