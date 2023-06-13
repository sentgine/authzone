<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-start gap-5">
            <x-authzone-component-back-button
                href=" {{ route('permissions.index') }}"
            />
            <x-authzone-component-heading-simple
                >{{ __("Create a permission") }}</x-authzone-component-heading-simple
            >
        </div>
    </x-slot>
    <div class="py-12 dark:text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700"
            >
                <section
                    x-data="{
                        isCrud: false,
                        permissionName: ''
                    }"
                >
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
                            action="{{ route('permissions.store') }}"
                        >
                            @csrf
                            <div class="grid grid-cols-1 gap-2">
                                <label class="font-semibold"
                                    >Name<sup class="text-red-500 text-lg"
                                        >*</sup
                                    ></label
                                >
                                <x-authzone-component-input 
                                    class="text-gray-900"
                                    type="text"
                                    name="name"
                                    placeholder="Enter the permission name..."
                                    x-model="permissionName"
                                />
                                @error('name')
                                <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="grid grid-cols-1 gap-2">
                                <label class="font-semibold">Guard Name</label>
                                <x-authzone-component-input 
                                    class="text-gray-900"
                                    type="text"
                                    name="guard_name"
                                    placeholder="web"
                                />
                            </div>
                            <div class="grid grid-cols-1 gap-2">
                                <div class="flex items-start justify-left gap-2">
                                    <x-authzone-component-input 
                                        class="mt-1"
                                        type="checkbox"
                                        name="isCrud"
                                        value="1"
                                        x-model="isCrud"
                                    />
                                    <span>Create a permission resource</span>
                                </div>
                                <div x-show="isCrud" class="text-sm border p-5 text-gray-800 bg-white dark:text-gray-300 dark:bg-gray-800">
                                    <p>This will create a permission resource.</p>
                                    <ul class="ml-5 mt-1 list-disc tracking-wider">
                                        <li><strong>C</strong>reate <span x-text="permissionName"></span></li>
                                        <li><strong>R</strong>ead <span x-text="permissionName"></span></li>
                                        <li><strong>U</strong>pdate <span x-text="permissionName"></span></li>
                                        <li><strong>D</strong>elete <span x-text="permissionName"></span></li>
                                    </ul>
                                </div>
                            </div>
                            <x-authzone-component-save-button
                                type="submit"
                                class="py-2"
                                :name="__('Save changes')"
                            />
                        </form>
                    </x-authzone-form-container>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
