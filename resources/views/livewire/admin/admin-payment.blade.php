<div x-data="{ isOpen: false }"
     x-on:show-modal.window="isOpen = true"
     x-on:close-modal.window="isOpen = false" class="flex flex-col h-full items-center justify-center">

    <x-alert.success :message="session('success')"/>

    <div class="px-4 mx-auto max-w-7xl mt-5 sm:px-6 md:px-8">

        <h1 class="text-lg text-gray-600"> Payment Details </h1>

    </div>

    <div class="w-full xl:w-full z-10 xl:mb-0 px-4 mx-auto mt-8">

        <div class="relative flex flex-col min-w-0 break-words bg-white p-3 w-full mb-6 shadow-lg rounded ">

            <div class="rounded-t mb-0 px-4 py-3 border-0">

                <div class="flex flex-wrap items-center">

                    <div class="relative w-full px-4 max-w-full flex-grow flex-1">

                        <h3 class="font-semibold text-base text-blueGray-700">Payment Information</h3>

                    </div>

                    <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">

                        <button wire:click.prevent="addPayment"
                                class="bg-green-500 text-white active:bg-green-600 text-xs font-bold uppercase
                                 px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all
                                 duration-150" type="button">Make Payment
                        </button>

                    </div>

                </div>

            </div>


            <x-table>

                <x-slot name="header">

                    <x-table.head> Student Name</x-table.head>

                    <x-table.head> Subject</x-table.head>

                    <x-table.head> Amount Paid</x-table.head>

                    <x-table.head> Balance_Amount</x-table.head>

                    <x-table.head> Date Paid</x-table.head>

                    <x-table.head></x-table.head>

                </x-slot>

                <x-table.body>

                    @forelse($infoPayments as $infoPayment)

                        <x-table.row>

                            <x-table.data> {{ $infoPayment->students->first_nm }} {{ $infoPayment->students->last_nm }} </x-table.data>

                            <x-table.data> {{ $infoPayment->subjects->subject_nm }} </x-table.data>

                            <x-table.data> $ {{ $infoPayment->amount_paid }}</x-table.data>

                            <x-table.data> $ {{ number_format($infoPayment->balance_amt,'2') }} </x-table.data>

                            <x-table.data> {{ ($infoPayment->date_paid) === null ? 'Awaiting Payment' : $infoPayment->date_paid }} </x-table.data>

                            <x-table.data class="space-x-2">

                                <a wire:click.prevent="makePayment({{ $infoPayment }})" href="#" class="text-white shadow-md
                                    font-bold py-1 px-3 rounded text-xs
                                    bg-blue-500 hover:bg-blue-800">

                                    Update

                                </a>

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

            <div class="mt-2 p-5 bg-gray-100 text-white">

                {{ $infoPayments->links() }}

            </div>

        </div>

    </div>

    <div>

        <div x-show="isOpen"
             @keydown.esc.window="isOpen = false"
             x-transition.duration.300ms
             class="fixed flex items-center z-50 p-7 justify-center bg-black bg-opacity-75 h-screen w-screen top-0 bottom-0 left-0 ">

            @if($paymentAdd)

                <x-modal.form wire:submit.prevent="{{ $paymentAdd ? 'storePayment' : 'storeUpdatePay' }}"
                              @click.away.window="isOpen = false"
                              title="Payment Information">


                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">

                        <div class="grid grid-cols-1 space-x-2">

                            <x-input.label for="student_id" label="Student">

                                <x-input.select wire:model="student_id" :errors="$errors->first('student_id')">

                                    <option selected> Please Select Student</option>

                                    @forelse($students as $student)

                                        <option value="{{ $student->id }}">
                                            {{ $student->first_nm }}
                                            {{ $student->last_nm }}
                                        </option>

                                    @empty

                                        <option selected disabled> No Student Available</option>

                                    @endforelse

                                </x-input.select>

                            </x-input.label>

                        </div>

                        <div class="grid grid-cols-1 space-x-2">

                            <x-input.label for="subject_id" label="Subject">

                                <x-input.select wire:model="subject_id" :errors="$errors->first('subject_id')">

                                    <option selected> Please Select Subject</option>

                                    @forelse($subjects as $subject)

                                        <option value="{{ $subject->id }}">
                                            {{ $subject->subject_nm }} </option>

                                    @empty

                                        <option selected disabled> No Subjects Available</option>

                                    @endforelse

                                </x-input.select>

                            </x-input.label>

                        </div>

                    </div>

                    <div class="grid grid-cols-2 col-span-2">

                        <x-input.submit>

                            Create Payment

                        </x-input.submit>


                    </div>

                </x-modal.form>

            @else

                <div class="flex flex-col items-center rounded-xl
                    bg-gradient-to-bl from-gray-100 to-grey-200 bg-opacity-25 w-full p-7 justify-center ">

                    <div class="grid grid-cols-2 space-x-2 w-full">

                        <div
                            class="relative flex shadow-xl flex-col min-w-0 break-words bg-white p-3 w-full mb-6 shadow-lg rounded ">

                            <div class="rounded-t mb-0 px-4 py-3 border-0">

                                <div class="flex flex-wrap items-center">

                                    <div class="relative w-full px-4 max-w-full flex-grow flex-1">

                                        <h3 class="font-semibold text-base text-blueGray-700">Payment Details</h3>

                                    </div>

                                </div>

                            </div>


                            <x-table>

                                <x-slot name="header">

                                    <x-table.head> Student Name</x-table.head>

                                    <x-table.head> Subject</x-table.head>

                                    <x-table.head> Amount Paid</x-table.head>

                                    <x-table.head> Balance_Amount</x-table.head>

                                    <x-table.head> Date Paid</x-table.head>

                                </x-slot>

                                <x-table.body>

                                    <x-table.row>

                                        <x-table.data> {{ $payments->students->first_nm }} {{ $payments->students->last_nm }} </x-table.data>

                                        <x-table.data> {{ $payments->subjects->subject_nm }} </x-table.data>

                                        <x-table.data> $ {{ $payments->amount_paid }}</x-table.data>

                                        <x-table.data>

                                            $ {{ number_format($payments->balance_amt,'2') }}

                                        </x-table.data>

                                        <x-table.data> {{ ($payments->date_paid) === null ? 'Awaiting Payment' : $payments->date_paid }} </x-table.data>


                                    </x-table.row>

                                </x-table.body>

                            </x-table>

                        </div>

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

                                    <x-table.head> Amount Due </x-table.head>

                                    <x-table.head> Amount Paid </x-table.head>

                                    <x-table.head> Balance_Amount </x-table.head>

                                    <x-table.head> Year of Exam </x-table.head>


                                </x-slot>

                                <x-table.body>

                                    <x-table.row>

                                        <x-table.data> {{ $transaction->students->first_nm }} {{ $transaction->students->last_nm }} </x-table.data>

                                        <x-table.data>
                                            $ {{ number_format($transaction->amount_due,'2') }} </x-table.data>

                                        <x-table.data> $ {{ $payments->amount_paid }}</x-table.data>

                                        <x-table.data>

                                            $ {{ number_format($payments->balance_amt,'2') }}

                                        </x-table.data>

                                        <x-table.data> {{ $transaction->year_of_exam }} </x-table.data>


                                    </x-table.row>

                                </x-table.body>

                            </x-table>

                        </div>

                    </div>

                    <div x-data="{ isPress: false, isShow: true }">

                        <div>

                            <button x-show="isShow"
                                    @click.prevent="isPress = !isPress; isShow = false"
                                    class="bg-green-600 hover:bg-green-500 shadow-lg rounded-xl
                                px-4 py-2 font-semibold text-white">

                                Pay Now

                            </button>

                        </div>

                        <div x-show="isPress"
                             x-transition.duration.300ms.origin.bottom
                            class=" w-full p-6 bg-white rounded-md shadow-xl dark:bg-gray-800">

                            <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">Make Payment</h2>

                            <form wire:submit.prevent="storeUpdatePay">

                                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1">

                                    <x-input.label for="amount_paid" label="Amount Being Paid">

                                        <x-input.text wire:model="amount_paid" type="number" class="w-full"
                                                      :errors="$errors->first('amount_paid')"/>

                                    </x-input.label>


                                </div>

                                <div class="flex space-x-2 items-center justify-center w-full">

                                    <x-input.submit>

                                        Paid Now

                                    </x-input.submit>

                                    <button @click.prevent="isOpen = false; isPress=false; isShow = true"
                                            class ="flex items-center justify-center h-12 px-6 w-64 bg-red-600 mt-8 rounded font-semibold text-sm text-white hover:bg-red-700">

                                        Cancel

                                    </button>

                                </div>

                            </form>

                        </div>


                    </div>

                </div>

            @endif


        </div>

    </div>

</div>
