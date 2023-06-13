<div class="bg-gray-900 dark:bg-gray-900 dark:shadow-lg sm:h-screen sm:fixed">
    <nav class="sm:w-64 flex-none text-white">
       
        <!-- This part right here is for the Mobile navigation -->
        @include(authzone_layout_path('_navigation-mobile'))

        <!-- This part right here is for the desktop navigation -->
        @include(authzone_layout_path('_navigation-desktop'))
    </nav>
</div>
