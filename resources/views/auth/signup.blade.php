@extends('layout.app')

@section('title')
    Créer un compte
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/signup" method="post" class="col-md-8 col-lg-6 col-xxl-4">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input id="email" class="form-control" name="email" type="email" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input id="password" class="form-control" name="password" type="password" required>
        </div>
        <div class="mb-3">
            <label for="confirm-password" class="form-label">Confirmation mot de passe</label>
            <input id="confirm-password" class="form-control" name="confirm-password" type="password" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nom d'utilisateur</label>
            <input id="name" class="form-control" name="name" type="text" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" class="form-control" name="description">{{ old('description') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Créer mon compte</button>
    </form>
@endsection
