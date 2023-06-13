<div class="border-t border-gray-200 dark:border-gray-600"></div>
<div class="block px-4 py-2 text-xs text-gray-400">
    {{ __('Authzone') }} 
</div>
<x-dropdown-link href="{{ authzone_url('permissions') }}">
    {{ __('Permissions') }} <sup>(1)</sup>
</x-dropdown-link>
<x-dropdown-link href="{{ authzone_url('roles') }}">
    {{ __('Roles') }} <sup>(2)</sup>
</x-dropdown-link>
<x-dropdown-link href="{{ authzone_url('give-permissions')}}">
    {{ __('Give permissions') }} <sup>(3)</sup>
</x-dropdown-link>
<x-dropdown-link href="{{ authzone_url('assign-roles') }}">
    {{ __('Assign roles') }} <sup>(4)</sup>
</x-dropdown-link>
<div class="border-t border-gray-200 dark:border-gray-600"></div>