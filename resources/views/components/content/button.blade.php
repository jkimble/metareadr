@props(['styling', 'type' => null, 'link' => false])

@php
    $styles = match ($styling) {
        'primary' => 'btn btn-primary',
        'secondary' => 'btn btn-secondary'
    }
@endphp

@if ($link)
    <a {{ $attributes->merge(['class' => $styles]) }}>
        {{ $slot }}
    </a>

@else
    <button {{ $attributes->merge(['class' => $styles]) }}>
        {{ $slot }}
    </button>

@endif
