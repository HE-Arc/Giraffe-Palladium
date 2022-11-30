@extends('layout.app')

@section('title')
    Liste de mes emprunts :
@endsection

@section('content')
    <div class="d-flex">
        <ul>
            @foreach ($borrows as $borrow) {{-- type of : Share --}}
                <x-share
                    :title="$borrow->item->title"
                    :name="$borrow->lender ? $borrow->lender->name : $borrow->nonuser_lender"
                    :deadline="$borrow->deadline"
                />
            @endforeach
        </ul>
    </div>
@endsection
