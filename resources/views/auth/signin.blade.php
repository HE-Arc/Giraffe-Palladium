@extends('layout.app')

@section('title')
    Connexion
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
    <form action="/signin" method="post" class="col-md-8 col-lg-6 col-xxl-4">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input id="email" class="form-control" name="email" type="email" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input id="password" class="form-control" name="password" type="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    @endsection
