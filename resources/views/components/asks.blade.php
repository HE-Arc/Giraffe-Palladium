{{-- Variables :
    $showItem (boolean),
    $asks (App\Models\Ask)
--}}
<div class="table-responsive rounded-4 border border-gray">
    <table class="mb-0 table">
        <thead class="table-light">
            <tr>
                @if ($showItem)
                    <th scope="col">Objet</th>
                @endif
                <th scope="col">Demandeur</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            {{-- type of : Ask --}}
            @foreach ($asks as $ask)
                <tr class="align-middle">
                    @if ($showItem)
                        <td>
                            <a href="{{ route('items.show', $ask->item->id) }}"
                                class="link-dark">{{ $ask->item->title }}</a>
                        </td>
                    @endif

                    <td><a href="{{ route('users.show', $ask->borrower->id) }}"
                            class="link-dark">{{ $ask->borrower->name }}</a></td>
                    <td>
                        <a href="{{ route('asks.show', $ask->id) }}" class="btn btn-success bi bi-check-circle"
                            title="Accept"></a>
                        <form action="{{ route('asks.reject', $ask->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger bi bi-x-circle" title="Reject"></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
