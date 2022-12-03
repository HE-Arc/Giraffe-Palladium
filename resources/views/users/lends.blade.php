@extends('layout.app')

@section('title')
    Mes prêts
@endsection

@section('content')
<x-shares :shares="$lends" :borrowView="false" />

<div class="d-flex">
    {{ $lends->links() }}
</div>
@endsection
