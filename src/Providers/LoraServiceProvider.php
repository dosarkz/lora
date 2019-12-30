<?php

namespace Dosarkz\Lora\Providers;

use Dosarkz\Lora\Commands\AdminInstallCommand;
use Dosarkz\Lora\Commands\ModuleInstallCommand;
use Dosarkz\Lora\Commands\ModuleMakeCommand;
use Dosarkz\Lora\Modules;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class LoraServiceProvider extends ServiceProvider
{
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
        $this->publishes([__DIR__ . '/../Resources/assets' => public_path('vendor/admin')], 'admin');
        $this->publishes([__DIR__ . '/../Resources/views' => public_path('vendor/admin/views')], 'admin');
    }

    public function registerRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    public function registerMiddleware($router)
    {
        $router->aliasMiddleware('guardAuth', 'Dosarkz\Lora\Middleware\GuardAuth');
        $router->aliasMiddleware('role', 'Dosarkz\Lora\Middleware\Role');
        $router->aliasMiddleware('language', 'Dosarkz\Lora\Middleware\Language');
    }

    public function loadViews()
    {
        if (file_exists(public_path('vendor/admin/views'))) {
            $path = public_path('vendor/admin/views');
        } else {
            // load default layout of repository
            $path = __DIR__ . '/../Resources/views/';
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
        $modules = [
            'menu' => Modules\Menu\Providers\MenuServiceProvider::class,
            'superUser' => Modules\SuperUser\Providers\SuperUserServiceProvider::class,
            'moduleImage' => Modules\Image\Providers\ImageServiceProvider::class,
            'role' => Modules\Role\Providers\RoleServiceProvider::class,
        ];

        if (is_null(config('admin.modules.providers'))) {
            $config = [];
        } else {
            $config = config('admin.modules.providers');
        }

        return array_merge($config, $modules);
    }

    public function registerTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'admin');
    }

}


