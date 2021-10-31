<div>

    <div x-data="{ tabs: 'tab1' }">

        <ul class="flex text-center top-0 sticky z-30 overflow-hidden bg-white border-t border-b border-gray-200">

        <li @click.prevent="tabs = 'tab1'"
            class="flex-1">

            <a class="block p-4 text-sm font-medium justify-center items-center text-black"
               :class="{ 'relative block p-4 text-sm font-medium bg-white border-t border-l border-r border-gray-200' : tabs === 'tab1' }"
               href="">

                <span :class="{ 'absolute inset-x-0 w-full h-px bg-white -bottom-px' : tabs === 'tab1' }"></span>

                Payment Details

            </a>

        </li>

        <li @click.prevent="tabs = 'tab2'"
            class="flex-1">

            <a class="block p-4 text-sm font-medium justify-center items-center text-black"
               :class="{ 'relative block p-4 text-sm font-medium bg-white border-t border-l border-r border-gray-200' : tabs === 'tab2' }"
               href="">

                <span :class="{ 'absolute inset-x-0 w-full h-px bg-white -bottom-px' : tabs === 'tab2' }"></span>

                Transaction Details

            </a>

        </li>

        <li @click.prevent="tabs = 'tab3'"
            class="flex-1">

            <a class="block p-4 text-sm font-medium justify-center items-center text-black"
               :class="{ 'relative block p-4 text-sm font-medium bg-white border-t border-l border-r border-gray-200' : tabs === 'tab3' }"
               href="">

                <span :class="{ 'absolute inset-x-0 w-full h-px bg-white -bottom-px' : tabs === 'tab3' }"></span>

                Payment Log

            </a>

        </li>

        </ul>

        <div x-show="tabs === 'tab1'" x-transition.duration.300ms
             class="space-y-2">

            @livewire('admin.report.payment-detail')

        </div>

        <div x-show="tabs === 'tab2'" x-transition.duration.300ms
             class="space-y-2">

            @livewire('admin.report.transaction-detail')

        </div>

        <div x-show="tabs === 'tab3'" x-transition.duration.300ms
             class="space-y-2">

            @livewire('admin.report.payment-log')

        </div>

    </div>


</div>
