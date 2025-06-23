@props(['styling', 'type' => null])

@php
    $styles = match ($styling) {
        'primary' => 'btn btn-primary',
        'secondary' => 'btn btn-secondary'
    }
@endphp

<button {{ $attributes->merge(['class' => $styles]) }}>
    {{ $slot }}
</button>
