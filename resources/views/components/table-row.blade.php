<tr {{ $attributes->
    merge(['class' => 'text-base text-gray-900 transition duration-300
    ease-in-out bg-white hover:bg-gray-100 dark:bg-gray-900 dark:hover:bg-gray-700
    dark:text-white dark:hover:border-l dark:hover:border-r']) }} >
    {{
        $slot
    }}
</tr>
