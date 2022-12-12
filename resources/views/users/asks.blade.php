@extends('layout.app')

@section('title')
    Demandes d'emprunt
@endsection

@section('content')
    @forelse ($items as $item)
        <h2>
            <a href="{{ route('items.show', $item->id) }}">{{ $item->title }}</a></td>
        </h2>
        <x-asks :showItem="false" :asks="$item->asks" />
    @empty
        <p>Vous n'avez aucune demande d'emprunt.</p>
    @endforelse
    <div class="d-flex">
        {{ $items->links() }}
    </div>
@endsection
