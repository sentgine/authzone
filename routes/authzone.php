<?php

use Illuminate\Support\Facades\Route;
use Sentgine\Authzone\Http\Controllers\AssignRolesController;
use Sentgine\Authzone\Http\Controllers\AuthzoneController;
use Sentgine\Authzone\Http\Controllers\GivePermissionsController;
use Sentgine\Authzone\Http\Controllers\PermissionsController;
use Sentgine\Authzone\Http\Controllers\RolesController;

Route::group(['prefix' => config('authzone.route_group'), 'middleware' => ['web']], function () {

    // Remove permission from a role
    Route::delete('remove-permission/{permission}/{role}', [GivePermissionsController::class, 'removePermission'])->name('give-permissions.removePermission');

    // Revoke permissions from a role
    Route::delete('revoke-permission/{role}', [GivePermissionsController::class, 'revokePermissions'])->name('give-permissions.revokePermissions');

    // Remove permission from a role
    Route::delete('assign-roles/{userId}/{role}', [AssignRolesController::class, 'removeRole'])->name('assign-roles.removeRole');

    // Assign roles by bulk
    Route::post('assign-roles/bulk', [AssignRolesController::class, 'bulkAssignRole'])->name('assign-roles.bulk');

    // Remove all roles from all users
    Route::post('assign-roles/remove-roles-from-all-users', [AssignRolesController::class, 'removeRolesFromAllUsers'])->name('assign-roles.remove-roles-from-all-users');

    // Assign roles resource
    Route::resource('assign-roles', AssignRolesController::class);

    // Give permissions resource
    Route::resource('give-permissions', GivePermissionsController::class)->except(['destroy', 'show', 'update', 'edit', 'create']);

    // Permissions resource
    Route::resource('permissions', PermissionsController::class)->except(['show']);

    // Roles resource 
    Route::resource('roles', RolesController::class)->except(['show']);

    // Index
    Route::get('/', [AuthzoneController::class, 'index'])->name('authzone');
});
