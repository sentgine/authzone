<?php

namespace Sentgine\Authzone\Tests\Unit;

class CheckIfClassesExistTest extends BaseClassUnitTest
{
    /**
     * Test if base class search exists.
     * 
     * @return void
     */
    public function test_base_class_search_exists(): void
    {
        $this->is_class_exists('Sentgine\Authzone\Base\Search');
    }

    /**
     * Test if install command exists.
     * 
     * @return void
     */
    public function test_install_command_exists(): void
    {
        $this->is_class_exists('Sentgine\Authzone\Console\Commands\Install');
    }

    /**
     * Test if after publish listener class exists.
     * 
     * @return void
     */
    public function test_after_publish_listener_class_exists(): void
    {
        $this->is_class_exists('Sentgine\Authzone\Listeners\AfterPublishListener');
    }
}
