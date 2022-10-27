@extends('layout')

@section('content')
    <h1>Liste des utilisateurs</h1>
    <ul>
        @foreach($users as $user)
            <li><a href="/account/{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</a></li>
        @endforeach
    </ul>
@endsection
