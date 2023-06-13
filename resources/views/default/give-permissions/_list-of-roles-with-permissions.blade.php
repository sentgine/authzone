<!-- List of roles with permissions  -->
<section class="mt-10 max-w-[500px] md:min-w-full overflow-auto">
    <x-authzone-component-heading-simple class="mb-8"
        >Role List with Permissions</x-authzone-component-heading-simple
    >
    <x-authzone-component-table>
        <x-slot name="top">
            <form method="GET">
                <x-authzone-component-search
                    name="search"
                    value="{{ request()->input('search') }}"
                />
            </form>
        </x-slot>
        <x-slot name="heading"
            ><th
                scope="col"
                class="text-sm font-medium px-6 py-4 text-left"
                width="10%"
            >
                Role Name
            </th>
            <th
                scope="col"
                class="text-sm font-medium px-6 py-4 text-left"
                width="10%"
            >
                Guard Name
            </th>
            <th
                scope="col"
                class="text-sm font-medium px-6 py-4 text-left"
                width="60%"
            >
                Permissions
            </th>
            <th
                scope="col"
                class="text-sm font-medium px-6 py-4 text-left"
                width="5%"
            >
                Action
            </th>
        </x-slot>
        <x-slot name="body">
            @foreach ($rolesWithPermissions as $role)
            <x-authzone-component-table-row>
                <x-authzone-component-table-data>
                    {{ $role->name }}
                </x-authzone-component-table-data>
                <x-authzone-component-table-data>
                    {{ $role->guard_name }}
                </x-authzone-component-table-data>
               
                <x-authzone-component-table-data class="text-gray-900 font-light px-6 py-4 whitespace-nowrap flex flex-wrap gap-2">
                    @foreach ($role->permissions as $permission)
                    <span
                        class="pt-1 px-2 flex justify-between shadow-sm border rounded bg-blue-200 cursor-pointer"
                    >
                        <span> {{ $permission->name }}</span>

                        <form
                            method="POST"
                            action="{{
                                route(
                                    'give-permissions.removePermission',
                                    [
                                        'permission' => $permission,
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
                    <form
                        action="{{
                            route('give-permissions.revokePermissions', [
                                'permission' => $permission,
                                'role' => $role
                            ])
                        }}"
                        method="POST"
                    >
                        @csrf @method('DELETE')
                        <x-authzone-component-delete-button
                            type="submit"
                            onclick="return confirm('Are you sure you want to revoke all permissions from [{{ $role->name }}] role?');"
                            :name="__('Delete')"
                        />
                    </form>
                </x-authzone-component-table-data>
            </x-authzone-component-table-row>
            @endforeach
        </x-slot>
        <x-slot name="bottom"> {!! $rolesWithPermissions->links() !!} </x-slot>
    </x-authzone-component-table>
</section>
