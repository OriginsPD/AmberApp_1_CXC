<div
    x-data="{ isEdit: false }"
    x-on:show-modal.window="isEdit = true"
    x-on:close-modal.window="isEdit = false">

    <x-alert.success :message="session('success')"/>

    <div class="px-4 mx-auto max-w-7xl mt-5 sm:px-6 md:px-8">

        <h1 class="text-lg text-gray-600"> Full Teachers Details </h1>

    </div>

    <div class="w-full xl:w-full z-10 xl:mb-0 px-4 mx-auto mt-8">

        <div class="relative flex flex-col min-w-0 break-words bg-white p-3 w-full mb-6 shadow-lg rounded ">

            <div class="rounded-t mb-0 px-4 py-3 border-0">

                <div class="flex flex-wrap items-center space-x-2">

                    <div class="relative w-full px-4 max-w-full flex-grow flex-1">

                        <h3 class="font-semibold text-base text-blueGray-700">Student Information</h3>

                    </div>

                    <div class="relative p-3" wire:loading>

                        <i class="fad fa-spinner-third text-blue-400"
                           wire:loading.class="animate-spin"></i>

                    </div>

                    <div
                        class=" pl-4 pr-2 bg-white border-gray-900 border rounded-full flex justify-between items-center relative">

                        <label>
                            <input wire:model="search" placeholder="Search"
                                   class="h-10 appearance-none w-full outline-none focus:outline-none active:outline-none"/>
                        </label>

                        <div class="ml-1 outline-none focus:outline-none active:outline-none">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                 stroke-width="2"
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

                    <x-table.head> Subject</x-table.head>

                    <x-table.head> Email</x-table.head>

                    <x-table.head> Status</x-table.head>

                    <x-table.head></x-table.head>

                </x-slot>

                <x-table.body>

                    @forelse($teachers as $teacher)

                        <x-table.row>

                            <x-table.data> {{ ($teacher->gender === 'Male') ? 'Mr.' : 'Ms.' }} {{ $teacher->first_nm }} {{ $teacher->last_nm }} </x-table.data>

                            <x-table.data> {{ $teacher->subjects->subject_nm }} </x-table.data>

                            <x-table.data> {{ $teacher->email }} </x-table.data>

                            <x-table.data class="space-x-2">

                                @if($teacher->status === null)

                                    <a wire:click.prevent="changeStatus({{ $teacher }},1)" href="#" class="text-white font-bold shadow py-1 px-3 rounded
                                                    text-xs bg-green-500 hover:bg-green-600">

                                        Approve

                                    </a>

                                    <a wire:click.prevent="changeStatus({{ $teacher }},0)" href="#" class="text-white font-bold shadow py-1 px-3 rounded
                                                   text-xs bg-red-500 hover:bg-red-600">

                                        Rejected

                                    </a>

                                @else

                                    {{ ($teacher->status) ? 'Approved' : 'rejected' }}

                                @endif

                            </x-table.data>

                            <x-table.data class="space-x-2">

                                <a wire:click.prevent="editTeacher({{ $teacher }})" href="#" class="text-white font-bold
                                 shadow py-1 px-3 rounded text-xs bg-green-500 hover:bg-green-600">

                                    Edit

                                </a>

                            </x-table.data>

                        </x-table.row>

                    @empty

                        <x-table.row>

                            <x-table.data colspan="7" class="w-full text-center">

                                No Teachers Found

                            </x-table.data>

                        </x-table.row>

                    @endforelse

                </x-table.body>

            </x-table>

            <div class="p-5 m-2">

                {{ $teachers->links() }}

            </div>

        </div>

    </div>

    <div>

        <div x-show="isEdit"
             @keydown.esc.window="isEdit = false"
             x-transition.duration.300ms
             class="fixed flex items-center z-50 justify-center bg-black bg-opacity-75 h-screen w-screen top-0 bottom-0 left-0 ">

            <x-modal.form wire:submit.prevent="storeEdit"
                          @click.away.window="isEdit = false"
                          title="Edit Teacher Details">

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

                        <x-input.label for="subject_id" label="Subject Assigned">

                            <x-input.select wire:model="subject_id" :errors="$errors->first('subject_id')">

                                <option selected>Please Select Subject</option>

                                @forelse($subjects as $subject)

                                    <option value="{{ $subject->id}}">{{ $subject->subject_nm }} </option>

                                @empty

                                    <option selected disabled>No Subjects Found</option>

                                @endforelse

                            </x-input.select>

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

                <div class="grid col-span-2">

                    <x-input.submit>

                        Update

                    </x-input.submit>


                </div>

            </x-modal.form>

        </div>


    </div>


</div>
