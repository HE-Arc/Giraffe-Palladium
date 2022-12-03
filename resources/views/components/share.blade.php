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
</tr>
