@props([
    'active' => false
])

@php

$classes = ($active ?? false)
                     ? 'flex items-center py-2 px-8 text-white border-r-4  bg-gray-700
                        text-gray-100 border-gray-100'
                     : 'flex items-center py-2 px-8 text-gray-400 border-r-4 border-gray-800 hover:bg-gray-700
                        hover:text-gray-100 hover:border-gray-100'

@endphp

<a {{ $attributes->merge(['class' => $classes]) }} >

   {{ $icon }}

    <span class="mx-4 font-medium">

        {{ $slot }}

    </span>
</a>
