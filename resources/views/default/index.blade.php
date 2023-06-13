@extends(authzone_layout_path('app'))
@section('title', 'Authzone - Index')
@section('content')
<section
    class="w-full grid grid-cols-1 gap-5 tracking-wide leading-8 dark:text-gray-50"
>
<h1 class="text-3xl font-bold text-gray-800 dark:text-gray-50">Welcome to Authzone!</h1>
    <p>
        The "AuthZone" is a Laravel package designed to provide a simple
        and user-friendly interface for managing user permissions and roles in a
        Laravel application. Built on top of the popular Spatie Laravel
        Permission package, AuthZone aims to simplify the process of
        implementing user authentication and authorization by providing a set of
        intuitive UI components that allow users to easily manage their roles
        and permissions.
    </p>
    <p>
        With AuthZone, you can quickly and easily define roles and permissions
        for your application, and assign them to your users as needed. The
        package provides a simple and intuitive interface that allows you to
        manage user roles and permissions from a central location, and to easily
        assign or revoke those roles and permissions as needed.
    </p>
    <p>
        The package is built on top of the Spatie Laravel Permission package,
        which provides a powerful and flexible permissions system for Laravel
        applications. AuthZone takes that system and makes it even easier to
        use, with a set of pre-built UI components that allow you to quickly
        create and manage permissions and roles.
    </p>
    <p>Some of the key features of AuthZone include:</p>
    <ul class="list-disc list-inside">
        <li>
            An intuitive and easy-to-use UI for managing user roles and
            permissions
        </li>
        <li>
            A set of pre-built UI components for creating and editing roles and
            permissions
        </li>
        <li>Integration with Laravel's built-in authentication system</li>
        <li>Support for multiple guards and authentication providers</li>
        <li>Built-in support for Laravel's blade templates</li>
    </ul>
    <p>
        Whether you are building a small application or a large enterprise
        system, AuthZone can help simplify the process of managing user
        permissions and roles. With its powerful and flexible permissions
        system, intuitive UI, and seamless integration with Laravel, AuthZone is
        the perfect choice for any Laravel developer looking to implement user
        authentication and authorization.
    </p>
</section>
@endsection
