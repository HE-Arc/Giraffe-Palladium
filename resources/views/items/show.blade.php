@extends('layout.app')

@section('title')
    {{ $item->title }}
@endsection

@section('content')
    @if ($isMine)
        <p>{{ $item->description }}</p>
        <a class="btn btn-primary" href="{{ route('items.edit', $item->id) }}">Edit</a>
    @else
        <p>
            Objet proposé par
            <a href="{{ route('users.show', $item->owner->id) }}">{{ $item->owner->name }} ({{ $item->owner->email }})</a>
        </p>
        <p>
            <a class="btn btn-primary" href="#">Demander à emprunter l'objet</a>
        </p>
    @endif
@endsection
