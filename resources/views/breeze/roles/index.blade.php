<x-app-layout>
    <x-slot name="header">
        <h2
            class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
        >
            {{ __("Roles") }}
        </h2>
    </x-slot>
    <div class="py-12 dark:text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700"
            >
                @if (session('message'))
                <x-authzone-component-alert
                    class="bg-blue-600 text-white"
                    :message="__(session('message'))"
                />
                @endif
                <x-authzone-component-table>
                    <x-slot name="top">
                        <form method="GET">
                            <x-authzone-component-search
                                name="search"
                                value="{{ request()->input('search') }}"
                            />
                        </form>
                        <x-authzone-component-create-button
                            class="py-2"
                            href="{{ route('roles.create') }}"
                            :name="__('Add new')"
                        />
                    </x-slot>
                    <x-slot name="heading">
                        <th scope="col" class="px-6 py-2 font-thin">Name</th>
                        <th scope="col" class="px-6 py-2 font-thin">
                            Guard Name
                        </th>
                        <th width="10%" scope="col" class="px-6 py-2 font-thin">
                            Action
                        </th>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($roles as $role)
                        <x-authzone-component-table-row>
                            <x-authzone-component-table-data>
                                {{ $role->name }}
                            </x-authzone-component-table-data>
                            <x-authzone-component-table-data>
                                {{ $role->guard_name }}
                            </x-authzone-component-table-data>
                            <x-authzone-component-table-data class="flex gap-1">
                                <x-authzone-component-update-button
                                    href="{{ route('roles.edit', $role->id) }}"
                                    :name="__('Edit')"
                                />
                                <form
                                    action="{{ route('roles.destroy', $role->id) }}"
                                    method="POST"
                                >
                                    @csrf @method('DELETE')
                                    <x-authzone-component-delete-button
                                        type="submit"
                                        onclick="return confirm('Are you sure you want to delete item ID: {{ $role->id }} [ {{ $role->name }} ]?');"
                                        :name="__('Delete')"
                                    />
                                </form>
                            </x-authzone-component-table-data>
                        </x-authzone-component-table-row>
                        @endforeach
                    </x-slot>
                    <x-slot name="bottom">{!! $roles->links() !!}</x-slot>
                </x-authzone-component-table>
            </div>
        </div>
    </div>
</x-app-layout>
