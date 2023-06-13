@props(['name','isButton' => false ]) @if ($isButton)
<button {{ $attributes->
    merge([ 'class' => 'min-w-[130px] flex text-sm items-center justify-center gap-2
    text-center py-1 px-3 bg-gray-800 hover:bg-gray-900 dark:bg-gray-700 dark:hover:bg-gray-800 dark:hover:border rounded-lg text-white'
    ]) }} >
    <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="w-6 h-6"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
        />
    </svg>
    <span>{{ $name }} </span>
</button>
@else
<a {{ $attributes->
    merge([ 'class' => 'min-w-[130px] flex text-sm items-center justify-center gap-2
    text-center py-1 px-3 bg-gray-800 hover:bg-gray-900 dark:bg-gray-700 dark:hover:bg-gray-800 dark:hover:border rounded-lg text-white'
    ]) }} >
    <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="w-6 h-6"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
        />
    </svg>
    <span>{{ $name }} </span>
</a>
@endif
