@props([
    'message'
])

<div x-data="{ successOpen: false }"
     x-on:alert-modal.window="successOpen = true; setTimeout(() => { successOpen = false }, 2500)">

    <div x-show="successOpen"
         x-transition.duration.300ms.origin.right
         role="alert" {{ $attributes->merge(['class' =>'absolute top-10 right-5 z-40 space-x-2
                    flex items-center justify-between shadow p-4 bg-white text-green-500 rounded']) }} >

        <div class="my-2">

            <i class="fas fa-shield-check"></i>

        </div>

        <p>{{ $message }}</p>

        <button @click.prevent="successOpen =!successOpen" class=" hover:bg-green-600 rounded-md p-2 ">

				<svg class="fill-current h-6 w-6 text-white"  xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 20 20">

					<title>Close</title>

					<path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1
                            1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2
                            0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>

                </svg>

			</button>

    </div>

</div>



