@extends('layout.app')

@section('title')
    Liste de mes emprunts :
@endsection

@section('content')
    <div class="d-flex">
        <ul>
            @foreach ($borrows as $borrow) {{-- type of : Share --}}
                <li>
                    {{ $borrow->item->title }}
                </li>
                <li>
                    @if($borrow->lender)
                        {{ $borrow->lender->name }}
                    @else
                        {{ $borrow->nonuser_lender }}
                    @endif
                </li>
                <li>
                    @if ($borrow->deadline)
                        {{-- todo : formattage de la date --}}
                        {{-- {{ ($borrow->deadline)->format('d.m.Y') }} --}}
                        {{ $borrow->deadline }}
                    @else
                        Pas de date limite
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
@endsection
