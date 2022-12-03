{{-- Variables :
    $borrowView (boolean),
    $share (App\Models\Share)
--}}
<div class="d-flex">
    <ul>
        <li>Objet</li>
        <li>{{ $borrowView ? "Prêteur" : "Emprunteur"}}</li>
        <li>Date limite</li>
    </ul>
    <ul>
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
    </ul>
</div>

