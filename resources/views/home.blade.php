@extends('layout.app')

@section('title')
    Accueil
@endsection

@section('content')
    <p>Bienvenue sur la page d'accueil !</p>

    @if (!$user)
        <p>
            Vous n'êtes pas connecté.<br>
            Pour gérez vos partages, veuillez vous connecté
        </p>
    @else
        <p>Ravi de vous revoir {{ $user->name }} !</p>
        <p>En ce {{ now()->format('d') }} {{ \Carbon\Carbon::now()->locale('fr_FR')->monthName }}, vous avez :</p>

        <ul>
            <li>
                <a href=""> {{-- TODO : redirect to the page when it is created (issue #5) --}}
                    {{ $user->asks->count() }} demande(s) d'emprunt
                </a>
            </li>
            <li>
                <a href="{{ route('users.lends', Auth::user()->id) }}"">
                    {{ $user->lends->count() }} prêt(s) en cours
                </a>
                <div>
                    <ul>
                        @if ($lends->count() > 0)
                            @foreach ($lends as $lend) {{-- type of : Share --}}
                                <x-share
                                    :title="$lend->item->title"
                                    :name="$lend->borrower ? $lend->borrower->name : $lend->nonuser_borrower"
                                    :deadline="$lend->deadline"
                                />
                            @endforeach
                        @endif
                    </ul>
                </div>
            </li>
            <li>
                <a href="{{ route('users.borrows', Auth::user()->id) }}">
                    {{ $user->borrows->count() }} emprunt(s) en cours
                </a>
                <div>
                    <ul>
                        @if ($borrows->count() > 0)
                            @foreach ($borrows as $borrow) {{-- type of : Share --}}
                                <x-share
                                    :title="$borrow->item->title"
                                    :name="$borrow->lender ? $borrow->lender->name : $borrow->nonuser_lender"
                                    :deadline="$borrow->deadline"
                                />
                            @endforeach
                        @endif
                    </ul>
                </div>
            </li>
        </ul>
    @endif
@endsection
