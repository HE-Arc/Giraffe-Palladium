@extends('layout.app')

@section('title')
    @if ($isMe)
        Mon profil
    @else
        {{ $user->name }}
    @endif
@endsection

@section('content')
    <p><strong>Email</strong> : {{ $user->email }}</p>
    <p><strong>Description</strong> : <span style="white-space: pre-wrap">{{ $user->description }}</span></p>
    @if ($isMe)
        <p><a href="{{ route('users.edit', $user->id) }}">Modifier mon profil</a></p>
    @endif

    <h3>
        @if ($isMe)
            Mes objets
        @else
            Objets qu'iel propose
        @endif
    </h3>
    <ul>
        @foreach ($items as $item)
            <li>
                <a href="{{ route('items.show', $item->id) }}">{{ $item->title }}</a>
            </li>
        @endforeach
    </ul>
    @if ($isMe)
        <a class="btn btn-primary" href="{{ route('items.create') }}">Ajouter un objet</a>
    @endif
    @empty($items->all())
        <p>
            @if ($isMe)
                Vous n'avez pas encore proposé d'objets.
            @else
                Cet utilisateur n'a pas encore proposé d'objets.
            @endif
        </p>
    @endempty
@endsection
