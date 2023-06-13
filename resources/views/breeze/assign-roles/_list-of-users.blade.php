<!-- List of roles with permissions  -->
<section class="mt-10 max-w-[500px] md:min-w-full overflow-auto">
    <x-authzone-component-table>
        <x-slot name="top">
            <form method="GET">
                <x-authzone-component-search
                    name="search"
                    value="{{ request()->input('search') }}"                   
                />
            </form>
            @include(authzone_view_path('assign-roles._remove-roles-from-all-users'))
            @include(authzone_view_path('assign-roles._single-role-bulk-assign'))
        </x-slot>
        <x-slot name="heading"
            ><th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                Email
            </th>
            <th scope="col" class="text-sm font-medium px-6 py-4 text-left">
                Role(s)
            </th>
            <th
                scope="col"
                class="text-sm font-medium px-6 py-4 text-left"
                width="10%"
            >
                Action
            </th>
        </x-slot>
        <x-slot name="body">
            @foreach ($users as $user)
            <x-authzone-component-table-row>
                <x-authzone-component-table-data>
                    {{ $user->email }}
                </x-authzone-component-table-data>
                <x-authzone-component-table-data class="text-gray-900 font-light px-6 py-4 whitespace-nowrap flex flex-wrap gap-2">
                    @foreach ($user->roles as $role)
                    <span
                        class="pt-1 px-2 flex justify-between shadow-sm border rounded bg-blue-200 cursor-pointer"
                    >
                        <span> {{ $role->name }} </span>
                        <form
                            method="POST"
                            action="{{
                                route(
                                    'assign-roles.removeRole',
                                    [
                                        'userId' => $user->id,
                                        'role' => $role
                                    ]
                                )
                            }}"
                        >
                            @csrf @method('DELETE')
                            <button class="ml-2">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6 hover:text-red-700"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </form>
                    </span>
                    @endforeach
                </x-authzone-component-table-data>
                <x-authzone-component-table-data>
                    <x-authzone-component-create-button
                        class="w-[140px]"
                        href="{{ route('assign-roles.edit', $user->id) }}"
                        :name="__('Assign roles')"
                    />
                </x-authzone-component-table-data>
            </x-authzone-component-table-row>
            @endforeach
        </x-slot>
        <x-slot name="bottom"> {!! $users->links() !!} </x-slot>
    </x-authzone-component-table>
</section>
