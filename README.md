# Authzone

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE.md)
[![Latest Stable Version](https://img.shields.io/packagist/v/sentgine/authzone.svg)](https://packagist.org/sentgine/authzone)
[![Total Downloads](https://img.shields.io/packagist/dt/sentgine/authzone.svg)](https://packagist.org/packages/sentgine/authzone)

Authzone is a Laravel package designed to provide a simple and user-friendly interface for managing user permissions and roles in a Laravel application. Built on top of the popular Spatie Laravel Permission package, AuthZone aims to simplify the process of implementing user authentication and authorization by providing a set of intuitive UI components that allow users to easily manage their roles and permissions.

## Features

- Simplified user authentication and authorization management.
- Intuitive UI components for managing roles and permissions.
- Built on top of the Spatie Laravel Permission package for flexibility and extensibility.

## Requirements

- Laravel 8.x or higher.
- PHP 8.0 or higher.

## Installation

(1) You can install the package via Composer by running the following command:

```bash
composer require sentgine/authzone
```

The laravel-permission package by Spatie will be included as a dependency.

(2) Then publish the the PermissionServiceProvider by Spatie (See: [Laravel Permission Installation](https://spatie.be/docs/laravel-permission/v5/installation-laravel))
```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

(3) Then run the migration files.
```bash
php artisan migrate
```

(4) Open the App\Models\User.php and add the HasRoles trait from Spatie\Permission\Traits\HasRoles;
```bash
use HasRoles;
```

(5) After that, you can choose 3 GUI's to install (Make sure you're in the root of your Laravel application):
- Authzone default
- Jetstream
- Breeze

If you are using Tailwind CSS, then you will have no problem using Jetstream or Breeze. But if you're using another CSS framework, you're going to have to use the Authzone default.

#### Authzone default:
Running this command will publish all the config file, routes, and all the views. This is great if you want to modify the overall design.

```bash
php artisan authzone:install
```
Or you have to option not to publish the views. Instead, you will just use the existing default design.
```bash
php artisan authzone:install --noviews
```
#### Jetstream:
Running this command will publish all the config file, routes, and all the views related to Jetstream.
```bash
php artisan authzone:install --jetstream
```
or
```bash
php artisan authzone:install --jetstream --noviews
```

Using Jetstream, you will have to go to your Laravel App's root directory and under the /resources/views/navigation-menu.blade.php add this navigation menu @authzoneJetstreamNavMenu and @authzoneJetstreamNavMenuResponsive directive.

```php
@if (Laravel\Jetstream\Jetstream::hasApiFeatures())
    <x-dropdown-link href="{{ route('api-tokens.index') }}">
        {{ __('API Tokens') }}
    </x-dropdown-link>
@endif

@authzoneJetstreamNavMenu

... The rest of the code
```
And the same applies to the navigation menu for the mobile view. Ideally, I would put it under the "Profile" link.
```php
<x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
    {{ __('Profile') }}
</x-responsive-nav-link>

@authzoneJetstreamNavMenuResponsive

... The rest of the code
```

#### Breeze:
Running this command will publish all the config file, routes, and all the views related to Breeze.
```bash
php artisan authzone:install --breeze
```
or
```bash
php artisan authzone:install --breeze --noviews
```

Using Breeze, you will still have to go to your Laravel App's root directory and under the /resources/views/layouts/navigation-menu.blade.php add this navigation menu @authzoneBreezeNavMenu and @authzoneBreezeNavMenuResponsive directive.

```php
<x-dropdown-link :href="route('profile.edit')">
    {{ __('Profile') }}
</x-dropdown-link>   

@authzoneBreezeNavMenu

... The rest of the code
```
And the same applies to the navigation menu for the mobile view. Ideally, I would put it under the "Dashboard" link.
```php
<x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
    {{ __('Dashboard') }}
</x-responsive-nav-link>

@authzoneBreezeNavMenuResponsive

... The rest of the code
```

(6) Open your tailwind.config.js on your Laravel Application's root directory andd this to the "content" key (See: https://laravel.com/docs/10.x/pagination).
```js
'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
```

(7) Optional, but you're gonna probably want to protect some of your routes based on user role. If that's the case, you can visit the [Middleware Section of Laravel Permission](https://spatie.be/docs/laravel-permission/v5/basic-usage/middleware).

## Configuration
The configuration file for AuthZone is located at config/authzone.php. This file allows you to customize various aspects of the package, such as the views, model and route group.

## Changelog
Please see the [CHANGELOG](https://github.com/sentgine/authzone/CHANGELOG.md) file for details on what has changed.

## Security
If you discover any security-related issues, please email sentgine@gmail.com instead of using the issue tracker.

## Credits
Authzone is built and maintained by Adrian Alconera. It is based on the Spatie Laravel Permission package.

## License
The MIT License (MIT). Please see the [LICENSE](https://github.com/sentgine/authzone/LICENSE) file for more information.