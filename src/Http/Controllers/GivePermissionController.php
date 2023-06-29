<?php

namespace Sentgine\Authzone\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Sentgine\Authzone\Services\SearchService;

class GivePermissionController extends Controller
{
    private $searchService;
    private $role;
    private $permission;

    /**
     * The constructor.
     * 
     * @param SearchService $searchService
     */
    public function __construct(SearchService $searchService, Role $role, Permission $permission)
    {
        $this->searchService = $searchService;
        $this->role = $role;
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     * 
     * @return View
     */
    public function index(Request $request): View
    {
        $roles = $this->role->all(); // Get all roles
        $permissions = $this->permission->all(); // Get all permissions 

        // Search the roles with permissions list
        $rolesWithPermissions = $this->searchService->search(request: $request, resource: 'give-permissions', perPage: 5);

        return view(authzone_view_path('give-permissions.index'), compact('roles', 'permissions', 'rolesWithPermissions'));
    }

    /**
     * Give permission(s) to as specific role.
     * 
     * @param Request $request
     * 
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the request
        $request->validate([
            'role' => 'required',
            'permissions' => $request->has('isAll') ? 'nullable|array' : 'required',
        ]);

        // Find the role
        $role = $this->role->findByName($request->role);

        if ($request->has('isAll')) { // Give all permissions to a specific role
            $permissions = $this->permission->all();
            $role->syncPermissions($permissions);
        } else { // Give permissions based on a what was selected
            $role->givePermissionTo($request->permissions);
        }

        return back()->with('message', "Successfully gave permissions to '$role->name' role.");
    }

    /**
     * Revoke permissions from a role.
     * 
     * @param Permission $permission
     * @param Role $role
     * 
     * @return RedirectResponse
     */
    public function revokePermissions(Role $role): RedirectResponse
    {
        // Revoke all permissions from a role
        $role->syncPermissions([]);

        return back()->with('message', "Successfully revoked all permissions from ($role->name) role!");
    }

    /**
     * Remove permission from a role.
     * 
     * @param Permission $permission
     * @param Role $role
     * 
     * @return RedirectResponse
     */
    public function removePermission(Permission $permission, Role $role): RedirectResponse
    {
        // Remove permission from a role
        $permission->removeRole($role);
        return back();
    }
}
