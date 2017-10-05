<?php
namespace Dosarkz\LaravelAdmin\Provider;

use Dosarkz\LaravelAdmin\LaravelAdmin;
use Illuminate\Support\ServiceProvider;

class LaravelUploaderServiceProvider extends ServiceProvider
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
            return new LaravelAdmin();
        });
    }




}
