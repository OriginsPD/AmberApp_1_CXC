<div class="flex flex-col items-center justify-center w-full ">

    <div class="flex flex-col border-b border-gray-500 text-center w-full my-4">

        <h1 class="sm:text-5xl text-4xl font-medium font-extrabold mb-4 text-gray-900">Dashboard</h1>

    </div>

    <x-alert.success :message="session('success')" />

    <div x-data="{ isOpen: false }"
         x-on:close-modal.window="isOpen = false"
         class="px-4 mx-auto w-full sm:px-6 md:px-8">

        <div class="relative flex flex-col min-w-0 break-words bg-white p-3 w-full mb-6 shadow-lg rounded ">

            <div class="rounded-t mb-0 space-x-2 px-4 py-3 border-0">

                <div class="flex flex-wrap items-center">

                    <div class="relative w-full px-4 max-w-full flex-grow flex-1">

                        <h3 class="font-semibold text-base text-blueGray-700">Student Choices</h3>

                    </div>

                    <div class="relative p-3" wire:loading>

                        <i class="fad fa-spinner-third text-blue-400"
                           wire:loading.class="animate-spin"></i>

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

                    <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">

                        <button @click.prevent="isOpen = !isOpen"
                            class="bg-green-500 shadow text-white active:bg-green-600 text-xs font-bold
                                    uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear
                                    transition-all duration-150" type="button">

                            Add New Choice

                        </button>

                    </div>


                </div>

            </div>


            <x-table>

                <x-slot name="header">

                    <x-table.head> Student Name</x-table.head>

                    <x-table.head> Subject </x-table.head>

                    <x-table.head> Status </x-table.head>

                    <x-table.head> Year of Exam </x-table.head>

                </x-slot>

                <x-table.body>

                    @forelse($studentChoices as $choice)

                        <x-table.row>

                            <x-table.data> {{ $choice->students->first_nm }} {{ $choice->students->last_nm }} </x-table.data>

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


                        </x-table.row>

                    @empty

                        <x-table.row>

                            <x-table.data colspan="4" class="w-full text-center">

                                No Students Found

                            </x-table.data>

                        </x-table.row>

                    @endforelse

                </x-table.body>

            </x-table>

            <div class="p-5 m-2">

                {{ $studentChoices->links() }}

            </div>

        </div>

        <div x-show="isOpen"
             @keydown.esc.window="isOpen = false"
             x-transition.duration.300ms
             class="fixed flex items-center z-50 justify-center bg-black bg-opacity-75 h-screen w-screen top-0 bottom-0 left-0 ">

            <x-modal.form wire:submit.prevent="storeChoice"
                          @click.away.window="isOpen = false"
                          title="New Subject Choice">


                    <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">

                        <div class="grid grid-cols-1 space-x-2">

                            <x-input.label for="student_id" label="Student">

                                <x-input.select wire:model="student_id" :errors="$errors->first('student_id')">

                                    <option selected >Please Select Student</option>

                                    @forelse($students as $student)

                                        <option value="{{ $student->id}}">{{ $student->first_nm }} {{ $student->last_nm }}</option>

                                    @empty

                                        <option selected disabled >No Student Found</option>

                                    @endforelse

                                </x-input.select>

                            </x-input.label>

                        </div>

                        <div class="grid grid-cols-1 space-x-2">

                            <x-input.label for="subject_id" label="Subject">

                                <x-input.select wire:model="subject_id" :errors="$errors->first('subject_id')">

                                    <option selected >Please Select Subject</option>

                                    @forelse($subjects as $subject)

                                        <option value="{{ $subject->id}}">{{ $subject->subject_nm }} </option>

                                    @empty

                                        <option selected disabled >No Subjects Found</option>

                                    @endforelse

                                </x-input.select>

                            </x-input.label>

                        </div>

                        <div class="grid grid-cols-1 space-x-2">

                            <x-input.label for="examDate" label="Exam Date">

                                <x-input.text wire:model="examDate" :errors="$errors->first('examDate')"/>

                            </x-input.label>

                        </div>


                    </div>


                <div class="grid grid-cols-1">

                    <x-input.submit>

                        Create

                    </x-input.submit>


                </div>

            </x-modal.form>

        </div>


    </div>

</div>
