<?php

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery\MockInterface;
use Sentgine\Authzone\Services\SearchService;
use Sentgine\Authzone\Tests\Unit\BaseClassUnitTest;

class SearchServiceTest extends BaseClassUnitTest
{
    /**
     * Test the search for the permissions page.
     * 
     * @return void
     */
    public function test_permissions_search_is_working_as_expected(): void
    {
        $request = $this->mock(Request::class, function (MockInterface $mock) {
            $mock->shouldReceive('has')->with('search')->andReturn(true);
            $mock->shouldReceive('input')->with('search')->andReturn('can edit');
        });

        $searchService = new SearchService();
        $permissionSearchService = $searchService->createSearch($request, 'permissions', 'search', 10);

        $results = $permissionSearchService->search();

        $this->assertInstanceOf(LengthAwarePaginator::class, $results);
    }

    /**
     * Test the search for the roles page.
     * 
     * @return void
     */
    public function test_roles_search_is_working_as_expected(): void
    {
        $request = $this->mock(Request::class, function (MockInterface $mock) {
            $mock->shouldReceive('has')->with('search')->andReturn(true);
            $mock->shouldReceive('input')->with('search')->andReturn('admin');
        });

        $searchService = new SearchService();
        $permissionSearchService = $searchService->createSearch($request, 'roles', 'search', 10);

        $results = $permissionSearchService->search();

        $this->assertInstanceOf(LengthAwarePaginator::class, $results);
    }

    /**
     * Test the search for the give permissions page.
     * 
     * @return void
     */
    public function test_give_permissions_search_is_working_as_expected(): void
    {
        $request = $this->mock(Request::class, function (MockInterface $mock) {
            $mock->shouldReceive('has')->with('search')->andReturn(true);
            $mock->shouldReceive('input')->with('search')->andReturn('admin');
        });

        $searchService = new SearchService();
        $permissionSearchService = $searchService->createSearch($request, 'give-permissions', 'search', 10);

        $results = $permissionSearchService->search();

        $this->assertInstanceOf(LengthAwarePaginator::class, $results);
    }

    /**
     * Test the search for the assign roles page.
     * 
     * @return void
     */
    public function test_assign_roles_search_is_working_as_expected(): void
    {
        $request = $this->mock(Request::class, function (MockInterface $mock) {
            $mock->shouldReceive('has')->with('search')->andReturn(true);
            $mock->shouldReceive('input')->with('search')->andReturn('admin');
        });

        $searchService = new SearchService();
        $permissionSearchService = $searchService->createSearch($request, 'assign-roles', 'search', 10);

        $results = $permissionSearchService->search();

        $this->assertInstanceOf(LengthAwarePaginator::class, $results);
    }
}
