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
        <p>Ravi de vous revoir <span class="fw-semibold text-info">{{ $user->name }}</span> !</p>
        <p>En ce {{ now()->format('d') }} {{ \Carbon\Carbon::now()->locale('fr_FR')->monthName }}, vous avez :</p>

        <ul class="list-group">
            <li class="my-2 list-group-item list-group-item-info rounded-4">
                <a href="{{ route('users.asks', Auth::user()->id) }}" class="link-dark">
                    {{ $user->offers()->count() }} demande(s) d'emprunt
                </a>
            </li>
            @if ($user->offers()->count() > 0)
                <x-asks :showItem="true" :asks="$asks" />
            @endif

            <li class="my-2 list-group-item list-group-item-info rounded-4">
                <a href="{{ route('users.lends', Auth::user()->id) }}" class="link-dark">
                    {{ $user->lends->count() }} prêt(s) en cours
                </a>
            </li>
            @if ($user->lends->count() > 0)
                <x-shares :shares="$lends" :borrowView="false" />
            @endif

            <li class="my-2 list-group-item list-group-item-info rounded-4">
                <a href="{{ route('users.borrows', Auth::user()->id) }}" class="link-dark">
                    {{ $user->borrows->count() }} emprunt(s) en cours
                </a>
            </li>
            @if ($user->borrows->count() > 0)
                <x-shares :shares="$borrows" :borrowView="true" />
            @endif
        </ul>
    @endif
@endsection
