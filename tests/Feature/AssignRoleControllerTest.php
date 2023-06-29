<?php

namespace Sentgine\Authzone\Tests\Feature;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Sentgine\Authzone\Services\SearchService;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Sentgine\Authzone\Http\Controllers\AssignRoleController;
use Spatie\Permission\Models\Permission;

class AssignRoleControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $connection = 'testing';

    /**
     * Returns the instance of the AssignRoleController
     * 
     * @return AssignRoleController
     */
    private function instanceOfController(): AssignRoleController
    {
        // Pass the search service class and the new role as new instances
        $searchService = new SearchService();
        $role = new Role();

        // Instantiate controller
        return new AssignRoleController($searchService, $role);
    }

    /**
     * Check if status is 200.
     * 
     * @return void
     */
    public function test_index_status_200(): void
    {
        $response = $this->get(authzone_url('assign-roles'));
        $response->assertStatus(200);
    }

    /**
     * Check if index has role and user list.
     * 
     * @return void
     */
    public function test_index_has_roles_and_users_list(): void
    {
        // Instance of the RoleController
        $controller = $this->instanceOfController();

        // Create a mock instance of Request
        $request = new Request();

        // Run the index method
        $response = $controller->index($request);

        // Assert that the response is an instance of View
        $this->assertInstanceOf(View::class, $response);

        // Assert that the response is an instance of LengthAwarePaginator
        $this->assertInstanceOf(Collection::class, $response->getData()['roles']);
        $this->assertInstanceOf(LengthAwarePaginator::class, $response->getData()['users']);
    }

    /**
     * Check if the create function returns view.
     * 
     * @return void
     */
    public function test_edit_returns_view(): void
    {
        // Instance of the RoleController
        $controller = $this->instanceOfController();

        // Create a user
        $user = \App\Models\User::factory()->create();

        // Run the create method
        $response = $controller->edit($user->id);

        // Assert that the response is an instance of View
        $this->assertInstanceOf(View::class, $response);
    }

    /**
     * Check if update role returns status 302.
     * 
     * @return void
     */
    public function test_update_assign_roles_to_the_user_returns_status_302(): void
    {
        // Instance of the RoleController
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
        $roleWithPermission = $findRole->givePermissionTo($findPermission);

        // Create a dummy user
        $newUser = \App\Models\User::factory()->create();

        // Get the user
        $user = authzone_user_model()->find($newUser->id);

        // Create a dummy request
        $request = new Request();
        $request->replace([
            'rolesWithPermissions' => $roleWithPermission,
        ]);

        // Run the assign role function
        $response = $controller->update($request, $user->id);

        // Assert that the response is a RedirectResponse
        $this->assertInstanceOf(RedirectResponse::class, $response);

        // Assert that the response has a 302 status code (redirect)
        $this->assertEquals(302, $response->getStatusCode());

        // Assert that the message is not empty
        $this->assertNotEmpty(Session::get('message'));
    }

    /**
     * Check if remove role returns status 302.
     * 
     * @return void
     */
    public function test_remove_role_from_the_user_returns_status_302(): void
    {
        // Instance of the RoleController
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
        $roleWithPermission = $findRole->givePermissionTo($findPermission);

        // Create a dummy user
        $newUser = \App\Models\User::factory()->create();

        // Get the user
        $user = authzone_user_model()->find($newUser->id);

        // Create a dummy request
        $request = new Request();
        $request->replace([
            'rolesWithPermissions' => $roleWithPermission,
        ]);

        // Assign a role to the user
        $controller->update($request, $user->id);

        // Run the remove role function
        $response = $controller->removeRole($user->id, $findRole);

        // Assert that the response is a RedirectResponse
        $this->assertInstanceOf(RedirectResponse::class, $response);

        // Assert that the response has a 302 status code (redirect)
        $this->assertEquals(302, $response->getStatusCode());

        // Assert that the message is not empty
        $this->assertNotEmpty(Session::get('message'));
    }

    /**
     * Check if bulk assign a role to a user returns status 302.
     * 
     * @return void
     */
    public function test_bulk_assign_a_role_to_a_user_returns_status_302(): void
    {
        // Instance of the RoleController
        $controller = $this->instanceOfController();

        // Create a new role.
        $role = Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        // Create a dummy request
        $request = new Request();
        $request->replace([
            'role' => $role->name,
        ]);

        // Run the remove role function
        $response = $controller->bulkAssignRole($request);

        // Assert that the response is a RedirectResponse
        $this->assertInstanceOf(RedirectResponse::class, $response);

        // Assert that the response has a 302 status code (redirect)
        $this->assertEquals(302, $response->getStatusCode());

        // Assert that the message is not empty
        $this->assertNotEmpty(Session::get('message'));
    }

    /**
     * Check if remove roles from all users returns status 302.
     * 
     * @return void
     */
    public function test_remove_roles_from_all_user_returns_status_302(): void
    {
        // Instance of the RoleController
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

        // Create a dummy user
        $newUser = \App\Models\User::factory()->create();

        // Get the user
        authzone_user_model()->find($newUser->id);

        // Run the remove role function
        $response = $controller->removeRolesFromAllUsers();

        // Assert that the response is a RedirectResponse
        $this->assertInstanceOf(RedirectResponse::class, $response);

        // Assert that the response has a 302 status code (redirect)
        $this->assertEquals(302, $response->getStatusCode());

        // Assert that the message is not empty
        $this->assertNotEmpty(Session::get('message'));
    }
}
