<?php

namespace Sentgine\Authzone\Tests\Unit;

class CheckIfTraitsExistTest extends BaseClassUnitTest
{
    private $namespace = 'Sentgine\Authzone\Traits';

    /**
     * Test if file trait exists.
     * 
     * @return void
     */
    public function test_file_traits_exists(): void
    {
        $this->is_trait_exists($this->namespace . '\File');
    }
}
