@extends(authzone_layout_path('app'))
@section('title', 'Permissions - Index')
@section('content')
    <x-authzone-component-heading> Permissions </x-authzone-component-heading>
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
                href="{{ route('permissions.create') }}"
                :name="__('Add new')"
            />
        </x-slot>
        <x-slot name="heading">
            <th scope="col" class="px-6 py-2 font-thin">Name</th>
            <th scope="col" class="px-6 py-2 font-thin">Guard Name</th>
            <th width="10%" scope="col" class="px-6 py-2 font-thin">Action</th>
        </x-slot>
        <x-slot name="body">
            @foreach ($permissions as $permission)
            <x-authzone-component-table-row>
                <x-authzone-component-table-data>
                    {{ $permission->name }}
                </x-authzone-component-table-data>
                <x-authzone-component-table-data>
                    {{ $permission->guard_name }}
                </x-authzone-component-table-data>
                <x-authzone-component-table-data class="flex gap-1">
                    <x-authzone-component-update-button
                        href="{{ route('permissions.edit', $permission->id ) }}"
                        :name="__('Edit')"
                    />

                    <form
                        action="{{ route('permissions.destroy', $permission->id) }}"
                        method="POST"
                    >
                        @csrf @method('DELETE')

                        <x-authzone-component-delete-button
                            type="submit"
                            onclick="return confirm('Are you sure you want to delete item ID: {{ $permission->id }} [ {{ $permission->name }} ]?');"
                            :name="__('Delete')"
                        />
                    </form>
                </x-authzone-component-table-data>
            </x-authzone-component-table-row>
            @endforeach
        </x-slot>
        <x-slot name="bottom"> {!! $permissions->links() !!} </x-slot>
    </x-authzone-component-table>
@endsection
