<?php
namespace Dosarkz\LaravelAdmin\Providers;

use Dosarkz\LaravelAdmin\Commands\AdminInstallCommand;
use Dosarkz\LaravelAdmin\Commands\InstallCommand;
use Dosarkz\LaravelAdmin\Commands\ModuleInstallCommand;
use Dosarkz\LaravelAdmin\Modules;
use Dosarkz\LaravelAdmin\Repositories\Repository;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * @param Router $router
     */
    public function boot(Router $router)
    {
        $this->registerPublishes();
        $this->registerRoutes();
        $this->registerMiddleware($router);
        $this->registerCommands();
        $this->loadViews();
        $this->registerGuard();
        $this->registerTranslations();
    }


    public function registerPublishes()
    {
        $this->mergeConfigFrom( __DIR__ . '/../Config/admin.php', 'admin');

        $this->publishes([ __DIR__ . '/../Config/admin.php' => config_path('admin.php')], 'admin');
        $this->publishes([__DIR__ . '/../Resources/assets' => public_path('vendor/admin')], 'admin');
    }

    public function registerRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    public function registerMiddleware($router)
    {
        $router->aliasMiddleware('guardAuth', 'Dosarkz\LaravelAdmin\Middleware\GuardAuth');
    }

    public function loadViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/views/', 'admin');
    }

    public function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                AdminInstallCommand::class,
                ModuleInstallCommand::class,
            ]);
        }

        $this->commands([
            ModuleInstallCommand::class,
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
        foreach ($this->baseModules() as $baseModule) {
            $this->app->register($baseModule);
        }

        $this->app->register(HelperServiceProvider::class);

        $this->app->singleton('modules', function ($app) {
            $modules = array_merge(config('admin.modules.providers'), $this->baseModules());
            return new Repository($app, $modules);
        });
    }

    /**
     * @return array
     */
    public function baseModules()
    {
        return [
            'superUser' =>  Modules\SuperUser\Providers\SuperUserServiceProvider::class,
            'moduleImage' => Modules\Image\Providers\ImageServiceProvider::class,
            'moduleRole' => Modules\Role\Providers\RoleServiceProvider::class,
        ];
    }

    public function registerTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'admin');
    }


    public function installModule()
    {

    }
}


