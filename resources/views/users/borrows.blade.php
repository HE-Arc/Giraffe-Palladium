@extends('layout.app')

@section('title')
    Mes emprunts
@endsection

@section('content')
    <x-shares :shares="$borrows" :borrowView="true"/>

    <div class="d-flex justify-content-center mt-3">
        {{ $borrows->links() }}
    </div>

@endsection
