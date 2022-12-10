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
            <div class="mb-3">
                <div class="mb-3">
                    <label for="item" class="form-label">Objet emprunté</label>
                    <select class="form-select" id="item" name="item" required disabled>
                        {{-- disabled because item can't be changed to avoid edges problems (disabled --> validation check & controller removed) --}}
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}" @selected(old('item', $share->item_id) == $item->id)>{{ $item->title }}</option>
                        @endforeach
                    </select>

                    <hr>

                    <label for="imBorrower" class="form-check-label">J'ai emprunter l'objet</label>
                    <input class="form-check-input" type="checkbox" id="imBorrower" name="imBorrower" value="active"
                        @checked(old('imBorrower')) data-bs-toggle="collapse" data-bs-target="#alertImBorrower" />

                    <br> {{-- Without it, when div collapsed, there is an issue with line separation --}}
                    <div id="alertImBorrower" class="alert alert-warning collapse {{ old('imBorrower') ? 'show' : '' }}"
                        role="alert">
                        Dans ce mode, l'objet emprunter ne sera pas lié à un utilisateur existant.<br>
                        (Le nom ne peut donc pas commencer par &#64;)
                    </div>


                    <label for="otherUser" id="otherUserLabel" class="form-label">Personne impliquée</label>
                    <input class="form-control" list="dlOptionsOtherUser" id="otherUser" name="otherUser"
                        placeholder="Ecrivez pour rechercher... (@ pour un utilisateur inscrit)" required>
                    <datalist id="dlOptionsOtherUser">
                        @foreach ($users as $user)
                            <option value="&#64;{{ $user->name }}">{{ $user->email }} </option>
                        @endforeach
                    </datalist>

                    <hr>
                    <label for="since" class="form-label">Date de début</label>
                    <input id="since" class="form-control" name="since" type="date"
                        value="{{ old('since', $share->since->format('Y-m-d')) }}">
                    {{-- date format is required to be Y-m-d to be setted as value programmatically --}}
                    <label for="deadline" class="form-label">Date de retour</label>
                    <input id="deadline" class="form-control" name="deadline" type="date"
                        value="{{ old('deadline', $share->deadline->format('Y-m-d')) }}" autofocus>

                    <hr>

                    <label for="terminated" class="form-check-label">L'objet a été retourné </label>
                    <input class="form-check-input" type="checkbox" id="terminated" name="terminated" value="active"
                        @checked(old('terminated', $share->terminated)) data-bs-toggle="collapse" data-bs-target="#alertTerminated" />

                    <div id="alertTerminated"
                        class="alert alert-warning collapse {{ old('terminated', $share->terminated) ? 'show' : '' }}"
                        role="alert">
                        Dans la version actuelle du site, un prêt noté comme retourné n'est plus accessible et donc ne peut
                        plus être modifié.
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/shares/edit.js') }}"></script>
@endsection
