<div {{ $attributes->
    merge(['class' => 'fixed z-10 inset-0 overflow-y-auto']) }}>
    <div
        class="flex items-center justify-center min-h-screen px-4 pt-6 pb-20 text-center sm:block sm:p-0"
    >
        <!-- The modal content -->
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span
            class="hidden sm:inline-block sm:align-middle sm:h-screen"
            aria-hidden="true"
            >&#8203;</span
        >

        <div
            class="inline-block align-bottom bg-white dark:bg-gray-900 dark:text-white rounded-lg px-4 pt-5 pb-4 text-left shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog"
            aria-modal="true"
            aria-labelledby="modal-headline"
        >
            <div class="overflow-hidden dark:text-white">{{ $slot }}</div>
        </div>
    </div>
</div>
