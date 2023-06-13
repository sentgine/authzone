<?php

namespace Sentgine\Authzone\Tests\Unit;

class CheckIfControllersExistTest extends BaseClassUnitTest
{
    private $namespace = 'Sentgine\Authzone\Http\Controllers';

    /**
     * Test if roles controller exists.
     * 
     * @return void
     */
    public function test_roles_controller_exists(): void
    {
        $this->is_class_exists($this->namespace . '\RolesController');
    }

    /**
     * Test if permissions controller exists.
     * 
     * @return void
     */
    public function test_permissions_controller_exists(): void
    {
        $this->is_class_exists($this->namespace . '\PermissionsController');
    }

    /**
     * Test if give permissions controller exists.
     * 
     * @return void
     */
    public function test_give_permissions_controller_exists(): void
    {
        $this->is_class_exists($this->namespace . '\GivePermissionsController');
    }

    /**
     * Test if assign roles controller exists.
     * 
     * @return void
     */
    public function test_assign_roles_controller_exists(): void
    {
        $this->is_class_exists($this->namespace . '\AssignRolesController');
    }

    /**
     * Test if authzone controller exists.
     * 
     * @return void
     */
    public function test_authzone_controller_exists(): void
    {
        $this->is_class_exists($this->namespace . '\AuthzoneController');
    }
}
