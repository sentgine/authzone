<?php

namespace Sentgine\Authzone;

use Illuminate\Foundation\Events\VendorTagPublished;
use Illuminate\Support\ServiceProvider;
use Sentgine\Authzone\Console\Commands;
use Sentgine\Authzone\Listeners\AfterPublishListener;
use Sentgine\Authzone\View\Components;
use Illuminate\Support\Facades\Blade;
use Sentgine\Authzone\Services\PermissionSearchService;
use Sentgine\Authzone\Services\RoleSearchService;
use Sentgine\Authzone\Services\RolesWithPermissionsSearchService;
use Sentgine\Authzone\Services\UserSearchService;

class AuthzoneServiceProvider extends ServiceProvider
{
    /**
     * The register function.
     * 
     * @return void
     */
    public function register(): void
    {
        // Register helper functions
        $this->registerHelperFunctions();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadViews();
        $this->loadComponents();
        $this->publishThings();
        $this->registerCommands();
        $this->registerDirectives();
        $this->registerSearchServices();
    }

    /**
     * Custom components.
     * 
     * @return array
     */
    protected function myComponents(): array
    {
        return [
            Components\Alert::class,
            Components\Heading::class,
            Components\HeadingSimple::class,
            Components\Modal::class,
            Components\ModalCloseButton::class,
            Components\Table::class,
            Components\TableRow::class,
            Components\TableData::class,
            Components\CreateButton::class,
            Components\UpdateButton::class,
            Components\DeleteButton::class,
            Components\SaveButton::class,
            Components\BackButton::class,
            Components\Search::class,
            Components\FormContainer::class,
            Components\Input::class,
        ];
    }

    /**
     * You can load routes here.
     * 
     * @return void
     */
    protected function loadRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    /**
     * Load views here.
     * 
     * @return void
     */
    protected function loadViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'authzone');
    }

    /**
     * Load components here.
     * 
     * @return void
     */
    protected function loadComponents(): void
    {
        $this->loadViewComponentsAs('authzone-component', $this->myComponents());
    }

    /**
     * Publish things that you want to publish here.
     * 
     * @return void
     */
    protected function publishThings(): void
    {
        // Publish config, views, assets, routes
        foreach ($this->publishables() as $tag => $files) {
            $this->publishes($files, $tag);
        }

        // Add the authzone route to the web.php file
        $this->app->make('events')->listen(VendorTagPublished::class, AfterPublishListener::class);
    }

    /**
     * Returns a list of files to be published.
     * 
     * @return array
     */
    protected function publishables(): array
    {
        $defaultPath = 'views/sentgine/authzone/';
        $default = [
            __DIR__ . '/../routes/authzone.php' => base_path('routes') . '/authzone.php',
            __DIR__ . '/../public/assets/authzone.min.css' => public_path('authzone.min.css'),
            __DIR__ . '/../public/assets/authzone-select2.min.css' => public_path('authzone-select2.min.css'),
        ];

        return [
            'authzone-default' => array_merge($default, [
                __DIR__ . '/../config/authzone.php' => config_path('authzone.php'),
                __DIR__ . '/../resources/views/components' => resource_path($defaultPath . 'components'),
                __DIR__ . '/../resources/views/default' => resource_path($defaultPath . 'default'),
                __DIR__ . '/../resources/views/layouts' => resource_path($defaultPath . 'layouts'),
            ]),
            'authzone-jetstream' => array_merge($default, [
                __DIR__ . '/../config/jetstream.php' => config_path('authzone.php'),
                __DIR__ . '/../resources/views/components' => resource_path($defaultPath . 'components'),
                __DIR__ . '/../resources/views/jetstream' => resource_path($defaultPath . 'jetstream'),
            ]),
            'authzone-breeze' => array_merge($default, [
                __DIR__ . '/../config/breeze.php' => config_path('authzone.php'),
                __DIR__ . '/../resources/views/components' => resource_path($defaultPath . 'components'),
                __DIR__ . '/../resources/views/breeze' => resource_path($defaultPath . 'breeze'),
            ]),
            'authzone-no-views' => array_merge($default, [
                __DIR__ . '/../config/authzone-no-views.php' => config_path('authzone.php'),
            ]),
            'authzone-no-views-jetstream' => array_merge($default, [
                __DIR__ . '/../config/authzone-no-views-jetstream.php' => config_path('authzone.php'),
            ]),
            'authzone-no-views-breeze' => array_merge($default, [
                __DIR__ . '/../config/authzone-no-views-breeze.php' => config_path('authzone.php'),
            ]),
        ];
    }

    /**
     * Register authzone commands.
     * 
     * @return void
     */
    protected function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\Install::class
            ]);
        }
    }

    /**
     * Register authzone helper functions.
     * 
     * @return void
     */
    protected function registerHelperFunctions(): void
    {
        // Register helper functions
        if (file_exists(__DIR__ . '/../helpers/functions.php')) {
            require_once __DIR__ . '/../helpers/functions.php';
        }
    }

    /**
     * Register authzone directives.
     * 
     * @return void
     */
    protected function registerDirectives(): void
    {
        Blade::directive('authzoneAssets', function () {
            return "<?php echo view(authzone_directive_path('assets')); ?>";
        });

        Blade::directive('authzoneDefaultAssets', function () {
            return "<?php echo view(authzone_directive_path('default-assets')); ?>";
        });

        Blade::directive('authzoneJetstreamNavMenu', function () {
            return "<?php echo view(authzone_directive_path('jetstream-navmenu')); ?>";
        });

        Blade::directive('authzoneJetstreamNavMenuResponsive', function () {
            return "<?php echo view(authzone_directive_path('jetstream-navmenu-responsive')); ?>";
        });

        Blade::directive('authzoneBreezeNavMenu', function () {
            return "<?php echo view(authzone_directive_path('breeze-navmenu')); ?>";
        });

        Blade::directive('authzoneBreezeNavMenuResponsive', function () {
            return "<?php echo view(authzone_directive_path('breeze-navmenu-responsive')); ?>";
        });
    }

    /**
     * Register search services
     * 
     * @return void
     */
    protected function registerSearchServices(): void
    {
        $this->app->singleton('searchable.services', function ($app) {
            return [
                'assign-roles' => UserSearchService::class,
                'permissions' => PermissionSearchService::class,
                'roles' => RoleSearchService::class,
                'give-permissions' => RolesWithPermissionsSearchService::class,
            ];
        });
    }
}
