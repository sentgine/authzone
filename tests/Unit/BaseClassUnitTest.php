<?php

namespace Sentgine\Authzone\Tests\Unit;

use Tests\TestCase;

class BaseClassUnitTest extends TestCase
{
    /**
     * Checks if a class exists.
     * 
     * @param string $className
     * 
     * @return void
     */
    protected function is_class_exists($className = ""): void
    {
        $this->assertTrue(class_exists($className), "Class $className does not exist.");
    }

    /**
     * Check if trait exists.
     * 
     * @param string $traitName
     * 
     * @return void
     */
    protected function is_trait_exists($traitName = ""): void
    {
        $this->assertTrue(trait_exists($traitName), "Trait $traitName does not exist.");
    }
}
