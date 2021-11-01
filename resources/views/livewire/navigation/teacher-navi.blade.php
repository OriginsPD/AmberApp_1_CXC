<header class="bg-gray-800 shadow-sm">

    <div class="p-4 mx-auto max-w-screen-xl">

        <div class="flex items-center justify-between space-x-4 lg:space-x-10">

            <div class="flex lg:w-0 lg:flex-1">

                <span class="w-20 h-10 bg-gray-200 rounded-lg"></span>

            </div>

            <nav class="hidden text-sm font-medium space-x-8 md:flex">

                <a class="text-white" href="">About</a>

                <a class="text-white" href="">Blog</a>

                <a class="text-white" href="">Projects</a>

                <a class="text-white" href="">Contact</a>

            </nav>

            <div class="items-center justify-end flex-1 hidden space-x-4 sm:flex">

                <a wire:click.prevent="logout"
                    class="px-5 py-2 text-sm font-medium text-gray-500 bg-gray-100 rounded-lg"
                   href="#">

                    Log Out

                </a>

            </div>

            <div class="lg:hidden">

                <button class="p-2 text-gray-600 bg-gray-100 rounded-lg" type="button">

                    <span class="sr-only">Open menu</span>

                    <svg
                        aria-hidden="true"
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        viewbox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">

                        <path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />

                    </svg>

                </button>

            </div>

        </div>

    </div>

</header>
