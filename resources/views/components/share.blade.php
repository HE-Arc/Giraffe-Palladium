{{-- Variables :
    $item (App\Models\Item),
    $user (App\Models\User) || (string),
    $deadline (datetime)
    $editLink (string),
--}}

@php
    $passedDateTextClass = '';
    $passedDateBorderClass = '';

    if ($deadline && $deadline->isToday()) {
        $passedDateTextClass = '';
        $passedDateBorderClass = 'table-warning';
    } elseif ($deadline && $deadline->isPast()) {
        $passedDateTextClass = 'text-danger';
        $passedDateBorderClass = 'table-danger';
    }

@endphp

<tr class="align-middle {{ $passedDateBorderClass }}">
    <td>
        <a href="{{ route('items.show', $item->id) }}" class="link-dark">{{ $item->title }}</a>
    </td>
    <td>
        @if ($user instanceof App\Models\User)
            <a href="{{ route('users.show', $user->id) }}" class="link-dark">{{ $user->name }}</a>
        @else
            {{ $user }}
        @endif
    </td>
    <td class="{{ $passedDateTextClass }}">
        @if ($deadline)
            {{ $deadline->format('d.m.Y') }}
        @else
            Pas de date limite
        @endif
    </td>
    <td class="text-end">
        @if ($editLink)
            <a href="{{ $editLink }}" class="btn btn-primary bi bi-pencil"></a>
        @endif
    </td>
</tr>
