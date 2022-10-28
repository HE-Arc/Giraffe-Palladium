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
    <p>Page {{ $page }} sur {{ $total }}</p>
    <p>
        @if($page > 1)
            <a href="/users?page={{ $page - 1 }}">Page précédente</a>
        @endif
        @if($page > 1 && $page < $total)
            <span> | </span>
        @endif
        @if($page < $total)
            <a href="/users?page={{ $page + 1 }}">Page suivante</a>
        @endif
    </p>
@endsection
