<?php

namespace Sentgine\Authzone\Tests\Unit;

class CheckIfServicesExistTest extends BaseClassUnitTest
{
    private $namespace = 'Sentgine\Authzone\Services';

    /**
     * Test if permission search service class exists.
     * 
     * @return void
     */
    public function test_permission_search_service_class_exists(): void
    {
        $this->is_class_exists($this->namespace . '\PermissionSearchService');
    }

    /**
     * Test if role search service class exists.
     * 
     * @return void
     */
    public function test_role_search_service_class_exists(): void
    {
        $this->is_class_exists($this->namespace . '\RoleSearchService');
    }

    /**
     * Test if role with permissions search service class exists.
     * 
     * @return void
     */
    public function test_roles_with_permissions_search_service_class_exists(): void
    {
        $this->is_class_exists($this->namespace . '\RolesWithPermissionsSearchService');
    }

    /**
     * Test if search service class exists.
     * 
     * @return void
     */
    public function test_search_service_class_exists(): void
    {
        $this->is_class_exists($this->namespace . '\SearchService');
    }

    /**
     * Test if user search service class exists.
     * 
     * @return void
     */
    public function test_user_search_service_class_exists(): void
    {
        $this->is_class_exists($this->namespace . '\UserSearchService');
    }
}
