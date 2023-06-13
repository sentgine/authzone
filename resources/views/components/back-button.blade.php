@props(['name'])
<a {{ $attributes->
    merge([ 'class' => 'flex text-sm items-center justify-start gap-2
    text-center py-2 px-3 bg-gray-800 hover:bg-gray-900 rounded-md text-white
    shadow-lg' ]) }} >
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
            d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3"
        />
    </svg>
    <span>
        @isset($name)
        {{ $name }}
        @endisset
    </span>
</a>
