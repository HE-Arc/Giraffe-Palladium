{{-- &#64; == @ --}}

@extends('layout.app')

@section('title')
    Créer un contrat de prêt
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
        <form action="{{ route('shares.store') }}" method="post" class="col-md-8 col-lg-6 col-xxl-4">
            @csrf
            <div class="mb-3">
                <div class="mb-3">
                    <x-forms.share :share="$share" :items="$items" :imBorrower="$imBorrower" :otherUserName="$otherUserName"
                        :users="$users" />
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/shares/edit.js') }}"></script>
@endsection