@extends('layout.app')

@section('title')
    Utilisateurs
@endsection

@section('content')
    <div class="container">
        <ul class="row p-0">
            @foreach ($users as $user)
                <li class="col-lg-6 list-unstyled p-0">
                    <a href="{{ route('users.show', $user->id) }}" class="d-block link-dark
                        rounded-2 border border-gray bg-light text-decoration-none m-1 p-3">
                        <p class="text-center m-0"><strong>{{ $user->name }}</strong></p>
                        <p class="text-center m-0 my-1">{{ $user->email }}</p>
                        <p class="text-center m-0">{{ $user->getNumberBorrowableItems() }} objet(s) proposé(s)</p>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="d-flex">
        {{ $users->links() }}
    </div>
@endsection
