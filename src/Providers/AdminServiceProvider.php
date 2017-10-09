<?php
namespace Dosarkz\LaravelAdmin\Providers;

use Dosarkz\LaravelAdmin\Admin;
use Dosarkz\LaravelAdmin\Commands\InstallCommand;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/laravel-admin.php' => config_path('laravel-admin.php'),
        ]);

        $this->loadMigrationsFrom(__DIR__.'/../Install/Migrations');
<<<<<<< HEAD
        $this->loadRoutesFrom(__DIR__.'/../Install/Routes/routes.php');
=======
>>>>>>> 59bf59a507bc5b0db3528363348485dbac73a7d8

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
            ]);
        }


    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->register('Intervention\Image\ImageServiceProvider');
//        $this->app->bind('Image', 'Intervention\Image\Facades\Image');


        $this->app->singleton('laravel-admin', function ($app) {
            return new Admin();
        });
    }




}
