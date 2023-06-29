<?php

use Illuminate\Support\Facades\Route;
use Sentgine\Authzone\Http\Controllers\AssignRoleController;
use Sentgine\Authzone\Http\Controllers\AuthzoneController;
use Sentgine\Authzone\Http\Controllers\GivePermissionController;
use Sentgine\Authzone\Http\Controllers\PermissionController;
use Sentgine\Authzone\Http\Controllers\RoleController;

Route::group(['prefix' => config('authzone.route_group'), 'middleware' => ['web']], function () {

    // Remove permission from a role
    Route::delete('remove-permission/{permission}/{role}', [GivePermissionController::class, 'removePermission'])->name('give-permissions.removePermission');

    // Revoke permissions from a role
    Route::delete('revoke-permission/{role}', [GivePermissionController::class, 'revokePermissions'])->name('give-permissions.revokePermissions');

    // Remove permission from a role
    Route::delete('assign-roles/{userId}/{role}', [AssignRoleController::class, 'removeRole'])->name('assign-roles.removeRole');

    // Assign roles by bulk
    Route::post('assign-roles/bulk', [AssignRoleController::class, 'bulkAssignRole'])->name('assign-roles.bulk');

    // Remove all roles from all users
    Route::post('assign-roles/remove-roles-from-all-users', [AssignRoleController::class, 'removeRolesFromAllUsers'])->name('assign-roles.remove-roles-from-all-users');

    // Assign roles resource
    Route::resource('assign-roles', AssignRoleController::class);

    // Give permissions resource
    Route::resource('give-permissions', GivePermissionController::class)->except(['destroy', 'show', 'update', 'edit', 'create']);

    // Permissions resource
    Route::resource('permissions', PermissionController::class)->except(['show']);

    // Roles resource 
    Route::resource('roles', RoleController::class)->except(['show']);

    // Index
    Route::get('/', [AuthzoneController::class, 'index'])->name('authzone');
});
