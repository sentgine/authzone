@props(['name' => '', 'value' => ''])
<div {{ $attributes->
    merge([ 'class' => 'relative w-full sm:min-w-[350px] md:min-w-[400px] lg:min-w-[400px] xl:min-w-[500px]' ]) }} >
    <input
        name="{{ $name }}"
        value="{{ $value }}"
        type="text"
        placeholder="Search"
        class="px-4 py-2 border w-full border-gray-300 text-gray-700 rounded-lg shadow-sm focus:outline-none focus:border-blue-500"
    />
    <button type="submit" class="absolute right-0 top-0 mt-2 mr-3 text-gray-400">
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
                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
            />
        </svg>
    </button>
</div>
