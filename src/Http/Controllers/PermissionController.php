<?php

namespace Sentgine\Authzone\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Sentgine\Authzone\Services\SearchService;

class PermissionController extends Controller
{
    private $searchService;

    /**
     * The constructor.
     * 
     * @param SearchService $searchService
     */
    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * Display the list of permissions.
     * 
     * @return View
     */
    public function index(Request $request): View
    {
        // Search for permissions list
        $permissions = $this->searchService->search(request: $request, resource: 'permissions');

        return view(authzone_view_path('permissions.index'), compact('permissions'));
    }

    /**
     * Show the form for creating a new permission.
     * 
     * @return View
     */
    public function create(): View
    {
        return view(authzone_view_path('permissions.create'));
    }

    /**
     * Store a newly created resource in storage.
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

            if ($request->has('isCrud')) {
                $restfulActions = ['create', 'read', 'update', 'delete'];

                // Create the permissions
                foreach ($restfulActions as $action) {
                    Permission::create([
                        'name' => $action . ' ' . $request->name,
                        'guard_name' => $guard_name
                    ]);
                }

                return back()->with('message', "Successfully added CRUD permissions: '$request->name'!");
            } else {
                // Create the permission
                $permission = Permission::create([
                    'name' => $request->name,
                    'guard_name' => $guard_name
                ]);
                return back()->with('message', "Successfully added '$permission->name' with an ID of ($permission->id)!");
            }
        } catch (\Spatie\Permission\Exceptions\PermissionAlreadyExists $e) {

            return back()->with('message', $e->getMessage())->setStatusCode(422);
        }
    }

    /**
     *  Show the form for editing the specified permission.
     * 
     * @param Permission $permission
     * 
     * @return View
     */
    public function edit(Permission $permission): View
    {
        return view(authzone_view_path('permissions.edit'), compact('permission'));
    }

    /**
     * Update the specified permission.
     * 
     * @param Request $request
     * @param Permission $permission
     * 
     * @return RedirectResponse
     */
    public function update(Request $request, Permission $permission): RedirectResponse
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
        ]);

        // If guard web is empty, just set the default to 'web'
        $guard_name = $request->filled('guard_name') ? $request->guard_name : 'web';

        // Update
        $permission->update([
            'name' => $request->name,
            'guard_name' => $guard_name
        ]);

        return redirect()->route('permissions.index')->with('message', 'Permission updated successfully');
    }

    /**
     * Remove the specified permission.
     * 
     * @param Permission $permission
     * 
     * @return RedirectResponse
     */
    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();
        return back()->with('message', 'Permission deleted successfully.');
    }
}
