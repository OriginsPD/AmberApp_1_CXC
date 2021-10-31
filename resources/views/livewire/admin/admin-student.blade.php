<div x-data="{ isEdit: false }"
     x-on:show-modal.window="isEdit = true"
     x-on:close-modal.window="isEdit = false"
     >

    <x-alert.success :message="session('success')" />

    <div class="px-4 mx-auto max-w-7xl mt-5 sm:px-6 md:px-8">

        <h1 class="text-lg text-gray-600"> Full Student and Subject Details </h1>

    </div>

    <div class="w-full xl:w-full z-10 xl:mb-0 px-4 mx-auto mt-8">

        <div class="relative flex flex-col min-w-0 break-words bg-white p-3 w-full mb-6 shadow-lg rounded ">

            <div class="rounded-t mb-0 px-4 py-3 border-0">

                <div class="flex flex-wrap items-center">

                    <div class="relative w-full px-4 max-w-full flex-grow flex-1">

                        <h3 class="font-semibold text-base text-blueGray-700">Student Information</h3>

                    </div>

                    <div class=" pl-3 pr-2 bg-white border-gray-500 border rounded-full flex justify-between items-center relative">

                        <input wire:model="search"  placeholder="Search"
                               class="h-10 appearance-none w-full outline-none focus:outline-none active:outline-none"/>

                        <div class="ml-1 outline-none focus:outline-none active:outline-none">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 viewBox="0 0 24 24" class="w-6 h-6">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>

                    </div>

                </div>

            </div>


            <x-table>

                <x-slot name="header">

                    <x-table.head> Student Name</x-table.head>

                    <x-table.head> Class</x-table.head>

                    <x-table.head> Email</x-table.head>

                    <x-table.head> Gender</x-table.head>

                    <x-table.head></x-table.head>

                </x-slot>

                <x-table.body>

                    @forelse($students as $student)

                        <x-table.row>

                            <x-table.data> {{ $student->first_nm }} {{ $student->last_nm }} </x-table.data>

                            <x-table.data> {{ $student->class }} </x-table.data>

                            <x-table.data> {{ $student->email }} </x-table.data>

                            <x-table.data> {{ $student->gender }} </x-table.data>

                            <x-table.data class="space-x-2">

                                <a wire:click.prevent="editStudent({{ $student }})" href="#" class="text-white font-bold shadow py-1 px-3 rounded
                                                    text-xs bg-green-500 hover:bg-green-600">

                                    Edit

                                </a>

                                <a wire:click.prevent="viewStudent({{ $student }})" href="#" class="text-white font-bold shadow py-1 px-3 rounded
                                                   text-xs bg-blue-500 hover:bg-blue-600">

                                    View

                                </a>

                            </x-table.data>

                        </x-table.row>

                    @empty

                        <x-table.row>

                            <x-table.data colspan="7" class="w-full text-center">

                                No Students Found

                            </x-table.data>

                        </x-table.row>

                    @endforelse

                </x-table.body>

            </x-table>

            <div class="p-5 m-2">

                {{ $students->links() }}

            </div>

        </div>

    </div>


    <div class="w-full xl:w-full xl:mb-0 px-4 mx-auto mt-8">

        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">

            <div class="rounded-t mb-0 px-4 py-3 border-0">

                <div class="flex flex-wrap items-center">

                    <div class="relative w-full px-4 max-w-full flex-grow flex-1">

                        <h3 class="font-semibold text-base text-blueGray-700">Subject Information</h3>

                    </div>


                </div>

            </div>


            <x-table>

                <x-slot name="header">

                    <x-table.head> Subject Name</x-table.head>

                    <x-table.head> Cost</x-table.head>


                </x-slot>

                <x-table.body>

                    @forelse($subjects as $subject)

                        <x-table.row>

                            <x-table.data> {{ $subject->subject_nm }} </x-table.data>

                            <x-table.data> $ {{ $subject->cost_amt }} </x-table.data>

                        </x-table.row>

                    @empty

                        <x-table.row>

                            <x-table.data colspan="7" class="w-full text-center">

                                No Subjects Found

                            </x-table.data>

                        </x-table.row>

                    @endforelse

                </x-table.body>

            </x-table>

            <div class="p-5 m-2">

                {{ $subjects->links() }}

            </div>

        </div>

    </div>


    <div>

        <div x-show="isEdit"
             @keydown.esc.window="isEdit = false"
             x-transition.duration.300ms
             class="fixed flex items-center z-50 justify-center bg-black bg-opacity-75 h-screen w-screen top-0 bottom-0 left-0 ">

            @if($studentEdit)

                <x-modal.form wire:submit.prevent="storeEdit"
                              @click.away.window="isEdit = false"
                              title="Edit Student">

                    @if($studentEdit)

                        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">

                            <div class="grid grid-cols-1 space-x-2">
                                <x-input.label for="first_nm" label="First Name">

                                    <x-input.text wire:model="first_nm" :errors="$errors->first('first_nm')"/>

                                </x-input.label>

                            </div>

                            <div class="grid grid-cols-1 space-x-2">

                                <x-input.label for="last_nm" label="Last Name">

                                    <x-input.text wire:model="last_nm" :errors="$errors->first('last_nm')"/>

                                </x-input.label>

                            </div>

                            <div class="grid grid-cols-1 space-x-2">

                                <x-input.label for="dob" label="Date of Birth">

                                    <x-input.text wire:model="dob"
                                                  type="date" :errors="$errors->first('dob')"/>

                                </x-input.label>

                            </div>

                            <div class="grid grid-cols-1 space-x-2">

                                <x-input.label for="class" label="Class">

                                    <x-input.text wire:model="class" :errors="$errors->first('class')"/>

                                </x-input.label>

                            </div>

                            <div class="grid grid-cols-1 space-x-2">

                                <x-input.label for="phone_nbr" label="Phone Number">

                                    <x-input.text wire:model="phone_nbr"
                                                  type="number" :errors="$errors->first('phone_nbr')"/>

                                </x-input.label>

                            </div>

                            <div class="grid grid-cols-1 space-x-2">

                                <x-input.label for="gender" label="Gender">

                                    <x-input.select wire:model="gender"
                                                    type="number" :errors="$errors->first('gender')">

                                        <option selected> Please Select Gender</option>

                                        <option value="Male"> Male</option>

                                        <option value="Female"> Female</option>

                                    </x-input.select>

                                </x-input.label>

                            </div>


                        </div>

                    @else

                        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">

                            <div class="grid grid-cols-1 space-x-2">

                                <x-input.label for="subject_nm" label="Subject Name">

                                    <x-input.text wire:model="subject_nm" :errors="$errors->first('subject_nm')"/>

                                </x-input.label>

                            </div>

                            <div class="grid grid-cols-1 space-x-2">

                                <x-input.label for="cost_amt" label="Cost Amount">

                                    <x-input.text wire:model="cost_amt" :errors="$errors->first('cost_amt')"/>

                                </x-input.label>

                            </div>


                        </div>

                    @endif

                    <div class="grid col-span-2">

                        <x-input.submit>

                            Update

                        </x-input.submit>


                    </div>

                </x-modal.form>

            @elseif($studentView)

                <div @click.away="isEdit = false"
                    class="relative flex flex-col min-w-0 break-words bg-white p-3 w-9/12 mb-6 shadow-lg rounded ">

                    <div class="rounded-t mb-0 px-4 py-3 border-0">

                        <div class="flex flex-wrap items-center">

                            <div class="relative w-full px-4 max-w-full flex-grow flex-1">

                                <h3 class="font-semibold text-base text-blueGray-700"> {{ $studentInfo[0]->students->first_nm }} {{ $studentInfo[0]->students->last_nm }}
                                    Status</h3>

                            </div>

                        </div>

                    </div>

                    <x-table>

                        <x-slot name="header">

                            <x-table.head> Subject</x-table.head>

                            <x-table.head> Status</x-table.head>

                            <x-table.head> Year of Exam</x-table.head>

                            <x-table.head></x-table.head>

                        </x-slot>

                        <x-table.body>

                            @forelse($studentInfo as $choice)

                                <x-table.row>

                                    <x-table.data> {{ $choice->subjects->subject_nm }} </x-table.data>

                                    <x-table.data>

                                        @if($choice->status === null)
                                            Pending
                                        @elseif($choice->status)
                                            Approved
                                        @else
                                            Rejected
                                        @endif

                                    </x-table.data>

                                    <x-table.data> {{ $choice->year_of_exam }} </x-table.data>

                                    @if($choice->status === null)

                                        <x-table.data class="space-x-2">

                                            <a wire:click.prevent="statusChange({{ $choice }},1)" href="#" class="text-white font-bold shadow py-1 px-3 rounded
                                                    text-xs bg-green-500 hover:bg-green-600">

                                                Approve

                                            </a>

                                            <a wire:click.prevent="statusChange({{ $choice }},0)" href="#" class="text-white font-bold shadow py-1 px-3 rounded
                                                   text-xs bg-red-500 hover:bg-red-600">

                                                Rejected

                                            </a>

                                        </x-table.data>



                                    @endif

                                </x-table.row>

                            @empty

                                <x-table.row>

                                    <x-table.data colspan="4"> No Subject Have Been Selected</x-table.data>

                                </x-table.row>

                            @endforelse

                        </x-table.body>

                    </x-table>

                </div>

            @endif


        </div>


    </div>


</div>
