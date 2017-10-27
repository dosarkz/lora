<?php
namespace Dosarkz\LaravelAdmin\Providers;

use Dosarkz\LaravelAdmin\Admin;
use Dosarkz\LaravelAdmin\Commands\InstallCommand;
use Dosarkz\LaravelAdmin\Commands\ModuleMakeCommand;
use Dosarkz\LaravelAdmin\Modules\AdminUser\Providers\AdminUserServiceProvider;
use Dosarkz\LaravelAdmin\Modules\Image\Providers\ImageServiceProvider;
use Dosarkz\LaravelAdmin\Modules\Role\Providers\RoleServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {

        $this->publishes([ __DIR__ . '/../config/laravel-admin.php' => config_path('laravel-admin.php')], 'laravel-admin');
        $this->publishes([__DIR__.'/../resources/assets' => public_path('vendor/laravel-admin')], 'laravel-admin');

        $this->loadRoutesFrom(__DIR__ . '/../Routes/routes.php');


        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                ModuleMakeCommand::class,
            ]);
        }

        $router->aliasMiddleware('adminAuth', 'Dosarkz\LaravelAdmin\Middleware\AdminAuth');
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'admin');

        Config::set('auth.guards', config('laravel-admin.auth.guards'));
        Config::set('auth.providers', config('laravel-admin.auth.providers'));

        $this->initBaseModules();
        $this->registerTranslations();
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('laravel-admin', function ($app) {
            return new Admin();
        });
    }

    public function registerTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'admin');
    }

    protected function initBaseModules()
    {
        $this->app->register(AdminUserServiceProvider::class);
        $this->app->register(RoleServiceProvider::class);
        $this->app->register(ImageServiceProvider::class);
    }




}
