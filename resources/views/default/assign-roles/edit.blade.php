@extends(authzone_layout_path('app'))
@section('title', 'Assign roles - Edit')
@section('content')
    <div class="flex items-center justify-start gap-5">
        <x-authzone-component-back-button
            href=" {{ route('assign-roles.index') }}"
        />
        <x-authzone-component-heading-simple
            >Assigning a roles to user:
            {{ $user->email }}</x-authzone-component-heading-simple
        >
    </div>
    <section>
            <!-- The form to assigns permission to a role. -->
            <form method="POST" action="{{ route('assign-roles.update', $user) }}">
                @csrf @method('PUT')
                <div class="flex justify-end">
                    <x-authzone-component-save-button
                        type="submit"
                        class="py-2 mr-5 dark:bg-gray-900 dark:hover:bg-gray-950"
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
@endsection
