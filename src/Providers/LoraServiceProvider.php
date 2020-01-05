<?php

namespace Dosarkz\Lora\Providers;

use Dosarkz\Lora\Commands\LoraInstallCommand;
use Dosarkz\Lora\Commands\ModuleInstallCommand;
use Dosarkz\Lora\Commands\ModuleMakeCommand;
use Dosarkz\Lora\Installation\Utilities\Providers\HelperServiceProvider;
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
        $this->registerMigrations();
        $this->registerViews();
        $this->registerRoutes();
        $this->registerMiddleware($router);
        $this->registerGuard();
        $this->registerTranslations();
    }


    public function registerPublishes()
    {
        if (!config('lora')) {
            $this->publishes([__DIR__ . '/../Config/lora.php' => config_path('lora.php')], 'lora');
        }
        $this->publishes([__DIR__ . '/../Installation/Modules/Lora/Resources/assets' => public_path('vendor/admin')], 'lora');
        $this->publishes([__DIR__ . '/../Installation/Modules/Lora/Resources/views' => public_path('vendor/admin/views')], 'lora');
    }

    public function registerMiddleware($router)
    {
        $router->aliasMiddleware('guardAuth', 'Dosarkz\Lora\Installation\Modules\Lora\Http\Middleware\GuardAuth');
        $router->aliasMiddleware('role', 'Dosarkz\Lora\Installation\Modules\Lora\Http\Middleware\Role');
        $router->aliasMiddleware('language', 'Dosarkz\Lora\Installation\Modules\Lora\Http\Middleware\Language');
    }


    public function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                LoraInstallCommand::class,
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
        Config::set('auth.guards', config('lora.auth.guards'));
        Config::set('auth.providers', config('lora.auth.providers'));
    }

    public function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Installation/Modules/Lora/Database/Migrations');
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
        $modules = [];

        if (is_null(config('admin.modules.providers'))) {
            $config = [];
        } else {
            $config = config('admin.modules.providers');
        }

        return array_merge($config, $modules);
    }

    public function registerTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../Installation/Modules/Lora/Resources/lang', 'lora');
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
//        if (file_exists(public_path('vendor/admin/views'))) {
//            $path = public_path('vendor/admin/views');
//        } else {
//            // load default layout of repository
//            $path = __DIR__ . '/../Resources/views/';
//        }

        $this->loadViewsFrom(__DIR__ . '/../Installation/Modules/Lora/Resources/views/', 'lora');

    }

    public function registerRoutes()
    {
        $this->loadRoutesFrom(__DIR__.'/../Installation/Modules/Lora/Routes/web.php');
    }

}


