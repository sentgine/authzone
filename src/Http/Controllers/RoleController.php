<?php

namespace Sentgine\Authzone\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Sentgine\Authzone\Services\SearchService;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    private $searchService;
    private $role;

    /**
     * The constructor.
     * 
     * @param SearchService $searchService
     * @param Role $role
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
        // Search for roles list
        $roles = $this->searchService->search(request: $request, resource: 'roles');

        return view(authzone_view_path('roles.index'), compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     */
    public function create(): View
    {
        return view(authzone_view_path('roles.create'));
    }

    /**
     * Store a newly created role.
     * 
     * @param Request $request
     * 
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            // Validate the request
            $request->validate([
                'name' => 'required'
            ]);

            // If guard web is empty, just set the default to 'web'
            $guard_name = $request->filled('guard_name') ? $request->guard_name : 'web';

            // Create the role
            $role = $this->role->create([
                'name' => $request->name,
                'guard_name' => $guard_name
            ]);

            return back()->with('message', "Successfully added '$role->name' with an ID of ($role->id)!");
        } catch (\Spatie\Permission\Exceptions\RoleAlreadyExists $e) {

            return back()->with('message', $e->getMessage())->setStatusCode(422);
        }
    }

    /**
     * Show the form for editing the specified role.
     * 
     * @param Role $role
     * 
     * @return View
     */
    public function edit(Role $role): View
    {
        return view(authzone_view_path('roles.edit'), compact('role'));
    }

    /**
     * Update the specified role.
     * 
     * @param Request $request
     * @param Role $role
     * 
     * @return RedirectResponse
     */
    public function update(Request $request, Role $role): RedirectResponse
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
        ]);

        // If guard web is empty, just set the default to 'web'
        $guardName = $request->filled('guard_name') ? $request->guard_name : 'web';

        // Update
        $role->update([
            'name' => $request->name,
            'guard_name' => $guardName
        ]);

        return redirect()->route('roles.index')->with('message', 'Role updated successfully');
    }

    /**
     * Remove the specified role.
     * 
     * @param Role $role
     * 
     * @return RedirectResponse
     */
    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();
        return back()->with('message', 'Role deleted successfully.');
    }
}
