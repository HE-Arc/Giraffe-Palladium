{{-- Variables :
    $borrowView (boolean),
    $share (App\Models\Share)
--}}
<table class="table">
    <thead>
        <tr>
            <th scope="col">Objet</th>
            <th scope="col">{{ $borrowView ? 'Prêteur' : 'Emprunteur' }}</th>
            <th scope="col">Date limite</th>
            <th></th> {{-- Edit button --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($shares as $share) {{-- type of : Share --}}
            @php
                if ($borrowView) {
                    $name = $share->lender ? $share->lender->name : $share->nonuser_lender;
                } else {
                    $name = $share->borrower ? $share->borrower->name : $share->nonuser_borrower;
                }

                $editLink = null;
                if ($share->owner()->id == Auth::user()->id) {
                     $editLink = route('shares.edit', $share->id);
                }
            @endphp

            <x-share
                :title="$share->item->title"
                :name="$name"
                :deadline="$share->deadline"
                :editLink="$editLink" />
        @endforeach
    </tbody>
</table>
