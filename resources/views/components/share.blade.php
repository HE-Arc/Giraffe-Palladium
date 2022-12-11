{{-- Variables :
    $title (string),
    $name (string),
    $deadline (datetime)
    $editLink (string),
--}}

<tr>
    <td>
        {{ $title }}
    </td>
    <td>
        {{ $name }}
    </td>
    <td>
        @if ($deadline)
            {{ ($deadline)->format('d.m.Y') }}
        @else
            Pas de date limite
        @endif
    </td>
    <td>
        @if ($editLink)
            <a href="{{ $editLink }}" class="btn btn-primary">Modifier</a>
        @endif
    </td>
</tr>
