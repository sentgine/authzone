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

(4) Open the App\Models\User.php and add the HasRoles trait.
```bash
use HasRoles;
```

(5) After that, you can choose 3 GUI's to install (Make sure you're in the root of your Laravel package):
- Authzone default
- Jetstream
- Breeze

#### Authzone default:
```bash
php artisan authzone:install
```
or
```bash
php artisan authzone:install --noviews
```
#### Jetstream:
```bash
php artisan authzone:install --jetstream
```
or
```bash
php artisan authzone:install --jetstream --noviews
```
#### Breeze:
```bash
php artisan authzone:install --breeze
```
or
```bash
php artisan authzone:install --breeze --noviews
```

(6) Open your tailwind.config.js on your Laravel Application's root directory andd this to the "content" key (See: https://laravel.com/docs/10.x/pagination).
```js
'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
```

(7) Open the App\Models\User.php and add the HasRoles trait from Spatie\Permission\Traits\HasRoles;
```bash
use HasRoles;
```

(8) Optional, but you're gonna probably want to protect some of your rotes based on user role. If that's the case, you can visit the [Middleware Section of Laravel Permission](https://spatie.be/docs/laravel-permission/v5/basic-usage/middleware).

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