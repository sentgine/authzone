<?php

namespace Sentgine\Authzone\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Sentgine\Authzone\Services\SearchService;
use Spatie\Permission\Models\Role;

class AssignRoleController extends Controller
{
    private $searchService;
    private $role;

    /**
     * The constructor.
     * 
     * @param SearchService $searchService
     */
    public function __construct(SearchService $searchService, Role $role)
    {
        $this->searchService = $searchService;
        $this->role = $role;
    }

    /**
     * Display a listing of the roles.
     * 
     * @return View
     */
    public function index(Request $request): View
    {
        // Search the users
        $users = $this->searchService->search(request: $request, resource: 'assign-roles');

        // Get all roles
        $roles = $this->role->all();

        return view(authzone_view_path('assign-roles.index'), compact('users', 'roles'));
    }
  /**
   * Assign roles to the user.
   * 
   * @param int|string $userId
   * 
   * @return View
   */
    public function edit(int|string $userId): View
    {
        // Find the specific user by id
        $user = authzone_user_model()->find($userId);

        // Get all roles
        $roles = $this->role->all();

        // Get all roles assigned to this user
        $userRoles = $user->roles->pluck('name')->toArray();

        return view(authzone_view_path('assign-roles.edit'), compact('user', 'roles', 'userRoles'));
    }

  /**
   * Update the specified role.
   * 
   * @param Request $request
   * @param int|string $userId
   * 
   * @return RedirectResponse
   */
    public function update(Request $request, int|string $userId): RedirectResponse
    {
        // Find the specific user
        $user = authzone_user_model()::find($userId);

        // Validate the request
        $request->validate([
            'rolesWithPermissions' => !$request->has('isAll') ? 'required' : '',
        ]);

        if ($request->has('isAll')) { // Give all roles to a specific user
            $roles = $this->role->all();
            $user->syncRoles($roles);
        } else { // Give roles to the user based on a what was selected
            $user->syncRoles($request->rolesWithPermissions);
        }

        return back()->with('message', "Assigned a role(s) to $user->email.");
    }

  /**
   * Remove role from the user.
   * 
   * @param int|string $userId
   * @param Role $role
   * 
   * @return RedirectResponse
   */
    public function removeRole(int|string $userId, Role $role): RedirectResponse
    {
        authzone_user_model()->find($userId)->removeRole($role->name);
        return back();
    }

    /**
     * Bulk assign roles to users.
     * 
     * @param Request $request
     * 
     * @return RedirectResponse
     */
    public function bulkAssignRole(Request $request): RedirectResponse
    {
        // Validate the request
        $request->validate([
            'role' => 'required',
        ]);

        // Get all users;
        $user = authzone_user_model()::all();

        // Assign this role to all users
        foreach ($user as $user) {
            $user->assignRole($request->role);
        }

        return back()->with('message', "Bulk assigned a role(s) to all users.");
    }

    /**
     * Remove roles from all users.
     * 
     * @return RedirectResponse
     */
    public function removeRolesFromAllUsers(): RedirectResponse
    {
        // Get all users
        $users = authzone_user_model()::all();

        // Loop through all the users
        foreach ($users as $user) {
            $user->roles()->detach();
        }

        return back()->with('message', "Removed all roles from all users.");
    }
}
