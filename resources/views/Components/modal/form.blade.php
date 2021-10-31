@props([
    'title' => false
])

<section class="max-w-4xl p-6 mx-auto bg-white rounded-md shadow-md dark:bg-gray-800">
    <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">

        <div class="text-3xl pb-4 border-b border-gray-400"> {{ $title }} </div>

    </h2>

    <form {{ $attributes }}>

        {{ $slot }}

    </form>

</section>
