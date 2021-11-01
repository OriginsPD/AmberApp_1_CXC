<div>

    <button type="submit" {{ $attributes->merge([
    'class' => 'flex items-center justify-center h-12 px-6 w-64 bg-blue-600 mt-8 rounded
                font-semibold text-sm text-white hover:bg-blue-700'
        ]) }}>

        {{ $slot }}

    </button>


</div>
