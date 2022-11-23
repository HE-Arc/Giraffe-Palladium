@extends('layout.app')

@section('title')
    Profil utilisateur
@endsection

@section('content')
    <p><strong>Nom d'utilisateur</strong> : {{ $user->name }}</p>
    <p><strong>Email</strong> : {{ $user->email }}</p>
    <p><strong>Créé le</strong> : {{ $user->created_at }}</p>
    <p><strong>Modifié le</strong> : {{ $user->updated_at }}</p>
    <p><strong>Description</strong> : <span style="white-space: pre-wrap">{{ $user->description }}</span></p>
    @if ($isMe)
        <p><a href="{{ route('users.edit', $user->id) }}">Modifier mon profil</a></p>
    @endif
@endsection
