<div x-data="{ isOpen: false, firstDrop: false, secondDrop: false }"
     x-on:open-modal.window="isOpen = true"
     x-on:close-modal.window="isOpen = false"

    class="w-full h-screen text-sm bg-gray-800 mt-8 sm:mt-0">

    <div class="flex items-center justify-center mt-10">

        <h1>

            <span class="ml-2 font-extrabold italic text-blue-500 text-4xl">

                <span class="uppercase tracking-tighter text-4xl text-orange-500">

                    Amber</span>CXC

            </span>

        </h1>

    </div>

    <nav class="mt-10 flex flex-col space-y-2">

        <x-navigation.adminLinks :href="route('admin.dashboard')"
                                 :active="request()->routeIs('admin.dashboard')">

            <x-slot name="icon">

                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 11H5M19 11C20.1046 11 21 11.8954 21 13V19C21 20.1046 20.1046 21 19 21H5C3.89543 21 3 20.1046 3 19V13C3 11.8954 3.89543 11 5 11M19 11V9C19 7.89543 18.1046 7 17 7M5 11V9C5 7.89543 5.89543 7 7 7M7 7V5C7 3.89543 7.89543 3 9 3H15C16.1046 3 17 3.89543 17 5V7M7 7H17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

            </x-slot>

            {{ __('Dashboard') }}

        </x-navigation.adminLinks>

        <x-navigation.adminLinks :href="route('admin.student')"
                                 :active="request()->routeIs('admin.student')">

            <x-slot name="icon">

                <i class="fad fa-list-alt"></i>

            </x-slot>

            {{ __('Students / Subject') }}

        </x-navigation.adminLinks>

        <div @if(request()->routeIs('admin.student')) x-show="firstDrop=true" @else x-show="firstDrop = false"  @endif
             x-transition.duration.300ms.origin.top
            class=" p-3 space-y-1 -mt-8">

            <x-navigation.adminLinks wire:click.prevent="addStudent"

                href="#">

                <x-slot name="icon">

                    <i class="fad fa-layer-plus"></i>

                </x-slot>

                {{ __('Add Student') }}

            </x-navigation.adminLinks>


            <x-navigation.adminLinks wire:click.prevent="addSubject" href="#">

                <x-slot name="icon">

                    <i class="fad fa-layer-plus"></i>

                </x-slot>

                {{ __('Add Subject') }}

            </x-navigation.adminLinks>

        </div>

        <x-navigation.adminLinks :href="route('admin.teacher')" :active="request()->routeIs('admin.teacher')">

            <x-slot name="icon">

                <i class="fad fa-chalkboard-teacher"></i>

            </x-slot>

            {{ __('Teacher Details') }}

        </x-navigation.adminLinks>

        <div @if(request()->routeIs('admin.teacher')) x-show="secondDrop=true" @else x-show="secondDrop=false"  @endif
             class="p-3 -mt-6">

            <x-navigation.adminLinks wire:click.prevent="addTeacher" href="#">

                <x-slot name="icon">

                    <i class="fad fa-layer-plus"></i>

                </x-slot>

                {{ __('Add Teacher') }}

            </x-navigation.adminLinks>


        </div>

        <x-navigation.adminLinks :href="route('admin.payment')" :active="request()->routeIs('admin.payment')">

            <x-slot name="icon">

                <i class="far fa-credit-card"></i>

            </x-slot>

            {{ __('Payment Details') }}

        </x-navigation.adminLinks>

            <x-navigation.adminLinks :href="route('admin.report')" :active="request()->routeIs('admin.report')">

                <x-slot name="icon">

                    <i class="fas fa-file-chart-line"></i>

                </x-slot>

                {{ __('Report') }}

            </x-navigation.adminLinks>

        <x-navigation.adminLinks wire:click="logout" class="absolute z-20 cursor-pointer bg-none bottom-10" >

            <x-slot name="icon">

                <i class="far fa-credit-card"></i>

            </x-slot>

            {{ __('Logout') }}

        </x-navigation.adminLinks>


    </nav>

    <div x-show="isOpen"
         @keydown.esc.window="isOpen = false"
         x-transition.duration.300ms
         class="fixed flex items-center z-50 justify-center bg-black bg-opacity-75 h-screen w-screen top-0 bottom-0 left-0 ">

        @if($teacherAdd)

            <x-modal.form wire:submit.prevent="createTeacher"
                          @click.away.window="isOpen = false"
                          title="New Teacher">

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

                            <x-input.label for="email" label="Email Address">

                                <x-input.text wire:model="email"
                                              type="email" :errors="$errors->first('email')"/>

                            </x-input.label>

                        </div>

                        <div class="grid grid-cols-1 space-x-2">

                            <x-input.label for="gender" label="Gender">

                                <x-input.select wire:model="gender"
                                                type="number" :errors="$errors->first('gender')">

                                    <option selected > Please Select Gender </option>

                                    <option value="Male"> Male </option>

                                    <option value="Female"> Female </option>

                                </x-input.select>

                            </x-input.label>

                        </div>

                        <div class="grid grid-cols-1 space-x-2">

                            <x-input.label for="password" label="Password">

                                <x-input.text wire:model="password"
                                              type="text" readonly :errors="$errors->first('password')"/>

                            </x-input.label>

                        </div>


                    </div>

                <div class="grid grid-cols-1">

                    <x-input.submit>

                        Create

                    </x-input.submit>


                </div>

            </x-modal.form>

        @else

            <x-modal.form wire:submit.prevent=" {{ $subjectAdd ? 'createSubject' : 'createStudent' }} "
                          @click.away.window="isOpen = false"
                          title="New Subject">

                @if($subjectAdd)

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


                @else

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

                            <x-input.label for="email" label="Email Address">

                                <x-input.text wire:model="email"
                                              type="email" :errors="$errors->first('email')"/>

                            </x-input.label>

                        </div>

                        <div class="grid grid-cols-1 space-x-2">

                            <x-input.label for="gender" label="Gender">

                                <x-input.select wire:model="gender"
                                                type="number" :errors="$errors->first('gender')">

                                    <option selected > Please Select Gender </option>

                                    <option value="Male"> Male </option>

                                    <option value="Female"> Female </option>

                                </x-input.select>

                            </x-input.label>

                        </div>

                        <div class="grid grid-cols-1 space-x-2">

                            <x-input.label for="password" label="Password">

                                <x-input.text wire:model="password"
                                              type="text" readonly :errors="$errors->first('password')"/>

                            </x-input.label>

                        </div>


                    </div>

                @endif

                <div class="grid grid-cols-1">

                    <x-input.submit>

                        Create

                    </x-input.submit>


                </div>

            </x-modal.form>


        @endif

    </div>

</div>
