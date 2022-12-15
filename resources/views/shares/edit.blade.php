{{-- &#64; == @ --}}

@extends('layout.app')

@section('title')
    Modifier un contrat de prêt
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
        <form action="{{ route('shares.update', $share->id) }}" method="post" class="col-md-8 col-lg-6 col-xxl-4">
            @csrf
            @method('PUT')
            <x-forms.share :share="$share" :items="$items" :imBorrower="$imBorrower" :otherUserName="$otherUserName" :users="$users" />
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/shares/edit.js') }}"></script>
@endsection
