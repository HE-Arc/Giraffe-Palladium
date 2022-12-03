<li>
    {{ $title }}
</li>
<li>
    {{ $name }}
</li>
<li>
    @if ($deadline)
        {{ ($deadline)->format('d.m.Y') }}
    @else
        Pas de date limite
    @endif
</li>
