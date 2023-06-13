<x-app-layout>
    <x-slot name="header">
        <h2
            class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
        >
            {{ __("Assign roles") }}
        </h2>
    </x-slot>
    <div class="py-12 dark:text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700"
            >
                <section class="mt-5">
                    @if (session('message'))
                    <x-authzone-component-alert
                        class="bg-blue-600 text-white"
                        :message="__(session('message'))"
                    />
                    @endif
                </section>
                @include(authzone_view_path('assign-roles._list-of-users'), ['users' => $users])
        
            </div>
        </div>
    </div>
</x-app-layout>
