<ul class="space-y-2">
    <li
        title="#1 Create the name of the permission."
        class="{{ request()->is('*/permissions') ? 'bg-gray-800 rounded-lg' : '' }}"
    >
        <a
            href="{{ authzone_url('permissions') }}"
            class="flex items-center p-2 text-base font-normal rounded-lg hover:bg-gray-800"
        >
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
                    d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"
                />
            </svg>

            <span class="ml-3"> Permissions <sup>(1)</sup></span>
        </a>
    </li>
    <li
        title="#2 Create the name of the role."
        class="{{ request()->is('*/roles') ? 'bg-gray-800 rounded-lg' : '' }}"
    >
        <a
            href="{{ authzone_url('roles') }}"
            class="flex items-center p-2 text-base font-normal rounded-lg hover:bg-gray-800"
        >
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
                    d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"
                />
            </svg>

            <span class="ml-3">Roles <sup>(2)</sup></span>
        </a>
    </li>
    <li
        title="#3 Give permission(s) to a specific role."
        class="{{ request()->is('*/give-permissions') ? 'bg-gray-800 rounded-lg' : '' }}"
    >
        <a
            href="{{ authzone_url('give-permissions') }}"
            class="flex items-center p-2 text-base font-normal rounded-lg hover:bg-gray-800"
        >
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
                    d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"
                />
            </svg>

            <span class="ml-3"> Give Permissions <sup>(3)</sup></span>
        </a>
    </li>
    <li
        title="#4 Assign a role to a specific user."
        class="{{ request()->is('*/assign-roles') ? 'bg-gray-800 rounded-lg' : '' }}"
    >
        <a
            href="{{ authzone_url('assign-roles') }}"
            class="flex items-center p-2 text-base font-normal rounded-lg hover:bg-gray-800"
        >
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
                    d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"
                />
            </svg>

            <span class="ml-3"> Assign Roles <sup>(4)</sup></span>
        </a>
    </li>
    <li class="h-2"></li>
</ul>
