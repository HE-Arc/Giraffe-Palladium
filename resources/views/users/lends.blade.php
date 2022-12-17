@extends('layout.app')

@section('title')
    Mes prêts
@endsection

@section('content')
    <x-shares :shares="$lends" :borrowView="false" />

    <div class="d-flex justify-content-center mt-3">
        {{ $lends->links() }}
    </div>
@endsection
