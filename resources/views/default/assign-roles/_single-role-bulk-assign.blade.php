<div
    class="grid grid-cols-1"
    x-data="{
            showModal: {{ $errors->any() ? 'true' : 'false' }},
        }"
    x-cloak
>
    <x-authzone-component-create-button
        class="py-2"
        :isButton="true"
        :name="__('Bulk assign')"
        @click="showModal=true"
    />
    <x-authzone-component-modal
        x-cloak
        x-bind:class="showModal ? 'visible' : 'hidden'"
    >
        <x-authzone-component-modal-close-button @click="showModal=false" />
        <h2 class="text-lg font-bold tracking-wider text-gray-700">
            What role do you want to add for all users?
        </h2>
        <form
            method="POST"
            action="{{ route('assign-roles.bulk') }}"
            class="grid grid-cols-1 mt-8"
        >
            @csrf
            <select class="authzone-select2-role rounded" name="role" required>
                <option value="">Select a role</option>
                @foreach ($roles as $role)
                <option value="{{ $role->name }}">
                    {{ $role->name }} ({{ $role->guard_name }})
                </option>
                @endforeach
            </select>
            <x-authzone-component-save-button
                type="submit"
                class="py-2 mt-5"
                :name="__('Save changes')"
            />
        </form>
    </x-authzone-component-modal>
</div>
