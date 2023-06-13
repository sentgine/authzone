<?php

namespace Sentgine\Authzone\Listeners;

use Illuminate\Foundation\Events\VendorTagPublished;
use Sentgine\Authzone\Traits\File;

class AfterPublishListener
{
    use File;

    /**
     * Handle the event.
     */
    public function handle(VendorTagPublished $event): void
    {
        $authzoneTags = [
            'authzone-default',
            'authzone-jetstream',
            'authzone-breeze',
            'authzone-no-views',
            'authzone-no-views-jetstream',
            'authzone-no-views-breeze'
        ];

        // Only run when the tags are one in the list above
        if (in_array($event->tag, $authzoneTags)) {
            $this->appendRouteToWebRoute();
        }
    }

    /**
     * Append the code to the app's web route.php file.
     * 
     * @return void
     */
    protected function appendRouteToWebRoute(): void
    {
        $code = "require __DIR__ . '/authzone.php';";
        $this->appendToFile(base_path('routes/web.php'), $code);
    }
}
