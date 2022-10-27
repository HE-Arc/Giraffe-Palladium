@extends('layout')

@section('content')
    <h1>Profile utilisateur</h1>
    <p><strong>Nom d'utilisateur</strong> : {{ $user->name }}</p>
    <p><strong>Email</strong> : {{ $user->email }}</p>
    <p><strong>Créé le</strong> : {{ $user->created_at }}</p>
    <p><strong>Modifié le</strong> : {{ $user->updated_at }}</p>
    @if($isMe)
        <p><a href="/account/edit">Modifier mon profil</a></p>
    @endif
@endsection
