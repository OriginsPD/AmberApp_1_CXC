@props([
    'errors' => false
])

@php

    $classes = ($errors ?? false)
                ? 'flex items-center h-12 px-4 w-64 bg-gray-50 border border-red-700 mt-2 rounded focus:outline-none focus:ring-2'
                : 'flex items-center h-12 px-4 w-64 bg-gray-50 mt-2 border border-grey-800 rounded focus:outline-none focus:ring-2'

@endphp

<div>
    <select {{ $attributes->merge([
    'class' => $classes
    ]) }}>

        {{ $slot }}

    </select>

    @if($errors)
        <div class="text-red-600 font-thin m-1" >
            {{ $errors }}
        </div>
    @endif

</div>
