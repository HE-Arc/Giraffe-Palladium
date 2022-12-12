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
                    $linkedUser = $share->lender ? $share->lender : $share->nonuser_lender;
                } else {
                    $linkedUser = $share->borrower ? $share->borrower : $share->nonuser_borrower;
                }

                $editLink = null;
                if ($share->owner()->id == Auth::user()->id) {
                     $editLink = route('shares.edit', $share->id);
                }
            @endphp

            <x-share
                :item="$share->item"
                :user="$linkedUser"
                :deadline="$share->deadline"
                :editLink="$editLink" />
        @endforeach
    </tbody>
</table>
