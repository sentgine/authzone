<?php

if (!function_exists('authzone_resolve_path')) {
    /**
     * Resolves the common path.
     * 
     * @param string $path
     * @param string $configPath
     * 
     * @return string
     */
    function authzone_resolve_path(string $path = "", string $configPath = ""): string
    {
        return $configPath . "." . $path;
    }
}

if (!function_exists('authzone_layout_path')) {
    /**
     * Returns the layout path.
     * 
     * @param string $path
     * 
     * @return string
     */
    function authzone_layout_path(string $path = ""): string
    {
        return authzone_resolve_path($path, config('authzone.layout_path'));
    }
}

if (!function_exists('authzone_component_path')) {
    /**
     * Returns the component path.
     * 
     * @param string $path
     * 
     * @return string
     */
    function authzone_component_path(string $path = ""): string
    {
        return authzone_resolve_path($path, config('authzone.component_path'));
    }
}

if (!function_exists('authzone_view_path')) {
    /**
     * Returns the view path.
     * 
     * @param string $path
     * 
     * @return string
     */
    function authzone_view_path(string $path = ""): string
    {
        return authzone_resolve_path($path, config('authzone.view_path'));
    }
}

if (!function_exists('authzone_directive_path')) {
    /**
     * Returns the directive path.
     * 
     * @param string $path
     * 
     * @return string
     */
    function authzone_directive_path(string $path = ""): string
    {
        return authzone_resolve_path($path, config('authzone.directive_path'));
    }
}

if (!function_exists('is_authzone_view_exist')) {
    /**
     * Checks if the view exists
     * 
     * @param string $path
     * 
     * @return bool
     */
    function is_authzone_view_exist(string $path): bool
    {
        if (Illuminate\Support\Facades\View::exists(authzone_view_path($path))) {
            return true;
        }

        return false;
    }
}

if (!function_exists('authzone_url')) {
    /**
     * Just providing an easy way to cleanup the URL.
     * 
     * @param string $url
     * 
     * @return \Illuminate\Contracts\Routing\UrlGenerator
     */
    function authzone_url($url = ""): \Illuminate\Contracts\Routing\UrlGenerator|string
    {
        return url('/' . config('authzone.route_group') . '/' . $url);
    }
}

if (!function_exists('authzone_user_model')) {
    /**
     * Returns a new instance of the user model class.
     * 
     * @return Illuminate\Foundation\Auth\User
     */
    function authzone_user_model(): Illuminate\Foundation\Auth\User
    {
        $className = config('authzone.user_model');
        return app($className);
    }
}
