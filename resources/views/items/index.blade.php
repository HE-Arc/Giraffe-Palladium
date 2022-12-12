@extends('layout.app')

@section('title')
    Objets empruntables
@endsection

@section('content')
<table class="table">
    <thead>
        <tr>
            <th scope="col">Objet</th>
            <th scope="col">Prêteur</th>
        </tr>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item) {{-- type of : Item --}}
            <tr>
                <td><a href="{{ route('items.show', $item->id) }}">{{ $item->title }}</a></td>
                <td><a href="{{ route('users.show', $item->owner->id) }}">{{ $item->owner->name }}</a></td>
            </tr>
        @endforeach
    </tbody>
</table>

    <div class="d-flex">
        {{ $items->links() }}
    </div>
@endsection
