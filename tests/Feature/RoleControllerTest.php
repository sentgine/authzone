<?php

namespace Sentgine\Authzone\Tests\Feature;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Sentgine\Authzone\Http\Controllers\RoleController;
use Sentgine\Authzone\Services\SearchService;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class RoleControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $connection = 'testing';

    /**
     * Returns the instance of the RoleController
     * 
     * @return RoleController
     */
    private function instanceOfController(): RoleController
    {
        // Pass the search service class and the new role as new instances
        $searchService = new SearchService();
        $role = new Role();

        // Instantiate controller
        return new RoleController($searchService, $role);
    }

    /**
     * Check if status is 200.
     * 
     * @return void
     */
    public function test_index_status_200(): void
    {
        $response = $this->get(authzone_url('roles'));
        $response->assertStatus(200);
    }

    /**
     * Check if index has role list.
     * 
     * @return void
     */
    public function test_index_has_roles_list(): void
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
        $this->assertInstanceOf(LengthAwarePaginator::class, $response->getData()['roles']);
    }

    /**
     * Check if the create function returns view.
     * 
     * @return void
     */
    public function test_create_returns_view(): void
    {
        // Instance of the RoleController
        $controller = $this->instanceOfController();

        // Run the create method
        $response = $controller->create();

        // Assert that the response is an instance of View
        $this->assertInstanceOf(View::class, $response);
    }

    /**
     * Return status 302 when there is no duplicate.
     * 
     * @return void
     */
    public function test_store_returns_status_302_when_there_is_no_duplicate_role(): void
    {
        // Create a dummy request
        $request = new Request();
        $request->replace([
            'name' => 'Test Role',
            'guard_name' => 'web',
        ]);

        // Instance of the roles controller
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
     * Returns 422 when there is a duplicate.
     * 
     * @return void
     */
    public function test_store_returns_422_when_there_is_a_duplicate_role(): void
    {
        // Create a dummy request
        $request = new Request();
        $request->replace([
            'name' => 'Test Role',
            'guard_name' => 'web',
        ]);

        // Instance of the roles controller
        $controller = $this->instanceOfController();

        // Run the store function first to save the role to the database.
        $controller->store($request);

        // Then run it again
        $response = $controller->store($request);

        // Assert that the response is an instance of RedirectResponse
        $this->assertInstanceOf(RedirectResponse::class, $response);

        // Assert that the response has a 302 status code (redirect)
        $this->assertEquals(422, $response->getStatusCode());

        // Assert that the message is not empty
        $this->assertNotEmpty(Session::get('message'));
    }

    /**
     * Check if the edit function returns view.
     * 
     * @return void
     */
    public function test_edit_returns_view(): void
    {
        // Instance of the RoleController
        $controller = $this->instanceOfController();

        // Create a new role.
        $role = Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        // Run the controller
        $response = $controller->edit($role);

        // Assert that the response is an instance of View
        $this->assertInstanceOf(View::class, $response);
    }

    /**
     * Check if update role returns status 302.
     * 
     * @return void
     */
    public function test_update_role_returns_status_302(): void
    {
        // Instance of the RoleController
        $controller = $this->instanceOfController();

        // Create a dummy request
        $request = new Request();
        $request->replace([
            'name' => 'Test Role',
            'guard_name' => 'web',
        ]);

        // Create a new role
        $role = Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        // Run the update function
        $response = $controller->update($request, $role);

        // Assert that the response is a RedirectResponse
        $this->assertInstanceOf(RedirectResponse::class, $response);

        // Assert that the response has a 302 status code (redirect)
        $this->assertEquals(302, $response->getStatusCode());

        // Assert that the message is not empty
        $this->assertNotEmpty(Session::get('message'));
    }

    /**
     * Test delete role returns status 302.
     * 
     * @return void
     */
    public function test_delete_role_returns_status_302(): void
    {
        // Instance of the RoleController
        $controller = $this->instanceOfController();

        // Create a new role
        $role = Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        // Run the destroy function
        $response = $controller->destroy($role);

        // Assert that the response is a RedirectResponse
        $this->assertInstanceOf(RedirectResponse::class, $response);

        // Assert that the response has a 302 status code (redirect)
        $this->assertEquals(302, $response->getStatusCode());
    }
}
