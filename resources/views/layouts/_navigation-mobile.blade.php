<div
    x-data="{          
            isOpen : false,
            toggle : function () {
               this.isOpen = ! this.isOpen;
            }
    }"
    class="visible h-full sm:h-0 sm:invisible sm:p-0"
>
    <div>
        <div class="flex items-center justify-between p-2">
            <span>
                @include(authzone_layout_path('_logo'))</span
            >
            <button
                @click="toggle()"
                class="grid grid-cols-1 text-sm uppercase shadow-lg"
            >
                <!-- The burger menu icon -->
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    :class="!isOpen ? 'w-12 h-12' : 'w-0 h-0 hidden'"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3.75 9h16.5m-16.5 6.75h16.5"
                    />
                </svg>
                <!-- The close menu icon -->
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    :class="isOpen ? 'w-12 h-12' : 'w-0 h-0 hidden'"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"
                    />
                </svg>
            </button>
        </div>
        <div x-show="isOpen" class="px-3">
            @include(authzone_layout_path('_navigation-menu'))
        </div>
    </div>
</div>
