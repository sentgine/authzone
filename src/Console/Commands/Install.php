<?php

namespace Sentgine\Authzone\Console\Commands;

use Illuminate\Console\Command;

class Install extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'authzone:install {--jetstream : Indicate that Jetstream support views & components will be published}
                                             {--breeze : Indicate that Breeze support views & components will be published}
                                             {--noviews : Indicate that only the config and routes are published}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish the authzone layouts, views, and config';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->comment('Publishing files...');

        // This is the default tag
        $tag = 'authzone-default';

        // Publish the jetstream option with no views
        if ($this->option('jetstream') && $this->option('noviews')) {
            $tag = 'authzone-no-views-jetstream';
        }
        // Publish the breeze option with no views
        if ($this->option('breeze') && $this->option('noviews')) {
            $tag = 'authzone-no-views-breeze';
        }
        // Publish the jetstream option
        elseif ($this->option('jetstream')) {
            $tag = 'authzone-jetstream';
        }
        // Publish the breeze option
        elseif ($this->option('breeze')) {
            $tag = 'authzone-breeze';
        }
        // Publish the noviews option
        elseif ($this->option('noviews')) {
            $tag = 'authzone-no-views';
        }

        // Run the publish command
        $this->call('vendor:publish', [
            '--provider' => 'Sentgine\Authzone\AuthzoneServiceProvider',
            '--tag' => $tag,
        ]);

        $this->info('Files published successfully.');
    }
}
