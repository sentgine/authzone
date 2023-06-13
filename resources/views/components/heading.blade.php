<!-- Component starts here -->
<h2 {{ $attributes->
    merge(['class' => 'flex flex-row flex-nowrap items-center mb-8'])
    }}>
    <span
        class="flex-none block mr-4 px-4 py-2.5 text-3xl leading-none font-medium bg-gray-800 dark:bg-gray-900 shadow-lg text-white rounded-sm"
    >
        {{ $slot }}
    </span>
    <span
        class="flex-grow block border-t border-gray-500 shadow-lg"
        aria-hidden="true"
        role="presentation"
    ></span>
</h2>
