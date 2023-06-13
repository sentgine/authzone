@extends(authzone_layout_path('app'))
@section('title', 'Permissions - Edit:'. $permission->name) 
@section('content')
<div class="flex items-center justify-start gap-5">
    <x-authzone-component-back-button
        href=" {{ route('permissions.index') }}"
    />
    <x-authzone-component-heading-simple
        >Edit a Permission</x-authzone-component-heading-simple
    >
</div>
<section>
    <x-authzone-component-form-container class="max-w-[600px]">
        <form
            class="grid grid-cols-1 gap-3"
            method="POST"
            action="{{ route('permissions.update', $permission->id) }}"
        >
            @csrf @method('PUT')
            <div class="grid grid-cols-1 gap-2">
                <label class="font-semibold"
                    >Name<sup class="text-red-500 text-lg">*</sup></label
                >
                <x-authzone-component-input
                    class="text-gray-800"
                    type="text"
                    name="name"
                    value="{{ $permission->name }}"
                    placeholder="Enter the permission name..."
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
                    value="{{ $permission->guard_name }}"
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
