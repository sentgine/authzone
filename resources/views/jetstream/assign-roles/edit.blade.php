<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-start gap-5">
            <x-authzone-component-back-button
                href=" {{ route('assign-roles.index') }}"
            />
            <x-authzone-component-heading-simple>
                {{__("Assigning a role to user")}}:
                {{ $user->email }}
            </x-authzone-component-heading-simple>
        </div>
    </x-slot>
    <div class="py-12 dark:text-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700"
            >
                
                <section>
                    <!-- The form to assigns permission to a role. -->
                    <form method="POST" action="{{ route('assign-roles.update', $user) }}">
                        @csrf @method('PUT')
                        <div class="flex justify-end">
                            <x-authzone-component-save-button
                                type="submit"
                                class="py-2 mr-5"
                                :name="__('Save changes')"
                            />
                        </div>
                        <x-authzone-component-form-container class="w-full">
                            <div
                                class="py-5"
                                x-data="{
                                    isAll: false
                                }"
                            >
                                <div class="flex justify-start items-center gap-3">
                                    <h2 class="text-xl font-semibold">
                                        Roles with Permissions
                                    </h2>
                                    <div class="flex items-start justify-center gap-2">
                                        <x-authzone-component-input 
                                            class="mt-1"
                                            type="checkbox"
                                            name="isAll"
                                            value="1"
                                            x-model="isAll"
                                        />
                                        <span>Add all roles</span>
                                    </div>
                                </div>
                                <div x-show="!isAll" class="mt-5">
                                    <select
                                        class="authzone-select2-roles"
                                        name="rolesWithPermissions[]"
                                        multiple="multiple"
                                    >
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->name }}" {{ in_array($role->
                                            name, $userRoles) ? 'selected' : '' }}>
                                            {{ $role->name }} ({{ $role->guard_name }})
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('rolesWithPermissions')
                                    <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </x-authzone-component-form-container>
                    </form>    
                </section>    
            </div>
        </div>
    </div>
</x-app-layout>
