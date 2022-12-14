@extends('layout.app')

@section('title')
    {{ $item->title }}
@endsection

@section('content')
    <p>{{ $item->description }}</p>

    @if ($isMine)
        @php
            $autorised = $item->listed ? 'autorisez' : 'refusez';
            $autorisedColor = $item->listed ? 'text-success' : 'text-danger';
        @endphp
        <p>
            Vous
            <span class='fw-semibold {{ $autorisedColor }}'>{{ $autorised }}</span>
            cet objet à être disponible dans la liste d'emprunt
        </p>
        @if ($item->listed)
            {{-- TODO : && partagé --}}
            <div class="alert alert-warning" role="alert">
                <p>Cet objet est actuellement partagé à quelqu'un.</p>
                <p class="mb-0">Il n'est donc pas visible pour les autres utilisateurs.</p>
            </div>
        @endif
        <a class="btn btn-primary" href="{{ route('items.edit', $item->id) }}">Edit</a>
        <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" title="Delete">Delete</button>
        </form>
    @else
        <p>
            Objet proposé par
            <a href="{{ route('users.show', $item->owner->id) }}">{{ $item->owner->name }}
                ({{ $item->owner->email }})</a>
        </p>

        @if ($item->listed)
            {{-- TODO : && Non partagé --}}
            <p>Cet objet est disponible à l'emprunt.</p>
        @else
            <p>Cet objet n'est pas disponible à l'emprunt.</p>
        @endif

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
