@extends('layout.app')

@section('title')
    Mes emprunts
@endsection

@section('content')
    <x-shares :shares="$borrows" :borrowView="true" />

    <div class="d-flex">
        {{ $borrows->links() }}
    </div>

@endsection
