@extends('layout.app')

@section('title')
    @if ($isMe)
        Mon profil
    @else
        Utililisateur
    @endif
@endsection

@section('content')
    <h2>
        @if ($isMe)
            {{ $user->name }} ({{ $user->email }})
        @else
            {{ $user->name }} (<a class="link-dark" href="mailto:{{ $user->email }}">{{ $user->email }}</a>)
        @endif
    </h2>
    <p class="alert alert-light border border-1">
        @if ($user->description == '')
            <i class="text-muted">Aucune description</i>
        @else
            <span class="text-break text-multiline">{{ $user->description }}</span>
        @endif
    </p>
    @if ($isMe)
        <p>
            <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Modifier mon profil</a>
        </p>
    @endif
    @empty($items->all())
        <p>
            @if ($isMe)
                Vous n'avez pas encore proposé d'objets.
            @else
                Cet utilisateur n'a pas encore proposé d'objets.
            @endif
        </p>
    @else
        <h3>
            @if ($isMe)
                Mes objets
            @else
                Objets qu'iel propose
            @endif
        </h3>
        <div class="container">
            <ul class="row p-0">
                @foreach ($items as $item)
                    <li class="col-lg-6 list-unstyled p-1">
                        <a href="{{ route('items.show', $item->id) }}"
                            class="d-block link-dark h-100
                            rounded-2 border border-gray bg-light text-decoration-none p-3">
                            <p class="text-center m-0 text-truncate"><strong>{{ $item->title }}</strong></p>
                            <p class="text-center m-0 mt-1 text-truncate">{{ $item->description }}</p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endempty
    @if ($isMe)
        <p>
            <a class="btn btn-primary" href="{{ route('items.create') }}">Ajouter un objet</a>
        </p>
    @endif
@endsection
