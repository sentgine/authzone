<div
    class="grid grid-cols-1"
    x-data="{
            showModal: {{ $errors->any() ? 'true' : 'false' }},
        }"
    x-cloak
>
    <x-authzone-component-delete-button
        class="py-2"
        :isButton="true"
        :name="__('Unassign all')"
        @click="showModal=true"
    />
    <x-authzone-component-modal
        x-cloak
        x-bind:class="showModal ? 'visible' : 'hidden'"
    >
        <x-authzone-component-modal-close-button @click="showModal=false" />
        <h2 class="text-lg font-bold tracking-wider text-gray-700">
            Want to remove all roles from all users?
        </h2>
        <form
            method="POST"
            action="{{ route('assign-roles.remove-roles-from-all-users') }}"
            class="grid grid-cols-1 mt-8"
        >
            @csrf

            <x-authzone-component-save-button
                type="submit"
                class="py-2 mt-5"
                :name="__('Yes')"
            />
        </form>
    </x-authzone-component-modal>
</div>
