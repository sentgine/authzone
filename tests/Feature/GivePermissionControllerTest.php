<?php

namespace Sentgine\Authzone\Tests\Feature;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Sentgine\Authzone\Services\SearchService;
use Tests\TestCase;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Sentgine\Authzone\Http\Controllers\GivePermissionController;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GivePermissionControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $connection = 'testing';

    /**
     * Returns the instance of the GivePermissionController
     * 
     * @return GivePermissionController
     */
    private function instanceOfController(): GivePermissionController
    {
        // Pass the search service class as a new instance
        $searchService = new SearchService();
        $role = new Role();
        $permission = new Permission();

        // Instantiate controller
        return new GivePermissionController($searchService, $role, $permission);
    }

    /**
     * Check if status is 200.
     * 
     * @return void
     */
    public function test_index_status_200(): void
    {
        $response = $this->get(authzone_url('give-permissions'));
        $response->assertStatus(200);
    }

    /**
     * Check if index has roles with permissions list.
     * 
     * @return void
     */
    public function test_index_has_roles_with_permissions_list(): void
    {
        // Instance of the PermissionController
        $controller = $this->instanceOfController();

        // Create a mock instance of Request
        $request = new Request();

        // Run the index method
        $response = $controller->index($request);

        // Assert that the response is an instance of View
        $this->assertInstanceOf(View::class, $response);

        // Assert that the response is an instance of LengthAwarePaginator with the values permissions, roles, rolesWithPermissions
        $this->assertInstanceOf(Collection::class, $response->getData()['permissions']);
        $this->assertInstanceOf(Collection::class, $response->getData()['roles']);
        $this->assertInstanceOf(LengthAwarePaginator::class, $response->getData()['rolesWithPermissions']);
    }

    /**
     * Return status 302 when there is existing role and permission.
     * 
     * @return void
     */
    public function test_store_returns_status_302_when_there_is_existing_role_and_permission(): void
    {
        // Create a new role.
        $role = Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        // Create a new permission.
        $permission = Permission::create([
            'name' => 'can edit post',
            'guard_name' => 'web'
        ]);

        // Create a dummy request
        $request = new Request();
        $request->replace([
            'role' => $role->name,
            'permissions' => $permission->name
        ]);

        // Instance of the GivePermissionController
        $controller = $this->instanceOfController();

        // Run the store function
        $response = $controller->store($request);

        // Assert that the response is an instance of RedirectResponse
        $this->assertInstanceOf(RedirectResponse::class, $response);

        // Assert that the response has a 302 status code (redirect)
        $this->assertEquals(302, $response->getStatusCode());

        // Assert that the message is not empty
        $this->assertNotEmpty(Session::get('message'));
    }

    /**
     * Return status 302 when the isAll option is selected.
     * 
     * @return void
     */
    public function test_store_returns_status_302_when_the_is_all_option_is_selected(): void
    {
        // Create a new role.
        $role = Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        // Create dummy permissions
        $permissionList = [
            'create post',
            'read post',
            'update post',
            'delete post'
        ];

        // Save permissions to the datbabase
        foreach ($permissionList as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        // Create a dummy request
        $request = new Request();
        $request->replace([
            'role' => $role->name,
            'isAll' => true,
        ]);

        // Instance of the GivePermissionController
        $controller = $this->instanceOfController();

        // Run the store function
        $response = $controller->store($request);

        // Assert that the response is an instance of RedirectResponse
        $this->assertInstanceOf(RedirectResponse::class, $response);

        // Assert that the response has a 302 status code (redirect)
        $this->assertEquals(302, $response->getStatusCode());

        // Assert that the message is not empty
        $this->assertNotEmpty(Session::get('message'));
    }

    /**
     * Test revoke all permissions returns status 302.
     * 
     * @return void
     */
    public function test_revoke_all_permissions_returns_status_302(): void
    {
        // Instance of the GivePermissionController
        $controller = $this->instanceOfController();

        // Create a new role.
        $role = Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        // Run the revoke permissions function
        $response = $controller->revokePermissions($role);

        // Assert that the response is a RedirectResponse
        $this->assertInstanceOf(RedirectResponse::class, $response);

        // Assert that the response has a 302 status code (redirect)
        $this->assertEquals(302, $response->getStatusCode());
    }

    /**
     * Test revoke single permission from a role returns status 302.
     * 
     * @return void
     */
    public function test_revoke_single_permission_from_a_role_returns_status_302(): void
    {
        // Instance of the GivePermissionController
        $controller = $this->instanceOfController();

        // Create a new role.
        $role = Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        // Create a new permission.
        $permission = Permission::create([
            'name' => 'can edit post',
            'guard_name' => 'web'
        ]);

        // Find the role and permission
        $findRole = Role::findById($role->id);
        $findPermission = Permission::findById($permission->id);

        // Give permission to the role
        $findRole->givePermissionTo($findPermission);

        // Run the remove permission function
        $response = $controller->removePermission($findPermission, $findRole);

        // Assert that the response is a RedirectResponse
        $this->assertInstanceOf(RedirectResponse::class, $response);

        // Assert that the response has a 302 status code (redirect)
        $this->assertEquals(302, $response->getStatusCode());
    }
}
