<li>
    {{ $title }}
</li>
<li>
    {{ $name }}
</li>
<li>
    @if ($deadline)
        {{-- todo : formattage de la date --}}
        {{-- {{ ($deadline)->format('d.m.Y') }} --}}
        {{ $deadline }}
    @else
        Pas de date limite
    @endif
</li>
