@extends('layout.app')

@section('title')
    Demande d'emprunt
@endsection

@section('content')
<p>
    L'utilisateur
    <a href="{{ route('users.show', $borrower->id) }}">{{ $borrower->name }}</a>
    souhaite emprunter l'objet
    <a href="{{ route('items.show', $item->id) }}">{{ $item->title }}</a>
</p>
@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('asks.accept', $ask->id) }}" method="post" class="col-md-8 col-lg-6 col-xxl-4">
    @csrf
    <input type="hidden" name="ask_id" value="{{ $ask->id }}">
    <div class="mb-3">
        <label for="deadline" class="form-label">Date de retour</label>
        <input id="deadline" class="form-control" name="deadline" type="date" value="{{ now()->addDays(7)->format('Y-m-d') }}" autofocus>
    </div>
    <button type="submit" class="btn btn-primary" title="Lend">Prêter l'objet</button>
</form>
@endsection
