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
                <a href="{{ route('users.asks', Auth::user()->id) }}">
                    {{ $user->offers()->count() }} demande(s) d'emprunt
                </a>
            </li>
            <x-asks :asks="$asks" />
            <li>
                <a href="{{ route('users.lends', Auth::user()->id) }}"">
                    {{ $user->lends->count() }} prêt(s) en cours
                </a>
                <x-shares :shares="$lends" :borrowView="false" />
            </li>
            <li>
                <a href="{{ route('users.borrows', Auth::user()->id) }}">
                    {{ $user->borrows->count() }} emprunt(s) en cours
                </a>
                <x-shares :shares="$borrows" :borrowView="true" />
            </li>
        </ul>
    @endif
@endsection
