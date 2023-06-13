@extends(authzone_layout_path('app'))
@section('title', 'Roles - Index')
@section('content')
    <x-authzone-component-heading> Roles </x-authzone-component-heading>
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
                    class="w-[500px]"
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
            <th scope="col" class="px-6 py-2 font-thin">Guard Name</th>
            <th width="10%" scope="col" class="px-6 py-2 font-thin">Action</th>
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
    @endsection
