<div>

    <div class="flex flex-col space-y-2 bg-white w-full p-16">

        <div
            class="relative flex shadow-xl flex-col break-words bg-white p-3 w-full mb-6 shadow-lg rounded ">

            <div class="rounded-t mb-0 px-4 py-3 border-0">

                <div class="flex flex-wrap items-center">

                    <div class="relative w-full px-4 max-w-full flex-grow flex-1">

                        <h3 class="font-semibold text-base text-blueGray-700">Payment History</h3>

                    </div>

                </div>

            </div>


            <x-table>

                <x-slot name="header">

                    <x-table.head> Student Name</x-table.head>

                    <x-table.head> Amount Due</x-table.head>

                    <x-table.head> Date Paid</x-table.head>

                    <x-table.head> Description</x-table.head>


                </x-slot>

                <x-table.body>

                    @forelse($payHistories as $payHistory)

                        <x-table.row>

                            <x-table.data> {{ $payHistory->students->first_nm }} {{ $payHistory->students->last_nm }} </x-table.data>

                            <x-table.data> $ {{ number_format($payHistory->amount_paid,'2') }}</x-table.data>

                            <x-table.data> {{ $payHistory->date_paid }} </x-table.data>

                            <x-table.data>

                                {{ $payHistory->description }}

                            </x-table.data>

                        </x-table.row>

                    @empty

                        <x-table.row>

                            <x-table.data colspan="5" class="w-full text-center">

                                No Payment History Founded

                            </x-table.data>

                        </x-table.row>

                    @endforelse

                </x-table.body>

            </x-table>

            <span>

                <div
                    class="mt-2 p-5 bg-gray-100 text-white">

                            {{ $payHistories->links() }}

                </div>

            </span>

        </div>

    </div>


</div>
