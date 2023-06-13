<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-start gap-5">
            <x-authzone-component-back-button href=" {{ route('roles.index') }}" />
            <x-authzone-component-heading-simple>
                {{ __("Edit a role") }}
            </x-authzone-component-heading-simple>
        </div>
    </x-slot>
    <div class="py-12 dark:text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700"
            >
            <section>
                <x-authzone-component-form-container class="max-w-[600px]">
                    @if (session('message'))
                    <x-authzone-component-alert
                        class="bg-blue-600"
                        :message="__(session('message'))"
                    />
                    @endif
                    <form
                        class="grid grid-cols-1 gap-3"
                        method="POST"
                        action="{{ route('roles.update', $role->id) }}"
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
                                value="{{ $role->name }}"
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
                                value="{{ $role->guard_name }}"
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
            </div>
        </div>
    </div>
</x-app-layout>

