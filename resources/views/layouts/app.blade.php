<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="application-name" content="{{ config('app.name') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>@yield('title')</title>        
        @authzoneDefaultAssets         
        <script src="//unpkg.com/alpinejs" defer></script>    
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gray-200 dark:bg-gray-700">
        <div class="grid grid-cols-1 sm:flex">
            @include(authzone_layout_path('_sidebar'))
            <main class="sm:ml-[250px] sm:flex-1 min-w-0 overflow-auto p-10">
                @yield('content')
            </main>
        </div>
        <script>
            // In your Javascript (external.js resource or <script> tag)
            $(document).ready(function () {
                $(".authzone-select2").select2();
                $(".authzone-select2-permissions").select2({
                    placeholder: "Select a permission",
                });
                $(".authzone-select2-roles").select2({
                    placeholder: "Select roles",
                });
                $(".authzone-select2-role").select2({
                    placeholder: "Select a role",
                });
            });
        </script>
    </body>
</html>
