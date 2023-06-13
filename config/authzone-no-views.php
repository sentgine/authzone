<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authzone Route Group
    |--------------------------------------------------------------------------
    |
    | This value is the route group name. You can change this.
    |
    */
    'route_group' => 'authzone',

    /*
    |--------------------------------------------------------------------------
    | The Authzone Component Path
    |--------------------------------------------------------------------------
    |
    | This value is is for the component path.
    | Possible values: ['authzone::components', 'sentgine.authzone.components']
    |
    */
    'component_path' => 'authzone::components',

    /*
    |--------------------------------------------------------------------------
    | The Authzone View Path.
    |--------------------------------------------------------------------------
    |
    | This value is is for the views path.
    | Possible values: [
    | 'authzone::default', 'authzone::jetstream',
    | 'authzone::breeze', 'sentgine.authzone.default', 
    | 'sentgine.authzone.jetstream', 'sentgine.authzone.breeze'
    | ]
    |
    */
    'view_path' => 'authzone::default',

    /*
    |--------------------------------------------------------------------------
    | The Authzone Layout Path.
    |--------------------------------------------------------------------------
    |
    | This value is is for the layout path.
    | Possible values: ['authzone::layouts', 'sentgine.authzone.layouts']
    |
    */
    'layout_path' => 'authzone::layouts',

    /*
    |--------------------------------------------------------------------------
    | The Authzone Directive Path.
    |--------------------------------------------------------------------------
    |
    | This value is is for the directive path.
    | Possible values: ['authzone::directives', 'sentgine.authzone.directives']
    |
    */
    'directive_path' => 'authzone::directives',

    /*
    |--------------------------------------------------------------------------
    | The User Model.
    |--------------------------------------------------------------------------
    |
    | The user model class being used. You can change this.
    |
    */
    'user_model' => 'App\Models\User',
];
