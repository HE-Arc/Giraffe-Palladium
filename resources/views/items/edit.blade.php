@extends('layout.app')

@section('title')
    Modifier un objet
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
        <form action="{{ route('items.update', $item->id) }}" method="post" class="col-md-8 col-lg-6 col-xxl-4">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Nom de l'objet</label>
                <input id="title" class="form-control" name="title" type="text" value="{{ $item->title }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" class="form-control" name="description">{{ $item->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
@endsection
