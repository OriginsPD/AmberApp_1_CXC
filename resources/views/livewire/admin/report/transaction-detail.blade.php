<div>

    <div class="flex flex-col space-y-2 bg-white w-full p-20">

        <div
            class="relative flex shadow-xl flex-col break-words bg-white p-3 w-full mb-6 shadow-lg rounded ">

            <div class="rounded-t mb-0 px-4 py-3 border-0">

                <div class="flex flex-wrap items-center">

                    <div class="relative w-full px-4 max-w-full flex-grow flex-1">

                        <h3 class="font-semibold text-base text-blueGray-700">Transaction Details</h3>

                    </div>

                </div>

            </div>


            <x-table>

                <x-slot name="header">

                    <x-table.head> Student Name </x-table.head>

                    <x-table.head> Subject </x-table.head>

                    <x-table.head> Amount Due </x-table.head>

                    <x-table.head> Amount Paid </x-table.head>

                    <x-table.head> Balance_Amount </x-table.head>

                    <x-table.head> Year of Exam </x-table.head>


                </x-slot>

                <x-table.body>

                    @forelse($transactions as $transaction)

                    <x-table.row>

                        <x-table.data> {{ $transaction->students->first_nm }} {{ $transaction->students->last_nm }} </x-table.data>

                        <x-table.data> {{ $transaction->payments[0]->subjects->subject_nm }} </x-table.data>

                        <x-table.data>
                            $ {{ number_format($transaction->amount_due,'2') }} </x-table.data>

                        <x-table.data> $ {{ $transaction->amount_paid }}</x-table.data>

                        <x-table.data>

                            $ {{ number_format($transaction->balance_amt,'2') }}

                        </x-table.data>

                        <x-table.data> {{ $transaction->year_of_exam }} </x-table.data>

                    </x-table.row>

                    @empty

                        <x-table.row>

                            <x-table.data colspan="5" class="w-full text-center">

                                No Transaction Founded

                            </x-table.data>

                        </x-table.row>

                    @endforelse

                </x-table.body>

            </x-table>

        </div>

    </div>


</div>
