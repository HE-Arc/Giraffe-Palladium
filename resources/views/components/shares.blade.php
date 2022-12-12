{{-- Variables :
    $borrowView (boolean),
    $share (App\Models\Share)
--}}
<div class="table-responsive rounded-4 border border-gray">
    <table class="mb-0 table">
        <thead class="table-light">
            <tr>
                <th scope="col">Objet</th>
                <th scope="col">{{ $borrowView ? 'Prêteur' : 'Emprunteur' }}</th>
                <th scope="col">Date limite</th>
                <th></th> {{-- Edit button --}}
            </tr>
        </thead>
        <tbody>
            {{-- type of : Share --}}
            @foreach ($shares as $share)
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

                <x-share :item="$share->item" :user="$linkedUser" :deadline="$share->deadline" :editLink="$editLink" />
            @endforeach
        </tbody>
    </table>
</div>
