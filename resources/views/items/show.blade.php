@extends('layout.app')

@section('title')
    Visualisation de l'objet
@endsection

@section('content')
    <h2>{{ $item->title }}</h2>
    @if ($item->description)
        <p class="alert alert-light border border-1">
            <span class="text-break text-multiline">{{ $item->description }}</span>
        </p>
    @endif

    @if ($isMine)
        <p>
            Cet objet est
            <span class='fw-semibold {{ $item->listed ? 'text-success' : 'text-danger' }}'>
                {{ $item->listed ? 'visible' : 'invisible' }}
            </span>
            dans la liste des objets empruntables.
        </p>
        @if ($item->listed && $shares->count() > 0)
            <div class="alert alert-warning" role="alert">
                <p>Cet objet est actuellement partagé à quelqu'un.</p>
                <p class="mb-0">Il n'est donc pas visible pour les autres utilisateurs.</p>
            </div>
        @endif

        <a class="btn btn-primary bi bi-pencil" href="{{ route('items.edit', $item->id) }}"> Modifier</a>

        <button type="button" class="btn btn-danger bi bi-trash3" data-bs-toggle="modal" data-bs-target="#deleteModal">
            Supprimer
        </button>
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content border border-danger border-3">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-danger bi bi-exclamation-circle" id="deleteModalLabel">
                            Confirmation de suppression</h1>
                        <button type="button" id="modalClose" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Souhaitez-vous réellement supprimer cet objet ?</p>
                        <p>Si vous le supprimez, toutes les données associées le seront également.</p>
                        <p class="mb-0 text-danger bi bi-exclamation-square-fill"> Attention, cette action est irréversible.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" title="Delete">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <h2 class="mt-3">Partages en cours</h2>

        @if ($shares->count() > 0)
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
                                if ($linkedUser instanceof \App\Models\User && $linkedUser->id == auth()->id()) {
                                    $linkedUser = $share->lender ? $share->lender : $share->nonuser_lender;
                                }
                            @endphp

                            <x-share :item="null" :user="$linkedUser" :deadline="$share->deadline" :editLink="route('shares.edit', $share->id)" />
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p> Cet objet n'est pas partagé pour le moment. </p>
            <a class="btn btn-primary" href="{{ route('shares.create', ['itemId' => $item->id]) }}" title="Share">
                Ajouter un partage manuellement
            </a>
        @endif
    @else
        <p>
            Proposé par
            <a href="{{ route('users.show', $item->owner->id) }}" class="link-dark">{{ $item->owner->name }}
                ({{ $item->owner->email }})
            </a>
        </p>

        @if ($item->listed && $shares->count() == 0)
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

@section('js')
    <script src="{{ asset('js/modal-utils.js') }}"></script>
    <script>
        focusInput("deleteModal", "modalClose")
    </script>
@endsection
