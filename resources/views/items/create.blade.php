@extends('layout.app')

@section('title')
    Nouvel objet
@endsection

@section('content')
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('items.store') }}" method="post" class="col-md-8 col-lg-6 col-xxl-4">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Nom de l'objet</label>
                <input id="title" class="form-control" name="title" type="text" value="{{ old('title') }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" class="form-control" name="description">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="listed" class="form-check-label">Lister l'objet comme empruntable</label>
                <input id="listed" class="form-check-input" name="listed" type="checkbox" value="true" checked>
            </div>
            <button type="submit" class="btn btn-primary">Créer un objet</button>
        </form>
    </div>
@endsection
