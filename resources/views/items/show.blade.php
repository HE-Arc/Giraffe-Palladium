@extends('layout.app')

@section('title')
    Visualisation de l'objet
@endsection

@section('content')
    <h2>{{ $item->title }}</h2>
    @if ($item->description)
        <p class="alert alert-light border border-1">{{ $item->description }}</p>
    @endif
    @php
        $isAlreadyShared = $shares->count();
    @endphp

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
        @if ($item->listed && $isAlreadyShared)
            <div class="alert alert-warning" role="alert">
                <p>Cet objet est actuellement partagé à quelqu'un.</p>
                <p class="mb-0">Il n'est donc pas visible pour les autres utilisateurs.</p>
            </div>
        @endif

        <a class="btn btn-primary bi bi-pencil" href="{{ route('items.edit', $item->id) }}"> Modifier</a>
        <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger bi bi-trash3" title="Delete"> Supprimer</button>
        </form>

        @if ($isAlreadyShared)
            <hr>

            <h2 class="mt-3">Partages en cours</h2>

            <div class="table-responsive rounded-2 border border-gray">
                <table class=" mb-0 table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Partagé avec</th>
                            <th scope="col">Date limite</th>
                            <th></th> {{-- Edit button --}}
                        </tr>
                    </thead>
                    <tbody>
                        {{-- type of : Share --}}
                        @foreach ($shares as $share)
                            @php
                                $linkedUser = $share->borrower ? $share->borrower : $share->nonuser_borrower;
                                if ($linkedUser == auth()->user()) {
                                    $linkedUser = $share->lender ? $share->lender : $share->nonuser_lender;
                                }
                            @endphp

                            <x-share :item="null" :user="$linkedUser" :deadline="$share->deadline" :editLink="route('shares.edit', $share->id)" />
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    @else
        <p>
            Proposé par
            <a href="{{ route('users.show', $item->owner->id) }}" class="link-dark">{{ $item->owner->name }}
                ({{ $item->owner->email }})
            </a>
        </p>

        @if ($item->listed && !$isAlreadyShared)
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
        @else
            <button type="button" class="btn btn-secondary disabled">Non disponible à l'emprunt</button>
        @endif
    @endif
@endsection
