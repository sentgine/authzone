<!-- The form to give permissions to a role. -->
<form method="POST" action="{{ route('give-permissions.store') }}">
    @csrf
    <div class="flex justify-end">
        <x-authzone-component-save-button
            type="submit"
            class="py-2 dark:bg-gray-900 dark:hover:bg-gray-950"
            :name="__('Save changes')"
        />
    </div>
    <div class="grid grid-cols-1 gap-2 lg:grid-cols-2">
        <x-authzone-component-form-container>
            <h2 class="text-xl font-semibold">Role</h2>
            <div class="mt-5">
                <select
                    class="authzone-select2-role mt-5 rounded w-[300px]"
                    name="role"
                >
                    <option value="">Select a role</option>
                    @foreach ($roles as $role)
                    <option value="{{ $role->name }}">
                        {{ $role->name }} ({{ $role->guard_name }})
                    </option>
                    @endforeach
                </select>
                @error('role')
                <div class="text-red-500 pt-1 pb-2">{{ $message }}</div>
                @enderror
            </div>
        </x-authzone-component-form-container>
        <x-authzone-component-form-container>
            <div>
                <div
                    x-data="{
                    isAll: false
                }"
                >
                    <div class="flex justify-start items-center gap-3">
                        <h2 class="text-xl font-semibold">Permissions</h2>
                        <div class="flex items-start justify-center gap-2">
                            <x-authzone-component-input 
                                class="mt-1"
                                type="checkbox"
                                name="isAll"
                                value="1"
                                x-model="isAll"
                            />
                            <span>Add all permissions</span>
                        </div>
                    </div>
                    <div x-show="!isAll" class="mt-5">
                        <select
                            class="authzone-select2-permissions"
                            name="permissions[]"
                            multiple="multiple"
                        >
                            @foreach ($permissions as $permission)
                            <option value="{{ $permission->name }}">
                                {{ $permission->name }}
                                ({{ $permission->guard_name}})
                            </option>
                            @endforeach
                        </select>
                        @error('permissions')
                        <div class="text-red-500 pt-1 pb-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </x-authzone-component-form-container>
    </div>
</form>
