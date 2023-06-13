<?php

namespace Sentgine\Authzone\Services;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use InvalidArgumentException;
use Sentgine\Authzone\Services\PermissionSearchService;
use Sentgine\Authzone\Services\RoleSearchService;
use Sentgine\Authzone\Services\UserSearchService;
use Sentgine\Authzone\Services\RolesWithPermissionsSearchService;

use function PHPUnit\Framework\isNull;

class SearchService
{
    private $searchableServices;

    /**
     * The constructor.
     * 
     * @param array|null $searchableServices
     */
    public function __construct(array $searchableServices = null)
    {
        $this->searchableServices = $searchableServices ?? app('searchable.services');
    }

    /**
     * Creates the instance of the search factories.
     * 
     * @param Request $request
     * @param string $resource
     * @param string $inputName
     * @param int $perPage
     * 
     * @return UserSearchService|PermissionSearchService|RoleSearchService|RolesWithPermissionsSearchService
     * 
     * @throws InvalidArgumentException
     */
    public function createSearch(Request $request, string $resource, string $inputName = 'search', int $perPage = 10): UserSearchService|PermissionSearchService|RoleSearchService|RolesWithPermissionsSearchService
    {
        // Throw an exception if the class doesn't exist.
        if (!isset($this->searchableServices[$resource])) {
            throw new InvalidArgumentException("Invalid resource provided: $resource");
        }

        $serviceClass = $this->searchableServices[$resource];
        return new $serviceClass($request, $inputName, $perPage);
    }

    /**
     * Search and return the paginated data.
     * 
     * @param Request $request
     * @param string $resource
     * @param string $inputName
     * @param int $perPage
     * 
     * @return LengthAwarePaginator
     */
    public function search(Request $request, string $resource, string $inputName = 'search', int $perPage = 10): LengthAwarePaginator
    {
        // Initialize the search
        $searchFactory = $this->createSearch(request: $request, resource: $resource, inputName: $inputName, perPage: $perPage);

        return $searchFactory->search();
    }
}
