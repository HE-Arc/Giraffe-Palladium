@extends('layout.app')

@section('title')
    {{ $item->title }}
@endsection

@section('content')
    @if ($isMine)
        <p>{{ $item->description }}</p>
        <a class="btn btn-primary" href="{{ route('items.edit', $item->id) }}">Edit</a>
        <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" title="Delete">Delete</button>
        </form>
    @else
        <p>
            Objet proposé par
            <a href="{{ route('users.show', $item->owner->id) }}">{{ $item->owner->name }} ({{ $item->owner->email }})</a>
        </p>

        @if (!auth()->guest())
            @if (is_null($myAsk))
                <form action="{{ route('asks.store') }}" method="post" class="d-inline">
                    @csrf
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <button type="submit" class="btn btn-primary" title="Ask">Demander à emprunter l'objet</button>
                </form>
            @else
                <form action="{{ route('asks.destroy', $myAsk->id) }}" method="post" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" title="Cancel">Annuler la demande d'emprunt</button>
                </form>
            @endif
        @endif
    @endif
@endsection
