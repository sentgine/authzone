@extends(authzone_layout_path('app'))
@section('title', 'Give Permissions - Index')
@section('content')
    <x-authzone-component-heading
        >Give Permissions
    </x-authzone-component-heading>
    <section class="mt-5">
        @if (session('message'))
        <x-authzone-component-alert
            class="bg-blue-600 text-white"
            :message="__(session('message'))"
        />
        @endif 
        @include(authzone_view_path('give-permissions._form'))
    </section>
    @include(authzone_view_path('give-permissions._list-of-roles-with-permissions'),['rolesWithPermissions' => $rolesWithPermissions])
@endsection
