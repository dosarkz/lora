<?php

namespace Dosarkz\Dosmin\Providers;

use Dosarkz\Dosmin\Commands\AdminInstallCommand;
use Dosarkz\Dosmin\Commands\ModuleInstallCommand;
use Dosarkz\Dosmin\Commands\ModuleMakeCommand;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    private $debug = true;
    /**
     * @param Router $router
     */
    public function boot(Router $router)
    {
        Schema::defaultStringLength(191);
        $this->registerPublishes();
        $this->registerRoutes();
        $this->registerMiddleware($router);

        $this->loadViews();
        $this->registerGuard();
        $this->registerTranslations();
    }


    public function registerPublishes()
    {
        if (!config('admin')) {
            $this->publishes([__DIR__ . '/../Config/admin.php' => config_path('admin.php')], 'admin');
        }
        $this->publishes([__DIR__ . '/../resources/assets' => public_path('vendor/admin')], 'admin');
        $this->publishes([__DIR__ . '/../resources/views' => public_path('vendor/admin/views')], 'admin');
        $this->publishes([__DIR__ . '/../Modules' => app_path('Modules')], 'admin');
    }

    public function registerRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    public function registerMiddleware($router)
    {
        $router->aliasMiddleware('guardAuth', 'Dosarkz\Dosmin\Middleware\GuardAuth');
        $router->aliasMiddleware('role', 'Dosarkz\Dosmin\Middleware\Role');
        $router->aliasMiddleware('language', 'Dosarkz\Dosmin\Middleware\Language');
    }

    public function loadViews()
    {
        if (file_exists(public_path('vendor/admin/views')) && !$this->debug) {
            $path = public_path('vendor/admin/views');
        } else {
            // load default layout of repository
            $path = __DIR__ . '/../resources/views/';
        }

        $this->loadViewsFrom($path, 'admin');
    }

    public function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                AdminInstallCommand::class,
                ModuleInstallCommand::class,
                ModuleMakeCommand::class,
            ]);
        }

        $this->commands([
            ModuleInstallCommand::class,
            ModuleMakeCommand::class,
        ]);
    }

    public function registerGuard()
    {
        Config::set('auth.guards', config('admin.auth.guards'));
        Config::set('auth.providers', config('admin.auth.providers'));
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands();

        foreach ($this->listModules() as $module_name => $baseModule) {
            $this->app->register($baseModule);
        }
        $this->app->register(HelperServiceProvider::class);
    }

    /**
     * @return array
     */
    public function listModules()
    {
        if (is_null(config('admin.modules.providers'))) {
            $config = [];
        } else {
            $config = config('admin.modules.providers');
        }

        return $config;
    }

    public function registerTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'admin');
    }

}


