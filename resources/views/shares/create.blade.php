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
                    <label for="item" class="form-label">Objet emprunté</label>
                    <select class="form-select" id="item" name="item" required disabled>
                        {{-- disabled because item can't be changed to avoid edges problems --}}
                        @foreach ($items as $item)
                            <option value="{{ $item->id }}" @selected(old('item', $share->item_id) == $item->id)>{{ $item->title }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="itemId" value="{{ old('itemId', $share->item_id) }}">

                    <hr>

                    <label for="imBorrower" class="form-check-label">J'ai emprunté l'objet</label>
                    <input class="form-check-input" type="checkbox" id="imBorrower" name="imBorrower" value="active"
                        @checked(old('imBorrower', $imBorrower)) data-bs-toggle="collapse"
                        data-bs-target="#alertImBorrower, #otherUserLabelBorrower, #otherUserLabelLender" />

                    <br> {{-- Without it, when div collapsed, there is an issue with line separation --}}
                    <div id="alertImBorrower"
                        class="alert alert-warning collapse {{ old('imBorrower', $imBorrower) ? 'show' : '' }}"
                        role="alert">
                        Dans ce mode, l'objet emprunté ne sera pas lié à un utilisateur existant.<br>
                        (Le nom ne peut donc pas commencer par &#64;)
                    </div>


                    <label for="otherUser" id="otherUserLabelBorrower"
                        class="form-label collapse {{ old('imBorrower', $imBorrower) ? '' : 'show' }}">Emprunteur</label>
                    <label for="otherUser" id="otherUserLabelLender"
                        class="form-label collapse {{ old('imBorrower', $imBorrower) ? 'show' : '' }}">Prêteur</label>
                    <input class="form-control" list="dlOptionsOtherUser" id="otherUser" name="otherUser"
                        value="{{ old('otherUser', $otherUserName) }}"
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
                    @php
                        $deadline = $share->deadline;
                        if ($share->deadline) {
                            $deadline = $deadline->format('Y-m-d');
                        }
                    @endphp
                    <input id="deadline" class="form-control" name="deadline" type="date"
                        value="{{ old('deadline', $deadline) }}">

                    <hr>

                    <label for="terminated" class="form-check-label">L'objet a été retourné </label>
                    <input class="form-check-input" type="checkbox" id="terminated" name="terminated" value="active"
                        @checked(old('terminated', $share->terminated)) data-bs-toggle="collapse" data-bs-target="#alertTerminated" />

                    <div id="alertTerminated"
                        class="alert alert-warning collapse {{ old('terminated', $share->terminated) ? 'show' : '' }}"
                        role="alert">
                        Dans la version actuelle du site, un prêt retourné n'est plus accessible et donc ne peut
                        plus être modifié.
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Créer</button>
        </form>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/shares/edit.js') }}"></script>
@endsection
