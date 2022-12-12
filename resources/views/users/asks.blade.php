@extends('layout.app')

@section('title')
    Demandes d'emprunt
@endsection

@section('content')
@forelse ($items as $item)
    <h2><a href="{{ route('items.show', $item->id) }}">{{ $item->title }}</a></td></h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Demandé par</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($item->asks as $ask) {{-- type of : Ask --}}
                <tr>
                    <td><a href="{{ route('users.show', $ask->borrower->id) }}">{{ $ask->borrower->name }}</a></td>
                    <td>
                        <a href="{{ route('asks.show', $ask->id) }}" class="btn btn-primary btn-sm" title="Accept">Accepter</a>
                        <form action="{{ route('asks.reject', $ask->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Reject">Rejeter</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@empty
    <p>Vous n'avez aucune demande d'emprunt.</p>
@endforelse
<div class="d-flex">
    {{ $items->links() }}
</div>
@endsection