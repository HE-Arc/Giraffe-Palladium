@extends('layout.app')

@section('title')
    Mes prêts
@endsection

@section('content')
<div class="d-flex">
    <ul>
        @foreach ($lends as $lend) {{-- type of : Share --}}
            <x-share
                :title="$lend->item->title"
                :name="$lend->borrower ? $lend->borrower->name : $lend->nonuser_borrower"
                :deadline="$lend->deadline"
            />
        @endforeach
    </ul>
</div>

<div class="d-flex">
    {{ $lends->links() }}
</div>
@endsection
