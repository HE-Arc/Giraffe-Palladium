@extends('layout.app')

@section('title')
    Liste des utilisateurs
@endsection

@section('content')
    <p>Vous avez empruntez ces objets :</p>
    <div class="d-flex">
        <ul>
            @foreach ($borrows as $borrow) {{-- type of : Share --}}
                <li>
                    {{ $borrow->item->title }}
                </li>
                <li>
                    @if($borrow->lender)
                        {{ $borrow->lender->name }}
                    @else
                        {{ $borrow->nonuser_lender }}
                    @endif
                </li>
                <li>
                    {{ $borrow->deadline }}
                </li>
            @endforeach
        </ul>
    </div>
    {{-- <ul>
        @foreach ($users as $user)
            <li><a href="{{ route('users.show', $user->id) }}">{{ $user->name }} ({{ $user->email }})</a></li>
        @endforeach
    </ul>
    <div class="d-flex">
        {{ $users->links() }}
    </div> --}}
@endsection
