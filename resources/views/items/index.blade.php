@extends('layout.app')

@section('title')
    Objets empruntables
@endsection

@section('content')
    <div class="table-responsive rounded-2 border border-gray">
        <table class="mb-0 table">
            <thead class="table-light">
                <tr>
                    <th scope="col">Objet</th>
                    <th scope="col">Prêteur</th>
                </tr>
                </tr>
            </thead>
            <tbody>
                {{-- type of : Item --}}
                @foreach ($items as $item)
                    <tr class="align-middle">
                        <td><a href="{{ route('items.show', $item->id) }}" class="link-dark">{{ $item->title }}</a></td>
                        <td>
                            <a href="{{ route('users.show', $item->owner->id) }}"
                                class="link-dark">{{ $item->owner->name }}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex">
        {{ $items->links() }}
    </div>
@endsection
