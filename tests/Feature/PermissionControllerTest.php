<?php

namespace Sentgine\Authzone\Tests\Feature;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Sentgine\Authzone\Services\SearchService;
use Tests\TestCase;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Sentgine\Authzone\Http\Controllers\PermissionController;
use Spatie\Permission\Models\Permission;

class PermissionControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $connection = 'testing';

    /**
     * Returns the instance of the PermissionController
     * 
     * @return PermissionController
     */
    private function instanceOfController(): PermissionController
    {
        // Pass the search service class as a new instance
        $searchService = new SearchService();

        // Instantiate controller
        return new PermissionController($searchService);
    }

    /**
     * Check if status is 200.
     * 
     * @return void
     */
    public function test_index_status_200(): void
    {
        $response = $this->get(authzone_url('permissions'));
        $response->assertStatus(200);
    }

    /**
     * Check if index has permission list.
     * 
     * @return void
     */
    public function test_index_has_permissions_list(): void
    {
        // Instance of the PermissionController
        $controller = $this->instanceOfController();

        // Create a mock instance of Request
        $request = new Request();

        // Run the index method
        $response = $controller->index($request);

        // Assert that the response is an instance of View
        $this->assertInstanceOf(View::class, $response);

        // Assert that the response is an instance of LengthAwarePaginator
        $this->assertInstanceOf(LengthAwarePaginator::class, $response->getData()['permissions']);
    }

    /**
     * Check if the create function returns view.
     * 
     * @return void
     */
    public function test_create_returns_view(): void
    {
        // Instance of the PermissionController
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
    public function test_store_returns_status_302_when_there_is_no_duplicate_permission(): void
    {
        // Create a dummy request
        $request = new Request();
        $request->replace([
            'name' => 'can edit post',
            'guard_name' => 'web',
        ]);

        // Instance of the PermissionController
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
     * Return status 302 when there is no duplicate.
     * 
     * @return void
     */
    public function test_store_returns_status_302_for_storing_crud_permissions(): void
    {
        // Create a dummy request
        $request = new Request();
        $request->replace([
            'isCrud' => true,
            'name' => 'post',
            'guard_name' => 'web',
        ]);

        // Instance of the permission controller
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
    public function test_store_returns_422_when_there_is_a_duplicate_permission(): void
    {
        // Create a dummy request
        $request = new Request();
        $request->replace([
            'name' => 'can edit post',
            'guard_name' => 'web',
        ]);

        // Instance of the PermissionController
        $controller = $this->instanceOfController();

        // Run the store function first to save the permission to the database.
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
        // Instance of the PermissionController
        $controller = $this->instanceOfController();

        // Create a new permission.
        $permission = Permission::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        // Run the controller
        $response = $controller->edit($permission);

        // Assert that the response is an instance of View
        $this->assertInstanceOf(View::class, $response);
    }

    /**
     * Check if update permission returns status 302.
     * 
     * @return void
     */
    public function test_update_permission_returns_status_302(): void
    {
        // Instance of the PermissionController
        $controller = $this->instanceOfController();

        // Create a dummy request
        $request = new Request();
        $request->replace([
            'name' => 'can edit post',
            'guard_name' => 'web',
        ]);

        // Create a new permission
        $permission = Permission::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        // Run the update function
        $response = $controller->update($request, $permission);

        // Assert that the response is a RedirectResponse
        $this->assertInstanceOf(RedirectResponse::class, $response);

        // Assert that the response has a 302 status code (redirect)
        $this->assertEquals(302, $response->getStatusCode());

        // Assert that the message is not empty
        $this->assertNotEmpty(Session::get('message'));
    }

    /**
     * Test delete permission returns status 302.
     * 
     * @return void
     */
    public function test_delete_permission_returns_status_302(): void
    {
        // Instance of the PermissionController
        $controller = $this->instanceOfController();

        // Create a new permission
        $permission = Permission::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        // Run the destroy function
        $response = $controller->destroy($permission);

        // Assert that the response is a RedirectResponse
        $this->assertInstanceOf(RedirectResponse::class, $response);

        // Assert that the response has a 302 status code (redirect)
        $this->assertEquals(302, $response->getStatusCode());
    }
}
