@props([
    'for',
    'label',
])

<label class="font-semibold text-xs"
       {{ $for }}>
    {{ $label }}

    {{ $slot }}
</label>
