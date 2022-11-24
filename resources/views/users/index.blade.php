@extends('layout.app')

@section('title')
    Liste des utilisateurs
@endsection

@section('content')
    <ul>
        @foreach ($users as $user)
            <li><a href="{{ route('users.show', $user->id) }}">{{ $user->name }} ({{ $user->email }})</a></li>
        @endforeach
    </ul>
    <div class="d-flex">
        {{ $users->links() }}
    </div>
@endsection
