<div>

    <div class="flex flex-col space-y-2 bg-white w-full p-3">

        <div
            class="relative flex shadow-xl flex-col min-w-0 break-words bg-white p-3 w-full mb-6 shadow-lg rounded ">

            <div class="rounded-t mb-0 px-4 py-3 border-0">

                <div class="flex flex-wrap items-center">

                    <div class="relative w-full px-4 max-w-full flex-grow flex-1">

                        <h3 class="font-semibold text-base text-blueGray-700"> Payment Sum Details </h3>

                    </div>

                </div>

            </div>

            <x-table>

                <x-slot name="header">

                    <x-table.head> Students Name</x-table.head>

                    <x-table.head> Total Amount Paid </x-table.head>

                    <x-table.head> Total Balance_Amount </x-table.head>

                </x-slot>

                <x-table.body>

                    @forelse($paymentSum as $payment)

                    <x-table.row>

                        <x-table.data> {{ $payment->students->first_nm }} {{ $payment->students->last_nm }} </x-table.data>

                        <x-table.data> $ {{ number_format($payment->sum,'2') }} </x-table.data>

                        <x-table.data>

                            $ {{ number_format($payment->balance_amt,'2') }}

                        </x-table.data>

                    </x-table.row>

                    @empty

                        <x-table.row>

                            <x-table.data colspan="6" class="w-full text-center">

                                No Payment Founded

                            </x-table.data>

                        </x-table.row>

                    @endforelse

                </x-table.body>

            </x-table>

        </div>

        <div
            class="relative flex shadow-xl flex-col break-words bg-white p-3 w-full mb-6 shadow-lg rounded ">

            <div class="rounded-t mb-0 px-4 py-3 border-0">

                <div class="flex flex-wrap items-center">

                    <div class="relative w-full px-4 max-w-full flex-grow flex-1">

                        <h3 class="font-semibold text-base text-blueGray-700">Payment Avg Details</h3>

                    </div>

                </div>

            </div>

            <x-table>

                <x-slot name="header">

                    <x-table.head> Students Name</x-table.head>

                    <x-table.head> Total Amount Paid </x-table.head>

                    <x-table.head> Total Balance_Amount </x-table.head>

                </x-slot>

                <x-table.body>

                    @forelse($paymentAvg as $payment)

                        <x-table.row>

                            <x-table.data> {{ $payment->students->first_nm }} {{ $payment->students->last_nm }} </x-table.data>

                            <x-table.data> $ {{ number_format($payment->Avg,'2') }} </x-table.data>

                            <x-table.data>

                                $ {{ number_format($payment->balance_amt,'2') }}

                            </x-table.data>

                        </x-table.row>

                    @empty

                        <x-table.row>

                            <x-table.data colspan="6" class="w-full text-center">

                                No Payment Founded

                            </x-table.data>

                        </x-table.row>

                    @endforelse

                </x-table.body>

            </x-table>

        </div>

    </div>


</div>
