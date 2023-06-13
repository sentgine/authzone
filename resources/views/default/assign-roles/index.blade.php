@extends(authzone_layout_path('app'))
@section('title', 'Assign roles - Index')
@section('content')
    <x-authzone-component-heading> Assign Roles </x-authzone-component-heading>
    <section class="mt-5">
        @if (session('message'))
        <x-authzone-component-alert
            class="bg-blue-600 text-white"
            :message="__(session('message'))"
        />
        @endif
    </section>
    @include(authzone_view_path('assign-roles._list-of-users'), ['users' => $users])
@endsection
