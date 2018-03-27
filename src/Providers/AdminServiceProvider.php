<?php
namespace Dosarkz\Dosmin\Providers;

use Dosarkz\Dosmin\Commands\AdminInstallCommand;
use Dosarkz\Dosmin\Commands\ModuleInstallCommand;
use Dosarkz\Dosmin\Commands\ModuleMakeCommand;
use Dosarkz\Dosmin\Modules;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
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
        if(!config('admin'))
        {
            $this->publishes([ __DIR__ . '/../Config/admin.php' => config_path('admin.php')], 'admin');
           // chmod(config_path('admin.php'), 777);
        }
        $this->publishes([__DIR__ . '/../resources/assets' => public_path('vendor/admin')], 'admin');
    }

    public function registerRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    public function registerMiddleware($router)
    {
        $router->aliasMiddleware('guardAuth', 'Dosarkz\Dosmin\Middleware\GuardAuth');
    }

    public function loadViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'admin');
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
            'menu'          =>  Modules\Menu\Providers\MenuServiceProvider::class,
            'superUser'     =>  Modules\SuperUser\Providers\SuperUserServiceProvider::class,
            'moduleImage'   => Modules\Image\Providers\ImageServiceProvider::class,
            'role'          => Modules\Role\Providers\RoleServiceProvider::class,
            'article'       => Modules\Article\Providers\ArticleServiceProvider::class,
        ];

        if(is_null(config('admin.modules.providers')))
        {
            $config = [];
        }else{
            $config = config('admin.modules.providers');
        }

        return array_merge($config, $modules);
    }

    public function registerTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'admin');
    }

}


