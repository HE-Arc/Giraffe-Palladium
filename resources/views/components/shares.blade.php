{{-- Variables :
    $borrowView (boolean),
    $share (App\Models\Share)
--}}
<table class="table">
    <thead>
        <tr>
            <th scope="col">Objet</th>
            <th scope="col">{{ $borrowView ? "Prêteur" : "Emprunteur"}}</th>
            <th scope="col">Date limite</th>
        </tr>
        </tr>
    </thead>
    <tbody>
        @foreach ($shares as $share) {{-- type of : Share --}}
            @if ($borrowView)
                <x-share
                    :title="$share->item->title"
                    :name="$share->lender ? $share->lender->name : $share->nonuser_lender"
                    :deadline="$share->deadline"
                    />
                @else
                <x-share
                    :title="$share->item->title"
                    :name="$share->borrower ? $share->borrower->name : $share->nonuser_borrower"
                    :deadline="$share->deadline"
                />
            @endif
        @endforeach
    </tbody>
</table>

