<header x-data="{ isRegister: false }"
        class="text-gray-600 sticky top-0 z-20 bg-white body-font border-b border-gray-200 shadow">

    <div class=" mx-auto flex flex-wrap px-4 py-2 flex-col md:flex-row items-center">

        <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">

            <span class="ml-4 font-extrabold italic text-blue-500 text-4xl"><span class="uppercase text-orange-500">Amber</span>CXC</span>

        </a>

        <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">


        </nav>

        <div class="flex items-center py-2 -mx-1 md:mx-0">

            <a @click.prevent="isRegister = !isRegister"
                class="block w-1/2 px-3 py-2 mx-1 text-sm font-medium leading-5 text-center text-white transition-colors duration-200 transform bg-blue-500 rounded-md hover:bg-blue-600 md:mx-0 md:w-auto"
               href="#">

                Join free

            </a>

        </div>

    </div>

    <div x-show="isRegister"
         @keydown.esc.window="isRegister = false"
         x-transition.duration.300ms.origin.right.opacity.scale.50
         x-transition.out.duration.300ms.origin.right
         class="flex items-center justify-end fixed top-0 bottom-0
               w-screen h-screen mx-auto bg-black bg-opacity-0">

        @livewire('auth.register')

    </div>

</header>
