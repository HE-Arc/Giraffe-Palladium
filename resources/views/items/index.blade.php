@extends('layout.app')

@section('title')
    Liste des objets empruntables
@endsection

@section('content')
    <ul>
        @foreach ($items as $item)
            <li>
                <!-- TODO: use the item component -->
                <a href="{{ route('items.show', $item->id) }}">{{ $item->title }}</a>
            </li>
        @endforeach
    </ul>
    <div class="d-flex">
        {{ $items->links() }}
    </div>
@endsection
