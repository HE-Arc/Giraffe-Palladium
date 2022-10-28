@extends('layout')

@section('title')
    Liste des utilisateurs
@endsection

@section('content')
    <ul>
        @foreach($users as $user)
            <li><a href="/users/{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</a></li>
        @endforeach
    </ul>
@endsection
