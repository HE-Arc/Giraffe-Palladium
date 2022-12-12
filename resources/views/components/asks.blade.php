{{-- Variables :
    $ask (App\Models\Ask)
--}}
<div class="table-responsive rounded-4 border border-gray">
    <table class="mb-0 table">
        <thead class="table-light">
            <tr>
                <th scope="col">Objet</th>
                <th scope="col">Demandé par</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            {{-- type of : Ask --}}
            @foreach ($asks as $ask)
                <tr>
                    <td><a href="{{ route('items.show', $ask->item->id) }}">{{ $ask->item->title }}</a></td>
                    <td><a href="{{ route('users.show', $ask->borrower->id) }}">{{ $ask->borrower->name }}</a></td>
                    <td>
                        <a href="{{ route('asks.show', $ask->id) }}" class="btn btn-primary btn-sm"
                            title="Accept">Accepter</a>
                        <form action="{{ route('asks.reject', $ask->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Reject">Rejeter</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
