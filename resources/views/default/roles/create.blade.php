@extends(authzone_layout_path('app'))
@section('title', 'Roles - Create')
@section('content')
<div class="flex items-center justify-start gap-5">
    <x-authzone-component-back-button href=" {{ route('roles.index') }}" />
    <x-authzone-component-heading-simple
        >Create a Role</x-authzone-component-heading-simple
    >
</div>
<section>
    <x-authzone-component-form-container class="max-w-[600px]">
        @if (session('message'))
        <x-authzone-component-alert
            class="bg-blue-600 text-white"
            :message="__(session('message'))"
        />
        @endif
        <form
            class="grid grid-cols-1 gap-3"
            method="POST"
            action="{{ route('roles.store') }}"
        >
            @csrf
            <div class="grid grid-cols-1 gap-2">
                <label class="font-semibold"
                    >Name<sup class="text-red-500 text-lg">*</sup></label
                >
                <x-authzone-component-input
                    class="text-gray-800"
                    type="text"
                    name="name"
                    placeholder="Enter the role name..."
                />
                @error('name')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="grid grid-cols-1 gap-2">
                <label class="font-semibold">Guard Name</label>
                <x-authzone-component-input
                    class="text-gray-800"
                    type="text"
                    name="guard_name"
                    placeholder="web"
                />
            </div>
            <x-authzone-component-save-button
                type="submit"
                class="py-2"
                :name="__('Save changes')"
            />
        </form>
    </x-authzone-component-form-container>
</section>
@endsection
