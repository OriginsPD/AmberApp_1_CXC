@props([
    'for',
    'label',
])

<label {{ $attributes->merge(['class' => 'font-semibold text-xs']) }}
       {{ $for }}>
    {{ $label }}

    {{ $slot }}
</label>
